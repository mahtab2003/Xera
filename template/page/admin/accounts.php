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
					<?php if (count($list) > 0): ?>
						<?php foreach ($list as $item): ?>
							<tr>
								<td><?= $item['account_username'] ?></td>
								<td><?= $item['account_label'] ?></td>
								<td>
									<?php if ($item['account_status'] == 'pending' OR $item['account_status'] == 'deactivating' OR $item['account_status'] == 'reactivating'): ?>
										<span class="badge bg-yellow">
											<?= $item['account_status'] ?>
											<?php $btn = ['fa-cogs', 'btn-yellow'] ?>
										</span>
									<?php elseif ($item['account_status'] == 'active'): ?>
										<span class="badge bg-green">
											<?= $item['account_status'] ?>
											<?php $btn = ['fa-globe', 'btn-green'] ?>
										</span>
									<?php elseif ($item['account_status'] == 'deactivated' OR $item['account_status'] == 'suspended'): ?>
										<span class="badge bg-red">
											<?= $item['account_status'] ?>
											<?php $btn = ['fa-lock', 'btn-red'] ?>
										</span>
									<?php endif ?>
								</td>
								<td><a href="<?= base_url().'a/view_account/'.$item['account_username'] ?>" class="btn <?= $btn[1] ?> btn-sm"><i class="fa <?= $btn[0] ?> me-1"></i> Manage</a></td>
							</tr>
						<?php endforeach; ?>
					<?php else: ?>
						<tr>
							<td colspan="5" class="text-center">
								<div class="py-5">
									<i class="fa fa-box-open" style="font-size: 80px;"></i>
									<div>
										No hosting accounts yet?
									</div>
								</div>
							</td>
						</tr>
					<?php endif ?>
				</tbody>
			</table>
		</div>
		<div class="card-footer py-2">
			<?= count($list) ?> Hosting Accounts Found
		</div>
	</div>
</div>