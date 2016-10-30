<!-- Tab head -->
<div class="tab-head">
  <aside class="col-xs-12 col-sm-6 col-md-6 col-lg-6 text-capitalize">
	<!--<h2>Individual Invitation</h2>-->
	<ol class="breadcrumb">
	  <li><a href="#">Guestlist</a></li><!-- guestlist-invitations-sent.html -->
	  <li class="active">Individual Invitation</li>
	</ol>
  </aside>
  <aside class="col-xs-12 col-sm-2 col-md-2 col-lg-2 text-capitalize pull-right" style="padding-left:75px;">
  <div class="from_control">
	<?php $party_id = base64_encode(base64_encode($partyDetail['party_id'])); ?>
		<select id="view_type" class="form-control" onChange="gotoGuestList('<?php echo $party_id; ?>', this.value, true);">
			<option value="guestlist">Invite</option>
			 <option value="individual" selected>Individual</option>
			 <option value="multiple">Multiple</option>
		  </select>
		  </div>
  </aside>
 </div>
<!-- /Tab head -->

<!-- Table Content -->
<div class="col-xs-12">
	
	<div class="bottom_tab_head">
		<h3><?php echo ucfirst($partyDetail['name']); ?></h3>
	</div>
	
	<div class="table_entry">
	
		<aside class="col-xs-12 col-sm-12 col-md-6 col-lg-6  padding_0">
			<ul>
				<li><p class="col-md-4 col-lg-4">Name </p>- <span><?php echo ucfirst($partyDetail['name']); ?></span></li>
				<li><p class="col-md-4 col-lg-4">Date & Time </p>- <span><?php echo date('d/m/Y', strtotime($partyDetail['date'])).', '.$partyDetail['time']; ?></span></li>
			</ul>
		</aside>
		
		<aside class="col-xs-12 col-sm-12 col-md-6 col-lg-6 padding_0">
			<ul>
				<li><p class="col-md-4 col-lg-4">Occassion</p> - <span><?php echo ucfirst($partyDetail['productCategoryName']); ?></span></li>
				<li><p class="col-md-4 col-lg-4">Venue Address</p>- <span><?php echo ucfirst($partyDetail['town_nm']); ?></span></li>
			</ul>
		</aside>
			
	<div class="clearfix"></div>
	</div>
	
 <div class="clearfix"></div>
</div>
<!-- /Table Content -->
<div class="clearfix"></div>

<!-- Tab head -->
<div class="tab-head">
  <aside class="col-xs-12 col-sm-5 col-md-6 col-lg-3 text-capitalize">
	<h2>Send Individual Invitation</h2>
  </aside>
  <aside class="col-xs-12 col-sm-7 col-md-6 col-lg-9 rightbtns text-uppercase">
	<ul class="guestist_ul">
		 <li>Send invitation from -</li>
		<li><a href="#"><img src="<?php echo base_url().'assets/images/facebook1.png'; ?>" alt="" /></a></li>
		<li><a href="#"><img src="<?php echo base_url().'assets/images/twitter1.png'; ?>" alt="" /></a></li>
		<li><a href="#"><img src="<?php echo base_url().'assets/images/gplus1.png'; ?>" alt="" /></a></li>
	</ul>
  </aside>
  <div class="clearfix"></div>
</div>
<!-- /Tab head -->

 <!-- Multiple Invitation -->
<div class="col-lg-12 ">
	
	<div class="multiple_field_holder">
	<div class="multiple_field">
		<form action="<?php echo base_url().'users/sendInvitation'; ?>" id="invitation_form" class="form_horizontal" method="post">
				<input type="hidden" name="token" value="<?php echo $party_id; ?>" />
				<aside class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
				  <div class="form_part">
					<div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">
					  <span>Name</span>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-9 col-lg-9">
					  <input type="text" name="name" id="name" onclick="removeValidateHtml('name');" onblur="nameValidation();" placeholder="Guest Name" class="form-control validate_name">
					  <span id="name_error" class="error"></span>
					</div>
					<div class="clearfix"></div>
				  </div>
				</aside>
				<aside class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
				  <div class="form_part">
					<div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">
					  <span>Mobile</span>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-9 col-lg-9">
					  <input type="text" onkeypress="return isNumber(event);" name="phone" id="phone"  placeholder="Guest Mobile" class="form-control validate_phone">
					  <span class="error" id="phone_error"><font color="red"></font></span>
					</div>
					<div class="clearfix"></div>
				  </div>
				</aside>
				<aside class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
				  <div class="form_part">
					<div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">
					  <span>Email</span>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-9 col-lg-9">
					  <input type="text" name="email" id="email" placeholder="Guest Email" onclick="removeValidateHtml('email');" onblur="EmailValidation();" class="form-control validate_email">
					  <span id="email_error" class="error"></span>
					</div>
					<div class="clearfix"></div>
				  </div>
				</aside>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				  
				  <div class="form_part myform_part">
					<div class="col-xs-12 col-sm-2 col-md-1 col-lg-2">
					  <span>Message</span>
					</div>
					<div class="col-xs-12 col-sm-10 col-md-11 col-lg-10 form_part_submit">
					 <textarea class='form-control' name="message" placeholder="message"></textarea>
					  <button type="button" class="btn btn-danger register-button2" onclick="validateInvitationForm();">Send &amp; Save</button>
					</div>
					<div class="clearfix"></div>
				  </div>
				  
				</div>
		<div class="clearfix"></div>
	  </form>
	
	</div>
	</div>

</div>
 <!-- /Multiple Invitation -->

<div class="clearfix"></div>
</div>
