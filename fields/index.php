<?php

namespace Aslanator;


abstract class Fields{

  protected $metaBoxName = "";
  protected $title = "";
  protected $postType = "";

  public function __construct($metaBoxName, $title, $postType){
    $this->metaBoxName = $metaBoxName;
    $this->title = $title;
    $this->postType = $postType;
    add_action('add_meta_boxes', Array($this, 'add_meta_box'), 1);
    add_action( 'save_post', Array($this, 'save_post'), 0 );
    $this->registerActions();
  }

  public function add_meta_box(){
    add_meta_box( $this->metaBoxName, $this->title, Array($this, 'show_field'), $this->postType, 'normal', 'high'  );
  }

  abstract function show_field($post, $event);

  public function save_post($post_id){
    if(!$this->check_save_post($post_id))
      return false;
  // Все ОК! Теперь, нужно сохранить/удалить данные
  update_post_meta( $post_id, $this->metaBoxName,  $_POST[$this->metaBoxName] ); // add_post_meta() работает автоматически
    return $post_id;
  }

  protected function check_save_post($post_id){
    if (
      empty( $_POST[$this->metaBoxName] )
      || wp_is_post_autosave( $post_id )
      || wp_is_post_revision( $post_id )
    )
    return false;
   return true;
  }

  public function registerActions(){
  }
}