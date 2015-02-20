<?php
/**
 * @var array $filters All registered filters
 * @var array $current_filters Slugs of all active filters
 */
?>
<div class="tribe-admin-box-left">
<h4><?php _e( 'Available Filters', 'tribe-events-filter-view' ); ?></h4>
<ul id="all_filters">
	<?php
	foreach ( $filters as $slug => $filter ) { ?>
		<li id="tribe_events_filter_<?php echo $slug; ?>"><label><input type="checkbox" id="<?php echo $slug; ?>" name="tribe_active_filters[]" value="<?php echo $slug; ?>" <?php checked( in_array($slug, $current_filters) ); ?> /> <?php echo $filter['name']; ?></label></li>
	<?php }	?>
</ul>
</div>