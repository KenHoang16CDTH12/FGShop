<?php  if(!defined('PATH_SYSTEM')) die('Bad request!');

class Base_Controller extends FT_Controller {

  public function __construct() {
    parent::__construct();
  }

  public function have_token() {
    $token = isset($_REQUEST['token']) ? $_REQUEST['token'] : null;
    if ($token != null) {
      $user = $this->model->load('Users');
      $result = $this->model->Users->check_token_exists($token);
      if ($result == 0) {
        $this->unauthorized();
        return false;
      }
      else return true;
    } else {
        $this->unauthorized();
        return false;
    }
  }
  public function unauthorized() {
        $json = [];
        echo "{";
        echo "\"Users\":";
        //Set response code
         http_response_code(401);
                array_push($json, [
                    'message' => 'Unauthorized'
                ]);
        echo json_encode($json, JSON_UNESCAPED_UNICODE);
        echo "}";
  }
}
