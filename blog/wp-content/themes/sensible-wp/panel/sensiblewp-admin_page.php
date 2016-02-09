<?php

function sensiblewp_admin_page_styles() {
    wp_enqueue_style( 'sensiblewp-font-awesome-admin', get_template_directory_uri() . '/fonts/font-awesome.css' ); 
}
add_action( 'admin_enqueue_scripts', 'sensiblewp_admin_page_styles' ); 

// admin area styling
function sensiblewp_custom_admin_colors() { 
   echo '<style type="text/css">

body {
	margin: 0px;
}

.grid {
	width: 100%;
	max-width: 1240px;
	min-width: 755px;
	margin: 0 auto;
	overflow: hidden;
}

.grid:after {
	content: "";
	display: table;
	clear: both;
}

.grid-pad {
	padding-top: 20px;
	padding-left: 0px; /* grid-space to left */
	padding-right: 0px; /* grid-space to right: (grid-space-left - column-space) e.g. 20px-20px=0 */
}

.col-1-4 {
	float: left;
	padding-right: 2%; 
	width: 23%;  
	text-align: center;
}

.col-1-3 {
	float: left;
	padding-right: 2%;
	width: 31.333%;
	text-align: center;
	}
	
.fa { 
	font-size: 30px;
	color: #1cbda2;
}

.senswp .fa { font-size: 30px !important; }

.col-1-4 h4 {
	font-size: 16px;
}

button,
input[type="button"],
input[type="reset"],
input[type="submit"] {
	border: 2px solid;
	border-color: #1cbda2;
	border-radius: 4px;
	background: #1cbda2;
	box-shadow: none;
	font-size: 13px;
	line-height: 1;
	font-weight: 400;
	padding: 0.7em 1.5em 0.7em;
	text-shadow: none;
	color: #fff;
	cursor: pointer;
}

button:hover,
input[type="button"]:hover,
input[type="reset"]:hover,
input[type="submit"]:hover {
	border-color: #1cbda2;
}

button:focus,
input[type="button"]:focus,
input[type="reset"]:focus,
input[type="submit"]:focus,
button:active,
input[type="button"]:active,
input[type="reset"]:active,
input[type="submit"]:active {
	border-color: #1cbda2;
}

button.pro {
	font-size: 24px;
	padding: 1.25em 2em;
	text-align: center;
	margin: 20px auto 0;
	display: block;
}

a { 
	text-decoration: none;
}

.custom-box {
    border: 1px solid #dadada;
    border-radius: 5px;
    cursor: pointer;
    margin-bottom: 30px;
    overflow: hidden;
    position: relative;
    width: 100%;
}
.custom-box:before {
    content: "";
    display: block;
    padding-top: 90%;
}
.home-collection {
    background: none repeat scroll 0 0 #fff;
}
.custom-content {
    bottom: 0;
    color: white;
    left: 0;
    position: absolute;
    right: 0;
    top: 0;
}
.custom-content div {
    display: table;
    height: 100%;
    width: 100%;
}
.custom-content span {
    color: #999;
    display: table-cell;
    padding: 20px;
    text-align: center;
    vertical-align: middle;
}
.custom-content span > .fa {
    color: #404040;
    display: block;
    font-size: 50px;
    margin: 0 auto;
    padding: 0 0 20px;
    transition: all 0.2s ease-in-out 0s;
}
.custom-content:hover .fa {
    color: #1cbda2;
    font-size: 58px;
    transition: all 0.2s ease-in-out 0s;
}
.custom-content span > h5 {
    color: #404040;
	font-size: 18px;
	line-height: 20px;
	margin: 0;
}
.custom-content span > p {
    font-size: 15px;
    margin-bottom: 0;
}

@media handheld, only screen and (max-width: 800px) {
	.grid {
		width: 100%;
		min-width: 0;
		margin-left: 0px;
		margin-right: 0px;
		padding-left: 0px; /* grid-space to left */
		padding-right: 10px; /* grid-space to right: (grid-space-left - column-space) e.g. 20px-10px=10px */ 
	}
	
	.col-1-4 {
		float: none;
		padding-right: 0px;
		width: 100%;
		text-align: center;
	}
	
	.col-1-3 {
		float: none;
		padding-right: 0px;
		width: 100%;
		text-align: center; 
	}
}

}
		
         </style>';
}

add_action('admin_head', 'sensiblewp_custom_admin_colors'); 

     
    add_action('admin_menu', 'sensiblewp_setup_menu');
     
    function sensiblewp_setup_menu(){
    	add_theme_page( __('Sensible Theme Details', 'sensible-wp' ), __('Sensible Theme Details', 'sensible-wp' ), 'manage_options', 'sensiblewp-setup', 'sensiblewp_init' );
    }  
     
 	function sensiblewp_init(){ 
	 	echo '<div class="grid grid-pad"><div class="col-1-1"><h1 style="text-align: center;">';
		printf( __('Thank you for using Sensible!', 'sensible-wp' )); 
        echo "</h1></div></div>";
			
		echo '<div class="grid grid-pad" style="border-bottom: 1px solid #ccc; padding-bottom: 40px; margin-bottom: 30px;" ><div class="col-1-3"><h2>'; 
		printf( __('Sensible Theme Setup', 'sensible-wp' )); 
        echo '</h2>';
		
		echo '<p>';
		printf( __('We created a quick theme setup video to help you get started with Sensible. Watch the video with the link below.', 'sensible-wp' )); 
		echo '</p>'; 
		
		echo '<a href="http://modernthemes.net/documentation/sensible-documentation/sensible-theme-setup/" target="_blank"><button>';
		printf( __('View Video', 'sensible-wp' ));
		echo "</button></a></div>";
		
		echo '<div class="col-1-3"><h2>'; 
		printf( __('Documentation', 'sensible-wp' ));
        echo '</h2>';  
		
		echo '<p>';
		printf( __('Check out our Sensible Documentation to learn how to use Sensible and for tutorials on theme functions. Click the link below.', 'sensible-wp' )); 
		echo '</p>'; 
		
		echo '<a href="http://modernthemes.net/documentation/sensible-documentation/" target="_blank"><button>'; 
		printf( __('Read Docs', 'sensible-wp' ));
		echo "</button></a></div>";
		
		echo '<div class="col-1-3"><h2>'; 
		printf( __('About ModernThemes', 'sensible-wp' )); 
        echo '</h2>';  
		
		echo '<p>';
		printf( __('Want more to learn more about ModernThemes? Let us help you at www.modernthemes.net.', 'sensible-wp' ));
		echo '</p>';
		
		echo '<a href="http://modernthemes.net/" target="_blank"><button>';
		printf( __('About Us', 'sensible-wp' ));
		echo '</button></a></div></div>';
		
		echo '<div class="grid grid-pad senswp"><div class="col-1-1"><h1 style="padding-bottom: 30px; text-align: center;">';
		printf( __('Want more features? Go Pro.', 'sensible-wp' )); 
		echo '</h1></div>';
		
        echo '<div class="col-1-4"><i class="fa fa-cogs"></i><h4>';
		printf( __('More Theme Options', 'sensible-wp' ));
		echo '</h4>';
		
        echo '<p>';
		printf( __('Control more options and aspects of your website including slider settings, Service Icon Links, and uploading video.', 'sensible-wp' ));
		echo '</p></div>';
		
        echo '<div class="col-1-4"><i class="fa fa-image"></i><h4>';
        printf( __('Home Page Slider', 'sensible-wp' ));
		echo '</h4>';
		
        echo '<p>';
		printf( __('Add multiple slides to your home page with Sensible Pro. Create slides from your Posts and customize the settings in the Theme Customizer. ', 'sensible-wp' ));
		echo '</p></div>'; 
		
        echo '<div class="col-1-4"><i class="fa fa-th"></i><h4>';
		printf( __('Home Templates + Sections', 'sensible-wp' ));
		echo '</h4>';
		
        echo '<p>';
		printf( __( 'Add information with sections for a contact form, skill bars, and details spinner. Includes home page templates for Full-Screen Slider and Video Banner.', 'sensible-wp' )); 
		echo '</p></div> '; 
            
        echo '<div class="col-1-4"><i class="fa fa-shopping-cart"></i><h4>';
		printf( __( 'WooCommerce', 'sensible-wp' ));
		echo '</h4>';
		
        echo '<p>';
		printf( __( 'Turn your website into a powerful eCommerce machine. Sensible Pro is fully compatible with WooCommerce.', 'sensible-wp' ));
		echo '</p></div></div>';
            
        echo '<div class="grid grid-pad senswp"><div class="col-1-4"><i class="fa fa-th-list"></i><h4>';
		printf( __( 'More Sidebars', 'sensible-wp' ));
		echo '</h4>';
		
        echo '<p>';
		printf( __( 'Sometimes you need different sidebars for different pages. We got you covered, offering up to 5 different sidebars.', 'sensible-wp' ));
		echo '</p></div>';
		
       	echo '<div class="col-1-4"><i class="fa fa-font"></i><h4>More Google Fonts</h4><p>';
		printf( __( 'Access an additional 65 Google fonts with Sensible Pro right in the WordPress customizer.', 'sensible-wp' ));
		echo '</p></div>'; 
		
       	echo '<div class="col-1-4"><i class="fa fa-file-image-o"></i><h4>';
		printf( __( 'PSD Files', 'sensible-wp' ));
		echo '</h4>';
		
        echo '<p>';
		printf( __( 'Premium versions include PSD files. Preview your own content or showcase a customized version for your clients.', 'sensible-wp' ));
		echo '</p></div>';
            
        echo '<div class="col-1-4"><i class="fa fa-support"></i><h4>';
		printf( __( 'Free Support', 'sensible-wp' )); 
		echo '</h4>';
		
        echo '<p>';
		printf( __( 'Call on us to help you out. Premium themes come with free support that goes directly to our support staff.', 'sensible-wp' ));
		echo '</p></div></div>';
		
		echo '<div class="grid grid-pad" style="border-bottom: 1px solid #ccc; padding-bottom: 50px; margin-bottom: 30px;"><div class="col-1-1"><a href="http://modernthemes.net/wordpress-themes/sensible-pro/" target="_blank"><button class="pro">'; 
		printf( __( 'View Pro Version', 'sensible-wp' ));
		echo '</button></a></div></div>';
		
    }
?>