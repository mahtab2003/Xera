<div class="container-xl">
	<div class="page-header d-print-none">
		<div class="row align-items-center">
			<div class="col">
				<h2 class="page-title py-3">
					Your Clients
				</h2>
			</div>
		</div>
	</div>
	<div class="card mb-3 rounded">
		<div class="card-header">
			<div class="card-title">Your Clients</div>
		</div>
		<div class="table-responsive">
			<table class="table card-table table-vcenter table-transparent text-nowrap table-nowrap">
				<thead>
					<tr>
						<th width="5%">ID</th>
						<th width="15%">Name</th>
						<th width="70%">Email</th>
						<th width="10%">Status</th>
						<th width="10%" class="text-center">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php if (count($list) > 0): ?>
						<?php foreach ($list as $item): ?>
							<tr>
								<td><?php echo $count = $count ?? 1 ?></td>
								<td><?= $item['user_name'] ?></td>
								<td><?= $item['user_email'] ?></td>
								<td>
									<?php if ($item['user_status'] == 'inactive'): ?>
										<span class="badge bg-yellow">
											<?= $item['user_status'] ?>
										</span>
									<?php elseif ($item['user_status'] == 'active'): ?>
										<span class="badge bg-green">
											<?= $item['user_status'] ?>
										</span>
									<?php endif ?>
								</td>
								<td><a href="<?= base_url().'a/view_client/'.$item['user_key'] ?>" class="btn btn-sm">Manage</a></td>
							</tr>
							<?php $count += 1; ?>
						<?php endforeach; ?>
					<?php else: ?>
						<tr>
							<td colspan="5" class="text-center">
								<div class="py-5">
									<i class="fa fa-box-open" style="font-size: 80px;"></i>
									<div>
										No clients yet?
									</div>
								</div>
							</td>
						</tr>
					<?php endif ?>
				</tbody>
			</table>
		</div>
		<div class="card-footer py-2">
			<div class=""><?= count($list) ?> Clients</div>
		</div>
	</div>
</div>