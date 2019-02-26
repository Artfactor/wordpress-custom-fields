<?php

namespace Aslanator;


class TextWithText extends Fields {

  public function show_field($post, $event){
    $arValue = get_field($this->metaBoxName, $post);
    $text = $arValue['TEXT_1'];
    $buttonText = $arValue['TEXT_2'];
    ?>
    <table>
      <tr>
        <td>
          Первый текст: 
        </td>
        <td>
          <input type="text" value="<?=$text?>" class="regular-text process_custom_images" name="<?=$this->metaBoxName?>[TEXT_1]">
        </td>
      </tr>
      <tr>
        <td>
          Второй текст: 
        </td>
        <td>
          <input type="text" value="<?=$text?>" class="regular-text process_custom_images" name="<?=$this->metaBoxName?>[TEXT_2]">
        </td>
      </tr>
    </table>
    <?
  }

}