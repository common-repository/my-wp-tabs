<?php 
/*
Plugin Name: WP Tabs
Plugin URI: http://sohel.prowpexpert.com/
Description: This is WP Tabs wordpress plugin. Really the WP Tabs looking awesome and easy to use. 
Author: Md Sohel
Version: 1.0
Author URI: http://sohel.prowpexpert.com/
*/


function wp_sohel_tab_latest_jquery() {
	wp_enqueue_script('jquery');
}
add_action('wp_enqueue_scripts', 'wp_sohel_tab_latest_jquery');

function wp_sohel_tab_plugin_function() {

    wp_enqueue_script( 'tab-g-main', plugins_url( '/main.js', __FILE__ ), false);
	
	wp_enqueue_style( 'tab-css-style', plugins_url( '/style.css', __FILE__ ));
	
}

add_action('wp_footer','wp_sohel_tab_plugin_function');
//////////////////////////////////////////////////////////////////
// Tabs shortcode
//////////////////////////////////////////////////////////////////
add_shortcode('tabs', 'sohel_shortcode_tabs');
	function sohel_shortcode_tabs( $atts, $content = null ) {
	global $data;

	extract(shortcode_atts(array(
		'layout' => 'horizontal',
		'backgroundcolor' => '',
		'inactivecolor' => ''
	), $atts));

	if(!$backgroundcolor) {
		$backgroundcolor = $data['tabs_bg_color'];
	}

	if(!$inactivecolor) {
		$inactivecolor = $data['tabs_inactive_color'];
	}

	static $sohel_wp_tabs_counter = 1;

	$out = "<style type='text/css'>
	#tabs-{$sohel_wp_tabs_counter},#tabs-{$sohel_wp_tabs_counter}.tabs-vertical .tabs,#tabs-{$sohel_wp_tabs_counter}.tabs-vertical .tab_content{border-color:{$inactivecolor} !important;}
	#main #tabs-{$sohel_wp_tabs_counter}.tabs-horizontal,#tabs-{$sohel_wp_tabs_counter}.tabs-vertical .tab_content,.pyre_tabs .tabs-container{background-color:{$backgroundcolor} !important;}
	body.dark #tabs-{$sohel_wp_tabs_counter}.shortcode-tabs .tab-hold .tabs li,body.dark #sidebar .tab-hold .tabs li{border-right:1px solid {$backgroundcolor} !important;}
	body.dark #tabs-{$sohel_wp_tabs_counter}.shortcode-tabs .tab-hold .tabs li:last-child{border-right:0 !important;}
	body.dark #main #tabs-{$sohel_wp_tabs_counter} .tab-hold .tabs li a{background:{$inactivecolor} !important;border-bottom:0 !important;color:{$data[body_text_color]} !important;}
	body.dark #main #tabs-{$sohel_wp_tabs_counter} .tab-hold .tabs li a:hover{background:{$backgroundcolor} !important;border-bottom:0 !important;}
	body #main #tabs-{$sohel_wp_tabs_counter} .tab-hold .tabs li.active a,body #main #tabs-{$sohel_wp_tabs_counter} .tab-hold .tabs li.active{background:{$backgroundcolor} !important;border-bottom:0 !important;}
	#sidebar .tab-hold .tabs li.active a{border-top-color:{$data[primary_color]} !important;}
	</style>";

    $out .= '<div id="tabs-'.$sohel_wp_tabs_counter.'" class="tab-holder shortcode-tabs clearfix tabs-'.$layout.'">';

	$out .= '<div class="tab-hold tabs-wrapper">';
	
	$out .= '<ul id="tabs" class="tabset tabs">';
	foreach ($atts as $key => $tab) {
		if($key != 'layout' && $key != 'backgroundcolor' && $key != 'inactivecolor') {
			$out .= '<li><a href="#' . $key . '">' . $tab . '</a></li>';
		}
	}
	$out .= '</ul>';
	
	$out .= '<div class="tab-box tabs-container">';

	$out .= do_shortcode($content) .'</div></div></div>';

	$sohel_wp_tabs_counter++;
	
	return $out;
}

add_shortcode('tab', 'sohel_shortcode_tab');
	function sohel_shortcode_tab( $atts, $content = null ) {
	extract(shortcode_atts(array(
    ), $atts));
    
	$out = '';
	$out .= '<div id="tab' . $atts['id'] . '" class="tab tab_content">' . do_shortcode($content) .'</div>';
	
	return $out;
}

 
 

add_filter('widget_text', 'do_shortcode');