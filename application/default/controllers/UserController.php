<?php

class UserController extends Controller
{

  public function __construct()
  {
    parent::__construct();
  }

  public function indexAction()
  {
    $this->loadModel('admin', 'index');
    $this->_view->render('user/index');
  }
}
