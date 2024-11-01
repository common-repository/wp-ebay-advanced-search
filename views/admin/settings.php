<section class="<?php echo esc_attr('themeDev-ebay-body');?>">
	<h2><?php echo esc_html__('eBay Advanced Search', 'themedev-ebay-advanced-search');?></h2>
	<?php require ( WP_EBAY_SEARCH_PLUGIN_PATH.'views/admin/tab-menu-settings.php' );?>
	<?php if($message_status == 'yes'){?>
    <div class="">
        <div class ="notice is-dismissible" style="margin: 1em 0px; visibility: visible; opacity: 1;">
            <p><?php echo esc_html__(''.$message_text.' ', 'themedev-ebay-advanced-search');?></p>
            <button type="button" class="notice-dismiss"><span class="screen-reader-text"><?php echo esc_html__('Dismiss this notice.', 'xs-social-login');?></span></button>
        </div>
    </div>
    <?php }?>
	 <?php
	 if($active_tab == 'settings'){ 
		include( __DIR__ .'/include/option-settings.php');
	 }else if($active_tab == 'filter'){
		 include( __DIR__ .'/include/option-filter.php');
	 }else if($active_tab == 'global'){
		 include( __DIR__ .'/include/option-global.php');
	 }else if($active_tab == 'shotrcode'){
		 include( __DIR__ .'/include/option-shotrcode.php');
	 }
	 ?>
</section>
