<?php

#-----------------------------
# Глобальные
#-----------------------------
  error_reporting(E_ALL & ~E_NOTICE);  # E_ALL & ~E_NOTICE
  if (isset($_GET['category'])) $category = trim($_GET['category']);
  if (isset($_GET['param']))
    {
      $param = trim($_GET['param']);
      $param = addslashes($param); # добавляем слэши перед спец-символами
    }
  if (empty($category)) $category = 'page';             # если ктегория не задана, то делаем редирект на индексовую
  if (empty($param)) $param = 'index';
  $base_upload_dir = 'e:/web/agta.ru';
  $sub_directory = '/SiteEngineOnPHP';
  # Определяем констакты
  define('URL_SITE', 'http://'.$_SERVER["HTTP_HOST"]);
  define('URL_FILE_SITE', 'http://'.$_SERVER["HTTP_HOST"]);
  # Обнуление переменных
  $addres = '';
  $content = '';
  # Параметры базы данных
  $db_server = 'localhost';
  $db_user = 'root';
  $db_pass = '';
  $db_database = 'agta';

#-----------------------------
# menu.php
#-----------------------------
  # Обнуляем переменную
  $menu_include = '';

?>