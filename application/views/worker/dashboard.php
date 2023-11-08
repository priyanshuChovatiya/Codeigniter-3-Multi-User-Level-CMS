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
								<th>Project Status</th>
							</tr>
						</thead>
						<tbody>
							<?php if (!empty($project_data)) {
								foreach ($project_data as $key => $value) { ?>
									<tr>
										<td><?= $value['name']; ?></td>
										<td><a href="<?= base_url('worker/project/view_detail/'.$value['id']) ?>"><button type="button" class="btn btn-sm btn-danger rounded-pill btn-icon viewImage ms-1"><i class="mdi mdi-information-variant"></i></button></a></td>
										<td>
											<?php if ($value['project_status'] == "PENDING") { ?>
												<div class="badge bg-label-warning rounded-pill lh-xs"><?= isset($value['project_status']) ? $value['project_status'] : '' ?></div>
											<?php } elseif ($value['project_status'] == "INPROCESS") { ?>
												<div class="badge bg-label-primary rounded-pill lh-xs"><?= isset($value['project_status']) ? $value['project_status'] : '' ?></div>
											<?php } ?>
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
