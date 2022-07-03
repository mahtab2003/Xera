<!DOCTYPE html>
<html>
<head>
	<title>About Xera - <?= $this->base->get_hostname() ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="icon" type="image/png" href="<?= base_url()?>assets/img/fav.png">
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/css/tabler.min.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/css/all.min.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/css/style.css">
</head>
<body class="border-top-wide border-primary d-flex flex-column">
	<div class="page page-center">
		<div class="container text-center">
			<div class="empty">
	        <div class="empty-header"><img src="<?= base_url()?>assets/img/xera.png" class="img-fluid"></div>
		        <p class="empty-title">v<?= get_version() ?> <?= get_tag() ?></p>
		        <p class="empty-subtitle text-muted">
		        	 &copy; Copyright <?= date('Y') ?>. Powered by NxNetwork Ltd.
		        </p>
	        </div>
		</div>
	</div>
</body>
</html>