<?php  if(!defined('PATH_SYSTEM')) die('Bad request!');

/**
* @filesource system/core/FT_Controller.php
*/

class FT_Controller {
  //Object view
  protected $view     = null;
  //Object model
  protected $model    = null;
  //Object library
  protected $library  = null;
  //Object helper
  protected $helper   = null;
  //Object database
  protected $database   = null;

  public function __construct($is_controller = true) {
     // Loader cho config
      require_once PATH_SYSTEM . '/core/loader/FT_Config_Loader.php';
      $this->config   = new FT_Config_Loader();
      $this->config->load('config');

      // Loader Library
      require_once PATH_SYSTEM . '/core/loader/FT_Library_Loader.php';
      $this->library = new FT_Library_Loader();

      // Load Helper
      require_once PATH_SYSTEM . '/core/loader/FT_Helper_Loader.php';
      $this->helper = new FT_Helper_Loader();
      $this->helper->load('String');
      $this->helper->load('Utils');

      // Load Middleware
      require_once PATH_SYSTEM . '/core/loader/FT_Middleware_Loader.php';
      $this->middleware = new FT_Middleware_Loader();

      // Load View
      require_once PATH_SYSTEM . '/core/loader/FT_View_Loader.php';
      $this->view = new FT_View_Loader();

      // Connect database
      require_once PATH_SYSTEM . '/database/FT_Database.php';
      $this->database = FT_Database::instance();

      // Load model
      require_once PATH_SYSTEM . '/core/loader/FT_Model_Loader.php';
      $this->model = new FT_Model_Loader();
  }

}

?>
