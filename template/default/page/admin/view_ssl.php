<div class="container-xl">
	<div class="page-header d-print-none">
		<div class="row align-items-center">
			<div class="col">
				<h2 class="page-title py-3">
					View SSL
				</h2>
			</div>
			<div class="col-auto ms-auto d-print-none">
				<?php if ($data['status'] == 'cancelled' OR $data['status'] == 'expired'): ?>
					<a class="btn btn-danger" href="?delete=true">Delete</a>
				<?php elseif ($data['status'] !== 'cancelled' OR $data['status'] !== 'expired'): ?>
					<a class="btn btn-danger" href="?cancel=true">Cancel</a>
				<?php endif ?>
			</div>
		</div>
	</div>
	<div class="card mb-3">
		<div class="card-header">
			<div class="card-title">Information</div>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col-sm-6">
					<div class="row align-items-center">
						<span class="col">Domain:</span>
						<span class="col-auto ms-auto"><?= $data['domain'] ?></span>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="row align-items-center">
						<span class="col">Status:</span>
						<span class="col-auto ms-auto">
							<?php if ($data['status'] == 'processing'): ?>
								<span class="badge bg-yellow">
									<?= $data['status'] ?>
								</span>
							<?php elseif ($data['status'] == 'active'): ?>
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
						<span class="col">Start Date:</span>
						<span class="col-auto ms-auto"><?= $data['begin_date'] ?? '-- -- ----' ?></span>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="row align-items-center">
						<span class="col">End Date:</span>
						<span class="col-auto ms-auto"><?= $data['end_date'] ?? '-- -- ----' ?></span>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="card mb-3">
		<?php if ($data['status'] === 'processing'): ?>
			<?php $record = explode(' ', $data['approver_method']['dns']['record']) ?>
			<div class="card-header">
				<div class="card-title">Verify Ownership</div>
			</div>
			<div class="card-body">
				<div class="mb-3">
					<label class="form-label">CSR Code</label>
					<textarea class="form-control" style="min-height: 200px;" readonly="true"><?= $data['csr_code'] ?></textarea>
				</div>
				<div class="mb-3">
					<label class="form-label">Record Name</label>
					<input type="text" class="form-control" value="<?= trim($record[0]) ?>" readonly="true">
				</div>
				<div class="mb-3">
					<label class="form-label">Record Content</label>
					<input type="text" class="form-control" value="<?= trim($record[2]) ?>" readonly="true">
				</div>
			</div>
		<?php else: ?>
			<div class="card-body">
				<div class="mb-3">
					<label class="form-label">CSR Code</label>
					<textarea class="form-control" style="min-height: 200px;" readonly="true"><?= $data['csr_code'] ?></textarea>
				</div>
				<div class="mb-3">
					<label class="form-label">CRT Code</label>
					<textarea class="form-control" style="min-height: 200px;" readonly="true"><?= $data['crt_code'] ?></textarea>
				</div>
				<div class="mb-3">
					<label class="form-label">CA Code</label>
					<textarea class="form-control" style="min-height: 200px;" readonly="true"><?= $data['ca_code'] ?></textarea>
				</div>
			</div>
		<?php endif ?>
	</div>
</div>