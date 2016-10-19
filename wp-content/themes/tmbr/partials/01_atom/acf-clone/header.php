<?php
if ( ! defined( 'ABSPATH' ) ) {
  exit;
}
global $post;

/**
 *  ACF - BUTTON (clone field)
 *
 *  Checks if variables to get_fields are set in load template,
 *  otherwise sets vars to base button fields
 *
 *  Required vars:
 *   $el
 *   $align
 *   $text
 */


$el = isset($el) ? $el : get_field('header_style');
$align = isset($align) ? $align : get_field('header_align');
$text = isset($text) ? $text : get_field('header_text');
?>

<<?php if(isset($el)) { echo $el; } else { echo 'h3'; } ?> class="<?php if(isset($align)) { echo 'text-'.$align; } ?>">

  <?php if(!empty($text)) { echo $text; } ?>

</<?php if(isset($el)) { echo $el; } else { echo 'h3'; } ?>>