<?php

class Bootstrap
{
  public function __construct()
  {
    $params = array_merge($_GET, $_POST);
    $module = (isset($params['module'])) ? $params['module'] : DEFAULT_MODULE;
    $controller = (isset($params['controller'])) ? $params['controller'] : DEFAULT_CONTROLLER;
    $action = (isset($params['action'])) ? $params['action'] : DEFAULT_ACTION;

    $controllerName = ucfirst($controller) . 'Controller';
    $filePath = APPLICATION_PATH . $module . DS . 'controllers' . DS . $controllerName . '.php';
    if (file_exists($filePath)) {
      require_once $filePath;
      $controllerObject = new $controllerName();
      $controllerObject->loadModel($module, $controller);

      $actionName = $action . "Action";
      if (method_exists($controllerObject, $actionName)) {
        $controllerObject->$actionName();
      } else {
        $this->_error();
      }
    } else {
      $this->_error();
    }
  }

  public function _error()
  {
    require_once APPLICATION_PATH . 'default' . DS . 'controllers' . DS  . 'ErrorController.php';
    $errorController = new ErrorController();
    $errorController->indexAction();
  }
}
