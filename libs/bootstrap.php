<?php

class Bootstrap
{
  private $_params;
  private $_controllerObject;
  public function __construct()
  {
    $this->setParam();

    $controllerName = ucfirst($this->_params['controller']) . 'Controller';
    $filePath = APPLICATION_PATH . $this->_params['module'] . DS . 'controllers' . DS . $controllerName . '.php';
    if (file_exists($filePath)) {
      $this->loadExistingController($filePath, $controllerName);

      $this->callMethod();
    } else {
      $this->loadDefaultController();
    }
  }

  public function setParam()
  {
    $this->_params = array_merge($_GET, $_POST);
  }

  private function loadDefaultController()
  {
    $controllerName = ucfirst(DEFAULT_CONTROLLER) . 'Controller';
    $actionName = DEFAULT_ACTION . 'Action';
    $path = APPLICATION_PATH . DEFAULT_MODULE . DS . 'controllers' . DS . $controllerName . '.php';
    if (file_exists($path)) {
      require_once $path;
      $this->_controllerObject = new $controllerName();
      $this->_controllerObject->setView(DEFAULT_MODULE);
      $this->_controllerObject->{$actionName}();
    }
  }

  private function loadExistingController($filePath, $controllerName)
  {
    require_once $filePath;
    $this->_controllerObject = new $controllerName();
    $this->_controllerObject->loadModel($this->_params['module'], $this->_params['controller']);
    $this->_controllerObject->setView($this->_params['module']);
    $this->_controllerObject->setParam($this->_params);
  }

  private function callMethod()
  {
    $actionName = $this->_params['action'] . "Action";
    if (method_exists($this->_controllerObject, $actionName)) {
      $this->_controllerObject->$actionName();
    } else {
      $this->_error();
    }
  }

  public function _error()
  {
    require_once APPLICATION_PATH . 'default' . DS . 'controllers' . DS  . 'ErrorController.php';
    $this->_controllerObject = new ErrorController();
    $this->_controllerObject->setView('default');
    $this->_controllerObject->indexAction();
  }
}