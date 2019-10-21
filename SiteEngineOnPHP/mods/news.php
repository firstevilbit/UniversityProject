<?php
/* Новости. Версия 1.0
   Особенности версии:
   1. Удаление пробелов в начале и в конце входных переменных
   2. Проверка на корректность числовых переменных
   3. Обнуление переменных (не заданных явным оброзом)
   4. Разбивка на страницы по N сообщений
   5. Выбор колличества сообщений на страницу
   6. Хранение новостей в MySQL.
                                        EvilBit(C)
*/
#-----------------------------
# news.php | Новости
#-----------------------------
  # Создаём короткие переменные и удаляем пробелы в начале и в конце переменных
  # Количество новостей на странице
  if (isset($_GET['news_count'])) $news_count = trim($_GET['news_count']);
  if (empty($news_count) || !is_numeric($news_count)) $news_count = 5;
  # Отображаемая в данный момент страница
  if (isset($_GET['news_page'])) $news_page = trim($_GET['news_page']);
  if (empty($news_page) || !is_numeric($news_page)) $news_page = 1;
  # Раздел новостей
  if (isset($_GET['news_section'])) $news_section = trim($_GET['news_section']);
  else $news_section = '';
  # Публикация новостей
  if (isset($_GET['news_public'])) $news_public = trim($_GET['news_public']);
  else $news_public = '';
  if ($param == 'index') $news_section = 'news_agta';
  # Обнуляем переменную
  $news_include = '';
#--------------------------------

  # выполним запрос
  if ($news_section == 'all') $db_result = mysqli_query($db_conn, "SELECT * FROM news, news_section, news_public
                                                        WHERE news.news_public = news_public.id_public
                                                          AND news.news_section = news_section.id_section
                                                        ORDER by news_date DESC");
  elseif (!empty($news_section) && empty($news_public)) $db_result = mysqli_query($db_conn, "SELECT * FROM news, news_section
                                                                                  WHERE news.news_section = news_section.id_section
                                                                                    AND news_section.section_code = '$news_section'
                                                                                    AND (news.news_date + (news.news_life * 86400) > ".date('Y')."
                                                                                     OR news.news_life = '0')
                                                                                  ORDER by news_date DESC");
  elseif (!empty($news_public))
    {
      if ($news_public == 'ftk') $db_result = mysqli_query($db_conn, "SELECT * FROM news, news_section, news_public
                                                           WHERE news.news_public = news_public.id_public
                                                             AND news.news_section = news_section.id_section
                                                             AND news_section.section_code = 'news_facult'
                                                             AND (news_public.public_code = 'ftk'
                                                               OR news_public.public_code = 'vmk'
                                                               OR news_public.public_code = 'atp'
                                                               OR news_public.public_code = 'pe'
                                                               OR news_public.public_code = 'epp')
                                                             AND (news.news_date + (news.news_life * 86400) > ".date('U')."
                                                               OR news.news_life = '0')
                                                           ORDER by news_date DESC");
      elseif ($news_public == 'manag_business') $db_result = mysqli_query($db_conn, "SELECT * FROM news, news_section, news_public
                                                                          WHERE news.news_public = news_public.id_public
                                                                            AND news.news_section = news_section.id_section
                                                                            AND news_section.section_code = 'news_facult'
                                                                            AND (news_public.public_code = 'manag_business')
                                                                            AND (news.news_date + (news.news_life * 86400) > ".date('U')."
                                                                              OR news.news_life = '0')
                                                                          ORDER by news_date DESC");
      elseif ($news_public == 'tech') $db_result = mysqli_query($db_conn, "SELECT * FROM news, news_section, news_public
                                                                WHERE news.news_public = news_public.id_public
                                                                  AND news.news_section = news_section.id_section
                                                                  AND news_section.section_code = 'news_facult'
                                                                  AND (news_public.public_code = 'tech')
                                                                  AND (news.news_date + (news.news_life * 86400) > ".date('U')."
                                                                    OR news.news_life = '0')
                                                                ORDER by news_date DESC");
      else $db_result = mysqli_query($db_conn, "SELECT * FROM news, news_section, news_public
                                     WHERE news.news_public = news_public.id_public
                                       AND news.news_section = news_section.id_section
                                       AND news_section.section_code = 'news_facult'
                                       AND news_public.public_code = '$news_public'
                                       AND (news.news_date + (news.news_life * 86400) > ".date('U')."
                                         OR news.news_life = '0')
                                     ORDER by news_date DESC");
    }

  if (!$db_result) $news_include .= 'Ошибка. Запрос не выполнен!';
  elseif (($news_all = mysqli_num_rows($db_result)) < 1) $news_include .= 'Нет новостей';
    else
      {
        # создание циферно-асоциативного массива
        for ($news_i = 0; $news_i < $news_all; $news_i++) $news_array[$news_i] = mysqli_fetch_array($db_result);

        # вывод новостей
        for ($news_i = ($news_page-1)*$news_count; ($news_i < $news_page*$news_count) && ($news_i < $news_all); $news_i++)
          {
            include('news.inc.php');
          }

        # ссылки на остальные страницы
        $news_page_all = (($news_all-1) / $news_count)+1;     # все страницы
        $news_include.="<CENTER>Всего новостей: $news_all<BR>Новости: | ";
        $news_page_this = 0;          # задаём начальное значение
        for ($news_i=1; $news_i <= $news_page_all; $news_i++)
          {
            $news_page_link=(($news_i-1)*$news_count+1).'-'.$news_i*$news_count;  # с какой начинаем - какой кончается
            $news_page_this+=1;                                                   # какой порядковый номер у страницы
            if ($news_page != $news_i)
              $news_include.="<a href=".$sub_directory."/?category=page&param=$param&news_section=$news_section&news_public=$news_public&news_count=$news_count&news_page=$news_page_this>$news_page_link</a> | ";
            else $news_include.="$news_page_link | ";
          }

        # вывод разного количества сообщений на страницу
        $news_include.='<br>Показывать по: | ';
        for ($news_i=5; $news_i <= 20; $news_i+=5)
          {
            if ($news_count != $news_i)
              $news_include.="<a href=".$sub_directory."/?category=page&param=$param&news_section=$news_section&news_public=$news_public&news_count=$news_i&news_page=".(intval(($news_page-1)*$news_count/$news_i)+1).">$news_i</a> | ";
            else $news_include.="$news_i | ";
          }
        $news_include.='</center>';
      }

  # Заменяем вставки в тексте на переменные
  $content = str_replace('<<news_include>>', $news_include, $content);
?>