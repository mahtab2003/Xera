<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<title><?= $this->base->text($title, 'title').' - '.$this->base->get_hostname() ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="icon" type="image/png" href="<?= base_url()?>assets/<?= $this->base->get_template() ?>/img/fav.png">
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/<?= $this->base->get_template() ?>/css/tabler.min.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/<?= $this->base->get_template() ?>/css/all.min.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/<?= $this->base->get_template() ?>/css/style.css">
</head>
<body class="theme-<?= get_cookie('theme', true)?>">
	<div class="page">