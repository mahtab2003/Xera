<div class="container-xl">
	<div class="page-header d-print-none">
		<h2 class="page-title py-3">
			Settings
		</h2>
	</div>
	<div class="card mb-3">
		<div class="card-header">
			<div class="card-title">General</div>
		</div>
		<div class="card-body">
			<?= form_open('admin/settings') ?>
				<div class="row">
					<div class="col-sm-12">
						<label class="form-label">Your name</label>
						<input type="text" name="name" class="form-control mb-2" value="<?= $this->admin->get_name() ?>">
						<input type="submit" name="update_name" value="Change" class="btn btn-primary btn-pill">
					</div>
				</div>
			</form>
		</div>
	</div>
	<div class="card mb-3">
		<div class="card-header">
			<div class="card-title">Interface</div>
		</div>
		<div class="card-body">
			<?= form_open('admin/settings') ?>
				<div class="row">
					<div class="col-sm-12">
						<label class="form-label">Theme</label>
						<select class="form-control mb-2" name="theme">
							<?php 
							if(get_cookie('theme', true) == 'light'):
							?>
								<option value="light" selected="true">Light</option>
								<option value="dark">Dark</option>
							<?php
							elseif(get_cookie('theme', true) == 'dark'):
							?>
								<option value="light">Light</option>
								<option value="dark" selected="true">Dark</option>
							<?php
							endif;
							?>
						</select>
						<input type="submit" name="update_theme" value="Change" class="btn btn-primary btn-pill">
					</div>
				</div>
			</form>
		</div>
	</div>
	<div class="card mb-3">
		<div class="card-header">
			<div class="card-title">Security</div>
		</div>
		<div class="card-body">
			<?= form_open('admin/settings') ?>
				<div class="row">
					<div class="col-sm-12">
						<label class="form-label">New password</label>
						<input type="password" name="password" class="form-control mb-2" placeholder="New password...">
						<label class="form-label">Confirm password</label>
						<input type="password" name="password1" class="form-control mb-2" placeholder="Confirm password...">
						<label class="form-label">Old password</label>
						<input type="password" name="old_password" class="form-control mb-2" placeholder="Old password...">
						<input type="submit" name="update_password" value="Change" class="btn btn-primary btn-pill">
					</div>
				</div>
			</form>
		</div>
	</div>
</div>