<div class="row">
	<?php if (!empty($INPROCESS)) { ?>
		<div class="m-2 text-center">
			<h5 class="modal-title text-center"><i class="mdi mdi-arrow-right"></i> In Process Side Images</h5>
		</div>
		<?php foreach ($INPROCESS as $value) { ?>
			<div class="col-md-4">
				<a href="<?= isset($value['name']) ? base_url() . 'assets/uploads/work_image/' . $value['name'] : '' ?>" target="_blank" rel="noopener noreferrer"><img src="<?= isset($value['name']) ? base_url() . 'assets/uploads/work_image/' . $value['name'] : '' ?>" class="ms-4 mt-3 rounded" width="200" alt="Image preview"></a>
			</div>
	<?php }
	}else{ ?>
		<div class="m-2 text-center">
			<h5 class="modal-title text-center">No Images</h5>
		</div>

	<?php } ?>

	<?php if (!empty($COMPLATED)) { ?>
		<div class="m-2 text-center">
			<h5 class="modal-title text-center"><i class="mdi mdi-arrow-right"></i> Complated Side Images</h5>
		</div>
		<?php foreach ($COMPLATED as $value) { ?>
			<div class="col-md-4">
				<a href="<?= isset($value['name']) ? base_url() . 'assets/uploads/work_image/' . $value['name'] : '' ?>" target="_blank" rel="noopener noreferrer"><img src="<?= isset($value['name']) ? base_url() . 'assets/uploads/work_image/' . $value['name'] : '' ?>" class="ms-4 mt-3 rounded" width="200" alt="Image preview"></a>
			</div>
	<?php }
	} ?>
</div>
