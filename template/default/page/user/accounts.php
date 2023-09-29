<div class="container-xl">
	<div class="page-header d-print-none">
		<div class="row align-items-center">
			<div class="col">
				<h2 class="page-title py-3">
					<?= $this->base->text($title, 'title') ?>
				</h2>
			</div>
			<div class="col-auto ms-auto d-print-none">
				<?php if (count($list) < 3) : ?>
					<a class="btn btn-primary" href="<?= base_url() ?>u/create_account"><?= $this->base->text('create', 'button') ?></a>
				<?php endif ?>
			</div>
		</div>
	</div>
	<?php
        if (count($list) === 2) { 
            echo '<div class="alert alert-danger">'.$this->base->text('account_limit', 'paragraph').'<a href="https://ifastnet.com">'.$this->base->text('premium_hosting', 'heading').'</a>'.$this->base->text('better_service', 'paragraph').'</div>';
        } else if (count($list) === 3) { 
            echo '<div class="alert alert-danger">'.$this->base->text('account_limit_crossed', 'paragraph').'<a href="https://ifastnet.com">'.$this->base->text('premium_hosting', 'heading').'</a>'.$this->base->text('better_service', 'paragraph').'</div>';
        }
    ?>
	<div class="card mb-3 rounded">
		<div class="card-header">
			<div class="card-title"><?= $this->base->text('your_accounts', 'heading') ?></div>
		</div>
		<div class="table-responsive">
			<table class="table card-table table-transparent text-nowrap table-nowrap">
				<thead>
					<tr>
						<th width="5%"><?= $this->base->text('id', 'table') ?></th>
						<th width="15%"><?= $this->base->text('username', 'table') ?></th>
						<th width="70%"><?= $this->base->text('label', 'table') ?></th>
						<th width="10%"><?= $this->base->text('status', 'table') ?></th>
						<th width="10%" class="text-center"><?= $this->base->text('action', 'table') ?></th>
					</tr>
				</thead>
				<tbody>
					<?php if (count($list) > 0) : ?>
						<?php foreach ($list as $item) : ?>
							<tr>
								<td><?php echo $count = $count ?? 1 ?></td>
								<td><?= $item['account_username'] ?></td>
								<td><?= $item['account_label'] ?></td>
								<td>
									<?php if ($item['account_status'] == 'pending' or $item['account_status'] == 'deactivating' or $item['account_status'] == 'reactivating') : ?>
										<span class="badge bg-yellow">
											<?= $this->base->text($item['account_status'], 'table') ?>
											<?php $btn = ['fa-cogs', 'btn-yellow'] ?>
										</span>
									<?php elseif ($item['account_status'] == 'active') : ?>
										<span class="badge bg-green">
											<?= $this->base->text($item['account_status'], 'table') ?>
											<?php $btn = ['fa-globe', 'btn-green'] ?>
										</span>
									<?php elseif ($item['account_status'] == 'deactivated' or $item['account_status'] == 'suspended') : ?>
										<span class="badge bg-red">
											<?= $this->base->text($item['account_status'], 'table') ?>
											<?php $btn = ['fa-lock', 'btn-red'] ?>
										</span>
									<?php endif ?>
								</td>
								<td><a href="<?= base_url() . 'account/view/' . $item['account_username'] ?>" class="btn rounded <?= $btn[1] ?> btn-sm"><em class="fa <?= $btn[0] ?> me-1"></em> <?= $this->base->text('manage', 'button') ?></a></td>
							</tr>
							<?php $count += 1; ?>
						<?php endforeach; ?>
					<?php else : ?>
						<tr>
							<td colspan="5" class="text-center"><?= $this->base->text('nothing_to_show', 'paragraph') ?></td>
						</tr>
					<?php endif ?>
				</tbody>
			</table>
		</div>
		<div class="card-footer py-2">
			<?= count($list) ?> / 3 <?= $this->base->text('free_accounts', 'heading') ?>
		</div>
	</div>
</div>