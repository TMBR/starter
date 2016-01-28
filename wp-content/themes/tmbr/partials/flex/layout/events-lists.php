<?php
	/*
	 * Dependent on Events Calander being installed
	 * https://wordpress.org/plugins/the-events-calendar/
	 * Defaults: show 4 Events from any category
	 * Flex Content Part - can configure number of posts and a category filter
	*/

// Check for Events Calander Plugin.
if( class_exists( 'Tribe__Events__Main' ) ) { ?>

<div class="flex-events">

	<?php

	// Set up Section title
	global $sectiontitle;
	if( get_sub_field('section_title') ){
		$sectiontitle = get_sub_field('section_title');
	}
	if ($sectiontitle) { ?>
		<h2 class="subtitle"><?php echo esc_html($sectiontitle) ?></h2>
	<?php }

	if( get_sub_field('event_taxonomy') ){
		$eventtaxonomy = get_sub_field('event_taxonomy');
	}

	if( get_sub_field('how_many_events') ){
		$numberevents = get_sub_field('how_many_events');
	}

	if (!isset($numberevents)) { $numberevents = 4;}

	global $post;

	if (isset($eventtaxonomy)) {
		$events = tribe_get_events(array(
			'eventDisplay' => 'list',
			'posts_per_page' => $numberevents,
			'tax_query' => array(
				array(
					'taxonomy' => 'tribe_events_cat',
					'terms' => $eventtaxonomy,
					'field' => 'term_id'
				)
			)
		));
	} else {
		$events = tribe_get_events(array(
			'eventDisplay' => 'list',
			'posts_per_page' => $numberevents
		));
	}

	foreach ( $events as $post ) :

		setup_postdata( $post );
		$date = $post->EventStartDate;
		$formatted_date = date("F d, Y", strtotime($date));
		$thumb = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'lg_thumb');
		$url = $thumb['0'];

		if(empty($thumb)){
		    $url = DEFAULTIMAGE ;
		}
		?>

		<div class="event-card">
			<a class="event-link" href="<?php the_permalink(); ?>">
				<div class="img-wrap">
			    	<img class="event-image" src="<?php echo $url; ?>" alt=""/>
				</div>
				<div class="copy-wrap">
					<h4 class="event-title"><?php the_title();?></h4>
					<p class="event-date"><?php echo $formatted_date; ?></p>
					<p class="event-excerpt"><?php echo TMBR_excerpt(34); ?></p>
				</div>
			</a>
		</div><!-- / event card -->

	<?php endforeach;

	wp_reset_postdata(); ?>
	<div class="clear"></div>
</div>

<?php } else {
	echo ' Events Calander is required for this content section';
}