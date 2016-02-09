<?php
/**
Template Name: Home Page
 *
 * @package sensible-wp
 */

get_header(); ?>

		<?php if( get_theme_mod( 'active_hero' ) == '') : ?>
        
                    <section id="hero-header" data-speed="8" data-type="background" style="background: url('<?php echo esc_url(get_theme_mod( 'sensiblewp_main_bg', __( (get_stylesheet_directory_uri( 'stylesheet_directory') . '/img/hero-1.jpg'), 'sensible-wp' ) )); ?>')  50% 0 no-repeat fixed;"> 
                		<div class="hero-content-container">
                			<div class="hero-content">
                            
                            <span>
                            
                            <?php if ( get_theme_mod( 'sensiblewp_first_heading' ) ) : ?>
                            
               					<h2 class="animated fadeInDown delay"><?php echo esc_textarea( get_theme_mod( 'sensiblewp_first_heading')) ?></h2> 
                                
                            <?php else : ?> 
							<?php endif; ?> 
                            
                            <?php if ( get_theme_mod( 'sensiblewp_hero_button_text' ) ) : ?>
                            
                            <?php if ( get_theme_mod( 'hero_button_url' ) ) : ?>
                            
                    			<a href="<?php echo esc_url( get_page_link( get_theme_mod('hero_button_url'))) ?>" class="featured-link"> 
                                
							<?php endif; ?>
       
                    		<?php if ( get_theme_mod( 'page_url_text' ) ) : ?> 
                            
    							<a href="<?php echo esc_url( get_theme_mod ( 'page_url_text' )) ?>" class="featured-link" target="_blank">
                                   
							<?php endif; ?> 
                            
                            <button class="wow animated fadeInDown delay"><?php echo esc_html( get_theme_mod( 'sensiblewp_hero_button_text')) ?></button></a>
                               
                            <?php endif; ?> 
                            
                               	  
                			</span>
                             
                			</div><!-- hero-content --> 
                		</div><!-- hero-content-container -->
                	</section><!-- hero-header -->
				
        
        <?php else : ?>  
		<?php endif; ?>
		<?php // end if ?>  
        
        <?php if( get_theme_mod( 'active_social' ) == '') : ?>
        
        	<div class="social-bar">
        		<div class="grid grid-pad">
        			<div class="col-1-1">
                
                	<?php if ( get_theme_mod( 'social_text' ) ) : ?>
        			  	<span class="wow animated fadeIn"><?php echo wp_kses_post(get_theme_mod( 'social_text' )); ?></span> 
                	<?php else : ?>  
					<?php endif; ?> 
              			<div class="wow animated fadeIn">
                        	<ul class='social-media-icons'>
                            	<?php if ( get_theme_mod( 'sensiblewp_fb' ) ) : ?>
                                	<li>
                                    <a href="<?php echo esc_url(get_theme_mod( 'sensiblewp_fb' )); ?>">
                                    <i class="fa fa-facebook"></i>
                                    </a>
                                    </li>
								<?php endif; ?>
                                <?php if ( get_theme_mod( 'sensiblewp_twitter' ) ) : ?>
                                	<li>
                                    <a href="<?php echo esc_url(get_theme_mod( 'sensiblewp_twitter' )); ?>"> 
                                    <i class="fa fa-twitter"></i> 
                                    </a>
                                    </li>
								<?php endif; ?>
                                <?php if ( get_theme_mod( 'sensiblewp_linked' ) ) : ?>
                                	<li>
                                    <a href="<?php echo esc_url(get_theme_mod( 'sensiblewp_linked' )); ?>">
                                    <i class="fa fa-linkedin"></i>
                                    </a>
                                    </li>
								<?php endif; ?>
                                <?php if ( get_theme_mod( 'sensiblewp_google' ) ) : ?>
                                	<li>
                                    <a href="<?php echo esc_url(get_theme_mod( 'sensiblewp_google' )); ?>">
                                    <i class="fa fa-google-plus"></i>
                                    </a>
                                    </li>
								<?php endif; ?>
                                <?php if ( get_theme_mod( 'sensiblewp_instagram' ) ) : ?>
                                	<li>
                                    <a href="<?php echo esc_url(get_theme_mod( 'sensiblewp_instagram' )); ?>">
                                    <i class="fa fa-instagram"></i>
                                    </a>
                                    </li>
								<?php endif; ?>
                                <?php if ( get_theme_mod( 'sensiblewp_flickr' ) ) : ?>
                                	<li>
                                    <a href="<?php echo esc_url(get_theme_mod( 'sensiblewp_flickr' )); ?>">
                                    <i class="fa fa-flickr"></i>
                                    </a>
                                    </li>
								<?php endif; ?>
                                <?php if ( get_theme_mod( 'sensiblewp_pinterest' ) ) : ?>
                                	<li>
                                    <a href="<?php echo esc_url(get_theme_mod( 'sensiblewp_pinterest' )); ?>">
                                    <i class="fa fa-pinterest"></i>
                                    </a>
                                    </li>
								<?php endif; ?>
                                <?php if ( get_theme_mod( 'sensiblewp_youtube' ) ) : ?>
                                	<li>
                                    <a href="<?php echo esc_url(get_theme_mod( 'sensiblewp_youtube' )); ?>">
                                    <i class="fa fa-youtube"></i>
                                    </a>
                                    </li>
								<?php endif; ?>
                                <?php if ( get_theme_mod( 'sensiblewp_vimeo' ) ) : ?>
                                	<li>
                                    <a href="<?php echo esc_url(get_theme_mod( 'sensiblewp_vimeo' )); ?>">
                                    <i class="fa fa-vimeo-square"></i>
                                    </a>
                                    </li> 
								<?php endif; ?>
                                <?php if ( get_theme_mod( 'sensiblewp_tumblr' ) ) : ?>
                                	<li>
                                    <a href="<?php echo esc_url(get_theme_mod( 'sensiblewp_tumblr' )); ?>">
                                    <i class="fa fa-tumblr"></i>
                                    </a>
                                    </li>
								<?php endif; ?>
                                <?php if ( get_theme_mod( 'sensiblewp_dribbble' ) ) : ?>
                                	<li>
                                    <a href="<?php echo esc_url(get_theme_mod( 'sensiblewp_dribbble' )); ?>">
                                    <i class="fa fa-dribbble"></i>
                                    </a>
                                    </li>
								<?php endif; ?>
                                <?php if ( get_theme_mod( 'sensiblewp_rss' ) ) : ?>
                                	<li>
                                    <a href="<?php echo esc_url(get_theme_mod( 'sensiblewp_rss' )); ?>"> 
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
        
        <?php if( get_theme_mod( 'active_intro' ) == '') : ?>  
        
        	<div class="home-content">
        		<div class="grid grid-pad">
        			<div class="col-1-1">
                		
						<?php if ( get_theme_mod( 'intro_text' ) ) : ?>
        			  		<h6 class="wow animated fadeInLeft"><?php echo wp_kses_post( get_theme_mod( 'intro_text' )); ?></h6>
                		<?php else : ?>  
						<?php endif; ?>
                        
                        <?php if ( get_theme_mod( 'intro_textbox' ) ) : ?>
        			  		<p class="wow animated fadeInRight"><?php echo wp_kses_post( get_theme_mod( 'intro_textbox' )); ?></p>  
                		<?php else : ?> 
						<?php endif; ?>

                	</div><!-- col-1-1 --> 
        		</div><!-- grid -->
        	</div><!-- home-content --> 
        
        <?php else : ?>  
		<?php endif; ?>
		<?php // end if ?> 
        
        <?php if( get_theme_mod( 'active_services' ) == '') : ?>    
        		
        	<div class="home-services">
            	
				<?php if ( get_theme_mod( 'services_text' ) ) : ?>
                
        			<div class="grid grid-pad">
                    
            			<div class="col-1-1">
                        	<h6 class="wow animated fadeIn"><?php echo wp_kses_post(get_theme_mod( 'services_text' )); ?></h6>
                        </div>
                        
            		</div><!-- grid -->
                    
                <?php else : ?>  
				<?php endif; ?>
                
                <?php
    			$service_sections = get_theme_mod( 'sensiblewp_services_numbers' );
    			if( $service_sections != '' ) {
        		switch ( $service_sections ) { 
            	case 'option1':
                	// Do nothing. all services are displayed. 
                	break;
            	case 'option2':
                	echo '<style type="text/css">';
                	echo '.sbox-3 { display:none }'; 
                	echo '</style>';
                	break;
            	case 'option3':
                	echo '<style type="text/css">';
                	echo '.sbox-3, .sbox-2 { display:none }';
                	echo '</style>';   
                	break;
        			}
    				} ?>
                
        		<div class="grid grid-pad no-top"> 
                    
					<div class="col-1-3 tri-clear wow animated fadeIn" data-wow-delay="0.25s"> 
    					<div class="service sbox-1">
                        
                        <?php if( get_theme_mod( 'active_service_1' ) == '') : ?>
                        
                        	<?php if ( get_theme_mod( 'service_icon_1' ) ) : ?>
                				<i class="fa <?php echo esc_html( get_theme_mod( 'service_icon_1' )); ?>"></i>
                            <?php endif; ?> 
                            
                            <?php if ( get_theme_mod( 'service_title_1' ) ) : ?>
              					<h5><?php echo wp_kses_post( get_theme_mod( 'service_title_1' )); ?></h5>
                            <?php endif; ?> 
                            
                            <?php if ( get_theme_mod( 'service_text_1' ) ) : ?>
              					<p class="member-description"><?php echo wp_kses_post( get_theme_mod( 'service_text_1' )); ?></p>
                            <?php endif; ?>
                            
                        <?php endif; ?>  
                             
  						</div><!-- service --> 
					</div><!-- col-1-3 --> 
                    
                    <div class="col-1-3 tri-clear wow animated fadeIn" data-wow-delay="0.25s"> 
    					<div class="service sbox-2">
                        
                        <?php if( get_theme_mod( 'active_service_2' ) == '') : ?>
                        
                        	<?php if ( get_theme_mod( 'service_icon_2' ) ) : ?>
                				<i class="fa <?php echo esc_html( get_theme_mod( 'service_icon_2' )); ?>"></i>
                            <?php endif; ?> 
                            
                            <?php if ( get_theme_mod( 'service_title_2' ) ) : ?>
              					<h5><?php echo wp_kses_post( get_theme_mod( 'service_title_2' )); ?></h5>
                            <?php endif; ?> 
                            
                            <?php if ( get_theme_mod( 'service_text_2' ) ) : ?>
              					<p class="member-description"><?php echo wp_kses_post( get_theme_mod( 'service_text_2' )); ?></p>
                            <?php endif; ?> 
                            
                        <?php endif; ?> 
                             
  						</div><!-- service --> 
					</div><!-- col-1-3 --> 
     
                    <div class="col-1-3 tri-clear wow animated fadeIn" data-wow-delay="0.25s"> 
    					<div class="service sbox-3">
                        
                         <?php if( get_theme_mod( 'active_service_3' ) == '') : ?>
                        
                        	<?php if ( get_theme_mod( 'service_icon_3' ) ) : ?>
                				<i class="fa <?php echo esc_html( get_theme_mod( 'service_icon_3' )); ?>"></i>
                            <?php endif; ?> 
                            
                            <?php if ( get_theme_mod( 'service_title_3' ) ) : ?>
              					<h5><?php echo wp_kses_post( get_theme_mod( 'service_title_3' )); ?></h5>
                            <?php endif; ?> 
                            
                            <?php if ( get_theme_mod( 'service_text_3' ) ) : ?>
              					<p class="member-description"><?php echo wp_kses_post( get_theme_mod( 'service_text_3' )); ?></p> 
                            <?php endif; ?> 
                            
                        <?php endif; ?> 
                             
  						</div><!-- service --> 
					</div><!-- col-1-3 -->    
  
        		</div><!-- grid -->
                
                <?php if ( get_theme_mod( 'service_button_text' ) ) : ?>
                    
                    	<?php if ( get_theme_mod( 'service_button_url' ) ) : ?>
                    		<a href="<?php echo esc_url( get_page_link( get_theme_mod('service_button_url'))) ?>" class="featured-link"> 
						<?php endif; ?>
                            
                          	<button class="wow animated fadeIn" data-wow-delay="0.25s">
							
              					<?php echo wp_kses_post( get_theme_mod( 'service_button_text' )); ?> 
                            
                            </button></a>
                        
				<?php endif; ?> 
                
        	</div><!-- home-services --> 
              
		<?php else : ?>  
		<?php endif; ?>
		<?php // end if ?>  
        
        
        <?php if( get_theme_mod( 'active_blog' ) == '') : ?> 
        
        	<div class="home-news">
                
				<?php if ( get_theme_mod( 'blog_text' ) ) : ?>
                
                	<div class="grid grid-pad">
            			<div class="col-1-1">
                    		<h6 class="wow animated fadeIn"><?php echo wp_kses_post( get_theme_mod( 'blog_text' )); ?></h6>
                    	</div><!-- col-1-1 -->  
                    </div><!-- grid -->
                    
				<?php endif; ?> 
           	    	
            	<div class="grid grid-pad no-top">
                
                	<?php
						global $post;
						$args = array( 'post_type' => 'post', 'posts_per_page' => 3, 'meta_query' => array(
        					'relation' => 'OR',
        					array(
            					'key' => '_sn_primary_checkbox',
            					'value' => false,
            					'type' => 'BOOLEAN'
        					),
        					array(
            					'key' => '_sn_primary_checkbox',
            					'compare' => 'NOT EXISTS'
        					)
    						)); 
						$myposts = get_posts( $args );
						foreach( $myposts as $post ) :	setup_postdata($post); ?>
              
                        <div class="col-1-3 tri-clear wow animated fadeInUp" data-wow-delay="0.25s">
            
            				<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('sensible-wp-home-blog'); ?></a> 
							<h5><?php the_title(); ?></h5>
                        	<p><?php $content = get_the_content(); echo wp_trim_words( $content , '20' ); ?> <a href="<?php the_permalink(); ?>"> Read More</a></p>
                        
                        </div><!-- col-1-3 --> 

					<?php endforeach; ?>
                    
        		</div><!-- grid -->
        	</div><!-- home-news -->
        	
            <?php if ( get_theme_mod( 'blog_cta' ) ) : ?>
        		
                <div class="home-blog-cta">
        			<div class="grid grid-pad">
            			<div class="col-1-1">
                			<a href="<?php if( get_option( 'show_on_front' ) == 'page' ) echo get_permalink( get_option('page_for_posts' ) );
else echo esc_url( home_url() );?>">
							<button class="outline white"><?php echo esc_html( get_theme_mod( 'blog_cta' )); ?></button>
                            </a>  
        				</div><!-- col-1-1 -->
            		</div><!-- grid -->
        		</div><!-- home-blog-cta -->
            
			<?php endif; ?>
        
        <?php else : ?>  
		<?php endif; ?>
		<?php // end if ?> 
        
        <?php if( get_theme_mod( 'active_team' ) == '') : ?>   
        
        	<div class="home-team">
        		
                <?php if ( get_theme_mod( 'team_text' ) ) : ?>
                	
                    <div class="grid grid-pad">
            			<div class="col-1-1">
                        	<h6 class="wow animated fadeInRight"><?php echo wp_kses_post( get_theme_mod( 'team_text' )); ?></h6>
                        </div><!-- col-1-1 -->  
            		</div><!-- grid -->
                
				<?php endif; ?>
                
                <?php
    			$member_sections = get_theme_mod( 'sensiblewp_member_numbers' );  
    			if( $member_sections != '' ) {
        		switch ( $member_sections ) {  
            	case 'option1':
                	// Do nothing. All members are displayed.
                	break;
            	case 'option2':
                	echo '<style type="text/css">';
                	echo '.tbox-3 { display:none }'; 
                	echo '</style>';
                	break;
            	case 'option3':
                	echo '<style type="text/css">';
                	echo '.tbox-3, .tbox-2 { display:none }';
                	echo '</style>';
                	break;
        			} 
    				}  ?>
                
        		<div class="grid grid-pad no-top">
    
					<div class="col-1-3 tri-clear wow animated fadeInLeft" data-wow-delay="0.15s">
    					<div class="member tbox-1">
                        
                        <?php if( get_theme_mod( 'active_member_1' ) == '') : ?>
                        
             	 			<?php if ( get_theme_mod( 'member_image_1' ) ) : ?>
        						<img src="<?php echo esc_url( get_theme_mod( 'member_image_1' ) ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
							<?php endif; ?>
                            
                            <?php if ( get_theme_mod( 'member_name_1' ) ) : ?>
              					<h5><?php echo wp_kses_post( get_theme_mod( 'member_name_1' )); ?></h5>
                            <?php endif; ?>
                            
                            <?php if ( get_theme_mod( 'member_text_1' ) ) : ?>
              					<p class="member-description"><?php echo wp_kses_post( get_theme_mod( 'member_text_1' )); ?></p>
                            <?php endif; ?> 
                    
                    		<?php if ( get_theme_mod( 'member_fb_1' ) ) : ?>
                    			<a href="<?php echo esc_url( get_theme_mod( 'member_fb_1' )); ?>" target="_blank"><i class="fa fa-facebook"></i></a>
                    		<?php endif; ?>
                    
                    		<?php if ( get_theme_mod( 'member_twitter_1' ) ) : ?>
                    			<a href="<?php echo esc_url( get_theme_mod( 'member_twitter_1' )); ?>" target="_blank"><i class="fa fa-twitter"></i></a>
                    		<?php endif; ?> 
                    
                    		<?php if ( get_theme_mod( 'member_linked_1' ) ) : ?>
                    			<a href="<?php echo esc_url( get_theme_mod( 'member_linked_1' )); ?>" target="_blank"><i class="fa fa-linkedin"></i></a>
                    		<?php endif; ?>
                    
                    		<?php if ( get_theme_mod( 'member_google_1' ) ) : ?>
                    			<a href="<?php echo esc_url( get_theme_mod( 'member_google_1' )); ?>" target="_blank"><i class="fa fa-google-plus"></i></a>
                    		<?php endif; ?>
                    
                    		<?php if ( get_theme_mod( 'member_email_1' ) ) : ?>
                    			<a href="mailto:<?php echo esc_html( get_theme_mod( 'member_email_1' )); ?>" target="_blank"><i class="fa fa-envelope-o"></i></a>
                    		<?php endif; ?>
                            
                        <?php endif; ?>
                    	
  						</div><!-- member --> 
					</div><!-- col-1-3 -->
                    
                    <div class="col-1-3 tri-clear wow animated fadeInLeft" data-wow-delay="0.15s">
    					<div class="member tbox-2">
                        
                        <?php if( get_theme_mod( 'active_member_2' ) == '') : ?>
                        
             	 			<?php if ( get_theme_mod( 'member_image_2' ) ) : ?>
        						<img src="<?php echo esc_url( get_theme_mod( 'member_image_2' ) ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
							<?php endif; ?>
                            
                            <?php if ( get_theme_mod( 'member_name_2' ) ) : ?>
              					<h5><?php echo wp_kses_post( get_theme_mod( 'member_name_2' )); ?></h5>
                            <?php endif; ?>
                            
                            <?php if ( get_theme_mod( 'member_text_2' ) ) : ?>
              					<p class="member-description"><?php echo wp_kses_post( get_theme_mod( 'member_text_2' )); ?></p>
                            <?php endif; ?> 
                    
                    		<?php if ( get_theme_mod( 'member_fb_2' ) ) : ?>
                    			<a href="<?php echo esc_url( get_theme_mod( 'member_fb_2' )); ?>" target="_blank"><i class="fa fa-facebook"></i></a>
                    		<?php endif; ?>
                    
                    		<?php if ( get_theme_mod( 'member_twitter_2' ) ) : ?>
                    		<a href="<?php echo esc_url( get_theme_mod( 'member_twitter_2' )); ?>" target="_blank"><i class="fa fa-twitter"></i></a>
                    		<?php endif; ?>
                    
                    		<?php if ( get_theme_mod( 'member_linked_2' ) ) : ?>
                    		<a href="<?php echo esc_url( get_theme_mod( 'member_linked_2' )); ?>" target="_blank"><i class="fa fa-linkedin"></i></a>
                    		<?php endif; ?>
                    
                    		<?php if ( get_theme_mod( 'member_google_2' ) ) : ?>
                    		<a href="<?php echo esc_url( get_theme_mod( 'member_google_2' )); ?>" target="_blank"><i class="fa fa-google-plus"></i></a>
                    		<?php endif; ?>
                    
                    		<?php if ( get_theme_mod( 'member_email_2' ) ) : ?>
                    		<a href="mailto:<?php echo esc_html( get_theme_mod( 'member_email_2' )); ?>" target="_blank"><i class="fa fa-envelope-o"></i></a>
                    		<?php endif; ?>
                             
                    	<?php endif; ?>
                        
  						</div><!-- member --> 
					</div><!-- col-1-3 --> 
                    
                    <div class="col-1-3 tri-clear wow animated fadeInLeft" data-wow-delay="0.15s">
    					<div class="member tbox-3"> 
                        
                        <?php if( get_theme_mod( 'active_member_3' ) == '') : ?> 
                        
             	 			<?php if ( get_theme_mod( 'member_image_3' ) ) : ?>
        						<img src="<?php echo esc_url( get_theme_mod( 'member_image_3' ) ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
							<?php endif; ?>
                            
                            <?php if ( get_theme_mod( 'member_name_3' ) ) : ?>
              					<h5><?php echo wp_kses_post( get_theme_mod( 'member_name_3' )); ?></h5>
                            <?php endif; ?>
                            
                            <?php if ( get_theme_mod( 'member_text_3' ) ) : ?>
              					<p class="member-description"><?php echo wp_kses_post( get_theme_mod( 'member_text_3' )); ?></p>
                            <?php endif; ?> 
                    
                    		<?php if ( get_theme_mod( 'member_fb_3' ) ) : ?>
                    			<a href="<?php echo esc_url( get_theme_mod( 'member_fb_3' )); ?>" target="_blank"><i class="fa fa-facebook"></i></a>
                    		<?php endif; ?>
                    
                    		<?php if ( get_theme_mod( 'member_twitter_3' ) ) : ?>
                    		<a href="<?php echo esc_url( get_theme_mod( 'member_twitter_3' )); ?>" target="_blank"><i class="fa fa-twitter"></i></a>
                    		<?php endif; ?>
                    
                    		<?php if ( get_theme_mod( 'member_linked_3' ) ) : ?>
                    		<a href="<?php echo esc_url( get_theme_mod( 'member_linked_3' )); ?>" target="_blank"><i class="fa fa-linkedin"></i></a>
                    		<?php endif; ?>
                    
                    		<?php if ( get_theme_mod( 'member_google_3' ) ) : ?>
                    		<a href="<?php echo esc_url( get_theme_mod( 'member_google_3' )); ?>" target="_blank"><i class="fa fa-google-plus"></i></a>
                    		<?php endif; ?>
                    
                    		<?php if ( get_theme_mod( 'member_email_3' ) ) : ?>
                    		<a href="mailto:<?php echo esc_html( get_theme_mod( 'member_email_3' )); ?>" target="_blank"><i class="fa fa-envelope-o"></i></a> 
                    		<?php endif; ?>
                             
                    	<?php endif; ?>
  						
                        </div><!-- member --> 
					</div><!-- col-1-3 --> 
                       
            	</div><!-- grid -->
                
                <?php if ( get_theme_mod( 'team_button_text' ) ) : ?>
                    
                    	<?php if ( get_theme_mod( 'team_button_url' ) ) : ?>
                    		<a href="<?php echo esc_url( get_page_link( get_theme_mod('team_button_url'))) ?>" class="featured-link"> 
						<?php endif; ?>
                            
                          	<button class="wow animated fadeInLeft" data-wow-delay="0.15s">  
				
              					<?php echo esc_html( get_theme_mod( 'team_button_text' )); ?>
                            
                            </button>
                            
                         </a> 
                        
				<?php endif; ?> 
                
        	</div><!-- home-team -->
        
        <?php else : ?>  
		<?php endif; ?>
		<?php // end if ?>
        
        <?php if( get_theme_mod( 'active_home_widget' ) == '') : ?>
        
        <div class="home-cta" style="background: url(<?php echo esc_url( get_theme_mod( 'sensiblewp_new_widget_area_background' )); ?>) no-repeat center center fixed; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;">  
        	<div class="grid grid-pad">
                
         	<?php $widget_columns = get_theme_mod( 'sensiblewp_widget_columns' ); 
    			if( $widget_columns != '' ) {
        		switch ( $widget_columns ) { 
            	case 'option1':
                	// Do nothing. all services are displayed. 
                	break;
            	case 'option2':
                	echo '<style type="text/css">';
                	echo '.sensible-home-widget-area .widget { width: 50%; float:left; padding-right: 30px; }';
					echo '@media handheld, only screen and (max-width: 767px) {';
					echo '.sensible-home-widget-area .widget { width: 100%; float:none; padding-right: 0px; }';
                	echo '}';
					echo '</style>';
                	break;
            	case 'option3': 
                	echo '<style type="text/css">';
                	echo '.sensible-home-widget-area .widget { width: 33.33%; float:left; padding-right: 30px; }';
					echo '@media handheld, only screen and (max-width: 767px) {';
					echo '.sensible-home-widget-area .widget { width: 100%; float:none; padding-right: 0px; }';
                	echo '}';
					echo '</style>';
                	break;
				case 'option4':
                	echo '<style type="text/css">';
                	echo '.sensible-home-widget-area .widget { width: 25%; float:left; padding-right: 30px; }'; 
					echo '@media handheld, only screen and (max-width: 767px) {';
					echo '.sensible-home-widget-area .widget { width: 100%; float:none; padding-right: 0px; }';
                	echo '}'; 
					echo '</style>';
                	break;
        			}
    				}  ?>
                	
					<div class="sensible-home-widget-area">
                    
                    	<div class="col-1-1">
                
                			<?php if ( get_theme_mod( 'home_widget_icon' ) ) : ?>
                            
                				<i class="fa <?php echo esc_html( get_theme_mod( 'home_widget_icon' )); ?>"></i>
                                
							<?php endif; ?> 
                    
                    	</div><!-- col-1-1 --> 
                    
                    	<div class="col-1-1">
                    
                    		<?php if ( is_active_sidebar('home-widget') ) : ?>
                    
    							<?php dynamic_sidebar('home-widget'); ?> 
                           
    		 				<?php endif; ?>
                    
                    	</div><!-- col-1-1 -->
    
                    	<div class="col-1-1">
                    
                    		<?php if ( get_theme_mod( 'sensiblewp_widget_button_url' ) ) : ?>
                    			<a href="<?php echo esc_url( get_page_link( get_theme_mod('sensiblewp_widget_button_url')))?>"> 
                        			<?php if ( get_theme_mod( 'sensiblewp_widget_button_text' ) ) : ?> 
                            			<button class="outline white"><?php echo esc_html( get_theme_mod( 'sensiblewp_widget_button_text' )); ?></button>
									<?php endif; ?> 
                        		</a>
                    		<?php endif; ?> 
                    
                    	</div><!-- col-1-1 --> 
                    
                	</div><!-- sensible-home-widget-area --> 
					
				
            </div><!-- grid -->
        </div><!-- home-cta --> 
		
        <?php else : ?>  
		<?php endif; ?>
		<?php // end if ?>

<?php get_footer(); ?>
