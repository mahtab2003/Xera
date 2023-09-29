<div class="container-xl">
	<div class="page-header d-print-none">
		<div class="row align-items-center">
			<div class="col">
				<h2 class="page-title py-3">
					Support Tickets
				</h2>
			</div>
		</div>
	</div>
	<div class="card mb-3 rounded">
		<div class="card-header">
			<div class="card-title">Pending Support Tickets</div>
		</div>
		<div class="table-responsive">
			<table class="table card-table table-vcenter table-transparent text-nowrap table-nowrap">
				<thead>
					<tr>
						<th width="5%">ID</th>
						<th width="65%">Subject</th>
						<th width="10%" class="text-center">Date</th>
						<th width="10%" class="text-center">Client</th>
						<th width="10%">Status</th>
						<th width="10%" class="text-center">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php if (count($list) > 0) : ?>
						<?php foreach ($list as $item) : ?>
							<tr>
								<?php
								if ($this->input->get('page')) :
									$mcount = $this->base->rpp() * $this->input->get('page') + 1;
								else :
									$mcount = 1;
								endif;
								?>
								<td><?php echo $count = $count ?? $mcount ?></td>
								<td><?= $item['ticket_subject'] ?></td>
								<td><?= date('d-m-Y', $item['ticket_time']) ?></td>
								<td><?= $this->ticket->get_user_name($item['ticket_for']) ?></td>
								<td>
									<?php if ($item['ticket_status'] == 'open') : ?>
										<span class="badge bg-orange">
											<?= $item['ticket_status'] ?>
											<?php $btn = ['fa-clock', 'btn-yellow'] ?>
										</span>
									<?php elseif ($item['ticket_status'] == 'support' or $item['ticket_status'] == 'customer') : ?>
										<span class="badge bg-green">
											<?= $item['ticket_status'] ?>
											<?php $btn = ['fa-envelope-open', 'btn-green'] ?>
										</span>
									<?php elseif ($item['ticket_status'] == 'closed') : ?>
										<span class="badge bg-red">
											<?= $item['ticket_status'] ?>
											<?php $btn = ['fa-lock', 'btn-red'] ?>
										</span>
									<?php endif ?>
								</td>
								<td><a href="<?= base_url() . 'admin/ticket/view/' . $item['ticket_key'] ?>" class="btn rounded <?= $btn[1] ?> btn-sm"><em class="fa <?= $btn[0] ?> me-2"></em> Manage</a></td>
							</tr>
							<?php $count += 1; ?>
						<?php endforeach; ?>
					<?php else : ?>
						<tr>
							<td colspan="6" class="text-center">Nothing to show</td>
						</tr>
					<?php endif ?>
				</tbody>
			</table>
		</div>
		<div class="card-footer py-2">
			<div class="d-flex align-items-center justify-content-between">
				<div>
					Showing <?php if (isset($mcount)) : echo $mcount;
							else : echo 0;
							endif; ?> to <?php if (isset($count)) : echo $count - 1;
											else : echo 0;
											endif; ?> of <?= $this->ticket->list_count() ?> entries
				</div>
				<div>
					<?php $page = $this->input->get('page') ?? 0 ?>
					<?php $i = $this->ticket->list_count() - $this->base->rpp(); ?>
					<?php $i = $i / $this->base->rpp(); ?>
					<?php $i = intval($i); ?>
					<ul class="pagination mb-0">
						<li class="page-item <?php if ($page < 1) : ?>disabled<?php endif ?>">
							<a class="page-link" <?php if ($page > 0) : ?>href="<?= base_url() ?>admin/ticket/list?page=<?= $page - 1 ?>" <?php endif ?>>
								<span>&laquo;</span>
							</a>
						</li>
						<li class="page-item <?php if ($page > $i) : ?>disabled<?php endif ?>">
							<a class="page-link" <?php if ($page < $i + 1) : ?>href="<?= base_url() ?>admin/ticket/list?page=<?= $page + 1 ?>" <?php endif ?>>
								<span>&raquo;</span>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>