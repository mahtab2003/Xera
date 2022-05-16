<!DOCTYPE html>
<html>
<head>
	<title>User inactive - <?= $this->base->get_hostname() ?></title>
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
	        <div class="empty-header"><i class="fa fa-envelope-open"></i></div>
		        <p class="empty-title">Oops… You just found an error page</p>
		        <p class="empty-subtitle text-muted">
		        	We are sorry but your account is inactive please check your inbox. <a href="<?= base_url() ?>/e/error_400?resend=true">resend email</a> or <a href="<?= base_url() ?>/e/error_400?logout=true">logout</a>
		        </p>
	        </div>
		</div>
	</div>
		<div class="hidden-area" style="position: fixed; bottom: 0; right: 0;">
		<?php  
		if(isset($_SESSION['msg'])){
			$msg = json_decode($_SESSION['msg'], true);
			if($msg[0] == 0)
			{
				$class = 'danger';
			}
			else
			{
				$class = 'success';
			}
			$message = $msg[1];
			echo '<div class="alert alert-'.$class.' alert-dismissible" role="alert">
				'.$message.'
				<a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
				</div>';
			unset($_SESSION['msg']);
		}
		?>
	</div>
</body>
</html>