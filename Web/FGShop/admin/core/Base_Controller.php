<?php  if(!defined('PATH_SYSTEM')) die('Bad request!');

class Base_Controller extends FT_Controller {

  public function __construct() {
    parent::__construct();
  }

  public function load_header() {
    //Load content header
  }

  public function load_footer() {
    //Load content footer
  }

  //Cancel task show content of view, this time controller
  //needn't call $this->view->show
  public function __destruct() {
    $this->view->show();
  }

  public function have_token() {
    $token = isset($_GET['token']) ? $_GET['token'] : null;
    if (isset($_COOKIE['token'])) {
      if ($token != null) {
        $user = $this->model->load('Users');
        $result = $this->model->Users->check_token_exists($token);
        if ($result == 0) redirect_to(URL . "controller=user&action=login&status=403");
        else return $token;
      }

    } else {
      redirect_to(URL . "controller=user&action=login&status=405");
    }
  }
}
