<h3><?php echo esc_html__('Global', 'themedev-ebay-advanced-search');?></h3>
<form action="<?php echo esc_url(admin_url().'admin.php?page=themedev-ebay-settings&tab=global');?>" name="setting_ebay_form" method="post" >
	<div class="<?php echo esc_attr('themeDev-ebay-form');?>">
		<label for="ebay_short_order_list">
			 <?php echo esc_html__('Sort Order:', 'themedev-ebay-advanced-search');?>
		</label>
		<?php
		$orderLiust = \eBayAdvancedSearch\Apps\Settings::get_sort_order();
		$getOrder  = isset($return_data_ebay_global['short_order']) ? $return_data_ebay_global['short_order'] : 'BestMatch';
		?>
		<select name="themedevebay[short_order]" class="regular-text code themeDev-select " id="ebay_short_order_list">
			<?php 
			if(is_array($orderLiust) AND sizeof($orderLiust) > 0):
				
				foreach($orderLiust AS $k=>$v):	
				?>
				<option value="<?php echo esc_html($k);?>" <?php echo ($getOrder === $k) ? 'selected' : ''?>> <?php echo esc_html($v) ;?> </option>
				<?php
				endforeach;
			endif;
			?>
		</select>
		
	</div>
	<div class="<?php echo esc_attr('themeDev-ebay-form');?>">
		<label for="ebay_perpage">
			<?php echo esc_html__('Per Page: ', 'themedev-ebay-advanced-search');?>
		</label>
		<input class="regular-text code themedev-input-text " type="number" id="ebay_perpage" name="themedevebay[per_page]" value="<?php echo isset($return_data_ebay_global['per_page']) ? esc_html($return_data_ebay_global['per_page']) : 10; ?>">
	</div>	
	
	<div class="<?php echo esc_attr('themeDev-ebay-form');?>">
		<button type="submit" name="themedev-ebay-global" class="themedev-ebay-submit"> <?php echo esc_html__('Save ', 'themedev-ebay-advanced-search');?></button>
	</div>
</form>