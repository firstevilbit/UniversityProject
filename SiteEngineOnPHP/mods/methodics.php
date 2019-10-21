<?php
/* Методички. Версия 1.0
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
# methodics.php | Методички
#-----------------------------
  # Создаём короткие переменные и удаляем пробелы в начале и в конце переменных
  # Количество новостей на странице
  if (isset($_GET['methodics_count'])) $methodics_count = trim($_GET['methodics_count']);
  if (empty($methodics_count) || !is_numeric($methodics_count)) $methodics_count = 5;
  # Отображаемая в данный момент страница
  if (isset($_GET['methodics_page'])) $methodics_page = trim($_GET['methodics_page']);
  if (empty($methodics_page) || !is_numeric($methodics_page)) $methodics_page = 1;
  # Раздел новостей
  if (isset($_GET['methodics_section'])) $methodics_section = trim($_GET['methodics_section']);
  else $methodics_section = 'all';
  #
  if (isset($_POST['methodics_discipline'])) $methodics_discipline = trim($_POST['methodics_discipline']);
  #
  if (isset($_POST['methodics_auth'])) $methodics_auth = trim($_POST['methodics_auth']);
  #
  if (isset($_GET['methodics_file'])) $methodics_file = trim($_GET['methodics_file']);
  # Обнуляем переменную
  $methodics_include = '';
#--------------------------------------

  if (isset($methodics_file))
    {
      $db_result = mysql_query($db_conn, "SELECT * FROM methodics WHERE methodics_file = '$methodics_file'");
      if (!$db_result || mysql_num_rows($db_result) < 1) $methodics_include .= 'Ошибка. Такого файла в базе данных нет!';
      else
        {
          mysql_query("UPDATE methodics SET methodics_count = methodics_count+1 WHERE methodics_file = '$methodics_file'");
          header("Location: /files/".$methodics_file);
        }
    }
  else
    {
      #####################
      ## Выпадающее меню ##
      #####################
      $methodics_include .= '
        <form action='.$sub_directory.'/?category=page&param=vmk_methodics method=POST>
          &nbsp;&nbsp;&nbsp;&nbsp;
          <select size=1 name=methodics_discipline>
            <option value=>Все дисциплины</option>';

      # Делаем запрос на дисциплины
      $db_result = mysqli_query($db_conn, "SELECT methodics_discipline FROM methodics GROUP BY methodics_discipline");
      if (!$db_result) $methodics_include .= 'Ошибка. Запрос не выполнен!';
      elseif (($methodics_all = mysqli_num_rows($db_result)) > 0)
        {
            # Заполняем дисциплины
            for ($methodics_i = 0; $methodics_i < $methodics_all; $methodics_i++)
              {
                $methodics_array = mysqli_fetch_array($db_result);
                $methodics_include .= '<option value="'.$methodics_array['methodics_discipline'].'">'.$methodics_array['methodics_discipline']."</option>\n";
              }
        }

      $methodics_include .= '
          </select>
          <select size=1 name=methodics_auth>
            <option value=>Все авторы</option>';

      # Делаем запрос на авторов
      $db_result = mysqli_query($db_conn, "SELECT methodics_auth FROM methodics GROUP BY methodics_auth");
      if (!$db_result) $methodics_include .= 'Ошибка. Запрос не выполнен!';
      elseif (($methodics_all = mysqli_num_rows($db_result)) > 0)
        {
            # Заполняем авторов
            for ($methodics_i = 0; $methodics_i < $methodics_all; $methodics_i++)
              {
                $methodics_array = mysqli_fetch_array($db_result);
                $methodics_include .= '<option value="'.$methodics_array['methodics_auth'].'">'.$methodics_array['methodics_auth']."</option>\n";
              }
        }

      # Конец выпадающего меню
      $methodics_include .= '
          </select>
          <input type=submit value=Отобразить>
        </form>';

      if (!empty($methodics_discipline) && !empty($methodics_auth)) $db_result = mysqli_query($db_conn, "SELECT * FROM methodics WHERE methodics_discipline = '$methodics_discipline' AND methodics_auth = '$methodics_auth' ORDER by methodics_date DESC");
      elseif (!empty($methodics_discipline)) $db_result = mysqli_query($db_conn, "SELECT * FROM methodics WHERE methodics_discipline = '$methodics_discipline' ORDER by methodics_date DESC");
      elseif (!empty($methodics_auth)) $db_result = mysqli_query($db_conn, "SELECT * FROM methodics WHERE methodics_auth = '$methodics_auth' ORDER by methodics_date DESC");
      else $db_result = mysqli_query($db_conn, "SELECT * FROM methodics ORDER by methodics_date DESC");
      if (!$db_result) $methodics_include .= 'Ошибка. Запрос не выполнен!';
      elseif (($methodics_all = mysqli_num_rows($db_result)) < 1) $methodics_include .= '&nbsp;&nbsp;&nbsp;&nbsp; Методички не найдены!';
        else
          {
            # создание циферно-асоциативного массива
            for ($methodics_i = 0; $methodics_i < $methodics_all; $methodics_i++) $methodics_array[$methodics_i] = mysqli_fetch_array($db_result);

            # Шапка таблицы
            $methodics_include.="
            <center><table cellSpacing=1 cellPadding=3 border=0 width=95% bgcolor=#000000>
            <tr bgcolor=#C8DCF5>
              <td align=center><b>Дисциплина</b></td>
              <td align=center><b>Автор</b></td>
              <td align=center><b>Комментарий</b></td>
              <td align=center><b>Дата&nbsp;добавления</b></td>
              <td align=center><b>Размер</b></td>
              <td align=center><b>Скачано</b></td>
              <td align=center><b>Файл</b></td>
            </tr>\n";

            $methodics_bool = false;
            # вывод методичек
            for ($methodics_i = ($methodics_page-1)*$methodics_count; ($methodics_i < $methodics_page*$methodics_count) && ($methodics_i < $methodics_all); $methodics_i++)
              {
                include('methodics.inc.php');
              }
            $methodics_include.='</table></center><BR><BR>';

            # ссылки на остальные страницы
            $methodics_page_all = (($methodics_all-1) / $methodics_count)+1;     # все страницы
            $methodics_include.="<CENTER>Всего методичек: $methodics_all<BR>Методички: | ";
            $methodics_page_this = 0;          # задаём начальное значение
            for ($methodics_i=1; $methodics_i <= $methodics_page_all; $methodics_i++)
              {
                $methodics_page_link=(($methodics_i-1)*$methodics_count+1).'-'.$methodics_i*$methodics_count;  # с какой начинаем - какой кончается
                $methodics_page_this+=1;                                                   # какой порядковый номер у страницы
                if ($methodics_page != $methodics_i)
                  $methodics_include.="<a href=".$sub_directory."/?category=page&param=$param&methodics_count=$methodics_count&methodics_page=$methodics_page_this>$methodics_page_link</a> | ";
                else $methodics_include.="$methodics_page_link | ";
              }

            # вывод разного колличества сообщений на страницу
            $methodics_include.='<br>Показывать по: | ';
            for ($methodics_i=5; $methodics_i <= 20; $methodics_i+=5)
              {
                if ($methodics_count != $methodics_i)
                  $methodics_include.="<a href=".$sub_directory."/?category=page&param=$param&methodics_count=$methodics_i&methodics_page=".(intval(($methodics_page-1)*$methodics_count/$methodics_i)+1).">$methodics_i</a> | ";
                else $methodics_include.="$methodics_i | ";
              }
            $methodics_include.='</center>';
          }
    }

  # Заменяем вставки в тексте на переменные
  $content = str_replace('<<methodics_include>>', $methodics_include, $content);
?>