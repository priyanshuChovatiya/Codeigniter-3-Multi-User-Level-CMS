<div class="container-xxl flex-grow-1 container-p-y pt-0">
	<h4 class="py-3 mb-4"><span class="text-muted fw-light"></span>
		<?= ucfirst($page_title) ?>
	</h4>
	<div class="row mb-5">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-datatable table-responsive pt-0 m-2">
					<table class="table" id="ProjectTable">
						<thead>
							<tr>
								<th>Name</th>
								<th>Action</th>
								<th>Title</th>
								<th>Project Status</th>
								<th>City</th>
								<th>Start Date</th>
								<th>End Date</th>
							</tr>
						</thead>
						<tbody>
							<?php if (!empty($project_data)) {
								foreach ($project_data as $key => $value) { ?>
									<tr>
										<td><?= $value['name']; ?></td>
										<td><a href="<?= base_url('worker/project/view_detail/'.$value['id']) ?>"><button type="button" class="btn btn-sm btn-danger rounded-pill btn-icon viewImage ms-1"><i class="mdi mdi-information-variant"></i></button></a></td>
										<td><?= $value['title']; ?></td>
										<td>
											<?php if ($value['project_status'] == "PENDING") { ?>
												<div class="badge bg-label-warning rounded-pill lh-xs"><?= isset($value['project_status']) ? $value['project_status'] : '' ?></div>
											<?php } elseif ($value['project_status'] == "INPROCESS") { ?>
												<div class="badge bg-label-primary rounded-pill lh-xs"><?= isset($value['project_status']) ? $value['project_status'] : '' ?></div>
											<?php } ?>
										</td>
										<td><?= $value['city_name']; ?></td>
										<td><?= $value['start_date']; ?></td>
										<td><?= $value['end_date']; ?></td>
									</tr>
							<?php }
							} ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<div class="row mb-5">
		<?php if (!empty($project_data)) {
			foreach ($project_data as $key => $value) { ?>
				<div class="col-lg-3 col-sm-6">
					<div class="card h-100">
						<div class="row">
							<div class="col-6">
								<div class="card-body">
									<div class="card-info mb-3 py-2 mb-lg-1 mb-xl-3">
										<h5 class="mb-3 mb-lg-2 mb-xl-3 text-nowrap"><?= isset($value['name']) ? $value['name'] : '' ?></h5>
										<?php if (!empty($value['project_status']) && $value['project_status'] == "PENDING") { ?>
											<div class="badge bg-label-warning rounded-pill lh-xs"><?= isset($value['project_status']) ? $value['project_status'] : '' ?></div>
										<?php } elseif (!empty($value['project_status']) && $value['project_status'] == "INPROCESS") { ?>
											<div class="badge bg-label-primary rounded-pill lh-xs"><?= isset($value['project_status']) ? $value['project_status'] : '' ?></div>
										<?php } ?>
									</div>
									<div class="d-flex align-items-end flex-wrap gap-1 ms-5">
										<!-- <div class="badge bg-label-danger ms-5 rounded-pill lh-xs">View</div> -->
										<a href="<?= base_url('worker/project/view_detail') ?>"><button type="button" class="btn btn-sm btn-danger ms-5 rounded-pill btn-icon viewImage ms-1"><i class="mdi mdi-information-variant"></i></button></a>
									</div>
								</div>
							</div>
							<div class="col-6 text-end d-flex align-items-end justify-content-center">
								<div class="card-body pb-0 pt-3 position-absolute bottom-0">
									<img src="<?= base_url() ?>assets/img/illustrations/card-ratings-illustration.png" alt="Ratings" width="95" />
								</div>
							</div>
						</div>
					</div>
				</div>
		<?php }
		} ?>
	</div>
</div>
