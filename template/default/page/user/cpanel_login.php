<!DOCTYPE html>
<html lang="en" xml:lang="en">

<head>
	<title><?= $this->base->text('cpanel_login', 'title') ?>(<?= $username ?>) - <?= $this->base->get_hostname() ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="icon" type="image/png" href="<?= base_url() ?>assets/<?= $this->base->get_template() ?>/img/fav.png">
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/<?= $this->base->get_template() ?>/css/tabler.min.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/<?= $this->base->get_template() ?>/css/all.min.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/<?= $this->base->get_template() ?>/css/style.css">
	<meta name="robots" content="noindex" />
</head>

<body class="border-top-wide border-primary d-flex flex-column theme-<?= get_cookie('theme') ?? 'light' ?>">
	<div class="page page-center">
		<div class="container text-center">
			<div class="empty">
				<div class="empty-header"><i class="fa fa-cog"></i></div>
				<p class="empty-title"><?= $this->base->text('login_to_cpanel', 'heading') ?></p>
				<p class="empty-subtitle text-muted">
					<?= $this->base->text('cpanel_login', 'paragraph') ?>
				<form action="https://<?= $this->mofh->get_cpanel() ?>/login.php" method="post" id="form" name="login">
					<input type="hidden" name="uname" value="<?= $username ?>" alt="username">
					<input type="hidden" name="passwd" value="<?= $password ?>" alt="password">
					<div class="text-center d-grid">
						<button class="btn btn-primary"><?= $this->base->text('redirect_now', 'button') ?></button>
					</div>
				</form>
				</p>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		document.getElementById('form').submit(); // SUBMIT FORM 
	</script>
</body>

</html>