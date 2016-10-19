
<!-- VIDEO W/ BACKGROUND IMAGE -->

<?php
$url = $url;
$parsedVidURL = parse_url($url);
$vidPART = $parsedVidURL['path'];
$vidPART = str_replace('/','',$vidPART);
$hash = simplexml_load_file("https://vimeo.com/api/v2/video/$vidPART.xml");
$smUrl =  $hash->video[0]->thumbnail_large;
//$image = $smUrl;

if(!empty($img)) {
  $vid_img = $img['sizes'][$size];
}
else {
  $vid_img = $smUrl;
}
?>

<div class="img-bg" style="background-image: url('<?php echo $vid_img; ?>');"></div>
<a href="<?php echo $url; ?>" class="popup-video js-popup-video"><span class="trigger"></span></a>


<!-- VIDEO W/ IMG OBJECT -->

<?php
$url = $url;
$parsedVidURL = parse_url($url);
$vidPART = $parsedVidURL['path'];
$vidPART = str_replace('/','',$vidPART);
$hash = simplexml_load_file("https://vimeo.com/api/v2/video/$vidPART.xml");
$smUrl =  $hash->video[0]->thumbnail_large;
//$image = $smUrl;

if(!empty($img)) {
  $vid_img = $img['sizes'][$size];
}
else {
  $vid_img = $smUrl;
}
?>
<div class="wrapper -vid-obj">
<img src="<?php echo $vid_img; ?>" alt="" class="img-responsive">
<a href="<?php echo $url; ?>" class="popup-video js-popup-video"><span class="trigger"></span></a>
</div>