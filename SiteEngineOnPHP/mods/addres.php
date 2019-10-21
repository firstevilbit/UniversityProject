<?php

  $addres_owner = $param;
  $temp_bool = false;

  while ($addres_owner <> 'owner')
    {
	  $db_resulta = mysqli_query($db_conn, "SELECT page_name, page_owner, page_title, page_content FROM pages WHERE page_name='$addres_owner'");
      $db_result_arraya = SetData($db_resulta);
      $addres_owner = stripslashes($db_result_arraya['page_owner']);
      if (empty($addres_owner)) $addres_owner = 'index';
      elseif ($temp_bool == false) $addres_new = stripslashes($db_result_arraya['page_title']).'\\';
                              else $addres_new = '<a href='.$sub_directory.'/?param='.stripslashes($db_result_arraya['page_name']).'>'.stripslashes($db_result_arraya['page_title']).'</a>\\'.$addres_new;
      $temp_bool = true;
    }
  $addres_new = '\\\\'.$addres_new;

?>