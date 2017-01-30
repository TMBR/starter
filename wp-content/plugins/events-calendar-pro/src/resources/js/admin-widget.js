( function( $, _ ) {
	'use strict';

	var tribeWidget = {},
		$body = $( document.body );

	/**
	 * Better Search ID for Select2, compatible with WordPress ID from WP_Query
	 *
	 * @param  {object|string} e Searched object or the actual ID
	 * @return {string}   ID of the object
	 */
	tribeWidget.search_id = function ( e ) {
		var id = undefined;

		if ( 'undefined' !== typeof e.id ){
			id = e.id;
		} else if ( 'undefined' !== typeof e.ID ){
			id = e.ID;
		} else if ( 'undefined' !== typeof e.value ){
			id = e.value;
		}
		return undefined === e ? undefined : id;
	};

	tribeWidget.calendar_toggle = function( wrapper ) {

		wrapper.find( '.calendar-widget-filters-title' ).hide();
		wrapper.find( '.calendar-widget-filters-operand' ).hide();
		var hidden = wrapper.find( '.calendar-widget-added-filters' );

		if ( hidden.length ) {

			var calendar_filters = hidden.val() ? jQuery.parseJSON( hidden.val() ) : new Object();

			var count = 0;
			for ( var tax in calendar_filters ) {
				count += calendar_filters[ tax ].length;
			}

			if ( count > 0 ) {
				wrapper.find( '.calendar-widget-filters-title' ).show();
				if ( count > 1 ) {
					wrapper.find( '.calendar-widget-filters-operand' ).show();
				}
			}
		}

	};

	tribeWidget.select2 = function() {
		var $select = $( this ),
			args = {};

		if ( $select.hasClass( 'select2-container' ) ) {
			$select.select2( 'destroy' );

		}

		if ( $( 'body' ).hasClass( 'wp-customizer' ) ) {
			args.dropdownCssClass = 'tribe-customizer-select2';
		}

		if ( ! $select.is( 'select' ) ) {
			// Better Method for finding the ID
			args.id = tribeWidget.search_id;
		}

		// By default we allow The field to be cleared
		args.allowClear = true;
		if ( $select.is( '[data-prevent-clear]' ) ) {
			args.allowClear = false;
		}

		// If we are dealing with a Input Hidden we need to set the Data for it to work
		if ( $select.is( '[data-options]' ) ) {
			args.data = $select.data( 'options' );
		}

		// Prevents the Search box to show
		if ( $select.is( '[data-hide-search]' ) ) {
			args.minimumResultsForSearch = Infinity;
		}

		if ( $select.is( '[multiple]' ) ) {
			args.multiple = true;

			if ( ! _.isArray( $select.data( 'separator' ) ) ) {
				args.tokenSeparators = [ $select.data( 'separator' ) ];
			} else {
				args.tokenSeparators = $select.data( 'separator' );
			}
			args.separator = $select.data( 'separator' );

			// Define the regular Exp based on
			args.regexSeparatorElements = [ '^(' ];
			args.regexSplitElements = [ '(?:' ];
			$.each( args.tokenSeparators, function ( i, token ) {
				args.regexSeparatorElements.push( '[^' + token + ']+' );
				args.regexSplitElements.push( '[' + token + ']' );
			} );
			args.regexSeparatorElements.push( ')$' );
			args.regexSplitElements.push( ')' );

			args.regexSeparatorString = args.regexSeparatorElements.join( '' );
			args.regexSplitString = args.regexSplitElements.join( '' );

			args.regexToken = new RegExp( args.regexSeparatorString, 'ig' );
			args.regexSplit = new RegExp( args.regexSplitString, 'ig' );
		}

		/**
		 * Better way of matching results
		 *
		 * @param  {string} term Which term we are searching for
		 * @param  {string} text Search here
		 * @return {boolean}
		 */
		args.matcher = function( term, text ) {
			var result = text.toUpperCase().indexOf( term.toUpperCase() ) == 0;

			if ( ! result && 'undefined' !== typeof args.tags ){
				var possible = _.where( args.tags, { text: text } );
				if ( args.tags.length > 0  && _.isObject( possible ) ){
					var test_value = obj.search_id( possible[0] );
					result = test_value.toUpperCase().indexOf( term.toUpperCase() ) == 0;
				}
			}

			return result;
		};

		// Select also allows Tags, so we go with that too
		if ( $select.is( '[data-tags]' ) ){
			args.tags = $select.data( 'options' );

			args.initSelection = function ( element, callback ) {
				var data = [];
				$( element.val().split( args.regexSplit ) ).each( function () {
					var obj = { id: this, text: this };
					if ( args.tags.length > 0  && _.isObject( args.tags[0] ) ) {
						var _obj = _.where( args.tags, { value: this } );
						if ( _obj.length > 0 ){
							obj = _obj[0];
							obj = {
								id: obj.value,
								text: obj.text,
							};
						}
					}

					data.push( obj );

				} );
				callback( data );
			};

			args.createSearchChoice = function(term, data) {
				if ( term.match( args.regexToken ) ) {
					return { id: term, text: term };
				}
			};

			if ( 0 === args.tags.length ){
				args.formatNoMatches = function(){
					return $select.attr( 'placeholder' );
				};
			}
		}

		// When we have a source, we do an AJAX call
		if ( $select.is( '[data-source]' ) ) {
			var source = $select.data( 'source' );

			// For AJAX we reset the data
			args.data = { results: [] };

			// Allows HTML from Select2 AJAX calls
			args.escapeMarkup = function (m) {
				return m;
			};

			args.ajax = { // instead of writing the function to execute the request we use Select2's convenient helper
				dataType: 'json',
				type: 'POST',
				url: window.ajaxurl,
				results: function ( data ) { // parse the results into the format expected by Select2.
					return data.data;
				}
			};

			// By default only send the source
			args.ajax.data = function( search, page ) {
				return {
					action: 'tribe_widget_dropdown_' + source,
					disabled: $select.data( 'disabled' )
				};
			};
		}

		$select.on( 'open', function(){
			$( '.select2-drop' ).css( 'z-index', 10000000 );
		} ).select2( args );
	};

	tribeWidget.setup = function( e, $widget ){
		// If it's not set we try to figure it out from the Event
		if ( 'undefined' === typeof $widget ) {
			var $target = $( e.target ),
				$widget;

			// Prevent weird non avaiable widgets to go any further
			if ( ! $target.parents( '.widget-top' ).length || $target.parents( '#available-widgets' ).length ) {
				return;
			}

			$widget = $target.closest( 'div.widget' );
		}

		// It might be a DOM object, so we try convert to jQuery
		if ( 'object' === typeof $widget ) {
			$widget = $( $widget );
		}

		// If by this point it's not an jQuery Object we bail
		if ( 'jQuery' === typeof $widget ) {
			return;
		}

		// If we are not dealing with one of the Tribe Widgets
		if ( ! $widget.is( '[id*="tribe-"]' )  ) {
			return;
		}

		// We are dealing with a non-widget yet
		if ( $widget.is( '[id*="__i__"]' )  ) {
			return;
		}

		$widget.find( '.tribe-widget-select2' ).each( tribeWidget.select2 ).trigger( 'change' );

		$widget.on( 'change', '.js-tribe-condition', function(){
			var $this = $( this ),
				field = $this.data( 'tribeConditionalField' ),
				$conditionals = $widget.find( '.js-tribe-conditional' ).filter( '[data-tribe-conditional-field="' + field + '"]' ),
				value = $this.val();

			// First hide all conditionals
			$conditionals.hide()

			// Now Apply any stuff that must be "conditional" on hide
			.each( function(){
				var $conditional = $( this );

				if ( $conditional.hasClass( 'tribe-select2' ) ){
					$conditional.prev( '.select2-container' ).hide();
				}
			} )

			// Find the matching values
			.filter( '[data-tribe-conditional-value="' + value + '"]' ).show()

			// Apply showing with "conditions"
			.each( function(){
				var $conditional = $( this );

				if ( $conditional.hasClass( 'tribe-select2' ) ){
					$conditional.hide().prev( '.select2-container' ).show();
				}
			} );
		} );

		// Only happens on Widgets Admin page
		if ( ! $( 'body' ).hasClass( 'wp-customizer' ) ){
			if ( $.isNumeric( e ) || 'widget-updated' === e.type ){
				$widget.find( '.js-tribe-condition' ).trigger( 'change' );
			}
		}
	};

	$( document )
	// Configure the Widgets by default
	.ready( function( event ){
		// Prevents problems on Customizer
		if ( $( 'body' ).hasClass( 'wp-customizer' ) ){
			return;
		}

		// This ensures that we setup corretly the widgets that are already in place
		$( '.widget[id*="tribe-"]' ).each( tribeWidget.setup );
	} )
	.on( {
		// On the Widget Actions try to re-configure
		'widget-added widget-synced widget-updated': tribeWidget.setup,
	} )
	.on( 'change', '.calendar-widget-add-filter', function( e ) {
		var $select = $( this ),
			$widget = $select.parents( '.widget[id*="tribe-"]' ),
			$filters = $widget.find( '.calendar-widget-filters-container' ),
			$list = $widget.find( '.calendar-widget-filter-list' ),
			$field = $widget.find( '.calendar-widget-added-filters' ),
			values = $field.val() ? $.parseJSON( $field.val() ) : {},
			term = e.added,
			disabled = $select.data( 'disabled' ) ? $select.data( 'disabled' ) : [];

		if ( 'undefined' === typeof term ) {
			return;
		}

		// If we don't have the given Taxonomy
		if ( ! values[ term.taxonomy.name ] ) {
			values[ term.taxonomy.name ] = [];
		}

		// Bail if we already have the term added
		if ( -1 !== $.inArray( term.id, values[ term.taxonomy.name ] ) ) {
			// Remove the Selected Option
			$select.select2( 'val', '', false );
			return;
		}

		$filters.show();

		values[ term.taxonomy.name ].push( term.id );

		$field.val( JSON.stringify( values ) );

		var $link = $( '<a/>' ).attr( {
				'data-tax': term.taxonomy.name,
				'data-term': term.id,
				'class': 'calendar-widget-remove-filter',
				'href': '#',
			} ).text( '(remove)' ),
			$remove = $( '<span/>' ).append( $link ),
			$li = $( '<li/>' ).append( 'p' ).html( term.taxonomy.labels.name + ': ' + term.text ).append( $remove );

		$list.append( $li );

		tribeWidget.calendar_toggle( $widget );

		disabled.push( term.id );
		$select.data( 'disabled', disabled );

		// After all that remove the Opt
		$select.select2( 'val', '', false );
	} )
	.on( 'click', '.calendar-widget-remove-filter', function( e ) {
		e.preventDefault();
		var $link = $( this ),
			$widget = $link.parents( '.widget[id*="tribe-"]' ),
			$select = $widget.find( '.calendar-widget-add-filter' ).not( '.select2-container' ),
			$filters = $widget.find( '.calendar-widget-filters-container' ),
			$list = $widget.find( '.calendar-widget-filter-list' ),
			$field = $widget.find( '.calendar-widget-added-filters' ),
			values = $field.val() ? $.parseJSON( $field.val() ) : {},
			term_id = $link.data( 'term' ),
			taxonomy = $link.data( 'tax' ),
			disabled = $select.data( 'disabled' ) ? $select.data( 'disabled' ) : [];

		if ( values[ taxonomy ] ) {
			values[ taxonomy ] = _.without( values[ taxonomy ], term_id.toString() );
		}

		// Updates the HTML field
		$field.val( JSON.stringify( values ) );

		// Updates the Select2 Exclusion
		$select.data( 'disabled', _.without( disabled, term_id.toString() ) );

		$link.closest( 'li' ).remove();

		// support the customizer by triggering a false change on an element so the updated hidden field gets saved
		$widget.find( 'input[name^="widget-tribe-"]' ).trigger( 'change' );

		tribeWidget.calendar_toggle( $widget );

	} );

	// Open the Widget
	$body.on( 'click.widgets-toggle', tribeWidget.setup );
}( jQuery.noConflict(), _ ) );
