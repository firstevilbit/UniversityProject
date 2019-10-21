<?php

  $gallery_include .=
    "<div id=id_".$gallery_array[$gallery_i]['gallery_id']." style=\"top:0; left:0; position:absolute; visibility:hidden; filter:alpha(Opacity=100, FinishOpacity=65, Style=1, StartX=50, FinishX=150, StartY=50, FinishY=150)\">
       <table cellSpacing=1 cellPadding=3 border=0 bgcolor=#808080>
         <tr><td bgcolor=#FFFFEA align=left>";
  if ($gallery_array[$gallery_i]['gallery_comment'] <> '') $gallery_include .= "<p><b>Коментарии:</b> ".$gallery_array[$gallery_i]['gallery_comment']."<br>";
  $gallery_include .= "<b>Просмотров:</b> ".$gallery_array[$gallery_i]['gallery_count']."<br>
           <b>Дата&nbsp;добавления:</b>&nbsp;".get_date_format($gallery_array[$gallery_i]['gallery_date'])."
         </td></tr>
       </table>
     </div>
     <a href=".$sub_directory."/?param=vmk_foto&gallery_file=".$gallery_array[$gallery_i]['gallery_id'].">
       <img src=".$sub_directory."/mods/gallery_resizeimg.inc.php?gallery_file=".$gallery_array[$gallery_i]['gallery_filename']." border=0 ".'style="border: 1px solid #000000; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px;"'." onMouseOver=\"show('id_".$gallery_array[$gallery_i]['gallery_id']."')\" onMouseOut=\"hide('id_".$gallery_array[$gallery_i]['gallery_id']."')\"></a><br>\n
     <center><font color=#000000>".$gallery_array[$gallery_i]['gallery_comment_small'].'</font></center></p>';

?>
