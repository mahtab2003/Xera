<!DOCTYPE html>
<html>
<head>
	<title>Latest Version - <?= $this->base->get_hostname() ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="icon" type="image/png" href="<?= base_url()?>assets/<?= $this->base->get_template() ?>/img/fav.png">
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/<?= $this->base->get_template() ?>/css/tabler.min.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/<?= $this->base->get_template() ?>/css/all.min.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/<?= $this->base->get_template() ?>/css/style.css">
</head>
<body class="border-top-wide border-primary d-flex flex-column theme-<?= get_cookie('theme') ?? 'light' ?>">
	<div class="page page-center">
		<div class="container text-center">
			<div class="empty">
	        <div class="empty-header"><img src="<?= base_url()?>assets/<?= $this->base->get_template() ?>/img/xera.png" class="img-fluid"></div>
		        <p class="empty-title">Version <?= get_version() ?></p>
		        <p class="empty-subtitle text-muted">
		        	 You are using the latest version of Xera.
		        </p>
	        </div>
		</div>
	</div>
</body>
</html>