Social Feed Integration
=======================


This is the readme that will show you how to integrate the social feed into the site.  First follow these steps:

- Uncomment in functions.php where it links to inc/socialfeed/init.php

Once that is set up you are ready to rock.

Architecture
--------

Inside the `services` folder, there are specific files that deal with each of the services.  These pull the latest items from the respective service, and know how to convert those items into the standardized "socialpost" object.

Presently, the API Keys, usernames, auth keys, etc. reside in the respective service file.  This isn't ideal, but is functional for now.


Output
--------

### First you set it up just like you would any other post type



```

$args = array(
	'post_type' => 'social_posts',
	'posts_per_page' => 4,
);

// If you want to find just a certain service's posts
$args['meta_query'] = array(
	array(
		'key' => 'socialpost_data',
		'value' => 'facebook',
		'compare' => 'LIKE',
	),
);

$socialQuery = new WP_Query( $args );

```

### To output the posts...

```

while ( $socialQuery->have_posts() )
{

	$socialQuery->the_post();
	$socialPost = new \SocialFeed\Models\SocialPost;

	$socialPost->retrieve( get_the_ID() );

	$date = date("F d", $socialPost->get_date());

	if($socialPost->get_thumbnail())
	{
		echo '<img src="' . $socialPost->get_thumbnail() . '" alt="' . $socialPost->get_service() . '-image" />';
	}

	if($socialPost->get_content())
	{
		echo '<p>' . $socialPost->get_content() . '</p>';
	}

	if($socialPost->get_url())
	{
		echo '<a href="' . $socialPost->get_url() . '" class="social_more">more...</a> <span class="social-date">' . $date . ' -  </span><div class="clear"></div>';
	}

}

wp_reset_postdata();
```