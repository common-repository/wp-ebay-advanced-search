<?php
$active_tab = isset($_GET["tab"]) ? $_GET["tab"] : 'label';
?>
 <h2 class="nav-tab-wrapper">
	<a href="<?php echo esc_url(admin_url().'admin.php?page=themedev-ebay-search-advanced&tab=label');?>" class="nav-tab <?php if($active_tab == 'label'){echo 'nav-tab-active';} ?> "><?php echo esc_html__('Label ', 'themedev-ebay-advanced-search');?></a>
	<a href="<?php echo esc_url(admin_url().'admin.php?page=themedev-ebay-search-advanced&tab=label-data');?>" class="nav-tab <?php if($active_tab == 'label-data'){echo 'nav-tab-active';} ?> "><?php echo esc_html__('Label Data', 'themedev-ebay-advanced-search');?></a>
	
</h2>