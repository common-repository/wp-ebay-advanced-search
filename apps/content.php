<?php
namespace eBayAdvancedSearch\Apps;
if( ! defined( 'ABSPATH' )) die( 'Forbidden' );
class Content{
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
		// Load css file for settings page
        add_action( 'wp_enqueue_scripts', [$this, 'ebay_settings_css_loader_public' ] );

        // Load script file for settings page
        add_action( 'wp_enqueue_scripts', [$this, 'ebay_settings_script_loader_public' ] );
		
		// action init rest	
		add_action('init', [ $this, 'ebay_init_rest' ]); 
		// add shortcode options
		add_shortcode( 'advanced-ebay-search-forms', [ $this, 'ebay_search_forms_shortcode' ] );
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
     *  ebay shortcode .
     * Method Description: Generate shortcode for wordpress
     * @since 1.0.0
     * @access public
     */
	 public function ebay_search_forms_shortcode( $atts , $content = null ){
		// get label data
		$queryDataSearch = " AND status = 'Active'";
		$outputDataLabel = \eBayAdvancedSearch\Apps\Settings::ebay_get_result('ebay_advanced_label_info', $queryDataSearch);
		
		// general options
		$generalKeyThemeDev = 'themedev-ebay-general';
		$getGeneral = get_option($generalKeyThemeDev);
		
		$atts = shortcode_atts(
				[
					'id' => 'ebay-content',
					'class' => 'ebay-content',
				], $atts, 'advanced-ebay-search-forms' 
		);
		$className = isset($atts['class']) ? $atts['class'] : '';
		$idName = isset($atts['id']) ? $atts['id'] : '';
		$keywords = '';
		if(is_array($outputDataLabel) && !empty($outputDataLabel)):
			$m = 0;
			foreach($outputDataLabel as $v):
				$getKeyword  = isset($_GET['search_'.$m]) ? \eBayAdvancedSearch\Apps\Settings::sanitize($_GET['search_'.$m]) : '';
					
				if(is_array($getKeyword) && !empty($getKeyword)){
					$keywords .= implode(' or ', $getKeyword);
				}else{	
					$keywords .= strlen($getKeyword) > 0 ? urlencode(utf8_encode($getKeyword)).' or ' : '';
				}
			$m++;
			endforeach;
		endif;
		
		$getPage  = isset($_GET['ebay-page']) ? intval($_GET['ebay-page']) : 1;
		$dataUrl = [];
		
		$startDate = time();
		$dateMonth = date('Y-m-d', strtotime('-1 month', $startDate)).'T19:09:02.768Z';
		$todate = date('Y-m-d').'T00:00:00.000Z';
		
		$dataUrl['descriptionSearch'] = true;
		
		$dataUrl['paginationInput.pageNumber'] = $getPage;
		$dataUrl['keywords'] = $keywords;
		
		$itemFilter = [];
		
		if(isset($getGeneral['show_sold_product']) && $getGeneral['show_sold_product'] == 'Yes'){
			$itemFilter['SoldItemsOnly'] = true;
		}
		if(isset($getGeneral['enable_from_date']) && $getGeneral['enable_from_date'] == 'Yes'){
			$itemFilter['EndTimeFrom'] = $dateMonth;
		}
		if(isset($getGeneral['enable_to_date']) && $getGeneral['enable_to_date'] == 'Yes'){
			$itemFilter['EndTimeTo'] = $todate;
		}
		
		if(isset($getGeneral['listing_type']) && sizeof($getGeneral['listing_type']) > 0 ){
			$itemFilter['ListingType'] = $getGeneral['listing_type'];
		}
		
		if(isset($getGeneral['condition']) && sizeof($getGeneral['condition']) > 0 ){
			$itemFilter['Condition'] = $getGeneral['condition'];
		}
		if(isset($getGeneral['enable_min_price']) && $getGeneral['enable_min_price'] == 'Yes'){
			$getMinPrice  = isset($_GET['minprice']) ? intval($_GET['minprice']) : 1;		
			if($getMinPrice > 0):
				$itemFilter['MinPrice'] = $getMinPrice;
			endif;
		}
		if(isset($getGeneral['enable_max_price']) && $getGeneral['enable_max_price'] == 'Yes'){
			$getMaxPrice  = isset($_GET['maxprice']) ? intval($_GET['maxprice']) : 0;	
			if($getMaxPrice > 0):
				$itemFilter['MaxPrice'] = $getMaxPrice;
			endif;
		}
		
		if(is_array($itemFilter) && sizeof($itemFilter) > 0){
			$m = 0;
			foreach($itemFilter as $k=>$v){
				$dataUrl['itemFilter('.$m.').name'] = $k;
				if(is_array($v) && sizeof($v) > 0){
					$n = 0;
					foreach($v as $value):
						$dataUrl['itemFilter('.$m.').value('.$n.')'] = $value;
						$n++;
					endforeach;
				}else{
					$dataUrl['itemFilter('.$m.').value(0)'] = $v;
				}
				$m++;
			}
		}
		
		$dataUrl['outputSelector(0)'] = 'PictureURLLarge';
		$dataUrl['outputSelector(1)'] = 'SellerInfo';
		
		
		$getData = \eBayAdvancedSearch\Apps\Settings::ebay_api_call($dataUrl);
		// get content of search and include in shortcode.
		
		
		ob_start();
		include( WP_EBAY_SEARCH_PLUGIN_PATH . 'views/public/search.php');
		$content = ob_get_contents();
		ob_end_clean();
		return $content;
	 }
	 
	 /**
     * Donate ebay_init_rest .
     * Method Description: load rest api
     * @since 1.0.0
     * @access for public
     */ 
	 public function ebay_init_rest(){
		add_action( 'rest_api_init', function () {
		  register_rest_route( 'ebay-search-form', '/search/(?P<keyword>\w+)/', 
			array(
				'methods' => 'GET',
				'callback' => [$this, 'ebay_action_rest_search_form'],
			  ) 
		  );
		} );
		
    }
	 /**
     *  ebay_settings_css_loader .
     * Method Description: Settings Css Loader
     * @since 1.0.0
     * @access public
     */
     public function ebay_settings_css_loader_public(){
        wp_register_style( 'ebay_search_settings_css_public', WP_EBAY_SEARCH_PLUGIN_URL. 'assets/public/css/public-style.css');
        wp_enqueue_style( 'ebay_search_settings_css_public' );

		// select 2
		wp_register_style( 'wfp_select2css', WP_EBAY_SEARCH_PLUGIN_URL. 'assets/select2/css/select2-min.css', false, '1.0', 'all' );
		wp_register_script( 'wfp_select2', WP_EBAY_SEARCH_PLUGIN_URL. 'assets/select2/script/select2-min.js', array( 'jquery' ), '1.0', true );
		wp_enqueue_style( 'wfp_select2css' );
		wp_enqueue_script( 'wfp_select2' );
		
     }
     /**
     *  ebay_settings_script_loader .
     * Method Description: Settings Script Loader
     * @since 1.0.0
     * @access public
     */
    public function ebay_settings_script_loader_public(){
        wp_register_script( 'ebay_searc_settings_script', WP_EBAY_SEARCH_PLUGIN_URL. 'assets/public/scripts/public-script.js', array('jquery'));
        wp_enqueue_script( 'ebay_searc_settings_script' );
		
     }
}