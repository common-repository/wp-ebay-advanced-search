
<section class="<?php echo esc_attr('themeDev-ebay-body');?>">
	<h2><?php echo esc_html__('Search Options', 'themedev-ebay-advanced-search');?></h2>
	<?php require ( WP_EBAY_SEARCH_PLUGIN_PATH.'views/admin/tab-menu-admin.php' );?>
	<?php if($message_status == 'yes'){?>
    <div class="">
        <div class ="notice is-dismissible" style="margin: 1em 0px; visibility: visible; opacity: 1;">
            <p><?php echo esc_html__(''.$message_text.' ', 'themedev-ebay-advanced-search');?></p>
            <button type="button" class="notice-dismiss"><span class="screen-reader-text"><?php echo esc_html__('Dismiss this notice.', 'xs-social-login');?></span></button>
        </div>
    </div>
    <?php }?>
	
</section>	
 <?php
 if($active_tab == 'label'){ 
	include( __DIR__ .'/include/admin/admin-label.php');
 }else if($active_tab == 'label-data'){
	 include( __DIR__ .'/include/admin/admin-label-data.php');
 }else if($active_tab == 'global'){
	 include( __DIR__ .'/include/option-global.php');
 }else if($active_tab == 'shotrcode'){
	 include( __DIR__ .'/include/option-shotrcode.php');
 }
 ?>