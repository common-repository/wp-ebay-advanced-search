<?php
$active_tab = isset($_GET["tab"]) ? $_GET["tab"] : 'settings';
?>
 <h2 class="nav-tab-wrapper">
	<a href="<?php echo esc_url(admin_url().'admin.php?page=themedev-ebay-settings&tab=global');?>" class="nav-tab <?php if($active_tab == 'global'){echo 'nav-tab-active';} ?> "><?php echo esc_html__('Global Settings', 'themedev-ebay-advanced-search');?></a>
	<a href="<?php echo esc_url(admin_url().'admin.php?page=themedev-ebay-settings&tab=filter');?>" class="nav-tab <?php if($active_tab == 'filter'){echo 'nav-tab-active';} ?>"><?php echo esc_html__('Search Filter', 'themedev-ebay-advanced-search');?></a>
	<a href="<?php echo esc_url(admin_url().'admin.php?page=themedev-ebay-settings&tab=shotrcode');?>" class="nav-tab <?php if($active_tab == 'shotrcode'){echo 'nav-tab-active';} ?>"><?php echo esc_html__('Shortcode', 'themedev-ebay-advanced-search');?></a>
	<a href="<?php echo esc_url(admin_url().'admin.php?page=themedev-ebay-settings&tab=settings');?>" class="nav-tab <?php if($active_tab == 'settings'){echo 'nav-tab-active';} ?>"><?php echo esc_html__('Settings', 'themedev-ebay-advanced-search');?></a>
</h2>