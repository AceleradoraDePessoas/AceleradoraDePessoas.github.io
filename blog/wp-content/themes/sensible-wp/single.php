<?php
/**
 * The template for displaying all single posts.
 *
 * @package sensible-wp 
 */

get_header(); ?>

	<?php if (has_post_thumbnail( $post->ID ) ): ?>
		<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); $image = $image[0]; ?>
            
    	<header class="featured-img-header" data-speed="8" data-type="background" style="background: url('<?php echo $image; ?>') 50% 0 no-repeat fixed;">
    		<div class="grid grid-pad">
        		<div class="col-1-1">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
        		</div><!-- .col-1-1 -->
        	</div><!-- .grid --> 
		</header><!-- .entry-header --> 
    
		<?php else : ?>
        
        <header class="entry-header">
    		<div class="grid grid-pad">
        		<div class="col-1-1">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
        		</div><!-- .col-1-1 -->
        	</div><!-- .grid -->
		</header><!-- .entry-header -->
        
	<?php endif; ?>
    
 	<?php while ( have_posts() ) : the_post(); ?>
       
	<header class="single-blog-entry-header">
		<div class="entry-meta">
			<?php _e( 'Posted by, ', 'sensible-wp' ); ?><?php the_author(); ?><?php echo get_avatar( get_the_author_meta('email'), get_the_author() ); ?>
            <?php _e( 'on ', 'sensible-wp' ); ?><?php the_date(); ?> 
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->
   
	<div class="grid grid-pad">
		<div id="primary" class="content-area col-9-12">
			<main id="main" class="site-main" role="main">

			<?php get_template_part( 'content', 'single' ); ?>  

			<?php sensiblewp_post_nav(); ?>

			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			?>

		<?php endwhile; // end of the loop. ?>

			</main><!-- #main -->
		</div><!-- #primary -->

	<?php get_sidebar(); ?>
	</div><!-- grid -->
	<?php get_footer(); ?>
