<?php
ob_start();
session_start();

if (isset($_SERVER['HTTPS'])) {
	$protocol = 'https://';
} else {
	$protocol = 'http://';
}
$hostname = $_SERVER['HTTP_HOST'];
$base_path = str_replace('install.php', '', $_SERVER['REQUEST_URI']);
$base_path = str_replace('?step=', '', $base_path);
$base_path = str_replace('1', '', $base_path);
$base_path = str_replace('2', '', $base_path);
$base_path = str_replace('3', '', $base_path);
$base_url = $protocol . $hostname . $base_path;
if (isset($_GET['step']) and $_GET['step'] == 1) {
	$title = 'Basic Settings - Xera Installation';
} elseif (isset($_GET['step']) and $_GET['step'] == 2) {
	$title = 'Database Settings - Xera Installation';
} elseif (isset($_GET['step']) and $_GET['step'] == 3) {
	$title = 'Next Step - Xera Installation';
} else {
	$title = 'Welcome to Xera Installation Page';
}
?>
<!DOCTYPE html>
<html lang="en" xml:lang="en">

<head>
	<title><?= $title ?></title>
	<link rel="stylesheet" type="text/css" href="<?= $base_url ?>assets/default/css/tabler.min.css">
	<link rel="stylesheet" type="text/css" href="<?= $base_url ?>assets/default/css/all.min.css">
	<link rel="stylesheet" type="text/css" href="<?= $base_url ?>assets/default/css/style.css">
	<meta name="robots" content="noindex" />
</head>

<body class="border-top-wide border-primary d-flex flex-column">
	<div class="page page-center">
		<div class="container-tight py-4">
			<div class="text-center mb-4">
				<a href="." class="navbar-brand navbar-brand-autodark">
					<img src="<?= $base_url ?>assets/default/img/logo.png" height="36" alt="">
				</a>
			</div>
			<div class="card card-md">
				<?php if (isset($_GET['step']) and $_GET['step'] == 1) : ?>
					<form action="<?= $base_url ?>install.php?step=1" method='POST'>
						<div class="card-body">
							<h2 class="card-title text-center mb-3">Basic Settings</h2>
							<div class="mb-3">
								<label class="form-label">Website URL</label>
								<input required type="text" name="base_url" class="form-control" placeholder="https://your.domain" value="<?= $base_url ?>">
							</div>
							<div class="mb-3">
								<label class="form-label">Cookie Prefix</label>
								<input required type="text" name="cookie_prefix" class="form-control" placeholder="xera_" value="xera_">
							</div>
							<div class="mb-3">
								<label class="form-label">Enable CSRF Protection</label>
								<select class="form-control" name="csrf">
									<option value="1" selected="true">Yes</option>
									<option value="0">No</option>
								</select>
							</div>
							<div class="form-footer mt-1">
								<input type="submit" name="submit" value="Next Step" class="btn btn-primary w-100">
							</div>
						</div>
					</form>
				<?php elseif (isset($_GET['step']) and $_GET['step'] == 2) : ?>
					<form action="<?= $base_url ?>install.php?step=2" method='POST'>
						<div class="card-body">
							<h2 class="card-title text-center mb-3">Database Settings</h2>
							<div class="mb-3">
								<label class="form-label">Hostname</label>
								<input required type="text" name="hostname" class="form-control" placeholder="https://sql.your.domain" value="localhost">
							</div>
							<div class="mb-3">
								<label class="form-label">Username</label>
								<input required type="text" name="username" class="form-control" placeholder="root">
							</div>
							<div class="mb-3">
								<label class="form-label">Password</label>
								<input type="text" name="password" class="form-control" placeholder="password">
							</div>
							<div class="mb-3">
								<label class="form-label">Database</label>
								<input required type="text" name="database" class="form-control" placeholder="xera">
							</div>
							<div class="form-footer mt-1">
								<input type="submit" name="submit" value="Next Step" class="btn btn-primary w-100">
							</div>
						</div>
					</form>
				<?php elseif (isset($_GET['step']) and $_GET['step'] == 3) : ?>
					<div class="card-body">
						<h2 class="card-title text-center mb-3">Welcome to Xera!</h2>
						<p class="text-muted mb-3">Xera has been installed successfully! Once you click on the button below, you will be redirected to the admin registration page and the install.php file will be deleted automatically.</p>
						<div class="form-footer mt-1">
							<a href="<?= $base_url ?>a/register" class="btn btn-primary w-100">Redirect</a>
						</div>
					</div>
				<?php else : ?>
					<div class="card-body">
						<h2 class="card-title text-center mb-3">Welcome to Xera!</h2>
						<p class="text-muted mb-3">Xera is a hosting account and support management system especially designed to work with MyOwnFreeHost and the GoGetSSL API. Please click on the button below to continue the installation.</p>
						<div class="form-footer mt-1">
							<a href="<?= $base_url ?>install.php?step=1" class="btn btn-primary w-100">Get Started</a>
						</div>
					</div>
				<?php endif ?>
			</div>
			<div class="text-center text-muted mt-3">
				&copy; Copyright <?= date('Y') ?>. Powered by NxNetwork Ltd.
			</div>
		</div>
	</div>
	<div class="hidden-area">
		<?php if (isset($_SESSION['msg'])) : ?>
			<?php $data = json_decode($_SESSION['msg'], true) ?>
			<div class="alert alert-<?= $data[0] ?> alert-dismissible" role="alert">
				<?= $data[1] ?>
				<a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
			</div>
			<?php unset($_SESSION['msg']) ?>
		<?php endif ?>
	</div>
	<script src="<?= $base_url ?>assets/default/js/jquery.slim.js"></script>
	<script src="<?= $base_url ?>assets/default/js/tabler.min.js"></script>
</body>

</html>
<?php
if (isset($_GET['step']) and $_GET['step'] == 1 and isset($_POST['submit'])) {
	$base_url_value = $_POST['base_url'];
	$cookie_prefix = $_POST['cookie_prefix'];
	$csrf = $_POST['csrf'];
	if (strpos($cookie_prefix, '_') !== strlen($cookie_prefix)) {
		$cookie_prefix = $cookie_prefix . '_';
	}
	if ($csrf == 0) {
		$csrf_value = 'FALSE';
	} else {
		$csrf_value = 'TRUE';
	}
	$file = file_get_contents('https://raw.githubusercontent.com/mahtab2003/Xera/dev/app/config/config.php');
	$data = str_replace('BASE_URL_VALUE', $base_url_value, $file);
	$data = str_replace('COOKIE_PREFIX_VALUE', $cookie_prefix, $data);
	$data = str_replace('CSRF_PROTECTION_MODE', $csrf_value, $data);
	$res = file_put_contents(__DIR__ . '/app/config/config.php', $data);
	$_SESSION['msg'] = json_encode(['success', 'Basic settings changed successfully.']);
	header('location: ' . $base_url . 'install.php?step=2');
} elseif (isset($_GET['step']) and $_GET['step'] == 2 and isset($_POST['submit'])) {
	$hostname = $_POST['hostname'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$database = $_POST['database'];
	$mysqli = mysqli_connect(
		$hostname,
		$username,
		$password,
		$database
	);
	if (!$mysqli) {
		$_SESSION['msg'] = json_encode(['danger', 'Database connect cannot be establised.']);
		header('location: ' . $base_url . 'install.php?step=2');
	} else {
		$sql = mysqli_query($mysqli, "CREATE TABLE `is_base` (`base_id` varchar(89) NOT NULL DEFAULT 'xera_base',`base_name` varchar(20) NOT NULL,`base_email` varchar(100) NOT NULL,`base_template` varchar(100) NOT NULL DEFAULT 'default', `base_fourm` varchar(100) NOT NULL,`base_status` varchar(8) NOT NULL, `base_rpp` int(10) NOT NULL DEFAULT '1'
);");

		$sql = mysqli_query($mysqli, "INSERT INTO `is_base` (`base_id`,`base_name`,`base_email`,`base_fourm`,`base_status`
		) VALUES ('xera_base','Web Host','abc@gmail.com','fourm.example.com','active'
		);");

		$sql = mysqli_query($mysqli, "DROP TABLE IF EXISTS `is_recaptcha`;");

		$sql = mysqli_query($mysqli, "CREATE TABLE `is_recaptcha` (`recaptcha_id` varchar(89) NOT NULL DEFAULT 'xera_recaptcha',`recaptcha_site` varchar(100) NOT NULL,`recaptcha_key` varchar(100) NOT NULL,`recaptcha_status` varchar(8) NOT NULL,`recaptcha_type` varchar(6) NOT NULL
		);");

		$sql = mysqli_query($mysqli, "INSERT INTO `is_recaptcha` (`recaptcha_id`,`recaptcha_site`,`recaptcha_key`,`recaptcha_status`,`recaptcha_type`
		) VALUES ('xera_recaptcha','site key','secret key','inactive','google'
		);");

		$sql = mysqli_query($mysqli, "DROP TABLE IF EXISTS `is_smtp`;");

		$sql = mysqli_query($mysqli, "CREATE TABLE `is_smtp` (`smtp_id` varchar(9) NOT NULL DEFAULT 'xera_smtp',`smtp_hostname` varchar(100) NOT NULL,`smtp_username` varchar(100) NOT NULL,`smtp_password` varchar(100) NOT NULL,`smtp_port` varchar(8) NOT NULL,`smtp_from` varchar(100) NOT NULL,`smtp_status` varchar(8) NOT NULL,`smtp_name` varchar(50) NOT NULL
		);");

		$sql = mysqli_query($mysqli, "INSERT INTO `is_smtp` (`smtp_id`,`smtp_hostname`,`smtp_username`,`smtp_password`,`smtp_port`,`smtp_from`,`smtp_status`,`smtp_name`
		) VALUES ('xera_smtp','smtp.example.com','username','password','587','jhon@example.com','inactive','Web Host'
		);");

		$sql = mysqli_query($mysqli, "DROP TABLE IF EXISTS `is_mofh`;");

		$sql = mysqli_query($mysqli, "CREATE TABLE `is_mofh` (`mofh_id` varchar(9) NOT NULL DEFAULT 'xera_mofh',`mofh_username` varchar(256) NOT NULL,`mofh_password` varchar(256) NOT NULL,`mofh_cpanel` varchar(100) NOT NULL,`mofh_ns_1` varchar(50) NOT NULL,`mofh_ns_2` varchar(50) NOT NULL,`mofh_package` varchar(50) NOT NULL
		);");

		$sql = mysqli_query($mysqli, "INSERT INTO `is_mofh` (`mofh_id`,`mofh_username`,`mofh_password`,`mofh_cpanel`,`mofh_ns_1`,`mofh_ns_2`,`mofh_package`
		) VALUES ('xera_mofh','username','password','cpanel','ns1','ns2','free'
		);");

		$sql = mysqli_query($mysqli, "DROP TABLE IF EXISTS `is_user`;");

		$sql = mysqli_query($mysqli, "CREATE TABLE `is_user` (`user_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,`user_name` varchar(50) NOT NULL,`user_email` varchar(100) NOT NULL,`user_password` varchar(100) NOT NULL,`user_key` varchar(16) NOT NULL,`user_rec` varchar(32) NOT NULL,`user_status` varchar(8) NOT NULL,`user_date` varchar(20) NOT NULL, `user_oauth` varchar(10) NOT NULL DEFAULT 'disabled'
		);");

		$sql = mysqli_query($mysqli, "DROP TABLE IF EXISTS `is_admin`;");

		$sql = mysqli_query($mysqli, "CREATE TABLE `is_admin` (`admin_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,`admin_name` varchar(50) NOT NULL,`admin_email` varchar(100) NOT NULL,`admin_password` varchar(100) NOT NULL,`admin_key` varchar(16) NOT NULL,`admin_rec` varchar(32) NOT NULL,`admin_status` varchar(8) NOT NULL,`admin_date` varchar(20) NOT NULL
		);");

		$sql = mysqli_query($mysqli, "DROP TABLE IF EXISTS `is_email`;");

		$sql = mysqli_query($mysqli, "CREATE TABLE `is_email` (`email_id` varchar(50) NOT NULL,`email_subject` varchar(200) NOT NULL,`email_content` varchar(10000) NOT NULL,`email_for` varchar(8) NOT NULL,`email_doc` varchar(500) NOT NULL
		);");

		$sql = mysqli_query($mysqli, "INSERT INTO `is_email` (`email_id`,`email_subject`,`email_content`,`email_for`,`email_doc`
		) VALUES ('new_user','Verification required','Hi {user_name}!<br> Your account needs to be verified in order to use our services.<br> <a href=\"{activation_link}\">click here</a><br> Regards {site_name}', 'user','{user_name} {user_email} {activation_link} {site_name} {site_url}'
		);");

		$sql = mysqli_query($mysqli, "INSERT INTO `is_email` (`email_id`,`email_subject`,`email_content`,`email_for`,`email_doc`
		) VALUES ('forget_password','Action required','Hi {user_name}!<br> You have requested a password reset.<br> New password: {new_password}<br> Regards {site_name}', 'user','{user_name} {user_email} {new_password} {site_name} {site_url}'
		);");

		$sql = mysqli_query($mysqli, "INSERT INTO `is_email` (`email_id`,`email_subject`,`email_content`,`email_for`,`email_doc`
		) VALUES ('forget_password','Action required','Hi {admin_name}!<br> You have requested a password reset.<br> New password: {new_password}<br> Regards {site_name}', 'admin',''
		); ");

		$sql = mysqli_query($mysqli, "INSERT INTO `is_email` (`email_id`,`email_subject`,`email_content`,`email_for`,`email_doc`
		) VALUES ('new_ticket','Ticket Created','Hi {site_name}!<br> A new ticket has been opened by {user_name}<br> <a href=\"{ticket_url}\">View Ticket</a> Regards {site_name}', 'admin','{site_name}, {site_url}, {ticket_url}, {ticket_id}, {user_name}'
		);");

		$sql = mysqli_query($mysqli, "INSERT INTO `is_email` (`email_id`,`email_subject`,`email_content`,`email_for`,`email_doc`
		) VALUES ('reply_ticket','Ticket Reply Received','Hi {user_name}!<br> A new ticket reply has been received on ticket ID {ticket_id}<br> <a href=\"{ticket_url}\">View Ticket</a> Regards {site_name}', 'user','{site_name}, {site_url}, {ticket_url}, {ticket_id}, {user_name}'
		);");

		$sql = mysqli_query($mysqli, "INSERT INTO `is_email` (`email_id`,`email_subject`,`email_content`,`email_for`,`email_doc`
		) VALUES ('reply_ticket','Ticket Reply Received','Hi {admin_name}!<br> A new ticket reply has been received on ticket ID {ticket_id}<br> <a href=\"{ticket_url}\">View Ticket</a> Regards {site_name}', 'admin','{site_name}, {site_url}, {ticket_url}, {ticket_id}, {admin_name}'
		);");

		$sql = mysqli_query($mysqli, "INSERT INTO `is_email` (`email_id`,`email_subject`,`email_content`,`email_for`,`email_doc`
		) VALUES ('account_created','Account Created','Hi {user_name}!<br> Account created successfully.<br> Regards {site_name}', 'user','{site_name}, {site_url}, {account_username}, {account_password}, {account_domain}, {main_domain}, {cpanel_domain}, {sql_server}, {nameserver_1}, {nameserver_2}, {account_label}, {user_name}, {user_email}'
		); ");

		$sql = mysqli_query($mysqli, "INSERT INTO `is_email` (`email_id`,`email_subject`,`email_content`,`email_for`,`email_doc`
		) VALUES ('account_suspended','Account Suspended','Hi {user_name}!<br> The account with the username {account_username} has been suspended due to {some_reason}. Please visit our client area for further inquiry.<br> Regards {site_name}', 'user','{site_name}, {site_url}, {account_username}, {user_name}, {user_email}, {some_reason}'
		); ");

		$sql = mysqli_query($mysqli, "INSERT INTO `is_email` (`email_id`,`email_subject`,`email_content`,`email_for`,`email_doc`
		) VALUES ('account_reactivated','Account Reactivated','Hi {user_name}!<br> The account with the username {account_username} has been reactivated. Please visit our client area for further inquiry.<br> Regards {site_name}', 'user','{site_name}, {site_url}, {account_username}, {user_name}, {user_email}'
		); ");

		$sql = mysqli_query($mysqli, "INSERT INTO `is_email` (`email_id`,`email_subject`,`email_content`,`email_for`,`email_doc`
		) VALUES ('delete_account','Account Deleted','Hi {user_name}!<br> The account with the username {account_username} has been deleted. Please visit our client area to create a new account.<br> Regards {site_name}', 'user','{site_name}, {site_url}, {account_username}, {user_name}, {user_email}'
		); ");

		$sql = mysqli_query($mysqli, "DROP TABLE IF EXISTS `is_ticket`;");

		$sql = mysqli_query($mysqli, "CREATE TABLE `is_ticket` (`ticket_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,`ticket_subject` varchar(300) NOT NULL,`ticket_content` varchar(10000) NOT NULL,`ticket_status` varchar(20) NOT NULL,`ticket_key` varchar(8) NOT NULL,`ticket_for` varchar(16) NOT NULL,`ticket_time` varchar(20) NOT NULL
		);");

		$sql = mysqli_query($mysqli, "DROP TABLE IF EXISTS `is_reply`;");

		$sql = mysqli_query($mysqli, "CREATE TABLE `is_reply` (`reply_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,`reply_content` varchar(10000) NOT NULL,`reply_by` varchar(16) NOT NULL,`reply_for` varchar(8) NOT NULL,`reply_time` int(20) NOT NULL
		);");

		$sql = mysqli_query($mysqli, "DROP TABLE IF EXISTS `is_account`;");

		$sql = mysqli_query($mysqli, "CREATE TABLE `is_account` (`account_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,`account_label` varchar(250) NOT NULL,`account_username` varchar(20) NOT NULL,`account_password` varchar(20) NOT NULL,`account_status` varchar(20) NOT NULL,`account_sql` varchar(6) NOT NULL DEFAULT 'sqlxxx',`account_key` varchar(8) NOT NULL,`account_for` varchar(16) NOT NULL,`account_time` varchar(20) NOT NULL,`account_domain` varchar(50) NOT NULL,`account_main` varchar(50) NOT NULL
		);");

		$sql = mysqli_query($mysqli, "DROP TABLE IF EXISTS `is_domain`;");

		$sql = mysqli_query($mysqli, "CREATE TABLE `is_domain` (`domain_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,`domain_name` varchar(100) NOT NULL
		);");

		$sql = mysqli_query($mysqli, "INSERT INTO `is_domain` (`domain_name`) VALUES ('.example.com');");

		$sql = mysqli_query($mysqli, "DROP TABLE IF EXISTS `is_builder`;");

		$sql = mysqli_query($mysqli, "CREATE TABLE `is_builder` (`builder_id` varchar(12) NOT NULL DEFAULT 'xera_builder',`builder_hostname` varchar(100) NOT NULL,`builder_username` varchar(100) NOT NULL,`builder_password` varchar(100) NOT NULL,`builder_status` varchar(8) NOT NULL
		);");

		$sql = mysqli_query($mysqli, "INSERT INTO `is_builder` (`builder_hostname`,`builder_username`,`builder_password`,`builder_status`
		) VALUES ('https://site.pro','username','password','inactive'
		);");

		$sql = mysqli_query($mysqli, "DROP TABLE IF EXISTS `is_gogetssl`;");

		$sql = mysqli_query($mysqli, "CREATE TABLE `is_gogetssl` (`gogetssl_id` varchar(13) NOT NULL DEFAULT 'xera_gogetssl',`gogetssl_username` varchar(100) NOT NULL,`gogetssl_password` varchar(100) NOT NULL,`gogetssl_status` varchar(8) NOT NULL
		);");

		$sql = mysqli_query($mysqli, "INSERT INTO `is_gogetssl` (`gogetssl_username`,`gogetssl_password`,`gogetssl_status`
		) VALUES ('username','password','inactive'
		);");

		$sql = mysqli_query($mysqli, "DROP TABLE IF EXISTS `is_ssl`;");

		$sql = mysqli_query($mysqli, "CREATE TABLE `is_ssl` (`ssl_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,`ssl_pid` varchar(250) NOT NULL,`ssl_key` varchar(20) NOT NULL,`ssl_for` varchar(20) NOT NULL
		);");

		$sql = mysqli_query($mysqli, "CREATE TABLE `is_oauth` (`oauth_id` varchar(20) NOT NULL, `oauth_client` varchar(100) NOT NULL, `oauth_secret` varchar(100) NOT NULL, `oauth_endpoint` varchar(100) NOT NULL, `oauth_status` varchar(8) NOT NULL);");
		$sql = mysqli_query($mysqli, "INSERT INTO `is_oauth`(`oauth_id`, `oauth_client`, `oauth_secret`, `oauth_endpoint`, `oauth_status`) VALUES ('github', 'client key', 'client key', 'https://api.github.com/user', 'inactive');");

		if ($sql) {
			$file = file_get_contents('https://raw.githubusercontent.com/mahtab2003/Xera/dev/app/config/database.php');
			$data = str_replace('DB_HOSTNAME', $hostname, $file);
			$data = str_replace('DB_USERNAME', $username, $data);
			$data = str_replace('DB_PASSWORD', $password, $data);
			$data = str_replace('DB_NAME', $database, $data);
			$res = file_put_contents(__DIR__ . '/app/config/database.php', $data);
			$json = json_encode(['installed' => true, 'time' => date('d-m-Y h:i:s A')]);
			file_put_contents(__DIR__ . '/app/logs/install.json', $json);
			$_SESSION['msg'] = json_encode(['success', 'Database connection established successfully.']);
			header('location: ' . $base_url . 'install.php?step=3');
		} else {
			$_SESSION['msg'] = json_encode(['danger', 'An error occured. Try again later.']);
			header('location: ' . $base_url . 'install.php?step=2');
		}
	}
}
?>
