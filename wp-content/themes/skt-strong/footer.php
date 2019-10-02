<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package SKT Strong
 */
$hidefooter = get_theme_mod('hide_footer', 1);
$hidecontact = get_theme_mod('hide_contact', 1);
?>
<div id="footer-wrapper">
  <?php if($hidefooter == ''){?>
  <div class="container footer">
    <div class="cols-3 widget-column-1">
      <?php $about_title = get_theme_mod('about_title'); 
			  	if (!empty($about_title)) { ?>
      <h5><?php echo esc_html($about_title);?></h5>
      <?php } 
			   	$about_description = get_theme_mod('about_description'); 
				if (!empty($about_description)) { ?>
      <p><?php echo wp_kses_post($about_description);?></p>
      <?php } ?>
    </div>
    <!--end .widget-column-1-->
    <div class="cols-3 widget-column-2">
      <?php $newsfeed_title = get_theme_mod('newsfeed_title'); 
			  	if (!empty($newsfeed_title)) { ?>
      <h5><?php echo esc_html($newsfeed_title); ?></h5>
      <?php } 
			  $args = array( 'posts_per_page' => 2, 'post__not_in' => get_option('sticky_posts'), 'orderby' => 'date', 'order' => 'desc' );
					$postquery = new WP_Query( $args );
					while( $postquery->have_posts() ) : $postquery->the_post(); ?>
      <div class="recent-post">
        <div class="footerthumb"><a href="<?php echo esc_url( get_permalink() ); ?>">
          <?php the_post_thumbnail(); ?>
          </a></div>
        <p>
          <?php the_excerpt(); ?>
        </p>
        <a class="morebtn" href="<?php echo esc_url( get_permalink() ); ?>">
        <?php esc_attr_e('Read More..','skt-strong'); ?>
        </a> </div>
      <?php endwhile; wp_reset_postdata(); ?>
    </div>
    <!--end .widget-column-3-->
    
    <div class="cols-3 widget-column-3">
      <?php 
			   	   if($hidecontact == ''){
					   $contact_title = get_theme_mod('contact_title', 'skt-strong');
					   if (!empty($contact_title)){ 
				?>
      <h5><?php echo esc_html($contact_title); ?></h5>
      <?php } 
			   
			   $contact_add = get_theme_mod('contact_add', 'skt-strong');
			   if (!empty($contact_add)) { ?>
      <div class="siteaddress"><?php echo wp_kses_post($contact_add); ?></div>
      <?php } ?>
      <div class="phone-no">
        <?php $contact_no = get_theme_mod('contact_no'); 
			   if (!empty($contact_no)) { ?>
        <p><span><?php echo esc_html('Phone:', 'skt-strong');?></span> <?php echo esc_html($contact_no); ?></p>
        <?php } 
			   $contact_mail = get_theme_mod('contact_mail'); 
			   if(!empty($contact_mail)){ ?>
        <p><span><?php echo esc_html('Email:', 'skt-strong');?></span> <a href="mailto:<?php echo esc_attr( antispambot(sanitize_email( $contact_mail ) )); ?>"><?php echo esc_html( antispambot( $contact_mail ) ); ?></a></p>
        <?php } ?>
      </div>
      <?php } ?>
    </div>
    <!--end .widget-column-4-->
    <div class="clear"></div>
  </div>
  <!--end .container-->
  <?php } ?>
  <div class="copyright-wrapper">
    <div class="container">
      <div class="copyright-txt">&nbsp;</div>
      <div class="design-by"><?php echo esc_html('SKT Strong');?></div>
      <div class="clear"></div>
    </div>
  </div>
</div>
<!--end .footer-wrapper-->
<?php wp_footer(); ?>
</body></html>