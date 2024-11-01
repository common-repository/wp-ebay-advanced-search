<?php
namespace eBayAdvancedSearch;
if( ! defined( 'ABSPATH' )) die( 'Forbidden' );
/**
 * Class Name : Init - This main class for ebay plugin
 * Class Type : Normal class
 *
 * initiate all necessary classes, hooks, configs
 *
 * @since 1.0.0
 * @access Public
 */

Class Init{
     
     /**
     * veriable for meta box post type - $post_type_aws
     * @since 1.0.0
     * @access private
     */
     private $post_type_ebay = 'ebay-advanced-search';
	 
	 /**
     * Construct the plugin object
     * @since 1.0.0
     * @access public
     */
	public function __construct(){
		$this->ebay_autoloder();
         new Apps\Ebay();
         new Apps\Content();
         //new Apps\Settings();
         
	}
	
	
	/**
     * Review aws_autoloder.
     * xs_review autoloader loads all the classes needed to run the plugin.
     * @since 1.0.0
     * @access private
     */
	
	private function ebay_autoloder(){
		require_once WP_EBAY_SEARCH_PLUGIN_PATH . '/appsloader.php';
        Appsloader::run_plugin_ebay();
	}
	 
}