<?php

$videos = get_field( 'video_gallery' );
if ( empty( $videos ) ) {
	return;
}
?>


	<div class="row">

		<?php 
		while( has_sub_field( 'video_gallery' ) ) { 

		$vidURL = get_sub_field('vg_url');
		if(strpos($vidURL, 'youtube') !== false){
			$parsedVidURL = parse_url($vidURL);
			$vidPART = $parsedVidURL['query'];
			$vidPART = str_replace('v=','',$vidPART);
			$vidImgURL = 'http://img.youtube.com/vi/' . $vidPART . '/0.jpg';
			$smUrl = $vidImgURL;
		} 
		elseif(strpos($vidURL, 'vimeo') !== false) {
			$parsedVidURL = parse_url($vidURL);
			$vidPART = $parsedVidURL['path'];
			$vidPART = str_replace('/','',$vidPART);
			$hash = simplexml_load_file("http://vimeo.com/api/v2/video/$vidPART.xml");
			$smUrl =  $hash->video[0]->thumbnail_large; 
		}

		$title_markup = ''; // default
		$vid_title = get_sub_field('vg_title');
		if ( !empty( $vid_title ) ) {
			$title_markup = sprintf(
				'<h4>%s%s',
				$vid_title,
				'</h4>'
			);
		}
		?>
		<div class="col-sm-4 col-xs-6 col-xxs-12">
			<a href="<?php echo $vidURL; ?>" class="popup-video">
				<div class="vid-img-wrap"><img src="<?php echo $smUrl; ?>" class="img-responsive" alt=""/></div>
				<?php if($title_markup){ echo $title_markup; } ?>
			</a>
		</div><!-- /col -->
		
		<?php
		}
		?>

	</div><!-- /row -->



