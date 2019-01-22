<?php if ( ! defined('PATH_SYSTEM')) die ('Bad requested!');

class Utils_Controller extends Base_Controller
{
   public function dashboard() {
       $data = [
          "message" => "",
          "token" => $_GET['token']
        ];
       $this->view->load('dashboard', $data);
    }

   public function notifications() {
       $data = [
          "message" => "",
          "token" => $_GET['token']
        ];
       $this->view->load('notifications', $data);
    }


   public function table() {
       $data = [
          "message" => "",
          "token" => $_GET['token']
        ];
       $this->view->load('table', $data);
    }

   public function user() {
       $data = [
          "message" => "",
          "token" => $_GET['token']
        ];
       $this->view->load('user', $data);
    }

    public function error() {
        $data = ["message" => $_GET['message']];
        $this->view->load('error', $data);
    }
}
