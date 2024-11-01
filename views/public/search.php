<?php
$totalItem = isset($getData[0]->item) ? $getData[0]->item : [];
$current_url = get_permalink().'?';
?>
<section class="<?php echo esc_attr('themeDev-ebay-body ebay-search-filter');?>">
	<div class="ebay-content <?php echo esc_attr($className);?>" id="<?php echo esc_attr($idName);?>">
		<form action="" name="setting_ebay_form" method="get" >
			<div class="flex-div">
				<?php
				if(is_array($outputDataLabel) && !empty($outputDataLabel)):
					$m = 0;
					$queryBuild = [];
					foreach($outputDataLabel as $v):
					$getKeyword  = isset($_GET['search_'.$m]) ? \eBayAdvancedSearch\Apps\Settings::sanitize($_GET['search_'.$m]) : '';
					
					$queryDataSearch = " AND label_id = ".$v->label_id." AND status = 'Active'";
					$outputDataNewLabel = \eBayAdvancedSearch\Apps\Settings::ebay_get_result('ebay_advanced_label_model_info', $queryDataSearch);
					$queryBuild['search_'.$m] = $getKeyword;
					if(strlen($v->label_name) > 0){
				?>
				<div class="flex-item model-search">
					<label for="search_label_<?php echo $m;?>"><?php echo esc_html__($v->label_name.' : ', 'themedev-ebay-advanced-search')?></label>
					<?php if($v->label_type === 'Select'){?>
						<?php if(is_array($outputDataNewLabel) && !empty($outputDataNewLabel)):?>
							<select name="search_<?php echo $m;?>" id="search_label_<?php echo $m;?>"  class="ebay-search-select ebay-select2-themedev">
								<option value=""> All </option>
								<?php foreach($outputDataNewLabel as $va):
								if( strlen($va->model_name) > 0 ){
								?>
									<option value="<?php echo esc_html($va->model_name);?>" <?php echo ($getKeyword == $va->model_name) ? 'selected' : '';?>> <?php echo esc_html($va->model_name);?> </option>
								<?php 
								}
								endforeach;
								?>
							</select>
						<?php endif;?>
					<?php }else if(in_array($v->label_type, ['Text', 'Number'])){?>
							<input type="<?php echo strtolower($v->label_type);?>" class="ebay-search-<?php echo strtolower($v->label_type);?>" id="search_label_<?php echo $m;?>" name="search_<?php echo $m;?>" value="<?php echo $getKeyword;?>" >
					<?php }else if(in_array($v->label_type, ['Checkbox', 'Radio'])){?>
						<ul class="ebay-search-ul" style="list-style:none;">
						<?php 
						$n = 0;
						$newData = is_array($getKeyword) && !empty($getKeyword) ? $getKeyword : [] ;
						$newData =  \eBayAdvancedSearch\Apps\Settings::sanitize($newData);
						
						foreach($outputDataNewLabel as $va):
							$check = '';
							if(sizeof($newData) > 0){
								$check = (in_array($va->model_name, $newData)) ? 'checked' : '';
							}
							if(strlen($va->model_name) > 0){
						?>
							<li><label class="condition-items">
								<input type="<?php echo strtolower($v->label_type);?>" name="search_<?php echo $m;?>[]" class="ebay-search-<?php echo strtolower($v->label_type);?>" value="<?php echo esc_html($va->model_name);?>" <?php echo $check;?>><?php echo esc_html($va->model_name);?> 
							</label>
							</li>
						<?php $n++;
							}
						endforeach;?>
						</ul>
					<?php }?>
				</div>
				
				<?php 
					}
					$m++;
				endforeach;
			endif;
			if(isset($getGeneral['enable_min_price']) && $getGeneral['enable_min_price'] == 'Yes'){
				$queryBuild['minprice'] = $getMinPrice;
				?>
				<div class="flex-item min_price-search">
					<label class="min_price" for="color_min_price"><?php echo esc_html__('Min Price : ', 'themedev-ebay-advanced-search')?></label>
					<input type="number" id="color_min_price" name="minprice" value="<?php echo esc_html($getMinPrice);?>" >
				</div>
			<?php }
			if(isset($getGeneral['enable_max_price']) && $getGeneral['enable_max_price'] == 'Yes'){
				$queryBuild['maxprice'] = $getMaxPrice;
				?>
				<div class="flex-item max_price-search">
					<label class="min_price" for="color_max_price"><?php echo esc_html__('Max Price : ', 'themedev-ebay-advanced-search')?></label>
					<input type="number" id="color_max_price" name="maxprice" value="<?php echo esc_html($getMaxPrice);?>" >
				</div>
			<?php }?>
			</div>
			<div class="<?php echo esc_attr('themeDev-ebay-form');?>">
				<button type="submit" class="themedev-ebay-submit"> <?php echo esc_html__('Search ', 'themedev-ebay-advanced-search');?></button>
			</div>
		</form>
	</div>
</section>
<section class="<?php echo esc_attr('themeDev-ebay-body ebay-product-list');?>">
	<div class="ebay-content <?php echo esc_attr($className);?>" id="<?php echo esc_attr($idName);?>">
		<?php
			$current_url .= http_build_query($queryBuild, '&');
			if(is_array($totalItem) && sizeof($totalItem) > 0){
				foreach($totalItem as $value):
					$itemId = isset($value->itemId[0]) ? $value->itemId[0] : '';
					$title = isset($value->title[0]) ? $value->title[0] : '';
					
					$globalId = isset($value->globalId[0]) ? $value->globalId[0] : '';
					
					$categoryId = isset($value->primaryCategory[0]->categoryId[0]) ? $value->primaryCategory[0]->categoryId[0] : '';
					$categoryName = isset($value->primaryCategory[0]->categoryName[0]) ? $value->primaryCategory[0]->categoryName[0] : '';
					
					$galleryURL = isset($value->galleryURL[0]) ? $value->galleryURL[0] : '';
					$pictureURLLarge = isset($value->pictureURLLarge[0]) ? $value->pictureURLLarge[0] : '';
					$viewItemURL = isset($value->viewItemURL[0]) ? $value->viewItemURL[0] : '';
					
					$sellerUserName = isset($value->sellerInfo[0]->sellerUserName[0]) ? $value->sellerInfo[0]->sellerUserName[0] : '';
					$feedbackScore = isset($value->sellerInfo[0]->feedbackScore[0]) ? $value->sellerInfo[0]->feedbackScore[0] : '';
					$positiveFeedbackPercent = isset($value->sellerInfo[0]->positiveFeedbackPercent[0]) ? $value->sellerInfo[0]->positiveFeedbackPercent[0] : '';
					$feedbackRatingStar = isset($value->sellerInfo[0]->feedbackRatingStar[0]) ? $value->sellerInfo[0]->feedbackRatingStar[0] : '';
					$topRatedSeller = isset($value->sellerInfo[0]->topRatedSeller[0]) ? $value->sellerInfo[0]->topRatedSeller[0] : '';
					
					$shippingType = isset($value->shippingInfo[0]->shippingType[0]) ? $value->shippingInfo[0]->shippingType[0] : '';
					$shipToLocations = isset($value->shippingInfo[0]->shipToLocations[0]) ? $value->shippingInfo[0]->shipToLocations[0] : '';
					
					$rateShipping = isset($value->shippingInfo[0]->shippingServiceCost[0]->__value__) ? $value->shippingInfo[0]->shippingServiceCost[0]->__value__ : 0;
					
					$currentPriceData = isset($value->sellingStatus[0]->currentPrice[0]) ? (array) $value->sellingStatus[0]->currentPrice[0] : [];
					
					$currentPrice = isset($currentPriceData['__value__']) ? $currentPriceData['__value__'] : 0;
					$currentCurrency = isset($currentPriceData['@currencyId']) ? $currentPriceData['@currencyId'] : '';
					
					$sellingState = isset($value->sellingStatus[0]->sellingState[0]) ? $value->sellingStatus[0]->sellingState[0] : '';
					
					// listing Info
					$listingInfo = isset($value->listingInfo[0]) ? $value->listingInfo[0] : [];
					$bestOfferEnabled = isset($listingInfo->bestOfferEnabled[0]) ? $listingInfo->bestOfferEnabled[0] : '';
					$buyItNowAvailable = isset($listingInfo->buyItNowAvailable[0]) ? $listingInfo->buyItNowAvailable[0] : '';
					$startTime = isset($listingInfo->startTime[0]) ? $listingInfo->startTime[0] : '';
					$endTime = isset($listingInfo->endTime[0]) ? $listingInfo->endTime[0] : '';
					$listingType = isset($listingInfo->listingType[0]) ? $listingInfo->listingType[0] : '';
					
					// condition
					
					$condition = isset($value->condition[0]) ? $value->condition[0] : [];
					
					?>
						<div class="product-list">
							<a href="<?php echo esc_url($viewItemURL);?>" target="_blank">
								<div class="ebay-gallery-image">
									<figure>
										<img src="<?php echo esc_attr($galleryURL);?>" alt="<?php echo esc_html($title);?>">
									</figure>
								</div>
								<div class="ebay-title">
									<h4><?php echo esc_html($title);?></h4>
									<p><strong><?php echo esc_html('Price: ', 'themedev-ebay-advanced-search');?></strong> <?php echo esc_html(number_format($currentPrice, 2));?> [<?php echo $currentCurrency;?>]</p>
									<p><strong><?php echo esc_html('Shipping: ', 'themedev-ebay-advanced-search');?></strong> <?php echo esc_html(number_format($rateShipping, 2));?> [<?php echo $shippingType;?> - <?php echo $shipToLocations;?>]</p>
									<p><strong><?php echo esc_html('Category: ', 'themedev-ebay-advanced-search');?></strong> <?php echo esc_html($categoryName);?></p>
									<p><strong><?php echo esc_html('Global: ', 'themedev-ebay-advanced-search');?></strong> <?php echo esc_html($globalId)?></p>
									<p><strong><?php echo esc_html('Seller: ', 'themedev-ebay-advanced-search');?></strong> <?php echo $sellerUserName;?></p>
									<p><strong><?php echo esc_html('End Date: ', 'themedev-ebay-advanced-search');?></strong> <?php echo esc_html( date("Y F, d", strtotime($endTime)));?></p>
								</div>
							</a>
						</div>
					<?php
				endforeach;
				if($totalItem > 0){
				?>
				<div class="ebay-search-pagination">
					<?php if($getPage > 1):?>
					<div class="left-div-link">
						<a href="<?php echo esc_url($current_url);?>&ebay-page=<?php echo rawurlencode($getPage-1);?>" class="themedev-ebay"> <?php echo esc_html__('Previous', 'themedev-ebay-advanced-search');?>  </a>
					</div>
					<?php endif;?>
					<div class="left-div-link right-div-link">
						<a href="<?php echo esc_url($current_url);?>&ebay-page=<?php echo rawurlencode($getPage+1);?>" class="themedev-ebay"> <?php echo esc_html__('Next', 'themedev-ebay-advanced-search');?>  </a>
					</div>
				 </div>
				 <?php
				}
			}else{
				if(isset($_GET['search_0'])){
					?>
					<p class="ebay-not-found"> <?php echo esc_html__('Not found', 'themedev-ebay-advanced-search');?> </p>

				<?php
				}
				
			}
		?>
	</div>
</section>

<script type="text/javascript">
	jQuery(document).ready(function() {
		jQuery('.ebay-select2-themedev').select2();
	});
</script>