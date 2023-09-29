<div class="container-xl">
	<div class="page-header d-print-none">
		<div class="row align-items-center">
			<div class="col">
				<h2 class="page-title py-3">
					<?= $this->base->text($title, 'title') ?>
				</h2>
			</div>
			<div class="col-auto ms-auto d-print-none">
				<a class="btn btn-primary" href="<?= base_url() ?>u/create_ssl"><?= $this->base->text('create', 'button') ?></a>
			</div>
		</div>
	</div>
	<div class="card mb-3 rounded">
		<div class="card-header">
			<div class="card-title"><?= $this->base->text('your_certificates', 'heading') ?></div>
		</div>
		<div class="table-responsive">
			<table class="table card-table table-transparent text-nowrap table-nowrap">
				<thead>
					<tr>
						<th width="5%"><?= $this->base->text('id', 'table') ?></th>
						<th width="75%"><?= $this->base->text('domain', 'table') ?></th>
						<th width="10%"><?= $this->base->text('method', 'table') ?></th>
						<th width="10%"><?= $this->base->text('status', 'table') ?></th>
						<th width="10%" class="text-center"><?= $this->base->text('action', 'table') ?></th>
					</tr>
				</thead>
				<tbody>
					<?php if (count($list) > 0) : ?>
						<?php foreach ($list as $item) : ?>
							<tr>
								<td><?php echo $count = $count ?? 1 ?></td>
								<td><?= $item['domain'] ?></td>
								<td>DNS</td>
								<td>
									<?php if ($item['status'] == 'processing') : ?>
										<span class="badge bg-yellow">
											<?= $this->base->text($item['status'], 'table') ?>
											<?php $btn = ['fa-cogs', 'btn-yellow'] ?>
										</span>
									<?php elseif ($item['status'] == 'active') : ?>
										<span class="badge bg-green">
											<?= $this->base->text($item['status'], 'table') ?>
											<?php $btn = ['fa-shield-alt', 'btn-green'] ?>
										</span>
									<?php elseif ($item['status'] == 'cancelled' or $item['status'] == 'expired') : ?>
										<span class="badge bg-danger">
											<?= $this->base->text($item['status'], 'table') ?>
											<?php $btn = ['fa-lock', 'btn-red'] ?>
										</span>
									<?php endif ?>
								</td>
								<td><a href="<?= base_url() . 'ssl/view/' . $item['key'] ?>" class="btn <?= $btn[1] ?> rounded btn-sm"><em class="fa <?= $btn[0] ?> me-2"></em> <?= $this->base->text('manage', 'button') ?></a></td>
							</tr>
							<?php $count += 1; ?>
						<?php endforeach; ?>
					<?php else : ?>
						<tr>
							<td colspan="5" class="text-center"><?= $this->base->text('nothing_to_show', 'paragraph') ?></td>
						</tr>
					<?php endif ?>
				</tbody>
			</table>
		</div>
		<div class="card-footer py-2">
			<?= count($list) ?> <?= $this->base->text('ssl_certificates', 'heading') ?>
		</div>
	</div>
</div>