<div class="container-xl">
	<div class="page-header d-print-none">
		<div class="row align-items-center">
			<div class="col">
				<h2 class="page-title py-3">
                    <?= $this->base->text('view_ssl', 'title') ?> (<?php echo $data['type']; ?>)
				</h2>
			</div>
			<div class="col-auto ms-auto d-print-none">
				<?php if ($data['status'] == 'cancelled' OR $data['status'] == 'expired'): ?>
                    <a class="btn btn-danger" href="?delete=true"><?= $this->base->text('delete', 'button') ?></a>
				<?php elseif ($data['type'] != 'GoGetSSL'): ?>
					<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#deleteModal">
					    <?= $this->base->text('delete', 'button') ?>
					</button>
									
					<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
					    <div class="modal-dialog" role="document">
					        <div class="modal-content">
					            <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel"><?= $this->base->text('delete', 'button') ?></h5>
					                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					            </div>
					            <div class="modal-body">
                        <?= $this->base->text('delete_msg', 'paragraph') ?>
					            </div>
					            <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?= $this->base->text('close', 'button') ?></button>
                        <a class="btn btn-danger" href="?delete=true"><?= $this->base->text('delete', 'button') ?></a>
					            </div>
					        </div>
					    </div>
					</div>
				<?php elseif ($data['status'] !== 'cancelled' OR $data['status'] !== 'expired'): ?>
                    <a class="btn btn-danger" href="?cancel=true"><?= $this->base->text('cancel', 'button') ?></a>
				<?php endif ?>
			</div>
		</div>
	</div>
	<div class="card mb-3">
		<div class="card-header">
            <div class="card-title"><?= $this->base->text('information', 'heading') ?></div>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col-sm-6">
					<div class="row align-items-center">
                        <span class="col"><?= $this->base->text('domain', 'table') ?>:</span>
						<span class="col-auto ms-auto"><?= $data['domain'] ?></span>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="row align-items-center">
                        <span class="col"><?= $this->base->text('status', 'table') ?>:</span>
						<span class="col-auto ms-auto">
							<?php if ($data['status'] == 'processing' || $data['status'] == 'pending'): ?>
								<span class="badge bg-yellow">
									<?= $data['status'] ?>
								</span>
							<?php elseif ($data['status'] == 'active' || $data['status'] == 'ready'): ?>
								<span class="badge bg-green">
									<?= $data['status'] ?>
								</span>
							<?php elseif ($data['status'] == 'cancelled' OR $data['status'] == 'expired'): ?>
								<span class="badge bg-danger">
									<?= $data['status'] ?>
								</span>
							<?php endif ?>
						</span>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="row align-items-center">
                        <span class="col"><?= $this->base->text('start_date', 'table') ?>:</span>
						<span class="col-auto ms-auto"><?= $data['begin_date'] ?? '-- -- ----' ?></span>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="row align-items-center">
                        <span class="col"><?= $this->base->text('end_date', 'table') ?>:</span>
						<span class="col-auto ms-auto"><?= $data['end_date'] ?? '-- -- ----' ?></span>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="card mb-3">
		<?php if ($data['status'] == 'pending' || $data['status'] == 'ready' || ($data['status'] == 'processing' && $data['type'] == 'GoGetSSL')): ?>
			<?php $record = explode(' ', $data['approver_method']['dns']['record']) ?>
			<div class="card-header">
                <div class="card-title"><?= $this->base->text('verify_ownership', 'heading') ?></div>
			</div>
			<div class="card-body">
				<div class="mb-3">
                    <label class="form-label"><?= $this->base->text('csr_code', 'label') ?></label>
					<textarea class="form-control" style="min-height: 200px;" readonly="true"><?= $data['csr_code'] ?></textarea>
				</div>
				<div class="mb-3">
                    <label class="form-label"><?= $this->base->text('record_name', 'label') ?></label>
					<input type="text" class="form-control" value="<?= trim($record[0]) ?>" readonly="true">
				</div>
				<div class="mb-3">
                    <label class="form-label"><?= $this->base->text('record_type', 'label') ?></label>
					<input type="text" class="form-control" value="<?= trim($record[1]) ?>" readonly="true">
				</div>
				<div class="mb-3">
                    <label class="form-label"><?= $this->base->text('record_content', 'label') ?></label>
					<input type="text" class="form-control" value="<?= trim($record[2]) ?>" readonly="true">
				</div>
			</div>
		<?php else: ?>
			<div class="card-body">
				<div class="mb-3">
                    <label class="form-label"><?= $this->base->text('csr_code', 'label') ?></label>
					<textarea class="form-control" style="min-height: 200px;" readonly="true"><?= $data['csr_code'] ?></textarea>
				</div>
				<div class="mb-3">
                    <label class="form-label"><?= $this->base->text('crt_code', 'label') ?></label>
					<textarea class="form-control" style="min-height: 200px;" readonly="true"><?= $data['crt_code'] ?></textarea>
				</div>
				<div class="mb-3">
                    <label class="form-label"><?= $this->base->text('ca_code', 'label') ?></label>
					<textarea class="form-control" style="min-height: 200px;" readonly="true"><?= $data['ca_code'] ?></textarea>
				</div>
			</div>
		<?php endif ?>
	</div>
</div>