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
								<div class="col-md-2">
									<div class="form-floating form-floating-outline">
										<select id="worker" name="worker" class="select2 form-select" data-allow-clear="true">
											<option value="">Select Worker</option>
											<?php
											if (!empty($worker)) {
												foreach ($worker as $key => $value) { ?>
													<option value="<?= $value['id'] ?>" <?= isset($data['worker']) && $data['worker'] == $value['id'] ? 'selected' : '' ?>><?= $value['name'] ?></option>
											<?php }
											} ?>
										</select>
										<label for="worker">Worker</label>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-floating form-floating-outline">
										<select id="vendor" name="vendor" class="select2 form-select" data-allow-clear="true">
											<option value="">Select Vendor</option>
											<?php
											if (!empty($vendor)) {
												foreach ($vendor as $key => $value) { ?>
													<option value="<?= $value['id'] ?>" <?= isset($data['vendor']) && $data['vendor'] == $value['id'] ? 'selected' : '' ?>><?= $value['name'] ?></option>
											<?php }
											} ?>
										</select>
										<label for="vendor">Select Vendor</label>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-floating form-floating-outline">
										<select id="customer" name="customer" class="select2 form-select" data-allow-clear="true">
											<option value="">Select Customer</option>
											<?php
											if (!empty($customer)) {
												foreach ($customer as $key => $value) { ?>
													<option value="<?= $value['id'] ?>" <?= isset($data['customer']) && $data['customer'] == $value['id'] ? 'selected' : '' ?>><?= $value['name'] ?></option>
											<?php }
											} ?>
										</select>
										<label for="customer">Select Customer</label>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-floating form-floating-outline">
										<select id="status" name="status" class="select2 form-select" data-allow-clear="true">
											<option value="">Status</option>
											<option value="ACTIVE">ACTIVE</option>
											<option value="INACTIVE">INACTIVE</option>
										</select>
										<label for="status">Status</label>
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
								<th>Action</th>
								<th>Name</th>
								<th>Title</th>
								<th>Worker</th>
								<th>Vendor</th>
								<th>Customer</th>
								<th>Price</th>
								<th>Start Date</th>
								<th>End Date</th>
								<th>Status</th>
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
<div class="javascript">
	<script>
		// $(document).ready(function () {
		var table = $('#ProjectTable').DataTable({
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
				url: '<?= base_url('admin/project/getProjectList'); ?>',
				type: "post",
				data: function(data) {
					data.worker_id = $('#worker').val();
					data.vendor_id = $('#vendor').val();
					data.customer_id = $('#customer').val();
					data.status = $('#status').val();
					data.search = $('#search').val();
					ShowBlockUi('#ProjectTable');
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
					data: 'title'
				},
				{
					data: 'worker'
				},
				{
					data: 'vendor'
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
				{
					data: 'status'
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
