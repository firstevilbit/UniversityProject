<?php

# Ссылка на большую фото
  if (isset($_GET['gallery_file'])) $gallery_file = trim($_GET['gallery_file']);

  resizeimg(/*'http://'.$_SERVER["HTTP_HOST"].*/'../image/'.$gallery_file, 180, 180);

  function resizeimg($filename, $w, $h)
    {
      $ratio = $w / $h;
      $size_img = getimagesize($filename);
      if (($size_img[0] < $w) && ($size_img[1] < $h)) return true;
      $src_ratio = $size_img[0] / $size_img[1];
      if ($ratio < $src_ratio) $h = $w / $src_ratio;
      else $w = $h * $src_ratio;
      $dest_img = imagecreatetruecolor($w, $h);
      if  ($size_img[2] == 2) $src_img = imagecreatefromjpeg($filename);
      elseif  ($size_img[2] == 1) $src_img = imagecreatefromgif($filename);
      elseif  ($size_img[2] == 3) $src_img = imagecreatefrompng($filename);
      if (!imagecopyresampled($dest_img, $src_img, 0, 0, 0, 0, $w, $h, $size_img[0], $size_img[1])) return false;
      $path_parts = pathinfo($filename);
      // Вывод изображений в браузер
      if ($path_parts['extension'] == 'jpg')
        {
          header('Content-type: image/jpeg');
          imagejpeg($dest_img);
        }
      elseif ($path_parts['extension'] == 'gif')
        {
          header('Content-type: image/gif');
          imagegif($dest_img);
        }
      elseif ($path_parts['extension'] == 'png')
        {
          header('Content-type: image/png');
          imagepng($dest_img);
        }
      imagedestroy($dest_img);
      imagedestroy($src_img);
      return true;
    }

?>