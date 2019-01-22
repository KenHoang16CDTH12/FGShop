<?php  if(!defined('PATH_SYSTEM')) die('Bad request!');

class FT_Library_Loader {
  public function load($library, $args = []) {
    //if library is exists, is load
    if (empty($this->{$library})) {
      //Convert the first character and add _Library
      $class = ucfirst($library) . '_Library';
      require_once(PATH_SYSTEM . '/library/' . $class . '.php');
      $this->{$library} = new $class($args);
    }
  }
}
