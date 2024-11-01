<h3><?php echo esc_html__('Search Filter Options', 'themedev-ebay-advanced-search');?></h3>
<form action="<?php echo esc_url(admin_url().'admin.php?page=themedev-ebay-settings&tab=filter');?>" name="setting_ebay_form" method="post" >
	
	<div class="<?php echo esc_attr('themeDev-ebay-form');?>">
		<label for="ebay_show_sold_product" class="inline-label">
			<?php echo esc_html__('Enable Sold Items ', 'themedev-ebay-advanced-search');?>
		</label>
		
		<input type="checkbox" name="themedevebay[show_sold_product]" <?php echo isset($return_data_ebay_general['show_sold_product']) ? 'checked' : ''; ?> class="themedev-switch-input" value="Yes" id="themedev-switch-control"></input>
		<label class="themedev-checkbox-switch" for="themedev-switch-control">
			<span class="themedev-admin-control-label-switch" data-active="ON" data-inactive="OFF"></span>
		</label>
		<span class="themedev-document-info"> <?php echo esc_html__('Show sold item only . When On this switch.', 'themedev-ebay-advanced-search');?></span>
	</div>
	
	<div class="<?php echo esc_attr('themeDev-ebay-form');?>">
		<label for="ebay_enable_fromdate" class="inline-label">
			<?php echo esc_html__('Enable From Date ', 'themedev-ebay-advanced-search');?>
		</label>
		
		<input type="checkbox" name="themedevebay[enable_from_date]" <?php echo isset($return_data_ebay_general['enable_from_date']) ? 'checked' : ''; ?> class="themedev-switch-input" value="Yes" id="themedev-switch-control-formdate"></input>
		<label class="themedev-checkbox-switch" for="themedev-switch-control-formdate">
			<span class="themedev-admin-control-label-switch" data-active="ON" data-inactive="OFF"></span>
		</label>
		<span class="themedev-document-info"> <?php echo esc_html__('Added From date parameter in searching form.', 'themedev-ebay-advanced-search');?></span>
	</div>
	<div class="<?php echo esc_attr('themeDev-ebay-form');?>">
		<label for="ebay_enable_fromdate" class="inline-label">
			<?php echo esc_html__('Enable To Date ', 'themedev-ebay-advanced-search');?>
		</label>
		
		<input type="checkbox"  name="themedevebay[enable_to_date]" <?php echo isset($return_data_ebay_general['enable_to_date']) ? 'checked' : ''; ?> class="themedev-switch-input" value="Yes" id="themedev-switch-control-todate"></input>
		<label class="themedev-checkbox-switch" for="themedev-switch-control-todate">
			<span class="themedev-admin-control-label-switch" data-active="ON" data-inactive="OFF"></span>
		</label>
		<span class="themedev-document-info"> <?php echo esc_html__('Added To date parameter in searching form.', 'themedev-ebay-advanced-search');?></span>
	</div>
	<div class="<?php echo esc_attr('themeDev-ebay-form');?>">
		<label for="ebay_enable_fromdate" class="inline-label">
			<?php echo esc_html__('Enable Min Price ', 'themedev-ebay-advanced-search');?>
		</label>
		
		<input type="checkbox"  name="themedevebay[enable_min_price]" <?php echo isset($return_data_ebay_general['enable_min_price']) ? 'checked' : ''; ?> class="themedev-switch-input" value="Yes" id="themedev-switch-control-enable_min_price"></input>
		<label class="themedev-checkbox-switch" for="themedev-switch-control-enable_min_price">
			<span class="themedev-admin-control-label-switch" data-active="ON" data-inactive="OFF"></span>
		</label>
		<span class="themedev-document-info"> <?php echo esc_html__('Added Min Price parameter in searching form.', 'themedev-ebay-advanced-search');?></span>
	</div>
	<div class="<?php echo esc_attr('themeDev-ebay-form');?>">
		<label for="ebay_enable_fromdate" class="inline-label">
			<?php echo esc_html__('Enable Max Price ', 'themedev-ebay-advanced-search');?>
		</label>
		
		<input type="checkbox"  name="themedevebay[enable_max_price]" <?php echo isset($return_data_ebay_general['enable_max_price']) ? 'checked' : ''; ?> class="themedev-switch-input" value="Yes" id="themedev-switch-control-enable_max_price"></input>
		<label class="themedev-checkbox-switch" for="themedev-switch-control-enable_max_price">
			<span class="themedev-admin-control-label-switch" data-active="ON" data-inactive="OFF"></span>
		</label>
		<span class="themedev-document-info"> <?php echo esc_html__('Added Max Price parameter in searching form.', 'themedev-ebay-advanced-search');?></span>
	</div>
	<div class="<?php echo esc_attr('themeDev-ebay-form');?>">
		<label for="ebay_short_list_list" class="inline-label">
			 <?php echo esc_html__('Listing Type:', 'themedev-ebay-advanced-search');?>
		</label>
		<?php
		$listTingType = \eBayAdvancedSearch\Apps\Settings::get_listing_type();
		$getListing  = isset($return_data_ebay_general['listing_type']) ? $return_data_ebay_general['listing_type'] : [];
		//print_r($getListing);
		?>
		<select name="themedevebay[listing_type][]" class="regular-text code themeDev-select " id="ebay_short_list_list" multiple>
			<?php 
			if(is_array($listTingType) AND sizeof($listTingType) > 0):
				
				foreach($listTingType AS $k=>$v):	
				?>
				<option value="<?php echo esc_html($k);?>" <?php echo (in_array($k, $getListing)) ? 'selected' : ''?>> <?php echo esc_html($v) ;?> </option>
				<?php
				endforeach;
			endif;
			?>
		</select>
		
	</div>
	<div class="<?php echo esc_attr('themeDev-ebay-form');?> ">
		<label for="ebay_short_list_list" class="inline-label">
			 <?php echo esc_html__('Condition :', 'themedev-ebay-advanced-search');?>
		</label>
		<?php
		$conditionType = \eBayAdvancedSearch\Apps\Settings::get_condition();
		$getCondition  = isset($return_data_ebay_general['condition']) ? $return_data_ebay_general['condition'] : [];
		
		?>
		<select name="themedevebay[condition][]" class="regular-text code themeDev-select " id="ebay_short_list_list" multiple>
			<?php 
			if(is_array($conditionType) AND sizeof($conditionType) > 0):
				
				foreach($conditionType AS $k=>$v):	
				?>
				<option value="<?php echo esc_html($k);?>" <?php echo (in_array($k, $getCondition)) ? 'selected' : ''?>> <?php echo esc_html($v) ;?> </option>
				<?php
				endforeach;
			endif;
			?>
		</select>
		
	</div>
	<div class="<?php echo esc_attr('themeDev-ebay-form');?>">
		<button type="submit" name="themedev-ebay-general" class="themedev-ebay-submit"> <?php echo esc_html__('Save ', 'themedev-ebay-advanced-search');?></button>
	</div>
</form>