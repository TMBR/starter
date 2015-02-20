<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="initial-scale=1,user-scalable=no,maximum-scale=1,width=device-width">

	<title><?php wp_title(' | ', true, 'right'); ?></title>
	<?php wp_head(); ?>


</head>

<body <?php body_class(); ?>>

<?php
// Hero Slider
get_template_part( 'partials/header/fixed_nav' ); ?>
