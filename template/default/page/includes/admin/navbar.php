<nav class="navbar navbar-expand-md navbar-light d-print-none">
	<div class="container-xl">
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
			<span class="navbar-toggler-icon"></span>
		</button>
		<h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
			<a href="<?= base_url() ?>">
				<img src="<?= base_url() ?>assets/<?= $this->base->get_template() ?>/img/logo.png" width="110" height="32" alt="Logo" class="navbar-brand-image">
			</a>
		</h1>
		<div class="navbar-nav flex-row order-md-last">
			<div class="nav-item dropdown">
				<a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
					<span class="avatar avatar-sm" style="background-image: url(<?= $this->admin->get_avatar() ?>);"></span>
					<div class="d-none d-xl-block ps-2">
						<div><?= $this->admin->get_name() ?></div>
						<div class="mt-1 small text-muted">@<?= $this->admin->get_uid() ?></div>
					</div>
				</a>
				<div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
					<a href="<?= base_url() ?>admin/settings" class="dropdown-item">Settings</a>
					<a href="<?= base_url() ?>a/logout" class="dropdown-item">Logout</a>
				</div>
			</div>
		</div>
	</div>
</nav>
<div class="navbar-expand-md">
	<div class="collapse navbar-collapse" id="navbar-menu">
		<div class="navbar navbar-light">
			<div class="container-xl">
				<ul class="navbar-nav">
					<li class="nav-item <?php if (isset($active) and $active == 'home') : ?>
						active
					<?php endif ?>">
						<a class="nav-link" href="<?= base_url() ?>admin/">
							<span class="nav-link-icon d-md-none d-lg-inline-block">
								<i class="fa fa-home"></i>
							</span>
							<span class="nav-link-title">
								Home
							</span>
						</a>
					</li>
					<li class="nav-item <?php if (isset($active) and $active == 'client') : ?>
						active
					<?php endif ?>">
						<a class="nav-link" href="<?= base_url() ?>client/list">
							<span class="nav-link-icon d-md-none d-lg-inline-block">
								<i class="fa fa-users"></i>
							</span>
							<span class="nav-link-title">
								My Clients
							</span>
						</a>
					</li>
					<li class="nav-item <?php if (isset($active) and $active == 'account') : ?>
						active
					<?php endif ?>">
						<a class="nav-link" href="<?= base_url() ?>admin/account/list">
							<span class="nav-link-icon d-md-none d-lg-inline-block">
								<i class="fa fa-server"></i>
							</span>
							<span class="nav-link-title">
								MOFH Accounts
							</span>
						</a>
					</li>
					<?php if ($this->ssl->is_active()): ?>
						<li class="nav-item <?php if (isset($active) and $active == 'ssl') : ?>
							active
						<?php endif ?>">
							<a class="nav-link" href="<?= base_url() ?>admin/ssl/list">
								<span class="nav-link-icon d-md-none d-lg-inline-block">
									<em class="fa fa-shield-alt"></em>
								</span>
								<span class="nav-link-title">
									SSL Certificates
								</span>
							</a>
						</li>
					<?php endif ?>
					<li class="nav-item <?php if (isset($active) and $active == 'ticket') : ?>
						active
					<?php endif ?>">
						<a class="nav-link" href="<?= base_url() ?>admin/ticket/list">
							<span class="nav-link-icon d-md-none d-lg-inline-block">
								<i class="fa fa-bullhorn"></i>
							</span>
							<span class="nav-link-title">
								Support Tickets
							</span>
						</a>
					</li>
					<li class="nav-item dropdown <?php if (isset($active) and $active == 'settings') : ?>
						active
					<?php endif ?>">
						<a class="nav-link dropdown-toggle" href="#navbar-extra" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
							<span class="nav-link-icon d-md-none d-lg-inline-block">
								<i class="fa fa-book"></i>
							</span>
							<span class="nav-link-title">
								Settings
							</span>
						</a>
						<div class="dropdown-menu">
							<a class="dropdown-item" href="<?= base_url() ?>api/settings">
								API Settings
							</a>
							<a class="dropdown-item" href="<?= base_url() ?>email/templates">
								Email Templates
							</a>
							<a class="dropdown-item" href="<?= base_url() ?>domain/list">
								Domain Extensions
							</a>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>