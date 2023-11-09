<div class="row">
	<table class="table">
		<tr>
			<td>Image</td>
			<td>Complated Work</td>
			<td>Remark</td>
		</tr>
		<?php if (!empty($data)) { ?>
			<?php foreach ($data as $key => $value) { ?>
				<tr>
					<td calss="row">
						<a href="<?= base_url('assets/uploads/daily_activity/') . $value['name']; ?>" target="_blank" rel="noopener noreferrer"><img class="d-block rounded" width="100;" src="<?= base_url('assets/uploads/daily_activity/') . $value['name']; ?>" /></a>
					</td>
					<td><?php if (!empty($value['work_complate'])) {
							echo $value['work_complate'];
						} ?></td>
					<td><?php if (!empty($value['remark'])) {
							echo $value['remark'];
						} ?></td>
				</tr>
		<?php }
		} ?>
	</table>
</div>
