<?php
	ob_start();
?>
	<div class="ot-center ot-error" style="display:none;">
		<h2><?php esc_html_e("Error", 'orange-front-page');?></h2>
		<p><?php esc_html_e("Something went wrong...", 'orange-front-page');?></p>
	</div>


	<div class="ot-center ot-import-font-page" >

		<h1><?php esc_html_e("Import front page settings", 'orange-front-page');?></h1>

		<p><?php esc_html_e("Here you can easy import the front page settings, so it would look like our demo page.", 'orange-front-page');?></p>
		<p><?php esc_html_e("Before importing these settings, please make sure that you have done these steps:", 'orange-front-page');?></p>
		
		<?php if( ot_front_page()->supported_themes() == false ) { ?>
			<?php echo sprintf( esc_html__( 'Add this line', 'orange-front-page' ).'<code> %s </code>'.esc_html__( 'in your theme front-page.php or any template file that is used as front page.', 'orange-front-page' ), htmlspecialchars('<?php do_action( "orange_themes_front_page" ); ?>') ); ?>
		<?php } ?>
		
		<ol>
			<li class="<?php echo( get_option( 'show_on_front' ) == "page" ) ? 'ot-done' : 'ot-required'; ?>"><?php echo sprintf( esc_html__( 'Set up front page in', 'orange-front-page' ).' %s'.esc_html__( 'Settings', 'orange-front-page' ).'%s -> %s'.esc_html__( 'Reading', 'orange-front-page' ).'%s -> '.esc_html__( 'Front page displays', 'orange-front-page' ), '<a href="'.esc_url(admin_url( '/customize.php' )).'">', '</a>', '<a href="'.esc_url(admin_url( '/options-reading.php' )).'">', '</a>' ); ?></li>
			<li class="<?php echo( ot_front_page()->panel->check_recomended_plugins() ) ? 'ot-done' : 'ot-required'; ?>"><?php echo sprintf( esc_html__( 'Install and activate all', 'orange-front-page' ).' %s'.esc_html__( 'recomended plugins', 'orange-front-page' ).'%s ', '<a href="'.esc_url(admin_url( '/themes.php?page=tgmpa-install-plugins' )).'">','</a>' ); ?></li>
			<li class="<?php echo( get_option( 'jetpack_portfolio' ) == "1" && get_option( 'jetpack_testimonial' ) == "1") ? 'ot-done' : 'ot-required'; ?>"><?php esc_html_e("Enable JetPack custom post types - Portfolio and Testimonials", 'orange-front-page');?></li>
		</ol>
		<?php
			$button_class = ( ot_front_page()->panel->check_recomended_plugins() && get_option( 'show_on_front' ) == "page" && get_option( 'jetpack_portfolio' ) == "1" && get_option( 'jetpack_testimonial' ) == "1" ) ? 'ot-active' : 'ot-disabled ot-disabled';

		?>

		<div class="ot-center ot-imported-font-page"<?php echo ( get_option('otfp_front_page_imported') != "1" ) ? ' style="display:none;"' : ' style="display:block;"' ; ?>>
			<p><strong><?php esc_html_e("Front page settings are aleady imported.", 'orange-front-page');?></strong></p>
			<?php if( ot_front_page()->supported_themes() != false ) { ?>
				<p><?php echo sprintf( esc_html__( "Isn't it good enought? Then feel free to download also the post, portfolio and testimonial demo content here: ", 'orange-front-page' ).' %s<strong>'.esc_html__( 'Download', 'orange-front-page' ).'</strong>%s '.esc_html__( "Import it using the default WordPress importer plugin, and make sure you have connected to the JetPack plugin.", 'orange-front-page' ), '<a href="http://orange-themes.net/demo/'.ot_front_page()->supported_themes().'/'.ot_front_page()->supported_themes().'.xml" target="_blank">', '</a>'); ?></p>
			<?php } else { ?>
				<p><?php echo sprintf( esc_html__( "Isn't it good enought? Then feel free to download also the post, portfolio and testimonial demo content here: ", 'orange-front-page' ).' %s<strong>'.esc_html__( 'Download', 'orange-front-page' ).'</strong>%s '.esc_html__( "Import it using the default WordPress importer plugin, and make sure you have connected to the JetPack plugin.", 'orange-front-page' ), '<a href="http://orange-themes.net/demo/orange-front-page/orange-front-page.xml" target="_blank">', '</a>'); ?></p>
			<?php } ?>
		</div>

		<p><a href="<?php echo esc_url( admin_url( 'admin.php?action=orange_front_page_import_demo&import-type=orange-front-page&import=orange-front-page' ) );?>" class="ot-import-front-page button button-primary <?php echo esc_attr($button_class);?>" data-importing="<?php esc_attr_e("Importing...", 'orange-front-page');?>" data-imported="<?php esc_attr_e("Imported", 'orange-front-page');?>"><?php esc_html_e("Import Default Front Page", 'orange-front-page');?></a></p>
		<p><a href="#" class="ot-import-front-page-file button button-primary <?php echo esc_attr($button_class);?>" data-importing="<?php esc_attr_e("Importing From File...", 'orange-front-page');?>" data-imported="<?php esc_attr_e("Imported", 'orange-front-page');?>"><?php esc_html_e("Import Front Page From File", 'orange-front-page');?></a></p>
		<script type="text/javascript">
			jQuery(document).ready(function($){ loadUploader(jQuery("a.ot-import-front-page-file"), "<?php echo ( admin_url( 'admin.php?action=orange_front_page_upload_demo&ot-export-type=orange-front-page&import=orange-front-page' ) );?>");});
		</script>

		<p><a href="<?php echo esc_url( admin_url( 'admin.php?action=orange_front_page_export_management&ot-export-type=orange-front-page&file_name=orange-front-page&download=1' ) );?>" class="ot-export-front-page-file button button-primary <?php echo esc_attr($button_class);?>" data-exporting="<?php esc_attr_e("Exporting...", 'orange-front-page');?>" data-exported="<?php esc_attr_e("Exported", 'orange-front-page');?>"><?php esc_html_e("Export Front Page", 'orange-front-page');?></a></p>
	</div>



	<hr>

	<div class="ot-center">
		<h1><?php esc_html_e("Import sidebar widgets", 'orange-front-page');?></h1>
		<p><?php esc_html_e("Here you can easy import all page sidebar widgets, including front page widgets.", 'orange-front-page');?></p>
		<p><a href="<?php echo esc_url( admin_url( 'admin.php?action=orange_front_page_import_demo&import-type=orange-front-page-widgets&import=orange-front-page' ) );?>" class="ot-import-front-page button button-primary" data-importing="<?php esc_attr_e("Importing...", 'orange-front-page');?>" data-imported="<?php esc_attr_e("Imported", 'orange-front-page');?>"><?php esc_html_e("Import Widgets", 'orange-front-page');?></a></p>
		<p><a href="#" class="ot-widget-file button button-primary" data-importing="<?php esc_attr_e("Importing From File...", 'orange-front-page');?>" data-imported="<?php esc_attr_e("Imported", 'orange-front-page');?>"><?php esc_html_e("Import Widgets From File", 'orange-front-page');?></a></p>
		<script type="text/javascript">
			jQuery(document).ready(function($){ loadUploader(jQuery("a.ot-widget-file"), "<?php echo ( admin_url( 'admin.php?action=orange_front_page_upload_demo&ot-export-type=orange-front-page-widgets&import=orange-front-page' ) );?>");});
		</script>

		<p><a href="<?php echo esc_url( admin_url( 'admin.php?action=orange_front_page_export_widgets&ot-export-type=orange-front-page-widgets&file_name=orange-front-page-widgets&download=1' ) );?>" class="ot-export-front-page-file button button-primary" data-exporting="<?php esc_attr_e("Exporting...", 'orange-front-page');?>" data-exported="<?php esc_attr_e("Exported", 'orange-front-page');?>"><?php esc_html_e("Export Widgets", 'orange-front-page');?></a></p>


	</div>

	<hr>

	<div class="ot-center">
		<h1><?php esc_html_e("Reset theme settings", 'orange-front-page');?></h1>
		<p><?php esc_html_e("Use this if you want ro reset all theme custom settings.", 'orange-front-page');?></p>
		<p>
			<a href="#" class="ot-setting-reset button button-primary" data-reseting="<?php esc_attr_e("Reseting...", 'orange-front-page');?>" data-reseted="<?php esc_attr_e("Reseted", 'orange-front-page');?>">
				<?php esc_html_e("Reset", 'orange-front-page');?>
			</a>
		</p>

	</div>


<?php
	$content = ob_get_contents();
	ob_end_clean();

	$section_content = array(
		array(
			"type" => "navigation",
			"name" => esc_html__("Demo",'orange-front-page'),
			"slug" => "demo_content",
			"class" => "ot-actions"
		),
		array(
			"type" => "section_start",
			"slug" => "demo_content"
		),

		array(
			"type" => "section_content",
			"content" => $content
		),

		array(
			"type" => "section_end"
		),


	);

	$this->add_options( $section_content );