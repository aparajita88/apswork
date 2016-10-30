<div class="tab-head ">
  <aside class="col-xs-12 col-sm-3 col-md-3 col-lg-3 text-capitalize">
	  <?php
		if(count($guestList)){
			echo "<h2>".count($guestList)." Invitations Sent</h2>";
		}else{
			echo "<h2>0 Invitation(s) Sent</h2>";
		}
	  ?>
  </aside>
  <aside class="col-xs-12 col-sm-9 col-md-9 col-lg-9 rightbtns text-uppercase send_guest send_guest008">
	<ul>
		<li>
			<div id="dateRangeForm" class="dateRangeForm1 ">
				<div id="dateRangePicker" class="input-group input-append date">
					<input type="text" name="date" placeholder="Search by name, contact, response" class="form-control form-control01">
					<span class="input-group-addon add-on"><i class="fa fa-search fa_search"></i></span> 
				</div>
			</div>
		</li>
		<li><a href="Javascript:void(0)" onclick="submitReSendInvitationForm();" class="btn btn-default">Resend Invitation</a></li>
		<li class="from_control">
		<?php $party_id = base64_encode(base64_encode($partyDetail['party_id'])); ?>
		<select id="view_type" class="form-control" onChange="gotoGuestList('<?php echo $party_id; ?>', this.value, true);">
			<option value="guestlist" selected>Invite</option>
			 <option value="individual">Individual</option>
			 <option value="multiple">Multiple</option>
		  </select>
		</li>	
	</ul>
  </aside>
</div>
<div class="form-content">
  <div class="table-responsive">
   <form action="<?php echo base_url().'users/reSendInvitation'; ?>" id="reInvitationForm" method="post">
	<table width="100%" cellpadding="0" cellspacing="0" border="1" class="table mypartylist mypartylist1 text-capitalize" id="allgestlist">
	  <thead>
		<th width="25%">
		  <a href="#" title="Sort descending">
			
			<div class="checkbox checkbox1"><input class="master_chechbox" onclick="CheckedAllCheckbox();" id="checked1" type="checkbox" name="check" value="checked1"><label for="checked1"><span></span>Guest Name</label></div>
			
			<span class="sortable sorted-asc">
			  <b class="caret"></b>
			 </span>
		  </a>
		</th>
		<th width="25%">
		  <a href="#" title="Sort ascending">
			Contact 
			<span class="sortable">
			  <b class="caret"></b>
			  <!--<b class="caret flipped"></b>-->
			</span>
		  </a>
		</th>
		<th width="25%">
		  <a href="#" title="Sort ascending">
			Email 
			<span class="sortable">
			  <b class="caret"></b>
			  <!--<b class="caret flipped"></b>-->
			</span>
		  </a>
		</th>
		<th width="25%">
		  <a href="#" title="Sort ascending">
			Response
			<span class="sortable">
			  <b class="caret"></b>
			  <!--<b class="caret flipped"></b>-->
			</span>
		  </a>
		</th>
	   </thead>
	  <tbody class="text-capitalize">
	  <?php
		if(count($guestList)){
			foreach($guestList as $key => $value){
	  ?>
	   <tr>
		<td width="25%"><div class="checkbox checkbox2"><input onclick="CheckOrUncheckMusterCheckbox();" class="slave_chekbox" id="check<?php echo $value['id']; ?>" type="checkbox" name="guestList[]" value="<?php echo $value['id']; ?>"><label for="check<?php echo $value['id']; ?>"><span></span><?php echo $value['guest_name']; ?></label></div></td>
        <td width="25%"><?php echo $value['guest_contact_no']; ?></td>
        <td width="25%"><?php echo strtolower($value['guest_email']); ?></td>
        <td width="25%"><?php echo ($value['status']==1) ? "Accepted" : "Invited"; ?></td>
       </tr>
		<?php
			}
		}else{
			echo'<tr><td width="100%" colspan="4">You are not send any invitation(s).</td></tr>';
		}
		?>
	  </tbody>
	</table>
   </form>
  </div>
   <div class="clearfix"></div>
</div>
<div class="partylist-footer partylist_footer1">
   <aside class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
		<p>Showing 10 of 15</p>
   </aside>
   <aside class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
		 <ul class="pager mypager">
			<li><a href="#"><i class="fa fa-angle-left"></i>Previous</a></li>
			<li><a href="#">Next<i class="fa fa-angle-right"></i></a></li>
		 </ul>
   </aside>
   <div class="clearfix"></div>		
</div>	
	
<div class="clearfix"></div>
