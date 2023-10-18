<?php

class Controller
{

  // View Object
  protected $_view;
  // Model Object
  protected $_model;

  protected $_arrParam;

  public function __construct()
  {
    $this->_arrParam = array_merge($_GET, $_POST);
    $this->_view = new View($this->_arrParam['module']);
  }

  public function loadModel($moduleName, $modelName)
  {
    $modelName = ucfirst($modelName) . 'Model';
    $path = APPLICATION_PATH . $moduleName . DS . 'models' . DS . $modelName . '.php';

    if (file_exists($path)) {
      require_once $path;
      $this->_model = new $modelName();
    }
  }
}