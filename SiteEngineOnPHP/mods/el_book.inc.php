<?php
  # Вывод методичек.

  $el_book_include .= '<tr bgcolor=';
  if ($el_book_bool == false)
    {
      $el_book_include .= '#DDDDDD';
      $el_book_bool = true;
    }
  else
    {
      $el_book_include .= '#EEEEEE';
      $el_book_bool = false;
    }

  $db_result = mysqli_query($db_conn, "SELECT file_dir, file_name, file_count FROM files WHERE file_id='".$el_book_array[$el_book_i]['el_book_file']."'");
  # выбираем данные
  $db_result_array = SetData($db_result);

  $el_book_include .= '>
  <td align=left>'.$el_book_array[$el_book_i]['el_book_auth'].'</td>
  <td align=left>'.$el_book_array[$el_book_i]['el_book_name'].'</td>            
  <td align=center>'.get_date_format($el_book_array[$el_book_i]['el_book_date']).'</td>
  <td align=right>'.sprintf("%d", (@filesize($_SERVER["DOCUMENT_ROOT"].'/'.$db_result_array['file_dir'].$db_result_array['file_name']) / 1024)).'&nbsp;Кб</td>
  <td align=right>'.@$db_result_array['file_count'].'&nbsp;раз</td>
  <td align=center><a href='.$sub_directory.'/?category=file&param='.$el_book_array[$el_book_i]['el_book_file'].'>Скачать</a></td>
  </tr>';

?>