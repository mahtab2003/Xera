<div class="container-xl">
	<div class="page-header d-print-none">
		<div class="row align-items-center">
			<div class="col">
				<h2 class="page-title py-3">
					Hosting Accounts
				</h2>
			</div>
		</div>
	</div>
	<div class="card mb-3 rounded">
		<div class="card-header">
			<div class="card-title">Active Accounts</div>
		</div>
		<div class="table-responsive">
			<table class="table card-table table-transparent text-nowrap table-nowrap">
				<thead>
					<tr>
						<th width="15%">Username</th>
						<th width="75%">Label</th>
						<th width="10%">Status</th>
						<th width="10%" class="text-center">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php if (count($list) > 0) : ?>
						<?php foreach ($list as $item) : ?>
							<tr>
								<td><?= $item['account_username'] ?></td>
								<td><?= $item['account_label'] ?></td>
								<td>
									<?php if ($item['account_status'] == 'pending' or $item['account_status'] == 'deactivating' or $item['account_status'] == 'reactivating') : ?>
										<span class="badge bg-yellow">
											<?= $item['account_status'] ?>
											<?php $btn = ['fa-cogs', 'btn-yellow'] ?>
										</span>
									<?php elseif ($item['account_status'] == 'active') : ?>
										<span class="badge bg-green">
											<?= $item['account_status'] ?>
											<?php $btn = ['fa-globe', 'btn-green'] ?>
										</span>
									<?php elseif ($item['account_status'] == 'deactivated' or $item['account_status'] == 'suspended') : ?>
										<span class="badge bg-red">
											<?= $item['account_status'] ?>
											<?php $btn = ['fa-lock', 'btn-red'] ?>
										</span>
									<?php endif ?>
								</td>
								<td><a href="<?= base_url() . 'admin/account/view/' . $item['account_username'] ?>" class="btn rounded <?= $btn[1] ?> btn-sm"><em class="fa <?= $btn[0] ?> me-1"></em> Manage</a></td>
							</tr>
						<?php endforeach; ?>
					<?php else : ?>
						<tr>
							<td colspan="4" class="text-center">Nothing to show</td>
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
											endif; ?> of <?= $this->account->list_count() ?> entries
				</div>
				<div>
					<?php $page = $this->input->get('page') ?? 0 ?>
					<?php $i = $this->account->list_count() - $this->base->rpp(); ?>
					<?php $i = $i / $this->base->rpp(); ?>
					<?php $i = intval($i); ?>
					<ul class="pagination mb-0">
						<li class="page-item <?php if ($page < 1) : ?>disabled<?php endif ?>">
							<a class="page-link" <?php if ($page > 0) : ?>href="<?= base_url() ?>admin/account/list?page=<?= $page - 1 ?>" <?php endif ?>>
								<span>&laquo;</span>
							</a>
						</li>
						<li class="page-item <?php if ($page > $i) : ?>disabled<?php endif ?>">
							<a class="page-link" <?php if ($page < $i + 1) : ?>href="<?= base_url() ?>admin/account/list?page=<?= $page + 1 ?>" <?php endif ?>>
								<span>&raquo;</span>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>