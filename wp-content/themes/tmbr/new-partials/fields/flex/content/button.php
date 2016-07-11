<?php
$type = get_sub_field('cbac_btn_type');
$text = get_sub_field('cbac_btn_text');

// SET BUTTON LINK
if($type == 'internal') {$url = get_sub_field('cbac_site_page_link');  }
elseif($type == 'section') { $page = get_sub_field('cbac_site_page_link'); $id = get_sub_field('cbac_section_name'); $url = $page.'#'.$id; $target = 'target="_blank"';}
elseif($type == 'external') {$url = get_sub_field('cbac_custom_link'); $target = 'target="_blank"';}
elseif($type == 'file') {$url = get_sub_field('cbac_upload_file'); $target = 'target="_blank"';}
?>

    <div class="text-center">
      <a href="<?php echo $url; ?>" <?php if(isset($target)) {echo $target;} ?> class="btn"><?php echo $text; ?></a>
    </div>
