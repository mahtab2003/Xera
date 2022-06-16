<div class="container-xl">
	<div class="page-header d-print-none">
		<h2 class="page-title py-3">
			Api Settings
		</h2>
	</div>
	<div class="card mb-3">
		<div class="card-header">
			<div class="card-title">General</div>
		</div>
		<div class="card-body">
			<?= form_open('a/api_settings') ?>
				<div class="row">
					<div class="col-sm-6">
						<label class="form-label">Host Name</label>
						<input type="text" name="hostname" class="form-control mb-2" value="<?= $this->base->get_hostname() ?>">
					</div>
					<div class="col-sm-6">
						<label class="form-label">Alert Email</label>
						<input type="text" name="email" class="form-control mb-2" value="<?= $this->base->get_email() ?>">
					</div>
					<div class="col-sm-6">
						<label class="form-label">Fourm URL</label>
						<input type="text" name="fourm" class="form-control mb-2" value="<?= $this->base->get_fourm() ?>">
					</div>
					<div class="col-sm-6">
						<label class="form-label">Host Status</label>
						<select class="form-control mb-2" name="status">
							<?php 
							if($this->base->get_status() === 'active'):
							?>
								<option value="1" selected="true">Active</option>
								<option value="0">Inactive</option>
							<?php
							else:
							?>
								<option value="1">Active</option>
								<option value="0" selected="true">Inactive</option>
							<?php
							endif;
							?>
						</select>
					</div>
					<div class="col-sm-12">
						<input type="submit" name="update_host" value="Change" class="btn btn-primary btn-pill">
					</div>
				</div>
			</form>
		</div>
	</div>
	<div class="card mb-3">
		<div class="card-header">
			<div class="card-title">MOFH</div>
		</div>
		<div class="card-body">
			<?= form_open('a/api_settings') ?>
				<div class="row">
					<div class="col-sm-6">
						<label class="form-label">Username</label>
						<input type="text" name="username" class="form-control mb-2" value="<?= $this->mofh->get_username() ?>">
					</div>
					<div class="col-sm-6">
						<label class="form-label">Password</label>
						<input type="text" name="password" class="form-control mb-2" value="<?= $this->mofh->get_password() ?>">
					</div>
					<div class="col-sm-6">
						<label class="form-label">cPanel URL</label>
						<input type="text" name="cpanel" class="form-control mb-2" value="<?= $this->mofh->get_cpanel() ?>">
					</div>
					<div class="col-sm-6">
						<label class="form-label">Nameserver 1</label>
						<input type="text" name="ns_1" class="form-control mb-2" value="<?= $this->mofh->get_ns_1() ?>">
					</div>
					<div class="col-sm-6">
						<label class="form-label">Namserver 2</label>
						<input type="text" name="ns_2" class="form-control mb-2" value="<?= $this->mofh->get_ns_2() ?>">
					</div>
					<div class="col-sm-6">
						<label class="form-label">Package</label>
						<input type="text" name="package" class="form-control mb-2" value="<?= $this->mofh->get_package() ?>">
					</div>
					<div class="col-sm-6">
						<label class="form-label">Shared IP</label>
						<input type="text" name="email" class="form-control mb-2" value="<?= gethostbyname($_SERVER['HTTP_HOST']); ?>" readonly>
					</div>
					<div class="col-sm-6">
						<label class="form-label">Callback URL</label>
						<input type="text" name="callback" class="form-control mb-2" value="<?= base_url() ?>c/mofh" readonly>
					</div>
					<div class="col-sm-12">
						<input type="submit" name="update_mofh" value="Change" class="btn btn-primary btn-pill">
						<a href="?test_mofh=true" class="btn btn-success btn-pill">Test MOFH</a>
					</div>
				</div>
			</form>
		</div>
	</div>
	<div class="card mb-3">
		<div class="card-header">
			<div class="card-title">SMTP</div>
		</div>
		<div class="card-body">
			<?= form_open('a/api_settings') ?>
				<div class="row">
					<div class="col-sm-6">
						<label class="form-label">Hostname</label>
						<input type="text" name="hostname" class="form-control mb-2" value="<?= $this->smtp->get_hostname() ?>">
					</div>
					<div class="col-sm-6">
						<label class="form-label">Username</label>
						<input type="text" name="username" class="form-control mb-2" value="<?= $this->smtp->get_username() ?>">
					</div>
					<div class="col-sm-6">
						<label class="form-label">Password</label>
						<input type="text" name="password" class="form-control mb-2" value="<?= $this->smtp->get_password() ?>">
					</div>
					<div class="col-sm-6">
						<label class="form-label">From Email</label>
						<input type="text" name="from" class="form-control mb-2" value="<?= $this->smtp->get_from() ?>">
					</div>
					<div class="col-sm-6">
						<label class="form-label">From Name</label>
						<input type="text" name="name" class="form-control mb-2" value="<?= $this->smtp->get_name() ?>">
					</div>
					<div class="col-sm-6">
						<label class="form-label">SMTP Port</label>
						<input type="number" name="port" class="form-control mb-2" value="<?= $this->smtp->get_port() ?>">
					</div>
					<div class="col-sm-6">
						<label class="form-label">SMTP Status</label>
						<select class="form-control mb-2" name="status">
							<?php 
							if($this->smtp->get_status() === 'active'):
							?>
								<option value="1" selected="true">Active</option>
								<option value="0">Inactive</option>
							<?php
							else:
							?>
								<option value="1">Active</option>
								<option value="0" selected="true">Inactive</option>
							<?php
							endif;
							?>
						</select>
					</div>
					<div class="col-sm-12">
						<input type="submit" name="update_smtp" value="Change" class="btn btn-primary btn-pill">
						<a href="?test_mail=true" class="btn btn-success btn-pill">Test SMTP</a>
					</div>
				</div>
			</form>
		</div>
	</div>
	<div class="card mb-3">
		<div class="card-header">
			<div class="card-title">Recaptcha</div>
		</div>
		<div class="card-body">
			<?= form_open('a/api_settings') ?>
				<div class="row">
					<div class="col-sm-6">
						<label class="form-label">Site Key</label>
						<input type="text" name="site_key" class="form-control mb-2" value="<?= $this->grc->get_site_key() ?>">
					</div>
					<div class="col-sm-6">
						<label class="form-label">Secret key</label>
						<input type="text" name="secret_key" class="form-control mb-2" value="<?= $this->grc->get_secret_key() ?>">
					</div>
					<div class="col-sm-6">
						<label class="form-label">Status</label>
						<select class="form-control mb-2" name="status">
							<?php 
							if($this->grc->get_status() === 'active'):
							?>
								<option value="1" selected="true">Active</option>
								<option value="0">Inactive</option>
							<?php
							else:
							?>
								<option value="1">Active</option>
								<option value="0" selected="true">Inactive</option>
							<?php
							endif;
							?>
						</select>
					</div>
					<div class="col-sm-12">
						<input type="submit" name="update_grc" value="Change" class="btn btn-primary btn-pill">
					</div>
				</div>
			</form>
		</div>
	</div>
	<div class="card mb-3">
		<div class="card-header">
			<div class="card-title">SitePro Builder</div>
		</div>
		<div class="card-body">
			<?= form_open('a/api_settings') ?>
				<div class="row">
					<div class="col-sm-6">
						<label class="form-label">Hostname</label>
						<input type="text" name="hostname" class="form-control mb-2" value="<?= $this->sp->get_hostname() ?>">
					</div>
					<div class="col-sm-6">
						<label class="form-label">Username</label>
						<input type="text" name="username" class="form-control mb-2" value="<?= $this->sp->get_username() ?>">
					</div>
					<div class="col-sm-6">
						<label class="form-label">Password</label>
						<input type="text" name="password" class="form-control mb-2" value="<?= $this->sp->get_password() ?>">
					</div>
					<div class="col-sm-6">
						<label class="form-label">Status</label>
						<select class="form-control mb-2" name="status">
							<?php 
							if($this->sp->get_status() === 'active'):
							?>
								<option value="1" selected="true">Active</option>
								<option value="0">Inactive</option>
							<?php
							else:
							?>
								<option value="1">Active</option>
								<option value="0" selected="true">Inactive</option>
							<?php
							endif;
							?>
						</select>
					</div>
					<div class="col-sm-12">
						<input type="submit" name="update_sp" value="Change" class="btn btn-primary btn-pill">
					</div>
				</div>
			</form>
		</div>
	</div>
</div>