<?php
/**
 * Sensible Theme Customizer 
 *
 * @package sensible-wp
 */
 
function sensiblewp_theme_customizer( $wp_customize ) { 
	
	//allows donations
    class sensiblewp_Info extends WP_Customize_Control { 
     
        public $label = '';
        public function render_content() {
        ?>

        <?php
        }
    }	
	
	// Pro
    $wp_customize->add_section(
        'sensiblewp_theme_info',
        array(
            'title' => __('Sensible Pro', 'sensible-wp'), 
            'priority' => 5, 
            'description' => __('Need a little more Sensible? If you want to see what additional features <a href="http://modernthemes.net/wordpress-themes/sensible-pro/" target="_blank">Sensible Pro</a> has, check them all out right <a href="http://modernthemes.net/wordpress-themes/sensible-pro/" target="_blank">here</a>.', 'sensible-wp'), 
        )
    );
	 
    //Donations section
    $wp_customize->add_setting('sensiblewp_help', array(
			'sanitize_callback' => 'sensiblewp_no_sanitize',
            'type' => 'info_control',
            'capability' => 'edit_theme_options',
        )
    );
    $wp_customize->add_control( new sensiblewp_Info( $wp_customize, 'sensiblewp_help', array( 
        'section' => 'sensiblewp_theme_info', 
        'settings' => 'sensiblewp_help', 
        'priority' => 10
        ) )
    );
	   
	// Fonts  
    $wp_customize->add_section(
        'sensiblewp_typography',
        array(
            'title' => __('Google Fonts', 'sensible-wp' ),   
            'priority' => 40,
    ));
	
    $font_choices = 
        array(
			'Open Sans:400italic,700italic,400,700' => 'Open Sans',
			'Oswald:400,700' => 'Oswald',
			'Source Sans Pro:400,700,400italic,700italic' => 'Source Sans Pro',
			'Playfair Display:400,700,400italic' => 'Playfair Display',
			'Montserrat:400,700' => 'Montserrat',
			'Raleway:400,700' => 'Raleway',
            'Droid Sans:400,700' => 'Droid Sans',
            'Lato:400,700,400italic,700italic' => 'Lato',
            'Arvo:400,700,400italic,700italic' => 'Arvo',
            'Lora:400,700,400italic,700italic' => 'Lora',
			'Merriweather:400,300italic,300,400italic,700,700italic' => 'Merriweather',
			'Oxygen:400,300,700' => 'Oxygen',
			'PT Serif:400,700' => 'PT Serif', 
            'PT Sans:400,700,400italic,700italic' => 'PT Sans',
            'PT Sans Narrow:400,700' => 'PT Sans Narrow',
			'Cabin:400,700,400italic' => 'Cabin',
			'Fjalla One:400' => 'Fjalla One',
			'Francois One:400' => 'Francois One',
			'Josefin Sans:400,300,600,700' => 'Josefin Sans',  
			'Libre Baskerville:400,400italic,700' => 'Libre Baskerville',
            'Arimo:400,700,400italic,700italic' => 'Arimo',
            'Ubuntu:400,700,400italic,700italic' => 'Ubuntu',
            'Bitter:400,700,400italic' => 'Bitter',
            'Droid Serif:400,700,400italic,700italic' => 'Droid Serif',
            'Roboto:400,400italic,700,700italic' => 'Roboto',
            'Open Sans Condensed:700,300italic,300' => 'Open Sans Condensed',
            'Roboto Condensed:400italic,700italic,400,700' => 'Roboto Condensed',
            'Roboto Slab:400,700' => 'Roboto Slab',
            'Yanone Kaffeesatz:400,700' => 'Yanone Kaffeesatz',
            'Rokkitt:400' => 'Rokkitt',
    );
	
	//body font size
    $wp_customize->add_setting(
        'sensiblewp_body_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '15', 
        )       
    );
    $wp_customize->add_control( 'sensiblewp_body_size', array(
        'type'        => 'number', 
        'priority'    => 10,
        'section'     => 'sensiblewp_typography',
        'label'       => __('Body Font Size', 'sensiblewp'), 
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 28,
            'step'  => 1,
            'style' => 'margin-bottom: 10px; padding: 10px;',
        ),
  	));
    
    $wp_customize->add_setting(
        'headings_fonts',
        array(
            'sanitize_callback' => 'sensiblewp_sanitize_fonts',
    ));
    
    $wp_customize->add_control(
        'headings_fonts',
        array(
            'type' => 'select',
			'default'           => '20', 
            'description' => __('Select your desired font for the headings. Open Sans is the default Heading font.', 'sensible-wp'),
            'section' => 'sensiblewp_typography',
            'choices' => $font_choices
    ));
    
    $wp_customize->add_setting(
        'body_fonts',
        array(
            'sanitize_callback' => 'sensiblewp_sanitize_fonts',
    ));
    
    $wp_customize->add_control(
        'body_fonts',
        array(
            'type' => 'select',
			'default'           => '30', 
            'description' => __( 'Select your desired font for the body. Open Sans is the default Body font.', 'sensible-wp' ), 
            'section' => 'sensiblewp_typography',  
            'choices' => $font_choices 
    )); 

	// Colors
	$wp_customize->add_setting( 'sensiblewp_text_color', array(
        'default'     => '#8c9398',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sensiblewp_text_color', array(
        'label'	   => __( 'Text Color', 'sensible-wp' ),
        'section'  => 'colors',
        'settings' => 'sensiblewp_text_color',
		'priority' => 10 
    ))); 
	
    $wp_customize->add_setting( 'sensiblewp_link_color', array( 
        'default'     => '#ea474b',   
        'sanitize_callback' => 'sanitize_hex_color', 
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sensiblewp_link_color', array(
        'label'	   => __( 'Link Color', 'sensible-wp'),
        'section'  => 'colors',
        'settings' => 'sensiblewp_link_color', 
		'priority' => 30
    )));
	
	$wp_customize->add_setting( 'sensiblewp_hover_color', array(
        'default'     => '#ea474b',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sensiblewp_hover_color', array(
        'label'	   => __( 'Hover Color', 'sensible-wp' ), 
        'section'  => 'colors',
        'settings' => 'sensiblewp_hover_color',
		'priority' => 35 
    )));
	
	$wp_customize->add_setting( 'sensiblewp_custom_color', array( 
        'default'     => '#ea474b', 
		'sanitize_callback' => 'sanitize_hex_color',
    ));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sensiblewp_custom_color', array(
        'label'	   => __( 'Theme Color', 'sensible-wp' ),
        'section'  => 'colors',
        'settings' => 'sensiblewp_custom_color', 
		'priority' => 20
    )));
	
	$wp_customize->add_setting( 'sensiblewp_custom_color_hover', array( 
        'default'     => '#ea474b',  
		'sanitize_callback' => 'sanitize_hex_color', 
    ));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sensiblewp_custom_color_hover', array(
        'label'	   => __( 'Theme Hover Color', 'sensible-wp' ),
        'section'  => 'colors',
        'settings' => 'sensiblewp_custom_color_hover', 
		'priority' => 25
    )));
	
	$wp_customize->add_setting( 'sensiblewp_site_title_color', array(
        'default'     => '#ea474b', 
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sensiblewp_site_title_color', array(
        'label'	   => __( 'Site Title Color', 'sensible-wp' ),  
        'section'  => 'colors',
        'settings' => 'sensiblewp_site_title_color',
		'priority' => 40
    )));
	
	$wp_customize->add_setting( 'sensiblewp_blockquote', array(
        'default'     => '#f1f1f1',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sensiblewp_blockquote', array(
        'label'	   => __( 'Blockquote Background', 'sensible-wp' ),
        'section'  => 'colors',
        'settings' => 'sensiblewp_blockquote', 
		'priority' => 45
    )));
	
	$wp_customize->add_setting( 'sensiblewp_blockquote_border', array(
        'default'     => '#ea474b', 
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sensiblewp_blockquote_border', array(
        'label'	   => __( 'Blockquote Accent Color', 'sensible-wp' ), 
        'section'  => 'colors',
        'settings' => 'sensiblewp_blockquote_border', 
		'priority' => 50
    ))); 
	
	$wp_customize->add_setting( 'sensiblewp_entry', array(
        'default'     => '#ffffff', 
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sensiblewp_entry', array(
        'label'	   => __( 'Entry Title Color', 'sensible-wp' ), 
        'section'  => 'colors',
        'settings' => 'sensiblewp_entry',  
		'priority' => 55
    )));
	
	// Nav
	$wp_customize->add_setting( 'sensiblewp_nav_link_color', array(
        'default'     => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sensiblewp_nav_link_color', array(
        'label'	   => __( 'Navigation Link Color', 'sensible-wp' ),
        'section'  => 'nav',
        'settings' => 'sensiblewp_nav_link_color',
		'priority' => 70 
    )));
	
	$wp_customize->add_setting( 'sensiblewp_nav_link_hover_color', array(
        'default'     => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sensiblewp_nav_link_hover_color', array(
        'label'	   => __( 'Navigation Link Hover Color', 'sensible-wp' ),
        'section'  => 'nav',
        'settings' => 'sensiblewp_nav_link_hover_color', 
		'priority' => 75
    )));
	
	$wp_customize->add_setting( 'sensiblewp_nav_drop_link_color', array( 
        'default'     => '#8c9398',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sensiblewp_nav_drop_link_color', array(
        'label'	   => __( 'Menu Drop Down Link Color', 'sensible-wp' ),
        'section'  => 'nav',
        'settings' => 'sensiblewp_nav_drop_link_color',
		'priority' => 105
    )));
	
	//Animations
	$wp_customize->add_section( 'sensiblewp_animations' , array(  
	    'title'       => __( 'Animations', 'sensible-wp' ),
	    'priority'    => 39, 
	    'description' => __( 'We can make things fly across the screen.', 'sensible-wp' ),
	));
	
    $wp_customize->add_setting(
        'sensiblewp_animate',
        array(
            'sanitize_callback' => 'sensiblewp_sanitize_checkbox',
            'default' => 0,
    ));
	
    $wp_customize->add_control( 
        'sensiblewp_animate',
        array(
            'type' => 'checkbox',
            'label' => __('Check this box if you want to disable the animations.', 'sensible-wp'),
            'section' => 'sensiblewp_animations',  
            'priority' => 1,           
    ));

    // Logo upload
    $wp_customize->add_section( 'sensiblewp_logo_section' , array(  
	    'title'       => __( 'Logo and Icons', 'sensible-wp' ),
	    'priority'    => 21, 
	    'description' => __( 'Upload a logo to replace the default site name and description in the header. Also, upload your site favicon and Apple Icons.', 'sensible-wp'),
	));

	$wp_customize->add_setting( 'sensiblewp_logo', array(
		'sanitize_callback' => 'esc_url_raw',
	));

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'sensiblewp_logo', array( 
		'label'    => __( 'Logo', 'sensible-wp' ),
		'type'           => 'image',
		'section'  => 'sensiblewp_logo_section', 
		'settings' => 'sensiblewp_logo',
		'priority' => 1,
	))); 
	
	// Logo Width
	$wp_customize->add_setting( 'logo_size', array(
	    'sanitize_callback' => 'sensiblewp_sanitize_text',
		'default'	        => '200'  
	));

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'logo_size', array( 
		'label'    => __( 'Change the width of the Logo in PX.', 'sensible-wp' ),
		'description'    => __( 'Only enter numeric value', 'sensible-wp' ),
		'section'  => 'sensiblewp_logo_section', 
		'settings' => 'logo_size',  
		'priority'   => 2 
	)));
	
	//Favicon Upload
	$wp_customize->add_setting(
		'site_favicon',
		array(
			'default' => (get_stylesheet_directory_uri( 'stylesheet_directory') . '/img/favicon.png'), 
			'sanitize_callback' => 'esc_url_raw',
	));
	
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'site_favicon',
            array(
               'label'          => __( 'Upload your favicon (16x16 pixels)', 'sensible-wp' ),
			   'type' 			=> 'image',
               'section'        => 'sensiblewp_logo_section',
               'settings'       => 'site_favicon',
               'priority' => 2,
    )));
	
    //Apple touch icon 144
    $wp_customize->add_setting(
        'apple_touch_144',
        array(
            'default-image' => '',
			'sanitize_callback' => 'esc_url_raw',
    ));
	
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'apple_touch_144',
            array(
               'label'          => __( 'Upload your Apple Touch Icon (144x144 pixels)', 'sensible-wp' ),
               'type'           => 'image',
               'section'        => 'sensiblewp_logo_section',
               'settings'       => 'apple_touch_144',
               'priority'       => 11,
    )));
	
    //Apple touch icon 114
    $wp_customize->add_setting(
        'apple_touch_114',
        array(
            'default-image' => '',
			'sanitize_callback' => 'esc_url_raw', 
    ));

    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'apple_touch_114',
            array(
               'label'          => __( 'Upload your Apple Touch Icon (114x114 pixels)', 'sensible-wp' ),
               'type'           => 'image',
               'section'        => 'sensiblewp_logo_section',
               'settings'       => 'apple_touch_114',
               'priority'       => 12,
    )));
	
    //Apple touch icon 72
    $wp_customize->add_setting(
        'apple_touch_72',
        array(
            'default-image' => '',
			'sanitize_callback' => 'esc_url_raw',
    ));
	
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'apple_touch_72',
            array(
               'label'          => __( 'Upload your Apple Touch Icon (72x72 pixels)', 'sensible-wp' ),
               'type'           => 'image',
               'section'        => 'sensiblewp_logo_section',
               'settings'       => 'apple_touch_72',
               'priority'       => 13,
    )));
	
    //Apple touch icon 57
    $wp_customize->add_setting(
        'apple_touch_57',
        array(
            'default-image' => '',
			'sanitize_callback' => 'esc_url_raw',
    ));
	
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'apple_touch_57',
            array(
               'label'          => __( 'Upload your Apple Touch Icon (57x57 pixels)', 'sensible-wp' ),
               'type'           => 'image',
               'section'        => 'sensiblewp_logo_section',
               'settings'       => 'apple_touch_57',
               'priority'       => 14,
    )));
	
	// Hero Section
	$wp_customize->add_section( 'sensiblewp_slider_section', array(
		'title'          => __( 'Home Hero Section', 'sensible-wp' ),
		'priority'       => 24, 
		'description' => __( 'Edit your Home Page Hero', 'sensible-wp'), 
	));
	
	$wp_customize->add_setting('active_hero',
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_checkbox',
	));
	
	$wp_customize->add_control( 
    'active_hero', 
    array(
        'type' => 'checkbox',
        'label' => __( 'Hide Hero', 'sensible-wp' ),  
        'section' => 'sensiblewp_slider_section', 
		'priority'   => 10
    )); 
	
	// Main Background
	$wp_customize->add_setting( 'sensiblewp_main_bg', array(
		'sanitize_callback' => 'esc_url_raw',
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'sensiblewp_main_bg', array( 
		'label'    => __( 'Hero Image', 'sensible-wp' ),
		'section'  => 'sensiblewp_slider_section',  
		'settings' => 'sensiblewp_main_bg', 
		'priority'   => 20
	) ) );
	
	// First Heading
	$wp_customize->add_setting( 'sensiblewp_first_heading' ,
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_text',
	    ) 
	);
	 
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'sensiblewp_first_heading', array( 
    'label' => __( 'Hero Heading', 'sensible-wp' ),    
    'section' => 'sensiblewp_slider_section',
    'settings' => 'sensiblewp_first_heading',
	'priority'   => 30
	) ) );
	
	// Hero Button Text
	$wp_customize->add_setting( 'sensiblewp_hero_button_text',
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_text', 
	    ) 
	);
	 
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'sensiblewp_hero_button_text', array( 
    'label' => __( 'Hero Button Text', 'sensible-wp' ),   
    'section' => 'sensiblewp_slider_section',
    'settings' => 'sensiblewp_hero_button_text',  
	'priority'   => 40 
	) ) );
	
	// Page Drop Downs 
	$wp_customize->add_setting('hero_button_url', array( 
		'capability' => 'edit_theme_options', 
        'sanitize_callback' => 'sensiblewp_sanitize_int' 
	));
	
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'hero_button_url', array( 
    	'label' => __( 'Hero Button URL', 'sensible-wp' ), 
    	'section' => 'sensiblewp_slider_section', 
		'type' => 'dropdown-pages',
    	'settings' => 'hero_button_url',
		'priority'   => 50 
	)));
	
	// Home Social Panel
	$wp_customize->add_panel( 'social_panel', array(
    'priority'       => 25,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Home Social Section', 'sensible-wp' ),
    'description'    		 => __( 'Edit your home page social media icons', 'sensible-wp' ),
	));
	
	// Page URL
	$wp_customize->add_setting( 'page_url_text',
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_text',
	));  

	$wp_customize->add_control( 'page_url_text', array(
		'type'     => 'url',
		'label'    => __( 'External URL Option', 'sensible-wp' ), 
		'description' => __( 'If you use an external URL, leave the Widget Button Link above empty. Must include http:// before any URL.', 'sensible-wp' ),
		'section'  => 'sensiblewp_slider_section',   
		'settings' => 'page_url_text',
		'priority'   => 60
	));  
	
	// Social Section 
	$wp_customize->add_section( 'sensiblewp_settings', array(
    	'title'          => __( 'Social Media Icons', 'sensible-wp' ),
        'priority'       => 38,
		'panel' => 'social_panel',  
    ) );
	
	// Home Social Section 
	$wp_customize->add_setting('active_social',
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_checkbox',
	)); 
	
	$wp_customize->add_control( 
    'active_social', 
    array(
        'type' => 'checkbox',
        'label' => __( 'Hide Home Social Section', 'sensible-wp' ),
        'section' => 'sensiblewp_settings', 
		'priority'   => 1
    ));
	
	// Social Text
		$wp_customize->add_setting( 'social_text',
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_text',
	    )); 

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'social_text', array(
		'label'    => __( 'Socials Heading', 'sensible-wp' ),
		'section'  => 'sensiblewp_settings', 
		'settings' => 'social_text',
		'priority'   => 1
		) ) ); 
	
	// Social Icon Colors
	$wp_customize->add_setting( 'sensiblewp_social_color', array( 
        'default'     => '#888888', 
		'sanitize_callback' => 'sanitize_hex_color',
    ));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sensiblewp_social_color', array(
        'label'	   => __( 'Social Icon Color', 'sensible-wp' ),
        'section'  => 'sensiblewp_settings',
        'settings' => 'sensiblewp_social_color', 
		'priority' => 1
    )));
	
	$wp_customize->add_setting( 'sensiblewp_social_color_hover', array( 
        'default'     => '#888888',  
		'sanitize_callback' => 'sanitize_hex_color',  
    ));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sensiblewp_social_color_hover', array(
        'label'	   => __( 'Social Icon Hover Color', 'sensible-wp' ),
        'section'  => 'sensiblewp_settings',
        'settings' => 'sensiblewp_social_color_hover', 
		'priority' => 2
    )));
	
	// Facebook
	$wp_customize->add_setting( 'sensiblewp_fb',
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_text', 
	));  

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'sensiblewp_fb', array(
		'label'    => __( 'Facebook URL:', 'sensible-wp' ),
		'section'  => 'sensiblewp_settings', 
		'settings' => 'sensiblewp_fb',
		'priority'   => 2
	))); 
	
	// Twitter
	$wp_customize->add_setting( 'sensiblewp_twitter',
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_text', 
	));  

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'sensiblewp_twitter', array(
		'label'    => __( 'Twitter URL:', 'sensible-wp' ),
		'section'  => 'sensiblewp_settings', 
		'settings' => 'sensiblewp_twitter',
		'priority'   => 3
	))); 
	
	// LinkedIn
	$wp_customize->add_setting( 'sensiblewp_linked',
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_text', 
	));  

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'sensiblewp_linked', array(
		'label'    => __( 'LinkedIn URL:', 'sensible-wp' ),
		'section'  => 'sensiblewp_settings', 
		'settings' => 'sensiblewp_linked',
		'priority'   => 4
	)));
	
	// Google Plus
	$wp_customize->add_setting( 'sensiblewp_google',
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_text', 
	));  

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'sensiblewp_google', array(
		'label'    => __( 'Google Plus URL:', 'sensible-wp' ),
		'section'  => 'sensiblewp_settings', 
		'settings' => 'sensiblewp_google',
		'priority'   => 5
	)));
	
	// Instagram
	$wp_customize->add_setting( 'sensiblewp_instagram',
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_text', 
	));  

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'sensiblewp_instagram', array(
		'label'    => __( 'Instagram URL:', 'sensible-wp' ),
		'section'  => 'sensiblewp_settings', 
		'settings' => 'sensiblewp_instagram',
		'priority'   => 6 
	)));
	
	// Flickr
	$wp_customize->add_setting( 'sensiblewp_flickr',
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_text', 
	));  

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'sensiblewp_flickr', array(
		'label'    => __( 'Flickr URL:', 'sensible-wp' ),
		'section'  => 'sensiblewp_settings', 
		'settings' => 'sensiblewp_flickr',
		'priority'   => 7
	)));
	
	// Pinterest
	$wp_customize->add_setting( 'sensiblewp_pinterest',
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_text', 
	));  

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'sensiblewp_pinterest', array(
		'label'    => __( 'Pinterest URL:', 'sensible-wp' ),
		'section'  => 'sensiblewp_settings', 
		'settings' => 'sensiblewp_pinterest',
		'priority'   => 8
	)));
	
	// Youtube
	$wp_customize->add_setting( 'sensiblewp_youtube',
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_text', 
	));  

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'sensiblewp_youtube', array(
		'label'    => __( 'YouTube URL:', 'sensible-wp' ),
		'section'  => 'sensiblewp_settings', 
		'settings' => 'sensiblewp_youtube',  
		'priority'   => 9
	)));
	
	// Vimeo
	$wp_customize->add_setting( 'sensiblewp_vimeo',
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_text', 
	));  

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'sensiblewp_vimeo', array(
		'label'    => __( 'Vimeo URL:', 'sensible-wp' ),
		'section'  => 'sensiblewp_settings', 
		'settings' => 'sensiblewp_vimeo',
		'priority'   => 10
	)));
	
	// Tumblr
	$wp_customize->add_setting( 'sensiblewp_tumblr',
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_text', 
	));  

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'sensiblewp_tumblr', array(
		'label'    => __( 'Tumblr URL:', 'sensible-wp' ),
		'section'  => 'sensiblewp_settings', 
		'settings' => 'sensiblewp_tumblr', 
		'priority'   => 11 
	)));
	
	// Dribbble
	$wp_customize->add_setting( 'sensiblewp_dribbble',
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_text', 
	));  

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'sensiblewp_dribbble', array(
		'label'    => __( 'Dribbble URL:', 'sensible-wp' ),
		'section'  => 'sensiblewp_settings', 
		'settings' => 'sensiblewp_dribbble',
		'priority'   => 12
	)));
	
	// RSS
	$wp_customize->add_setting( 'sensiblewp_rss',
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_text', 
	));  

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'sensiblewp_rss', array(
		'label'    => __( 'RSS URL:', 'sensible-wp' ),
		'section'  => 'sensiblewp_settings', 
		'settings' => 'sensiblewp_rss',
		'priority'   => 13 
	)));
	
	// Home Intro Panel
	$wp_customize->add_panel( 'intro_panel', array(
    'priority'       => 26,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Home Intro Section', 'sensible-wp' ),
    'description'    		 => __( 'Edit your home page intro settings', 'sensible-wp' ),
	));
	
	// Home Intro Section
	$wp_customize->add_section( 'sensiblewp_intro_section', array(
		'title'          => __( 'Home Intro Section', 'sensible-wp' ),
		'priority'       => 10,
		'description' => __( 'Edit your home page Intro section content', 'sensible-wp' ), 
		'panel' => 'intro_panel',
	));
	
	// Home Intro Section
	$wp_customize->add_setting('active_intro',
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_checkbox',
	    ) 
	); 
	
	$wp_customize->add_control( 
    'active_intro', 
    array(
        'type' => 'checkbox',
        'label' => __( 'Hide Home Intro Section', 'sensible-wp' ),
        'section' => 'sensiblewp_intro_section', 
		'priority'   => 1  
    ));
	
	// Intro Text
	$wp_customize->add_setting( 'intro_text' ,
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_text',
	));
	
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'intro_text', array(
		'label'    => __( 'Intro Title Text', 'sensible-wp' ),
		'section'  => 'sensiblewp_intro_section', 
		'settings' => 'intro_text', 
		'priority'   => 2
	)));
	
	// Intro Text Box
	$wp_customize->add_setting( 'intro_textbox' ,
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_text', 
	)); 
	 
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'intro_textbox', array( 
    'label' => __( 'Intro Text Box', 'sensible-wp' ),
    'section' => 'sensiblewp_intro_section',
    'settings' => 'intro_textbox', 
	'type'     => 'textarea', 
	'priority'   => 3
	)));
	
	// Home Services Panel
	$wp_customize->add_panel( 'services_panel', array(
    'priority'       => 27,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Home Services Section', 'sensible-wp' ),
    'description'    => __( 'Edit your home page Services settings.', 'sensible-wp'),
	) );
	
	// Home Services Section
	$wp_customize->add_section( 'sensiblewp_services_section', array(
		'title'          => __( 'Home Services Content', 'sensible-wp' ),
		'priority'       => 10,
		'description' => __( 'Edit your home page Services content.', 'sensible-wp'), 
		'panel' => 'services_panel',  
	));

	$wp_customize->add_setting('active_services', 
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_checkbox',
	    ) 
	);  
	
	$wp_customize->add_control( 
    'active_services', 
    array(
        'type' => 'checkbox',
        'label' => __( 'Hide Services Section', 'sensible-wp' ), 
        'section' => 'sensiblewp_services_section', 
		'priority'   => 10
    ));
	
	// Services Text
	$wp_customize->add_setting( 'services_text',
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_text',
	    ) 
	); 

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'services_text', array(
		'label'    => __( 'Services Title Text', 'sensible-wp' ),
		'section'  => 'sensiblewp_services_section', 
		'settings' => 'services_text', 
		'priority'   => 20
	) ) );
	
	// Services Button Area
	$wp_customize->add_setting( 'service_button_text',
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_text',
	    ) 
	); 

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'service_button_text', array(
		'label'    => __( 'Services Button Text', 'sensible-wp' ),
		'section'  => 'sensiblewp_services_section', 
		'settings' => 'service_button_text', 
		'priority'   => 30 
	) ) );
	
	// Page Drop Downs 
	$wp_customize->add_setting('service_button_url', array( 
		'capability' => 'edit_theme_options', 
        'sanitize_callback' => 'sensiblewp_sanitize_int' 
	));
	
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'service_button_url', array( 
    	'label' => __( 'Service Button URL', 'sensible-wp' ), 
    	'section' => 'sensiblewp_services_section', 
		'type' => 'dropdown-pages',
    	'settings' => 'service_button_url',
		'priority'   => 40
	)));
    
	
	// Number of Services 
	$wp_customize->add_setting( 'sensiblewp_services_numbers', array(
		'default'	        => 'option1',
		'sanitize_callback' => 'sensiblewp_sanitize_service_content', 
	));

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'sensiblewp_services_numbers', array(
		'label'    => __( 'Number of services to display', 'sensible-wp' ),
		'section'  => 'sensiblewp_services_section',
		'settings' => 'sensiblewp_services_numbers',
		'type'     => 'radio',
		'priority'   => 50, 
		'choices'  => array(
			'option1' => 'All',
			'option2' => '2', 
			'option3' => '1', 
			),
	)));
	
	// Home Service Box 1 Section
	$wp_customize->add_section( 'sensiblewp_services_box_1', array(
		'title'          => __( 'Services Box 1', 'sensible-wp' ),
		'priority'       => 20,
		'description' => __( 'Edit your home page services box 1. Choose from any of <a href="http://fortawesome.github.io/Font-Awesome/cheatsheet/" target="_blank">these icons</a>. Example: "fa-arrow-right".', 'sensible-wp'),
		'panel' => 'services_panel', 
	));
	
	$wp_customize->add_setting('active_service_1', 
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_checkbox',
	    ) 
	);  
	
	$wp_customize->add_control( 
    'active_service_1', 
    array(
        'type' => 'checkbox',
        'label' => __( 'Hide Service Box 1', 'sensible-wp' ),
        'section' => 'sensiblewp_services_box_1', 
		'priority'   => 1
    ));
	
	// Service Icon 1
	$wp_customize->add_setting( 'service_icon_1',
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_text', 
	));  

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'service_icon_1', array(
		'label'    => __( 'Service Icon 1', 'sensible-wp' ),
		'section'  => 'sensiblewp_services_box_1', 
		'settings' => 'service_icon_1', 
		'priority'   => 2
	)));
	
	// Service Title 1
	$wp_customize->add_setting( 'service_title_1',
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_text', 
	));  

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'service_title_1', array(
		'label'    => __( 'Service Title 1', 'sensible-wp' ),
		'section'  => 'sensiblewp_services_box_1',
		'settings' => 'service_title_1', 
		'priority'   => 3
	)));
	
	// Service Text 1
	$wp_customize->add_setting( 'service_text_1' ,
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_text',
	)); 
	 
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'service_text_1', array( 
    'label' => __( 'Service Text Box 1', 'sensible-wp' ), 
    'section' => 'sensiblewp_services_box_1',
    'settings' => 'service_text_1', 
	'type'     => 'textarea', 
	'priority'   => 4
	)));
	
	// Home Service Box 2 Section
	$wp_customize->add_section( 'sensiblewp_services_box_2', array(
		'title'          => __( 'Services Box 2', 'sensible-wp' ),
		'priority'       => 30,
		'description' => __( 'Edit your home page services box 2. Choose from any of <a href="http://fortawesome.github.io/Font-Awesome/cheatsheet/" target="_blank">these icons</a>. Example: "fa-arrow-right".', 'sensible-wp' ),
		'panel' => 'services_panel', 
	));
	
	$wp_customize->add_setting('active_service_2', 
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_checkbox',
	    ) 
	);  
	
	$wp_customize->add_control( 
    'active_service_2', 
    array(
        'type' => 'checkbox',
        'label' => __( 'Hide Service Box 2', 'sensible-wp' ),
        'section' => 'sensiblewp_services_box_2', 
		'priority'   => 1
    ));
	
	// Service Icon 2
	$wp_customize->add_setting( 'service_icon_2',
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_text', 
	));  

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'service_icon_2', array(
		'label'    => __( 'Service Icon 2', 'sensible-wp' ),
		'section'  => 'sensiblewp_services_box_2', 
		'settings' => 'service_icon_2', 
		'priority'   => 2
	)));
	
	// Service Title 2
	$wp_customize->add_setting( 'service_title_2',
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_text', 
	));  

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'service_title_2', array(
		'label'    => __( 'Service Title 2', 'sensible-wp' ),
		'section'  => 'sensiblewp_services_box_2',
		'settings' => 'service_title_2', 
		'priority'   => 3
	)));
	
	// Service Text 2
	$wp_customize->add_setting( 'service_text_2' ,
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_text',
	)); 
	 
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'service_text_2', array( 
    'label' => __( 'Service Text Box 2', 'sensible-wp' ), 
    'section' => 'sensiblewp_services_box_2',
    'settings' => 'service_text_2', 
	'type'     => 'textarea', 
	'priority'   => 4
	)));
	
	// Home Service Box 3 Section
	$wp_customize->add_section( 'sensiblewp_services_box_3', array(
		'title'          => __( 'Services Box 3', 'sensible-wp' ),
		'priority'       => 40,
		'description' => __( 'Edit your home page services box 3. Choose from any of <a href="http://fortawesome.github.io/Font-Awesome/cheatsheet/" target="_blank">these icons</a>. Example: "fa-arrow-right".', 'sensible-wp'),
		'panel' => 'services_panel',  
	));
	
	$wp_customize->add_setting('active_service_3', 
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_checkbox',
	    ) 
	);  
	
	$wp_customize->add_control( 
    'active_service_3', 
    array(
        'type' => 'checkbox',
        'label' => __( 'Hide Service Box 3', 'sensible-wp' ),
        'section' => 'sensiblewp_services_box_3', 
		'priority'   => 1
    ));
	
	// Service Icon 3
	$wp_customize->add_setting( 'service_icon_3',
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_text', 
	));  

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'service_icon_3', array(
		'label'    => __( 'Service Icon 3', 'sensible-wp' ),
		'section'  => 'sensiblewp_services_box_3', 
		'settings' => 'service_icon_3', 
		'priority'   => 2
	)));
	
	// Service Title 3
	$wp_customize->add_setting( 'service_title_3',
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_text', 
	));  

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'service_title_3', array(
		'label'    => __( 'Service Title 3', 'sensible-wp' ),
		'section'  => 'sensiblewp_services_box_3',
		'settings' => 'service_title_3', 
		'priority'   => 3
	)));
	
	// Service Text 3
	$wp_customize->add_setting( 'service_text_3' ,
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_text',
	)); 
	 
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'service_text_3', array( 
    'label' => __( 'Service Text Box 3', 'sensible-wp' ), 
    'section' => 'sensiblewp_services_box_3',
    'settings' => 'service_text_3',
	'type'     => 'textarea', 
	'priority'   => 4
	))); 
	
	// Blog Panel
	$wp_customize->add_panel( 'blog_panel', array(
    'priority'       => 28,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Home Blog Section', 'sensible-wp' ),
    'description' 			 => __( 'Edit your home page blog settings', 'sensible-wp' ),
	));
	
	// Home Blog Section
	$wp_customize->add_section( 'sensiblewp_blog_section', array(
		'title'          => __( 'Home Blog Section', 'sensible-wp' ),
		'priority'       => 10,
		'description' => __( 'Edit your home page Blog section', 'sensible-wp' ),
		'panel' => 'blog_panel',
	));

	$wp_customize->add_setting('active_blog',
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_checkbox',
	));
	
	$wp_customize->add_control( 
    'active_blog', 
    array(
        'type' => 'checkbox',
        'label' => __( 'Hide Blog Section', 'sensible-wp' ), 
        'section' => 'sensiblewp_blog_section',
		'priority'   => 1 
    ));
	
	// Blog Text
	$wp_customize->add_setting( 'blog_text',
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_text', 
	));  

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'blog_text', array(
		'label'    => __( 'Blog Title Text', 'sensible-wp' ),
		'section'  => 'sensiblewp_blog_section', 
		'settings' => 'blog_text', 
		'priority'   => 2
	)));
	
	// Blog CTA
	$wp_customize->add_setting( 'blog_cta', array(
	    'sanitize_callback' => 'sensiblewp_sanitize_text',
	)); 

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'blog_cta', array(
		'label'    => __( 'Blog Call-to-Action', 'sensible-wp' ),
		'section'  => 'sensiblewp_blog_section', 
		'settings' => 'blog_cta', 
		'priority'   => 2 
	)));
	
	// Team Panel
	$wp_customize->add_panel( 'team_panel', array(
    'priority'       => 29,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Home Team Member Section', 'sensible-wp' ),
    'description'    		 => __( 'Edit your home page team member settings', 'sensible-wp' ),
	));
	
	// Home Team Section
	$wp_customize->add_section( 'sensiblewp_team_section', array(
		'title'          => __( 'Home Team Section', 'sensible-wp' ), 
		'priority'       => 10,
		'description' 			 => __( 'Edit your home page Team section', 'sensible-wp'),
		'panel' 		 => 'team_panel',   
	));

	$wp_customize->add_setting('active_team',
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_checkbox',
	));
	
	$wp_customize->add_control( 
    'active_team', 
    array(
        'type' => 'checkbox',
        'label' => __( 'Hide Team Section Content', 'sensible-wp' ),  
        'section' => 'sensiblewp_team_section',
		'priority'   => 10 
    ));
	
	// Team Text
	$wp_customize->add_setting( 'team_text',
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_text', 
	));  

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'team_text', array(
		'label'    => __( 'Team Title Text', 'sensible-wp' ),
		'section'  => 'sensiblewp_team_section', 
		'settings' => 'team_text', 
		'priority'   => 20
	))); 

	$wp_customize->add_setting('active_team',
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_checkbox',
	));
	
	// Team Member Button Area
	$wp_customize->add_setting( 'team_button_text',
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_text',
	    ) 
	); 

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'team_button_text', array(
		'label'    => __( 'Team Member Button Text', 'sensible-wp' ),
		'section'  => 'sensiblewp_team_section', 
		'settings' => 'team_button_text', 
		'priority'   => 30
	) ) );
	
	// Team Member Page Drop Downs 
	$wp_customize->add_setting('team_button_url', array( 
		'capability' => 'edit_theme_options', 
        'sanitize_callback' => 'sensiblewp_sanitize_int' 
	));
	
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'team_button_url', array( 
    	'label' => __( 'Team Member Button URL', 'sensible-wp' ), 
    	'section' => 'sensiblewp_team_section', 
		'type' => 'dropdown-pages',
    	'settings' => 'team_button_url', 
		'priority'   => 40
	)));
	
	// Number of Team Members
	$wp_customize->add_setting( 'sensiblewp_member_numbers', array(
		'default'	        => 'option1',
		'sanitize_callback' => 'sensiblewp_sanitize_member_content',   
	));

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'sensiblewp_member_numbers', array(
		'label'    => __( 'Number of team members to display', 'sensible-wp' ),
		'section'  => 'sensiblewp_team_section',
		'settings' => 'sensiblewp_member_numbers',
		'type'     => 'radio', 
		'priority'   => 50,  
		'choices'  => array(
			'option1' => 'All', 
			'option2' => '2', 
			'option3' => '1' 
			),
	)));
	
	// Home Team Member 1
	$wp_customize->add_section( 'sensiblewp_team_member_1', array(
		'title'          => __( 'Team Member 1', 'sensible-wp' ),  
		'priority'       => 20,
		'description' => __( 'Edit your Team Member 1', 'sensible-wp' ),
		'panel' => 'team_panel',   
	));
	
	$wp_customize->add_setting('active_member_1', 
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_checkbox',
	    ) 
	);  
	
	$wp_customize->add_control( 
    'active_member_1', 
    array(
        'type' => 'checkbox',
        'label' => __( 'Hide Member Box 1', 'sensible-wp' ),
        'section' => 'sensiblewp_team_member_1', 
		'priority'   => 1
    ));
	
	// Team Member Picture 1
	$wp_customize->add_setting( 'member_image_1', array(    
		'sanitize_callback' => 'esc_url_raw',
	));

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'member_image_1', array( 
		'label'    => __( 'Team Member Image 1', 'sensible-wp' ), 
		'section'  => 'sensiblewp_team_member_1',  
		'settings' => 'member_image_1',  
		'priority'   => 2
	))); 
	
	// Team Member Name 1
	$wp_customize->add_setting( 'member_name_1',
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_text', 
	));  

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'member_name_1', array(
		'label'    => __( 'Team Member Name 1', 'sensible-wp' ),
		'section'  => 'sensiblewp_team_member_1', 
		'settings' => 'member_name_1',
		'priority'   => 3
	))); 
	
	// Team Member Text 1
	$wp_customize->add_setting( 'member_text_1' ,
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_text',
	)); 
	 
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'member_text_1', array( 
    'label' => __( 'Team Member Text Box 1', 'sensible-wp' ), 
    'section' => 'sensiblewp_team_member_1',
    'settings' => 'member_text_1', 
	'type'     => 'textarea', 
	'priority'   => 4
	)));
	
	// Team Member Facebook 1
	$wp_customize->add_setting( 'member_fb_1',
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_text', 
	));  

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'member_fb_1', array(
		'label'    => __( 'Team Member Facebook 1', 'sensible-wp' ),
		'section'  => 'sensiblewp_team_member_1', 
		'settings' => 'member_fb_1',
		'priority'   => 5
	))); 
	
	// Team Member Twitter 1
	$wp_customize->add_setting( 'member_twitter_1',
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_text', 
	));  

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'member_twitter_1', array(
		'label'    => __( 'Team Member Twitter 1', 'sensible-wp' ),
		'section'  => 'sensiblewp_team_member_1', 
		'settings' => 'member_twitter_1',
		'priority'   => 6
	))); 
	
	// Team Member LinkedIn 1
	$wp_customize->add_setting( 'member_linked_1',
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_text', 
	));  

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'member_linked_1', array(
		'label'    => __( 'Team Member LinkedIn 1', 'sensible-wp' ),
		'section'  => 'sensiblewp_team_member_1', 
		'settings' => 'member_linked_1',
		'priority'   => 7
	))); 
	
	// Team Member Google 1
	$wp_customize->add_setting( 'member_google_1',
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_text', 
	));  

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'member_google_1', array(
		'label'    => __( 'Team Member Google 1', 'sensible-wp' ),
		'section'  => 'sensiblewp_team_member_1', 
		'settings' => 'member_google_1',
		'priority'   => 8
	))); 
	
	// Team Member Email 1
	$wp_customize->add_setting( 'member_email_1',
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_text', 
	));  

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'member_email_1', array(
		'label'    => __( 'Team Member Email 1', 'sensible-wp' ),
		'section'  => 'sensiblewp_team_member_1', 
		'settings' => 'member_email_1',
		'priority'   => 9
	)));  
	
	// Home Team Member 2
	$wp_customize->add_section( 'sensiblewp_team_member_2', array(
		'title'          => __( 'Team Member 2', 'sensible-wp' ),  
		'priority'       => 30,
		'description' => __( 'Edit your Team Member 2', 'sensible-wp' ),
		'panel' => 'team_panel',   
	));
	
	$wp_customize->add_setting('active_member_2', 
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_checkbox',
	    ) 
	);  
	
	$wp_customize->add_control( 
    'active_member_2', 
    array(
        'type' => 'checkbox',
        'label' => __( 'Hide Member Box 2', 'sensible-wp' ),  
        'section' => 'sensiblewp_team_member_2', 
		'priority'   => 1
    ));
	
	// Team Member Picture 2
	$wp_customize->add_setting( 'member_image_2', array(    
		'sanitize_callback' => 'esc_url_raw',
	));

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'member_image_2', array( 
		'label'    => __( 'Team Member Image 2', 'sensible-wp' ), 
		'section'  => 'sensiblewp_team_member_2',  
		'settings' => 'member_image_2',  
		'priority'   => 2
	))); 
	
	// Team Member Name 2
	$wp_customize->add_setting( 'member_name_2',
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_text', 
	));  

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'member_name_2', array(
		'label'    => __( 'Team Member Name 2', 'sensible-wp' ),
		'section'  => 'sensiblewp_team_member_2', 
		'settings' => 'member_name_2',
		'priority'   => 3
	))); 
	
	// Team Member Text 2
	$wp_customize->add_setting( 'member_text_2' ,
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_text',
	)); 
	 
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'member_text_2', array( 
    'label' => __( 'Team Member Text Box 2', 'sensible-wp' ), 
    'section' => 'sensiblewp_team_member_2',
    'settings' => 'member_text_2', 
	'type'     => 'textarea', 
	'priority'   => 4
	)));
	
	// Team Member Facebook 2
	$wp_customize->add_setting( 'member_fb_2',
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_text', 
	));  

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'member_fb_2', array(
		'label'    => __( 'Team Member Facebook 2', 'sensible-wp' ),
		'section'  => 'sensiblewp_team_member_2', 
		'settings' => 'member_fb_2',
		'priority'   => 5
	))); 
	
	// Team Member Twitter 2
	$wp_customize->add_setting( 'member_twitter_2',
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_text', 
	));  

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'member_twitter_2', array(
		'label'    => __( 'Team Member Twitter 2', 'sensible-wp' ),
		'section'  => 'sensiblewp_team_member_2', 
		'settings' => 'member_twitter_2',
		'priority'   => 6
	))); 
	
	// Team Member LinkedIn 2
	$wp_customize->add_setting( 'member_linked_2',
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_text', 
	));  

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'member_linked_2', array(
		'label'    => __( 'Team Member LinkedIn 2', 'sensible-wp' ),
		'section'  => 'sensiblewp_team_member_2', 
		'settings' => 'member_linked_2',
		'priority'   => 7
	))); 
	
	// Team Member Google 2
	$wp_customize->add_setting( 'member_google_2',
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_text', 
	));  

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'member_google_2', array(
		'label'    => __( 'Team Member Google 2', 'sensible-wp' ),
		'section'  => 'sensiblewp_team_member_2', 
		'settings' => 'member_google_2',
		'priority'   => 8
	))); 
	
	// Team Member Email 2
	$wp_customize->add_setting( 'member_email_2',
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_text', 
	));  

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'member_email_2', array(
		'label'    => __( 'Team Member Email 2', 'sensible-wp' ),
		'section'  => 'sensiblewp_team_member_2', 
		'settings' => 'member_email_2',
		'priority'   => 9
	)));  
	
	// Home Team Member 3
	$wp_customize->add_section( 'sensiblewp_team_member_3', array(
		'title'          => __( 'Team Member 3', 'sensible-wp' ), 
		'priority'       => 40,
		'description' => __( 'Edit your Team Member 3', 'sensible-wp' ),
		'panel' => 'team_panel',   
	));
	
	$wp_customize->add_setting('active_member_3', 
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_checkbox',
	    ) 
	);  
	
	$wp_customize->add_control( 
    'active_member_3', 
    array(
        'type' => 'checkbox',
        'label' => __( 'Hide Member Box 3', 'sensible-wp' ), 
        'section' => 'sensiblewp_team_member_3', 
		'priority'   => 1
    ));
	
	// Team Member Picture 3
	$wp_customize->add_setting( 'member_image_3', array(    
		'sanitize_callback' => 'esc_url_raw',
	));

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'member_image_3', array( 
		'label'    => __( 'Team Member Image 3', 'sensible-wp' ), 
		'section'  => 'sensiblewp_team_member_3',  
		'settings' => 'member_image_3',  
		'priority'   => 2
	))); 
	
	// Team Member Name 3
	$wp_customize->add_setting( 'member_name_3',
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_text', 
	));  

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'member_name_3', array(
		'label'    => __( 'Team Member Name 3', 'sensible-wp' ),
		'section'  => 'sensiblewp_team_member_3', 
		'settings' => 'member_name_3',
		'priority'   => 3
	))); 
	
	// Team Member Text 3
	$wp_customize->add_setting( 'member_text_3' ,
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_text',
	)); 
	 
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'member_text_3', array( 
    'label' => __( 'Team Member Text Box 3', 'sensible-wp' ), 
    'section' => 'sensiblewp_team_member_3',
    'settings' => 'member_text_3', 
	'type'     => 'textarea', 
	'priority'   => 4
	)));
	
	// Team Member Facebook 3
	$wp_customize->add_setting( 'member_fb_3',
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_text', 
	));  

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'member_fb_3', array(
		'label'    => __( 'Team Member Facebook 3', 'sensible-wp' ),
		'section'  => 'sensiblewp_team_member_3', 
		'settings' => 'member_fb_3',
		'priority'   => 5
	))); 
	
	// Team Member Twitter 3
	$wp_customize->add_setting( 'member_twitter_3',
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_text', 
	));  

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'member_twitter_3', array(
		'label'    => __( 'Team Member Twitter 3', 'sensible-wp' ),
		'section'  => 'sensiblewp_team_member_3', 
		'settings' => 'member_twitter_3',
		'priority'   => 6
	))); 
	
	// Team Member LinkedIn 3
	$wp_customize->add_setting( 'member_linked_3',
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_text', 
	));  

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'member_linked_3', array(
		'label'    => __( 'Team Member LinkedIn 3', 'sensible-wp' ),
		'section'  => 'sensiblewp_team_member_3', 
		'settings' => 'member_linked_3',
		'priority'   => 7
	))); 
	
	// Team Member Google 3
	$wp_customize->add_setting( 'member_google_3',
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_text', 
	));  

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'member_google_3', array(
		'label'    => __( 'Team Member Google 3', 'sensible-wp' ),
		'section'  => 'sensiblewp_team_member_3', 
		'settings' => 'member_google_3',
		'priority'   => 8
	))); 
	
	// Team Member Email 3
	$wp_customize->add_setting( 'member_email_3',
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_text', 
	));  

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'member_email_3', array(
		'label'    => __( 'Team Member Email 3', 'sensible-wp' ),
		'section'  => 'sensiblewp_team_member_3', 
		'settings' => 'member_email_3',
		'priority'   => 9 
	)));
	
	// Widget Panel
	$wp_customize->add_panel( 'widget_panel', array(
    'priority'       => 30,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Home Widget Section', 'sensible-wp' ),
    'description'    => __( 'Edit your home page widget settings. The main body of the widget area can be edited under the Widgets section below.', 'sensible-wp' ),
	));
	
	// Home Widget Section
	$wp_customize->add_section( 'sensiblewp_widget_section', array(
		'title'          => __( 'Home Widget Section', 'sensible-wp' ), 
		'priority'       => 10,
		'description' => __( 'Customize the home widget area. The main body of the widget area can be edited under the Widgets section below.', 'sensible-wp' ),
		'panel' => 'widget_panel', 
	));
	
	// Number of Widget Columns 
	$wp_customize->add_setting( 'sensiblewp_widget_columns', array(
		'default'	        => 'option1',
		'sanitize_callback' => 'sensiblewp_sanitize_widget_content',
	));

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'sensiblewp_widget_columns', array(
		'label'    => __( 'Number of Widget Columns', 'sensible-wp' ),
		'description'    => __( 'Select the number of widget columns to use. 1 Column will take up the entire widget area, while 4 columns will give space to use 4 widgets for content.', 'sensible-wp' ),
		'section'  => 'sensiblewp_widget_section', 
		'settings' => 'sensiblewp_widget_columns',
		'type'     => 'radio',
		'priority'   => 5,  
		'choices'  => array(
			'option1' => __( '1 Column', 'sensible-wp' ),
			'option2' => __( '2 Columns', 'sensible-wp' ), 
			'option3' => __( '3 Columns', 'sensible-wp' ),
			'option4' => __( '4 Columns', 'sensible-wp' ),
			),
	)));
	
	//New Widget Background Image
	$wp_customize->add_setting( 'sensiblewp_new_widget_area_background',
		array(
			'sanitize_callback' => 'esc_url_raw',
	));
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'sensiblewp_new_widget_area_background', array(
		'label'	=> __( 'Widget Background Area', 'sensible' ),
		'type'           => 'image',
		'section'	=> 'sensiblewp_widget_section',
		'settings' => 'sensiblewp_new_widget_area_background', 
		'priority'	=> 20
	)));
	
	// Icon
	$wp_customize->add_setting( 'home_widget_icon' , array( 
		'default' => 'fa-paper-plane',
	    'sanitize_callback' => 'sensiblewp_sanitize_text' 
	));
	 
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'home_widget_icon', array(
		'description' => __( 'Choose from any of <a href="http://fortawesome.github.io/Font-Awesome/cheatsheet/" target="_blank">these icons</a>. Example: "fa-arrow-right".', 'sensible-wp' ), 
    	'label' => __( 'Widget Icon', 'sensible-wp' ),  
    	'section' => 'sensiblewp_widget_section',
    	'settings' => 'home_widget_icon',
		'priority'   => 30
	))); 

	// hide section
	$wp_customize->add_setting('active_home_widget',
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_checkbox',
	));
	
	$wp_customize->add_control( 
    'active_home_widget', 
    array(
        'type' => 'checkbox',
        'label' => __( 'Hide Widget Section', 'sensible-wp' ),  
        'section' => 'sensiblewp_widget_section',
		'priority'   => 1
    ));
	
	// Widget Text
	$wp_customize->add_setting('sensiblewp_widget_button_text', array(
		'sanitize_callback' => 'sensiblewp_sanitize_text' 
	));
	
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'sensiblewp_widget_button_text', array(
		'label' => __( 'Widget Button Text', 'sensible-wp' ),
		'section' => 'sensiblewp_widget_section',
		'settings' => 'sensiblewp_widget_button_text',
		'priority' => 40
	)));
	
	//Page Drop Downs
	$wp_customize->add_setting( 'sensiblewp_widget_button_url', array(
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'absint' 
	));
	
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'sensiblewp_widget_button_url', array(
		'label' => __( 'Widget Button URL', 'sensible-wp' ),
		'section' => 'sensiblewp_widget_section',
		'type' => 'dropdown-pages',
		'settings' => 'sensiblewp_widget_button_url',
		'priority' => 50
	))); 
	
	// Footer Panel
	$wp_customize->add_panel( 'sensiblewp_footer_panel', array(
    'priority'       => 32, 
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Footer Options', 'sensible-wp' ),
    'description'    		 => __( 'Edit your footer options', 'sensible-wp' ),
	)); 
	 
	// Add Footer Section
	$wp_customize->add_section( 'footer-custom' , array(
    	'title' => __( 'Footer', 'sensible-wp' ),
    	'priority' => 32,
    	'description' => __( 'Customize your footer area', 'sensible-wp' ),
		'panel' => 'sensiblewp_footer_panel' 
	) );
	
	// Hide Footer Section 
	$wp_customize->add_setting('active_footer_contact',
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_checkbox',
	)); 
	
	$wp_customize->add_control( 
    'active_footer_contact', 
    array(
        'type' => 'checkbox',
        'label' => __( 'Hide Footer Top Section', 'sensible-wp' ), 
        'section' => 'footer-custom', 
		'priority'   => 12 
    ));
	
	// Footer Social Section 
	$wp_customize->add_setting('active_footer_social',
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_checkbox',
	)); 
	
	$wp_customize->add_control( 
    'active_footer_social', 
    array(
        'type' => 'checkbox',
        'label' => __( 'Hide Footer Social Section', 'sensible-wp' ),
        'section' => 'footer-custom', 
		'priority'   => 10
    ));
	
	// Social Text
		$wp_customize->add_setting( 'footer_social_text',
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_text',
	    )); 

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'footer_social_text', array(
		'label'    => __( 'Footer Social Heading', 'sensible-wp' ),
		'section'  => 'footer-custom',
		'settings' => 'footer_social_text', 
		'priority'   => 11
		) ) ); 
	
	// Phone Text
	$wp_customize->add_setting( 'footer_title_text',
	array(
	    'sanitize_callback' => 'sensiblewp_sanitize_text',
	) 
	);

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'footer_title_text', array(
		'label'    => __( 'Footer Title Text', 'sensible-wp' ),
		'section'  => 'footer-custom', 
		'settings' => 'footer_title_text', 
		'priority'   => 20
	) ) );
	
	// Bottom Footer Icon 1
	$wp_customize->add_setting( 'bottom_footer_icon_1', array( 
		'default' => 'fa-map-marker',
	    'sanitize_callback' => 'sensiblewp_sanitize_text',
	));
	 
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'bottom_footer_icon_1', array(  
    'label' => __( 'First Icon', 'sensible-wp' ),  
    'section' => 'footer-custom', 
    'settings' => 'bottom_footer_icon_1', 
	'priority'   => 30 
	)));
	
	// Address Text
	$wp_customize->add_setting( 'first_text',
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_text',
	)); 

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'first_text', array(
		'label'    => __( 'Footer First Text', 'sensible-wp' ),
		'section'  => 'footer-custom', 
		'settings' => 'first_text', 
		'priority'   => 40
	)));
	
	// Footer Address
	$wp_customize->add_setting( 'sensiblewp_footer_first',
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_text',
	));
	
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'sensiblewp_footer_first', array( 
    'label' => __( 'Footer First Column', 'sensible-wp' ),
    'section' => 'footer-custom',
    'settings' => 'sensiblewp_footer_first', 
	'type'     => 'textarea', 
	'priority'   => 50
	) ) );
	
	// Bottom Footer Icon 2
	$wp_customize->add_setting( 'bottom_footer_icon_2' , array( 
		'default' => 'fa-mobile',
	    'sanitize_callback' => 'sensiblewp_sanitize_text'
	)); 
	
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'bottom_footer_icon_2', array(  
    'label' => __( 'Second Icon', 'sensible-wp' ),  
    'section' => 'footer-custom',
    'settings' => 'bottom_footer_icon_2',
	'priority'   => 60
	)));
	
	// Phone Text
	$wp_customize->add_setting( 'second_text',
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_text',
	));
		
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'second_text', array(
		'label'    => __( 'Footer Second Text', 'sensible-wp' ),
		'section'  => 'footer-custom', 
		'settings' => 'second_text', 
		'priority'   => 70
	)));
	
	// Footer Phone
	$wp_customize->add_setting( 'sensiblewp_footer_second',
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_text', 
	));
	 
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'sensiblewp_footer_second', array(
    'label' => __( 'Footer Second Column', 'sensible-wp' ),
    'section' => 'footer-custom',
    'settings' => 'sensiblewp_footer_second',
	'type'     => 'textarea',   
	'priority'   => 80
	)));
	
	// Bottom Footer Icon 3
	$wp_customize->add_setting( 'bottom_footer_icon_3' , array( 
		'default' => 'fa-envelope-o', 
		'sanitize_callback' => 'sensiblewp_sanitize_text' 
	));   
	
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'bottom_footer_icon_3', array(  
    'label' => __( 'Third Icon', 'sensible-wp' ), 
    'section' => 'footer-custom',
    'settings' => 'bottom_footer_icon_3',
	'priority'   => 90
	)));
	
	// Email Text
	$wp_customize->add_setting( 'third_text',
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_text',
	));

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'third_text', array(
		'label'    => __( 'Footer Third Text', 'sensible-wp' ),
		'section'  => 'footer-custom',   
		'settings' => 'third_text', 
		'priority'   => 100
	)));
	
	// Footer Contact
	$wp_customize->add_setting( 'sensiblewp_footer_third',
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_text',
	));
	 
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'sensiblewp_footer_third', array(
    'label' => __( 'Footer Third Column', 'sensible-wp' ),
    'section' => 'footer-custom',
    'settings' => 'sensiblewp_footer_third',  
	'type'     => 'textarea',   
	'priority'   => 110
	)));

	// Footer Byline Text 
	$wp_customize->add_setting( 'sensiblewp_footerid',
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_text',
	));
	 
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'sensiblewp_footerid', array(
    'label' => __( 'Footer Byline Text', 'sensible-wp' ),
    'section' => 'footer-custom', 
    'settings' => 'sensiblewp_footerid',
	'priority'   => 120
	))); 
	
	$wp_customize->add_setting( 'sensiblewp_footer_color', array( 
        'default'     => '#242830',  
        'sanitize_callback' => 'sanitize_hex_color', 
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sensiblewp_footer_color', array(
        'label'	   => __( 'Footer Background Color', 'sensible-wp'),
        'section'  => 'footer-custom',
        'settings' => 'sensiblewp_footer_color',
		'priority' => 125
    )));
	
	$wp_customize->add_setting( 'sensiblewp_footer_text_color', array( 
        'default'     => '#ffffff', 
        'sanitize_callback' => 'sanitize_hex_color', 
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sensiblewp_footer_text_color', array(
        'label'	   => __( 'Footer Text Color', 'sensible-wp'),
        'section'  => 'footer-custom',
        'settings' => 'sensiblewp_footer_text_color', 
		'priority' => 135
    )));
	
	$wp_customize->add_setting( 'sensiblewp_footer_link_color', array( 
        'default'     => '#b3b3b3',
        'sanitize_callback' => 'sanitize_hex_color', 
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sensiblewp_footer_link_color', array(
        'label'	   => __( 'Footer Link Color', 'sensible-wp'),  
        'section'  => 'footer-custom',
        'settings' => 'sensiblewp_footer_link_color', 
		'priority' => 140
    )));

    // Choose excerpt or full content on blog
    $wp_customize->add_section( 'sensiblewp_layout_section' , array( 
	    'title'       => __( 'Blog Layout', 'sensible-wp' ),
	    'priority'    => 22, 
	    'description' => __( 'Change how Sensible displays posts', 'sensible-wp' ),
	));
	
	// Blog Title
	$wp_customize->add_setting( 'sensiblewp_blog_title',
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_text',
			'default' => 'Blog'
	));  

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'sensiblewp_blog_title', array(
		'label'    => __( 'Posts Page Title', 'sensible-wp' ),
		'section'  => 'sensiblewp_layout_section', 
		'settings' => 'sensiblewp_blog_title',
		'priority'   => 10 
	))); 
	
	// Blog Background
	$wp_customize->add_setting( 'sensiblewp_blog_bg', array(
		'sanitize_callback' => 'esc_url_raw',
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'sensiblewp_blog_bg', array( 
		'label'    => __( 'Posts Page Image', 'sensible-wp' ),
		'section'  => 'sensiblewp_layout_section',  
		'settings' => 'sensiblewp_blog_bg',   
		'priority'   => 20,
	)));

	$wp_customize->add_setting( 'sensiblewp_post_content', array(
		'default'	        => 'option1',
		'sanitize_callback' => 'sensiblewp_sanitize_index_content',
	));
	
	// Post Content
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'sensiblewp_post_content', array(
		'label'    => __( 'Post content', 'sensible-wp' ),
		'section'  => 'sensiblewp_layout_section',
		'settings' => 'sensiblewp_post_content',
		'type'     => 'radio',
		'priority'   => 30,
		'choices'  => array(
			'option1' => 'Excerpts',
			'option2' => 'Full content',
			),
	)));
	
	//Excerpt
    $wp_customize->add_setting(
        'exc_length',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '30',
    )); 
	
    $wp_customize->add_control( 'exc_length', array( 
        'type'        => 'number',
        'priority'    => 2, 
        'section'     => 'sensiblewp_layout_section',
        'label'       => __('Excerpt length', 'sensible-wp'),
        'description' => __('Choose your excerpt length here. Default: 30 words', 'sensible-wp'),
		'priority'   => 40,
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 200,
            'step'  => 5,
            'style' => 'padding: 15px;',
        ), 
	)); 
	
	// Page Services Panel
	$wp_customize->add_panel( 'services_page_panel', array(
    'priority'       => 36,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Services Page Section', 'sensible-wp' ),
    'description'    		 => __( 'Edit your Services page settings.', 'sensible-wp' ),
	) );
	
	// Services Page Section
	$wp_customize->add_section( 'sensiblewp_services_page_section', array(
		'title'          => __( 'Services Page Content', 'sensible-wp' ),
		'priority'       => 10,
		'description' 			 => __( 'Edit your home page Services content.', 'sensible-wp' ),
		'panel' => 'services_page_panel',  
	));
	
	// Number of Services 
	$wp_customize->add_setting( 'sensiblewp_page_services_numbers', array(
		'default'	        => 'option1',
		'sanitize_callback' => 'sensiblewp_sanitize_service_content', 
	));

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'sensiblewp_page_services_numbers', array(
		'label'    => __( 'Number of services to display on your page', 'sensible-wp' ),
		'section'  => 'sensiblewp_services_page_section',
		'settings' => 'sensiblewp_page_services_numbers',
		'type'     => 'radio',
		'priority'   => 3, 
		'choices'  => array(
			'option1' => 'All',
			'option2' => '2',
			'option3' => '1', 
			),
	)));
	
	// Page Service Box 1 Section
	$wp_customize->add_section( 'sensiblewp_page_services_box_1', array(
		'title'          => __( 'Services Page Box 1', 'sensible-wp' ),
		'priority'       => 20,
		'description' => __( 'Edit your services page box 1. Choose from any of <a href="http://fortawesome.github.io/Font-Awesome/cheatsheet/" target="_blank">these icons</a>. Example: "fa-arrow-right".', 'sensible-wp' ),
		'panel' => 'services_page_panel', 
	));
	
	$wp_customize->add_setting('active_page_service_1', 
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_checkbox',
	    ) 
	);  
	
	$wp_customize->add_control( 
    'active_page_service_1', 
    array(
        'type' => 'checkbox',
        'label' => __( 'Hide Service Page Box 1', 'sensible-wp' ), 
        'section' => 'sensiblewp_page_services_box_1',
		'priority'   => 1
    ));
	
	// Page Service Icon 1
	$wp_customize->add_setting( 'page_service_icon_1',
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_text', 
	));  

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'page_service_icon_1', array(
		'label'    => __( 'Service Page Icon 1', 'sensible-wp' ),
		'section'  => 'sensiblewp_page_services_box_1', 
		'settings' => 'page_service_icon_1', 
		'priority'   => 2
	)));
	
	// Service Page Title 1
	$wp_customize->add_setting( 'page_service_title_1',
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_text', 
	));  

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'page_service_title_1', array(
		'label'    => __( 'Service Page Title 1', 'sensible-wp' ),
		'section'  => 'sensiblewp_page_services_box_1',
		'settings' => 'page_service_title_1', 
		'priority'   => 3
	)));
	
	// Service Page Text 1
	$wp_customize->add_setting( 'page_service_text_1' ,
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_text',
	)); 
	 
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'page_service_text_1', array( 
    'label' => __( 'Service Page Text Box 1', 'sensible-wp' ), 
    'section' => 'sensiblewp_page_services_box_1',
    'settings' => 'page_service_text_1', 
	'type'     => 'textarea', 
	'priority'   => 4
	)));
	
	// Service Page Box 2 Section
	$wp_customize->add_section( 'sensiblewp_page_services_box_2', array(
		'title'          => __( 'Services Page Box 2', 'sensible-wp' ),
		'priority'       => 30,
		'description' 			 => __( 'Edit your services page box 2. Choose from any of <a href="http://fortawesome.github.io/Font-Awesome/cheatsheet/" target="_blank">these icons</a>. Example: "fa-arrow-right".', 'sensible-wp' ),
		'panel' => 'services_page_panel', 
	));
	
	$wp_customize->add_setting('active_page_service_2', 
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_checkbox',
	    ) 
	);  
	
	$wp_customize->add_control( 
    'active_page_service_2', 
    array(
        'type' => 'checkbox',
        'label' => __( 'Hide Service Page Box 2', 'sensible-wp' ),
        'section' => 'sensiblewp_page_services_box_2', 
		'priority'   => 1
    ));
	
	// Service Page Icon 2
	$wp_customize->add_setting( 'page_service_icon_2',
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_text', 
	));  

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'page_service_icon_2', array(
		'label'    => __( 'Service Page Icon 2', 'sensible-wp' ),
		'section'  => 'sensiblewp_page_services_box_2', 
		'settings' => 'page_service_icon_2', 
		'priority'   => 2
	)));
	
	// Service Page Title 2
	$wp_customize->add_setting( 'page_service_title_2',
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_text', 
	));  

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'page_service_title_2', array(
		'label'    => __( 'Service Page Title 2', 'sensible-wp' ),
		'section'  => 'sensiblewp_page_services_box_2',
		'settings' => 'page_service_title_2', 
		'priority'   => 3
	)));
	
	// Service Page Text 2
	$wp_customize->add_setting( 'page_service_text_2' ,
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_text',
	)); 
	 
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'page_service_text_2', array( 
    'label' => __( 'Service Page Text Box 2', 'sensible-wp' ), 
    'section' => 'sensiblewp_page_services_box_2',
    'settings' => 'page_service_text_2', 
	'type'     => 'textarea', 
	'priority'   => 4
	)));
	
	// Service Page Box 3 Section
	$wp_customize->add_section( 'sensiblewp_page_services_box_3', array(
		'title'          => __( 'Services Page Box 3', 'sensible-wp' ),
		'priority'       => 40,
		'description'			 => __( 'Edit your services page box 3. Choose from any of <a href="http://fortawesome.github.io/Font-Awesome/cheatsheet/" target="_blank">these icons</a>. Example: "fa-arrow-right".', 'sensible-wp' ),
		'panel' 		 => 'services_page_panel',   
	));
	
	$wp_customize->add_setting('active_page_service_3', 
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_checkbox', 
	    ) 
	);  
	
	$wp_customize->add_control( 
    'active_page_service_3', 
    array(
        'type' => 'checkbox',
        'label' => __( 'Hide Service Page Box 3', 'sensible-wp' ), 
        'section' => 'sensiblewp_page_services_box_3', 
		'priority'   => 1
    ));
	
	// Service Page Icon 3
	$wp_customize->add_setting( 'page_service_icon_3', 
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_text', 
	));  

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'page_service_icon_3', array(
		'label'    => __( 'Service Page Icon 3', 'sensible-wp' ),
		'section'  => 'sensiblewp_page_services_box_3', 
		'settings' => 'page_service_icon_3',
		'priority'   => 2
	)));
	
	// Service Page Title 3
	$wp_customize->add_setting( 'page_service_title_3',
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_text', 
	));  

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'page_service_title_3', array(
		'label'    => __( 'Service Page Title 3', 'sensible-wp' ),
		'section'  => 'sensiblewp_page_services_box_3',
		'settings' => 'page_service_title_3', 
		'priority'   => 3
	)));
	
	// Service Page Text 3
	$wp_customize->add_setting( 'page_service_text_3' ,
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_text',
	)); 
	 
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'page_service_text_3', array( 
    'label' => __( 'Service Page Text Box 3', 'sensible-wp' ), 
    'section' => 'sensiblewp_page_services_box_3',
    'settings' => 'page_service_text_3',
	'type'     => 'textarea', 
	'priority'   => 4
	)));
	
	// Team Page Panel
	$wp_customize->add_panel( 'page_team_panel', array(
    'priority'       => 37,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Team Member Page Section', 'sensible-wp' ),
    'description'    		 => __( 'Edit your team member page settings.', 'sensible-wp' ), 
	)); 
	
	// Team Page Section
	$wp_customize->add_section( 'page_sensiblewp_team_section', array(
		'title'          => __( 'Team Page Section', 'sensible-wp' ),
		'priority'       => 10,
		'description' 			 => __( 'Edit your Team page section.', 'sensible-wp' ),
		'panel' => 'page_team_panel',   
	));
	
	// Page Number of Team Members
	$wp_customize->add_setting( 'sensiblewp_page_member_numbers', array(
		'default'	        => 'option1',
		'sanitize_callback' => 'sensiblewp_sanitize_member_page_content', 
	));

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'sensiblewp_page_member_numbers', array( 
		'label'    => __( 'Number of team members to display on Team Page', 'sensible-wp' ),
		'section'  => 'page_sensiblewp_team_section',
		'settings' => 'sensiblewp_page_member_numbers',
		'type'     => 'radio', 
		'priority'   => 3, 
		'choices'  => array(
			'option1' => 'All', 
			'option2' => '2', 
			'option3' => '1' 
			),
	)));
	
	// Page Team Member 1
	$wp_customize->add_section( 'page_sensiblewp_team_member_1', array(
		'title'          => __( 'Team Member 1', 'sensible-wp' ),
		'priority'       => 20,
		'description' => __( 'Edit your page - Team Member 1', 'sensible-wp' ),
		'panel' => 'page_team_panel',   
	));
	
	$wp_customize->add_setting('page_active_member_1', 
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_checkbox',
	    ) 
	);  
	
	$wp_customize->add_control( 
    'page_active_member_1', 
    array(
        'type' => 'checkbox',
        'label' => __( 'Hide Member Box 1', 'sensible-wp' ),
        'section' => 'page_sensiblewp_team_member_1', 
		'priority'   => 1
    ));
	
	// Page - Team Member Picture 1
	$wp_customize->add_setting( 'page_member_image_1', array(    
		'sanitize_callback' => 'esc_url_raw',
	));

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'page_member_image_1', array( 
		'label'    => __( 'Team Member Image 1', 'sensible-wp' ), 
		'section'  => 'page_sensiblewp_team_member_1',  
		'settings' => 'page_member_image_1',  
		'priority'   => 2
	))); 
	
	// Page - Team Member Name 1
	$wp_customize->add_setting( 'page_member_name_1',
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_text', 
	));  

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'page_member_name_1', array(
		'label'    => __( 'Team Member Name 1', 'sensible-wp' ),
		'section'  => 'page_sensiblewp_team_member_1', 
		'settings' => 'page_member_name_1',
		'priority'   => 3
	))); 
	
	// Page - Team Member Text 1
	$wp_customize->add_setting( 'page_member_text_1' ,
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_text',
	)); 
	 
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'page_member_text_1', array( 
    'label' => __( 'Team Member Text Box 1', 'sensible-wp' ), 
    'section' => 'page_sensiblewp_team_member_1',
    'settings' => 'page_member_text_1', 
	'type'     => 'textarea', 
	'priority'   => 4
	)));
	
	// Page - Team Member Facebook 1
	$wp_customize->add_setting( 'page_member_fb_1',
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_text', 
	));  

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'page_member_fb_1', array(
		'label'    => __( 'Team Member Facebook 1', 'sensible-wp' ),
		'section'  => 'page_sensiblewp_team_member_1', 
		'settings' => 'page_member_fb_1',
		'priority'   => 5
	))); 
	
	// Page - Team Member Twitter 1
	$wp_customize->add_setting( 'page_member_twitter_1',
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_text', 
	));  

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'page_member_twitter_1', array(
		'label'    => __( 'Team Member Twitter 1', 'sensible-wp' ),
		'section'  => 'page_sensiblewp_team_member_1', 
		'settings' => 'page_member_twitter_1',
		'priority'   => 6
	))); 
	
	// Page - Team Member LinkedIn 1
	$wp_customize->add_setting( 'page_member_linked_1',
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_text', 
	));  

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'page_member_linked_1', array(
		'label'    => __( 'Team Member LinkedIn 1', 'sensible-wp' ),
		'section'  => 'page_sensiblewp_team_member_1', 
		'settings' => 'page_member_linked_1',
		'priority'   => 7
	))); 
	
	// Page - Team Member Google 1
	$wp_customize->add_setting( 'page_member_google_1',
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_text', 
	));  

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'page_member_google_1', array(
		'label'    => __( 'Team Member Google 1', 'sensible-wp' ),
		'section'  => 'page_sensiblewp_team_member_1', 
		'settings' => 'page_member_google_1',
		'priority'   => 8
	))); 
	
	// Page - Team Member Email 1
	$wp_customize->add_setting( 'page_member_email_1',
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_text', 
	));  

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'page_member_email_1', array(
		'label'    => __( 'Team Member Email 1', 'sensible-wp' ),
		'section'  => 'page_sensiblewp_team_member_1', 
		'settings' => 'page_member_email_1',
		'priority'   => 9
	)));  
	
	// Page - Home Team Member 2
	$wp_customize->add_section( 'page_sensiblewp_team_member_2', array(
		'title'          => __( 'Team Member 2', 'sensible-wp' ),
		'priority'       => 30,
		'description' => __( 'Edit your Team Member 2', 'sensible-wp' ),
		'panel' => 'page_team_panel',   
	));
	
	$wp_customize->add_setting('page_active_member_2', 
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_checkbox',
	    ) 
	);  
	
	$wp_customize->add_control( 
    'page_active_member_2', 
    array(
        'type' => 'checkbox',
        'label' => __( 'Hide Member Box 2', 'sensible-wp' ),
        'section' => 'page_sensiblewp_team_member_2', 
		'priority'   => 1
    ));
	
	// Page - Team Member Picture 2
	$wp_customize->add_setting( 'page_member_image_2', array(    
		'sanitize_callback' => 'esc_url_raw',
	));

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'page_member_image_2', array( 
		'label'    => __( 'Team Member Image 2', 'sensible-wp' ), 
		'section'  => 'page_sensiblewp_team_member_2',  
		'settings' => 'page_member_image_2',  
		'priority'   => 2
	))); 
	
	// Page - Team Member Name 2
	$wp_customize->add_setting( 'page_member_name_2',
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_text', 
	));  

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'page_member_name_2', array(
		'label'    => __( 'Team Member Name 2', 'sensible-wp' ),
		'section'  => 'page_sensiblewp_team_member_2', 
		'settings' => 'page_member_name_2',
		'priority'   => 3
	))); 
	
	// Page - Team Member Text 2
	$wp_customize->add_setting( 'page_member_text_2' ,
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_text',
	)); 
	 
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'page_member_text_2', array( 
    'label' => __( 'Team Member Text Box 2', 'sensible-wp' ), 
    'section' => 'page_sensiblewp_team_member_2',
    'settings' => 'page_member_text_2', 
	'type'     => 'textarea', 
	'priority'   => 4
	)));
	
	// Page - Team Member Facebook 2
	$wp_customize->add_setting( 'page_member_fb_2',
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_text', 
	));  

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'page_member_fb_2', array(
		'label'    => __( 'Team Member Facebook 2', 'sensible-wp' ),
		'section'  => 'page_sensiblewp_team_member_2', 
		'settings' => 'page_member_fb_2',
		'priority'   => 5
	))); 
	
	// Page - Team Member Twitter 2
	$wp_customize->add_setting( 'page_member_twitter_2',
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_text', 
	));  

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'page_member_twitter_2', array(
		'label'    => __( 'Team Member Twitter 2', 'sensible-wp' ),
		'section'  => 'page_sensiblewp_team_member_2', 
		'settings' => 'page_member_twitter_2',
		'priority'   => 6
	))); 
	
	// Page - Team Member LinkedIn 2
	$wp_customize->add_setting( 'page_member_linked_2',
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_text', 
	));  

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'page_member_linked_2', array(
		'label'    => __( 'Team Member LinkedIn 2', 'sensible-wp' ),
		'section'  => 'page_sensiblewp_team_member_2', 
		'settings' => 'page_member_linked_2',
		'priority'   => 7
	))); 
	
	// Page - Team Member Google 2
	$wp_customize->add_setting( 'page_member_google_2',
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_text', 
	));  

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'page_member_google_2', array(
		'label'    => __( 'Team Member Google 2', 'sensible-wp' ),
		'section'  => 'page_sensiblewp_team_member_2', 
		'settings' => 'page_member_google_2',
		'priority'   => 8
	))); 
	
	// Page - Team Member Email 2
	$wp_customize->add_setting( 'page_member_email_2',
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_text', 
	));  

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'page_member_email_2', array(
		'label'    => __( 'Team Member Email 2', 'sensible-wp' ),
		'section'  => 'page_sensiblewp_team_member_2', 
		'settings' => 'page_member_email_2',
		'priority'   => 9
	)));  
	
	// Page - Home Team Member 3
	$wp_customize->add_section( 'page_sensiblewp_team_member_3', array(
		'title'          => __( 'Team Member 3', 'sensible-wp' ), 
		'priority'       => 40,
		'description' => __( 'Edit your Team Member 3', 'sensible-wp' ),
		'panel' => 'page_team_panel',   
	));
	
	$wp_customize->add_setting('page_active_member_3', 
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_checkbox',
	    ) 
	);  
	
	$wp_customize->add_control( 
    'page_active_member_3', 
    array(
        'type' => 'checkbox',
        'label' => __( 'Hide Member Box 3', 'sensible-wp' ),
        'section' => 'page_sensiblewp_team_member_3', 
		'priority'   => 1
    ));
	
	// Page - Team Member Picture 3
	$wp_customize->add_setting( 'page_member_image_3', array(    
		'sanitize_callback' => 'esc_url_raw',
	));

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'page_member_image_3', array( 
		'label'    => __( 'Team Member Image 3', 'sensible-wp' ), 
		'section'  => 'page_sensiblewp_team_member_3',  
		'settings' => 'page_member_image_3',  
		'priority'   => 2
	))); 
	
	// Page - Team Member Name 3
	$wp_customize->add_setting( 'page_member_name_3',
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_text', 
	));  

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'page_member_name_3', array(
		'label'    => __( 'Team Member Name 3', 'sensible-wp' ),
		'section'  => 'page_sensiblewp_team_member_3', 
		'settings' => 'page_member_name_3',
		'priority'   => 3
	))); 
	
	// Page - Team Member Text 3
	$wp_customize->add_setting( 'page_member_text_3' ,
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_text',
	)); 
	 
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'page_member_text_3', array( 
    'label' => __( 'Team Member Text Box 3', 'sensible-wp' ), 
    'section' => 'page_sensiblewp_team_member_3',
    'settings' => 'page_member_text_3', 
	'type'     => 'textarea', 
	'priority'   => 4
	)));
	
	// Page - Team Member Facebook 3
	$wp_customize->add_setting( 'page_member_fb_3',
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_text', 
	));  

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'page_member_fb_3', array(
		'label'    => __( 'Team Member Facebook 3', 'sensible-wp' ),
		'section'  => 'page_sensiblewp_team_member_3', 
		'settings' => 'page_member_fb_3',
		'priority'   => 5
	))); 
	
	// Page - Team Member Twitter 3
	$wp_customize->add_setting( 'page_member_twitter_3',
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_text', 
	));  

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'page_member_twitter_3', array(
		'label'    => __( 'Team Member Twitter 3', 'sensible-wp' ),
		'section'  => 'page_sensiblewp_team_member_3', 
		'settings' => 'page_member_twitter_3',
		'priority'   => 6
	))); 
	
	// Page - Team Member LinkedIn 3
	$wp_customize->add_setting( 'page_member_linked_3',
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_text', 
	));  

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'page_member_linked_3', array(
		'label'    => __( 'Team Member LinkedIn 3', 'sensible-wp' ),
		'section'  => 'page_sensiblewp_team_member_3',  
		'settings' => 'page_member_linked_3',
		'priority'   => 7
	))); 
	
	// Page - Team Member Google 3
	$wp_customize->add_setting( 'page_member_google_3',
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_text', 
	));  

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'page_member_google_3', array(
		'label'    => __( 'Team Member Google 3', 'sensible-wp' ),
		'section'  => 'page_sensiblewp_team_member_3', 
		'settings' => 'page_member_google_3',
		'priority'   => 8
	))); 
	
	// Page - Team Member Email 3
	$wp_customize->add_setting( 'page_member_email_3',
	    array(
	        'sanitize_callback' => 'sensiblewp_sanitize_text', 
	));  

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'page_member_email_3', array(
		'label'    => __( 'Team Member Email 3', 'sensible-wp' ),
		'section'  => 'page_sensiblewp_team_member_3', 
		'settings' => 'page_member_email_3', 
		'priority'   => 9 
	)));
	

	// Set site name and description to be previewed in real-time
	$wp_customize->get_setting('blogname')->transport='postMessage';
	$wp_customize->get_setting('blogdescription')->transport='postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	
	// Move sections up 
	$wp_customize->get_section('static_front_page')->priority = 10;
	$wp_customize->get_section('nav')->priority = 11; 

	// Enqueue scripts for real-time preview
	wp_enqueue_script( 'sensiblewp_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
 

}
add_action('customize_register', 'sensiblewp_theme_customizer');


/**
 * Sanitizes a hex color. Identical to core's sanitize_hex_color(), which is not available on the wp_head hook.
 *
 * Returns either '', a 3 or 6 digit hex color (with #), or null.
 * For sanitizing values without a #, see sanitize_hex_color_no_hash().
 *
 * @since 1.7
 */
function sensiblewp_sanitize_hex_color( $color ) {
	if ( '#ea474b' === $color ) 
		return '';

	// 3 or 6 hex digits, or the empty string.
	if ( preg_match('|^#([A-Fa-f0-9]{3}){1,2}$|', $color ) )
		return $color;

	return null;
}

/**
 * Sanitizes our post content value (either excerpts or full post content).
 *
 * @since 1.7
 */
function sensiblewp_sanitize_index_content( $content ) {
	if ( 'option2' == $content ) {
		return 'option2';
	} else {
		return 'option1';
	} 
}

//services number radio
function sensiblewp_sanitize_service_content( $input ) {
    $valid = array( 
        'option1' => 'All',
		'option2' => '1',
		'option3' => '1',
    );
 
    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
}

//sensible sanitize widget content
function sensiblewp_sanitize_widget_content( $input ) {
    $valid = array(
        'option1' => '1 Column', 
		'option2' => '2 Columns',
		'option3' => '3 Columns',
		'option4' => '4 Columns',
    );
 
    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
} 

//services page number radio
function sensiblewp_page_services_numbers( $input ) {
    $valid = array( 
        'option1' => 'All',
		'option2' => '2',
		'option3' => '1',
    );
 
    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
}

//team members number radio
function sensiblewp_sanitize_member_content( $input ) {
    $valid = array( 
        'option1' => 'All', 
		'option2' => '2',
		'option3' => '1'  
    );
 
    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
}

//team members number radio
function sensiblewp_sanitize_member_page_content( $input ) {
    $valid = array( 
        'option1' => 'All', 
		'option2' => '2',
		'option3' => '1'  
    );
 
    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
}


//Checkboxes
function sensiblewp_sanitize_checkbox( $input ) {
	if ( $input == 1 ) {
		return 1;
	} else {
		return '';
	}
}

//Integers
function sensiblewp_sanitize_int( $input ) {
    if( is_numeric( $input ) ) {
        return intval( $input );
    }
}

//Text
function sensiblewp_sanitize_text( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}

//Sanitizes Fonts 
function sensiblewp_sanitize_fonts( $input ) {  
    $valid = array(
			'Open Sans:400italic,700italic,400,700' => 'Open Sans',
            'Oswald:400,700' => 'Oswald',
			'Source Sans Pro:400,700,400italic,700italic' => 'Source Sans Pro',
			'Playfair Display:400,700,400italic' => 'Playfair Display',
			'Montserrat:400,700' => 'Montserrat',
			'Raleway:400,700' => 'Raleway',    
            'Droid Sans:400,700' => 'Droid Sans',
            'Lato:400,700,400italic,700italic' => 'Lato',
            'Arvo:400,700,400italic,700italic' => 'Arvo',
            'Lora:400,700,400italic,700italic' => 'Lora',
			'Merriweather:400,300italic,300,400italic,700,700italic' => 'Merriweather',
			'Oxygen:400,300,700' => 'Oxygen',
			'PT Serif:400,700' => 'PT Serif', 
            'PT Sans:400,700,400italic,700italic' => 'PT Sans',
            'PT Sans Narrow:400,700' => 'PT Sans Narrow',
			'Cabin:400,700,400italic' => 'Cabin',
			'Fjalla One:400' => 'Fjalla One',
			'Francois One:400' => 'Francois One',
			'Josefin Sans:400,300,600,700' => 'Josefin Sans',  
			'Libre Baskerville:400,400italic,700' => 'Libre Baskerville',
            'Arimo:400,700,400italic,700italic' => 'Arimo',
            'Ubuntu:400,700,400italic,700italic' => 'Ubuntu',
            'Bitter:400,700,400italic' => 'Bitter',
            'Droid Serif:400,700,400italic,700italic' => 'Droid Serif',
            'Roboto:400,400italic,700,700italic' => 'Roboto',
            'Open Sans Condensed:700,300italic,300' => 'Open Sans Condensed',
            'Roboto Condensed:400italic,700italic,400,700' => 'Roboto Condensed',
            'Roboto Slab:400,700' => 'Roboto Slab',
            'Yanone Kaffeesatz:400,700' => 'Yanone Kaffeesatz',
            'Rokkitt:400' => 'Rokkitt', 
    );
 
    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
}

//No sanitize - empty function for options that do not require sanitization -> to bypass the Theme Check plugin
function sensiblewp_no_sanitize( $input ) {
} 

/**
 * Add CSS in <head> for styles handled by the theme customizer
 *
 * @since 1.5
 */
function sensiblewp_add_customizer_css() {
	
	$color = ( get_theme_mod( 'sensiblewp_link_color', '#ea474b' ) );
	$hover_color = ( get_theme_mod( 'sensiblewp_hover_color', '#ea474b' ) );
	$theme_color = ( get_theme_mod( 'sensiblewp_custom_color' ) );
	$theme_hover_color = ( get_theme_mod( 'sensiblewp_custom_color_hover' ) );
	$social_color = ( get_theme_mod( 'sensiblewp_social_color' ) );
	$social_hover_color = ( get_theme_mod( 'sensiblewp_social_color_hover' ) );
	
	$checkVars = array($color != '#ea474b', $hover_color != '#ea474b', $theme_color != '#ea474b', $theme_hover_color != '#ea474b', $social_color != '#888888', $social_hover_color != '#888888');
	
	?>
	<!-- Sensible customizer CSS -->
	<style>
		body { border-color: <?php echo $color; ?>; }
		
		a { color: <?php echo $color; ?>; } 
		
		<?php if ( get_theme_mod( 'sensiblewp_hover_color' ) ) : ?>
		.main-navigation li:hover > a, a:hover { color: <?php echo esc_attr( get_theme_mod( 'sensiblewp_hover_color', '#ea474b' )) ?>; }
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'sensiblewp_custom_color_hover' ) ) : ?>
		.member .fa:hover { background: <?php echo esc_attr( get_theme_mod( 'sensiblewp_custom_color_hover', '#ea474b' )) ?>; } 
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'sensiblewp_custom_color' ) ) : ?>
		#sequence .slide-arrow { background: <?php echo esc_attr( get_theme_mod( 'sensiblewp_custom_color', '#ea474b' )) ?>; } 
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'sensiblewp_social_color' ) ) : ?>
		.social-media-icons .fa { color: <?php echo esc_attr( get_theme_mod( 'sensiblewp_social_color', '#888888' )) ?>; 
		-o-transition:.5s;
  		-ms-transition:.5s;
  		-moz-transition:.5s;
  		-webkit-transition:.5s;
  		transition:.5s;  } 
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'sensiblewp_social_color_hover' ) ) : ?>
		.social-media-icons .fa:hover { color: <?php echo esc_attr( get_theme_mod( 'sensiblewp_social_color_hover', '#888888' )) ?>; }
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'sensiblewp_custom_color' ) ) : ?>
		.home-services .fa, .service .fa  { background: <?php echo esc_attr( get_theme_mod( 'sensiblewp_custom_color', '#ea474b' )) ?>; }
		<?php endif; ?>
		 
		<?php if ( get_theme_mod( 'sensiblewp_custom_color' ) ) : ?>
		.entry-header { background: <?php echo esc_attr( get_theme_mod( 'sensiblewp_custom_color', '#ea474b' )) ?>; }
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'sensiblewp_custom_color' ) ) : ?>
		.home-entry-title:after, .member-entry-title:after, .works-entry-title:after, .client-entry-title:after, .home-news h5:after, .home-team h5:after, .home-cta h6:after, .footer-contact h5:after, .member h5:after { border-color: <?php echo esc_attr( get_theme_mod( 'sensiblewp_custom_color', '#ea474b' )) ?>; } 
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'sensiblewp_custom_color' ) ) : ?>
		.main-navigation ul ul li { border-color: <?php echo esc_attr( get_theme_mod( 'sensiblewp_custom_color', '#ea474b' )) ?>; }
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'sensiblewp_custom_color' ) ) : ?>
		button, input[type="button"], input[type="reset"], input[type="submit"] { background: <?php echo esc_attr( get_theme_mod( 'sensiblewp_custom_color', '#ea474b' )) ?>; }  
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'sensiblewp_custom_color' ) ) : ?>
		button, input[type="button"], input[type="reset"], input[type="submit"] { border-color: <?php echo esc_attr( get_theme_mod( 'sensiblewp_custom_color', '#ea474b' )) ?>; }  
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'sensiblewp_custom_color' ) ) : ?>
		.home-blog .entry-footer:hover, button:hover, input[type="button"]:hover, input[type="reset"]:hover, input[type="submit"]:hover { border-color: <?php echo esc_attr( get_theme_mod( 'sensiblewp_custom_color', '#ea474b' )) ?>; }  
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'sensiblewp_custom_color' ) ) : ?>
		.nav-previous, .paging-navigation .nav-previous, .post-navigation .nav-previous, .nav-next, .paging-navigation .nav-next, .post-navigation .nav-next { background: <?php echo esc_attr( get_theme_mod( 'sensiblewp_custom_color', '#ea474b' )) ?>; }  
		<?php endif; ?>
		
		#site-navigation button:hover { background: none; }
		
		<?php if ( get_theme_mod( 'sensiblewp_site_title_color' ) ) : ?>
		h1.site-title a { color: <?php echo esc_attr( get_theme_mod( 'sensiblewp_site_title_color', '#ea474b' )) ?>; } 
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'sensiblewp_text_color' ) ) : ?>
		body, button, input, select, textarea, p { color: <?php echo esc_attr( get_theme_mod( 'sensiblewp_text_color', '#8c9398' )) ?>; }
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'sensiblewp_nav_link_color' ) ) : ?>
		.site-header .main-navigation ul li a { color: <?php echo esc_attr( get_theme_mod( 'sensiblewp_nav_link_color', '#ffffff' )) ?>; }
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'sensiblewp_nav_link_hover_color' ) ) : ?>
		.site-header .main-navigation a:hover { color: <?php echo esc_attr( get_theme_mod( 'sensiblewp_nav_link_hover_color', '#ffffff' )) ?>; }
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'sensiblewp_nav_drop_link_color' ) ) : ?>
		.main-navigation ul ul a { color: <?php echo esc_attr( get_theme_mod( 'sensiblewp_nav_drop_link_color', '#8c9398' )) ?> !important; } 
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'sensiblewp_blockquote' ) ) : ?>
		blockquote { background: <?php echo esc_attr( get_theme_mod( 'sensiblewp_blockquote', '#f1f1f1' )) ?>; }
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'sensiblewp_blockquote_border' ) ) : ?>
		blockquote { border-color:<?php echo esc_attr( get_theme_mod( 'sensiblewp_blockquote_border', '#ea474b' )) ?>; }
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'sensiblewp_entry' ) ) : ?>
		.entry-header .entry-title, .featured-img-header .entry-title { color: <?php echo esc_attr( get_theme_mod( 'sensiblewp_entry', '#ffffff' )) ?>; }
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'sensiblewp_footer_color' ) ) : ?>
		.site-footer { background: <?php echo esc_attr( get_theme_mod( 'sensiblewp_footer_color', '#242830' )) ?>; }
		<?php endif; ?> 
		
		<?php if ( get_theme_mod( 'sensiblewp_footer_text_color' ) ) : ?>
		.site-footer { color: <?php echo esc_attr( get_theme_mod( 'sensiblewp_footer_text_color', '#ffffff' )) ?>; }
		<?php endif; ?> 
		
		<?php if ( get_theme_mod( 'sensiblewp_custom_color' ) ) : ?>
		.footer-contact h5 { color: <?php echo esc_attr( get_theme_mod( 'sensiblewp_custom_color', '#ea474b' )) ?>; }  
		<?php endif; ?> 
		
		<?php if ( get_theme_mod( 'sensiblewp_custom_color' ) ) : ?>
		.footer-contact h5:after { border-color: <?php echo esc_attr( get_theme_mod( 'sensiblewp_custom_color', '#ea474b' )) ?>; }  
		<?php endif; ?> 
		
		<?php if ( get_theme_mod( 'sensiblewp_footer_link_color' ) ) : ?>
		.site-footer a { color: <?php echo esc_attr( get_theme_mod( 'sensiblewp_footer_link_color', '#b3b3b3' )) ?>; }
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'sensiblewp_body_size' ) ) : ?>
		body, p { font-size: <?php echo esc_attr( get_theme_mod( 'sensiblewp_body_size' )) ?>px; } 
		<?php endif; ?>  
		
	</style>
<?php } 

add_action( 'wp_head', 'sensiblewp_add_customizer_css' );
