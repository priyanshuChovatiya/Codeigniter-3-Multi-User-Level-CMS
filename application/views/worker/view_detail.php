<div class="container-xxl flex-grow-1 container-p-y pt-0">
	<h4 class="py-2 mb-2"><span class="text-muted fw-light">Project / </span> Report </h4>
	<div class="row mb-3 justify-content-center">
		<div class="col-xl-4 col-lg-6 col-md-6 mt-2">
			<div class="card ">
				<div class="card-body text-center">
					<div class="mx-auto mb-4">
						<img src="<?= base_url('assets/uploads/project/' . $data['project_image']); ?>" alt="Avatar Image" class="rounded" width="200">
					</div>
					<h4 class="mb-1 card-title"><?= $data['name']; ?></h4>
					<span><?= isset($data['title']) ? $data['title'] : ""; ?></span>
					<div class="d-flex align-items-center justify-content-center my-4 gap-2">
						<a href="javascript:;" class="me-1"><span class="badge bg-label-secondary rounded-pill"><?= $data['start_date']; ?></span></a>
						<a href="javascript:;"><span class="badge bg-label-warning rounded-pill"><?= $data['end_date']; ?></span></a>
					</div>
				</div>
			</div>
		</div>

		<div class="col-12 col-xl-8 mt-2">
			<div class="card h-100">
				<div class="card-body pb-3">
					<ul class="nav nav-tabs nav-tabs-widget pb-3 gap-4 mx-1 d-flex flex-nowrap" role="tablist">
						<li class="nav-item" role="presentation">
							<div class="nav-link btn d-flex flex-column align-items-center justify-content-center active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-orders-id" aria-controls="navs-orders-id" aria-selected="false" tabindex="-1">
								Daily <br> Activity
							</div>
						</li>
						<li class="nav-item" role="presentation">
							<div class="nav-link btn d-flex flex-column align-items-center justify-content-center" role="tab" data-bs-toggle="tab" data-bs-target="#navs-profit-id" aria-controls="navs-profit-id" aria-selected="true">
								Worker
							</div>
						</li>
						<li class="nav-item" role="presentation">
							<div class="nav-link btn d-flex flex-column align-items-center justify-content-center" role="tab" data-bs-toggle="tab" data-bs-target="#navs-sales-id" aria-controls="navs-sales-id" aria-selected="false" tabindex="-1">
								Material
							</div>
						</li>
						<li class="nav-item" role="presentation">
							<div class="nav-link btn d-flex flex-column align-items-center justify-content-center" role="tab" data-bs-toggle="tab" data-bs-target="#navs-income-id" aria-controls="navs-income-id" aria-selected="false" tabindex="-1">
								Vendor
							</div>
						</li>
						<span class="tab-slider" style="left: 272px; width: 112px; bottom: 0px;"></span>
					</ul>
					<div class="tab-content p-0 ms-0 ms-sm-2">
						<div class="tab-pane fade active show" id="navs-orders-id" role="tabpanel">
							<div class="text-nowrap">
								<form action="<?= base_url('worker/project/daily_work/' . $project_id); ?>" id="permissionForm" class="browser-default-validation needs-validation mt-3" novalidate method="post" enctype="multipart/form-data">
									<div class="modal-body pb-0" id="Modelbody">
										<div class="row">
											<div class="col-md-4 mt-2 mb-3">
												<div class="form-floating form-floating-outline">
													<input type="file" id="work_image" multiple name="work_image[]" class="form-control file required" />
													<label for="work_image">Project Image</label>
												</div>
												<p class="pb-1 mb-1"> Select Please Multiple Image</p>
											</div>
											<div class="col-md-3 mt-2 mb-3">
												<div class="form-floating form-floating-outline">
													<select id="work_complate" name="work_complate" class="select2 form-select required" required data-lable='Work Complated' data-allow-clear="true">
														<option value="">Select Work Complated</option>
														<option value="10">10 %</option>
														<option value="20">20 %</option>
														<option value="30">30 %</option>
														<option value="40">40 %</option>
														<option value="50">50 %</option>
														<option value="60">60 %</option>
														<option value="70">70 %</option>
														<option value="80">80 %</option>
														<option value="90">90 %</option>
														<option value="100">100 %</option>
													</select>
													<label for="work_complate">Work Complated</label>
												</div>
											</div>
											<div class="col-md-3 mt-2 mb-3">
												<div class="form-floating form-floating-outline">
													<input type="text" id="remark" name="remark" class="form-control" />
													<label for="remark">Remark</label>
												</div>
											</div>
											<input type="hidden" id="id" name="id" class="form-control" />
											<input type="hidden" id="status" name="status" class="form-control" />
											<div class="col-md-2 mt-2">
												<button type="submit" class="btn btn-primary">Submit</button>
											</div>
											<div class="col-md-12 mb-2">
												<div class="show_image row">
												</div>
											</div>
											<div class="col-md-3 mb-2 text-center">
												<span class="badge rounded-pill bg-label-primary viewImage" data-id="<?= $project_id; ?>">View Activity</span>
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
						<div class="tab-pane fade" id="navs-sales-id" role="tabpanel">
							<div class="table-responsive text-nowrap">
								<table class="table table-borderless">
									<thead class="border-bottom">
										<tr>
											<th class="fw-medium ps-0 text-heading">parameter</th>
											<th class="pe-0 fw-medium text-heading">Status</th>
											<th class="pe-0 fw-medium text-heading">Conversion</th>
											<th class="pe-0 text-end text-heading">total revenue</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td class="h6 ps-0">Create Audiences in Ads Manager</td>
											<td class="pe-0"><span class="badge rounded-pill bg-label-primary">Active</span></td>
											<td class="pe-0 text-danger">-8%</td>
											<td class="pe-0 text-end h6">$322</td>
										</tr>
										<tr>
											<td class="h6 ps-0">Facebook page advertising</td>
											<td class="pe-0"><span class="badge rounded-pill bg-label-primary">Active</span></td>
											<td class="text-success pe-0">+19%</td>
											<td class="pe-0 text-end h6">$5,634</td>
										</tr>
										<tr>
											<td class="h6 ps-0">Messenger advertising</td>
											<td class="pe-0"><span class="badge rounded-pill bg-label-danger">Expired</span></td>
											<td class="text-danger pe-0">-23%</td>
											<td class="pe-0 text-end h6">$751</td>
										</tr>
										<tr>
											<td class="h6 ps-0">Video campaign</td>
											<td class="pe-0">
												<span class="badge rounded-pill bg-label-warning">Completed</span>
											</td>
											<td class="text-success pe-0">+21%</td>
											<td class="pe-0 text-end h6">$3,585</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
						<div class="tab-pane fade" id="navs-profit-id" role="tabpanel">
							<div class="table-responsive text-nowrap">
								<table class="table table-borderless">
									<thead class="border-bottom">
										<tr>
											<!-- <th class="fw-medium ps-0 text-heading">Profile</th> -->
											<th class="fw-medium ps-0 text-heading">Name</th>
											<th class="pe-0 fw-medium text-heading">Status</th>
											<th class="pe-0 text-heading">Email</th>
										</tr>
									</thead>
									<tbody>
										<?php if (!empty($worker)) {
											for ($i = 0; $i < count($worker); $i++) { ?>
												<tr>
													<!-- <td> -->
														<!-- <?php if (!empty($worker[$i]['worker_profile'])) {
															$profile = explode(',', $worker[$i]['worker_profile']);
															for ($a = 0; $a < count($profile); $a++) { ?>
																<a href="<?= base_url('assets/uploads/profile/') . trim($profile[$a]); ?>" target="_blank" rel="noopener noreferrer"><img src="<?= base_url('assets/uploads/profile/') . trim($profile[$a]); ?>" class="rounded m-1" width="100" alt="Image preview"></a><br>
														<?php }
														} ?> -->
													<!-- </td> -->
													<td class="h6 ps-0">
														<?php if (!empty($worker[$i]['worker_name'])) {
															$worker_name = explode(',', $worker[$i]['worker_name']);
															$worker_mobile = explode(',', $worker[$i]['worker_mobile']);
															$worker_id = explode(',', $worker[$i]['worker_id']);
															for ($j = 0; $j < count($worker_name); $j++) { ?>
																<?= isset($worker_name[$j]) ? $worker_name[$j] : '' ?> ( <?= $worker[$i]['job_name'] ?> ) ( <?= !empty($worker_mobile[$j]) ? $worker_mobile[$j] : ' ' ?> ) 
																<button type="button" class="btn btn-sm btn-primary ms-3 rounded-pill btn-icon viewImage ms-1" data-user_id="<?=$worker_id[$j];?>" data-project_id="<?= $project_id; ?>"><i class="mdi mdi-eye"></i></button><br>
														<?php }
														} ?>
													</td>

													<td>
														<?php
														if ($worker[$i]['worker_status'] == "PENDING") { ?>
															<span class="badge rounded-pill bg-label-warning">Pending</span>
														<?php } elseif ($worker[$i]['worker_status'] == "INPROCESS") { ?>
															<span class="badge rounded-pill bg-label-primary">In Process</span>
														<?php } elseif ($worker[$i]['worker_status'] == "COMPLATED") { ?>
															<span class="badge rounded-pill bg-label-success">Complated</span>
														<?php } ?>
													</td>
													<td class="pe-0 h6">
														<?php if (!empty($worker[$i]['worker_email'])) {
															$worker_email = explode(',', $worker[$i]['worker_email']);
															for ($k = 0; $k < count($worker_email); $k++) { ?>
																<?= $worker_email[$k] ?> <br>
														<?php }
														} ?>
													</td>
												</tr>
										<?php }
										} ?>
									</tbody>
								</table>
							</div>
						</div>
						<div class="tab-pane fade" id="navs-income-id" role="tabpanel">
							<div class="table-responsive text-nowrap">
								<table class="table table-borderless">
									<thead class="border-bottom">
										<tr>
											<th class="fw-medium ps-0 text-heading">Name</th>
											<th class="pe-0 fw-medium text-heading">Status</th>
											<th class="pe-0 fw-medium text-heading">Mobile</th>
											<th class="pe-0 text-heading">Email</th>
										</tr>
									</thead>
									<tbody>
										<?php if (!empty($worker)) {
											for ($i = 0; $i < count($worker); $i++) { ?>
												<tr>
													<td class="h6 ps-0">
														<?php if (!empty($worker[$i]['vendor_name'])) {
															$vendor_name = explode(',', $worker[$i]['vendor_name']);
															for ($k = 0; $k < count($vendor_name); $k++) { ?>
																<?= $vendor_name[$k] ?> <br>
														<?php }
														} ?>
													</td>
													<td>
														<?php
														if ($worker[$i]['vendor_status'] == "PENDING") { ?>
															<span class="badge rounded-pill bg-label-warning">Pending</span>
														<?php } elseif ($worker[$i]['vendor_status'] == "INPROCESS") { ?>
															<span class="badge rounded-pill bg-label-primary">In Process</span>
														<?php } elseif ($worker[$i]['vendor_status'] == "COMPLATED") { ?>
															<span class="badge rounded-pill bg-label-success">Complated</span>
														<?php } ?>
													</td>
													<td class="pe-0 text-primary">
														<?php if (!empty($worker[$i]['vendor_mobile'])) {
															$vendor_mobile = explode(',', $worker[$i]['vendor_mobile']);
															for ($k = 0; $k < count($vendor_mobile); $k++) { ?>
																<?= $vendor_mobile[$k] ?> <br>
														<?php }
														} ?>
													</td>
													<td class="pe-0 h6">
														<?php if (!empty($worker[$i]['vendor_email'])) {
															$vendor_email = explode(',', $worker[$i]['vendor_email']);
															for ($k = 0; $k < count($vendor_email); $k++) { ?>
																<?= $vendor_email[$k] ?> <br>
														<?php }
														} ?>
													</td>
												</tr>
										<?php }
										} ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="viewImageModel" tabindex="-1" aria-hidden="true">
		<div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="exampleModalLabel1">Daily Activity</h4>
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
				// $(document).on('click', '.viewImage', function() {
				// 	var activity_id = $(this).data('id');
				// 	$('#viewImageModelBody').html("");
				// 	$.ajax({
				// 		url: "<?= site_url() . 'worker/project/viewActivity'; ?>",
				// 		type: 'post',
				// 		showLoader: true,
				// 		data: {
				// 			activity_id: activity_id,
				// 		},
				// 		success: function(res) {
				// 			$('#viewImageModelBody').html(res);
				// 			$("#viewImageModel").modal('show');
				// 		}
				// 	});
				// });
				$(document).on('click', '.viewImage', function() {
					var user_id = $(this).data('user_id');
					var project_id = $(this).data('project_id');
					$('#viewImageModelBody').html("");
					$.ajax({
						url: "<?= site_url() . 'worker/project/presonalImage'; ?>",
						type: 'post',
						showLoader: true,
						data: {
							user_id: user_id,
							project_id: project_id,
						},
						success: function(res) {
							$('#viewImageModelBody').html(res);
							$("#viewImageModel").modal('show');
						}
					});
				});
			});
		</script>
	</div>
