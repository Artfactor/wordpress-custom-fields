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

abstract class CustomFieldCreator{

  abstract public function factoryMethod($metaBoxName, $title, $postType);

  public function addCustomField($metaBoxName, $title, $postType){
    if(!is_string($postType) || !is_string($metaBoxName) || !is_string($title)){
      throw new Exception("All argument must be a string");
    }
    $field = $this->factoryMethod($metaBoxName, $title, $postType);
  }
}

class ImageWithEditorFieldCreator extends CustomFieldCreator {

  public function factoryMethod($metaBoxName, $title, $postType){
    return new ImageWithEditor($metaBoxName, $title, $postType);
  }

}

class TextFieldCreator extends CustomFieldCreator {

  public function factoryMethod($metaBoxName, $title, $postType){
    return new Text($metaBoxName, $title, $postType);
  }

}

class TextWithButtonCreator extends CustomFieldCreator {

  public function factoryMethod($metaBoxName, $title, $postType){
    return new TextWithButton($metaBoxName, $title, $postType);
  }

}

class TextWithTextCreator extends CustomFieldCreator {

  public function factoryMethod($metaBoxName, $title, $postType){
    return new TextWithText($metaBoxName, $title, $postType);
  }

}

class ButtonCreator extends CustomFieldCreator {

  public function factoryMethod($metaBoxName, $title, $postType){
    return new Button($metaBoxName, $title, $postType);
  }

}