<div class="container-xl">
	<div class="page-header d-print-none">
		<div class="row align-items-center">
			<div class="col">
                <h2 class="page-title py-3">
                    <?= $this->base->text('your_clients', 'heading') ?>
                </h2>
			</div>
		</div>
	</div>
	<div class="card mb-3 rounded">
		<div class="card-header">
            <div class="card-title"><?= $this->base->text('your_clients', 'heading') ?></div>
		</div>
		<div class="table-responsive">
			<table class="table card-table table-vcenter table-transparent text-nowrap table-nowrap">
				<thead>
					<tr>
                        <th width="5%"><?= $this->base->text('id', 'table') ?></th>
                        <th width="15%"><?= $this->base->text('your_name', 'label') ?></th>
                        <th width="70%"><?= $this->base->text('email_address', 'label') ?></th>
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
					?>
                    <?php foreach ($list as $item) : ?>
							<tr>
								<td><?php echo $count = $count ?? $mcount ?></td>
								<td><?= $item['user_name'] ?></td>
								<td><?= $item['user_email'] ?></td>
								<td>
									<?php if ($item['user_status'] == 'inactive') : ?>
										<span class="badge bg-yellow">
											<?= $item['user_status'] ?>
										</span>
									<?php elseif ($item['user_status'] == 'active') : ?>
										<span class="badge bg-green">
											<?= $item['user_status'] ?>
										</span>
									<?php endif ?>
								</td>
                                <td><a href="<?= base_url() . 'client/view/' . $item['user_key'] ?>" class="btn rounded btn-green btn-sm"><em class="fa fa-user me-2"></em> <?= $this->base->text('manage', 'button') ?></a></td>
							</tr>
                            <?php $count += 1; ?>
						<?php endforeach; ?>
					<?php else : ?>
						<tr>
                            <td colspan="5" class="text-center">
                                <?= $this->base->text('no_clients_yet', 'paragraph') ?>
                            </td>
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
											endif; ?> of <?= $this->user->list_count() ?> entries
				</div>
				<div>
					<?php $page = $this->input->get('page') ?? 0 ?>
                    <ul class="pagination mb-0">
						<li class="page-item <?php if ($page < 1) : ?>disabled<?php endif ?>">
							<a class="page-link" <?php if ($page > 0) : ?>href="<?= base_url() ?>client/list?page=<?= $page - 1 ?>" <?php endif ?>>
								<span>&laquo;</span>
							</a>
						</li>
						<li class="page-item <?php if (($page + 1) * $this->base->rpp() >= $this->user->list_count()) : ?>disabled<?php endif ?>">
							<a class="page-link" <?php if (($page + 1) * $this->base->rpp() < $this->user->list_count()) : ?>href="<?= base_url() ?>client/list?page=<?= $page + 1 ?>" <?php endif ?>>
								<span>&raquo;</span>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
