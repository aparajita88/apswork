<?php require_once(FCPATH.'assets/admin/lib/header2.php'); ?>
<section role="main" class="content-body">
	<header class="page-header">
		<h2>Hi   <?php echo $userData['FirstName']." ".$userData['LastName'];?></h2>	
	</header>					
	<section class="panel">						
			<div class="panel-body"><h2 class="panel-title"><?php echo $table_heading; ?></h2></div>					
			<div class="panel-body panel_body_top">
            		<div class="hover-tooltip">
                    	<div class="innercontent">
                        	<i class="fa fa-check-circle-o" aria-hidden="true"></i>
							<p>your current membership</p>
                        </div>
                    </div>
				 <div class="table-responsive">
                 	<table cellpadding="0" cellspacing="0" class="table membership-table">
                    	<tr>
                        	<th width="40%" rowspan="2">&nbsp;</th>
                            <th width="20%" align="center" class="lightgrey" style="text-align:center;"><strong>Smart Silver</strong></th>
                            <th width="20%" align="center" class="moderategrey" style="text-align:center;"><strong>Smart Platinum</strong></th>
                            <th width="20%" align="center" class="darkgrey" style="text-align:center;"><strong>Smart Titanium</strong></th>
                        </tr>
                        <tr>
                            <td align="center" class="lightgrey">INR 599 Onwards</td>
                            <td align="center" class="moderategrey">INR 899 Onwards</td>
                            <td align="center" class="darkgrey">INR 2199 Onwards</td>
                        </tr>
                        <tr>
                        	<td class="orangebg"><strong>Private Office</strong></td>
                            <td class="lightgrey">&nbsp;</td>
                            <td align="center" class="moderategrey">2 days is for private office</td>
                            <td align="center" class="darkgrey">5 days is for private office</td>
                        </tr>
                        <tr>
                        	<td class="orangebg"><strong>Smart Social</strong></td>
                            <td align="center" class="lightgrey"><i class="fa fa-check" aria-hidden="true"></i></td>
                            <td align="center" class="moderategrey"><i class="fa fa-check" aria-hidden="true"></i></td>
                            <td align="center" class="darkgrey"><i class="fa fa-check" aria-hidden="true"></i></td>
                        </tr>
                        <tr>
                        	<td class="orangebg"><strong>Walk in and work</strong></td>
                            <td align="center" class="lightgrey"><i class="fa fa-check" aria-hidden="true"></i></td>
                            <td align="center" class="moderategrey"><i class="fa fa-check" aria-hidden="true"></i></td>
                            <td align="center" class="darkgrey"><i class="fa fa-check" aria-hidden="true"></i></td>
                        </tr>
                        <tr>
                        	<td class="orangebg"><strong>Virtual Office</strong></td>
                            <td class="lightgrey">&nbsp;</td>
                            <td align="center" class="moderategrey">5% discount on virtual office monthly fee</td>
                            <td align="center" class="darkgrey">10% discount on virtual office monthly fee</td>
                        </tr>
                        <tr>
                        	<td class="orangebg"><strong>Free refreshments</strong></td>
                            <td align="center" class="lightgrey"><i class="fa fa-check" aria-hidden="true"></i></td>
                            <td align="center" class="moderategrey"><i class="fa fa-check" aria-hidden="true"></i></td>
                            <td align="center" class="darkgrey"><i class="fa fa-check" aria-hidden="true"></i></td>
                        </tr>
                         <tr>
                        	<td class="orangebg"><strong>Free Wi-Fi</strong></td>
                            <td align="center" class="lightgrey"><i class="fa fa-check" aria-hidden="true"></i></td>
                            <td align="center" class="moderategrey"><i class="fa fa-check" aria-hidden="true"></i></td>
                            <td align="center" class="darkgrey"><i class="fa fa-check" aria-hidden="true"></i></td>
                        </tr>
                        <tr>
                        	<td class="orangebg"><strong>Meeting from Conference Rooms & Videoconferencing and day office discounts</strong></td>
                           	<td align="center" class="lightgrey">10%</td>
                            <td align="center" class="moderategrey">15%</td>
                            <td align="center" class="darkgrey">15%</td>
                        </tr>
                        <tr>
                        	<td class="orangebg"><strong>Concierge</strong></td>
                            <td align="center" class="lightgrey"><i class="fa fa-check" aria-hidden="true"></i></td>
                            <td align="center" class="moderategrey"><i class="fa fa-check" aria-hidden="true"></i></td>
                            <td align="center" class="darkgrey"><i class="fa fa-check" aria-hidden="true"></i></td>
                        </tr>
                        <tr>
                        	<td class="orangebg"><strong>Events*</strong></td>
                            <td align="center" class="lightgrey"><i class="fa fa-check" aria-hidden="true"></i></td>
                            <td align="center" class="moderategrey"><i class="fa fa-check" aria-hidden="true"></i></td>
                            <td align="center" class="darkgrey"><i class="fa fa-check" aria-hidden="true"></i></td>
                        </tr>
                        <tr>
                        	<td class="orangebg"><strong>Offers on Smart Alliance**</strong></td>
                            <td align="center" class="lightgrey"><i class="fa fa-check" aria-hidden="true"></i></td>
                            <td align="center" class="moderategrey"><i class="fa fa-check" aria-hidden="true"></i></td>
                            <td align="center" class="darkgrey"><i class="fa fa-check" aria-hidden="true"></i></td>
                        </tr>
                        <tr>
                        	<td>&nbsp;</td>
                            <td align="center">&nbsp;</td>
                            <td align="center" class="mymembershipbtn"><button type="button" class="btn btn-block btn-lg">Upgrade Now</button></td>
                            <td align="center" class="mymembershipbtn"><button type="button" class="btn btn-block btn-lg">Upgrade Now</button></td>
                        </tr>
                    </table>
                 </div>
                
			</div>
	</section>		
</section>
<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});
</script>
<?php require_once(FCPATH.'assets/admin/lib/footer2.php'); ?>
