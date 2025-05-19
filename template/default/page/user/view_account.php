<div class="container-xl">
	<div class="page-header d-print-none">
		<h2 class="page-title py-3">
			<?= $id . "(" . $data['account_label'] . ")" ?>
		</h2>
	</div>
	<div class="row">
		<div class="col-md-4 mb-2 order-md-2">
			<div class="card">
				<div class="pt-2 px-3 pb-0">
					<div class="d-grid mb-2">
						<a <?php if ($data['account_status'] === 'active') : ?>href="<?= base_url() ?>account/view/<?= $id ?>?login=true" target="_blank" <?php else : ?> href="#" disabled class="btn btn-primary rounded disabled" <?php endif ?> class="btn btn-primary rounded"><em class="fa fa-globe me-2"></em> <?= $this->base->text('control_panel', 'button') ?></a>
					</div>
					<div class="d-grid mb-2">
						<a <?php if ($data['account_status'] === 'active') : ?>href="<?= $this->account->create_fm_link($data['account_username'], $data['account_password']) ?>" target="_blank" <?php else : ?> class="disabled btn btn-yellow rounded" href="#" disabled <?php endif ?> class="btn btn-green rounded"><em class="fa fa-file me-2"></em> <?= $this->base->text('file_manager', 'button') ?></a>
					</div>
					<?php if ($data['account_status'] === 'active') : ?>
						<div class="d-grid mb-2">
							<a href="<?= base_url() ?>account/settings/<?= $id ?>" class="btn btn-yellow rounded"><em class="fa fa-cogs me-2"></em> <?= $this->base->text('settings', 'button') ?></a>
						</div>
					<?php elseif ($data['account_status'] === 'suspended') : ?>
						<div class="d-grid mb-2">
							<a href="<?= base_url() ?>ticket/create" class="btn btn-green rounded"><em class="fa fa-cog me-2"></em> <?= $this->base->text('open_ticket', 'button') ?></a>
						</div>
					<?php elseif ($data['account_status'] === 'deactivated') : ?>
						<div class="d-grid mb-2">
							<a href="<?= base_url() ?>account/view/<?= $id ?>?reactivate=true" class="btn btn-green rounded"><em class="fa fa-cog me-2"></em> <?= $this->base->text('reactivate', 'button') ?></a>
						</div>
					<?php else : ?>
						<div class="d-grid mb-2">
							<a href="#" class="btn btn-yellow disabled rounded"><em class="fa fa-cogs me-2"></em> <?= $this->base->text('settings', 'button') ?></a>
						</div>
					<?php endif ?>
				</div>
			</div>
		</div>
		<div class="col-md-8 mb-2">
			<?php $time = $data['account_time'] + 3600; ?>
			<?php if ($time > time()) : ?>
				<div class="alert alert-success">
					<?= $this->base->text('account_note', 'paragraph') ?>
				</div>
			<?php endif; ?>
			<?php if ($data['account_status'] === 'pending') : ?>
				<div class="alert alert-info">
					<?= $this->base->text('account_pending', 'paragraph') ?>
				</div>
			<?php elseif ($data['account_status'] === 'reactivating') : ?>
				<div class="alert alert-warning">
					<?= $this->base->text('account_reactivating', 'paragraph') ?>
				</div>
			<?php elseif ($data['account_status'] === 'deactivating') : ?>
				<div class="alert alert-warning">
					<?= $this->base->text('account_deactivating', 'paragraph') ?>
				</div>
			<?php elseif ($data['account_status'] === 'suspended') : ?>
				<div class="alert alert-danger">
					<?= $this->base->text('account_suspended', 'paragraph') ?>
				</div>
			<?php elseif ($data['account_status'] === 'deactivated') : ?>
				<div class="alert alert-success">
					<?= $this->base->text('account_deactivated', 'paragraph') ?>
				</div>
			<?php endif; ?>
			<div class="row row-cards">
				<div class="col-md-6">
					<div class="card">
						<div class="card-header">
							<div class="card-title"><?= $this->base->text('account_details', 'heading') ?></div>
						</div>
						<table class="table card-table">
							<tbody>
								<tr>
									<td width="30%">
										<strong><?= $this->base->text('username', 'table') ?></strong>
									</td>
									<td>
										<?php if ($data['account_status'] === 'active') : ?>
											<?= $data['account_username'] ?>
										<?php else : ?>
											Loading
										<?php endif ?>
									</td>
								</tr>
								<tr>
									<td>
										<strong><?= $this->base->text('password', 'table') ?></strong>
									</td>
									<td class="d-flex justify-content-between">
										<code id="passwordHide1" class="">***************</code>
										<code id="passwordShow1" class="d-none">
											<?php if ($data['account_status'] === 'active') : ?>
												<?= $data['account_password'] ?>
											<?php else : ?>
												***************
											<?php endif ?>
										</code>
										<a class="btn btn-outline-primary btn-sm rounded trigger" data-hide="passwordHide1" data-show="passwordShow1">
											<?= $this->base->text('show_hide', 'label') ?>
										</a>
									</td>
								</tr>
								<tr>
									<td>
										<strong><?= $this->base->text('status', 'table') ?></strong>
									</td>
									<td>
										<?php if ($data['account_status'] == 'pending' or $data['account_status'] == 'deactivating' or $data['account_status'] == 'reactivating') : ?>
											<span class="badge bg-yellow">
												<?= $this->base->text($data['account_status'], 'table') ?>
											</span>
										<?php elseif ($data['account_status'] == 'active') : ?>
											<span class="badge bg-green">
												<?= $this->base->text($data['account_status'], 'table') ?>
											</span>
										<?php elseif ($data['account_status'] == 'deactivated' or $data['account_status'] == 'suspended') : ?>
											<span class="badge bg-red">
												<?= $this->base->text($data['account_status'], 'table') ?>
											</span>
										<?php endif ?>
									</td>
								</tr>
								<tr>
									<td>
										<strong><?= $this->base->text('main_domain', 'table') ?></strong>
									</td>
									<td>
										<?php if ($data['account_status'] === 'active') : ?>
											<?= $data['account_main'] ?>
										<?php else : ?>
											Loading
										<?php endif ?>
									</td>
								</tr>
								<tr>
									<td>
										<strong><?= $this->base->text('cpanel_domain', 'table') ?></strong>
									</td>
									<td>
										<?php if ($data['account_status'] === 'active') : ?>
											<?= $this->mofh->get_cpanel() ?>
										<?php else : ?>
											Loading
										<?php endif ?>
									</td>
								</tr>
								<tr>
									<td>
										<strong><?= $this->base->text('website_ip', 'table') ?></strong>
									</td>
									<td>
										<?php if ($data['account_status'] === 'active') : ?>
											<?= gethostbyname($data['account_main']) ?>
										<?php else : ?>
											Loading
										<?php endif ?>
									</td>
								</tr>
								<tr>
									<td>
										<strong><?= $this->base->text('created_on', 'table') ?></strong>
									</td>
									<td>
										<?php if ($data['account_status'] === 'active') : ?>
											<?= date('d-m-Y', $data['account_time']) ?>
										<?php else : ?>
											Loading
										<?php endif ?>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<div class="col-md-6">
					<div class="card">
						<div class="card-header">
							<div class="card-title"><?= $this->base->text('ftp_details', 'heading') ?></div>
						</div>
						<table class="table card-table">
							<tbody>
								<tr>
									<td width="30%">
										<strong><?= $this->base->text('username', 'table') ?></strong>
									</td>
									<td>
										<?php if ($data['account_status'] === 'active') : ?>
											<?= $data['account_username'] ?>
										<?php else : ?>
											Loading
										<?php endif ?>
									</td>
								</tr>
								<tr>
									<td>
										<strong><?= $this->base->text('password', 'table') ?></strong>
									</td>
									<td class="d-flex justify-content-between">
										<code id="passwordHide2" class="">***************</code>
										<code id="passwordShow2" class="d-none">
											<?php if ($data['account_status'] === 'active') : ?>
												<?= $data['account_password'] ?>
											<?php else : ?>
												***************
											<?php endif ?>
										</code>
										<a class="btn btn-outline-primary btn-sm rounded trigger" data-hide="passwordHide2" data-show="passwordShow2">
											<?= $this->base->text('show_hide', 'label') ?>
										</a>
									</td>
								</tr>
								<tr>
									<td>
										<strong><?= $this->base->text('hostname', 'table') ?></strong>
									</td>
									<td>
										<?php if ($data['account_status'] === 'active') : ?>
											ftpupload.net
										<?php else : ?>
											Loading
										<?php endif ?>
									</td>
								</tr>
								<tr>
									<td>
										<strong><?= $this->base->text('port', 'table') ?></strong>
									</td>
									<td>
										<?php if ($data['account_status'] === 'active') : ?>
											21
										<?php else : ?>
											Loading
										<?php endif ?>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<div class="col-md-6">
					<div class="card">
						<div class="card-header">
							<div class="card-title"><?= $this->base->text('mysql_details', 'heading') ?></div>
						</div>
						<table class="table card-table">
							<tbody>
								<tr>
									<td width="30%">
										<strong><?= $this->base->text('username', 'table') ?></strong>
									</td>
									<td>
										<?php if ($data['account_status'] === 'active') : ?>
											<?= $data['account_username'] ?>
										<?php else : ?>
											Loading
										<?php endif ?>
									</td>
								</tr>
								<tr>
									<td>
										<strong><?= $this->base->text('password', 'table') ?></strong>
									</td>
									<td class="d-flex justify-content-between">
										<code id="passwordHide3" class="">***************</code>
										<code id="passwordShow3" class="d-none">
											<?php if ($data['account_status'] === 'active') : ?>
												<?= $data['account_password'] ?>
											<?php else : ?>
												***************
											<?php endif ?>
										</code>
										<a class="btn btn-outline-primary btn-sm rounded trigger" data-hide="passwordHide3" data-show="passwordShow3">
											<?= $this->base->text('show_hide', 'label') ?>
										</a>
									</td>
								</tr>
								<tr>
									<td>
										<strong><?= $this->base->text('hostname', 'table') ?></strong>
									</td>
									<td>
										<?php if ($data['account_status'] === 'active') : ?>
											<?= str_replace('cpanel', $data['account_sql'], $this->mofh->get_cpanel()) ?>
										<?php else : ?>
											Loading
										<?php endif ?>
									</td>
								</tr>
								<tr>
									<td>
										<strong><?= $this->base->text('port', 'table') ?></strong>
									</td>
									<td>
										<?php if ($data['account_status'] === 'active') : ?>
											3306
										<?php else : ?>
											Loading
										<?php endif ?>
									</td>
								</tr>
								<tr>
									<td>
										<strong><?= $this->base->text('database_name', 'table') ?></strong>
									</td>
									<td>
										<?php if ($data['account_status'] === 'active') : ?>
											<?= $data['account_username'] ?>_xxx
										<?php else : ?>
											Loading
										<?php endif ?>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<div class="col-md-6">
					<div class="card">
						<div class="card-header">
							<div class="card-title"><?= $this->base->text('account_domains', 'heading') ?></div>
						</div>
						<table class="table card-table table-transparent">
							<thead>
								<tr>
									<th width="90%"><?= $this->base->text('domain', 'table') ?></th>
									<th width="10%"><?= $this->base->text('action', 'table') ?></th>
								</tr>
							</thead>
							<tbody>
								<?php if ($data['account_status'] === 'active') : ?>
									<?php $domains = $this->account->get_domains($data['account_username'], $data['account_password'], $data['account_domain']) ?>
									<?php if (count($domains) > 0) : ?>
										<?php foreach ($domains as $domain) : ?>
											<tr>
												<td>
													<span><?= $domain['domain'] ?></span>
												</td>
												<td class="row align-items-center">
													<a href="<?= $domain['file_manager'] ?>" class="btn btn-sm rounded btn-yellow col me-2" target="_blank"><em class="fa fa-file"></em></a>
													<?php if ($this->sp->is_active()) : ?>
														<a href="<?= base_url() . 'account/view/' . $data['account_username'] . '/?builder=true&domain=' . $domain['domain'] ?>" class="btn btn-red btn-sm rounded col" target="_blank"><em class="fa fa-upload"></em></a>
													<?php endif ?>
												</td>
											</tr>
										<?php endforeach ?>
									<?php elseif ($domains === false) : ?>
										<tr>
											<td colspan="2" class="text-center">Nothing to show</td>
										</tr>
									<?php else : ?>
										<tr>
											<td colspan="2" class="text-center">Nothing to show</td>
										</tr>
									<?php endif ?>
								<?php else : ?>
									<tr>
										<td colspan="2" class="text-center">Nothing to show</td>
									</tr>
								<?php endif ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	var coll = document.getElementsByClassName("trigger");
	var i;
	for (i = 0; i < coll.length; i++) {
		coll[i].addEventListener("click", function() {
			var hide = this.getAttribute("data-hide");
			var show = this.getAttribute("data-show");

			show = document.getElementById(show);
			hide = document.getElementById(hide);

			show.classList.toggle('d-none');
			hide.classList.toggle('d-none');
		});
	}
</script>
