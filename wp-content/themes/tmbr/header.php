<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>" />
	<meta name="viewport" content="width=device-width" />

	<title><?php wp_title(' | ', true, 'right'); ?></title>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="site-wrapper">

<div id="nav-wrapper">
	<div class="container-fluid no-gutter">
		<div class="row">
			<div class="col-sm-12">
				<nav id="header-nav" role="navigation">
				<a href="#" class="toggle-nav" id="hamburg"><i class="fa fa-bars"></i></a>
				<a href="#" id="take-action" data-toggle="modal" data-target="#actionModal"><i class="fa fa-microphone"></i> TAKE ACTION </a>
				<?php wp_nav_menu( array( 'theme_location' => 'main-menu','menu_class' => '', 'container_class' => '' ) ); ?>
				</nav>
			</div><!-- /col -->

		</div><!-- /row -->
	</div><!-- /container -->
</div><!-- /end nav wrapper -->

   <div id="site-canvas">

     <div id="site-menu">
       <a href="#" class="toggle-nav" style="color: pink; font-size: 20px;"><i class="fa fa-times"></i></a>
       <h2>My Menu</h1>
       <p class="lead">Put any HTML you want here.</p>
       <p>Style it however you want.</p>

       <ul>
         <li>Free to scroll up and down</li>
         <li>But not left and write</li>
         <li>Free to scroll up and down</li>
         <li>But not left and write</li>
         <li>Free to scroll up and down</li>
         <li>But not left and write</li>
         <li>Free to scroll up and down</li>
         <li>But not left and write</li>
         <li>Free to scroll up and down</li>
         <li>But not left and write</li>
         <li>Free to scroll up and down</li>
         <li>But not left and write</li>
         <li>Free to scroll up and down</li>
         <li>But not left and write</li>
         <li>Free to scroll up and down</li>
         <li>But not left and write</li>
         <li>Free to scroll up and down</li>
         <li>But not left and write</li>
         <li>Free to scroll up and down</li>
         <li>But not left and write</li>
         <li>Free to scroll up and down</li>
         <li>But not left and write</li>
         <li>Free to scroll up and down</li>
         <li>But not left and write</li>
         <li>Free to scroll up and down</li>
         <li>But not left and write</li>
       </ul>
     </div>

<!--
<div class="container">
	<div class="row">
		<div class="col-md-12">
		<?php wp_nav_menu( array( 'theme_location' => 'main-menu','menu_class' => '', 'container_class' => '' ) );?>
		</div>
	</div>
</div> -->