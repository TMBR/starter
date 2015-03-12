<?php
/*
Template Name: x-Style Guide-x
*/

get_header(); ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>


<?php get_template_part('/partials/global/child-nav'); ?>

<div id="page-wrap">
		
	<div class="container">
		<div class="row">
		
			<div class="col-lg-10 col-lg-offset-1 col-xs-12">		
				<h1 class="text-center"><?php the_title(); ?></h1>
				<h2 class="fw-black uppercase">Headers</h2>
				<div class="row">
					<div class="col-xs-2"><code>&lt;h1&gt;Header 1&lt;/h1&gt;</code></div><!-- /col -->
					<div class="col-xs-10"><h1 style="margin-top:0;">Header 1</h1></div><!-- /col -->
				</div><!-- /row -->

				<div class="row">
					<div class="col-xs-2"><code>&lt;h2&gt;Header 2&lt;/h2&gt;</code></div><!-- /col -->
					<div class="col-xs-10"><h2 style="margin-top:0;">Header 2</h2></div><!-- /col -->
				</div><!-- /row -->

				<div class="row">
					<div class="col-xs-2"><code>&lt;h3&gt;Header 3&lt;/h3&gt;</code></div><!-- /col -->
					<div class="col-xs-10"><h3 style="margin-top:0;">Header 3</h3></div><!-- /col -->
				</div><!-- /row -->

				<div class="row">
					<div class="col-xs-2"><code>&lt;h4&gt;Header 4&lt;/h4&gt;</code></div><!-- /col -->
					<div class="col-xs-10"><h4 style="margin-top:0;">Header 4</h4></div><!-- /col -->
				</div><!-- /row -->

				<div class="row">
					<div class="col-xs-2"><code>&lt;h5&gt;Header 5&lt;/h5&gt;</code></div><!-- /col -->
					<div class="col-xs-10"><h5 style="margin-top:0;">Header 5</h5></div><!-- /col -->
				</div><!-- /row -->
				<hr/>
				<h2 class="fw-black uppercase">Typography</h2>
				
				<p><code>&lt;h4 class="emphasis&gt;Header with Underline&lt;/h4&gt;</code></p>
				<h4 class="emphasis">Header with Underline</h4>
				
				<hr>
				<div class="row">
					<div class="col-xs-4"><code>&lt;p class="lead"&gt;...&lt;/p&gt;</code></div><!-- /col -->
					<div class="col-xs-8"><p class="lead">Use the lead class for text that you would like to stand out.</p></div><!-- /col -->
				</div><!-- /row -->
				<hr/>
				<div class="row">
					<div class="col-xs-4"><code>&lt;p class="text-center"&gt;...&lt;/p&gt;</code></div><!-- /col -->
					<div class="col-xs-8"><p class="text-center">Use the text-center class for center-aligned text. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. </p></div><!-- /col -->
				</div><!-- /row -->
				<hr/>
				<div class="row">
					<div class="col-xs-4"><code>&lt;p class="uppercase"&gt;...&lt;/p&gt;</code></div><!-- /col -->
					<div class="col-xs-8"><p class="uppercase">Use the uppercase class to capitalize text.</p></div><!-- /col -->
				</div><!-- /row -->
				<hr/>
				<h2 class="fw-black uppercase">Buttons</h2>
				<p class="lead">Use the button shortcode to easily add a button to your content! With the button shortcode you can set the link, the size and whether or not the button opens in a new tab. </p>
				<h4><strong>Example 1:</strong> A button that links to homepage</h4>

				<p><code>&#91;button link="http://www.jhmg.com"&#93;Sample Button&#91;/button&#93;</code></p>
				<p><a href="http://www.jhmg.com" class="btn btn-blue">Sample Button</a></p>
				<p>You can enter anything you'd like as a link, you could enter <code>/adventures/</code> to link to the <a href="/adventures/">Adventures Page</a> or you could enter a link to another website. Just be sure to include <code>http://</code> before <code>www</code> where applicable and to <strong>test all your links!</strong></p>
				<hr/>
				<h4><strong>Example 2:</strong> A large blue button</h4>
				<p><code>&#91;button color="blue" size="btn-lg" link="http://www.climbwyoming.org"&#93;Large Blue Button&#91;/button&#93;</code></p>
				<p><a href="http://www.climbwyoming.org" class="btn btn-blue btn-lg">Large Blue Button</a></p>
				<br/>
				<p><strong>Available Size Values:</strong> <code>btn-lg</code>, <code>btn-sm</code>, <code>btn-block</code>.</p>
				<div class="row">
					<div class="col-md-2">
					<a href="http://www.climbwyoming.org" class="btn btn-blue btn-sm">Small Button</a>
					</div><!-- /col -->
					<div class="col-md-2">
					<a href="http://www.climbwyoming.org" class="btn btn-blue">Normal Button</a>
					</div><!-- /col -->
					<div class="col-md-2">
					<a href="http://www.climbwyoming.org" class="btn btn-blue btn-lg">Large Button</a>
					</div><!-- /col -->
					<div class="col-md-12" style="margin-top: 15px;">
					<a href="http://www.climbwyoming.org" class="btn btn-blue btn-block">Full Width Button</a>
					</div><!-- /col -->
					
					
				</div><!-- /row -->
				<hr/>
				<h4><strong>Example 3:</strong> A button that opens the link in a new tab</h4>
				<p><code>&#91;button target="blank" link="http://www.google.com"&#93;Link in New Tab&#91;/button&#93;</code></p>
				<p><a href="http://www.google.com" target="_blank" class="btn btn-blue">Link in New Tab</a></p>
				<br/>
				<p><strong>The only value available for target is:</strong> <code>blank</code>.</p>
				<hr/>
			
				<h2 class="fw-black uppercase">Colors</h2>
				<p class="lead">Set the color of text with the following classes:</p>
				<div class="row">
					<div class="col-xs-3"><code>&lt;p class="white"&gt;...&lt;/p&gt;</code></div><!-- /col -->
					<div class="col-xs-9"><p class="white">This text is white (which is default color, this is good for links which are automatically blue)</p></div><!-- /col -->
				</div><!-- /row -->
				<div class="row">
					<div class="col-xs-3"><code>&lt;p class="blue"&gt;...&lt;/p&gt;</code></div><!-- /col -->
					<div class="col-xs-9"><p class="blue">This text is blue</p></div><!-- /col -->
				</div><!-- /row -->
				<div class="row">
					<div class="col-xs-3"><code>&lt;p class="gray"&gt;...&lt;/p&gt;</code></div><!-- /col -->
					<div class="col-xs-9"><p class="gray">This text is gray</p></div><!-- /col -->
				</div><!-- /row -->
				
				<br/>
				
			</div><!-- /col -->
		
		</div><!-- /row -->
		
	</div><!-- /container -->
</div><!-- #page-wrap -->

<?php endwhile; endif; ?>
<?php get_footer(); ?>
