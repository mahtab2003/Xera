<div class="container-xl">
	<div class="page-header d-print-none">
		<div class="row align-items-center">
			<div class="col">
				<h2 class="page-title py-3">
					Hosting Accounts
				</h2>
			</div>
			<div class="col-auto ms-auto d-print-none">
				<?php if (count($list) < 3): ?>
					<a class="btn btn-primary" href="<?= base_url() ?>u/create_account">Create</a>
				<?php endif ?>
			</div>
		</div>
	</div>
	<?php if (count($list) > 1): ?>
		<div class="alert alert-danger">You are about to reach the limit of 3 free hosting accounts per user. Please upgrade to <a href="https://ifastnet.com">premium hosting</a> for better service.</div>
	<?php endif ?>
	<div class="card mb-3 rounded">
		<div class="card-header">
			<div class="card-title">Your Accounts</div>
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
								<td><a href="<?= base_url().'u/view_account/'.$item['account_username'] ?>" class="btn btn-sm">Manage</a></td>
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
			<?= count($list) ?> / 3 Free Accounts
		</div>
	</div>
</div>