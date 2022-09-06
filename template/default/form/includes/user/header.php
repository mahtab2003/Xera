<!DOCTYPE html>
<html lang="en" xml:lang="en">

<head>
	<meta charset="utf-8" />
	<?php if ($this->base->text($title, 'title') !== '...') : ?>
		<?php $title = $this->base->text($title, 'title'); ?>
	<?php endif ?>
	<title><?= $title . ' - ' . $this->base->get_hostname() ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="icon" type="image/png" href="<?= base_url() ?>assets/<?= $this->base->get_template() ?>/img/fav.png">
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/<?= $this->base->get_template() ?>/css/tabler.min.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/<?= $this->base->get_template() ?>/css/all.min.css">
	<style type="text/css">
		.alert p {
			margin: 0;
		}
	</style>
</head>

<body class="border-top-wide border-primary d-flex flex-column theme-<?= get_cookie('theme') ?? 'light' ?>">
	<div class="page page-center">
		<div class="container-tight py-4">
			<div class="text-center mb-4">
				<a href="." class="navbar-brand navbar-brand-autodark"><img src="<?= base_url() ?>assets/<?= $this->base->get_template() ?>/img/logo.png" height="36" alt=""></a>
			</div>
