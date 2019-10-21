<?php

# Выдёргиваем параметр $menu
if (isset($_GET['menu'])) $menu = trim($_GET['menu']);
elseif (isset($_SESSION['menu'])) $menu = trim($_SESSION['menu']);
else $menu = '';
$_SESSION['menu'] = $menu;

# Выдёргиваем параметр $menu_style
if (isset($_GET['menu_style'])) $menu_style = trim($_GET['menu_style']);
elseif (isset($_SESSION['menu_style'])) $menu_style = trim($_SESSION['menu_style']);
else $menu_style = 'st';
$_SESSION['menu_style'] = $menu_style;

# Конфигурация меню
include 'menu_config.inc.php';

$menu_include .= '<div class=MenuBorder>';

if (is_array($menu_level_1))
if ($menu_style == 'js')
  { 
	 
	  {  
		foreach ($menu_level_1 as $key => $val) 	# key - ключ; value - значение
		   { 
			 if ($val['show'] == false) continue;

			 $menu_include .= '<div class=MenuWidth state=0>
							   <div class=MenuButtonU1 classOut=MenuButtonU1 classOver=MenuButtonU1 onMouseOver="Init(this)" title="'.$val['title'].'">'.$val['hint'].'</div>
							   <div style="background:#EEEEEE">';

			 # раскрываем менюху
			 if ($menu == $val['param']) $menu_include .= '<div state=1>';
			 else $menu_include .= '<div style="display:none" state=0>';

			 # если у 2-го уровня есть хоть один пункт, то...
			 if (count($menu_level_2[$key]) > 0)
			   {
				 # перебираем 2-ой уровень в цикле
				 for ($menu_count_2 = 0; $menu_count_2 < count($menu_level_2[$key]); $menu_count_2++)
				   {
					 if ($menu_level_2[$key][$menu_count_2]['show'] == false) continue;

					 # проверяем url или page
					 if (substr($menu_level_2[$key][$menu_count_2]['param'], 0, 3) <> 'url')
					   $menu_level_2[$key][$menu_count_2]['param'] = '&param='.$menu_level_2[$key][$menu_count_2]['param'];
					 else $menu_level_2[$key][$menu_count_2]['param'] = '&category='.$menu_level_2[$key][$menu_count_2]['param'];

					 # если есть addition, добавляем дополнение
					 if (isset($menu_level_2[$key][$menu_count_2]['addition']))
					   $menu_level_2[$key][$menu_count_2]['param'] = $menu_level_2[$key][$menu_count_2]['param'].$menu_level_2[$key][$menu_count_2]['addition'];

					 # формируем ссылку
					 $menu_include .= '<span class=MenuButtonU2 classOut=MenuButtonU2 classOver=MenuButtonU2>•&nbsp;
									   <a href='.$sub_directory.'/?menu='.$val['param'].$menu_level_2[$key][$menu_count_2]['param'].'  title="'.$menu_level_2[$key][$menu_count_2]['title'].'">'.$menu_level_2[$key][$menu_count_2]['hint'].'</a></span><BR>';
					}
			   }
			 $menu_include .= '</div></div></div>';
		   }
	  }
  }
else
  {
    $menu_include .= '<table border=0 cellSpacing=0 cellPadding=0 class=MenuWidth>';
	foreach ($menu_level_1 as $key => $val) 	# key - ключ; value - значение
       {
         if ($val['show'] == false) continue;

         $menu_include .= '<tr><td class=MenuButtonU1 title="'.$val['title'].'">'.$val['hint'];

         # если у 2-го уровня есть хоть один пункт, то...
         if (count($menu_level_2[$key]) > 0)
           {
             # перебираем 2-ой уровень в цикле
             for ($menu_count_2 = 0; $menu_count_2 < count($menu_level_2[$key]); $menu_count_2++)
               {
                 if ($menu_level_2[$key][$menu_count_2]['show'] == false) continue;

                 # проверяем url или page
                 if (substr($menu_level_2[$key][$menu_count_2]['param'], 0, 3) <> 'url')
                   $menu_level_2[$key][$menu_count_2]['param'] = '&param='.$menu_level_2[$key][$menu_count_2]['param'];
                 else $menu_level_2[$key][$menu_count_2]['param'] = '&category='.$menu_level_2[$key][$menu_count_2]['param'];

                 # если есть addition, добавляем дополнение
                 if (isset($menu_level_2[$key][$menu_count_2]['addition']))
                   $menu_level_2[$key][$menu_count_2]['param'] = $menu_level_2[$key][$menu_count_2]['param'].$menu_level_2[$key][$menu_count_2]['addition'];

                 # формируем ссылку
                 $menu_include .= '<tr><td class=MenuButtonU2 style="background:#EEEEEE">•&nbsp;
                                   <a href='.$sub_directory.'/?menu='.$val['param'].$menu_level_2[$key][$menu_count_2]['param'].'  title="'.$menu_level_2[$key][$menu_count_2]['title'].'">'.$menu_level_2[$key][$menu_count_2]['hint'].'</a></td></tr>';
                 }
           }
         $menu_include .= '</td></tr>';
       }
    $menu_include .= '</table>';
  }
$menu_include .= '</div>';


if ($menu_style == 'js') $menu_include .= '<BR><center><small><a href='.$sub_directory.'/?menu_style=st&param='.$param.'>Обычное меню</a></small></center>';
                    else $menu_include .= '<BR><center><small><a href='.$sub_directory.'/?menu_style=js&param='.$param.'>JavaScript меню</a></small></center>';

?>
