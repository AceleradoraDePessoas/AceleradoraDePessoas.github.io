<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package sensible-wp
 */
?>

	</section><!-- #content --> 
    
    
    <?php if( get_theme_mod( 'active_footer_social' ) == '') : ?> 
        
        	<div class="social-bar"> 
        		<div class="grid grid-pad">
        			<div class="col-1-1">
                
                	<?php if ( get_theme_mod( 'footer_social_text' ) ) : ?>
        			  	<span class="wow animated fadeIn"><?php echo wp_kses_post( get_theme_mod( 'footer_social_text' )); ?></span>
                	<?php else : ?>  
					<?php endif; ?> 
              			<div class="wow animated fadeIn">
                        	<ul class='social-media-icons'>
                            	<?php if ( get_theme_mod( 'sensiblewp_fb' ) ) : ?>
                                	<li>
                                    <a href="<?php echo esc_url( get_theme_mod( 'sensiblewp_fb' )); ?>">
                                    <i class="fa fa-facebook"></i>
                                    </a>
                                    </li>
								<?php endif; ?>
                                <?php if ( get_theme_mod( 'sensiblewp_twitter' ) ) : ?>
                                	<li>
                                    <a href="<?php echo esc_url( get_theme_mod( 'sensiblewp_twitter' )); ?>">
                                    <i class="fa fa-twitter"></i>
                                    </a>
                                    </li>
								<?php endif; ?>
                                <?php if ( get_theme_mod( 'sensiblewp_linked' ) ) : ?>
                                	<li>
                                    <a href="<?php echo esc_url( get_theme_mod( 'sensiblewp_linked' )); ?>">
                                    <i class="fa fa-linkedin"></i>
                                    </a>
                                    </li>
								<?php endif; ?>
                                <?php if ( get_theme_mod( 'sensiblewp_google' ) ) : ?>
                                	<li>
                                    <a href="<?php echo esc_url( get_theme_mod( 'sensiblewp_google' )); ?>">
                                    <i class="fa fa-google-plus"></i>
                                    </a>
                                    </li>
								<?php endif; ?>
                                <?php if ( get_theme_mod( 'sensiblewp_instagram' ) ) : ?>
                                	<li>
                                    <a href="<?php echo esc_url( get_theme_mod( 'sensiblewp_instagram' )); ?>">
                                    <i class="fa fa-instagram"></i>
                                    </a>
                                    </li>
								<?php endif; ?>
                                <?php if ( get_theme_mod( 'sensiblewp_flickr' ) ) : ?>
                                	<li>
                                    <a href="<?php echo esc_url( get_theme_mod( 'sensiblewp_flickr' )); ?>">
                                    <i class="fa fa-flickr"></i>
                                    </a>
                                    </li>
								<?php endif; ?>
                                <?php if ( get_theme_mod( 'sensiblewp_pinterest' ) ) : ?>
                                	<li>
                                    <a href="<?php echo esc_url( get_theme_mod( 'sensiblewp_pinterest' )); ?>">
                                    <i class="fa fa-pinterest"></i>
                                    </a>
                                    </li>
								<?php endif; ?>
                                <?php if ( get_theme_mod( 'sensiblewp_youtube' ) ) : ?>
                                	<li>
                                    <a href="<?php echo esc_url( get_theme_mod( 'sensiblewp_youtube' )); ?>">
                                    <i class="fa fa-youtube"></i>
                                    </a>
                                    </li>
								<?php endif; ?>
                                <?php if ( get_theme_mod( 'sensiblewp_vimeo' ) ) : ?>
                                	<li>
                                    <a href="<?php echo esc_url( get_theme_mod( 'sensiblewp_vimeo' )); ?>">
                                    <i class="fa fa-vimeo-square"></i>
                                    </a>
                                    </li> 
								<?php endif; ?>
                                <?php if ( get_theme_mod( 'sensiblewp_tumblr' ) ) : ?>
                                	<li>
                                    <a href="<?php echo esc_url( get_theme_mod( 'sensiblewp_tumblr' )); ?>">
                                    <i class="fa fa-tumblr"></i>
                                    </a>
                                    </li>
								<?php endif; ?>
                                <?php if ( get_theme_mod( 'sensiblewp_dribbble' ) ) : ?>
                                	<li>
                                    <a href="<?php echo esc_url( get_theme_mod( 'sensiblewp_dribbble' )); ?>">
                                    <i class="fa fa-dribbble"></i>
                                    </a>
                                    </li>
								<?php endif; ?>
                                <?php if ( get_theme_mod( 'sensiblewp_rss' ) ) : ?>
                                	<li>
                                    <a href="<?php echo esc_url( get_theme_mod( 'sensiblewp_rss' )); ?>"> 
                                    <i class="fa fa-rss"></i>
                                    </a>
                                    </li>   
								<?php endif; ?> 
                        	</ul>
                        </div>   
                
                	</div><!-- col-1-1 -->
        		</div><!-- grid -->
        	</div><!-- social-bar -->
        
        <?php else : ?>  
		<?php endif; ?>
		<?php // end if ?>
        
        <?php if( get_theme_mod( 'active_footer_contact' ) == '') : ?>
    
    
    <div class="footer-contact">
        <div class="grid grid-pad">
            
            <div class="col-1-1">
            	<?php if ( get_theme_mod( 'footer_title_text' ) ) : ?> 
    				<h6><?php echo wp_kses_post( get_theme_mod( 'footer_title_text' )); // footer title ?></h6>
    			<?php else : ?> 
				<?php endif; ?>
            </div><!-- col-1-1 -->
            	
                <div class="col-1-3">
            		<div class="footer-block">
                    
                    	<?php if ( get_theme_mod( 'bottom_footer_icon_1' ) ) : ?> 
    						<i class="fa <?php echo wp_kses_post( get_theme_mod( 'bottom_footer_icon_1', __( 'fa-map-marker', 'sensible-wp' ) )); // first icon ?>"></i>
    					<?php else : ?> 
						<?php endif; ?>
                        
                        <?php if ( get_theme_mod( 'first_text' ) ) : ?> 
    						<h5><?php echo wp_kses_post( get_theme_mod( 'first_text' )); // first icon ?></h5>
    					<?php else : ?>   
						<?php endif; ?>
                        
                        <?php if ( get_theme_mod( 'sensiblewp_footer_first' ) ) : ?> 
    						<p><?php echo wp_kses_post( get_theme_mod( 'sensiblewp_footer_first' )); // first icon ?></p>
    					<?php else : ?>   
						<?php endif; ?>  
            		
            		</div><!-- footer-block -->
    			</div><!-- col-1-3 -->
                
            	<div class="col-1-3">
            		<div class="footer-block">
            			
                        <?php if ( get_theme_mod( 'bottom_footer_icon_2' ) ) : ?> 
    						<i class="fa <?php echo wp_kses_post( get_theme_mod( 'bottom_footer_icon_2', __( 'fa-mobile', 'sensible-wp' ) )); // second icon ?>"></i>
    					<?php else : ?> 
						<?php endif; ?>
                        
                        <?php if ( get_theme_mod( 'second_text' ) ) : ?> 
    						<h5><?php echo wp_kses_post( get_theme_mod( 'second_text' )); // second icon ?></h5>
    					<?php else : ?>   
						<?php endif; ?>
                        
                        <?php if ( get_theme_mod( 'sensiblewp_footer_second' ) ) : ?> 
    						<p><?php echo wp_kses_post( get_theme_mod( 'sensiblewp_footer_second' )); // second icon ?></p>
    					<?php else : ?>   
						<?php endif; ?>
                 
            		</div><!-- footer-block -->
    			</div><!-- col-1-3 -->
                
            	<div class="col-1-3">
            		<div class="footer-block">
                    	
                        <?php if ( get_theme_mod( 'bottom_footer_icon_3' ) ) : ?> 
    						<i class="fa <?php echo wp_kses_post( get_theme_mod( 'bottom_footer_icon_3', __( 'fa-envelope-o', 'sensible-wp' ) )); // third icon ?>"></i>
    					<?php else : ?>
						<?php endif; ?>
                        
                        <?php if ( get_theme_mod( 'third_text' ) ) : ?> 
    						<h5><?php echo wp_kses_post( get_theme_mod( 'third_text' )); // third icon ?></h5> 
    					<?php else : ?>   
						<?php endif; ?>
                        
                        <?php if ( get_theme_mod( 'sensiblewp_footer_third' ) ) : ?>  
    						<p><?php echo wp_kses_post( get_theme_mod( 'sensiblewp_footer_third' )); // third icon ?></p> 
    					<?php else : ?>   
						<?php endif; ?>  
            		  
            		</div><!-- footer-block -->
    			</div><!-- col-1-3 -->
                
    	</div><!-- grid -->
    </div><!-- footer-contact --> 
    
    <?php endif; ?> 
	<?php // end if ?> 

	<footer id="colophon" class="site-footer" role="contentinfo">
    	<div class="grid grid-pad">
			<div class="site-info col-1-1">
				<?php if ( get_theme_mod( 'sensiblewp_footerid' ) ) : ?> 
        			<?php echo wp_kses_post( get_theme_mod( 'sensiblewp_footerid' )); // footer id ?>
				<?php else : ?>  
    				<?php printf( __( 'Theme: %1$s by %2$s', 'sensible-wp' ), 'Sensible', '<a href="http://modernthemes.net" rel="designer">modernthemes.net</a>' ); ?>
				<?php endif; ?>
			</div><!-- .site-info --> 
        </div><!-- grid -->
	</footer><!-- #colophon -->

</div><!-- #page --> 

<?php wp_footer(); ?>

</body>
</html>
