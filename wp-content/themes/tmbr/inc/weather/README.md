Weather Forecast Integration
=====================================================================

This is the readme that will show you how to integrate the social feed into the site.  First follow these steps:

- Uncomment in functions.php where it links to weather stuff

Notes
--------------

- The [Forecast.io API](https://developer.forecast.io/docs/v2) provides a JSON response with multiple days, each as their own object.  These particular days are referenced throughout the code as `$weather_obj`.  There are helper functions to help reference some of the commonly-requested properties of the object.  This prevents needing to do a bunch of isset checks, as these methods take care of that.
- Forecast.io provides **"current"** conditons separately than the results for the day -- even "today".  Because of that, there are methods that we can use to interact with the current day's properties.
	- The function `get_current_icon()` also filters the icon, which allows you to filter the icon that's presented to the user.  There's an example of the filter below.

Set Up the Weather Object
---------------------------------------------------------------------

```

	<?php
	$weather = TMBR_Weather::i();

	//YOU MUST FIRST CREATE THE POST TYPE 'SNOW REPORTS' and ACF

	$args = array(
		'post_type' => 'snow_reports',
		'posts_per_page' => 7  // one weeks worth
	);
	$weeks_snow_reports = get_posts( $args );

	// Pull the latest snow report for 24hr snowfall
	$snow_report = current( $weeks_snow_reports );
	$snow_level = get_post_meta( $snow_report->ID, 'snowfall_24hr', true );

	$is_todays_snow_report = ( $snow_report->post_title == date( 'Y-m-d', current_time( 'timestamp' ) ) );
	$snow_report_sent = (bool) get_post_meta( $snow_report->ID, 'mailchimp_campaign_sent', true );


	if ( empty( $weeks_snow_reports ) )
	{
		wp_die( 'Please enter snow reports before accessing this page.' );
	}

	$daily_snow_conditions = array();

	foreach ($weeks_snow_reports as $daily_report) {

		$daily_snow_conditions[] = array(
			'detail' => get_post_meta( $daily_report->ID, 'detail', true ),
			'24hr' => get_post_meta( $daily_report->ID, 'snowfall_24hr', true ),
			'48hr' => get_post_meta( $daily_report->ID, 'snowfall_48hr', true ),
			'5days' => get_post_meta( $daily_report->ID, 'snowfall_5day', true ),
			'1year' => get_post_meta( $daily_report->ID, 'snowfall_year', true ),
			'avg_depth' => get_post_meta( $daily_report->ID, 'snowfall_avg_depth', true ),
			'title' => $daily_report->post_title,
		);
	}
	?>

```


Samples Of Output
--------------------------------------------------------------------------

###When the report was last updated

```
	<?php
	$lastUpdate = $snow_report->post_title;
	$lastUpdate = date("F jS", strtotime($lastUpdate));

	echo 'Last Updated:' . $lastUpdate;
	?>

```


###Current Weather Icon and Temp

```

<i class="wi large <?php echo esc_attr( $weather->get_current_icon() ); ?>"></i>
<p class="current-temp"><?php echo esc_html( round($weather->get_current_temp()) ); ?>&deg;<span>f</span></p>

```


###High For The Current Day

```

<i class="wi small <?php echo esc_attr( $weather->get_current_icon() ); ?>"></i>
<p class="temp"><?php echo esc_html( round($weather->get_weather_for_day(0)->temperatureMax) ); ?>&deg;<span>f</span></p>

```

###Low For The Current Day

```
<i class="wi small <?php echo esc_attr( $weather->get_current_icon() ); ?>"></i>
<p class="temp"><?php echo esc_html( round($weather->get_weather_for_day(0)->temperatureMin) ); ?>&deg;<span>f</span></p>

```


###Weekly Forecast

```

<?php for ($i=1; $i <= 6; $i++) {
$day_weather = $weather->get_weather_for_day( $i );
?>
<div class="col-xs-2">
	<i class="wi small <?php echo esc_attr( $weather->get_icon_from_weather( $day_weather) ); ?>"></i>
	<p><?php echo esc_html( date( 'D', strtotime( '+' . $i . ' day' ) ) ); ?></p>
</div>
<?php } ?>

```


###24hr Precip

```
<?php echo $daily_snow_conditions[0]['24hr']; ?>

```


###48hr Precip

```

<?php echo $daily_snow_conditions[0]['48hr']; ?>

```


###5 Day Precip

```

<?php echo $daily_snow_conditions[0]['5days']; ?>

```


###Base Depth

```

<?php echo $daily_snow_conditions[0]['avg_depth']; ?>

```


###Year To Date

```

<?php echo $daily_snow_conditions[0]['1year']; ?>

```


###Output Details

```

<?php echo $daily_snow_conditions[0]['detail']; ?>

```

### Example Filter for the Current Icon Override

There is a file `weather-overrides.php` in the `inc/` folder of the theme that integrates this and a couple other features.

```
add_filter(
	'tmbr_weather_current_icon',
	function( $icon_str, $weather_obj ) {
		$_icon = get_option( 'options_weather_icon_override' );
		if ( !empty( $_icon ) && strtolower( $_icon ) != 'default')
		{
			$icon_str = $_icon;
		}
		return $icon_str;
	},
	10,
	2
);
```




