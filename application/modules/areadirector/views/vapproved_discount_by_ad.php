<div class="modal-dialog">
    <?php 
    $net_amount=$book_floor_data[0]['total_price']-$book_floor_data[0]['total_price']*$book_floor_data[0]['discount']/100;
    $price_details=json_decode($book_floor_data[0]['price_details']);
    ?>
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><b>Price Details</b></h4>
        </div>
            
			<div class="modal-body">
          <p>Price Details:</p>
          <p>Bookself Cost: <span id="bkprice"><i class="fa fa-inr"></i> <?php echo  $price_details->bookself;?></span></p>
          <p>Internal Storage Cost: <span id="storeprice"><i class="fa fa-inr"></i> <?php echo  $price_details->internalstorage;?></span></p>
          <p>Internet Cost: <span id="intprice"><i class="fa fa-inr"></i> <?php echo  $price_details->internet;?></span></p>
          <p>Phone Cost: <span id="phprice"><i class="fa fa-inr"></i> <?php echo  $price_details->phone;?></span></p>
          <p>Wifi Cost: <span id="wifiprice"><i class="fa fa-inr"></i> <?php echo  $price_details->wifi;?></span></p>
          <p>Gross Amount: <span id="totalprice"><i class="fa fa-inr"></i> <?php echo $book_floor_data[0]['total_price'];?></span></p>
          <p>Discount: <span id="totalprice"><?php echo $book_floor_data[0]['discount'];?> %</span></p>
          <p>Net Amount: <span id="totalprice"><i class="fa fa-inr"></i> <?php echo $net_amount;?></span></p>

        </div>
        <div class="modal-footer">
           <button type="button" class="btn btn-primary" onclick="approveddiscount('<?php echo $book_floor_data[0]['id'];?>','<?php echo $net_amount;?>')">Approved</button>
        </div>
        
        
      </div>
      
    </div>
    <script type="text/javascript">
        function approveddiscount(id,amount){
            $.ajax({ 
             url: '<?php echo base_url();?>index.php/areadirector/discount_amount_byareadirector', 
              type: 'post',
              data: "appid="+id+"&amount="+amount,
                
                success: function(result)
                {
                    location.href = "<?php echo base_url();?>index.php/areadirector/dashBoard";
                  
                 }
            });
        }
    </script>