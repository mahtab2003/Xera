<div class="container-xl">
	<div class="page-header d-print-none">
		<div class="row align-items-center">
			<div class="col">
				<h2 class="page-title py-3">
					SSL Certificates
				</h2>
			</div>
		</div>
	</div>
	<div class="card mb-3 rounded">
		<div class="card-header">
			<div class="card-title">Your Certificates</div>
		</div>
		<div class="table-responsive">
			<table class="table card-table table-transparent text-nowrap table-nowrap">
				<thead>
					<tr>
						<th width="5%">ID</th>
						<th width="75%">Domain</th>
						<th width="10%">Method</th>
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
								<td><?= $item['domain'] ?></td>
								<td>DNS</td>
								<td>
									<?php if ($item['status'] == 'processing') : ?>
										<span class="badge bg-yellow">
											<?= $item['status'] ?>
											<?php $btn = ['fa-cogs', 'btn-yellow'] ?>
										</span>
									<?php elseif ($item['status'] == 'active') : ?>
										<span class="badge bg-green">
											<?= $item['status'] ?>
											<?php $btn = ['fa-shield-alt', 'btn-green'] ?>
										</span>
									<?php elseif ($item['status'] == 'cancelled' or $item['status'] == 'expired') : ?>
										<span class="badge bg-danger">
											<?= $item['status'] ?>
											<?php $btn = ['fa-lock', 'btn-red'] ?>
										</span>
									<?php endif ?>
								</td>
								<td><a href="<?= base_url() . 'admin/ssl/view/' . $item['key'] ?>" class="btn <?= $btn[1] ?> rounded btn-sm"><em class="fa <?= $btn[0] ?> me-2"></em> Manage</a></td>
							</tr>
							<?php $count += 1; ?>
						<?php endforeach; ?>
					<?php else : ?>
						<tr>
							<td colspan="5" class="text-center">Nothing to show</td>
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
											endif; ?> of <?= $this->ssl->list_count() ?> entries
				</div>
				<div>
					<?php $page = $this->input->get('page') ?? 0 ?>
					<?php $i = $this->ssl->list_count() - $this->base->rpp(); ?>
					<?php $i = $i / $this->base->rpp(); ?>
					<?php $i = intval($i); ?>
					<ul class="pagination mb-0">
						<li class="page-item <?php if ($page < 1) : ?>disabled<?php endif ?>">
							<a class="page-link" <?php if ($page > 0) : ?>href="<?= base_url() ?>admin/ssl/list?page=<?= $page - 1 ?>" <?php endif ?>>
								<span>&laquo;</span>
							</a>
						</li>
						<li class="page-item <?php if ($page >= $i) : ?>disabled<?php endif ?>">
							<a class="page-link" <?php if ($page < $i + 1) : ?>href="<?= base_url() ?>admin/ssl/list?page=<?= $page + 1 ?>" <?php endif ?>>
								<span>&raquo;</span>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>