<?php
/* Required vars:
* $tag
* $align
* $text
*
* Used by:
* partials/fields/flex/content.php
* partials/fields/flex/cards.php
*/

?>

<<?php if(isset($tag)) { echo $tag; } else { echo 'h3'; } ?> class="<?php if(isset($align)) { echo 'text-'.$align; } ?>"> <!-- h1 / h2 / h3 / h4 / h5 -->

  <?php if(!empty($text)) {echo $text;} ?>

</<?php if(isset($tag)) { echo $tag; } else { echo 'h3'; } ?>>