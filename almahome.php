<?php
/*
 * ALMa Home
 * 
 * @package 			AlmaHome
 * @author 				Petr Vurm
 * @copyright 			2024 Petr Vurm
 * @license 			private
 * Plugin Name:       	ALMa Home
 * Description:       	Vlastní plugin pro ALMa Home. V případě, že potřebujete upravit nějakou část pluginu, doporučujeme Vám kontaktovat autora. Své úpravy provádíte na vlastní nebezpečí a může dojít k poškození celého pluginu!
 * Version:           	1.0.8
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
    require_once __DIR__ . '/widgets/KalkulackaServis.php';
    require_once __DIR__ . '/widgets/KalkulackaRenovace.php'; // od verze 1.0.2

    $widgets_manager->register(new \almahome\widgets\KalkulackaServis());
    $widgets_manager->register(new \almahome\widgets\KalkulackaRenovace()); // od verze 1.0.2
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

/**
 * Načtení vlastních stylů a skriptů pluginu
 * 
 * @since 1.0.6
 */
function almahome_init() {
	wp_enqueue_style('almahome-style', plugin_dir_url(__FILE__) . 'css/style.css');
	wp_enqueue_script( 'almahome-script', plugin_dir_url(__FILE__) . 'js/script.js', array('jquery'), "1.0.6");
}

/**
 * Check for updates to this plugin
 *
 * @param array  $update   Array of update data.
 * @param array  $plugin_data Array of plugin data.
 * @param string $plugin_file Path to plugin file.
 * @param string $locales    Locale code.
 *
 * @return array|bool Array of update data or false if no update available.
 */
function self_update( $update, array $plugin_data, string $plugin_file, $locales ) {
	// only check this plugin
	if ( 'AlmaHome/almahome.php' !== $plugin_file ) {
		return $update;
	}

	// already completed update check elsewhere
	if ( ! empty( $update ) ) {
		return $update;
	}

	// let's go get the latest version number from GitHub
	$response = wp_remote_get(
		'https://api.github.com/repos/ultronstudio/AlmaHome/releases/latest',
		array(
			'user-agent' => 'ultronstudio',
		)
	);

	if ( is_wp_error( $response ) ) {
		return;
	} else {
		$output = json_decode( wp_remote_retrieve_body( $response ), true );
	}

	$new_version_number  = $output['tag_name'];
	$is_update_available = version_compare( $plugin_data['Version'], $new_version_number, '<' );

	if ( ! $is_update_available ) {
		return false;
	}

	$new_url     = $output['html_url'];
	$new_package = $output['assets'][0]['browser_download_url'];

	error_log('$plugin_data: ' . print_r( $plugin_data, true ));
	error_log('$new_version_number: ' . $new_version_number );
	error_log('$new_url: ' . $new_url );
	error_log('$new_package: ' . $new_package );

	return array(
		'slug'    => $plugin_data['TextDomain'],
		'version' => $new_version_number,
		'url'     => $new_url,
		'package' => $new_package,
	);
}

add_filter( 'update_plugins_github.com', 'self_update', 10, 4 );

add_filter( 'auto_update_plugin', '__return_true' );
add_filter( 'plugin_row_meta', 'plugin_meta_links', 10, 4 );

add_action('elementor/widgets/register', 'register_almahome_widgets');
add_action( 'elementor/elements/categories_registered', 'register_almahome_categories' );

// registrace skriptů a stylů
add_action('wp_enqueue_scripts','almahome_init');