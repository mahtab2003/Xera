<div class="container-xl">
	<div class="page-header d-print-none">
        <h2 class="page-title py-3">
            <?= $this->base->text('api_settings', 'title') ?>
        </h2>
	</div>
	<div class="card">
		<ul class="nav nav-tabs nav-fill">
			<li class="nav-item">
				<a href="#general" class="nav-link <?php if (empty($_GET)) : ?>
					active
                <?php endif ?>" data-bs-toggle="tab"><em class="fa fa-cogs me-2"></em><?= $this->base->text('general', 'heading') ?></a>
			</li>
			<li class="nav-item">
				<a href="#mofh" class="nav-link <?php if ($this->input->get('mofh')) : ?>
					active
                <?php endif ?>" data-bs-toggle="tab"><em class="fa fa-network-wired me-2"></em><?= $this->base->text('myownfreehost', 'heading') ?></a>
			</li>
			<li class="nav-item">
				<a href="#smtp" class="nav-link <?php if ($this->input->get('smtp')) : ?>
					active
                <?php endif ?>" data-bs-toggle="tab"><em class="fa fa-envelope me-2"></em><?= $this->base->text('simple_mailer', 'heading') ?></a>
			</li>
			<li class="nav-item">
				<a href="#captcha" class="nav-link <?php if ($this->input->get('captcha')) : ?>
					active
                <?php endif ?>" data-bs-toggle="tab"><em class="fa fa-robot me-2"></em><?= $this->base->text('bot_protection', 'heading') ?></a>
			</li>
			<li class="nav-item">
				<a href="#ssl" class="nav-link <?php if ($this->input->get('ssl')) : ?>
					active
                <?php endif ?>" data-bs-toggle="tab"><em class="fa fa-shield-alt me-2"></em><?= $this->base->text('ssl_certificates', 'heading') ?></a>
			</li>
			<li class="nav-item">
				<a href="#acme" class="nav-link <?php if ($this->input->get('acme')) : ?>
					active
                <?php endif ?>" data-bs-toggle="tab"><em class="fa fa-shield-alt me-2"></em><?= $this->base->text('ssl_certificates_acme', 'heading') ?></a>
			</li>
			<li class="nav-item">
				<a href="#sitepro" class="nav-link <?php if ($this->input->get('sitepro')) : ?>
					active
                <?php endif ?>" data-bs-toggle="tab"><em class="fa fa-brush me-2"></em><?= $this->base->text('site_builder', 'heading') ?></a>
			</li>
			<li class="nav-item">
				<a href="#oauth" class="nav-link <?php if ($this->input->get('oauth')) : ?>
					active
                <?php endif ?>" data-bs-toggle="tab"><em class="fab fa-github me-2"></em><?= $this->base->text('oauth2', 'heading') ?></a>
			</li>
		</ul>
		<div class="card-body tab-content p-4">
			<div class="tab-pane <?php if (empty($_GET)) : ?>
				active
			<?php endif ?>" id="general">
				<?= form_open('api/settings') ?>
				<div class="row">
					<div class="col-sm-6">
                        <label class="form-label"><?= $this->base->text('host_name', 'label') ?></label>
						<input type="text" name="hostname" class="form-control mb-2" value="<?= $this->base->get_hostname() ?>">
					</div>
					<div class="col-sm-6">
                        <label class="form-label"><?= $this->base->text('alert_email', 'label') ?></label>
						<input type="text" name="email" class="form-control mb-2" value="<?= $this->base->get_email() ?>">
					</div>
					<div class="col-sm-6">
                        <label class="form-label"><?= $this->base->text('forum_url', 'label') ?></label>
						<input type="text" name="fourm" class="form-control mb-2" value="<?= $this->base->get_fourm() ?>">
					</div>
					<div class="col-sm-6">
                        <label class="form-label"><?= $this->base->text('host_status', 'label') ?></label>
						<select class="form-control mb-2" name="status">
							<?php
							if ($this->base->get_status() === 'active') :
							?>
                                <option value="1" selected="true"><?= $this->base->text('active', 'table') ?></option>
                                <option value="0"><?= $this->base->text('inactive', 'table') ?></option>
							<?php
							else :
							?>
                                <option value="1"><?= $this->base->text('active', 'table') ?></option>
                                <option value="0" selected="true"><?= $this->base->text('inactive', 'table') ?></option>
							<?php
							endif;
							?>
						</select>
					</div>
					<div class="col-sm-6">
                        <label class="form-label"><?= $this->base->text('template_dir', 'label') ?></label>
						<select class="form-control mb-2" name="template">
							<?php foreach (get_templates() as $dir) : ?>
								<?php if ($dir['dir'] == $this->base->get_template()) : ?>
									<option value="<?= $dir['dir'] ?>" selected="true"><?= $dir['name'] ?></option>
								<?php else : ?>
									<option value="<?= $dir['dir'] ?>"><?= $dir['name'] ?></option>
								<?php endif ?>
							<?php endforeach ?>
						</select>
					</div>
					<div class="col-sm-6">
                        <label class="form-label"><?= $this->base->text('records_per_page', 'label') ?></label>
						<input type="number" name="rpp" class="form-control mb-2" value="<?= $this->base->rpp() ?>">
					</div>
					<div class="col-sm-12">
                        <input type="submit" name="update_host" value="<?= $this->base->text('change', 'button') ?>" class="btn btn-primary btn-pill">
					</div>
				</div>
				</form>
			</div>
			<div class="tab-pane <?php if ($this->input->get('mofh')) : ?>
				active
			<?php endif ?>" id="mofh">
				<?= form_open('api/settings') ?>
				<div class="row">
					<div class="col-sm-6">
                        <label class="form-label"><?= $this->base->text('username', 'label') ?></label>
						<input type="text" name="username" class="form-control mb-2" value="<?= $this->mofh->get_username() ?>">
					</div>
					<div class="col-sm-6">
                        <label class="form-label"><?= $this->base->text('password', 'label') ?></label>
						<input type="text" name="password" class="form-control mb-2" value="<?= $this->mofh->get_password() ?>">
					</div>
					<div class="col-sm-6">
                        <label class="form-label"><?= $this->base->text('cpanel_url', 'label') ?></label>
						<input type="text" name="cpanel" class="form-control mb-2" value="<?= $this->mofh->get_cpanel() ?>">
					</div>
					<div class="col-sm-6">
                        <label class="form-label"><?= $this->base->text('nameserver_1', 'label') ?></label>
						<input type="text" name="ns_1" class="form-control mb-2" value="<?= $this->mofh->get_ns_1() ?>">
					</div>
					<div class="col-sm-6">
                        <label class="form-label"><?= $this->base->text('nameserver_2', 'label') ?></label>
						<input type="text" name="ns_2" class="form-control mb-2" value="<?= $this->mofh->get_ns_2() ?>">
					</div>
					<div class="col-sm-6">
                        <label class="form-label"><?= $this->base->text('package', 'label') ?></label>
						<input type="text" name="package" class="form-control mb-2" value="<?= $this->mofh->get_package() ?>">
					</div>
					<div class="col-sm-6">
                        <label class="form-label"><?= $this->base->text('shared_ip', 'label') ?></label>
						<input type="text" name="email" class="form-control mb-2" value="<?= gethostbyname($_SERVER['HTTP_HOST']); ?>" readonly>
					</div>
					<div class="col-sm-6">
                        <label class="form-label"><?= $this->base->text('callback_url', 'label') ?></label>
						<input type="text" name="callback" class="form-control mb-2" value="<?= base_url() ?>c/mofh" readonly>
					</div>
					<div class="col-sm-12">
                        <input type="submit" name="update_mofh" value="<?= $this->base->text('change', 'button') ?>" class="btn btn-primary btn-pill">
                        <a href="?test_mofh=true" class="btn btn-success btn-pill"><?= $this->base->text('test_connection', 'button') ?></a>
					</div>
				</div>
				</form>
			</div>
			<div class="tab-pane <?php if ($this->input->get('smtp')) : ?>
				active
			<?php endif ?>" id="smtp">
				<?= form_open('api/settings') ?>
				<div class="row">
					<div class="col-sm-6">
                        <label class="form-label"><?= $this->base->text('service_type', 'label') ?></label>
						<select class="form-control" name="type">
							<option selected="true">SMTP</option>
						</select>
					</div>
					<div class="col-sm-6">
                        <label class="form-label"><?= $this->base->text('hostname', 'table') ?></label>
						<input type="text" name="hostname" class="form-control mb-2" value="<?= $this->smtp->get_hostname() ?>">
					</div>
					<div class="col-sm-6">
                        <label class="form-label"><?= $this->base->text('username', 'label') ?></label>
						<input type="text" name="username" class="form-control mb-2" value="<?= $this->smtp->get_username() ?>">
					</div>
					<div class="col-sm-6">
                        <label class="form-label"><?= $this->base->text('password', 'label') ?></label>
						<input type="text" name="password" class="form-control mb-2" value="<?= $this->smtp->get_password() ?>">
					</div>
					<div class="col-sm-6">
                        <label class="form-label"><?= $this->base->text('from_email', 'label') ?></label>
						<input type="text" name="from" class="form-control mb-2" value="<?= $this->smtp->get_from() ?>">
					</div>
					<div class="col-sm-6">
                        <label class="form-label"><?= $this->base->text('from_name', 'label') ?></label>
						<input type="text" name="name" class="form-control mb-2" value="<?= $this->smtp->get_name() ?>">
					</div>
					<div class="col-sm-6">
                        <label class="form-label"><?= $this->base->text('smtp_port', 'label') ?></label>
						<input type="number" name="port" class="form-control mb-2" value="<?= $this->smtp->get_port() ?>">
					</div>
                    <div class="col-sm-6">
                        <label class="form-label"><?= $this->base->text('smtp_encryption', 'label') ?></label>
						<select class="form-control mb-2" name="encryption">
							<?php
							if ($this->smtp->get_encryption() === 'ssl') {
							?>
                                <option value="ssl" selected="true">SSL</option>
                                <option value="tls">TLS</option>
                                <option value="none"><?= $this->base->text('none', 'label') ?></option>
							<?php
                            }
							elseif ($this->smtp->get_encryption() === 'tls') {
							?>
                                <option value="ssl">SSL</option>
                                <option value="tls" selected="true">TLS</option>
                                <option value="none"><?= $this->base->text('none', 'label') ?></option>
  						    <?php
                            }
							elseif ($this->smtp->get_encryption() === 'none') {
							?>
                                <option value="ssl">SSL</option>
                                <option value="tls">TLS</option>
                                <option value="none" selected="true"><?= $this->base->text('none', 'label') ?></option>
							<?php
							}
							?>
						</select>
					</div>
					<div class="col-sm-6">
                        <label class="form-label"><?= $this->base->text('smtp_status', 'label') ?></label>
						<select class="form-control mb-2" name="status">
							<?php
							if ($this->smtp->get_status() === 'active') :
							?>
                                <option value="1" selected="true"><?= $this->base->text('active', 'table') ?></option>
                                <option value="0"><?= $this->base->text('inactive', 'table') ?></option>
							<?php
							else :
							?>
                                <option value="1"><?= $this->base->text('active', 'table') ?></option>
                                <option value="0" selected="true"><?= $this->base->text('inactive', 'table') ?></option>
							<?php
							endif;
							?>
						</select>
					</div>
					<div class="col-sm-12">
                        <input type="submit" name="update_smtp" value="<?= $this->base->text('change', 'button') ?>" class="btn btn-primary btn-pill">
                        <a href="?test_mail=true" class="btn btn-success btn-pill"><?= $this->base->text('test_connection', 'button') ?></a>
					</div>
				</div>
				</form>
			</div>
			<div class="tab-pane <?php if ($this->input->get('captcha')) : ?>
				active
			<?php endif ?>" id="captcha">
				<?= form_open('api/settings') ?>
				<div class="row">
					<div class="col-sm-6">
                        <label class="form-label"><?= $this->base->text('captcha_type', 'label') ?></label>
						<select class="form-control mb-2" name="type">
							<?php
							if ($this->grc->get_type() === 'google') :
							?>
								<option value="google" selected="true">Google reCAPTCHA</option>
								<option value="human">hCaptcha</option>
								<option value="crypto">CryptoLoot</option>
								<option value="turnstile">Cloudflare Turnstile</option>
							<?php
							elseif ($this->grc->get_type() === 'human') :
							?>
								<option value="google">Google reCAPTCHA</option>
								<option value="human" selected="true">hCaptcha</option>
								<option value="crypto">CryptoLoot</option>
								<option value="turnstile">Cloudflare Turnstile</option>
							<?php
							elseif ($this->grc->get_type() === 'crypto') :
							?>
								<option value="google">Google reCAPTCHA</option>
								<option value="human">hCaptcha</option>
								<option value="crypto" selected="true">CryptoLoot</option>
								<option value="turnstile">Cloudflare Turnstile</option>
							<?php
							elseif ($this->grc->get_type() === 'turnstile') :
							?>
								<option value="google">Google reCAPTCHA</option>
								<option value="human">hCaptcha</option>
								<option value="crypto">CryptoLoot</option>
								<option value="turnstile" selected="true">Cloudflare Turnstile</option>
							<?php
							endif;
							?>
						</select>
					</div>
					<div class="col-sm-6">
                        <label class="form-label"><?= $this->base->text('site_key', 'label') ?></label>
						<input type="text" name="site_key" class="form-control mb-2" value="<?= $this->grc->get_site_key() ?>">
					</div>
					<div class="col-sm-6">
                        <label class="form-label"><?= $this->base->text('secret_key', 'label') ?></label>
						<input type="text" name="secret_key" class="form-control mb-2" value="<?= $this->grc->get_secret_key() ?>">
					</div>
					<div class="col-sm-6">
                        <label class="form-label"><?= $this->base->text('status', 'table') ?></label>
						<select class="form-control mb-2" name="status">
							<?php
							if ($this->grc->get_status() === 'active') :
							?>
								<option value="1" selected="true">Active</option>
								<option value="0">Inactive</option>
							<?php
							else :
							?>
								<option value="1">Active</option>
								<option value="0" selected="true">Inactive</option>
							<?php
							endif;
							?>
						</select>
					</div>
					<div class="col-sm-12">
                        <input type="submit" name="update_grc" value="<?= $this->base->text('change', 'button') ?>" class="btn btn-primary btn-pill">
					</div>
				</div>
				</form>
			</div>
			<div class="tab-pane <?php if ($this->input->get('ssl')) : ?>
				active
			<?php endif ?>" id="ssl">
				<?= form_open('api/settings') ?>
				<div class="row">
					<div class="col-sm-6">
                        <label class="form-label"><?= $this->base->text('ssl_type', 'label') ?></label>
						<select class="form-control mb-2" name="type">
							<option value="1" selected="true">GoGetSSL</option>
						</select>
					</div>
					<div class="col-sm-6">
                        <label class="form-label"><?= $this->base->text('username', 'label') ?></label>
						<input type="text" name="username" class="form-control mb-2" value="<?= $this->ssl->get_username() ?>">
					</div>
					<div class="col-sm-6">
                        <label class="form-label"><?= $this->base->text('password', 'label') ?></label>
						<input type="text" name="password" class="form-control mb-2" value="<?= $this->ssl->get_password() ?>">
					</div>
					<div class="col-sm-6">
                        <label class="form-label"><?= $this->base->text('status', 'table') ?></label>
						<select class="form-control mb-2" name="status">
							<?php
							if ($this->ssl->get_status() === 'active') :
							?>
								<option value="1" selected="true">Active</option>
								<option value="0">Inactive</option>
							<?php
							else :
							?>
								<option value="1">Active</option>
								<option value="0" selected="true">Inactive</option>
							<?php
							endif;
							?>
						</select>
					</div>
					<div class="col-sm-12">
                        <input type="submit" name="update_ssl" value="<?= $this->base->text('change', 'button') ?>" class="btn btn-primary btn-pill">
					</div>
				</div>
				</form>
			</div>
			<div class="tab-pane <?php if ($this->input->get('acme')) : ?>
				active
			<?php endif ?>" id="acme">
				<?= form_open('api/settings') ?>
				<div class="row">
                <div class="hr-text text-green">Let's Encrypt</div>
					<div class="col-sm-12">
                        <label class="form-label"><?= $this->base->text('directory_url', 'label') ?></label>
						<input type="text" name="letsencrypt" class="form-control mb-2" value="<?= $this->acme->get_letsencrypt() ?>">
					</div>
                <div class="hr-text text-green">ZeroSSL</div>
					<?php
						$zerossl = $this->acme->get_zerossl();
						if ($zerossl == 'not-set') {
							$zerossl = [
								'url' => '',
								'eab_kid' => '',
								'eab_hmac_key' => ''
							];
						}
					?>
					<div class="col-sm-6">
                        <label class="form-label"><?= $this->base->text('directory_url', 'label') ?></label>
						<input type="text" name="zerossl_url" class="form-control mb-2" value="<?= $zerossl['url'] ?>">
					</div>
					<div class="col-sm-6">
                        <label class="form-label"><?= $this->base->text('eab_key_id', 'label') ?></label>
						<input type="text" name="zerossl_kid" class="form-control mb-2" value="<?= $zerossl['eab_kid'] ?>">
					</div>
					<div class="col-sm-12">
                        <label class="form-label"><?= $this->base->text('eab_hmac_key', 'label') ?></label>
						<input type="text" name="zerossl_hmac" class="form-control mb-2" value="<?= $zerossl['eab_hmac_key'] ?>">
					</div>
                <div class="hr-text text-green">Google Trust</div>
					<?php
						$googletrust = $this->acme->get_googletrust();
						if ($googletrust == 'not-set') {
							$googletrust = [
								'url' => '',
								'eab_kid' => '',
								'eab_hmac_key' => ''
							];
						}
					?>
					<div class="col-sm-6">
                        <label class="form-label"><?= $this->base->text('directory_url', 'label') ?></label>
						<input type="text" name="googletrust_url" class="form-control mb-2" value="<?= $googletrust['url'] ?>">
					</div>
					<div class="col-sm-6">
                        <label class="form-label"><?= $this->base->text('eab_key_id', 'label') ?></label>
						<input type="text" name="googletrust_kid" class="form-control mb-2" value="<?= $googletrust['eab_kid'] ?>">
					</div>
					<div class="col-sm-12">
                        <label class="form-label"><?= $this->base->text('eab_hmac_key', 'label') ?></label>
						<input type="text" name="googletrust_hmac" class="form-control mb-2" value="<?= $googletrust['eab_hmac_key'] ?>">
					</div>
                <div class="hr-text text-green">ACME</div>
					<?php
						$dnsSettings = $this->acme->get_dns();
					?>
					<div class="col-sm-6">
                        <label class="form-label"><?= $this->base->text('dns_over_https', 'label') ?></label>
						<select class="form-control mb-2" name="dns_doh">
							<?php
							if ($dnsSettings['doh'] === 'active') :
							?>
                                <option value="active" selected="true"><?= $this->base->text('active', 'table') ?></option>
                                <option value="inative"><?= $this->base->text('inactive', 'table') ?></option>
							<?php
							else :
							?>
								<option value="active">Active</option>
								<option value="inative" selected="true">Inactive</option>
							<?php
							endif;
							?>
						</select>
                        <p><?= $this->base->text('use_doh_hint', 'paragraph') ?></p>
					</div>
					<div class="col-sm-6">
                        <label class="form-label"><?= $this->base->text('dns_resolver', 'label') ?></label>
						<input type="text" name="dns_resolver" class="form-control mb-2" value="<?= $dnsSettings['resolver'] ?>">
                        <p><?= $this->base->text('dns_over_https_normal', 'paragraph') ?></p>
                        <p><?= $this->base->text('google_public_dns', 'paragraph') ?></p>
                        <ul>
                            <li><?= $this->base->text('normal_dns', 'paragraph') ?> 8.8.8.8</li>
                            <li><?= $this->base->text('dns_over_https', 'paragraph') ?> dns.google</li>
                        </ul>
					</div>
					<div class="col-sm-12">
                        <label class="form-label"><?= $this->base->text('status', 'table') ?></label>
						<select class="form-control mb-2" name="status">
							<?php
							if ($this->acme->get_status() === 'active') :
							?>
								<option value="1" selected="true">Active</option>
								<option value="0">Inactive</option>
							<?php
							else :
							?>
								<option value="1">Active</option>
								<option value="0" selected="true">Inactive</option>
							<?php
							endif;
							?>
						</select>
					</div>
					<div class="col-sm-12">
                        <input type="submit" name="update_acme" value="<?= $this->base->text('change', 'button') ?>" class="btn btn-primary btn-pill">
					</div>
				</div>
				</form>
			</div>
			<div class="tab-pane <?php if ($this->input->get('sitepro')) : ?>
				active
			<?php endif ?>" id="sitepro">
				<?= form_open('api/settings') ?>
				<div class="row">
					<div class="col-sm-6">
                        <label class="form-label"><?= $this->base->text('hostname', 'table') ?></label>
						<input type="text" name="hostname" class="form-control mb-2" value="<?= $this->sp->get_hostname() ?>">
					</div>
					<div class="col-sm-6">
                        <label class="form-label"><?= $this->base->text('username', 'label') ?></label>
						<input type="text" name="username" class="form-control mb-2" value="<?= $this->sp->get_username() ?>">
					</div>
					<div class="col-sm-6">
                        <label class="form-label"><?= $this->base->text('password', 'label') ?></label>
						<input type="text" name="password" class="form-control mb-2" value="<?= $this->sp->get_password() ?>">
					</div>
					<div class="col-sm-6">
                        <label class="form-label"><?= $this->base->text('status', 'table') ?></label>
						<select class="form-control mb-2" name="status">
							<?php
							if ($this->sp->get_status() === 'active') :
							?>
								<option value="1" selected="true">Active</option>
								<option value="0">Inactive</option>
							<?php
							else :
							?>
								<option value="1">Active</option>
								<option value="0" selected="true">Inactive</option>
							<?php
							endif;
							?>
						</select>
					</div>
					<div class="col-sm-12">
                        <input type="submit" name="update_sp" value="<?= $this->base->text('change', 'button') ?>" class="btn btn-primary btn-pill">
					</div>
				</div>
				</form>
			</div>
			<div class="tab-pane <?php if ($this->input->get('oauth')) : ?>
				active
			<?php endif ?>" id="oauth">
				<?= form_open('api/settings') ?>
				<div class="row">
					<div class="col-sm-6">
                        <label class="form-label"><?= $this->base->text('oauth_client', 'label') ?></label>
						<select class="form-control mb-2" name="type">
							<option value="1" selected="true">GitHub</option>
						</select>
					</div>
					<input type="hidden" name="service" value="<?php $oauth = 'github';
																echo ($oauth); ?>">
					<div class="col-sm-6">
                        <label class="form-label"><?= $this->base->text('client_key', 'label') ?></label>
						<input type="text" name="client" class="form-control mb-2" value="<?= $this->oauth->get_client($oauth) ?>">
					</div>
					<div class="col-sm-6">
                        <label class="form-label"><?= $this->base->text('secret_key', 'label') ?></label>
						<input type="text" name="secret" class="form-control mb-2" value="<?= $this->oauth->get_secret($oauth) ?>">
					</div>
					<div class="col-sm-6">
                        <label class="form-label"><?= $this->base->text('endpoint_url', 'label') ?></label>
						<input type="text" name="endpoint" class="form-control mb-2" value="<?= $this->oauth->get_endpoint($oauth) ?>" readonly>
					</div>
					<div class="col-sm-6">
                        <label class="form-label"><?= $this->base->text('callback_url', 'label') ?></label>
						<input type="text" name="callback" class="form-control mb-2" value="<?= base_url() ?>c/github_oauth" readonly>
					</div>
					<div class="col-sm-6">
                        <label class="form-label"><?= $this->base->text('status', 'table') ?></label>
						<select class="form-control mb-2" name="status">
							<?php
							if ($this->oauth->get_status($oauth) === 'active') :
							?>
								<option value="1" selected="true">Active</option>
								<option value="0">Inactive</option>
							<?php
							else :
							?>
								<option value="1">Active</option>
								<option value="0" selected="true">Inactive</option>
							<?php
							endif;
							?>
						</select>
					</div>
					<div class="col-sm-12">
                        <input type="submit" name="update_github" value="<?= $this->base->text('change', 'button') ?>" class="btn btn-primary btn-pill">
					</div>
				</div>
				</form>
			</div>
		</div>
	</div>
</div>