<?php
namespace eBayAdvancedSearch\Apps;
if( ! defined( 'ABSPATH' )) die( 'Forbidden' );
class Settings{
	 
	 // ebay option table name
	  const table_name = 'ebay_advanced_model_info';
	 /**
     * Custom get_model 
     * Method Description: Get model list
     * @since 1.0.0
     * @access public
     */
	 public static function get_model(){
		 return [
			'iphone 5c' => 'iphone 5c',
			'iphone 5s' => 'iphone 5s',
			'iphone 5' => 'iphone 5',
			'iphone 6' => 'iphone 6',
			'iphone 6plus' => 'iphone 6plus',
			'iphone 6s' => 'iphone 6s',
			'iphone 6s plus' => 'iphone 6s plus',
			'iphone se' => 'iphone se',
			'iphone 7 plus' => 'iphone 7 plus',
			'iphone 8' => 'iphone 8',
			'iphone 8 plus' => 'iphone 8 plus',
			'iphone x' => 'iphone x',
			'iphone xs' => 'iphone xs',
			'iphone xr' => 'iphone xr',
			'iphone xs-max' => 'iphone xs-max',
		 ];
	 }
	 /**
     * Custom get_model 
     * Method Description: Get color
     * @since 1.0.0
     * @access public
     */
	 public static function get_color(){
		 return [
			'white' => 'white',
			'black' => 'black',
			'red' => 'red',
			'yellow' => 'yellow',
			'silver' => 'silver',
			'blue' => 'blue',
			'coral' => 'coral',
			'gold' => 'gold',
			'rose gold' => 'rose gold',
			'space gray' => 'space gray',
			'jet black' => 'jet black',
			
		 ];
	 }
	 
	 /**
     * Custom get_storage 
     * Method Description: Get Storage
     * @since 1.0.0
     * @access public
     */
	 public static function get_storage(){
		 return [
			'16gb' => '16gb',
			'32gb' => '32gb',
			'64gb' => '64gb',
			'128gb' => '128gb',
			'256gb' => '256gb',
		 ];
	 }
	 
	 /**
     * Custom get_carrier 
     * Method Description: Get Carrier
     * @since 1.0.0
     * @access public
     */
	 public static function get_carrier(){
		 return [
			't-mobile' => 't-mobile',
			'verizon' => 'verizon',
			'sprint' => 'sprint',
			'att' => 'att',
			'unlocked' => 'unlocked',
		 ];
	 }
	 
	 /**
     * Custom get_condition 
     * Method Description: Get Condition
     * @since 1.0.0
     * @access public
     */
	 public static function get_condition(){
		return ['New' => 'New', 'Used' => 'Used'];
	 }
	  /**
     * Custom get_operation 
     * Method Description: Get Search Operation
     * @since 1.0.0
     * @access public
     */
	 public static function get_sort_order(){
		 return [
			'BestMatch' => 'Best Match',
			'Time:EndingSoonest' => 'Time: ending soonest',
			'EndTime' => 'End Time',
			'Time:NewlyListed' => 'Time: newly listed',
			'Price+Shipping:LowestFirst' => 'Price + Shipping: lowest first',
			'Price+Shipping:HighestFirst' => 'Price + Shipping: highest first',
			'Price:HighestFirst' => 'Price: highest first',
		 ];
	 }
	 /**
     * Custom get_operation 
     * Method Description: Get Search Operation
     * @since 1.0.0
     * @access public
     */
	 public static function get_operation(){
		 return [
			'findCompletedItems' => 'Find Completed Items',
			'findItemsAdvanced' => 'Find Items Advanced',
			'findItemsByKeywords' => 'Find Items By Keywords',
		 ];
	 }
	  /**
     * Custom get_operation 
     * Method Description: Get Search Operation
     * @since 1.0.0
     * @access public
     */
	 public static function get_listing_type(){
		 return [
			'All' => 'All',
			'FixedPrice' => 'FixedPrice',
			'AuctionWithBIN' => 'AuctionWithBIN',
			'StoreInventory' => 'StoreInventory',
			'Classified' => 'Classified',
		 ];
	 }
	 /**
     * Custom get_global_id 
     * Method Description: Get Global Id
     * @since 1.0.0
     * @access public
     */
	 public static function get_global_id(){
		 return [
			'EBAY-US' => 'United States',
			'EBAY-ENCA' => 'Canada (English)',
			'EBAY-GB' => 'UK',
			'EBAY-AU' => 'Australia',
			'EBAY-AT' => 'Austria',
			'EBAY-FRBE' => 'Belgium (French)',
			'EBAY-FR' => 'France',
			'EBAY-DE' => 'Germany',
			'EBAY-MOTOR' => 'Motors',
			'EBAY-IT' => 'Italy',
			'EBAY-NLBE' => 'Belgium (Dutch)',
			'EBAY-NL' => 'Netherlands',
			'EBAY-ES' => 'Spain',
			'EBAY-CH' => 'Switzerland',
			'EBAY-HK' => 'Hong Kong',
			'EBAY-IN' => 'India',
			'EBAY-IE' => 'Ireland',
			'EBAY-MY' => 'Malaysia',
			'EBAY-FRCA' => 'Canada (French)',
			'EBAY-PH' => 'Philippines',
			'EBAY-PL' => 'Poland',
			'EBAY-SG' => 'Singapore',
		 ];
	 }
	  /**
     * Custom get_condition 
     * Method Description: Get Condition
     * @since 1.0.0
     * @access public
     */
	 public static function ebay_api_url( $load = 'find'){
		 $api = [
			'find' => 'http://svcs.ebay.com/services/search/FindingService/v1',
			
		 ];
		 $link = isset($api[$load]) ? $api[$load] : '';
		 if(strlen($link) == 0):
			return $api['find'];
		 endif;
		 return $link;
	 }
	  /**
     * Custom ebay_api_call 
     * Method Description: Get Call api data
     * @since 1.0.0
     * @access public
     */
	  public static function ebay_api_call($dataUrl){
		
		// setting options 
		$settingsKeyThemeDev = 'themedev-ebay-credentials';
		$getOptions = get_option($settingsKeyThemeDev);
		
		$keyApi = isset($getOptions['ebay_access_id']) ? $getOptions['ebay_access_id'] : 'MdNayeem-ebakeset-PRD-c721c3e58-3e3cd43b';
		$keyOperation = isset($getOptions['ebay_access_operation']) ? $getOptions['ebay_access_operation'] : 'findCompletedItems';
		$keyGlobal = isset($getOptions['ebay_access_global_id']) ? $getOptions['ebay_access_global_id'] : '';
		
		// general options
		$generalKeyThemeDev = 'themedev-ebay-general';
		$getGeneral = get_option($generalKeyThemeDev);
		
		// general options
		$globalKeyThemeDev = 'themedev-ebay-global';
		$getGlobal = get_option($globalKeyThemeDev);
		
		// per page entry
		$perpage = isset($getGlobal['per_page']) ? $getGlobal['per_page'] : 10;
		//short order
		$shortorder = isset($getGlobal['short_order']) ? $getGlobal['short_order'] : 'BestMatch';
		
		$url = self::ebay_api_url('find').'?';
			 
		$dataUrl['OPERATION-NAME'] = $keyOperation;	
		$dataUrl['SERVICE-VERSION'] = '1.0.0';
		$dataUrl['SECURITY-APPNAME'] = $keyApi;
		$dataUrl['RESPONSE-DATA-FORMAT'] = 'JSON';
		$dataUrl['REST-PAYLOAD'] = true;	
		if(strlen($keyGlobal) > 1):
			$dataUrl['GLOBAL-ID'] = $keyGlobal;
		endif;
		// pagination per page
		$dataUrl['paginationInput.entriesPerPage'] = $perpage;
		
		// short order
		$dataUrl['sortOrder'] = $shortorder;
		
		$url .= http_build_query($dataUrl, '', '&');
		
		$response = wp_remote_post( $url, [
			'method' => 'GET',
			'timeout' => 45,
			'headers' => [
						'Content-Type' => 'application/json; charset=utf-8'
					],
			]
		);		
		if ( is_wp_error( $response ) ) {
		   $error_message = $response->get_error_message();
		   return false;
		} else {
			$bodyResponse =  json_decode($response['body']);
			$searchResult = isset($bodyResponse->findCompletedItemsResponse[0]->searchResult) ? $bodyResponse->findCompletedItemsResponse[0]->searchResult : [];
			return $searchResult;
		}
	 }
	 
	 /**
     * Custom ebay_options_table 
     * Method Description: Set Table with wp prefix
     * @since 1.0.0
     * @access public
     */
	 public static function ebay_options_table($table = ''){
		 global $wpdb;
		 if( strlen($table) > 0){
			 return $wpdb->prefix.$table;
		 }else{ 
			return $wpdb->prefix.self::table_name;
		 }
	 }
	 /**
     * Custom themedev_ebay_options_table 
     * Method Description: Create table when active this plugin
     * @since 1.0.0
     * @access public
     */
	 public static function themedev_ebay_options_table(){
		$tableName = self::ebay_options_table(); 
		
		global $wpdb;
		$charset_collate = $wpdb->get_charset_collate();
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		// create table for video 
		if($wpdb->get_var("SHOW TABLES LIKE '$tableName'") != $tableName) 
		{
			$wdp_sql = "CREATE TABLE IF NOT EXISTS `$tableName` (
			  `options_id` mediumint(9) NOT NULL AUTO_INCREMENT,
			  `model_name` varchar(150) NOT NULL,
			  `issues_name` varchar(150) NOT NULL,
			  `video_url` varchar(150) NOT NULL,
			  `guide_url` varchar(150) NOT NULL,
			  `replace_url` varchar(150) NOT NULL,
			  `date_time` datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
			  `status` ENUM('Active', 'DeActive', 'Delete') DEFAULT 'Active',
			  PRIMARY KEY (`options_id`)
			) $charset_collate;";	
				
			
			dbDelta($wdp_sql);
		}
		
		// eBay Label Entry
		$tableNameLavel = self::ebay_options_table('ebay_advanced_label_info'); 
		if($wpdb->get_var("SHOW TABLES LIKE '$tableNameLavel'") != $tableNameLavel) 
		{
			$wdp_sql_lavel = "CREATE TABLE IF NOT EXISTS `$tableNameLavel` (
			  `label_id` mediumint(9) NOT NULL AUTO_INCREMENT,
			  `label_name` varchar(150) NOT NULL,
			  `label_type` ENUM('Text', 'Checkbox', 'Radio', 'Select') default 'Text',
			  `date_time` datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
			  `status` ENUM('Active', 'DeActive', 'Delete') DEFAULT 'Active',
			  PRIMARY KEY (`label_id`)
			) $charset_collate;";	
				
			dbDelta($wdp_sql_lavel);
		}
		
		// eBay Model Entry
		$tableNameModel = self::ebay_options_table('ebay_advanced_label_model_info'); 
		if($wpdb->get_var("SHOW TABLES LIKE '$tableNameModel'") != $tableNameModel) 
		{
			$wdp_sql_lavel = "CREATE TABLE IF NOT EXISTS `$tableNameModel` (
			  `model_id` mediumint(9) NOT NULL AUTO_INCREMENT,
			  `label_id` mediumint(9) NOT NULL,
			  `model_key` varchar(150) NOT NULL,
			  `model_name` varchar(150) NOT NULL,
			  `date_time` datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
			  `status` ENUM('Active', 'DeActive', 'Delete') DEFAULT 'Active',
			  PRIMARY KEY (`model_id`)
			) $charset_collate;";	
				
			dbDelta($wdp_sql_lavel);
		}
	 }
	 /**
     * Custom ebay_get_result 
     * Method Description: Get Retuls
     * @since 1.0.0
     * @access public
     */
	 public static function ebay_get_result($tableName = '', $queryData = '', $joindata = ''){
		$tableName = self::ebay_options_table($tableName);
		global $wpdb;
		$myrows = $wpdb->get_results( "SELECT * FROM $tableName $joindata WHERE 1 = 1 $queryData" );
		return $myrows;
		
	}
	/**
     * Custom ebay_get_sum 
     * Method Description: Get Sum Retuls
     * @since 1.0.0
     * @access public
     */
	public static function ebay_get_sum($tableName = '', $sumFied= '', $queryData = ''){
		$tableName = self::ebay_options_table($tableName);
		global $wpdb;
		$myrows = $wpdb->get_var( "SELECT SUM($sumFied) FROM $tableName WHERE 1 = 1 $queryData" );
		return $myrows;
	}
	/**
     * Custom ebay_get_count 
     * Method Description: Get Count Retuls
     * @since 1.0.0
     * @access public
     */
	public static function ebay_get_count($tableName = '', $sumFied= '*', $queryData = ''){
		$tableName = self::ebay_options_table($tableName);
		global $wpdb;
		$myrows = $wpdb->get_var( "SELECT COUNT($sumFied) FROM $tableName WHERE 1 = 1 $queryData" );
		return $myrows;
	}
	
	public static function sanitize($value, $senitize_func = 'sanitize_text_field'){
        $senitize_func = (in_array($senitize_func, [
                'sanitize_email', 
                'sanitize_file_name', 
                'sanitize_hex_color', 
                'sanitize_hex_color_no_hash', 
                'sanitize_html_class', 
                'sanitize_key', 
                'sanitize_meta', 
                'sanitize_mime_type',
                'sanitize_sql_orderby',
                'sanitize_option',
                'sanitize_text_field',
                'sanitize_title',
                'sanitize_title_for_query',
                'sanitize_title_with_dashes',
                'sanitize_user',
                'esc_url_raw',
                'wp_filter_nohtml_kses',
            ])) ? $senitize_func : 'sanitize_text_field';
        
        if(!is_array($value)){
            return $senitize_func($value);
        }else{
            return array_map(function($inner_value) use ($senitize_func){
                return self::sanitize($inner_value, $senitize_func);
            }, $value);
        }
    }
	
	 public static function valid_email($str) {
		return (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $str)) ? FALSE : TRUE;
	}
	
}