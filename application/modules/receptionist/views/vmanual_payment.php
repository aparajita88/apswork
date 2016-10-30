<?php require_once(FCPATH.'assets/admin/lib/header2.php'); ?> 
<style>
.design_select { background:#fff !important; border:1px solid #ddd; padding:5px 15px; font-size:15px; color:#000;}
</style>
<section role="main" class="content-body">
	<header class="page-header">
		<h2>Hi   <?php echo $userData['FirstName']." ".$userData['LastName'];?></h2>

		<div class="right-wrapper pull-right">
			
			</ol>
</div>
</header>
<form name="frmpayment" id="frmpayment" action="<?php echo base_url();?>index.php/receptionist/manual_payment" method="post">
<section class="panel">
						<?php if($this->session->flashdata('item')){ ?>
						<div class="alert alert-success" role="alert"><?php echo $this->session->flashdata('item'); ?></div>
						<?php } ?>
						<?php if($this->session->flashdata('item_error')){ ?>
						<div class="alert alert-danger" role="alert"><?php echo $this->session->flashdata('item_error'); ?></div>
                        <?php } ?>
                        <div class="panel-body"><h2 class="panel-title">Manual Payment</h2>

                           </div>
                           <div class="panel-body panel_body_top">
                            <div class="form-group">
                            <div class="col-md-6">
                            <select name="client" id="client" class="form-control" onchange="fngetinvoice(this.value)">
                                   <option value="">Select Client</option>
                                   <?php foreach($clientinfo as $clnt){?>
                                   <option value="<?php echo $clnt['userId'];?>|<?php echo $clnt['company_id'];?>"><?php echo $clnt['FirstName']." ".$clnt['LastName']." (".$clnt['userEmail'].") ".(($clnt['company_name']<>"")?$clnt['company_name']:'Individual');?></option>
                                   <?php }?>
                                        </select>
                                  
                            </div>
                            <div class="col-md-6">
                            <select name="invoice" id="invoice" class="form-control"  onchange="fndueamount()">
                                   <option value="">Select Invoice</option>
                                   
                                        </select>
                                  
                            </div>
                            </div>
                            <input type="hidden" id="due_amount" value="">
                           </div>
                           <div class="panel-body">
                           <div class="form-group">
                            <div class="col-md-12">
                            
                                <label>Purpose of Payment </label>
                                <textarea name="purpose" rows="4" cols="100" class="form-control"></textarea>
                            </div>
                            </div>
                            <div class="form-group">
                            <div class="col-md-4">
                            
                                <label>Payment Type </label>
                                <select name="payment_type" class="form-control" id="payment_type">
                                <option value="">Select Payment Type</option>
                                <option value="cash">Cash</option>
                                <option value="cheque no/pos no">Cheque No/Pos No</opttion>
                                <option value="debit card">Debit Card</option>
                                <option value="credit card">Credit Card</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                            
                                <label>Amount(INR) </label>
                               <input type="text" name="amount" id="amount" class="form-control" placeholder="payment amount"/>

                            </div>
                            <div class="col-md-4">
                            
                                <label>Cheque No/Pos No</label>
                               <input type="text" name="cheque_no" id="cheque_no" placeholder="Please enter cheque no or Pos no" class="form-control"/>

                            </div>
                            </div>
                           </div>
                           <div class="panel-body">
  	<div class="form-group sub_text" style="padding-left:15px !important;">
           <button type="button" id="add_payment" class="btn savepayment"  >Save & Print Receipt</button>
    </div>
  </div>
</form>
<?php require_once(FCPATH.'assets/admin/lib/footer2.php'); ?> 
<style>
.savepayment{
	background-color: #000;
	color:#fff;
}
</style>
<script type="text/javascript">
function fngetinvoice(clntid){
	$.ajax({
		  url: '<?php echo base_url();?>index.php/manager/get_invoice_for_client', 
		  type: 'post', 
		  data:"clientid="+clntid,
		  
		success: function(result) {
			$('#invoice').html(result);
			}
		});
}
$(document).ready(function(){
	var float= /^\s*(\+|-)?((\d+(\.\d+)?)|(\.\d+))\s*$/;
	$('#add_payment').click(function(){
		if($('#client').val()==""){
			alert('Please select the client');
			$('#client').css({'border-color':'red'});
			$('#client').focus();
		}else if($('#invoice').val()==""){
			alert('Please select the invoice');
			$('#invoice').css({'border-color':'red'});
			$('#invoice').focus();
		}else if($('#payment_type').val()==""){
			alert('Please select the payment type');
			$('#payment_type').css({'border-color':'red'});
			$('#payment_amount').focus();
		}else if($('#amount').val()==""){
			alert('Please select the payment amount');
			$('#amount').css({'border-color':'red'});
			$("#amount").attr("placeholder", "Give the payment amount");
			$('#amount').focus();
		}else if(!float.test($('#amount').val())){
			alert('Please enter a valid amount');
			$('#amount').val('');
			$('#amount').css({'border-color':'red'});
			$("#amount").attr("placeholder", "Give the valid payment amount");
			$('#amount').focus();
		}
		else if(parseFloat($('#amount').val())>parseFloat($('#due_amount').val())){
			alert('Amount should not be exceed than the due amount');
			$('#amount').val('');
			$('#amount').css({'border-color':'red'});
			$("#amount").attr("placeholder", "Give the valid payment amount");
			$('#amount').focus();
		}
		else if($('#payment_type').val()=="cheque" && $('#cheque_no').val()==""){
			alert('Please enter a cheque no');
			$('#cheque_no').css({'border-color':'red'});
			$('#cheque_no').attr("placeholder", "Give the valid cheque no");
			$('#cheque_no').focus();
		}
		else if($('#payment_type').val()=="pos" && $('#cheque_no').val()==""){
			alert('Please enter a pos no');
			$('#cheque_no').css({'border-color':'red'});
			$('#cheque_no').attr("placeholder", "Give the valid pos no");
			$('#cheque_no').focus();
		}
		else{
			$('#frmpayment').submit();
		}
	});
});
function fndueamount(){
	var invoicetext=$("#invoice option:selected").text();
	var due_text=invoicetext.split('|');
	var text=due_text[1];
	var due_amount=text.replace('Due Amount:', '');
	$('#due_amount').val(due_amount);
}
</script>