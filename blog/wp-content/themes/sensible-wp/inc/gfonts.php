<?php


//Google Fonts 

function sensiblewp_custom_styles($custom) { 


	//Fonts 

	$headings_font = esc_html(get_theme_mod('headings_fonts')); 

	$body_font = esc_html(get_theme_mod('body_fonts')); 	

	

	if ( $headings_font ) {

		$font_pieces = explode(":", $headings_font);

		$custom .= "h1, h2, h3, h4, h5, h6 { font-family: {$font_pieces[0]}; }"."\n";

	}

	if ( $body_font ) {

		$font_pieces = explode(":", $body_font);

		$custom .= "body, button, input, select, textarea { font-family: {$font_pieces[0]}; }"."\n";

	}

	//Output all the styles

	wp_add_inline_style( 'sensiblewp-style', $custom );	

}

add_action( 'wp_enqueue_scripts', 'sensiblewp_custom_styles' );