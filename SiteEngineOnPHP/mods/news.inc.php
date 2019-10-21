<?php

  # Вывод новостей.

  $news_include.='<center><table cellSpacing=1 cellPadding=3 border=0 width=95% bgcolor=#000000>';
  $news_include.='<tr><td bgcolor=#AAAAAA><font size=0>&nbsp;<b>Дата: '.get_date_format($news_array[$news_i]['news_date']);

  if ($news_section == 'news_facult') $news_include.=' <font color=#bb3333>Опубликовано для "'.$news_array[$news_i]['public_title'].'"</font>';

  $news_include.='</b></font></td></tr>
                  <tr><td bgcolor=#DDDDDD>&nbsp; '.$news_array[$news_i]['news_content'].'<BR><BR></td></tr>';
  $news_include.='</table></center><BR><BR>';



?>