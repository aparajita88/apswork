<!--panel-body--> 
<div class="panel-heading">
	<h3 class="panel-title2 pull-left"><?php echo (isset($mainCategoryName['productCategoryName'])?ucfirst($mainCategoryName['productCategoryName']):'') ?></h3>
	<div class="clear">
		<a href="Javascript:void(0)" onclick="selectAllCheckbox('checkbox-search');">Select all</a> | <a href="Javascript:void(0)" onclick="unSelectAllCheckbox('checkbox-search');">Clear</a>
	</div>
</div>
<div class="panel-body">
	<form>
		<div class="listingP">
			<?php 
			if(isset($subcategory) && count($subcategory)){
				foreach($subcategory as $key => $value){
			?>
					<div class="checkbox">
						<input id="check<?php echo $key; ?>" type="checkbox" class="checkbox-search subservices_checkbox" name="check[]" value="<?php echo $value['productCategoryId']; ?>" onclick="doFilter();">
						<label for="check<?php echo $key; ?>"><span></span><?php echo ucfirst($value['productCategoryName']); ?></label>
					</div>
			<?php 
				}
			} 
			?>
		</div>
	</form>
</div>
<!--panel-body--> 
