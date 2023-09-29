<!DOCTYPE html>
<html lang="en" xml:lang="en">

<head>
	<title><?= $this->base->text('user_inactive', 'title') ?> - <?= $this->base->get_hostname() ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="icon" type="image/png" href="<?= base_url() ?>assets/<?= $this->base->get_template() ?>/img/fav.png">
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/<?= $this->base->get_template() ?>/css/tabler.min.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/<?= $this->base->get_template() ?>/css/all.min.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/<?= $this->base->get_template() ?>/css/style.css">
</head>

<body class="border-top-wide border-primary d-flex flex-column theme-<?= get_cookie('theme') ?? 'light' ?>">
	<div class="page page-center">
		<div class="container text-center">
			<div class="empty">
				<div class="empty-header"><em class="fa fa-envelope-open"></em></div>
				<p class="empty-title"><?= $this->base->text('oops_note', 'paragraph') ?></p>
				<p class="empty-subtitle text-muted">
					<?= $this->base->text('user_inactive_note', 'paragraph') ?> <a href="<?= base_url() ?>400?resend=true"><?= $this->base->text('resend_email', 'button') ?></a> <?= $this->base->text('or', 'label') ?> <a href="<?= base_url() ?>400?logout=true"><?= $this->base->text('logout', 'button') ?></a>
				</p>
			</div>
		</div>
	</div>
	<div class="hidden-area" style="position: fixed; bottom: 0; right: 0;">
		<?php
		if (isset($_SESSION['msg'])) {
			$msg = json_decode($_SESSION['msg'], true);
			if ($msg[0] == 0) {
				$class = 'danger';
			} else {
				$class = 'success';
			}
			$message = $msg[1];
			echo '<div class="alert alert-' . $class . ' alert-dismissible" role="alert">
				' . $message . '
				<a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
				</div>';
			unset($_SESSION['msg']);
		}
		?>
	</div>
</body>

</html>