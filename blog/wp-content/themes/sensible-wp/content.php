<?php
/**
 * @package sensible-wp
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>> 

	<?php if (has_post_thumbnail( $post->ID ) ): ?>
		<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); $image = $image[0]; ?>
          
        <a href="<?php the_permalink(); ?>">    
    	<header class="blog-featured-img-header" style="background: url('<?php echo $image; ?>');">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		</header><!-- .entry-header --> 
        </a>
    
	<?php else : ?>
        
        <a href="<?php the_permalink(); ?>">  
        <header class="blog-entry-header">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		</header><!-- .entry-header -->
        </a>
        
	<?php endif; ?>


	<div class="entry-content">
		
		<?php
				if ( 'option2' == sensiblewp_sanitize_index_content( get_theme_mod( 'sensiblewp_post_content' ) ) ) :
				the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'sensible-wp' ) );
				else :
				the_excerpt( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'sensible-wp' ) );
				endif; 
		?>

		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'sensible-wp' ), 
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
    	<div class="entry-meta">
			<i class="fa fa-clock-o"></i><?php sensiblewp_posted_on(); ?>
		</div><!-- .entry-meta -->
			<?php sensiblewp_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
