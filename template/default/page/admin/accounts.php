<div class="container-xl">
	<div class="page-header d-print-none">
		<div class="row align-items-center">
			<div class="col">
                <h2 class="page-title py-3">
                    <?= $this->base->text('accounts', 'title') ?>
                </h2>
			</div>
		</div>
	</div>
	<div class="card mb-3 rounded">
		<div class="card-header">
            <div class="card-title"><?= $this->base->text('active', 'table') ?> <?= $this->base->text('accounts', 'heading') ?></div>
		</div>
		<div class="table-responsive">
			<table class="table card-table table-transparent text-nowrap table-nowrap">
				<thead>
					<tr>
                        <th width="15%"><?= $this->base->text('username', 'table') ?></th>
                        <th width="75%"><?= $this->base->text('label', 'table') ?></th>
                        <th width="10%"><?= $this->base->text('status', 'table') ?></th>
                        <th width="10%" class="text-center"><?= $this->base->text('action', 'table') ?></th>
					</tr>
				</thead>
				<tbody>
					<?php if (count($list) > 0) : ?>
						<?php
						if ($this->input->get('page')) :
							$mcount = $this->base->rpp() * $this->input->get('page') + 1;
						else :
							$mcount = 1;
						endif;
						$count = $mcount;
						?>
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
                                <td><a href="<?= base_url() . 'admin/account/view/' . $item['account_username'] ?>" class="btn rounded <?= $btn[1] ?> btn-sm"><em class="fa <?= $btn[0] ?> me-1"></em> <?= $this->base->text('manage', 'button') ?></a></td>
							</tr>
							<?php $count += 1; ?>
						<?php endforeach; ?>
					<?php else : ?>
						<tr>
                            <td colspan="4" class="text-center"><?= $this->base->text('nothing_to_show', 'paragraph') ?></td>
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
					<ul class="pagination mb-0">
						<li class="page-item <?php if ($page < 1) : ?>disabled<?php endif ?>">
							<a class="page-link" <?php if ($page > 0) : ?>href="<?= base_url() ?>admin/account/list?page=<?= $page - 1 ?>" <?php endif ?>>
								<span>&laquo;</span>
							</a>
						</li>
						<li class="page-item <?php if (($page + 1) * $this->base->rpp() >= $this->account->list_count()) : ?>disabled<?php endif ?>">
							<a class="page-link" <?php if (($page + 1) * $this->base->rpp() < $this->account->list_count()) : ?>href="<?= base_url() ?>admin/account/list?page=<?= $page + 1 ?>" <?php endif ?>>
								<span>&raquo;</span>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
