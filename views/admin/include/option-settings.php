<h3><?php echo esc_html__('Settings', 'themedev-ebay-advanced-search');?></h3>
<form action="<?php echo esc_url(admin_url().'admin.php?page=themedev-ebay-settings');?>" name="setting_ebay_form" method="post" >
	<div class="<?php echo esc_attr('themeDev-ebay-form');?>">
		<label for="ebay_access_id">
			<?php echo esc_html__('Security App Name: ', 'themedev-ebay-advanced-search');?>
		</label>
		<input class="regular-text code themedev-input-text " type="text" id="ebay_access_id" name="themedevebay[ebay_access_id]" value="<?php echo isset($return_data_ebay_credentials['ebay_access_id']) ? esc_html($return_data_ebay_credentials['ebay_access_id']) : ''; ?>">
	</div>	
	<div class="<?php echo esc_attr('themeDev-ebay-form');?>">
		<label for="ebay_operation_list">
			 <?php echo esc_html__('Select Operation:', 'themedev-ebay-advanced-search');?>
		</label>
		<?php
		$operation = \eBayAdvancedSearch\Apps\Settings::get_operation();
		$getOperation  = isset($return_data_ebay_credentials['ebay_access_operation']) ? $return_data_ebay_credentials['ebay_access_operation'] : 'findCompletedItems';
		?>
		<select name="themedevebay[ebay_access_operation]" class="regular-text code themeDev-select " id="ebay_operation_list">
			<?php 
			if(is_array($operation) AND sizeof($operation) > 0):
				
				foreach($operation AS $k=>$v):	
				?>
				<option value="<?php echo esc_html($k);?>" <?php echo ($getOperation === $k) ? 'selected' : ''?>> <?php echo esc_html($v) ;?> </option>
				<?php
				endforeach;
			endif;
			?>
		</select>
		
	</div>
	<div class="<?php echo esc_attr('themeDev-ebay-form');?>">
		<label for="ebay_global_list">
			 <?php echo esc_html__('Select Global ID (Optional):', 'themedev-ebay-advanced-search');?>
		</label>
		<?php
		$global = \eBayAdvancedSearch\Apps\Settings::get_global_id();
		$getGlobal  = isset($return_data_ebay_credentials['ebay_access_global_id']) ? $return_data_ebay_credentials['ebay_access_global_id'] : '';
		?>
		<select name="themedevebay[ebay_access_global_id]" class="regular-text code themeDev-select" id="ebay_global_list">
			<option value=""> All </option>
			<?php 
			if(is_array($global) AND sizeof($global) > 1):
				foreach($global AS $k=>$v):	
				?>
				<option value="<?php echo esc_html($k);?>" <?php echo ($getGlobal === $k) ? 'selected' : ''?>> <?php echo esc_html($v) ;?> </option>
				<?php
				endforeach;
			endif;
			?>
		</select>
		
	</div>
	<div class="<?php echo esc_attr('themeDev-ebay-form');?>">
		<button type="submit" name="themedev-ebay-setting" class="themedev-ebay-submit"> <?php echo esc_html__('Save ', 'themedev-ebay-advanced-search');?></button>
	</div>
</form>