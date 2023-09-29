<div class="container-xl">
	<div class="page-header d-print-none">
		<div class="row align-items-center">
			<div class="col">
			<h2 class="page-title py-3">
				Email Templates
			</h2>
			</div>
		</div>
	</div>
	<div class="card mb-3 border-bottom-0 rounded">
		<div class="card-header">
			<div class="card-title">Your Templates</div>
		</div>
		<div class="table-responsive">
			<table class="table card-table table-vcenter table-transparent text-nowrap table-nowrap">
				<thead>
					<tr>
						<th width="5%">ID</th>
						<th width="75%">Subject</th>
						<th width="15%">Trigger</th>
						<th width="5%" class="text-center">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php if (count($list) > 0): ?>
						<?php foreach ($list as $item): ?>
							<tr>
								<td><?php echo $count = $count ?? 1 ?></td>
								<td><?= $item['email_subject'] ?></td>
								<td><?= strtoupper($item['email_id']) ?></td>
								<td><a href="<?= base_url().'email/edit/'.$item['email_id'] ?>" class="btn btn-sm">Manage</a></td>
							</tr>
						<?php $count += 1; ?>
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
			<div class=""><?= count($list) ?> Sendable Emails</div>
		</div>
	</div>
</div>