<?php

class Controller
{

  public function __construct()
  {
    // $this->view = new View();
  }

  public function loadModel($moduleName, $modelName)
  {
    $modelName = ucfirst($modelName) . 'Model';
    $path = APPLICATION_PATH . $moduleName . DS . 'models' . DS . $modelName . '.php';

    if (file_exists($path)) {
      require_once $path;
      $this->db = new $modelName();
    }
  }
}