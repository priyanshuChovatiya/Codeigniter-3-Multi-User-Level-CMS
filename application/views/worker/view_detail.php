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
					<span><?= $data['title']; ?></span>
					<div class="d-flex align-items-center justify-content-center my-4 gap-2">
						<a href="javascript:;" class="me-1"><span class="badge bg-label-secondary rounded-pill"><?= $data['start_date']; ?></span></a>
						<a href="javascript:;"><span class="badge bg-label-warning rounded-pill"><?= $data['end_date']; ?></span></a>
					</div>

					<div class="d-flex align-items-center justify-content-around mb-4">
						<div>
							<h4 class="mb-1">18</h4>
							<span>Projects</span>
						</div>
						<div>
							<h4 class="mb-1">834</h4>
							<span>Tasks</span>
						</div>
						<div>
							<h4 class="mb-1">129</h4>
							<span>Connections</span>
						</div>
					</div>
					<div class="d-flex align-items-center justify-content-center">
						<a href="javascript:;" class="btn btn-primary d-flex align-items-center me-3 waves-effect waves-light"><i class="mdi mdi-account-check-outline me-1"></i>Connected</a>
						<a href="javascript:;" class="btn btn-outline-secondary btn-icon waves-effect"><i class="mdi mdi-email-outline lh-sm"></i></a>
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
								<!-- <button type="button" class="btn btn-icon rounded-pill btn-label-google-plus waves-effect"> -->
								Daily <br> Activity
								<!-- <i class="mdi mdi-google mdi-20px"></i> -->
								<!-- </button> -->
							</div>
						</li>
						<li class="nav-item" role="presentation">
							<div class="nav-link btn d-flex flex-column align-items-center justify-content-center" role="tab" data-bs-toggle="tab" data-bs-target="#navs-sales-id" aria-controls="navs-sales-id" aria-selected="false" tabindex="-1">
								<!-- <button type="button" class="btn btn-icon rounded-pill btn-label-facebook waves-effect">
                              <i class="mdi mdi-facebook mdi-20px"></i>
                            </button> -->
								Material
							</div>
						</li>
						<li class="nav-item" role="presentation">
							<div class="nav-link btn d-flex flex-column align-items-center justify-content-center" role="tab" data-bs-toggle="tab" data-bs-target="#navs-profit-id" aria-controls="navs-profit-id" aria-selected="true">
								<!-- <button type="button" class="btn btn-icon rounded-pill btn-label-instagram waves-effect">
                              <i class="mdi mdi-instagram mdi-20px"></i>
                            </button> -->
								Worker
							</div>
						</li>
						<li class="nav-item" role="presentation">
							<div class="nav-link btn d-flex flex-column align-items-center justify-content-center" role="tab" data-bs-toggle="tab" data-bs-target="#navs-income-id" aria-controls="navs-income-id" aria-selected="false" tabindex="-1">
								<!-- <button type="button" class="btn btn-icon rounded-pill btn-label-twitter waves-effect">
                              <i class="mdi mdi-twitter mdi-20px"></i>
                            </button> -->
								Vendor
							</div>
						</li>
						<span class="tab-slider" style="left: 272px; width: 112px; bottom: 0px;"></span>
					</ul>
					<div class="tab-content p-0 ms-0 ms-sm-2">
						<div class="tab-pane fade active show" id="navs-orders-id" role="tabpanel">
							<div class="table-responsive text-nowrap">
								<table class="table table-borderless">
									<thead class="border-bottom">
										<tr>
											<th class="fw-medium ps-0 text-heading">Parameter</th>
											<th class="pe-0 fw-medium text-heading">Status</th>
											<th class="pe-0 fw-medium text-heading">Conversion</th>
											<th class="pe-0 text-end text-heading">total revenue</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td class="h6 ps-0">Email Marketing Campaign</td>
											<td class="pe-0"><span class="badge rounded-pill bg-label-primary">Active</span></td>
											<td class="pe-0 text-success">+24%</td>
											<td class="pe-0 text-end h6">$42,857</td>
										</tr>
										<tr>
											<td class="h6 ps-0">Google Workspace</td>
											<td class="pe-0">
												<span class="badge rounded-pill bg-label-warning">Completed</span>
											</td>
											<td class="text-danger pe-0">-12%</td>
											<td class="pe-0 text-end h6">$850</td>
										</tr>
										<tr>
											<td class="h6 ps-0">Affiliation Program</td>
											<td class="pe-0"><span class="badge rounded-pill bg-label-primary">Active</span></td>
											<td class="text-success pe-0">+24%</td>
											<td class="pe-0 text-end h6">$5,576</td>
										</tr>
										<tr>
											<td class="h6 ps-0">Google Adsense</td>
											<td class="pe-0"><span class="badge rounded-pill bg-label-info">In Draft</span></td>
											<td class="text-success pe-0">0%</td>
											<td class="pe-0 text-end h6">$0</td>
										</tr>
									</tbody>
								</table>
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
													<td class="h6 ps-0"><?= $worker[$i]['worker_name'] ?></td>
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
													<td class="pe-0 text-primary"><?= $worker[$i]['worker_mobile'] ?></td>
													<td class="pe-0 h6"><?= $worker[$i]['worker_email'] ?></td>
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
													<td class="h6 ps-0"><?= $worker[$i]['vendor_name'] ?></td>
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
													<td class="pe-0 text-primary"><?= $worker[$i]['vendor_mobile'] ?></td>
													<td class="pe-0 h6"><?= $worker[$i]['vendor_email'] ?></td>
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

		<!-- <div class="col-lg-12 mb-3">
			<div class="card">
				<div class="card-body">
					<div class="row">
						<h5 class="mb-1 ">Name : <?= $data['name']; ?></h5>
						<div class="row g-4 mt-3">
							<div class="row">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div> -->
	</div>
	<!-- / Content -->
	<div class="javascript">
		<script>
			$(document).ready(function() {});
		</script>
	</div>
