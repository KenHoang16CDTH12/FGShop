<?php
class Admin_Middleware {
  public function handle($role) {
    if ($role == "ADMIN") {
      //next
      return true;
    } else {
      return false;
    }
  }
}
