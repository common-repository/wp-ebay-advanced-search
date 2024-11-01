<?php
if( ! defined( 'ABSPATH' )) die( 'Forbidden' );
/**
 * Plugin Name: WP eBay Advanced Search
 * Description: The most advanced eBay Advanced Product Search Plugin. Product search by Dynamic Keyword, Category, Min Price, Max Price Sold Product Only, Listing Type, Condition and others etc.
 * Plugin URI: http://themedev.net/?plugin=ebay-search
 * Author: ThemeDev
 * Version: 1.0.1
 * Author URI: http://themedev.net/
 *
 * Text Domain: themedev-ebay-advanced-search
 *
 * @package themedev-eBay-advanced-search 
 * @category Free
 * Domain Path: /languages/
 * License: GPL2+
 */
/**
 * Defining static values as global constants
 * @since 1.0.0
 */
define( 'WP_EBAY_SEARCH_VERSION', '1.0.1' );
define( 'WP_EBAY_SEARCH_PREVIOUS_STABLE_VERSION', '1.0.0' );

define( 'WP_EBAY_SEARCH_KEY', 'themedev-ebay-advanced-search' );

define( 'WP_EBAY_SEARCH_DOMAIN', 'themedev-ebay-advanced-search' );

define( 'WP_EBAY_SEARCH_FILE_', __FILE__ );
define( "WP_EBAY_SEARCH_PLUGIN_PATH", plugin_dir_path( WP_EBAY_SEARCH_FILE_ ) );
define( 'WP_EBAY_SEARCH_PLUGIN_URL', plugin_dir_url( WP_EBAY_SEARCH_FILE_ ) );

// initiate actions
add_action( 'plugins_loaded', 'ebay_advance_search_load_plugin_textdomain' );
/**
 * Load eBay Search textdomain.
 * @since 1.0.0
 * @return void
 */
function ebay_advance_search_load_plugin_textdomain() {
	load_plugin_textdomain( 'themedev-ebay-advanced-search', false, basename( dirname( __FILE__ ) ) . '/languages'  );
}

// add action page hook
add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'themedev_ebay_action_links' );

// added custom link
function themedev_ebay_action_links($links){
	$links[] = '<a href="' . admin_url( 'admin.php?page=ebay-settings' ).'"> '. __('Settings', 'themedev-ebay-advanced-search').'</a>';
	return $links;
}

/**
 * Load eBay Search Loader main page.
 * @since 1.0.0
 * @return plugin output
 */
require_once(WP_EBAY_SEARCH_PLUGIN_PATH.'init.php');
new \eBayAdvancedSearch\Init();

// actiove plugin hook
register_activation_hook( __FILE__ , ['\eBayAdvancedSearch\Apps\Settings', 'themedev_ebay_options_table' ] );
