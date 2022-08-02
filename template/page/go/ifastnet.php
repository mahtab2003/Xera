<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Redirecting - <?= $this->base->get_hostname() ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />

    <!-- ICONS-->
    <link rel="icon" type="image/png" href="<?= base_url() ?>assets/img/fav.png">
    <link rel="shortcut icon" type="image/png" href="<?= base_url() ?>assets/img/fav.png" />

    <!-- SEO -->
    <meta name="robots" content="noindex,nofollow" />

    <!-- SHORTCUTS & MOBILE OPTIMISATION-->
    <meta name="msapplication-TileColor" content="#206bc4" />
    <meta name="theme-color" content="#206bc4" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="mobile-web-app-capable" content="yes" />
    <meta name="HandheldFriendly" content="True" />
    <meta name="MobileOptimized" content="320" />

    <!-- CSS -->
    <link rel="icon" type="image/png" href="<?= base_url() ?>assets/img/fav.png">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/tabler.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/style.css">

    <!-- REDIRECTION -->
    <meta http-equiv="refresh" content="3; url = https://ifastnet.com/portal/aff.php?aff=28302" />
</head>

<body class="theme-<?= get_cookie('theme', true) ?> border-top-wide border-primary d-flex flex-column">
    <div class="page page-center">
        <div class="container text-center">
            <div class="empty">
                <div class="empty-header"><i class="fa-solid fa-diamond-turn-right"></i></div>
                <p class="empty-title">Redirecting</p>
                <p class="empty-subtitle text-muted">
                    We are redirecting you to the website: <strong>IFastNet</strong>
                </p>
            </div>
        </div>
    </div>
</body>

</html>
