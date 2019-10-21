<?php
  # Вывод методичек.

  $methodics_include .= '<tr bgcolor=';
  if ($methodics_bool == false)
    {
      $methodics_include .= '#DDDDDD';
      $methodics_bool = true;
    }
  else
    {
      $methodics_include .= '#EEEEEE';
      $methodics_bool = false;
    }

  $db_result = mysqli_query($db_conn, "SELECT file_dir, file_name, file_count FROM files WHERE file_id='".$methodics_array[$methodics_i]['methodics_file']."'");
  # выбираем данные
  $db_result_array = SetData($db_result);

  $methodics_include .= '>
  <td align=left>'.$methodics_array[$methodics_i]['methodics_discipline'].'</td>
  <td align=left>'.$methodics_array[$methodics_i]['methodics_auth'].'</td>
  <td align=left>'.$methodics_array[$methodics_i]['methodics_name'].'</td>
  <td align=center>'.get_date_format($methodics_array[$methodics_i]['methodics_date']).'</td>
  <td align=right>'.sprintf("%d", (@filesize($_SERVER["DOCUMENT_ROOT"].'/'.$db_result_array['file_dir'].$db_result_array['file_name']) / 1024)).'&nbsp;Кб</td>
  <td align=right>'.@$db_result_array['file_count'].'&nbsp;раз</td>
  <td align=center><a href='.$sub_directory.'/?category=file&param='.$methodics_array[$methodics_i]['methodics_file'].'>Скачать</a></td>
  </tr>';

?>