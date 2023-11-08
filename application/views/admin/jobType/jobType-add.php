<div class="container-xxl flex-grow-1 container-p-y pt-0">
	<h4 class="py-2 mb-2"><span class="text-muted fw-light">Job Type / </span> <?= isset($data) ? 'Edit' : 'Add' ?> </h4>
	<!-- Sticky Actions -->
	<form action="<?= !isset($data) ? base_url('admin/jobType/add') : base_url('admin/jobType/update') ?>" class="browser-default-validation mb-3 needs-validation" novalidate id="userForm" method="post" enctype="multipart/form-data">
		<div class="row">
			<div class="col-lg-12 mb-2">
				<div class="card">
					<div class="card-body">
						<div class="row">
							<h5 class="text-primary">Job Type Details</h5>
							<div class="row g-4">
								<input type="hidden" id="id" name="id" value="<?= isset($id) ? $id : '' ?>" class="form-control" />
								<div class="col-md-4">
									<div class="form-floating form-floating-outline">
										<input type="text" id="name" name="name" value="<?= isset($data['name']) ? $data['name'] : '' ?>" required class="form-control required" placeholder="Enter Name" />
										<label for="name">Name</label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="d-flex justify-content-center">
										<div class="m-1">
											<button type="submit" class="btn btn-primary d-flex send-msg-btn waves-effect waves-light submit">
												<span class="align-middle">Submit</span>
											</button>
										</div>
										<div class="mt-1">
											<button type="reset" class="btn btn-danger d-flex send-msg-btn waves-effect waves-light resetBtn">
												<span class="align-middle">Reset</span>
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
	</form>
	<div class="row">
		<div class="col-lg-12 mb-2">
			<div class="card">
				<div class="card-body">
					<div class="row">
						<h5 class="text-primary">Job Type Report</h5>
						<div class="card-datatable table-responsive pt-0 m-2">
							<table class="table table-bordered" id="WorkTable">
								<thead>
									<tr>
										<th>id</th>
										<th>Action</th>
										<th>Name</th>
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
	</div>
</div>
<div class="javascript">
	<script>
		$(document).ready(function () {
		var table = $('#WorkTable').DataTable({
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
				url: '<?= base_url('admin/jobType/getJobTypeList'); ?>',
				type: "post",
				data: function(data) {
					ShowBlockUi('#WorkTable');
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
					data: 'status'
				},
			]
		});

		function change_status({
			i,
			...payload
		}, current_status) {
			alert_if("Do you want to update the status?", function() {
				$.ajax({
					url: "<?= base_url("admin/work/status") ?>",
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
							ShowBlockUi('#WorkTable');
						} else {
							i.val(current_status)
							SweetAlert('error', 'Failed to update status.');
							ShowBlockUi('#WorkTable');
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
		});
	</script>
</div>
