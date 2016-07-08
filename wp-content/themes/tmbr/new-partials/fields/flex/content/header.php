<?php

$tag = get_sub_field('ac_h_type');
$align = get_sub_field('ac_h_align');
$text = get_sub_field('ac_h_header_text');

?>

<<?php if(isset($tag)) { echo $tag; } else { echo 'h3'; } ?> class="<?php if(isset($align)) { echo 'text-'.$align; } ?>"> <!-- h1 / h2 / h3 / h4 / h5 -->

  <?php if(!empty($text)) {echo $text;} ?>

</<?php if(isset($tag)) { echo $tag; } else { echo 'h3'; } ?>>