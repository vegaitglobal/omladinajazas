<?php
/**
 * @package SKT Strong
 */
?>
 <div class="blog_lists">
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    
		<?php if (has_post_thumbnail() ){ ?>
        <div class="post-thumb"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a></div>
        <?php }?>
  
        <header class="entry-header">           
            <h4><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h4>
            <?php if ( 'post' == get_post_type() ) : ?>
                <div class="postmeta">
                    <div class="post-date"><?php echo the_date(); ?></div><!-- post-date -->
                    <div class="post-comment"> &nbsp;|&nbsp; <a href="<?php comments_link(); ?>"><?php comments_number(); ?></a></div>
                    <div class="post-categories"> &nbsp;|&nbsp; <?php the_category( esc_html( ', ', 'skt-strong' )); ?></div>                  
                </div><!-- postmeta -->
            <?php endif; ?>
        </header><!-- .entry-header -->
        <div class="entry-summary">
           	<?php the_excerpt(); ?>
           <a class="ReadMore" href="<?php the_permalink(); ?>"><?php esc_attr_e('Read More &rarr;','skt-strong'); ?></a>
        </div><!-- .entry-summary -->
        <div class="clear"></div>
    </article><!-- #post-## -->
</div><!-- blog-post-repeat -->