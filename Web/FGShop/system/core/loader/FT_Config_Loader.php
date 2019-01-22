<?php
  //@filesource system/core/loader/FT_Config_Loader.php

  class FT_Config_Loader {
    //List config
    protected $config = [];

    /**
     * Load config
     *
     * @param string
     * @desc function load config, param name config
     */

    public function load($config) {
      if (file_exists(PATH_APPLICATION . '/config/' . $config . '.php')) {
        $config = include_once PATH_APPLICATION . '/config/' . $config . '.php';
        if (!empty($config)) {
          foreach ($config as $key => $item) {
            $this->config[$key] = $item;
          }
        }
        return true;
      }
      return false;
    }

    /**
     * Get item config
     *
     * @param string
     * @param string
     * @desc function get config item, param is name item and param default
     */
    public function item($key, $default_val = '') {
      return isset($this->config[$key]) ? $this->config[$key] : $default_val;
    }

    /**
     * Set item config
     *
     * @param string
     * @param string
     * @desc function set config item, param is name and param is value
     */
    public function set_item($key, $val) {
      $this->config[$key] = $val;
    }
  }
 ?>
