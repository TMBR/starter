<?php
if ( ! defined( 'ABSPATH' ) ) {
  exit;
}
global $post;

/**
 *  ACF - Header (clone field)
 *  ============================
 *  1. Checks if display is set to group or seamless
 *   a. if display = group, values are loaded as array
 *  2. Checks if variables to get_fields are set in load template,
 *  otherwise sets vars to base header fields
 *
 *  Vars:
 *   $display - 'group', 'seamless'
 *   $label - for 'group' display only
 */

if(isset($display))
{

  if($display == 'group' && !empty($label)) {
    $el = $label['header_style'];
    $align = $label['header_align'];
    $text = $label['header_text'];
  }

  elseif($display == 'seamless') {
    // could get very granular here and check if clone is sub field or not.
  }

}

/* Assumes that field is getting loaded directly */
else
{
  $el = isset($el) ? $el : get_field('header_style');
  $align = isset($align) ? $align : get_field('header_align');
  $text = isset($text) ? $text : get_field('header_text');
}

// BEGIN MARKUP
?>

<<?php if(isset($el)) { echo $el; } else { echo 'h3'; } ?> class="<?php if(isset($align)) { echo 'text-'.$align; } ?>">

  <?php if(!empty($text)) { echo $text; } ?>

</<?php if(isset($el)) { echo $el; } else { echo 'h3'; } ?>>