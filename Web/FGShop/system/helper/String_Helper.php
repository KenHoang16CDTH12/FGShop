<?php  if(!defined('PATH_SYSTEM')) die('Bad request!');

//Convert character to number
function string_to_int($str) {
  return sprintf("%u", crc32($str));
}

function csrf_token(){
  return bin2hex(random_bytes(16));
  //return generateRandomString(); // if bin2hex errors
}

function generateRandomString($length = 60) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
