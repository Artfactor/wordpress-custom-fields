<?php
namespace Aslanator;

if($_GET['debug'] === 'Y'){
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
}


require 'fields/index.php';
require 'fields/image-with-editor/index.php';
require 'fields/text/index.php';
require 'fields/text-with-button/index.php';
require 'fields/text-with-text/index.php';
require 'fields/button/index.php';
require 'fields/image/index.php';
