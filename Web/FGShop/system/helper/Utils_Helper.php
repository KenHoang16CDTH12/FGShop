<?php if ( ! defined('PATH_SYSTEM')) die ('Bad requested!');

// Redirect url
function redirect_to($url) {
    header("location: $url");
}

function increment_once(&$index){
  $index += 1;
  return $index;
}

function go_back(){
  if (isset($_SERVER["HTTP_REFERER"])) {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }
}
