<?php

class FT_View_Loader {

  /**
  * @desc var save view loaded
  */
  private $__content = [];

  public function load($view, $data = []) {

    //Convert view to var
    ob_start();
    //Convert from data to var
    extract($data);;

    require_once PATH_APPLICATION . '/view/' . $view . '.php';
    $content = ob_get_contents();
    ob_end_clean();

    // Tag content to list view is loaded
    $this->__content[] = $content;
  }

  public function show() {
    foreach ($this->__content as $html) {
      echo $html;
    }
  }
}
