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
								<div class="col-md-4">
									<div class="form-floating form-floating-outline">
										<input type="text" id="name" name="name" value="<?= isset($data['name']) ? $data['name'] : '' ?>" required class="form-control required" placeholder="Enter Name" />
										<label for="name">Name</label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-floating form-floating-outline">
										<input type="text" id="title" name="title" value="<?= isset($data['title']) ? $data['title'] : '' ?>" class="form-control" placeholder="Enter Title" />
										<label for="title">Title</label>
									</div>
								</div>
								<!-- <div class="col-md-4">
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
								</div> -->
								<!-- <div class="col-md-4">
									<div class="form-floating form-floating-outline">
										<select id="worker" name="worker[]" class="select2 form-select getWorker required" multiple data-lable='Worker' required data-allow-clear="true">
											<option value="">Select Worker</option>
										</select>
										<label for="worker">Workers</label>
									</div>
								</div> -->
								<!-- <div class="col-md-4">
									<div class="form-floating form-floating-outline">
										<select id="vendor" name="vendor[]" class="select2 form-select getVendor required" multiple data-lable='Vendor' required data-allow-clear="true">
											<option value="">Select Vendor</option>
										</select>
										<label for="vendor">Vendor</label>
									</div>
								</div> -->
								<div class="col-md-4">
									<div class="form-floating form-floating-outline">
										<select id="customer" name="customer" class="select2 form-select required" data-lable='Customer' required data-allow-clear="true">
											<option value="">Select Customer</option>
											<?php if (!empty($customer)) {
												foreach ($customer as $value) { ?>
													<option value="<?= $value['id'] ?>" <?= isset($data['customer_id']) && $data['customer_id'] == $value['id'] ? "selected" : '' ?>><?= $value['name'] ?></option>
											<?php }
											} ?>

										</select>
										<label for="customer">Customer</label>
									</div>
								</div>
								<!-- <div class="col-md-4">
									<div class="form-floating form-floating-outline">
										<input type="number" name="price" id="price" value="<?= isset($data['price']) ? $data['price'] : '' ?>" required class="form-control phone-mask required  positiveNumber" placeholder="0.00" aria-label="0.00" />
										<label for="price">Price</label>
									</div>
								</div> -->
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
										<?php if (!empty($data['project_image'])) { ?>
											<img src="<?= isset($data['project_image']) ? base_url() . 'assets/uploads/project/'  . $data["project_image"] : ''; ?>" class="ms-4 mt-3 rounded" width="200" alt="Image preview">
										<?php } ?>

									</div>
								</div>
							</div>
						</div>
						<div class="row mt-4">
							<div class="col-md-12">
								<div class=" text-nowrap">
									<table class="table">
										<thead>
											<tr>
												<th>SR NO</th>
												<th>Job Type</th>
												<th>Worker</th>
												<th>Vendor</th>
												<th>Price</th>
												<th>Priority</th>
												<th>Actions</th>
											</tr>
										</thead>
										<tbody class="table-border-bottom-0 append-here appendHTML">
											<?php if (!empty($project_detail)) {
												foreach ($project_detail as $key => $project_detail) { ?>
													<tr class="copy_row gap-2">
														<input type="hidden" name="pd_id[]" value="<?= isset($project_detail['id']) ? $project_detail['id'] : '' ?>" class="form-control" />
														<td class="td-srno">
															<?= isset($project_detail) ? $key + 1 : '1' ?>
														</td>
														<td class="p-1">
															<div class="form-floating form-floating-outline">
																<select name="job_type[]" class="select2 form-select required" required data-lable="Job Type" data-allow-clear="true">
																	<option value="">Select Job Type</option>
																	<?php if (!empty($job_type)) {
																		foreach ($job_type as $key => $value) { ?>
																			<option value="<?= $value['id'] ?>" <?= isset($project_detail['job_type_id']) && $project_detail['job_type_id'] == $value['id'] ? "selected" : '' ?>><?= $value['name'] ?></option>
																		<?php } ?>
																	<?php } ?>
																</select>
																<label for="Job Type">Job Type</label>
															</div>
														</td>
														<td class="p-1">
															<div class="form-floating form-floating-outline">
																<select name="worker[]" class="select2 form-select required" data-lable="Worker" required data-allow-clear="true">
																	<option value="">Select Worker</option>
																	<?php if (!empty($worker)) {
																		foreach ($worker as $key => $value) { ?>
																			<option value="<?= $value['id'] ?>" <?= isset($project_detail['worker_id']) && $project_detail['worker_id'] == $value['id'] ? "selected" : '' ?>><?= $value['name'] ?></option>
																		<?php } ?>
																	<?php } ?>
																</select>
																<label for="worker">Worker</label>
															</div>
														</td>
														<td class="p-1">
															<div class="form-floating form-floating-outline">
																<select name="vendor[]" class="select2 form-select required" data-lable="Vendor" required data-allow-clear="true">
																	<option value="">Select Vendor</option>
																	<?php if (!empty($vendor)) {
																		foreach ($vendor as $key => $value) { ?>
																			<option value="<?= $value['id'] ?>" <?= isset($project_detail['vendor_id']) && $project_detail['vendor_id'] == $value['id'] ? "selected" : '' ?>><?= $value['name'] ?></option>
																		<?php } ?>
																	<?php } ?>
																</select>
																<label for="vendor">Vendor</label>
															</div>
														</td>
														<td class="p-1">
															<div class="form-floating form-floating-outline">
																<input type="number" name="price[]" class="form-control" value="<?= isset($project_detail['price']) ? $project_detail['price'] : '' ?>" required placeholder="0.00" aria-label="0.00" />
																<label for="price">Price</label>
															</div>
														</td>
														<td class="p-1">
															<div class="form-floating form-floating-outline">
																<input type="number" name="priority[]" class="form-control required priority" value="<?= isset($project_detail['priority']) ? $project_detail['priority'] : '' ?>" required placeholder="1" aria-label="0.00" />
																<label for="priority">Priority</label>
															</div>
														</td>
														<td>
															<div class="mb-3 col-lg-12 col-xl-2 col-12 d-flex align-items-center mb-0">
																<button type="button" class="btn btn-danger waves-effect mt-3 remove-row-btn">
																	<span class="align-middle">
																		<i class="mdi mdi-close "></i>
																	</span>
																</button>
															</div>
														</td>
													</tr>
												<?php }
											} else { ?>
												<tr class="copy_row gap-2">
													<td class="td-srno">
														1
													</td>
													<td class="p-1">
														<div class="form-floating form-floating-outline">
															<select name="job_type[]" class="select2 form-select required" required data-lable="Job Type" data-allow-clear="true">
																<option value="">Select Job Type</option>
																<?php if (!empty($job_type)) {
																	foreach ($job_type as $key => $value) { ?>
																		<option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
																	<?php } ?>
																<?php } ?>
															</select>
															<label for="Job Type">Job Type</label>
														</div>
													</td>
													<td class="p-1">
														<div class="form-floating form-floating-outline">
															<select name="worker[]" class="select2 form-select required" data-lable="Worker" required data-allow-clear="true">
																<option value="">Select Worker</option>
																<?php if (!empty($worker)) {
																	foreach ($worker as $key => $value) { ?>
																		<option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
																	<?php } ?>
																<?php } ?>
															</select>
															<label for="worker">Worker</label>
														</div>
													</td>
													<td class="p-1">
														<div class="form-floating form-floating-outline">
															<select name="vendor[]" class="select2 form-select required" data-lable="Vendor" required data-allow-clear="true">
																<option value="">Select Vendor</option>
																<?php if (!empty($vendor)) {
																	foreach ($vendor as $key => $value) { ?>
																		<option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
																	<?php } ?>
																<?php } ?>
															</select>
															<label for="vendor">Vendor</label>
														</div>
													</td>
													<td class="p-1">
														<div class="form-floating form-floating-outline">
															<input type="number" name="price[]" class="form-control amount" required min="0" oninput="validateAmount(this)" placeholder="0.00" aria-label="0.00" />
															<label for="price">Price</label>
														</div>
													</td>
													<td class="p-1">
														<div class="form-floating form-floating-outline">
															<input type="number" name="priority[]" class="form-control required priority" value="<?= isset($project_detail['priority']) ? $project_detail['priority'] : '' ?>" required placeholder="1" aria-label="0.00" />
															<label for="priority">Priority</label>
														</div>
													</td>
													<td>
														<div class="mb-3 col-lg-12 col-xl-2 col-12 d-flex align-items-center mb-0">
															<button type="button" class="btn btn-danger waves-effect mt-3 remove-row-btn">
																<span class="align-middle">
																	<i class="mdi mdi-close "></i>
																</span>
															</button>
														</div>
													</td>
												</tr>
											<?php } ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<button type="button" class="float-start btn btn-primary more-btn mt-3"> +
									Add More
								</button>
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
<script type="text/template" id="copyHTML">
	<tr class="copy_row gap-2">
		<td class="td-srno">
			1
		</td>
		<td class="p-1">
			<div class="form-floating form-floating-outline">
				<select name="job_type[]" class="select2 form-select required" required data-lable="Job Type" data-allow-clear="true">
					<option value="">Select Job Type</option>
					<?php if (!empty($job_type)) {
						foreach ($job_type as $key => $value) { ?>
							<option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
						<?php } ?>
					<?php } ?>
				</select>
				<label for="Job Type">Job Type</label>
			</div>
		</td>
		<td class="p-1">
			<div class="form-floating form-floating-outline">
				<select name="worker[]" class="select2 form-select required" required data-lable="Worker" data-allow-clear="true">
					<option value="">Select Worker</option>
					<?php if (!empty($worker)) {
						foreach ($worker as $key => $value) { ?>
							<option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
						<?php } ?>
					<?php } ?>
				</select>
				<label for="worker">Worker</label>
			</div>
		</td>
		<td class="p-1">
			<div class="form-floating form-floating-outline">
				<select name="vendor[]" class="select2 form-select required" required data-lable="Vendor" data-allow-clear="true">
					<option value="">Select Vendor</option>
					<?php if (!empty($vendor)) {
						foreach ($vendor as $key => $value) { ?>
							<option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
						<?php } ?>
					<?php } ?>
				</select>
				<label for="vendor">Vendor</label>
			</div>
		</td>
		<td class="p-1">
			<div class="form-floating form-floating-outline">
				<input type="number" name="price[]" class="form-control amount" min="0" oninput="validateAmount(this)" required placeholder="0.00" aria-label="0.00" />
				<label for="price">Price</label>
			</div>
		</td>
		<td class="p-1">
			<div class="form-floating form-floating-outline">
				<input type="number" name="priority[]" class="form-control required priority" value="<?= isset($project_detail['priority']) ? $project_detail['priority'] : '' ?>" required placeholder="1" aria-label="0.00" />
				<label for="priority">Priority</label>
			</div>
		</td>
		<td>
			<div class="mb-3 col-lg-12 col-xl-2 col-12 d-flex align-items-center mb-0">
				<button type="button" class="btn btn-danger waves-effect mt-3 remove-row-btn">
					<span class="align-middle">
						<i class="mdi mdi-close "></i>
					</span>
				</button>
			</div>
		</td>
	</tr>
</script>
<script>
	var worker = <?= json_encode(($worker) ?? '') ?>;
	var vendor = <?= json_encode(($vendor) ?? '') ?>;
	var customer = <?= json_encode(($customer) ?? '') ?>;
</script>
<div class="javascript">
	<script>
		$(document).ready(function() {
			$('.amount').on('input', function() {
				var value = $(this).val();
				if (value < 0 || value.includes('-')) {
					$(this).val(value.replace('-', ''));
				}
			});

			$(document).on("click", ".more-btn", function() {
				var row = $("#copyHTML").html();
				AppendBox = $('.appendHTML');
				AppendBox.append(row);
				AppendBox.children().last().find('.select2').each(function() {
					$(this).val(null).trigger('change.select2').select2();
				});
				setSrNo(AppendBox);
			});
			$(document).on("click", ".remove-row-btn", function(e) {
				let mainRowLength = $(".copy_row").length;
				var RemoveBtn = $(this);
				if (mainRowLength > 1) {
					Swal.fire({
						title: "Are you sure to delete?",
						text: "You won't be able to revert this!",
						icon: "warning",
						showCancelButton: true,
						confirmButtonText: "Yes, delete!",
						customClass: {
							confirmButton: "btn btn-primary me-3 waves-effect waves-light",
							cancelButton: "btn btn-outline-secondary waves-effect",
						},
						buttonsStyling: false,
					}).then(function(result) {
						if (result.value) {
							RemoveBtn.parents(".copy_row").fadeOut(() => {
								RemoveBtn.parents(".copy_row").remove();
							});
						}
					});
				}
			});

			$(document).on("keyup", ".priority", function() {
				var priorities = [];
				var isDuplicate = false;

				$('.priority').each(function() {
					var priorityValue = $(this).val();

					if ($.inArray(priorityValue, priorities) !== -1) {
						isDuplicate = true;
						return false;
					}

					if (priorityValue !== '') {
						priorities.push(priorityValue);
					}
				});

				if (isDuplicate) {
					$(this).val('');
					SweetAlert('error', 'Priority already exists for this project');
				}
			});

			// $('.priority').on('keyup', function() {
			// 	if ($('#id').val() != "") {
			// 		var project_id = $('#id').val(); // Assuming you have a project ID field
			// 		var priority = $(this).val();
			// 		console.log(priority);
			// 		$.ajax({
			// 			url: '<?php echo site_url('admin/project/check_priority'); ?>',
			// 			type: 'POST',
			// 			dataType: 'json',
			// 			data: {
			// 				project_id: project_id,
			// 				priority: priority
			// 			},
			// 			success: function(response) {
			// 				if (response.success == true) {
			// 					SweetAlert('error', response.message);
			// 				}
			// 			},
			// 			error: function() {
			// 				SweetAlert('error', 'Error checking priority.');
			// 			}
			// 		});
			// 	}
			// });
		});
	</script>
</div>
