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
						<a <?php if ($data['account_status'] === 'active') : ?>href="<?= base_url() ?>admin/account/view/<?= $id ?>?login=true" target="_blank" <?php else : ?> href="#" disabled class="btn btn-primary rounded disabled" <?php endif ?> class="btn btn-primary rounded"><i class="fa fa-globe me-2"></i> Control Panel</a>
					</div>
					<div class="d-grid mb-2">
						<a <?php if ($data['account_status'] === 'active') : ?>href="<?= $this->account->create_fm_link($data['account_username'], $data['account_password']) ?>" target="_blank" <?php else : ?> class="disabled btn btn-yellow rounded" href="#" disabled <?php endif ?> class="btn btn-green rounded"><i class="fa fa-file me-2"></i> File Manager</a>
					</div>
					<?php if ($data['account_status'] === 'active') : ?>
						<div class="d-grid mb-2">
							<a href="<?= base_url() ?>admin/account/settings/<?= $id ?>" target="_blank" class="btn btn-yellow rounded"><i class="fa fa-cogs me-2"></i> Settings</a>
						</div>
					<?php elseif ($data['account_status'] === 'suspended' or $data['account_status'] === 'deactivated') : ?>
						<div class="d-grid mb-2">
							<a href="<?= base_url() ?>admin/account/view/<?= $id ?>?reactivate=true" class="btn btn-green rounded"><i class="fa fa-cog me-2"></i> Reactivate</a>
						</div>
					<?php else : ?>
						<div class="d-grid mb-2">
							<a href="#" class="btn btn-yellow disabled rounded"><i class="fa fa-cogs me-2"></i> Settings</a>
						</div>
					<?php endif ?>
				</div>
			</div>
		</div>
		<div class="col-md-8 mb-2">
			<?php $time = $data['account_time'] + 3600; ?>
			<?php if ($time > time()) : ?>
				<div class="alert alert-success">
					Some of the hosting features may not work. It may take up to 72 hours for the account to work properly...
				</div>
			<?php endif; ?>
			<?php if ($data['account_status'] === 'pending') : ?>
				<div class="alert alert-info">
					This hosting account is pending activation and will be activated soon...
				</div>
			<?php elseif ($data['account_status'] === 'reactivating') : ?>
				<div class="alert alert-warning">
					This hosting account is reactivating and will be activated soon...
				</div>
			<?php elseif ($data['account_status'] === 'deactivating') : ?>
				<div class="alert alert-warning">
					This hosting account is deactivating and will be deactivated soon...
				</div>
			<?php elseif ($data['account_status'] === 'suspended') : ?>
				<div class="alert alert-danger">
					This hosting account is suspended due to the reason provided in your email and will be completely removed within 30 days...
				</div>
			<?php elseif ($data['account_status'] === 'deactivated') : ?>
				<div class="alert alert-success">
					This hosting account is deactivated and will be completely removed within 30 days...
				</div>
			<?php endif; ?>
			<div class="row row-cards">
				<div class="col-md-6">
					<div class="card">
						<div class="card-header">
							<div class="card-title">Account Details</div>
						</div>
						<table class="table card-table">
							<tbody>
								<tr>
									<td width="30%">
										<strong>Username</strong>
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
										<strong>Password</strong>
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
										<a class="btn btn-outline-primary btn-sm trigger" data-hide="passwordHide1" data-show="passwordShow1">
											Show/Hide
										</a>
									</td>
								</tr>
								<tr>
									<td>
										<strong>Status</strong>
									</td>
									<td>
										<?php if ($data['account_status'] == 'pending' or $data['account_status'] == 'deactivating' or $data['account_status'] == 'reactivating') : ?>
											<span class="badge bg-yellow">
												<?= $data['account_status'] ?>
											</span>
										<?php elseif ($data['account_status'] == 'active') : ?>
											<span class="badge bg-green">
												<?= $data['account_status'] ?>
											</span>
										<?php elseif ($data['account_status'] == 'deactivated' or $data['account_status'] == 'suspended') : ?>
											<span class="badge bg-red">
												<?= $data['account_status'] ?>
											</span>
										<?php endif ?>
									</td>
								</tr>
								<tr>
									<td>
										<strong>Main Domain</strong>
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
										<strong>cPanel Domain</strong>
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
										<strong>Website IP</strong>
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
										<strong>Created on</strong>
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
							<div class="card-title">FTP Details</div>
						</div>
						<table class="table card-table">
							<tbody>
								<tr>
									<td width="30%">
										<strong>Username</strong>
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
										<strong>Password</strong>
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
										<a class="btn btn-outline-primary btn-sm trigger" data-hide="passwordHide2" data-show="passwordShow2">
											Show/Hide
										</a>
									</td>
								</tr>
								<tr>
									<td>
										<strong>Hostname</strong>
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
										<strong>Port</strong>
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
							<div class="card-title">MySQL Details</div>
						</div>
						<table class="table card-table">
							<tbody>
								<tr>
									<td width="30%">
										<strong>Username</strong>
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
										<strong>Password</strong>
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
										<a class="btn btn-outline-primary btn-sm trigger" data-hide="passwordHide3" data-show="passwordShow3">
											Show/Hide
										</a>
									</td>
								</tr>
								<tr>
									<td>
										<strong>Hostname</strong>
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
										<strong>Port</strong>
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
										<strong>Database Name</strong>
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
							<div class="card-title">Account Domains</div>
						</div>
						<table class="table card-table table-transparent">
							<thead>
								<tr>
									<th width="90%">Domain</th>
									<th width="10%">Action</th>
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
													<a href="<?= $domain['file_manager'] ?>" class="btn btn-sm btn-yellow col" target="_blank"><em class="fa fa-file"></em></a>
													<?php if ($this->sp->is_active()) : ?>
														<a href="<?= base_url() . 'admin/account/view/' . $data['account_username'] . '/?builder=true&domain=' . $domain['domain'] ?>" class="btn btn-red btn-sm col" target="_blank"><i class="fa fa-upload"></i></a>
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