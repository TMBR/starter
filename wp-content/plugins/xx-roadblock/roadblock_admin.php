<?php 
    if($_POST['tmbr_rdblk_hidden'] == 'Y') {
        //Form data sent
        $hdrtext = $_POST['tmbr_rdblk_hdrtext'];
        update_option('tmbr_rdblk_hdrtext', $hdrtext);
         
        $subhdr = $_POST['tmbr_rdblk_subhdr'];
        update_option('tmbr_rdblk_subhdr', $subhdr);
         
        $gfid = $_POST['tmbr_rdblk_gfid'];
        update_option('tmbr_rdblk_gfid', $gfid);
 
        $hdrimg = $_POST['tmbr_rdblk_hdrimg'];
        update_option('tmbr_rdblk_hdrimg', $hdrimg);
 
        ?>
        <div class="updated"><p><strong><?php _e('Options saved.' ); ?></strong></p></div>
        <?php
    } else {
        //Normal page display
        $hdrtext = get_option('tmbr_rdblk_hdrtext');
        $subhdr = get_option('tmbr_rdblk_subhdr');
        $gfid = get_option('tmbr_rdblk_gfid');
        $hdrimg = get_option('tmbr_rdblk_hdrimg');
    }
?>


<div class="wrap">
    <?php    echo "<h2>" . __( 'TMBR Roadblock Display Options', 'tmbr_rdblk_trdom' ) . "</h2>"; ?>
     
    <form name="tmbr_rdblk_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
        <input type="hidden" name="tmbr_rdblk_hidden" value="Y">
        <p><?php _e("Header: " ); ?><input type="text" name="tmbr_rdblk_hdrtext" value="<?php echo $hdrtext; ?>" size="20"></p>
        <p><?php _e("Sub-Heading: " ); ?><input type="text" name="tmbr_rdblk_subhdr" value="<?php echo $subhdr; ?>" size="20"></p>
        
        <p><?php _e("Gravity Form ID: " ); ?><input type="text" name="tmbr_rdblk_gfid" value="<?php echo $gfid; ?>" size="20"></p>
        <p><?php _e("Header Image: " ); ?><input type="file" name="tmbr_rdblk_hdrimg" value="<?php echo $hdrimg; ?>"><?php _e(" ex: http://www.yourstore.com/images/" ); ?></p>
         
     
        <p class="submit">
        <input type="submit" name="Submit" class="button button-primary" value="<?php _e('Update Options', 'tmbr_rdblk_trdom' ) ?>" />
        </p>
    </form>
</div>