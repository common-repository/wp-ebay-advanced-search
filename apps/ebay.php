<?php
namespace eBayAdvancedSearch\Apps;
if( ! defined( 'ABSPATH' )) die( 'Forbidden' );
class Ebay{
	 /**
     * veriable for meta box post type - $post_type_aws
     * @since 1.0.0
     * @access private
     */
     private $post_type_ebay = 'ebay-advanced-search';
	 
	  /**
     * construct
     * @since 1.0.0
     * @access public
     */
	 public function __construct(){
		 // add Admin Page WP- Action
		
		add_action('admin_menu', [ $this, 'ebay_admin_menu_setup' ]);
		
		// Load css file for settings page
        add_action( 'admin_enqueue_scripts', [$this, 'ebay_settings_css_loader' ] );

        // Load script file for settings page
        add_action( 'admin_enqueue_scripts', [$this, 'ebay_settings_script_loader' ] );
	 }
	/**
     * Custom Post type 
     * Method Description: Set custom Post type
     * @since 1.0.0
     * @access public
     */
	 public static function post_type(){
		 return $this->post_type_ebay;
	 }
	 /**
     * Added admin manu page
     * Method Description: Set admin menu page with sub page
     * @since 1.0.0
     * @access public
     */
	 public function ebay_admin_menu_setup(){
		 add_menu_page(
			__( 'eBay', 'themedev-ebay-advanced-search' ),
			'eBay Search',
			'manage_options',
			'themedev-ebay-search-advanced',
			[ $this , 'ebay_options_admin'],
			WP_EBAY_SEARCH_PLUGIN_URL.'assets/images/eBay-20X20.png',
			101
		);
		//sub main page - Search product
		add_submenu_page(
			'themedev-ebay-search-advanced',
			__( 'Settings', 'themedev-ebay-advanced-search' ),
			__('Settings', 'themedev-ebay-advanced-search' ),
			'manage_options',
			'themedev-ebay-settings',
			[ $this , 'ebay_settings_admin']
		);
	 }
	 /**
     * Admin main page
     * Method Description: Search product page
     * @since 1.0.0
     * @access public
     */
	 public function ebay_options_admin(){
		// check page
		if(!file_exists(WP_EBAY_SEARCH_PLUGIN_PATH.'views/admin/admin-options.php')){
			die('admin-options.php file could not found');
		}
		
		$message_status = 'no';
		$message_text = '';
		$tableNameLabel =  \eBayAdvancedSearch\Apps\Settings::ebay_options_table('ebay_advanced_label_info');
		
		global $wpdb;
		
		$labelId = isset($_GET['labelid']) ? intval($_GET['labelid']) : 0;
		$urlType = isset($_GET['type']) ? sanitize_text_field($_GET['type']) : 'edit';
		
		$error = 0;
		/*Label Entry*/
		if(isset($_POST['themedev-ebay-label-submit'])){
			$themedeveBayOptions = \eBayAdvancedSearch\Apps\Settings::sanitize($_POST['themedevebay']);
			
			if(is_array($themedeveBayOptions) && sizeof($themedeveBayOptions) > 0){
				$themedeveBayOptions['date_time'] = date("Y-m-d H:i:s");
				
				if(strlen($themedeveBayOptions['label_name']) == 0){
					$error = 1;
					$message_status = 'yes';
					$message_text = __('Please filed up all filed.', 'themedev-ebay-advanced-search');
				}
				if($error == 0){
					if($labelId > 0 && $urlType == 'edit'){
						$queryData = " AND label_id = '$labelId'";
						$count_return =  \eBayAdvancedSearch\Apps\Settings::ebay_get_count('ebay_advanced_label_info', '*', $queryData);
						// update query
						if($count_return == 1){
							if( $wpdb->update($tableNameLabel, $themedeveBayOptions, ['label_id' => $labelId]) ) :
								$message_status = 'yes';
								$message_text = __('Successfully modify this data.', 'themedev-ebay-advanced-search');
							endif;
						}else{
							$message_status = 'yes';
							$message_text = __('Invalid Data', 'themedev-ebay-advanced-search');
						}
					}else{
						$queryData = " AND label_name = '".$themedeveBayOptions['label_name']."' ";
						$count_return =  \eBayAdvancedSearch\Apps\Settings::ebay_get_count('ebay_advanced_label_info', '*', $queryData);
					 // insert query
						if($count_return == 0){
							if( $wpdb->insert($tableNameLabel, $themedeveBayOptions) ) :
								$id_insert = $wpdb->insert_id;
								$message_status = 'yes';
								$message_text = __('Successfully added this data.', 'themedev-ebay-advanced-search');
							endif;
						}else{
							$message_status = 'yes';
							$message_text = __('Sorry Already Exits.', 'themedev-ebay-advanced-search');
						}
					}
				}
			}
			
		}
		
		$getLabelData = [];
		if($labelId > 0 && $urlType == 'edit'){
			$queryDataSearch = " AND label_id = '$labelId'";
			$getLabelData = \eBayAdvancedSearch\Apps\Settings::ebay_get_result('ebay_advanced_label_info', $queryDataSearch);
			$getLabelData = isset($getLabelData[0]) ? $getLabelData[0] : [];
			
		}else if($labelId > 0 && $urlType == 'delete'){
			$queryData = " AND label_id = '$labelId'";
			$count_return =  \eBayAdvancedSearch\Apps\Settings::ebay_get_count('ebay_advanced_label_info', '*', $queryData);
			if($count_return == 1){
				if( $wpdb->delete($tableNameLabel, ['label_id' => $labelId]) ) :
					$message_status = 'yes';
					$message_text = __('Successfully Deleted this data.', 'themedev-ebay-advanced-search');
				endif;
			}else{
				$message_status = 'yes';
				$message_text = __('Already Deleted this data.', 'themedev-ebay-advanced-search');
			}
		}
		// output of ebay options 
		$queryDataSearch = " AND status = 'Active'";
		$outputDataLabel = \eBayAdvancedSearch\Apps\Settings::ebay_get_result('ebay_advanced_label_info', $queryDataSearch);
		
		
		/*Label data Entry*/
		$dataid = isset($_GET['dataid']) ? intval($_GET['dataid']) : 0;
		$tableNameLabelData =  \eBayAdvancedSearch\Apps\Settings::ebay_options_table('ebay_advanced_label_model_info');
		if(isset($_POST['themedev-ebay-label-data-submit'])){
			$themedeveBayOptions = \eBayAdvancedSearch\Apps\Settings::sanitize($_POST['themedevebay']);
			if(is_array($themedeveBayOptions) && sizeof($themedeveBayOptions) > 0){
				$themedeveBayOptions['date_time'] = date("Y-m-d H:i:s");
				
				if(strlen($themedeveBayOptions['model_name']) == 0){
					$error = 1;
					$message_status = 'yes';
					$message_text = __('Please filed up all filed.', 'themedev-ebay-advanced-search');
				}
				if($error == 0){
					if($dataid > 0 && $urlType == 'edit'){
						$queryData = " AND model_id = '$dataid'";
						$count_return =  \eBayAdvancedSearch\Apps\Settings::ebay_get_count('ebay_advanced_label_model_info', '*', $queryData);
						// update query
						if($count_return == 1){
							if( $wpdb->update($tableNameLabelData, $themedeveBayOptions, ['model_id' => $dataid]) ) :
								$message_status = 'yes';
								$message_text = __('Successfully modify this data.', 'themedev-ebay-advanced-search');
							endif;
						}else{
							$message_status = 'yes';
							$message_text = __('Invalid Data', 'themedev-ebay-advanced-search');
						}
					}else{
						$queryData = " AND model_name = '".$themedeveBayOptions['model_name']."' ";
						$count_return =  \eBayAdvancedSearch\Apps\Settings::ebay_get_count('ebay_advanced_label_model_info', '*', $queryData);
					 // insert query
						if($count_return == 0){
							if( $wpdb->insert($tableNameLabelData, $themedeveBayOptions) ) :
								$id_insert = $wpdb->insert_id;
								$message_status = 'yes';
								$message_text = __('Successfully added this data.', 'themedev-ebay-advanced-search');
							endif;
						}else{
							$message_status = 'yes';
							$message_text = __('Sorry Already Exits.', 'themedev-ebay-advanced-search');
						}
					}
				}
			}
			
		}
		
		$getLabelData2 = [];
		if($dataid > 0 && $urlType == 'edit'){
			$queryDataSearch = " AND model_id = '$dataid'";
			$getLabelData2 = \eBayAdvancedSearch\Apps\Settings::ebay_get_result('ebay_advanced_label_model_info', $queryDataSearch);
			$getLabelData2 = isset($getLabelData2[0]) ? $getLabelData2[0] : [];
			
		}else if($dataid > 0 && $urlType == 'delete'){
			$queryData = " AND model_id = '$dataid'";
			$count_return =  \eBayAdvancedSearch\Apps\Settings::ebay_get_count('ebay_advanced_label_model_info', '*', $queryData);
			if($count_return == 1){
				if( $wpdb->delete($tableNameLabelData, ['model_id' => $dataid]) ) :
					$message_status = 'yes';
					$message_text = __('Successfully Deleted this data.', 'themedev-ebay-advanced-search');
				endif;
			}else{
				$message_status = 'yes';
				$message_text = __('Already Deleted this data.', 'themedev-ebay-advanced-search');
			}
		}
		// output of ebay options 
		$queryDataSearch = " AND model.status = 'Active'";
		$join = " INNER JOIN $tableNameLabel as label ON label.label_id = model.label_id";
		$outputDataNewLabel = \eBayAdvancedSearch\Apps\Settings::ebay_get_result('ebay_advanced_label_model_info as model', $queryDataSearch, $join);
		
		
		/*edit option*/
		$tableName =  \eBayAdvancedSearch\Apps\Settings::ebay_options_table('ebay_advanced_model_info');
		
		$urlId = isset($_GET['ebayid']) ? intval($_GET['ebayid']) : 0;
		
		if(isset($_POST['themedev-ebay-options'])){
			$themedevawsOptions = \eBayAdvancedSearch\Apps\Settings::sanitize($_POST['themedevebay']);
			if(is_array($themedevawsOptions) && sizeof($themedevawsOptions) > 0){
				$themedevawsOptions['date_time'] = date("Y-m-d H:i:s");
				
				if($urlId > 0 && $urlType == 'edit'){
					$queryData = " AND options_id = '$urlId'";
					$count_return =  \eBayAdvancedSearch\Apps\Settings::ebay_get_count('ebay_advanced_model_info', '*', $queryData);
					// update query
					if($count_return == 1){
						if( $wpdb->update($tableName, $themedevawsOptions, ['options_id' => $urlId]) ) :
							$message_status = 'yes';
							$message_text = __('Successfully modify this data.', 'themedev-ebay-advanced-search');
						endif;
					}else{
						$message_status = 'yes';
						$message_text = __('Invalid Data', 'themedev-ebay-advanced-search');
					}
				}else{
					$queryData = " AND model_name = '".$themedevawsOptions['model_name']."' AND  issues_name = '".$themedevawsOptions['issues_name']."' ";
					$count_return =  \eBayAdvancedSearch\Apps\Settings::ebay_get_count('ebay_advanced_model_info', '*', $queryData);
				 // insert query
					if($count_return == 0){
						if( $wpdb->insert($tableName, $themedevawsOptions) ) :
							$id_insert = $wpdb->insert_id;
							$message_status = 'yes';
							$message_text = __('Successfully added this data.', 'themedev-ebay-advanced-search');
						endif;
					}else{
						$message_status = 'yes';
						$message_text = __('Sorry Already Exits.', 'themedev-ebay-advanced-search');
					}
				}
			}
			
		}
		
		$getData = [];
		if($urlId > 0 && $urlType == 'edit'){
			$queryDataSearch = " AND options_id = '$urlId'";
			$getData = \eBayAdvancedSearch\Apps\Settings::ebay_get_result('ebay_advanced_model_info', $queryDataSearch);
			$getData = isset($getData[0]) ? $getData[0] : [];
			
		}else if($urlId > 0 && $urlType == 'delete'){
			$queryData = " AND options_id = '$urlId'";
			$count_return =  \eBayAdvancedSearch\Apps\Settings::ebay_get_count('ebay_advanced_model_info', '*', $queryData);
			if($count_return == 1){
				if( $wpdb->delete($tableName, ['options_id' => $urlId]) ) :
					$message_status = 'yes';
					$message_text = __('Successfully Deleted this data.', 'themedev-ebay-advanced-search');
				endif;
			}else{
				$message_status = 'yes';
				$message_text = __('Already Deleted this data.', 'themedev-ebay-advanced-search');
			}
		}
		// output of ebay options 
		$queryDataSearch = " AND status = 'Active'";
		$outputData = \eBayAdvancedSearch\Apps\Settings::ebay_get_result('ebay_advanced_model_info', $queryDataSearch);
		
		include ( WP_EBAY_SEARCH_PLUGIN_PATH.'views/admin/admin-options.php' );
	 }
	  /**
     * Search Product page
     * Method Description: Search product page
     * @since 1.0.0
     * @access public
     */
	 public function ebay_settings_admin(){
		
		// check page
		if(!file_exists( WP_EBAY_SEARCH_PLUGIN_PATH.'views/admin/settings.php' )){
			die('settings.php file could not found');
		}
		$message_status = 'no';
		$message_text = '';
		
		// setting data store
		$settingsKeyThemeDev = 'themedev-ebay-credentials';
		if(isset($_POST['themedev-ebay-setting'])){
			$themedeveBayOptions = \eBayAdvancedSearch\Apps\Settings::sanitize($_POST['themedevebay']);
			if(is_array($themedeveBayOptions) && sizeof($themedeveBayOptions) > 0){
				 if(update_option( $settingsKeyThemeDev, $themedeveBayOptions, 'Yes' )){
					$message_status = 'yes';
					$message_text = 'eBay Credentials data have been updated.';	
				}
			}
			
		}
		// output for ebay Credentials
        $return_data_ebay_credentials = get_option($settingsKeyThemeDev);
		
		// setting data store
		$generalKeyThemeDev = 'themedev-ebay-general';
		if(isset($_POST['themedev-ebay-general'])){
			$themedeveBayOptions = \eBayAdvancedSearch\Apps\Settings::sanitize($_POST['themedevebay']);
			
			if(is_array($themedeveBayOptions) && sizeof($themedeveBayOptions) > 0){
				 if(update_option( $generalKeyThemeDev, $themedeveBayOptions, 'Yes' )){
					$message_status = 'yes';
					$message_text = 'Successfully Save General data.';	
				}
			}
			
		}
		// output for ebay global options
        $return_data_ebay_general = get_option($generalKeyThemeDev);
		
		// setting data store
		$globalKeyThemeDev = 'themedev-ebay-global';
		if(isset($_POST['themedev-ebay-global'])){
			$themedeveBayOptions = \eBayAdvancedSearch\Apps\Settings::sanitize($_POST['themedevebay']);
			if(is_array($themedeveBayOptions) && sizeof($themedeveBayOptions) > 0){
				 if(update_option( $globalKeyThemeDev, $themedeveBayOptions, 'Yes' )){
					$message_status = 'yes';
					$message_text = 'Successfully Save Global data.';	
				}
			}
			
		}
		// output for ebay global options
        $return_data_ebay_global = get_option($globalKeyThemeDev);
		
		include ( WP_EBAY_SEARCH_PLUGIN_PATH.'views/admin/settings.php' );
	 }
	 
	 /**
     *  ebay_settings_css_loader .
     * Method Description: Settings Css Loader
     * @since 1.0.0
     * @access public
     */
     public function ebay_settings_css_loader(){
        wp_register_style( 'ebay_search_settings_css', WP_EBAY_SEARCH_PLUGIN_URL. 'assets/admin/css/admin-settings.css');
        wp_enqueue_style( 'ebay_search_settings_css' );
		
     }
     /**
     *  ebay_settings_script_loader .
     * Method Description: Settings Script Loader
     * @since 1.0.0
     * @access public
     */
    public function ebay_settings_script_loader(){
        wp_register_script( 'ebay_searc_settings_script', WP_EBAY_SEARCH_PLUGIN_URL. 'assets/admin/scripts/admin-settings.js', array('jquery'));
        wp_enqueue_script( 'ebay_searc_settings_script' );
		
     }
}