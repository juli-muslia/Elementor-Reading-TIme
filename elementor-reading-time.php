<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://julianmuslia.com
 * @since             1.0.0
 * @package           Ele_Reading_Time
 *
 * @wordpress-plugin
 * Plugin Name:       Elementor Reading Time
 * Plugin URI:        https://julianmuslia.com
 * Description:       -This plugin adds a reading time Dynamic Tag for Elementor. 
 * Version:           1.0.0
 * Author:            Julian Muslia
 * Author URI:        https://julianmuslia.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       ele-reading-time
 * Domain Path:       /languages
 */
 
 if ( ! defined( 'ABSPATH' ) ) {
     exit; // Exit if accessed directly.
 }
 
 class Ele_Reading_Time {
 
     public function __construct() {
         add_action( 'elementor/dynamic_tags/register', [ $this, 'register_tags' ] );
         add_action( 'elementor/widgets/widgets_registered', [ $this, 'init' ] );
         add_action( 'wp', [ $this, 'init' ] ); // Ensure init is called on frontend
     }
 
     public function init() {
         if ( did_action( 'elementor/loaded' ) ) {
             $file_path = plugin_dir_path( __FILE__ ) . 'tags/class-reading-time-tag.php';
             if ( file_exists( $file_path ) ) {
                 require_once( $file_path );
             } else {
                 error_log( 'File ' . $file_path . ' not found' );
             }
         }
     }
 
     public function register_tags( $dynamic_tags ) {
         if ( class_exists( 'Reading_Time_Tag' ) ) {
             $dynamic_tags->register_tag( 'Reading_Time_Tag' );
         } else {
             error_log( 'Reading_Time_Tag class not found' );
         }
     }
 
 }
 
 new Ele_Reading_Time();
 