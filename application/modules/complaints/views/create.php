<?php require_once(FCPATH.'assets/admin/lib/header2.php'); ?> 


<script type="text/javascript" src="/assets/admin/lib/ckeditor.js"></script>
<script type="text/javascript" src="/assets/admin/lib/ckeditor.js"></script>
              
<section role="main" class="content-body">
	<header class="page-header">
		<h2>Reply Complaints</h2>

	<!--	<div class="right-wrapper pull-right">
			<ol class="breadcrumbs">
	 			<li>
					<a href="" title="Dashboard">
						<i class="fa fa-home"></i>
					</a>
				</li>
				<li><span>Dashboard</span></li>
			</ol>
</div>
			<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>--->
		
	</header>
	



<section class="panel">
	<div class="row">
							<div class="col-xs-12">
								<section class="panel">
									<header class="panel-heading">
									<!--	<div class="panel-actions">
											<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
											<a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
										</div>
						
										<h2 class="panel-title">Reply Complaints</h2> -->
									</header>
									<div class="panel-body">
								
								
										
										
                                
	                           <!---------------- FORM--------------->		
										
                                  
										
							
								

	<?php  $attributes = array('name' => 'form','id' => 'frmord','class'=>"orm-horizontal form-bordered");
echo  form_open_multipart('index.php/complaints/create/'.$this->uri->segment(3).'/'.$this->uri->segment(4), $attributes);?>	
    
 <!--<input type="text" name="classified_id" value="<?php echo $this->uri->segment(3); ?>">
 <input type="text" name="complain_id" value="<?php echo $this->uri->segment(4); ?>">	-->											
											<div class="form-group">
												<label class="col-md-3 control-label" for="inputDefault">Subject</label>
												<div class="col-md-6">
												
												
											


                                      						
      <?php 
      //print_r($posts);
      
      foreach($posts as $post)
	  {  ?>
       <input type="text" class="form-control" id="inputDefault" value="<?php echo $post->subject;?>" name="subject" disabled>
								 <?php }?>
								 
							
				
													 

												</div>
											</div>
											
											<div class="form-group">
												<label class="col-md-3 control-label">Message :</label>
												<div class="col-md-9">
												<div id="wr"></div>	 
													
													<!---<div class="summernote">
					data-plugin-summernote data-plugin-options='{ "height": 180, "codemirror": { "theme": "ambiance" } }' 
								 name="Message" value="<?php echo set_value('message'); ?>">--->
					                     
<div class="summernote"><textarea value="<?php echo set_value('message'); ?>" class="summernote" id="summernote" name="message" data-plugin-summernote data-plugin-options=
	 '{ "height": 180, "codemirror": { "theme": "ambiance" } }'></textarea></div>                 
					                
					                     
					                     
													
													</div>
												</div>
	<div class="row">
				  
			<div class="col-md-9 col-md-offset-3">
			<input type="submit" id="cc" class="btn btn-primary" value="Create" name="submit" />
			</div>
			</div>
											</div>



											
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  
                    
			
													
           </form>
									</div>
								</section>
							</div>
						</div>
	
	
								
								
	 			
								


<?php require_once(FCPATH.'assets/admin/lib/right.php'); ?> 

</section>

<?php require_once(FCPATH.'assets/admin/lib/footer.php'); ?>
<script>
    $(document).ready(function()
	{
		
        $('#cc').click(function()
		{   
            var err=0;

             if ($('#summernote').val()=="")
			 {      err++;
					$('#wr').html("Message can't be blank");
                   $('#wr').css("color","red");
				   return false;
             }
                
				if (err==0)
				{
				  $('#summernote').submit();
				  $("#inputDefault").removeAttr('disabled');
                 }
	    });
    });
</script>		
