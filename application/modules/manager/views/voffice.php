<?php require_once(FCPATH.'assets/admin/lib/header2.php'); ?>

<section role="main" class="content-body">
  <header class="page-header">
    <h2>Hi <?php echo $userData['FirstName']." ".$userData['LastName'];?></h2>
    <div class="right-wrapper pull-right">
      </ol>
    </div>
  </header>
  <section class="panel">
    <?php if($this->session->flashdata('item')){ ?>
    <div class="alert alert-success" role="alert"><?php echo $this->session->flashdata('item'); ?></div>
    <?php } ?>
    <?php if($this->session->flashdata('item_error')){ ?>
    <div class="alert alert-danger" role="alert"><?php echo $this->session->flashdata('item_error'); ?></div>
    <?php } ?>
    <div class="panel-body">
      <h2 class="panel-title">virtual office booking</h2>
    </div>
    <div class="panel-body panel_body_top"> 
    	<div class="col-md-3 selection pad_left0">
            <div class="form-group sub_text1">
              <label for="inputDefault" class="col-md-12 control-label ">Location :</label>
              <div class="col-md-12 ">
                <select class="form-control mb-md" name="location" id="location" onchange="get_business(this.value)">
                  <option value="0">Select Location</option>
                  <?php foreach($location as $key=>$value) {
                                                
                                                if($userData['location_id']==$value['locationId']){
                                                echo '<option value="'.$value['locationId'].'" selected>'.$value['name'].'</option>'; 
                                            }else{
                                                echo '<option value="'.$value['locationId'].'">'.$value['name'].'</option>'; 
                                            }
                                                
                                            } ?>
                </select>
              </div>
            </div>
          </div>
         <div class="col-md-3 selection">
            <div class="form-group sub_text1">
              <label for="inputDefault" class="col-md-12 control-label pad_left0">Business Centers :</label>
              <div class="col-md-12 pad_left0">
                <select  class="form-control mb-md" name="business" id="business" onchange="getfloorplanBybusiness(this.value)" >
                  <?php foreach($business_data as $key=>$value) {
                                                
                                                
                                                echo '<option value="'.$value['business_id'].'" >'.$value['businessName'].'</option>'; 
                                            
                                                
                                            } ?>
                </select>
              </div>
            </div>
          </div>
          <div class="clearfix"></div>
          <h3 class="virtualhead">select a package</h3>
          <!--<div class="parent">
          	<div class="row">
                	<div class="col-xs-12 col-sm-6 col-md-2 col-lg-2">
                    	<div class="child skyblue">
                    		<h2>mail box</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin facilisis sagittis massa, nec gravida nisl sodales sed. Sed accumsan pretium augue, ac tempus tellus maximus id. Phasellus tincidunt viverra facilisis. Nullam vel justo dictum dui imperdiet malesuada. Nunc sagittis orci vitae ante hendrerit, sed vulputate nisl ornare. Morbi rutrum felis dui, et commodo lectus eleifend ac. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Duis accumsan sem ac sagittis laoreet. </p>
                        </div>
                        <button type="button" class="skyblue">select now</button>
                    </div>
                	<div class="col-xs-12 col-sm-6 col-md-2 col-lg-2">
                    	<div class="child green">
                    		<h2>telephone answering</h2>
                            <p>Donec mattis cursus pharetra. Ut nisl est, interdum vel mattis id, aliquam et massa. Praesent tellus justo, iaculis sed consequat sed, porttitor eu odio. Praesent at turpis sit amet purus gravida ultricies. Donec mauris libero, scelerisque quis pharetra quis, elementum a nulla. Suspendisse suscipit sagittis dapibus.</p>
                        </div>
                        <button type="button" class="green">select now</button>
                    </div>
                	<div class="col-xs-12 col-sm-6 col-md-2 col-lg-2">
                    	<div class="child orange">
                    		<h2>virtual office</h2>
                            <p>Nulla purus augue, rutrum at tincidunt at, blandit id nisi. Donec laoreet quis enim vitae pharetra. Nam hendrerit erat vitae dui finibus egestas quis quis purus. Nunc congue nec nisl ac maximus. Etiam vitae nibh massa. Mauris ante tellus, aliquam vel libero vitae, pharetra ullamcorper tortor. Quisque nibh orci, accumsan a egestas et, aliquam vitae est. Nam vel tellus sit amet ligula ultricies dapibus.</p>
                        </div>
                        <button type="button" class="orange">select now</button>
                    </div>
                	<div class="col-xs-12 col-sm-6 col-md-2 col-lg-2">
                    	<div class="child saffron">
                    		<h2>virtual office advance</h2>
                            <p>Suspendisse mollis lacinia mauris, sed porta mi bibendum a. Donec id elementum sem. Ut neque mi, iaculis in ipsum vel, sollicitudin facilisis quam. Quisque faucibus risus ac nibh maximus, sed blandit neque posuere. Nunc at magna et lacus accumsan pellentesque id ac elit. Aliquam malesuada auctor efficitur. Curabitur in libero sed tortor feugiat iaculis eu consequat turpis. Proin varius purus in sagittis consequat. Nunc quis erat venenatis, viverra ligula ut, finibus risus.</p>
                        </div>
                        <button type="button" class="saffron">select now</button>
                    </div>
                	<div class="col-xs-12 col-sm-6 col-md-2 col-lg-2">
                    	<div class="child blue">
                    		<h2>virtual office advance plus</h2>
                            <p>Aenean consequat finibus pellentesque. Etiam nulla massa, mollis ut scelerisque sed, consectetur viverra est. Aenean commodo placerat nisl aliquam mattis. Donec at dignissim diam. Etiam venenatis risus a egestas tristique. Donec at sem sed dui fringilla ultricies at molestie eros. </p>
                        </div>
                        <button type="button" class="blue">select now</button>
                    </div>
                <div class="clearfix"></div>
               </div>	
            </div>-->
          <div class="parent">
            <div class="child skyblue">
               <h2>mail box</h2>
               <p>Sed accumsan pretium augue, ac tempus tellus maximus id. Nullam vel justo dictum dui imperdiet malesuada. Nunc sagittis orci vitae ante hendrerit, sed vulputate nisl ornare. Morbi rutrum felis dui, et commodo lectus eleifend ac. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Duis accumsan sem ac sagittis laoreet. </p>
            </div>
            
            <div class="child green">
                <h2>telephone answering</h2>
                <p>Donec mattis cursus pharetra. Ut nisl est, interdum vel mattis id, aliquam et massa. Praesent tellus justo, iaculis sed consequat sed, porttitor eu odio. Praesent at turpis sit amet purus gravida ultricies. Donec mauris libero, scelerisque quis pharetra quis, elementum a nulla. Suspendisse suscipit sagittis dapibus.</p>
            </div>
            
            <div class="child orange">
                <h2>virtual office</h2>
                <p>Nulla purus augue, rutrum at tincidunt at, blandit id nisi. Donec laoreet quis enim vitae pharetra. Nam hendrerit erat vitae dui finibus egestas quis quis purus. Nunc congue nec nisl ac maximus. Etiam vitae nibh massa. Mauris ante tellus, aliquam vel libero vitae, pharetra ullamcorper tortor. Quisque nibh orci, accumsan a egestas et, aliquam vitae est. Nam vel tellus sit amet ligula ultricies dapibus.</p>
            </div>
            
            <div class="child saffron">
                 <h2>virtual office advance</h2>
                 <p>Ut neque mi, iaculis in ipsum vel, sollicitudin facilisis quam. Quisque faucibus risus ac nibh maximus, sed blandit neque posuere. Nunc at magna et lacus accumsan pellentesque id ac elit. Aliquam malesuada auctor efficitur. Curabitur in libero sed tortor feugiat iaculis eu consequat turpis. Proin varius purus in sagittis consequat. Nunc quis erat venenatis, viverra ligula ut, finibus risus.</p>
            </div>
           
            <div class="child blue">
                 <h2>virtual office advance plus</h2>
                 <p>Aenean consequat finibus pellentesque. Etiam nulla massa, mollis ut scelerisque sed, consectetur viverra est. Aenean commodo placerat nisl aliquam mattis. Donec at dignissim diam. Etiam venenatis risus a egestas tristique. Donec at sem sed dui fringilla ultricies at molestie eros. </p>
            </div>
           
         </div>
         <div class="parent">
         	<div class="child"><button type="button" class="skyblue">select now</button></div>
         	<div class="child"><button type="button" class="green">select now</button></div>
            <div class="child"><button type="button" class="orange">select now</button></div>
            <div class="child"><button type="button" class="saffron">select now</button></div>
            <div class="child"><button type="button" class="blue">select now</button></div>   
         </div>
  </section>
  <div class="panel-body">
    	<button type="button" class="btn btn-info agreementbtn">view agreement</button>
    </div>
</section>
</section>
<?php require_once(FCPATH.'assets/admin/lib/footer2.php'); ?>
<script>
function changeuserStatus(id,status)
{
	//alert(js_site_url);
	//alert(id);
	var table='user';
	var pid='userId';
	$.ajax({ 
      method: "POST", 
      url: js_site_url+"index.php/users/changeuserStatus", 
      data: { _id:id, _status:status,_table:table,_pid:pid,}, 
      async: false, 
      success: function(data) { 
	  	//alert(data);
        $("#statusId"+id).html(data.trim()); 
      } 
    });
}

</script> 
