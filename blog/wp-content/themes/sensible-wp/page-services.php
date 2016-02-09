<?php
/**
Template Name: Page - Services
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

	<div id="primary" class="content-area service-page">
		<main id="main" class="site-main" role="main">
		
        <div class="grid grid-pad">

		<?php
    			$service_page_sections = get_theme_mod( 'sensiblewp_page_services_numbers' );
    			if( $service_page_sections != '' ) {
        		switch ( $service_page_sections ) {  
            	case 'option1':
                	// Do nothing. all services are displayed. 
                	break;
            	case 'option2':
                	echo '<style type="text/css">';
                	echo '.sbox-page-3 { display:none }'; 
                	echo '</style>';
                	break;
            	case 'option3':
                	echo '<style type="text/css">';
                	echo '.sbox-page-3, .sbox-page-2 { display:none }';
                	echo '</style>'; 
                	break;
				
        			}
    				} 
				?>
                
        	
                    
					<div class="col-1-3 tri-clear wow animated fadeIn" data-wow-delay="0.25s"> 
    					<div class="service sbox-page-1">
                        
                        <?php if( get_theme_mod( 'active_page_service_1' ) == '') : ?>
                        
                        	<?php if ( get_theme_mod( 'page_service_icon_1' ) ) : ?>
                				<i class="fa <?php echo esc_html( get_theme_mod( 'page_service_icon_1' )); ?>"></i>
                            <?php endif; ?> 
                            
                            <?php if ( get_theme_mod( 'page_service_title_1' ) ) : ?>
              					<h5><?php echo wp_kses_post( get_theme_mod( 'page_service_title_1' )); ?></h5>
                            <?php endif; ?> 
                            
                            <?php if ( get_theme_mod( 'page_service_text_1' ) ) : ?>
              					<p class="member-description"><?php echo wp_kses_post( get_theme_mod( 'page_service_text_1' )); ?></p>
                            <?php endif; ?>
                            
                        <?php endif; ?>  
                             
  						</div><!-- service --> 
					</div><!-- col-1-3 --> 
                    
                    <div class="col-1-3 tri-clear wow animated fadeIn" data-wow-delay="0.25s"> 
    					<div class="service sbox-page-2">
                        
                        <?php if( get_theme_mod( 'active_page_service_2' ) == '') : ?>
                        
                        	<?php if ( get_theme_mod( 'page_service_icon_2' ) ) : ?>
                				<i class="fa <?php echo esc_html( get_theme_mod( 'page_service_icon_2' )); ?>"></i>
                            <?php endif; ?> 
                            
                            <?php if ( get_theme_mod( 'page_service_title_2' ) ) : ?>
              					<h5><?php echo wp_kses_post( get_theme_mod( 'page_service_title_2' )); ?></h5>
                            <?php endif; ?> 
                            
                            <?php if ( get_theme_mod( 'page_service_text_2' ) ) : ?>
              					<p class="member-description"><?php echo wp_kses_post( get_theme_mod( 'page_service_text_2' )); ?></p>
                            <?php endif; ?> 
                            
                        <?php endif; ?> 
                             
  						</div><!-- service --> 
					</div><!-- col-1-3 --> 
     
                    <div class="col-1-3 tri-clear wow animated fadeIn" data-wow-delay="0.25s"> 
    					<div class="service sbox-page-3">
                        
                         <?php if( get_theme_mod( 'active_page_service_3' ) == '') : ?>
                        
                        	<?php if ( get_theme_mod( 'page_service_icon_3' ) ) : ?>
                				<i class="fa <?php echo esc_html( get_theme_mod( 'page_service_icon_3' )); ?>"></i>
                            <?php endif; ?> 
                            
                            <?php if ( get_theme_mod( 'page_service_title_3' ) ) : ?>
              					<h5><?php echo wp_kses_post( get_theme_mod( 'page_service_title_3' )); ?></h5>
                            <?php endif; ?> 
                            
                            <?php if ( get_theme_mod( 'page_service_text_3' ) ) : ?>
              					<p class="member-description"><?php echo wp_kses_post( get_theme_mod( 'page_service_text_3' )); ?></p>
                            <?php endif; ?>
                            
                        <?php endif; ?> 
                             
  						</div><!-- service -->
					</div><!-- col-1-3 -->
  
			
				<div class="content-area col-1-1">

					<?php while ( have_posts() ) : the_post(); ?>

						<?php get_template_part( 'content', 'page' ); ?> 

						<?php
							// If comments are open or we have at least one comment, load up the comment template
							if ( comments_open() || get_comments_number() ) :
								comments_template();
							endif;
						?>

					<?php endwhile; // end of the loop. ?>

				</div><!-- col-1-1 -->
			
        
        </div><!-- grid --> 

		</main><!-- #main -->
	</div><!-- #primary -->
    
<?php get_footer(); ?>
