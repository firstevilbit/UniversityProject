<?php

#-----------------------------
# gallery.php
#-----------------------------
  # Количество фоток на странице
  if (!empty($_GET['gallery_count'])) $gallery_count = trim($_GET['gallery_count']);
  elseif (!empty($_POST['gallery_count'])) $gallery_count = trim($_POST['gallery_count']);
  elseif (!empty($_SESSION['gallery_count'])) $gallery_count = trim($_SESSION['gallery_count']);
  if (empty($gallery_count) || !is_numeric($gallery_count)) $gallery_count = 10;
  $_SESSION['gallery_count'] = $gallery_count;

  # Отображаемая в данный момент страница
  if (!empty($_GET['gallery_page'])) $gallery_page = trim($_GET['gallery_page']);
  elseif (!empty($_POST['gallery_page'])) $gallery_page = trim($_POST['gallery_page']);
  elseif (!empty($_SESSION['gallery_page'])) $gallery_page = trim($_SESSION['gallery_page']);
  if (empty($gallery_page) || !is_numeric($gallery_page)) $gallery_page = 1;
  $_SESSION['gallery_page'] = $gallery_page;

  # Действие в галлереи
  if (!empty($_GET['gallery_action'])) $gallery_action = trim($_GET['gallery_action']);
  elseif (!empty($_POST['gallery_action'])) $gallery_action = trim($_POST['gallery_action']);
  elseif (!empty($_SESSION['gallery_action'])) $gallery_action = trim($_SESSION['gallery_action']);
  if (empty($gallery_action)) $gallery_action = '';
  $_SESSION['gallery_action'] = $gallery_action;

  # Отображаемая в данный момент секция
  if (!empty($_GET['gallery_section'])) $gallery_section = trim($_GET['gallery_section']);
  elseif (!empty($_POST['gallery_section'])) $gallery_section = trim($_POST['gallery_section']);
  elseif (!empty($_SESSION['gallery_section'])) $gallery_section = trim($_SESSION['gallery_section']);
  if (empty($gallery_section)) $gallery_section = 'menu';
  $_SESSION['gallery_section'] = $gallery_section;

  #
  if (!empty($_GET['gallery_access'])) $gallery_access = trim($_GET['gallery_access']);
  elseif (!empty($_POST['gallery_access'])) $gallery_access = trim($_POST['gallery_access']);
  elseif (!empty($_SESSION['gallery_access'])) $gallery_access = trim($_SESSION['gallery_access']);
  if (empty($gallery_access)) $gallery_access = '';
  $_SESSION['gallery_access'] = $gallery_access;

  #
  if (!empty($_GET['gallery_section_id'])) $gallery_section_id = trim($_GET['gallery_section_id']);
  elseif (!empty($_POST['gallery_section_id'])) $gallery_section_id = trim($_POST['gallery_section_id']);
  elseif (!empty($_SESSION['gallery_section_id'])) $gallery_section_id = trim($_SESSION['gallery_section_id']);
  if (empty($gallery_section_id)) $gallery_section_id = 'all';
  $_SESSION['gallery_section_id'] = $gallery_section_id;

  # Ссылка на фото
  if (isset($_GET['gallery_file'])) $gallery_file = trim($_GET['gallery_file']);

  # Количество ячеек в ширину
  if (empty($gallery_width) || !is_numeric($gallery_width)) $gallery_width = 4;

  # Админка
  # ID фотки
  if (!empty($_GET['gallery_id'])) $gallery_id = trim($_GET['gallery_id']);
  elseif (!empty($_POST['gallery_id'])) $gallery_id = trim($_POST['gallery_id']);
  elseif (!empty($_SESSION['gallery_id'])) $gallery_id = trim($_SESSION['gallery_id']);
  if (empty($gallery_id) || !is_numeric($gallery_id)) $gallery_id = 1;
  $_SESSION['gallery_id'] = $gallery_id;

  # Количество фоток в админке
  if (!empty($_GET['gallery_count_admin'])) $gallery_count_admin = trim($_GET['gallery_count_admin']);
  elseif (!empty($_POST['gallery_count_admin'])) $gallery_count_admin = trim($_POST['gallery_count_admin']);
  elseif (!empty($_SESSION['gallery_count_admin'])) $gallery_count_admin = trim($_SESSION['gallery_count_admin']);
  if (empty($gallery_count_admin) || !is_numeric($gallery_count_admin)) $gallery_count_admin = 15;
  $_SESSION['gallery_count_admin'] = $gallery_count_admin;

  # upload папка (абсолютный локальный адрес)
  $gallery_upload_dir = $base_upload_dir.'/image/';

  # Обнуляем переменную
  $gallery_include = '';

?>