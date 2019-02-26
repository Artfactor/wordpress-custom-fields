<?php

namespace Aslanator;

class ImageWithEditor extends Fields {

  public function registerActions(){
    add_action('wp_ajax_add_image_' . $this->metaBoxName, Array($this, 'show_image_with_text_input_ajax'));
  }

  public function show_field($post, $event){
    $name = $this->metaBoxName;
    $images = get_field($name, $post);
    ?>
    <script>
    jQuery(document).ready(function() {
      var $ = jQuery;
      var $parent = $('#<?=$name?>');
      if ($parent.find('.set_custom_images').length > 0) {
          if ( typeof wp !== 'undefined' && wp.media && wp.media.editor) {
              $(document).on('click', '.set_custom_images', function(e) {
                  e.preventDefault();
                  var button = $(this);
                  var id = button.prev();
                  wp.media.editor.send.attachment = function(props, attachment) {
                      id.val(attachment.id);
                  };
                  wp.media.editor.open(button);
                  return false;
              });
          }
      }
      $parent.find('.add-new-small-image-with-text').on('click', function(event){
        event.preventDefault();
        var $self = $(this);
        var id = $(this).data('new');
        var data = {
            action: "add_image_<?=$name?>",
            id: id
        };
        jQuery.post(ajaxurl, data, function (response) {
          console.log(response);
          $self.data('new', ++id);
          $parent.find('.new-new-small-image-with-text').append(response);
        });
      })
    });
    </script>
    <?if(is_array($images) && count($images) > 0):?>
      <?foreach($images as $key => $image):?>
        <?$this->show_image_with_text_input($name, $key, $image['TEXT'], $image['ID'])?>
      <?endforeach;?>
    <?else: $key = 0;?>
    <?endif;?>
    <?$this->show_image_with_text_input($name, ++$key);?>
    <div class="new-new-small-image-with-text"></div>
    <button class="add-new-small-image-with-text" data-new="<?=++$key?>">Добавить новую картинку</button>
    <?
  }

  public function save_post( $post_id ){
    if (
      empty( $_POST[$this->metaBoxName] )
      || wp_is_post_autosave( $post_id )
      || wp_is_post_revision( $post_id )
    )
   return false;
  $_POST[$this->metaBoxName] = array_filter($_POST[$this->metaBoxName], function($element){ // Удаляю все элементы массива без ID картинки
    if($element['ID']) return true;
  });

  update_post_meta( $post_id, $this->metaBoxName,  $_POST[$this->metaBoxName] ); 
  
  return $post_id;
  }

  private function show_image_with_text_input($name, $id, $text = null, $imageID = null){
    ?>
    <p>
      Текст: <input type="text" value="<?=$text?>" class="regular-text process_custom_images" name="<?=$name?>[<?=$id?>][TEXT]">
      ID изображения: <input type="number" value="<?=$imageID?>" class="regular-text process_custom_images" name="<?=$name?>[<?=$id?>][ID]" max="" min="1" step="1" style="width: 60px">
      <?if($imageID):?>
        <?=wp_get_attachment_image($imageID)?>
      <?endif;?>
      <button class="set_custom_images button">Set Image ID</button>
    </p>
    <?
  }
  
  public function show_image_with_text_input_ajax(){
    $this->show_image_with_text_input($this->metaBoxName, $_POST['id']);
    wp_die();
  }

}