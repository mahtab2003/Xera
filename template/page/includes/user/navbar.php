<nav class="navbar navbar-expand-md navbar-light d-print-none">
	<div class="container-xl">
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
			<span class="navbar-toggler-icon"></span>
		</button>
		<h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
			<a href="<?= base_url()?>">
				<img src="<?= base_url()?>assets/img/logo.png" width="110" height="32" alt="Logo" class="navbar-brand-image">
			</a>
		</h1>
		<div class="navbar-nav flex-row order-md-last">
			<div class="nav-item d-none d-md-flex me-3">
				<div class="btn-list">
					<a href="<?= base_url() ?>go/ifastnet" class="btn bg-orange" target="_blank">
						<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 512 512" stroke-width="2" stroke="currentColor" fill="currentColor" stroke-linecap="round" stroke-linejoin="round">
							<path stroke="none" d="M256 0C114.6 0 0 114.6 0 256s114.6 256 256 256c141.4 0 256-114.6 256-256S397.4 0 256 0zM382.8 246.1C380.3 252.1 374.5 256 368 256h-64v96c0 17.67-14.33 32-32 32h-32c-17.67 0-32-14.33-32-32V256h-64C137.5 256 131.7 252.1 129.2 246.1C126.7 240.1 128.1 233.3 132.7 228.7l112-112c6.248-6.248 16.38-6.248 22.62 0l112 112C383.9 233.3 385.3 240.1 382.8 246.1z" />
						</svg>
						Go premium
					</a>
				</div>
			</div>
			<div class="nav-item dropdown">
				<a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
					<span class="avatar avatar-sm" style="background-image: url(<?= $this->user->get_avatar() ?>);"></span>
					<div class="d-none d-xl-block ps-2">
						<div><?= $this->user->get_name() ?></div>
						<div class="mt-1 small text-muted">@<?= $this->user->get_uid() ?></div>
					</div>
				</a>
				<div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
					<a href="<?= base_url() ?>u/settings" class="dropdown-item">Settings</a>
					<a href="<?= base_url() ?>u/logout" class="dropdown-item">Logout</a>
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
					<li class="nav-item <?php if (isset($active) and $active == 'home'): ?>
						active
					<?php endif ?>">
						<a class="nav-link" href="<?= base_url() ?>u/dashboard" >
							<span class="nav-link-icon d-md-none d-lg-inline-block">
								<i class="fa fa-home"></i>
							</span>
							<span class="nav-link-title">
								Home
							</span>
						</a>
					</li>
					<li class="nav-item <?php if (isset($active) and $active == 'account'): ?>
						active
					<?php endif ?>">
						<a class="nav-link" href="<?= base_url() ?>u/accounts">
							<span class="nav-link-icon d-md-none d-lg-inline-block">
								<i class="fa fa-server"></i>
							</span>
							<span class="nav-link-title">
								Accounts
							</span>
						</a>
					</li>
					<?php if($this->ssl->is_active()): ?>
						<li class="nav-item <?php if (isset($active) and $active == 'ssl'): ?>
							active
						<?php endif ?>">
							<a class="nav-link" href="<?= base_url() ?>u/ssl">
								<span class="nav-link-icon d-md-none d-lg-inline-block">
									<i class="fa fa-shield-alt"></i>
								</span>
								<span class="nav-link-title">
									SSL Certificates
								</span>
							</a>
						</li>
					<?php endif ?>
					<li class="nav-item <?php if (isset($active) and $active == 'ticket'): ?>
						active
					<?php endif ?>">
						<a class="nav-link" href="<?= base_url() ?>u/tickets">
							<span class="nav-link-icon d-md-none d-lg-inline-block">
								<i class="fa fa-bullhorn"></i>
							</span>
							<span class="nav-link-title">
								Support Tickets
							</span>
						</a>
					</li>
					<li class="nav-item <?php if (isset($active) and $active == 'domain'): ?>
						active
					<?php endif ?>">
						<a class="nav-link" href="<?= base_url() ?>u/domain_checker">
							<span class="nav-link-icon d-md-none d-lg-inline-block">
								<i class="fa fa-globe"></i>
							</span>
							<span class="nav-link-title">
								Domain Checker
							</span>
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="<?= $this->base->get_fourm() ?>">
							<span class="nav-link-icon d-md-none d-lg-inline-block">
								<i class="fa fa-book"></i>
							</span>
							<span class="nav-link-title">
								Community Fourm
							</span>
						</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>
