<?php

class ErrorController extends Controller
{

  public function __construct()
  {
    parent::__construct();
  }

  public function indexAction()
  {
    echo "<h3>This is an error</h3>";
  }
}