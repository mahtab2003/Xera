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
					<?php if (count($list) > 0): ?>
						<?php foreach ($list as $item): ?>
							<tr>
								<td><?php echo $count = $count ?? 1 ?></td>
								<td><?= $item['domain'] ?></td>
								<td>DNS</td>
								<td>
									<?php if ($item['status'] == 'processing'): ?>
										<span class="badge bg-yellow">
											<?= $item['status'] ?>
											<?php $btn = ['fa-cogs', 'btn-yellow'] ?>
										</span>
									<?php elseif ($item['status'] == 'active'): ?>
										<span class="badge bg-green">
											<?= $item['status'] ?>
											<?php $btn = ['fa-shield-alt', 'btn-green'] ?>
										</span>
									<?php elseif ($item['status'] == 'cancelled' OR $item['status'] == 'expired'): ?>
										<span class="badge bg-danger">
											<?= $item['status'] ?>
											<?php $btn = ['fa-lock', 'btn-red'] ?>
										</span>
									<?php endif ?>
								</td>
								<td><a href="<?= base_url().'a/view_ssl/'.$item['key'] ?>" class="btn <?= $btn[1] ?> btn-sm"><i class="fa <?= $btn[0] ?> me-2"></i> Manage</a></td>
							</tr>
							<?php $count += 1; ?>
						<?php endforeach; ?>
					<?php else: ?>
						<tr>
							<td colspan="5" class="text-center">
								<div class="py-5">
									<i class="fa fa-box-open" style="font-size: 80px;"></i>
									<div>
										No ssl certificates yet?
									</div>
								</div>
							</td>
						</tr>
					<?php endif ?>
				</tbody>
			</table>
		</div>
		<div class="card-footer py-2">
			<?= count($list) ?> SSL Certificates
		</div>
	</div>
</div>