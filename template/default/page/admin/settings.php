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
                        <hr class="my-3">
                        <div class="row">
                                <div class="col-sm-12">
                                        <h3 class="card-title h5">Two factor authentication</h3>
                                        <?php if ($twofa_enabled): ?>
                                                <p class="text-muted">Two factor authentication is enabled for this account.</p>
                                                <?= form_open('admin/settings') ?>
                                                        <button type="submit" name="disable_2fa" class="btn btn-outline-danger btn-pill">Disable two factor authentication</button>
                                                </form>
                                        <?php elseif ($twofa_pending_secret): ?>
                                                <p class="text-muted">Scan this QR code with your authenticator app and enter the code it generates to finish enabling 2FA.</p>
                                                <?php if ($twofa_provisioning): ?>
                                                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=<?= urlencode($twofa_provisioning) ?>" alt="2FA QR code" class="mb-2">
                                                <?php endif; ?>
                                                <p class="text-muted">Secret: <strong><?= twofa_format_secret($twofa_pending_secret) ?></strong></p>
                                                <?= form_open('admin/settings') ?>
                                                        <label class="form-label">Authentication code</label>
                                                        <input type="text" name="code" class="form-control mb-2" placeholder="123456" autocomplete="one-time-code">
                                                        <button type="submit" name="confirm_2fa" class="btn btn-primary btn-pill">Confirm two factor authentication</button>
                                                </form>
                                        <?php else: ?>
                                                <p class="text-muted">Add an extra layer of security by requiring a time based code during login.</p>
                                                <?= form_open('admin/settings') ?>
                                                        <button type="submit" name="start_2fa" class="btn btn-outline-primary btn-pill">Enable two factor authentication</button>
                                                </form>
                                        <?php endif; ?>
                                </div>
                        </div>
                </div>
        </div>
</div>