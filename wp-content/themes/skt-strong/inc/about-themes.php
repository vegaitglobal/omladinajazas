<?php
//about theme info
add_action( 'admin_menu', 'skt_strong_abouttheme' );
function skt_strong_abouttheme() {    	
	add_theme_page( __('About Theme', 'skt-strong'), __('About Theme', 'skt-strong'), 'edit_theme_options', 'skt_strong_guide', 'skt_strong_mostrar_guide');   
} 

//guidline for about theme
function skt_strong_mostrar_guide() { 
	//custom function about theme customizer
?>

<style type="text/css">
@media screen and (min-width: 800px) {
.col-left {float:left; width: 65%; padding: 1%;}
.col-right {float:right; width: 30%; padding:1%; border-left:1px solid #DDDDDD; }
}
</style>

<div class="wrapper-info">
	<div class="col-left">
   		   <div style="font-size:16px; font-weight:bold; padding-bottom:5px; border-bottom:1px solid #ccc;">
			  <?php esc_attr_e('About Theme Info', 'skt-strong'); ?>
		   </div>
          <p><?php esc_attr_e('SKT Strong is a responsive crossfit WordPress theme which can be used for gym, fitness, personal trainer, studio, yoga, boxing, aerobics, spa, health, workout, portfolio and other multipurpose local business use. Compatible with gallery plugins, contact form plugins, SEO plugins and is translation ready and multilingual ready.','skt-strong'); ?></p>
		  <a href="<?php echo esc_url(SKT_PRO_THEME_URL); ?>"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/free-vs-pro.png" alt="" /></a>
	</div><!-- .col-left -->
	
	<div class="col-right">			
			<div style="text-align:center; font-weight:bold;">
				<hr />
				<a href="<?php echo esc_url(SKT_LIVE_DEMO); ?>" target="_blank"><?php esc_attr_e('Live Demo', 'skt-strong'); ?></a> | 
				<a href="<?php echo esc_url(SKT_PRO_THEME_URL); ?>"><?php esc_attr_e('Buy Pro', 'skt-strong'); ?></a> | 
				<a href="<?php echo esc_url(SKT_THEME_DOC); ?>" target="_blank"><?php esc_attr_e('Documentation', 'skt-strong'); ?></a>
                <div style="height:5px"></div>
				<hr />                
                <a href="<?php echo esc_url(SKT_THEMES); ?>" target="_blank"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/sktskill.jpg" alt="" /></a>
			</div>		
	</div><!-- .col-right -->
</div><!-- .wrapper-info -->
<?php } ?>