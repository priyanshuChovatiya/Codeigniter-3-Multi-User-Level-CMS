<div class="container-xxl flex-grow-1 container-p-y pt-0">
	<h4 class="py-2 mb-2"><span class="text-muted fw-light">Project / </span> Report </h4>
	<div class="row mb-3">
		<div class="col-lg-12 mb-3">
			<div class="card">
				<div class="card-body">
					<div class="row">
						<h5 class="mb-1 ">Filters</h5>
						<div class="row g-4 mt-3">
							<div class="row">
								<div class="col-md-2">
									<div class="form-floating form-floating-outline">
										<select id="city" name="city" class="select2 form-select required" data-lable='City' required data-allow-clear="true">
											<option value="">Select City</option>
											<?php if (!empty($city)) { ?>
												<?php foreach ($city as $key => $value) { ?>
													<option value="<?= $value['id'] ?>" <?= isset($data['city_id']) && $data['city_id'] == $value['id'] ? "selected" : '' ?>><?= $value['name'] ?></option>
												<?php } ?>
											<?php } ?>
										</select>
										<label for="City">City</label>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-floating form-floating-outline">
										<select id="worker_status" name="worker_status" class="select2 form-select" data-lable='Worker Status' data-allow-clear="true">
											<option value="">Select Worker Status</option>
											<option value="PENDING">PENDING</option>
											<option value="INPROCESS">INPROCESS</option>
											<option value="COMPLATED">COMPLATED</option>
										</select>
										<label for="Worker Status">Worker Status</label>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-floating form-floating-outline">
										<select id="vendor_status" name="vendor_status" class="select2 form-select" data-lable='Vendor Status' data-allow-clear="true">
											<option value="">Select Vendor Status</option>
											<option value="PENDING">PENDING</option>
											<option value="INPROCESS">INPROCESS</option>
											<option value="COMPLATED">COMPLATED</option>
										</select>
										<label for="Vendor Status">Vendor Status</label>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-floating form-floating-outline">
										<input type="text" id="search" name="search" class="form-control" placeholder="User Name" />
										<label for="search">Search Project </label>
									</div>
								</div>
								<div class="col-md-2">
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
					<table class="table table-bordered" id="ProjectTable">
						<thead>
							<tr>
								<th>id</th>
								<th>Project Status</th>
								<th>Action</th>
								<th>Name</th>
								<th>Title</th>
								<th>City</th>
								<th>Job Type</th>
								<th>Worker</th>
								<th>Worker Status</th>
								<th>Mobile</th>
								<th>Email</th>
								<th>Vendor</th>
								<th>Vendor Status</th>
								<th>Mobile</th>
								<th>Email</th>
								<th>Customer</th>
								<th>Price</th>
								<th>Start Date</th>
								<th>End Date</th>
							</tr>
						</thead>
						<tbody></tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="statusModel" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="exampleModalLabel1">Change Status</h4>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form action="<?= base_url('worker/project/update_status'); ?>" id="permissionForm" class="browser-default-validation needs-validation" novalidate method="post" enctype="multipart/form-data">
				<div class="modal-body pb-0" id="Modelbody">
					<div class="row">
						<div class="col-md-6">
							<div class="form-floating form-floating-outline">
								<input type="file" id="work_image" multiple name="work_image[]" class="form-control file" />
								<label for="work_image">Project Image</label>
							</div>
							<p class="pb-1 mb-1"> Select Please Multiple Image</p>
						</div>
						<div class="col-md-6">
							<div class="form-floating form-floating-outline">
								<input type="text" id="remark" name="remark" class="form-control" />
								<label for="remark">Remark</label>
							</div>
						</div>
						<input type="hidden" id="id" name="id" class="form-control" />
						<input type="hidden" id="status" name="status" class="form-control" />
						<div class="col-md-12">
							<div class="show_image row">
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer mt-3">
					<button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
						Close
					</button>
					<button type="submit" id="add_permission" class="btn btn-primary">Save changes</button>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="modal fade" id="viewImageModel" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="exampleModalLabel1">Side Images</h4>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body pb-0" id="viewImageModelBody">
			</div>
			<div class="modal-footer mt-3">
				<button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
					Close
				</button>
			</div>
		</div>
	</div>
</div>
<!-- / Content -->
<div class="javascript">
	<script>
		$(document).ready(function() {
			var table = $('#ProjectTable').DataTable({
				fixedHeader: false,
				responsive: false,
				serverSide: true,
				showLoader: true,
				destroy: true,
				autoFill: true,
				searching: false,
				paging: true,
				processing: false,
				ajax: {
					url: '<?= base_url('worker/project/getProjectList'); ?>',
					type: "post",
					data: function(data) {
						data.worker_status = $('#worker_status').val();
						data.vendor_status = $('#vendor_status').val();
						data.search = $('#search').val();
						data.city = $('#city').val();
						ShowBlockUi('#ProjectTable');
					}
				},
				'columns': [{
						data: 'id'
					},
					{
						data: 'project_status'
					},
					{
						data: 'action'
					},
					{
						data: 'name'
					},
					{
						data: 'title'
					},
					{
						data: 'city'
					},
					{
						data: 'job_type'
					},
					{
						data: 'worker'
					},
					{
						data: 'worker_status'
					},
					{
						data: 'w_mobile'
					},
					{
						data: 'w_email'
					},
					{
						data: 'vendor'
					},
					{
						data: 'vendor_status'
					},
					{
						data: 'v_mobile'
					},
					{
						data: 'v_email'
					},
					{
						data: 'customer'
					},
					{
						data: 'price'
					},
					{
						data: 'start_date'
					},
					{
						data: 'end_date'
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
						url: "<?= base_url("admin/project/status") ?>",
						type: 'POST',
						showLoader: true,
						data: payload,
						dataType: 'json',
						success: function(response) {
							var {
								success,
								message
							} = response;
							if (success) {
								SweetAlert('success', message);
								ShowBlockUi('#ProjectTable');
							} else {
								i.val(current_status)
								SweetAlert('error', 'Failed to update status.');
								ShowBlockUi('#ProjectTable');
							}
						},
						error: function() {
							SweetAlert('error', 'There was a problem processing your request.');
						},
					});
				}, () => {
					if (payload.type == 'project_status') {
						i.val(current_status);
					} else {
						current_status = !i.prop("checked") ? i.data("on") : i.data("off");
						i.prop('checked', !i.prop('checked')).siblings('.switch-label').text(current_status)
					}
				});
			}

			$(document).on('change', '.status', function() {
				var i = $(this);
				let current_status = i.data('status');
				status = i.is(":checked") ? i.data('on') : i.data('off')
				obj = {
					status: status,
					id: i.data('id'),
					i: i,
					type: 'status',
				}
				change_status(obj, current_status);
			});
			$(document).on('change', '.project_status', function() {
				var i = $(this);
				let current_status = i.data('current-status');
				obj = {
					i: i,
					id: i.data('id'),
					status: i.val(),
					type: 'project_status',
				}
				change_status(obj, current_status);

			});

			$(document).on('click', '.viewImage', function() {
				var project_detail_id = $(this).data('id');
				$('#viewImageModelBody').html("");
				$.ajax({
					url: "<?= site_url() . 'worker/project/viewImage'; ?>",
					type: 'post',
					showLoader: true,
					data: {
						project_detail_id: project_detail_id,
					},
					success: function(res) {
						$('#viewImageModelBody').html(res);
						$("#viewImageModel").modal('show');
					}
				});
			});

			$(document).on('click', '.approved', function() {
				$("#statusModel").modal('show');
				var worker_id = $(this).data('id');
				$('#id').val('');
				$('#status').val('');
				$('#work_image').val('');
				$('#id').val(worker_id);
				$('#status').val('COMPLATED');
			});
			$(document).on('click', '.inprogress ', function() {
				$("#statusModel").modal('show');
				var worker_id = $(this).data('id');
				$('#id').val('');
				$('#status').val('');
				$('#work_image').val('');
				$('#id').val(worker_id);
				$('#status').val('INPROCESS');
			});
		});
	</script>
</div>
