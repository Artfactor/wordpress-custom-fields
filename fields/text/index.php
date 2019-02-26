<?php

namespace Aslanator;


class Text extends Fields {

  public function show_field($post, $event){
    $text = get_field($this->metaBoxName, $post);
    ?>
      <input type="text" value="<?=$text?>" class="regular-text process_custom_images" name="<?=$this->metaBoxName?>">
    <?
  }

}