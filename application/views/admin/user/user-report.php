<div class="container-xxl flex-grow-1 container-p-y pt-0">
	<h4 class="py-2 mb-2"><span class="text-muted fw-light">User / </span> Report </h4>
	<div class="row mb-3">
		<div class="col-lg-12 mb-3">
			<div class="card">
				<div class="card-body">
					<div class="row">
						<h5 class="mb-1 ">Filters</h5>
						<div class="row g-4 mt-3">
							<div class="row">
								<div class="col-md-3">
									<div class="form-floating form-floating-outline">
										<select id="user_type" name="user_type" class="select2 form-select" data-allow-clear="true">
											<option value="">Type</option>
											<option value="CUSTOMER">CUSTOMER</option>
											<option value="VENDOR">VENDOR</option>
											<option value="WORKER">WORKER</option>
										</select>
										<label for="user_type">Type</label>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-floating form-floating-outline">
										<select id="status" name="status" class="select2 form-select" data-allow-clear="true">
											<option value="">Status</option>
											<option value="ACTIVE">ACTIVE</option>
											<option value="INACTIVE">INACTIVE</option>
										</select>
										<label for="status">Status</label>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-floating form-floating-outline">
										<select id="city" name="city" class="select2 form-select required" data-lable='City' required data-allow-clear="true">
											<option value="">Select City</option>
											<?php if(!empty($city)){ ?>
												<?php foreach ($city as $key => $value) {?>
                                                    <option value="<?= $value['id']?>" <?= isset($data['city_id']) && $data['city_id'] == $value['id']? "selected" : ''?>><?= $value['name']?></option>
                                                <?php }?>
                                            <?php }?>
										</select>
										<label for="City">City</label>
									</div>
								</div>
								<div class="col-md-3 mb-3">
									<div class="form-floating form-floating-outline">
										<input type="text" id="search" name="search" class="form-control" placeholder="User Name" />
										<label for="search">Search User</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="">
										<div class="m-1">
											<button type="submit" class="btn btn-primary d-flex send-msg-btn waves-effect waves-light search-btn">
												<span class="align-middle">Search</span>
											</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row mb-5">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-datatable table-responsive pt-0 m-2">
					<table class="table table-bordered" id="usersTable">
						<thead>
							<tr>
								<th>id</th>
								<th>Action</th>
								<th>Name</th>
								<th>Email</th>
								<th>Mobile</th>
								<th>City</th>
								<th>User Type</th>
								<th>Job Type</th>
								<th>Status</th>
								<th>Created At</th>
							</tr>
						</thead>
						<tbody></tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- / Content -->
<div class="modal fade" id="permissionModel" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-scrollable modal-xl" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="exampleModalLabel1">Manage User's Services</h4>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body pt-0 pb-0" id="Modelbody">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
					Close
				</button>
				<button type="submit" id="add_permission" class="btn btn-primary">Save changes</button>
			</div>
		</div>
	</div>
</div>
<div class="javascript">
	<script>
		// $(document).ready(function () {
			var table = $('#usersTable').DataTable({
				fixedHeader: false,
				responsive: true,
				serverSide: true,
				showLoader: true,
				destroy: true,
				autoFill: true,
				searching: false,
				paging: true,
				processing: false,
				ajax: {
					url : '<?= base_url('admin/user/getUserList'); ?>',
					type : "post",
					data : function(data) {
						data.user_type = $('#user_type').val();
						data.status = $('#status').val();
						data.search = $('#search').val();
						data.city_id = $('#city').val();
						ShowBlockUi('#usersTable');
					}
				},
				'columns': [{
						data: 'id'
					},
					{
						data: 'action'
					},
					{
						data: 'name'
					},
					{
						data: 'email'
					},
					{
						data: 'mobile'
					},
					{
						data: 'city'
					},
					{
						data: 'user_type'
					},
					{
						data: 'job_type'
					},
					{
						data: 'status'
					},
					{
						data: 'created_at'
					},
				]
			});
	
			$(document).on('click', '.search-btn', function() {
				table.ajax.reload();
				((element) => ShowBlockUi(element))('#usersTable')
			});
	
			function change_status({
				i,
				...payload
			}, current_status) {
				alert_if("Do you want to update the status?", function() {
					$.ajax({
						url: "<?= base_url("admin/user/status") ?>",
						type: 'POST',
						showLoader: true,
						data: payload,
						dataType:'json',
						success: function(response) {
							var {success,message} = response;
							if (success) {
								SweetAlert('success', message);
								ShowBlockUi('#usersTable');
							} else {
								i.val(current_status)
								SweetAlert('error', 'Failed to update status.');
								ShowBlockUi('#usersTable');
							}
						},
						error: function() {
							SweetAlert('error', 'There was a problem processing your request.');
						},
					});
				}, () => {
					current_status = !i.prop("checked") ? i.data("on") : i.data("off");
					i.prop('checked', !i.prop('checked')).siblings('.switch-label').text(current_status)
				});
			}
	
			$(document).on('change', '.status', function() {
				var i = $(this);
				let current_status = i.data('status');
				status = i.is(":checked") ? i.data('on') : i.data('off')
				obj = {
					status: status,
					id: i.data('id'),
					i: i
				}
				change_status(obj, current_status);
			});
		// });
	</script>
</div>
