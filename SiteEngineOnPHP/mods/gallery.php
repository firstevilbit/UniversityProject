<?php
/* Галерея. Версия 2.0
   Особенности версии:
   1. Удаление пробелов в начале и в конце входных переменных
   2. Проверка на корректность числовых переменных
   3. Обнуление переменных (не заданных явным оброзом)
   4. Разбивка на страницы по N сообщений
   5. Выбор колличества сообщений на страницу
   6. Хранение данных в MySQL.
   7. Cлучаенное фото
   8. Меню (на каждый раздел случаенное фото)
   9. Выборка по определённому разделу
   10. Счётчик на фотки

                                        EvilBit(C)
*/
  require_once('gallery_conf.php');

  if (isset($gallery_file))
    {
      $db_result = mysqli_query($db_conn, "SELECT * FROM gallery WHERE gallery_id = '$gallery_file'");
      if (!$db_result || mysqli_num_rows($db_result) < 1) $gallery_include .= 'Ошибка. Такого файла в базе данных нет!';
      else
        {
          mysqli_query($db_conn, "UPDATE gallery SET gallery_count = gallery_count+1 WHERE gallery_id = '$gallery_file'");
          $gallery_array = mysqli_fetch_array($db_result);
          $gallery_include .= '&nbsp;&nbsp;<a class="url" href="javascript:history.back(1)"><< назад</a><br><br>';
          $gallery_include .= "<center><img src=".$sub_directory."/image/".$gallery_array['gallery_filename']." border=0></center>";
        }
    }
  else
    {
      if ($gallery_access <> 'list')
        {
         if (($gallery_section == 'menu') && !empty($gallery_access)) $db_result = mysqli_query($db_conn, "SELECT *
                                                                                                FROM gallery,
                                                                                                     gallery_section
                                                                                                WHERE gallery.gallery_section_id = gallery_section.gallery_section_id AND
                                                                                                      gallery_section.gallery_section_access = '$gallery_access'
                                                                                                ORDER by gallery.gallery_date DESC");
         elseif (!empty($gallery_section) && !empty($gallery_access)) $db_result = mysqli_query($db_conn, "SELECT *
                                                                                                FROM gallery,
                                                                                                     gallery_section
                                                                                                WHERE gallery.gallery_section_id = gallery_section.gallery_section_id AND
                                                                                                      gallery_section.gallery_section_id = '$gallery_section' AND
                                                                                                      gallery_section.gallery_section_access = '$gallery_access'
                                                                                                ORDER by gallery.gallery_date DESC");
	if (!$db_result) $gallery_include .= 'Ошибка. Запрос не выполнен! (Ошибка №1)';
         else
           {
             $gallery_all = mysqli_num_rows($db_result);
             if (($gallery_all < 1)) $gallery_include.='Фото не найдены! (Ошибка №1)';
             else
               {
                 # создание циферно-асоциативного массива
                 for ($gallery_i = 0; $gallery_i < $gallery_all; $gallery_i++) $gallery_array[$gallery_i] = mysqli_fetch_array($db_result);

                 # скрипт на пдсказки
                 include('gallery_script.inc.php');

                 #####################
                 ## Cлучаенное фото ##
                 #####################
                /* if ($gallery_action == 'random')
                   {
                     # случаянный выбор
                     srand((float)microtime()*1000000);
                     shuffle($gallery_array);

                     $gallery_include.='<center><table class=gallery_table cellSpacing=1 cellPadding=3>';
                     for ($gallery_i = 1; $gallery_i <= 4; $gallery_i++)
                       {
                         $gallery_include.='<tr>';
                         for ($gallery_k = 1; $gallery_k <= $gallery_width; $gallery_k++)
                           {
                             $gallery_include.='<td class=gallery_td width='.(100 / $gallery_width).'%>';
                             if (($gallery_i < $gallery_page*$gallery_count) && ($gallery_i < $gallery_all)) include('gallery.inc.php');
                             $gallery_include.='</td>';
                             ++$gallery_i;
                           }
                         $gallery_include.='</tr>';
                       }
                     $gallery_include.='</table></center><BR><BR>';
                   }

                 #############################################
                 ## Меню (на каждый раздел случаенное фото) ##
                 #############################################
                 else
                   {                        */
                     # Список ID других разделов
                     $db_result_menu = mysqli_query($db_conn, "SELECT gallery_section_id,
                                                           gallery_section_title,
                                                           gallery_section_comment
                                                    FROM gallery_section
                                                    WHERE gallery_section.gallery_section_access = '$gallery_access'
                                                    ORDER BY gallery_section_sort");
                     if (!$db_result_menu) $gallery_include .= 'Ошибка. Запрос не выполнен! (Ошибка №2)';
                     else
                       {
                         $gallery_all_menu = mysqli_num_rows($db_result_menu);
                         if ($gallery_all_menu < 1) $gallery_include.='Фото не найдены! (Ошибка №2)';
                         else
                           {
                             # создание циферно-асоциативного массива
                             for ($gallery_i = 0; $gallery_i < $gallery_all_menu; $gallery_i++) $gallery_array_menu[$gallery_i] = mysqli_fetch_array($db_result_menu);
                           }
                       }

                     if ($gallery_section == 'menu')
                       {
                         $gallery_include .= '<div align="center"><table class=gallery_table border=0 cellSpacing=0 cellPadding=6>';
                         $gallery_k = 0;
                         # пробегаемся по секциям
                         for ($gallery_i = 0; $gallery_i < $gallery_all_menu; $gallery_i++)
                           {
                             $db_result = mysqli_query($db_conn, "SELECT * FROM gallery, gallery_section WHERE gallery.gallery_section_id = '".$gallery_array_menu[$gallery_i]['gallery_section_id']."' AND
                                                                                                    gallery.gallery_section_id = gallery_section.gallery_section_id");
                             if (!$db_result) $gallery_include .= 'Ошибка. Запрос не выполнен!';
                             else
                               {
                                 # кол-во  фоток в секции
                                 $gallery_all_2 = mysqli_num_rows($db_result);
								 
                                 if ($gallery_all_2 > 0)
                                   {
                                     # обнуляем переменную
                                     $gallery_array_2 = array();

                                     # создание циферно-аcсоциативного массива
                                     for ($gallery_j = 0; $gallery_j < $gallery_all_2; $gallery_j++) $gallery_array_2[$gallery_j] = mysqli_fetch_array($db_result);

                                     # случаянный выбор
                                     //srand((float)microtime()*1000000);
                                     shuffle($gallery_array_2);

                                     //Кол. просмотров
                                     $count_view_result_query = mysqli_query($db_conn, "SELECT sum(gallery_count) FROM gallery WHERE gallery_section_id = '".$gallery_array_menu[$gallery_i]['gallery_section_id']."'");

                                     while ($count_view_data=mysqli_fetch_array($count_view_result_query))
                                       $count_view=$count_view_data['sum(gallery_count)'];
                                     if (!isset($count_view)) $count_view=0;

                                     //Последнее обновление
                                     $update_date_result_query = mysqli_query($db_conn, "SELECT * FROM gallery WHERE gallery_section_id = '".$gallery_array_menu[$gallery_i]['gallery_section_id']."' ORDER by gallery_date");

                                     while ($update_date_data=mysqli_fetch_array($update_date_result_query))
                                       $update_date=$update_date_data['gallery_date'];
                                     if (!isset($update_date)) $update_date='нет';

                                     $gallery_include .= '<tr><td class=gallery_td rowspan="2" align="center" width=200>';
                                     $gallery_include .= '  <a href='.$sub_directory.'/?param='.$param.'&gallery_section='.$gallery_array_2[0]['gallery_section_id'].'><img style="border: 1px solid #000000; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px;" src='.$sub_directory.'/mods/gallery_resizeimg.inc.php?gallery_file='.$gallery_array_2[0]['gallery_filename'].' border=0></a></td>';
                                     $gallery_include .= '<td class=gallery_td><h2>'.$gallery_array_2[0]['gallery_section_title'].'</h2><BR></td></tr>
                                                          <tr><td class=gallery_td height=130>';
                                     if (!empty($gallery_array_2[0]['gallery_section_comment'])) $gallery_include .= '<b>Комментарий:</b> '.$gallery_array_2[0]['gallery_section_comment'].'<br>';
                                     $gallery_include .= '<b>Количество фотографий:</b> '.$gallery_all_2.'<br>';
                                     $gallery_include .= '<b>Количество просмотров:</b> '.$count_view.'<br>';
                                     $gallery_include .= '<b>Последнее обновление:</b> '.get_date_format($update_date).'<br><br>';
                                     $gallery_include .= '<b><a href='.$sub_directory.'/?param='.$param.'&gallery_section='.$gallery_array_2[0]['gallery_section_id'].'>Посмотреть >></a></b></td></tr>';
                                   }
                               }
                           }
                         if ($gallery_k != 0)
                           for ($gallery_i = $gallery_k; $gallery_i < $gallery_width; $gallery_i++)
                             {
                               $gallery_include .= '<td class=gallery_td width='.(100 / $gallery_width)."%></td>\n";
                             }
                         $gallery_include.='</tr></table></div><BR><BR>';
                       }

                     #########################################
                     ## Выборка по определённому разделу    ##
                     #########################################
                     else
                       {
                         # меню
                         $gallery_include .= '<a class=url href='.$sub_directory.'/?param='.$param.'&gallery_section=menu>Перейти в меню</a>';
                         for ($gallery_i = 0; $gallery_i < $gallery_all_menu; $gallery_i++)
                           {                     
                             $gallery_include .= ' | ';
                             if ($_SESSION['gallery_section'] <> $gallery_array_menu[$gallery_i]['gallery_section_id']) $gallery_include .= '<a class=url href='.$sub_directory.'/?param=vmk_foto&gallery_section='.$gallery_array_menu[$gallery_i]['gallery_section_id'].'>';
                             $gallery_include .= $gallery_array_menu[$gallery_i]['gallery_section_title'];
                             if ($_SESSION['gallery_section'] <> $gallery_array_menu[$gallery_i]['gallery_section_id']) $gallery_include .= '</a>';
                           }
                         $gallery_include .= '<br><br>';

                         $gallery_include .= '<center><table class=gallery_table cellSpacing=1 cellPadding=3>';
                         # указатель на фото
                         $gallery_i = ($gallery_page-1)*$gallery_count;
                         while (($gallery_i < $gallery_page*$gallery_count) && ($gallery_i < $gallery_all))
                           {
                             $gallery_include.='<tr>';
                             for ($gallery_k = 1; $gallery_k <= $gallery_width; $gallery_k++)
                               {
                                 $gallery_include.='<td class=gallery_td width='.(100 / $gallery_width).'%>';
                                 if (($gallery_i < $gallery_page*$gallery_count) && ($gallery_i < $gallery_all)) include('gallery.inc.php');
                                 $gallery_include.='</td>';
                                 ++$gallery_i;
                               }
                             $gallery_include.='</tr>';
                           }
                         $gallery_include.='</table></center><BR><BR>';

                         # ссылки на остальные страницы
                         $gallery_page_all = (($gallery_all-1) / $gallery_count)+1;     # все страницы
                         $gallery_include.='<p style="text-align: center">Всего фото: '.$gallery_all.'<BR>Текущая страница: | ';
                         $gallery_page_this = 0;          # задаём начальное значение
                         for ($gallery_i=1; $gallery_i <= $gallery_page_all; $gallery_i++)
                           {
                             $gallery_page_link=(($gallery_i-1)*$gallery_count+1).'-'.$gallery_i*$gallery_count;  # с какой начинаем - какой кончается
                             $gallery_page_this+=1;                                                   # какой порядковый номер у страницы
                             if ($gallery_page != $gallery_i)
                               $gallery_include.='<a class=url href='.$sub_directory.'/?param='.$param.'&gallery_count='.$gallery_count.'&gallery_page='.$gallery_page_this.'>'.$gallery_page_link.'</a> | ';
                             else $gallery_include.=$gallery_page_link.' | ';
                           }

                         # вывод разного колличества сообщений на страницу
                         $gallery_include.='<br>Показывать по: | ';
                         for ($gallery_i=5; $gallery_i <= 20; $gallery_i+=5)
                           {
                             if ($gallery_count != $gallery_i)
                               $gallery_include.='<a class=url href='.$sub_directory.'/?param='.$param.'&gallery_count='.$gallery_i.'&gallery_page='.(intval(($gallery_page-1)*$gallery_count/$gallery_i)+1).">$gallery_i</a> | ";
                             else $gallery_include.="$gallery_i | ";
                           }
                         $gallery_include.='</center><br>';
                       }
                  # }
               }
           }
        }
    }

  # Заменяем вставки в тексте на переменные
  $content = str_replace('<<gallery_include>>', $gallery_include, $content);
?>