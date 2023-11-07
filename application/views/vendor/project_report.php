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
										<select id="status" name="status" class="select2 form-select" data-allow-clear="true">
											<option value="">Status</option>
											<option value="PENDING">PENDING</option>
											<option value="INPROCESS">INPROCESS</option>
										</select>
										<label for="status">Status</label>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-floating form-floating-outline">
										<input type="date" name="from_date" id="from_date" value="<?= isset($data['from_date']) ? $data['from_date'] : '' ?>" required class="form-control phone-mask required" />
										<label for="from_date">From Date</label>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-floating form-floating-outline">
										<input type="date" name="to_date" id="to_date" value="<?= isset($data['to_date']) ? $data['to_date'] : '' ?>" required class="form-control phone-mask required" />
										<label for="to_date">To Date</label>
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
								<th>City</th>
								<th>Name</th>
								<th>Title</th>
								<th>Worker</th>
								<th>Vendor</th>
								<th>Customer</th>
								<th>Price</th>
								<th>Project Status</th>
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
<!-- / Content -->
<div class="javascript">
	<script>
		// $(document).ready(function () {
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
				url: '<?= base_url('vendor/project/getProjectList'); ?>',
				type: "post",
				data: function(data) {
					data.from_date = $('#from_date').val();
					data.to_date = $('#to_date').val();
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
					data: 'city'
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
					data: 'project_status'
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
					url: "<?= base_url("vendor/project/status") ?>",
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
		// });
	</script>
</div>