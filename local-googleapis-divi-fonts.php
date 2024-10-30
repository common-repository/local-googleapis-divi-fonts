<?php
/**
 * @package Optimize Database after Deleting Revisions
 * @version 1.0.1
 */
/*
Plugin Name: Local GoogleAPIS Divi Fonts
Plugin URI: http://sunsoftworld.com/
Description: Customizations for removing googleapis fonts and loading them from local server
Author: SunSoft World
Author URI: 'http://sunsoftworld.com/'
Network: True
Version: 1.0.1
*/

/*********************************** * *	MAIN CLASS * * **********************************/
// VERSION
	 $odb_version           = '1.0.1';
	 $odb_release_date      = '02/10/2018';
	
	
		//////////////////////////Plugin No:2 ///////////////////////////////////
///////////////////////Start: Remove Google fonts and Add them locally //////////////////////////

//////////////Start: Functions declaration////////////////// 
function lgdf_wpcustom_inspect_scripts_and_styles() {
	global $wp_scripts;
	global $wp_styles;
 
	// Runs through the queue scripts
	foreach( $wp_scripts->queue as $handle ) :
		$scripts_list .= $handle . ' | ';
	endforeach;
 
	// Runs through the queue styles
	foreach( $wp_styles->queue as $handle ) :
		$styles_list .= $handle . ' | ';
	endforeach;
 
	printf('Scripts: %1$s <br /> Styles: %2$s', 
	$scripts_list, 
	$styles_list);
}

function lgdf_dequeue_open_sans() {
wp_dequeue_style( 'divi-fonts' );
wp_dequeue_style( 'et-fb-fonts' );
wp_dequeue_style( 'et-gf' );
wp_dequeue_style( 'et-gf-open-sans' );
}

function lgdf_dequeue_google_fonts() { 
wp_dequeue_style( 'wpb-google-fonts' ); 
wp_dequeue_style( 'et-builder-googlefonts-cached'); 
wp_dequeue_style( 'genesis-sample-fonts' );
wp_dequeue_style( 'et-gf-merriweather' );
wp_dequeue_style( 'et-gf-raleway' );
wp_dequeue_style( 'et-core-main-fonts' );
wp_dequeue_style( 'wordfence-font' );
} 

function lgdf_dequeue_google_fonts_head() { 
wp_dequeue_style( 'wpb-google-fonts' ); 
wp_dequeue_style( 'et-builder-googlefonts-cached'); 
wp_dequeue_style( 'genesis-sample-fonts' );
wp_dequeue_style( 'et-gf-merriweather' );
wp_dequeue_style( 'et-gf-raleway' );
wp_dequeue_style( 'et-core-main-fonts' );
wp_dequeue_style( 'wordfence-font' );

} 
function lgdf_deregister_scripts_styles_footer(){
 wp_deregister_style('et-gf-open-sans'); 
 wp_deregister_style( 'et-core-main-fonts' );
 wp_deregister_style( 'wordfence-font' );
}
function lgdf_deregister_scripts_styles_head(){
 wp_deregister_style('et-gf-open-sans'); 
 wp_deregister_style( 'et-core-main-fonts' );
 wp_deregister_style( 'wordfence-font' );
}

function lgdf_localFontsPlugin_styles() {
// Add CSS file
//var_dump(plugin_dir_url( __FILE__ ));
wp_enqueue_style( 'lgdf_localFontsPluginCSS', plugin_dir_url( __FILE__ ) . 'assets/css/localFontsPlugin.css' );
}
//////////////End: Functions declaration////////////////// 
	
function lgdf_all_plugin2_functions(){
    
//add_action( 'wp_print_scripts', 'lgdf_wpcustom_inspect_scripts_and_styles' );

//To remove the fonts loading from googleapis, via Theme and various plugins /////
add_action( 'wp_enqueue_scripts', 'lgdf_dequeue_open_sans', 100 );
add_action( 'wp_enqueue_scripts', 'lgdf_dequeue_google_fonts',100 );
add_action('wp_footer', 'lgdf_deregister_scripts_styles_footer');

//add_action('wp_head', 'lgdf_deregister_scripts_styles_head'); 
//add_action('wp_head', 'lgdf_dequeue_google_fonts_head'); 

//To add the fonts Locally ///////////////
add_action( 'wp_enqueue_scripts', 'lgdf_localFontsPlugin_styles' );

}
///////////////////////////////////End: Remove Google fonts and Add them manually ////////////////////////


lgdf_all_plugin2_functions();

	
?>