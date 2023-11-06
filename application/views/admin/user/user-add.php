<div class="container-xxl flex-grow-1 container-p-y pt-0">
	<h4 class="py-2 mb-2"><span class="text-muted fw-light">User / </span> <?=isset($data) ? 'Edit' : 'Add' ?> </h4>
	<!-- Sticky Actions -->
	<form action="<?=!isset($data) ? base_url('admin/user/add') : base_url('admin/user/update') ?>" class="browser-default-validation mb-3 needs-validation" novalidate id="userForm" method="post" enctype="multipart/form-data">
		<div class="row">
			<div class="col-lg-12 mb-2">
				<div class="card">
					<div class="card-body">
						<div class="row">
							<h5 class="text-primary">Person Details</h5>
							<div class="row g-4">
								<div class="col-md-4">
									<div class="form-floating form-floating-outline">
										<input type="text" id="name" name="name" value="<?= isset($data['name']) ? $data['name'] : '' ?>" required class="form-control required" placeholder="Enter Name" />
										<label for="name">Name</label>
									</div>
									<input type="hidden" id="id" name="id" value="<?= isset($id) ? $id : '' ?>" class="form-control"/>
								</div>
								<div class="col-md-4">
									<div class="form-floating form-floating-outline">
										<input type="email" id="email" name="email" value="<?= isset($data['email']) ? $data['email'] : '' ?>" required class="form-control required" placeholder="example@gmail.com" />
										<label for="email">Email</label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-floating form-floating-outline">
										<input type="text" name="mobile" id="mobile" value="<?= isset($data['mobile']) ? $data['mobile'] : '' ?>" required maxlength="10" minlength="10" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..?)\../g, '$1');" class="form-control phone-mask required  mobileCheck" placeholder="658 799 8941" aria-label="658 799 8941" />
										<label for="mobile">Mobile</label>
									</div>
								</div>
								<?php if(empty($data)) { ?>
									<div class="col-md-4">
										<div class="form-floating form-floating-outline">
											<input type="password" id="password" name="password" <?=isset($data) ? 'disabled' : '' ?> required class="form-control required" placeholder="*****" />
											<label for="password">Password</label>
										</div>
									</div>
								<?php } ?>
								<div class="col-md-4">
									<div class="form-floating form-floating-outline">
										<select id="user_type" name="user_type" class="select2 form-select required" data-lable='User Type' required data-allow-clear="true">
											<option value="">Select User Type</option>
											<option value="CUSTOMER" <?= isset($data['type']) && $data['type'] == "CUSTOMER" ? "selected" : '' ?>>CUSTOMER</option>
											<option value="VENDOR" <?= isset($data['type']) && $data['type'] == "VENDOR" ? "selected" : '' ?>>VENDOR</option>
											<option value="WORKER" <?= isset($data['type']) && $data['type'] == "WORKER" ? "selected" : '' ?>>WORKER</option>
										</select>
										<label for="User Type">User Type</label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-floating form-floating-outline">
										<select id="city" name="city" class="select2 form-select required" data-lable='City' required data-allow-clear="true">
											<option value="">Select City</option>
											<?php if(!empty($city)){ ?>
												<?php foreach ($city as $key => $value) {?>
                                                    <option value="<?= $value['id']?>" <?= isset($data['city_id']) && $data['city_id'] == $value['id']? "selected" : ''?>><?= $value['name']?></option>
                                                <?php }?>
                                            <?php }?>
										</select>
										<label for="City">City</label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-floating form-floating-outline">
										<select id="job_type" name="job_type" class="select2 form-select required" data-lable='Job Type' required data-allow-clear="true">
											<option value="">Select Job Type</option>
											<?php if(!empty($job_type)){ ?>
												<?php foreach ($job_type as $key => $value) {?>
                                                    <option value="<?= $value['id']?>" <?= isset($data['job_type_id']) && $data['city_id'] == $value['id']? "selected" : ''?>><?= $value['name']?></option>
                                                <?php }?>
                                            <?php }?>
										</select>
										<label for="Job Type">Job Type</label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-floating form-floating-outline">
										<input type="file" id="profile" name="profile" <?=!isset($data) ? 'required' : '' ?> class="form-control file <?=!isset($data) ? 'required' : '' ?>" />
										<label for="profile">Profile Image</label>
									</div>
									<div class="show_image">
										<?php $url = isset($data['profile']) ? 'assets/uploads/profile/' . $data['profile'] : 'assets/uploads/no_image.jpg' ?>
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
