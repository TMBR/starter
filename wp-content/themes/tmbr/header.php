<!DOCTYPE html>
<!--[if lt IE 7]><html class="ie ie6" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 7]><html class="ie ie7" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 8]><html class="ie ie8" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 9]><html class="ie9" <?php language_attributes(); ?>><![endif]-->
<!--[if (gte IE 10)|!(IE)]><!--><html <?php language_attributes(); ?>><!--<![endif]-->

<head>

	<meta charset="<?php bloginfo('charset'); ?>" />
	<meta name="viewport" content="initial-scale=1,user-scalable=no,maximum-scale=1,width=device-width">

	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<!-- TYPEKIT
	<script src="//use.typekit.net/mhf8zro.js"></script>
	<script>try{Typekit.load();}catch(e){}</script>
	-->

	<title><?php wp_title(' | ', true, 'right'); ?></title>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

	<?php wp_head(); ?>

</head>



<body <?php body_class(); ?>  itemscope="itemscope" itemtype="http://schema.org/WebPage">

  <?php get_template_part( 'partials/global/preloader' ); ?>

  <div class="js-sitewrap site-wrap"> <!-- .body has opacity 0 for fade in effect on load -->

    <header id="header" role="header">
      <?php get_template_part( 'partials/header/fixed-nav' ); ?>
    </header>
    <!-- #header -->