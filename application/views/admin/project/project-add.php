<div class="container-xxl flex-grow-1 container-p-y pt-0">
	<h4 class="py-2 mb-2"><span class="text-muted fw-light">Project / </span> <?= isset($data) ? 'Edit' : 'Add' ?> </h4>
	<!-- Sticky Actions -->
	<form action="<?= !isset($data) ? base_url('admin/project/add') : base_url('admin/project/update') ?>" class="browser-default-validation mb-3 needs-validation" novalidate id="userForm" method="post" enctype="multipart/form-data">
		<div class="row">
			<div class="col-lg-12 mb-2">
				<div class="card">
					<div class="card-body">
						<div class="row">
							<h5 class="text-primary">Project Details</h5>
							<div class="row g-4">
								<input type="hidden" id="id" name="id" value="<?= isset($id) ? $id : '' ?>" class="form-control" />
								<input type="hidden" id="vendor_id" name="vendor_id" value="<?= isset($data['vendor_id']) ? $data['vendor_id'] : '' ?>" class="form-control" />
								<input type="hidden" id="worker_id" name="worker_id" value="<?= isset($data['worker_id']) ? $data['worker_id'] : '' ?>" class="form-control" />
								<input type="hidden" id="customer_id" name="customer_id" value="<?= isset($data['customer_id']) ? $data['customer_id'] : '' ?>" class="form-control" />
								<div class="col-md-4">
									<div class="form-floating form-floating-outline">
										<input type="text" id="name" name="name" value="<?= isset($data['name']) ? $data['name'] : '' ?>" required class="form-control required" placeholder="Enter Name" />
										<label for="name">Name</label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-floating form-floating-outline">
										<input type="text" id="title" name="title" value="<?= isset($data['title']) ? $data['title'] : '' ?>" required class="form-control required" placeholder="Enter Title" />
										<label for="title">Title</label>
									</div>
								</div>
								<div class="col-md-4">
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
								<div class="col-md-4">
									<div class="form-floating form-floating-outline">
										<select id="worker" name="worker" class="select2 form-select getWorker required" data-lable='Worker' required data-allow-clear="true">
											<option value="">Select Worker</option>
										</select>
										<label for="worker">Workers</label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-floating form-floating-outline">
										<select id="vendor" name="vendor" class="select2 form-select getVendor required" data-lable='Vendor' required data-allow-clear="true">
											<option value="">Select Vendor/option>
										</select>
										<label for="vendor">Vendor</label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-floating form-floating-outline">
										<select id="customer" name="customer" class="select2 form-select getCustomer required" data-lable='Customer' required data-allow-clear="true">
											<option value="">Select Customer/option>
										</select>
										<label for="customer">Customer</label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-floating form-floating-outline">
										<input type="number" name="price" id="price" value="<?= isset($data['price']) ? $data['price'] : '' ?>" required class="form-control phone-mask required  positiveNumber" placeholder="0.00" aria-label="0.00" />
										<label for="price">Price</label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-floating form-floating-outline">
										<input type="date" name="start_date" id="start_date" value="<?= isset($data['start_date']) ? $data['start_date'] : '' ?>" required class="form-control phone-mask required" />
										<label for="start_date">Start Date</label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-floating form-floating-outline">
										<input type="date" name="end_date" id="end_date" value="<?= isset($data['end_date']) ? $data['end_date'] : '' ?>" required class="form-control phone-mask required" />
										<label for="end_date">End Date</label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-floating form-floating-outline">
										<input type="file" id="project_image" name="project_image" <?= !isset($data) ? 'required' : '' ?> class="form-control file <?= !isset($data) ? 'required' : '' ?>" />
										<label for="project_image">Project Image</label>
									</div>
									<div class="show_image">
										<?php $url = isset($data['project_image']) ? 'assets/uploads/project/' . $data['project_image'] : 'assets/uploads/no_image.jpg' ?>
										<img src="<?= base_url() . $url; ?>" class="ms-4 mt-3 rounded" width="200" alt="Image preview">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="d-flex justify-content-center">
			<div class="mt-5 m-1">
				<button type="submit" class="btn btn-primary d-flex send-msg-btn waves-effect waves-light submit">
					<span class="align-middle">Submit</span>
				</button>
			</div>
			<div class="mt-5">
				<button type="reset" class="btn btn-danger d-flex send-msg-btn waves-effect waves-light resetBtn">
					<span class="align-middle">Reset</span>
				</button>
			</div>
		</div>
	</form>
</div>
<script>
	var worker = <?= json_encode(($worker) ?? '') ?>;
	var vendor = <?= json_encode(($vendor) ?? '') ?>;
	var customer = <?= json_encode(($customer) ?? '') ?>;
</script>
<div class="javascript">
	<script>
		selectAuto();
		function selectAuto() {
			if (worker) {
				var options = {
					format: "name-city_name",
					selected_id: $('#worker_id').val(),
					default: true,
				};
				var optionHTML = getOptions(worker, options);
				$('.getWorker').html(optionHTML);
			}
			if (vendor) {
				var options = {
					format: "name-city_name",
					selected_id: $('#vendor_id').val(),
					default: true,
				};
				var optionHTML = getOptions(vendor, options);
				$('.getVendor').html(optionHTML);
			}
			if (customer) {
				var options = {
					format: "name-city_name",
					selected_id: $('#customer_id').val(),
					default: true,
				};
				var optionHTML = getOptions(customer, options);
				$('.getCustomer').html(optionHTML);
			}
		}

		$(document).on('change', '#city', function() {
			getCustomer($(this).val());
			getVendor($(this).val());
			getWorker($(this).val());
		});
	</script>
</div>
