<style type="text/css">
    p.head {
        text-align: center;
        font-size: 1.6em;
    }
    p.sub-head {
        text-align: center;
    }
    .cende-table table tbody tr:first-child, .cende-table table tbody tr:last-child {
        font-weight: bold;
    }
    span {
        vertical-align: middle;
    }
</style>
<?php require_once(FCPATH.'assets/admin/lib/header2.php'); ?>

<section role="main" class="content-body">
  <header class="page-header">
    <h2>Hi <?php echo $userData['FirstName']." ".$userData['LastName'];?></h2>
    <div class="right-wrapper pull-right">
      </ol>
    </div>
  </header>
  <section class="panel">
    <div class="panel-body">
      <h2 class="panel-title"><?= $table_heading; ?></h2>
    </div>
    <div class="panel-body panel_body_top">
                    <div class="form-group sub_text1 selUser">
                        <select class="fform-control selection2">
                          <option value="">Select Client</option>
                          <?php 
                            foreach($userlist as $value) {
                                if (isset($com_id) && $com_id == $value['company_id']."|++|".$value['userId']) {
                                    echo '<option value="'.$value['company_id']."|++|".$value['userId'].'" selected>'.ucfirst($value['FirstName']).' '.ucfirst($value['LastName']).' ('.$value['userEmail'].') '.ucfirst($value['company_name']).'</option>'; 
                                }else{
                                 echo '<option value="'.$value['company_id']."|++|".$value['userId'].'">'.ucfirst($value['FirstName']).' '.ucfirst($value['LastName']).' ('.$value['userEmail'].') '.ucfirst($value['company_name']).'</option>'; 
                                }
                            }
                          ?>
                        </select>
                    </div>
            </div>
     <div class="panel-body panel_body_top">
     	<div id="messageError" class="col-md-12"></div>
        <p class="head">Transaction History</p>
        <hr>
        <div class="form-group mainform">
            <div class="col-md-6">
                          <?php if(isset($userDetails) && !empty($userDetails)) {?>
                          <span style="font-weight: bold; margin-right: 15px;">Centre:</span> <span><?= ucfirst($userDetails['l_name']); ?>, <?= ucfirst($userDetails['c_name']); ?></span>
                          <?php } ?>
            </div>
            <div class="col-md-6">
                <div class="col-md-5 pull-right" style="margin-bottom: 15px;">
                    <input type="text" class="form-control mycalender" id="dtStart" name="dtStart" value="<?= ((isset($start_date) && $start_date != '') ? $start_date : '')?>" placeholder="Start Date"/>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-6">
                         <?php if(isset($userDetails) && !empty($userDetails)) {?>
                          <span style="font-weight: bold; margin-right: 15px;">Customer:</span> <span><?= ($userDetails['company_name']!= '') ? ucfirst($userDetails['company_name']) : 'Individual'; ?></span>
                          <?php } ?>
            </div>
            <div class="col-md-6">
                <div class="col-md-5 pull-right">
                    <input type="text" class="form-control mycalender" id="dtEnd" name="dtEnd" value="<?= ((isset($end_date) && $end_date != '') ? $end_date : '')?>" placeholder="End Date"/>
                </div>
            </div>
        </div>
        <?php if (isset($_POST) && !empty($_POST)) { ?>
        <?php if(isset($acc_statement['invoice']) && count($acc_statement['invoice']) > 0 && !empty($acc_statement['invoice'])){?>
        <p class="sub-head">Please note that any transactions placed in the last 2 days may not be reflected</p>
        <div class="cende-table">
	        <div class="table-responsive">
	        	<table class="table table-bordered table-striped" >
					<thead>
			    		<tr role="row">
			                <th>DATE</th>
			                <th>TRANSACTION TYPE</th>
			                <th>TRANSACTION REFERENCE</th>
			                <th>DEBIT</th>
			                <th>CREDIT</th>
			                <th>OUTSTANDING BALANCE (INR)</th>
			            </tr>
					</thead>
					<tbody>
			          	<tr>
				            <td>
                                <?php 
                                    $date=date_create($acc_statement['ending_balance_date']);
                                    echo date_format($date,"d-M-y");
                                ?>            
                            </td>
				            <td></td>
				            <td>Ending Balance</td>
				            <td></td>
				            <td></td>
				            <td><?= $acc_statement['ending_balance'];?></td>
			          	</tr>
		         		 <?php 
                         $temp = 0;
			          	foreach($acc_statement['invoice'] as $key => $dat){
			          		$date=date_create($dat['p_date']);
			          	?>
                        <?php if($dat['t_status'] == 'paid'){ ?>
                        <tr>
                            <td><?= date_format($date,"d-M-y"); ?></td>
                            <td><?= ucfirst('Invoice'); ?></td>
                            <td><?= $dat['t_number']; ?></td>
                            <td><?= $dat['t_amount']; ?></td>
                            <td></td>
                            <td><?= $dat['t_outstanding_debit']; ?></td>
                        </tr>
                        <?php }?>
			          	<tr>
                            <?php if($dat['t_status'] == 'debit'){?>
                                <td><?= date_format($date,"d-M-y"); ?></td>
                                <td><?= ucfirst($dat['t_type']); ?></td>
                                <td><?= $dat['t_number']; ?></td>
				                <td><?= $dat['t_amount']; ?></td>
                                <td></td>
                                 <td><?= $dat['t_outstanding']; ?></td>
                            <?php }elseif($dat['t_status'] == 'credit'){ ?>
                                <td><?= date_format($date,"d-M-y"); ?></td>
                                <td><?= ucfirst($dat['t_type']); ?></td>
                                <td><?= $dat['t_number']; ?></td>
                                <td></td>
                                <td><?= $dat['t_amount']; ?></td>
                                 <td><?= $dat['t_outstanding']; ?></td>
                            <?php }elseif($dat['t_status'] == 'paid'){ ?>
                                <td><?= date_format($date,"d-M-y"); ?></td>
                                <td><?= ucfirst('Payment'); ?></td>
                                <td><?= $dat['t_number']; ?></td>
                                <td></td>
                                <td><?= $dat['t_amount']; ?></td>
                                 <td><?= $dat['t_outstanding_credit']; ?></td>
                            <?php }?>
			          	</tr>
			          	<?php } ?>
			          <tr>
			            <td>
			            <?php 
			            	$date=date_create($acc_statement['staring_balance_date']);
							echo date_format($date,"d-M-y");
			            ?>
			            </td>
			            <td></td>
			            <td>Starting Balance</td>
			            <td></td>
			            <td></td>
			            <td><?= $acc_statement['staring_balance'];?></td>
			          </tr>
					</tbody>
				</table>
	        </div>
        </div>
        <div class="col-md-12"><a class="btn btn-primary" href="<?php echo base_url(); ?>index.php/invoice/account_statements_pdf/<?php echo base64_encode(base64_encode($userDetails['userId'])); ?>/<?php echo base64_encode(base64_encode($userDetails['company_id'])); ?>/<?php echo base64_encode(base64_encode($start_date)); ?>/<?php echo base64_encode(base64_encode($end_date)); ?>" target="_blank">Print</a></div>
        <?php }else{?>
        <div style="margin-top:18px; text-align: center;" class="alert alert-danger fade in"><a title="close"  aria-label="close" data-dismiss="alert" class="close" href="#">×</a><strong>No account statement(s) available.</strong></div>
        <?php } ?>
        <?php } ?>
     </div>
     <?php  $attributes = array('name' => 'account_stmt_frm','id' => 'account_stmt_frm','class'=>"for_sign_up");
	   echo form_open('index.php/receptionist/account_statements/', $attributes);?>
	    <input type="hidden" id='start_date' name="start_date" value="<?= ((isset($start_date) && $start_date != '') ? $start_date : '')?>"/>
	    <input type="hidden" id='end_date' name="end_date" value="<?= ((isset($end_date) && $end_date != '') ? $end_date : '')?>"/>
         <input type="hidden" id='com_id' name="com_id" value="<?= ((isset($com_id) && $com_id != '') ? $com_id : '')?>"/>
  </section>
</section>
</section>
<?php require_once(FCPATH.'assets/admin/lib/footer2.php'); ?>
<script type="text/javascript">
    $(function() {
    	$("#messageError").html('');
        $("#dtStart").datepicker({
            format: 'mm-yyyy',
            minViewMode: 'months',
    		viewMode: 'months',
         	pickTime: false,
            autoclose: true,
        }).on('changeDate', function (selected) {
            var startDate = new Date(selected.date.valueOf());
            $('#dtEnd').datepicker('setStartDate', startDate);
            console.log($(this).val());
        }).on('clearDate', function (selected) {
            $('#dtEnd').datepicker('setStartDate', null);
        });

        $("#dtEnd").datepicker({
            format: 'mm-yyyy',
            minViewMode: 'months',
    		viewMode: 'months',
         	pickTime: false,
            autoclose: true,
        }).on('changeDate', function (selected) {
            var endDate = new Date(selected.date.valueOf());
            $('#dtStart').datepicker('setEndDate', endDate);
            console.log($(this).val());
            if(chkUser() && chkStartDate() && chkEndDate()){
		        $("#messageError").html('');
		        $('#start_date').val($("#dtStart").val());
		        $('#end_date').val($(this).val());
		        $("#account_stmt_frm").submit();
	        }
        }).on('clearDate', function (selected) {
            $('#dtStart').datepicker('setEndDate', null);
        });
        $('.selection2').change(function(){
            $('#com_id').val($(this).val());
        });
  });
function chkUser(){
    var com_id = $("#com_id").val();
    if(com_id == ''){
        $("#dtStart").val("");
        $("#dtEnd").val("");
        $("#messageError").html('<div style="margin-top:18px;" class="alert alert-danger fade in"><a title="close"  aria-label="close" data-dismiss="alert" class="close" href="#">×</a><strong>Please select a user first.</strong></div>');
        return false;
    }else{
        $("#messageError").html('');
        return true;
    }
}
function chkStartDate(){
    var start = $("#dtStart").val();
    if(start == ''){
        $("#messageError").html('<div style="margin-top:18px;" class="alert alert-danger fade in"><a title="close"  aria-label="close" data-dismiss="alert" class="close" href="#">×</a><strong>Please select start date.</strong></div>');
        return false;
    }else{
        $("#messageError").html('');
        return true;
    }
}
function chkEndDate(){
    var end = $("#dtEnd").val();
    if(end == ''){
        $("#messageError").html('<div style="margin-top:18px;" class="alert alert-danger fade in"><a title="close"  aria-label="close" data-dismiss="alert" class="close" href="#">×</a><strong>Please select end date.</strong></div>');
        return false;
    }else{
        $("#messageError").html('');
        return true;
    }
}
</script>
 
