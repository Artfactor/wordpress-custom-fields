<?php

namespace Aslanator;


class TextWithButton extends Fields {

  public function show_field($post, $event){
    $arValue = get_field($this->metaBoxName, $post);
    $text = $arValue['TEXT'];
    $buttonText = $arValue['BUTTON_TEXT'];
    $event = $arValue['EVENT'];
    ?>
    <table>
      <tr>
        <td>
          Текст: 
        </td>
        <td>
          <input type="text" value="<?=$text?>" class="regular-text process_custom_images" name="<?=$this->metaBoxName?>[TEXT]">
        </td>
      </tr>
      <tr>
        <td>
          Текст в кнопке: 
        </td>
        <td>
          <input type="text" value="<?=$text?>" class="regular-text process_custom_images" name="<?=$this->metaBoxName?>[BUTTON_TEXT]">
        </td>
      </tr>
      <tr>
        <td>
          Событие onclick на кнопке: 
        </td>
        <td>
          <input type="text" value="<?=$text?>" class="regular-text process_custom_images" name="<?=$this->metaBoxName?>[EVENT]">
        </td>
      </tr>
    </table>
    <?
  }

}