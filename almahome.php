<?php
/*
 * ALMa Home
 * 
 * @package 			AlmaHome
 * @author 				Petr Vurm
 * @copyright 			2024 Petr Vurm
 * @license 			private
 * 
 * Plugin Name:       	ALMa Home
 * Description:       	Vlastní plugin pro ALMa Home
 * Version:           	1.0.0
 * Author:            	Petr Vurm
 * Author URI:        	https://petrvurm.cz
 * License:           	All Rights Reserved
 * License URI:		  	https://en.wikipedia.org/wiki/All_rights_reserved
 * Text Domain:       	alma-home
 * Update URI: 			https://github.com/ultronstudio/AlmaHome
 */

if(!defined('ABSPATH')) {
	exit;
}

/**
 * Registrace kategorií
 * @since 1.0.0
 * @param \Elementor\Widgets_Manager $elements_manager
 * @return void
 */
function register_almahome_categories( $widgets_manager ) {

	$widgets_manager->add_category(
		'almahome',
		[
			'title' => esc_html__( 'ALMa Home', 'almahome' ),
			'icon' => "eicon-person"
		]
	);
}

/**
 * Registrace widgetu
 * @since 1.0.0
 * @param \Elementor\Widgets_Manager $widgets_manager Elementor widgets manager
 * @return void
 */
function register_almahome_widgets($widgets_manager) : void
{
    require_once __DIR__ . '/widgets/Kalkulacka.php';

    $widgets_manager->register(new \almahome\widgets\Kalkulacka());
}

/**
 * Filters the array of row meta for each/specific plugin in the Plugins list table.
 * Appends additional links below each/specific plugin on the plugins page.
 *
 * @access  public
 * @param   array       $links_array            An array of the plugin's metadata
 * @param   string      $plugin_file_name       Path to the plugin file
 * @param   array       $plugin_data            An array of plugin data
 * @param   string      $status                 Status of the plugin
 * @return  array       $links_array
 */
function plugin_meta_links( $links_array, $plugin_file_name, $plugin_data, $status ) {
	if ( strpos( $plugin_file_name, basename(__FILE__) ) ) {

		// You can still use `array_unshift()` to add links at the beginning.
		$links_array[] = '<b style="color: red">Vytvořeno na zakázku, nekomerční</b>';
	}

	return $links_array;
}

function register_almahome_styles() {
	wp_enqueue_style('almahome-style', plugin_dir_url(__FILE__) . 'css/custom-styles.css');
}

add_filter( 'auto_update_plugin', '__return_true' );
add_filter( 'plugin_row_meta', 'plugin_meta_links', 10, 4 );

add_action('elementor/widgets/register', 'register_almahome_widgets');
add_action( 'elementor/elements/categories_registered', 'register_almahome_categories' );