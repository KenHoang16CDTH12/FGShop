<?php  if(!defined('PATH_SYSTEM')) die('Bad request!');

/**
* @filesource system/core/FT_Controller.php
*/

class FT_Model {
  //Object model
  protected $model    = null;

  public function __construct($is_controller = true) {
      // Load model
      require_once PATH_SYSTEM . '/core/loader/FT_Model_Loader.php';
      $this->model = new FT_Model_Loader();
  }

}

?>
