<?php
/* Required vars:
* $type
* $text
* $site_pg
* $id
* $custom
* $u_file
*
* Used by:
* partials/fields/flex/content.php
* partials/components/cards/link-card.php
*/

?>



<?php
// SET BUTTON LINK
if($type == 'internal')
{
  $url = $site_pg;
}

elseif($type == 'section')
{
  $page = $site_pg;
  $id = $id;
  $url = $page.'#'.$id;
  $target = 'target="_blank"';
}

elseif($type == 'external')
{
  $url = $custom;
  $target = 'target="_blank"';
}

elseif($type == 'file')
{
  $url = $u_file;
  $target = 'target="_blank"';
}
?>


      <a href="<?php echo $url; ?>" <?php if(isset($target)) {echo $target;} ?> class="btn"><?php echo $text; ?></a>

