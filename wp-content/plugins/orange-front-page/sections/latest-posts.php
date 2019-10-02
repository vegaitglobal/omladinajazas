<?php
/**
 *	The template for dispalying latest posts section in front page.
 *
 *	@package WordPress
 *	@subpackage ot_front_page
 */

	$title = ot_front_page()->options->get( 'latest_posts_title' );
	$text = ot_front_page()->options->get( 'latest_posts_text' );
	$bg_color = ot_front_page()->options->get( 'latest_posts_bg_color','#ffffff' );
	$text_color = ot_front_page()->options->get( 'latest_posts_text_color', 0 );
	$count = ot_front_page()->options->get( 'latest_posts_count', 3 );
	$offset = ot_front_page()->options->get( 'latest_posts_offset', 0 );
	$cat = ot_front_page()->options->get( 'latest_posts_cat', array() );
	$tag = ot_front_page()->options->get( 'latest_posts_tag', array() );
	$images = ot_front_page()->options->get( 'latest_posts_images', 1 );


	if(is_array($cat)) {
		$args['category__in'] = $cat;
		$category__in = $args['category__in'];
	} else if($cat) {
		$args['cat'] = $cat;
		$category__in = false;
	} else {
		$category__in = false;
	}

	if(is_array($tag)) {
		$args['tag__in'] = $tag;
		$tag__in = $args['tag__in'];
	} else if($cat) {
		$args['tag'] = $tag;
		$tag__in = false;
	} else {
		$tag__in = false;
	}

	$args = array(
		'offset' => $offset,
		'category__in' => $category__in,
		'tag__in' => $tag__in,
		'posts_per_page'=> $count,
		'ignore_sticky_posts' => true
	);

	$the_query = new WP_Query($args);

?>

<?php if( $title != "" || $text != "" || $the_query->have_posts() ) : ?>
	<!-- about plugin --> 
	<section id="latest-posts" class="ot-section <?php echo esc_attr(( $text_color == 1) ? 'text-light' : 'text-dark'); ?> <?php echo esc_attr(( $bg_color == "#fff" || $bg_color == "#ffffff" ) ? 'ot-bg-white' : ''); ?>" style="background-color:<?php echo esc_attr( $bg_color );?>">
		<div class="ot-container">
			<?php if( $title || $text ) : ?>
				<div class="row">
					<div class="col-lg-12 text-center">
						<div class="section-title">
							<?php if( $title ) : ?>
								<h2><?php echo ot_front_page()->customizer->sanitize_html($title);?></h2>
							<?php endif; ?>
							<?php if( $text ) : ?>
								<p><?php echo ot_front_page()->customizer->sanitize_html($text);?></p>
							<?php endif; ?>
						</div>
					</div>
				</div>
			<?php endif; ?>


			<div class="row widget-count-<?php echo esc_attr($count);?> per-row-<?php echo esc_attr($count);?>">


				<?php if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post(); ?>
				
					<div class="ot-widget">
						<div class="ot-blog-post">
							<?php if( $images == 1 ) : ?>
								<div class="ot-blog-post-image">
									<a href="<?php the_permalink();?>" title="<?php the_title_attribute();?>">
										<?php the_post_thumbnail( 'ot-front-page-latest-posts-front' ); ?>		
									</a>
								</div>
							<?php endif;?>		
							<div class="ot-blog-post-body">
								<h2>
									<a href="<?php the_permalink();?>" title="<?php the_title_attribute();?>" class="post-title">
										<?php the_title();?>
									</a>
								</h2>
								<p>
									<?php the_excerpt(); ?>
								</p>
								<p>
									<a href="<?php the_permalink();?>" title="<?php esc_attr_e("Read more", "orange-front-page");?>" class="btn">
										<?php esc_html_e("Read more", "orange-front-page");?>
									</a>
								</p>
							</div><!--/.post-entry-->

						</div><!--/.post-->
					</div>


				<?php endwhile; else: ?>
					<p><?php  esc_html_e('No posts were found','orange-front-page');?></p>
				<?php endif; ?>


			</div>


		</div>
		<!-- /.container -->
	</section>
<?php endif; ?>