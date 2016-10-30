<?php require_once(FCPATH.'assets/admin/lib/header.php'); ?> 
<section role="main" class="content-body">
	<header class="page-header">
		<h2>Country</h2>

		<div class="right-wrapper pull-right">
			<ol class="breadcrumbs">
				<li>
					<a href="<?php echo base_url(); ?>" title="city">
						<i class="fa fa-home"></i>
					</a>
				</li>
				<li><span>Country</span></li>
			</ol>

			<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
		</div>
	</header>
	<section class="panel" id="country_list_div">
		<header class="panel-heading">
			<div class="panel-actions">
				<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
				<a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
			</div>
	
			<h2 class="panel-title">Country List</h2>
		</header>
		<div class="panel-body">
			<div>
				<input type="button" class="btn btn-primary" value="Add new" id="add_new_country" />
			</div>
			<table class="table table-bordered table-striped mb-none" id="datatable-tabletools" data-swf-path="assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf">
				<thead>
					<tr>
						<th>Id</th>
						<th>Name</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						if(isset($allCountries) && count($allCountries)){ 
							foreach($allCountries as $country){
					?>
					<tr class="gradeX">
						<td><?php echo $country['id']; ?></td>
						<td><?php echo $country['name']; ?></td>
						<td><?php echo ($country['status']==1)?"Active":"Inactive"; ?></td>
						<td>
							<a href="Javascript:void(0)" id="<?php echo "country_edit_btn_".$country['id']; ?>" onclick="drawCountryEdit(this.id)"><img src="<?php echo base_url()."assets/icon/edit.png"; ?>" title="Edit" alt="Edit"></a>
							<a href="Javascript:void(0)" id="<?php echo "country_delete_btn_".$country['id']; ?>" onclick="deleteCountry(this.id)"><img src="<?php echo base_url()."assets/icon/delete.png"; ?>" title="Delete" alt="Delete"></a>
						</td>
					</tr>
					<?php 
							} 
						}
					?>
				</tbody>
			</table>
		</div>
	</section>
	
	<!--Country add html start here-->
	
	<div class="row" id="country_add_div" style="display:none;">
		<div class="col-xs-12">
			<section class="panel">
				<header class="panel-heading">
					<div class="panel-actions">
						<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
						<a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
					</div>
	
					<h2 class="panel-title">Add new Country</h2>
				</header>
				<div class="panel-body">
					<form class="form-horizontal form-bordered" action="<?php echo base_url().'index.php/countries/save' ?>" id="country_add_form" method="post">
						<div class="form-group">
							<label class="col-md-3 control-label">Country name</label>
							<div class="col-md-6">
								<input type="text" class="from-control" name="country" id="country" placeholder="Country Name" onclick="removeValidateHtml(this.id)">
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-2"><input type="button" value="Add country" id="save_new_country" class="btn btn-primary"></div>
							<div class="col-md-2"><input type="button" value="Cancel" id="cancel_add_country" class="btn btn-danger"></div>
						</div>
					</form>
				</div>
			</section>
		</div>
	</div>
	
	<!--Country add html end here-->
	
	
	
	
</section>
</div>

<?php require_once(FCPATH.'assets/admin/lib/right.php'); ?> 

</section>

<?php require_once(FCPATH.'assets/admin/lib/footer.php'); ?> 
