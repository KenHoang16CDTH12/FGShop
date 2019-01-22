<?php
  //path system
  define('PATH_ROOT', __DIR__);
  define('PATH_PUBLIC', __DIR__.'/public');
  define('PATH_SYSTEM', __DIR__.'/system');
  define('PATH_APPLICATION', __DIR__.'/admin');
  define('PATH_MODEL', __DIR__.'/model');
  define('PATH_ASSETS', __DIR__.'/assets');
  //url of ken
  define('URL_ASSETS_IMAGE', 'assets/image');
  define('URL', 'http://localhost/mvc/FGShop/admin.php?');
  //Get Parameter config
  require (PATH_SYSTEM . '/config/config.php');

  //open file FT_Common.php, file have function FT_Load() run system
  include_once PATH_SYSTEM . '/core/FT_Common.php';

  //Run program
  FT_Load();
 ?>
