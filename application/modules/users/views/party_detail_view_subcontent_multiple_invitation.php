<div class="tab-head">
  <aside class="col-xs-12 col-sm-6 col-md-6 col-lg-6 text-capitalize">
	<!--<h2>Multiple Invitation</h2>-->
	<ol class="breadcrumb">
	  <li><a href="#">Guestlist</a></li><!-- guestlist-invitations-sent.html -->
	  <li class="active">Multiple Invitation</li>
	</ol>
  </aside>
  <aside class="col-xs-12 col-sm-2 col-md-2 col-lg-2 text-capitalize pull-right" style="padding-left:75px;">
	<div class="from_control">
	<?php $party_id = base64_encode(base64_encode($partyDetail['party_id'])); ?>
		<select id="view_type" class="form-control" onChange="gotoGuestList('<?php echo $party_id; ?>', this.value, true);">
			<option value="guestlist">Invite</option>
			 <option value="individual">Individual</option>
			 <option value="multiple" selected>Multiple</option>
		  </select>
	</div>      
  </aside>
 </div>



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

<div class="clearfix"></div>


<div class="tab-head">
  <aside class="col-xs-12 col-sm-5 col-md-6 col-lg-3 text-capitalize">
	<h2>Send Multiple Invitation</h2>
  </aside>
  <aside class="col-xs-12 col-sm-7 col-md-6 col-lg-9 rightbtns text-uppercase">
	<ul class="guestist_ul">
		<li><button onclick="addGuest();" class="btn btn-default">Add Guest</button></li>
		<li>Send invitation from -</li>
		<li><a href="#"><img src="<?php echo base_url().'assets/images/facebook1.png'; ?>" alt="" /></a></li>
		<li><a href="#"><img src="<?php echo base_url().'assets/images/twitter1.png'; ?>" alt="" /></a></li>
		<li><a href="#"><img src="<?php echo base_url().'assets/images/gplus1.png'; ?>" alt="" /></a></li>
	</ul>
  </aside>
  <div class="clearfix"></div>
</div>



<div class="col-lg-12 ">
	
	<div class="multiple_field_holder">
	<div class="multiple_field">
		<form role="form" action="<?php echo base_url().'users/sendMultipleInvitation'; ?>" method="post" id="invitation_form" class="form_horizontal">
			<input type="hidden" name="token" value="<?php echo $party_id; ?>" />
			<input type="hidden" id="totalrow" value="3"/>
			<?php for($i=1; $i<=3; $i++){ ?>
				<div class="form_part" id="guestDetail<?php echo $i; ?>">
				 <aside class="col-xs-12 col-sm-5 col-md-5 col-lg-5">
					<div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">
					  <span>Name</span>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-9 col-lg-9">
					  <input type="text" class="form-control validate_name" onclick="removeValidateHtml(this.id);" onblur="validateMultipleGuest(this.id, 'name');" name="guests[<?php echo $i; ?>][name]" id="name<?php echo $i; ?>" placeholder="Guest Name">
						<span class="error" id="<?php echo 'name'.$i.'_error'; ?>" />
					</div>
				</aside>
				<aside class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
					<div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">
					  <span>Mobile</span>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-9 col-lg-9">
					  <input type="text" class="form-control" onkeypress="return isNumber(event);" name="guests[<?php echo $i; ?>][phone]" id="phone<?php echo $i; ?>" placeholder="Guest Mobile">
					<span class="error" id="<?php echo 'phone'.$i.'_error'; ?>" />
					</div>
				</aside>
				<aside class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
					<div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">
					  <span>Email</span>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-9 col-lg-9">
					  <input type="text" class="form-control validate_email" onclick="removeValidateHtml(this.id);" onblur="validateMultipleGuest(this.id, 'email');" name="guests[<?php echo $i; ?>][email]" id="email<?php echo $i; ?>" placeholder="Guest Email">
						<span class="error" id="<?php echo 'email'.$i.'_error'; ?>" />
					</div>
				</aside>
				<aside class="col-xs-12 col-sm-1 col-md-1 col-lg-1 close-sign">
					<?php if($i!=1){ ?>
						<span onclick="closeGuestField('<?php echo "guestDetail".$i; ?>');"><i class="fa fa-times"></i>
</span>
					<?php } ?>
				</aside>
				
				<div class="clearfix"></div>
			</div>
			<?php } ?>
			<div id="addMoreGuest"></div>
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<div class="form_part myform_part">
				<div class="col-xs-12 col-sm-2 col-md-1 col-lg-2">
					  <span>Message</span>
				</div>
				<div class="col-xs-12 col-sm-10 col-md-11 col-lg-10 form_part_submit">
					 <textarea name="message" placeholder="Message." class="form-control"></textarea>
					 <button onclick="InvitationFormSubmit();" class="btn btn-danger register-button2" type="button">Send &amp; Save</button>
				</div>
			</div>
			<span style="display:none;"><input type="submit" id="form_submit"/></span>
			</div>
			<div class="clearfix"></div>
	  </form>
	
	</div>
	</div>

</div>


<div class="clearfix"></div>
