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
# el_book.php | Методички
#-----------------------------
  # Создаём короткие переменные и удаляем пробелы в начале и в конце переменных
  # Количество новостей на странице
  if (isset($_GET['el_book_count'])) $el_book_count = trim($_GET['el_book_count']);
  if (empty($el_book_count) || !is_numeric($el_book_count)) $el_book_count = 5;
  # Отображаемая в данный момент страница
  if (isset($_GET['el_book_page'])) $el_book_page = trim($_GET['el_book_page']);
  if (empty($el_book_page) || !is_numeric($el_book_page)) $el_book_page = 1;
  # Раздел новостей
  if (isset($_GET['el_book_section'])) $el_book_section = trim($_GET['el_book_section']);
  else $el_book_section = 'all';
  #
  if (isset($_POST['el_book_discipline'])) $el_book_discipline = trim($_POST['el_book_discipline']);
  #
  if (isset($_POST['el_book_auth'])) $el_book_auth = trim($_POST['el_book_auth']);
  #
  if (isset($_GET['el_book_file'])) $el_book_file = trim($_GET['el_book_file']);
  # Обнуляем переменную
  $el_book_include = '';
#--------------------------------------

  if (isset($el_book_file))
    {
      $db_result = mysql_query("SELECT * FROM el_book WHERE el_book_file = '$el_book_file'", $db_conn);
      if (!$db_result || mysql_num_rows($db_result) < 1) $el_book_include .= 'Ошибка. Такого файла в базе данных нет!';
      else
        {
          mysql_query("UPDATE el_book SET el_book_count = el_book_count+1 WHERE el_book_file = '$el_book_file'");
          header("Location: /files/".$el_book_file);
        }
    }
  else
    {
      #####################
      ## Выпадающее меню ##
      #####################
      $el_book_include .= '
        <form action='.$sub_directory.'/?category=page&param=24 method=POST>
          &nbsp;&nbsp;&nbsp;&nbsp;
          <select size=1 name=el_book_auth>
            <option value=>Все авторы</option>';

      # Делаем запрос на авторов
      $db_result = mysqli_query($db_conn, "SELECT el_book_auth FROM el_book GROUP BY el_book_auth");
      if (!$db_result) $el_book_include .= 'Ошибка. Запрос не выполнен!';
      elseif (($el_book_all = mysqli_num_rows($db_result)) > 0)
        {
            # Заполняем авторов
            for ($el_book_i = 0; $el_book_i < $el_book_all; $el_book_i++)
              {
                $el_book_array = mysqli_fetch_array($db_result);
                $el_book_include .= '<option value="'.$el_book_array['el_book_auth'].'">'.$el_book_array['el_book_auth']."</option>\n";
              }
        }

      # Конец выпадающего меню
      $el_book_include .= '
          </select>
          <input type=submit value=Отобразить>
        </form>';

      if (!empty($el_book_discipline) && !empty($el_book_auth)) $db_result = mysqli_query($db_conn, "SELECT * FROM el_book WHERE el_book_discipline = '$el_book_discipline' AND el_book_auth = '$el_book_auth' ORDER by el_book_date DESC");
      elseif (!empty($el_book_discipline)) $db_result = mysqli_query($db_conn, "SELECT * FROM el_book WHERE el_book_discipline = '$el_book_discipline' ORDER by el_book_date DESC");
      elseif (!empty($el_book_auth)) $db_result = mysqli_query($db_conn, "SELECT * FROM el_book WHERE el_book_auth = '$el_book_auth' ORDER by el_book_date DESC");
      else $db_result = mysqli_query($db_conn, "SELECT * FROM el_book ORDER by el_book_date DESC");
      if (!$db_result) $el_book_include .= 'Ошибка. Запрос не выполнен!';
      elseif (($el_book_all = mysqli_num_rows($db_result)) < 1) $el_book_include .= '&nbsp;&nbsp;&nbsp;&nbsp; Методички не найдены!';
        else
          {
            # создание циферно-асоциативного массива
            for ($el_book_i = 0; $el_book_i < $el_book_all; $el_book_i++) $el_book_array[$el_book_i] = mysqli_fetch_array($db_result);

            # Шапка таблицы
            $el_book_include.="
            <center><table cellSpacing=1 cellPadding=3 border=0 width=95% bgcolor=#000000>
            <tr bgcolor=#C8DCF5>
              <td align=center><b>Автор</b></td>
              <td align=center><b>Наименование&nbsp;книги</b></td>  
              <td align=center><b>Дата&nbsp;добавления</b></td>
              <td align=center><b>Размер</b></td>
              <td align=center><b>Скачано</b></td>
              <td align=center><b>Файл</b></td>
            </tr>\n";

            $el_book_bool = false;
            # вывод методичек
            for ($el_book_i = ($el_book_page-1)*$el_book_count; ($el_book_i < $el_book_page*$el_book_count) && ($el_book_i < $el_book_all); $el_book_i++)
              {
                include('el_book.inc.php');
              }
            $el_book_include.='</table></center><BR><BR>';

            # ссылки на остальные страницы
            $el_book_page_all = (($el_book_all-1) / $el_book_count)+1;     # все страницы
            $el_book_include.="<CENTER>Всего методичек: $el_book_all<BR>Методички: | ";
            $el_book_page_this = 0;          # задаём начальное значение
            for ($el_book_i=1; $el_book_i <= $el_book_page_all; $el_book_i++)
              {
                $el_book_page_link=(($el_book_i-1)*$el_book_count+1).'-'.$el_book_i*$el_book_count;  # с какой начинаем - какой кончается
                $el_book_page_this+=1;                                                   # какой порядковый номер у страницы
                if ($el_book_page != $el_book_i)
                  $el_book_include.="<a href=".$sub_directory."/?category=page&param=$param&el_book_count=$el_book_count&el_book_page=$el_book_page_this>$el_book_page_link</a> | ";
                else $el_book_include.="$el_book_page_link | ";
              }

            # вывод разного колличества сообщений на страницу
            $el_book_include.='<br>Показывать по: | ';
            for ($el_book_i=5; $el_book_i <= 20; $el_book_i+=5)
              {
                if ($el_book_count != $el_book_i)
                  $el_book_include.="<a href=".$sub_directory."/?category=page&param=$param&el_book_count=$el_book_i&el_book_page=".(intval(($el_book_page-1)*$el_book_count/$el_book_i)+1).">$el_book_i</a> | ";
                else $el_book_include.="$el_book_i | ";
              }
            $el_book_include.='</center>';
          }
    }

  # Заменяем вставки в тексте на переменные
  $content = str_replace('<<el_book_include>>', $el_book_include, $content);
?>