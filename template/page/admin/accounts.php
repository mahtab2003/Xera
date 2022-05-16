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
								<td><?= strtoupper($item['account_status']) ?></td>
								<td><a href="<?= base_url().'a/view_account/'.$item['account_username'] ?>" class="btn btn-sm">Manage</a></td>
							</tr>
						<?php endforeach; ?>
					<?php else: ?>
						<tr>
							<td colspan="5" class="text-center">Nothing to show</td>
						</tr>
					<?php endif ?>
				</tbody>
			</table>
		</div>
		<div class="card-footer py-2">
			<?= count($list) ?> / 3 Hosting Accounts
		</div>
	</div>
</div>