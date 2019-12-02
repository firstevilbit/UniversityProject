<?php
/* Основная часть движка. Версия 2.0
   Особенности версии:
   1. Хранение всех данных MySQL.
   2. Возможность подключения модулей
                                        EvilBit(C)
*/
  session_start();

  require_once('inc_config.php');

  if ($category <> 'page' && $category <> 'file' && $category <> 'url') error_header('Location: '.$sub_directory.'/?category=page&param=error404');
  # подключение к БД
  if (!$db_conn = @mysqli_connect($db_server, $db_user, $db_pass, $db_database)) error('Ошибка подключения к БД MySQL!<BR>');
  /* проверяем соединение */
  if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
  }
  mysqli_set_charset($db_conn, 'utf8');
  
  # чтение из БД
  switch ($category)
    {
      case 'page':
        # загружаем меню
        include('mods/menu.php');
        # делаем выборку
        $db_result = mysqli_query($db_conn, "SELECT page_name, page_owner, page_title, page_content FROM pages WHERE page_name='$param'");
        # выбираем данные
        if (($db_result_array = SetData($db_result)) == false) error_header('Location: '.$sub_directory.'/?param=error404');
        include('mods/addres.php');
        $addres = $addres_new;
        $content =  stripslashes($db_result_array['page_content']);
		$content =  str_replace('$sub_directory', $sub_directory, $content);
        # новости и объявления
        if (preg_match('<<news_include>>', $content)) include('mods/news.php');
        # методички
        if (preg_match('<<methodics_include>>', $content)) include('mods/methodics.php');
        # электронные книги
        if (preg_match('<<el_book_include>>', $content)) include('mods/el_book.php');
        # Фото галерея
        if (preg_match('<<gallery_include>>', $content)) include('mods/gallery.php');
        # Система тестирования студентов
        if (preg_match('<<testing_include>>', $content)) include('mods/testing.php');
        # Библиотека
        if (preg_match('<<library_include>>', $content)) include('mods/library/index.php');
        # заменяем "$url_site" из текста на реальный URL_SITE
        $content = str_replace('$url_site', URL_SITE, $content);
        include('inc_skin.php');
      break;

      case 'file':
        $db_result = mysqli_query($db_conn, "SELECT file_host, file_dir, file_name FROM files WHERE file_id='$param'");
        # выбираем данные
        if (($db_result_array = SetData($db_result)) == false) error_header('Location: '.$sub_directory.'/?param=error404');
        # заменяем "$url_site" из текста на реальный URL_SITE
        $url_index = str_replace('$url_file_site', URL_FILE_SITE, stripslashes($db_result_array['file_host']).$sub_directory.'/'.stripslashes($db_result_array['file_dir']).'/'.stripslashes($db_result_array['file_name']));
        # увеличиваем счётчик
        mysqli_query($db_conn, "UPDATE files SET file_count = file_count+1 WHERE file_id = '$param'");
        # открывам файл
        header("Location: $url_index");
      break;

      case 'url':
        $db_result = mysqli_query($db_conn, "SELECT url_link FROM urls WHERE url_name='$param'");
        # выбираем данные
        if (($db_result_array = SetData($db_result)) == false) error_header('Location: '.$sub_directory.'/?param=error404');
        $url_index = stripslashes($db_result_array['url_link']);
        # открывам url
        header("Location: $url_index");
      break;
    }
  mysqli_close($db_conn);

##########################
## Вывод ошибки и выход ##
##########################
function error($str = '')
  {
    global $content;
    global $addres;
    global $menu_include;
    $content .= $str;
    include('inc_skin.php');
    exit;
  }

#####################
## Вывод заголовка ##
#####################
function error_header($str)
  {
     header($str);
     exit;
  }

#############################
## Проверка и выбор данных ##
#############################
# $db_result - входные данные
# $db_result_array - выходные данные
function SetData($db_result)
  {
    if (!$db_result) error('Ошибка. Запрос не выполнен!');
    elseif (mysqli_num_rows($db_result) < 1) return false;
    return mysqli_fetch_array($db_result);
  }

###################################################
## Преобразование метки времяни в нормальный вид ##
###################################################
function get_date_format($timestamp)
  {
    $time_array = getdate($timestamp);
    switch ($time_array['month'])
      {
        case 'January':   $time_array['month'] = 'января';   break;
        case 'February':  $time_array['month'] = 'февраля';  break;
        case 'March':     $time_array['month'] = 'марта';    break;
        case 'April':     $time_array['month'] = 'апреля';   break;
        case 'May':       $time_array['month'] = 'мая';      break;
        case 'June':      $time_array['month'] = 'июня';     break;
        case 'July':      $time_array['month'] = 'июля';     break;
        case 'August':    $time_array['month'] = 'августа';  break;
        case 'September': $time_array['month'] = 'сентября'; break;
        case 'October':   $time_array['month'] = 'октября';  break;
        case 'November':  $time_array['month'] = 'ноября';   break;
        case 'December':  $time_array['month'] = 'декабря';  break;
      }
    return "$time_array[mday]&nbsp;$time_array[month]&nbsp;$time_array[year]&nbsp;г.";
  }

?>