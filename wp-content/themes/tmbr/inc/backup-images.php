<?php
/*
** ALLOWS YOU TO DISPLAY BACKUP IMAGES IF IMG IS NEEDED AND NONE EXISTS
** Backup images can be managed on the "Global Settings" Options Page
**
** Usage Case 1: If you want to output a medium sized image as backup
**  <img src="<?php echo backup_img('medium'); ?>" />
** Usage Case 2: Output img url as background image
**  <div style="background-image: url('<?php echo backup_img('full_screen'); ?>');"></div>
**
** https://www.advancedcustomfields.com/resources/repeater/
*/



function backup_img($size) {
  $rows = get_field('backup_images','option' ); // get all the rows
  $rand_img_row = $rows[ array_rand( $rows ) ]; // get a random row
  $rand_img = $rand_img_row['bu_image']; // get the sub field value
  $bu_img = $rand_img['sizes'][$size];
  return $bu_img;
}