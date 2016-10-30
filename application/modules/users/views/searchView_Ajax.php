   <!--pagination-bar-->
        <nav class="navbar navbar-inverse margin-botm2">
          <div>
            <!-- Brand and toggle get grouped for better mobile display -->
            <ul class="nav navbar-nav">
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Rating <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li style="padding-left: 10px;">
                        <div class="checkbox">
                        <input id="checkd1" type="checkbox" name="check" value="checkd1">
                        <label for="checkd1"><span></span>Action</label>
                        </div>
                        <div class="checkbox">
                        <input id="checkd2" type="checkbox" name="check" value="checkd2">
                        <label for="checkd2"><span></span>Another action</label>
                        </div>
                        <div class="checkbox">
                        <input id="checkd3" type="checkbox" name="check" value="checkd3">
                        <label for="checkd3"><span></span>Something else here</label>
                        </div>
                        <div class="checkbox">
                        <input id="checkd4" type="checkbox" name="check" value="checkd4">
                        <label for="checkd4"><span></span>Separated link</label>
                        </div>
                    </li>
                  </ul>
                </li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Price <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <!--<li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>-->
                    <li style="padding-left: 10px;">
                        <div class="checkbox">
                            <input id="checkd1" type="checkbox" name="check" value="checkd1">
                            <label for="checkd1"><span></span>Low to High</label>
                        </div>
                        <div class="checkbox">
                            <input id="checkd2" type="checkbox" name="check" value="checkd2">
                            <label for="checkd2"><span></span>High to Low</label>
                        </div>
                    </li>    
                  </ul>
                </li>
            </ul>
        

            <!--pagination-->
            <ul class="pagination pull-right">
                <li><a href="#">First</a></li>
                <li class="disabled"><a href="#"><i class="fa fa-chevron-left"></i> Previous</a></li>
                <li class="active"><a href="#">1</a></li>
                <li><a href="#">Next <i class="fa fa-chevron-right"></i></a></li>
                <li><a href="#">Last</a></li>
            </ul>
            <!--pagination-end-->
            
          </div><!-- /.container-fluid -->
        </nav>
        <!--pagination-bar-end-->
        
        
        <?php 
         if(isset($vendor_list) && !empty($vendor_list)){
			foreach($vendor_list as $value){
				if(!isset($product[$value['userId']][$value['serviceId']]) || empty($product[$value['userId']][$value['serviceId']])){
					continue;
				}
				$userId = base64_encode(base64_encode($value['userId']));
        ?>
        <!--brand-panel-5-->
        <div class="brand-pan">
        	<div class="panel2 panel-default2">
              <!-- Default panel contents -->
              <div class="panel-heading">
              	<img src="<?php echo base_url(); ?>assets/images/ico/ico-build.png" alt=""> <span><a href="#"><?php echo ucfirst($value['productCategoryName']); ?></a></span>  <img src="<?php echo base_url(); ?>assets/images/ico/ico-tree.png" alt=""><span><a href="#"><?php echo ucfirst($value['serviceName']); ?></a></span>
              </div>
              <div class="panel-body">
              	<div class="brand-cont">
                <div class="row">
                	<div class="brand-cont-img"><!-- vendor-detail.html --><a href="#"><img src="<?php echo $value['image']; ?>" alt=""></a></div>
                    <div class="brand-cont-text">
                    	<h2><a href="<?php echo base_url().'users/vendor_detail?token='.$userId.'&type='.$value['serviceName']; ?>"><?php echo ucfirst($value['userCompanyName']); ?></M></a></h2><!-- vendor-detail.html -->
                        <h6><img src="<?php echo base_url(); ?>assets/images/ico/ico-location.png" alt=""> <span><?php echo ucfirst($value['town_nm']).', '.ucfirst($value['county_nm']); ?></span> 
                        	<a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star2.png" alt=""></a>
                        </h6>
                        <div><?php echo $value['businessDesc']; ?></div>
                    </div>
                </div><!--row-->
                </div>
              </div>
              <!-- Table -->
              <div class="table-responsive">
              <table class="table table-striped tblmrgn">
                <!--<thead>
                  <tr>
                    <th>Firstname</th>
                    <th>Lastname</th>
                  </tr>
                </thead>-->
                <tbody>
                    <?php
						$products = array();
						$count=0;
						if(isset($product[$value['userId']][$value['serviceId']]) && !empty($product[$value['userId']][$value['serviceId']])){
							$products = $product[$value['userId']][$value['serviceId']];
						}
						foreach($products as $key => $data){
							$count++;
							$productToken = base64_encode(base64_encode($data['productId']));
					  ?>
                  <tr class="loadr">
                    <td>
                    	<h3><a href="#" data-toggle="modal" onclick="getServiceDetails('<?php echo $productToken; ?>');" data-target="#myModal3"><?php echo ucfirst($data['productName']); ?></a></h3>
                        <span id="<?php echo 'favourite_'.$productToken; ?>"><a href="Javascript:void(0)" onclick="addToFavourite('<?php echo $productToken; ?>')"><img src="<?php echo base_url(); ?>assets/images/ico/ico-like.png" alt=""><span> Add to Favourite </span></a></span>
                        <span id="<?php echo 'wishlist_'.$productToken; ?>"><a href="Javascript:void(0)" onclick="addToWishlist('<?php echo $productToken; ?>')"><img src="<?php echo base_url(); ?>assets/images/ico/ico-gbox.png" alt=""><span> Add to Wishlist </span></a></span>
                        <a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-file.png" alt=""><span> Add to Compare </span></a>
						<br /><br /><span id="<?php echo 'status_'.$productToken; ?>"></span>
                    </td>
                    <td valign="middle" align="right">
                    	<div class="margin-top1">Save upto <span class="text-them-red paddingR-20"> <?php echo $data['productDiscount'].'%'; ?></span> <input name="amount" type="button" value="From $ <?php echo $data['productMinPrice']; ?>" class="btn btn-black"></div>
                    </td>
                  </tr>
                  
                  
                  <?php if($count==3){ break;} } ?>
                 <!-- <tr class="loadr">
                    <td>
                    	<h3><a href="#" data-toggle="modal" data-target="#myModal3">Aliquam lorem ante</a></h3>
                        <a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-like.png" alt=""><span> Add to Favourite </span></a>
                        <a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-gbox.png" alt=""><span> Add to Wishlist </span></a>
                        <a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-file.png" alt=""><span> Add to Compare </span></a>
                    </td>
                    <td valign="middle" align="right">
                    	<div class="margin-top1">Save upto <span class="text-them-red paddingR-20"> 20%</span> <input name="amount" type="button" value="From $ 1000" class="btn btn-black"></div>
                    </td>
                  </tr>
                  <tr class="loadr">
                    <td>
                    	<h3><a href="#" data-toggle="modal" data-target="#myModal3">Aliquam lorem ante</a></h3>
                        <a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-like.png" alt=""><span> Add to Favourite </span></a>
                        <a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-gbox.png" alt=""><span> Add to Wishlist </span></a>
                        <a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-file.png" alt=""><span> Add to Compare </span></a>
                    </td>
                    <td valign="middle" align="right">
                    	<div class="margin-top1">Save upto <span class="text-them-red paddingR-20"> 20%</span> <input name="amount" type="button" value="From $ 1000" class="btn btn-black"></div>
                    </td>
                  </tr>
                <tr class="trblk4">
                    <td>
                    	<h3><a href="#" data-toggle="modal" data-target="#myModal3">Aliquam lorem ante</a></h3>
                        <a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-like.png" alt=""><span> Add to Favourite </span></a>
                        <a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-gbox.png" alt=""><span> Add to Wishlist </span></a>
                        <a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-file.png" alt=""><span> Add to Compare </span></a>
                    </td>
                    <td valign="middle" align="right">
                    	<div class="margin-top1">Save upto <span class="text-them-red paddingR-20"> 20%</span> <input name="amount" type="button" value="From $ 1000" class="btn btn-black"></div>
                    </td>
                  </tr>
                  <tr class="trblk4">
                    <td>
                    	<h3><a href="#" data-toggle="modal" data-target="#myModal3">Aliquam lorem ante</a></h3>
                        <a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-like.png" alt=""><span> Add to Favourite </span></a>
                        <a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-gbox.png" alt=""><span> Add to Wishlist </span></a>
                        <a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-file.png" alt=""><span> Add to Compare </span></a>
                    </td>
                    <td valign="middle" align="right">
                    	<div class="margin-top1">Save upto <span class="text-them-red paddingR-20"> 20%</span> <input name="amount" type="button" value="From $ 1000" class="btn btn-black"></div>
                    </td>
                  </tr>
                  <tr class="trblk4">
                    <td>
                    	<h3><a href="#" data-toggle="modal" data-target="#myModal3">Aliquam lorem ante</a></h3>
                        <a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-like.png" alt=""><span> Add to Favourite </span></a>
                        <a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-gbox.png" alt=""><span> Add to Wishlist </span></a>
                        <a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-file.png" alt=""><span> Add to Compare </span></a>
                    </td>
                    <td valign="middle" align="right">
                    	<div class="margin-top1">Save upto <span class="text-them-red paddingR-20"> 20%</span> <input name="amount" type="button" value="From $ 1000" class="btn btn-black"></div>
                    </td>
                  </tr>
                  -->
                </tbody>
                <tfoot>
					<?php if($count>=3){ ?>
                  <tr>
                    <th colspan="2"><div id="loadMore4" class="btn btn-lg btn-block button5">SHOW ALL</div></th>
                  </tr>
				<?php } ?>
                </tfoot>
              </table>
            </div>
            </div>
        </div>
        <!--brand-panel-5-end-->
        <?php
			}
		}
        ?>
        
        <!--pagination-bar-->
        <nav class="navbar navbar-inverse margin-botm2">
          <div>
            <!-- Brand and toggle get grouped for better mobile display -->
			<ul class="pull-left">
            	<li><p>Page 1 of 5</p></li> 
            </ul>
        

            <!--pagination-->
            <ul class="pagination pull-right">
                <li><a href="#">First</a></li>
                <li class="disabled"><a href="#"><i class="fa fa-chevron-left"></i> Previous</a></li>
                <li class="active"><a href="#">1</a></li>
                <li><a href="#">Next <i class="fa fa-chevron-right"></i></a></li>
                <li><a href="#">Last</a></li>
            </ul>
            <!--pagination-end-->
            
          </div><!-- /.container-fluid -->
        </nav>
        <!--pagination-bar-end-->
            
