<?php
/**
 * @package Wpng
 */
/*
Plugin Name: Wpng
Plugin URI: https://quocdung.net/
Description: Bring AngularJS on WP
Version: 0.1.0.0
Author: quocdunginfo
Author URI: https://quocdung.net/
License: GPLv2
Text Domain: wpng
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

Copyright 2005-2015 quocdunginfo.
*/
namespace Wpng;
// END Test Doctrine 2

// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
	echo __('Hi there!  I\'m just a plugin, not much I can do when called directly.', 'wpng');
	exit;
}

define( 'WPNG_VERSION', '0.1.0.0' );
define( 'WPNG_MINIMUM_WP_VERSION', '4.0' );
define( 'WPNG_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'WPNG_DELETE_LIMIT', 100000 );
define( 'WPNG_MODULE', 'wpng' );

require_once( WPNG_PLUGIN_DIR . 'router.php' );
require_once( WPNG_PLUGIN_DIR . 'bootstrap.php' );

add_action( 'init', function(){
	WpngRouter::init();
} );

register_activation_hook( __FILE__, function(){
	Wpng::pluginActivation();
} );
register_deactivation_hook( __FILE__, function(){
	Wpng::pluginDeactivation();
} );

add_action( 'init', function(){
	Wpng::init();
} );
if ( is_admin() ) {
	add_action('init', function(){
		Wpng::initAdmin();
	});
}
require_once( WPNG_PLUGIN_DIR . 'doctrine.php' );