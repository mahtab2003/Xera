<!DOCTYPE html>
<html>
<head>
	<title>Not found - <?= $this->base->get_hostname() ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="icon" type="image/png" href="<?= base_url()?>assets/img/fav.png">
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/css/tabler.min.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/css/all.min.css">
</head>
<body class="border-top-wide border-primary d-flex flex-column theme-<?= get_cookie('theme') ?? 'light' ?>">
	<div class="page page-center">
		<div class="container text-center">
			<div class="empty">
	        <div class="empty-header">404</div>
		        <p class="empty-title">Oops… You just found an error page</p>
		        <p class="empty-subtitle text-muted">
		        	We are sorry but the page you are looking for was not found
		        </p>
	        </div>
		</div>
	</div>
</body>
</html>