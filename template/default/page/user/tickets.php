<div class="container-xl">
	<div class="page-header d-print-none">
		<div class="row align-items-center">
			<div class="col">
				<h2 class="page-title py-3">
					<?= $this->base->text($title, 'title') ?>
				</h2>
			</div>
			<div class="col-auto ms-auto d-print-none">
				<a class="btn btn-primary" href="<?= base_url() ?>u/create_ticket"><?= $this->base->text('create', 'button') ?></a>
			</div>
		</div>
	</div>
	<div class="card mb-3 rounded">
		<div class="card-header">
			<div class="card-title"><?= $this->base->text('your_tickets', 'heading') ?></div>
		</div>
		<div class="table-responsive">
			<table class="table card-table table-transparent text-nowrap table-nowrap">
				<thead>
					<tr>
						<th width="5%"><?= $this->base->text('id', 'table') ?></th>
						<th width="75%"><?= $this->base->text('subject', 'table') ?></th>
						<th width="10%" class="text-center"><?= $this->base->text('date', 'table') ?></th>
						<th width="10%"><?= $this->base->text('status', 'table') ?></th>
						<th width="10%" class="text-center"><?= $this->base->text('action', 'table') ?></th>
					</tr>
				</thead>
				<tbody>
					<?php if (count($list) > 0) : ?>
						<?php foreach ($list as $item) : ?>
							<tr>
								<td><?php echo $count = $count ?? 1 ?></td>
								<td><?= $item['ticket_subject'] ?></td>
								<td><?= date('d-m-Y', $item['ticket_time']) ?></td>
								<td>
									<?php if ($item['ticket_status'] == 'open') : ?>
										<span class="badge bg-orange">
											<?= $this->base->text($item['ticket_status'], 'table') ?>
											<?php $btn = ['fa-clock', 'btn-yellow'] ?>
										</span>
									<?php elseif ($item['ticket_status'] == 'support' or $item['ticket_status'] == 'customer') : ?>
										<span class="badge bg-green">
											<?= $this->base->text($item['ticket_status'], 'table') ?>
											<?php $btn = ['fa-envelope-open', 'btn-green'] ?>
										</span>
									<?php elseif ($item['ticket_status'] == 'closed') : ?>
										<span class="badge bg-red">
											<?= $this->base->text($item['ticket_status'], 'table') ?>
											<?php $btn = ['fa-lock', 'btn-red'] ?>
										</span>
									<?php endif ?>
								</td>
								<td><a href="<?= base_url() . 'ticket/view/' . $item['ticket_key'] ?>" class="btn rounded <?= $btn[1] ?> btn-sm"><em class="fa <?= $btn[0] ?> me-2"></em> <?= $this->base->text('manage', 'button') ?></a></td>
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
			<?= count($list) ?> <?= $this->base->text('support_tickets', 'heading') ?>
		</div>
	</div>
</div>