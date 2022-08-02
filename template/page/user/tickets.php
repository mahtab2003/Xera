<div class="container-xl">
	<div class="page-header d-print-none">
		<div class="row align-items-center">
			<div class="col">
				<h2 class="page-title py-3">
					Support Tickets
				</h2>
			</div>
			<div class="col-auto ms-auto d-print-none">
				<a class="btn btn-primary" href="<?= base_url() ?>u/create_ticket">Create</a>
			</div>
		</div>
	</div>
	<div class="card mb-3 rounded">
		<div class="card-header">
			<div class="card-title">Your Tickets</div>
		</div>
		<div class="table-responsive">
			<table class="table card-table table-transparent text-nowrap table-nowrap">
				<thead>
					<tr>
						<th width="5%">ID</th>
						<th width="75%">Subject</th>
						<th width="10%" class="text-center">Date</th>
						<th width="10%">Status</th>
						<th width="10%" class="text-center">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php if (count($list) > 0): ?>
						<?php foreach ($list as $item): ?>
							<tr>
								<td><?php echo $count = $count ?? 1 ?></td>
								<td><?= $item['ticket_subject'] ?></td>
								<td><?= date('d-m-Y', $item['ticket_time']) ?></td>
								<td>
									<?php if ($item['ticket_status'] == 'open'): ?>
										<span class="badge bg-orange">
											<?= $item['ticket_status'] ?>
											<?php $btn = ['fa-clock', 'btn-yellow'] ?>
										</span>
									<?php elseif ($item['ticket_status'] == 'support' OR $item['ticket_status'] == 'customer'): ?>
										<span class="badge bg-green">
											<?= $item['ticket_status'] ?>
											<?php $btn = ['fa-envelope-open', 'btn-green'] ?>
										</span>
									<?php elseif ($item['ticket_status'] == 'closed'): ?>
										<span class="badge bg-red">
											<?= $item['ticket_status'] ?>
											<?php $btn = ['fa-lock', 'btn-red'] ?>
										</span>
									<?php endif ?>
								</td>
								<td><a href="<?= base_url().'u/view_ticket/'.$item['ticket_key'] ?>" class="btn <?= $btn[1] ?> btn-sm"><i class="fa <?= $btn[0] ?> me-2"></i> Manage</a></td>
							</tr>
							<?php $count += 1; ?>
						<?php endforeach; ?>
					<?php else: ?>
						<tr>
							<td colspan="5" class="text-center">
								<div class="py-5">
									<i class="fa fa-box-open" style="font-size: 80px;"></i>
									<div class="mb-2">
										No support tickets yet?
									</div>
									<a href="<?= base_url() ?>u/create_ticket" class="btn btn-primary">Create Now</a>
								</div>
							</td>
						</tr>
					<?php endif ?>
				</tbody>
			</table>
		</div>
		<div class="card-footer py-2">
			<?= count($list) ?> Support Tickets
		</div>
	</div>
</div>