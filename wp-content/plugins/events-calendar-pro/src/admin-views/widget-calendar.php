<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'tribe-events-calendar-pro' ); ?>
		<input type="text" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" value="<?php echo esc_attr( strip_tags( $instance['title'] ) ); ?>" />
	</label>
</p>

<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'count' ) ); ?>"><?php esc_html_e( 'Number of events to show:', 'tribe-events-calendar-pro' ); ?>
		<input type="text" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'count' ) ); ?>"
		       id="<?php echo esc_attr( $this->get_field_id( 'count' ) ); ?>"
		       value="<?php echo esc_attr( strip_tags( $instance['count'] ) ); ?>" />
	</label>
</p>

<?php
$class = '';
if ( empty( $instance['filters'] ) ) {
	$class = 'display:none;';
}
?>

<div class="calendar-widget-filters-container" style="<?php echo esc_attr( $class ); ?>">

	<h3 class="calendar-widget-filters-title"><?php esc_html_e( 'Filters', 'tribe-events-calendar-pro' ); ?>:</h3>

	<input type="hidden" name="<?php echo esc_attr( $this->get_field_name( 'filters' ) ); ?>"
	       id="<?php echo esc_attr( $this->get_field_id( 'filters' ) ); ?>" class="calendar-widget-added-filters"
	       value='<?php echo esc_attr( maybe_serialize( $instance['filters'] ) ); ?>' />

	<ul class="calendar-widget-filter-list">

		<?php
		$disabled = array();
		if ( ! empty( $instance['filters'] ) ) {

			foreach ( json_decode( $instance['filters'] ) as $tax => $terms ) {
				$tax_obj = get_taxonomy( $tax );

				foreach ( $terms as $term ) {
					if ( empty( $term ) ) {
						continue;
					}
					$term_obj = get_term( $term, $tax );

					// Add to the disabled ones
					$disabled[] = $term_obj->term_id;
					echo sprintf(
						"<li><p>%s: %s&nbsp;&nbsp;<span><a href='#' class='calendar-widget-remove-filter' data-tax='%s' data-term='%s'>(" . esc_html__( 'remove', 'tribe-events-calendar-pro' ) . ')</a></span></p></li>',
						esc_html( $tax_obj->labels->name ),
						esc_html( $term_obj->name ),
						esc_attr( $tax ),
						esc_attr( $term_obj->term_id )
					);
				}
			}
		}
		?>

	</ul>

	<p class="calendar-widget-filters-operand">
		<label for="<?php echo esc_attr( $this->get_field_name( 'operand' ) ); ?>">
			<input <?php checked( $instance['operand'], 'AND' ); ?> type="radio" name="<?php echo esc_attr( $this->get_field_name( 'operand' ) ); ?>" value="AND">
			<?php esc_html_e( 'Match all', 'tribe-events-calendar-pro' ); ?></label><br />
		<label for="<?php echo esc_attr( $this->get_field_name( 'operand' ) ); ?>">
			<input <?php checked( $instance['operand'], 'OR' ); ?> type="radio" name="<?php echo esc_attr( $this->get_field_name( 'operand' ) ); ?>" value="OR">
			<?php esc_html_e( 'Match any', 'tribe-events-calendar-pro' ); ?></label>
	</p>
</div>
<p class="tribe-widget-term-filter">
	<label><?php esc_html_e( 'Add a filter', 'tribe-events-calendar-pro' ); ?>:	</label>
	<input
		type="hidden"
		placeholder="<?php esc_attr_e( 'Select a Taxonomy Term', 'tribe-events-calendar-pro' ); ?>"
		data-source="terms"
		data-hide-search
		data-prevent-clear
		class="widefat calendar-widget-add-filter tribe-widget-select2"
		id="<?php echo esc_attr( $this->get_field_id( 'selector' ) ); ?>"
		data-disabled="<?php echo esc_attr( json_encode( $disabled ) ); ?>"
	/>
</p>
<p>
	<?php $jsonld_enable = ( isset( $instance['jsonld_enable'] ) && $instance['jsonld_enable'] ) || false === $this->updated; ?>
	<input class="checkbox" type="checkbox" value="1" <?php checked( $jsonld_enable, '1' ); ?>
	       id="<?php echo esc_attr( $this->get_field_id( 'jsonld_enable' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'jsonld_enable' ) ); ?>"/>
	<label for="<?php echo esc_attr( $this->get_field_id( 'jsonld_enable' ) ); ?>"><?php esc_html_e( 'Generate JSON-LD data', 'the-events-calendar-pro' ); ?></label>
</p>
