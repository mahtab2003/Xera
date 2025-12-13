<div class="container-xl">
	<div class="page-header d-print-none">
		<h2 class="page-title py-3">
			<?= $this->base->text($title, 'title') ?>
		</h2>
	</div>
	<div class="card mb-3">
		<div class="card-header">
			<div class="card-title"><?= $this->base->text('your_name', 'label') ?></div>
		</div>
		<div class="card-body">
			<?= form_open('settings') ?>
				<div class="row">
					<div class="col-sm-12">
						<label class="form-label"><?= $this->base->text('your_name', 'label') ?></label>
						<input type="text" name="name" placeholder="<?= $this->base->text('your_name', 'label') ?>" class="form-control mb-2" value="<?= $this->user->get_name() ?>">
						<input type="submit" name="update_name" value="<?= $this->base->text('change', 'button') ?>" class="btn btn-primary btn-pill">
					</div>
				</div>
			</form>
		</div>
	</div>
	<div class="card mb-3">
		<div class="card-header">
			<div class="card-title"><?= $this->base->text('interface', 'heading') ?></div>
		</div>
		<div class="card-body">
			<?= form_open('settings') ?>
				<div class="row">
					<div class="col-sm-12">
						<label class="form-label"><?= $this->base->text('theme', 'label') ?></label>
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
						<label class="form-label"><?= $this->base->text('language', 'label') ?></label>
						<select class="form-control mb-2" name="language">
							<?php foreach (get_languages() as $lang): ?>
								<?php if ($lang['code'] == get_cookie('lang')): ?>
									<option value="<?= $lang['code'] ?>" selected="true"><?= $lang['name'] ?></option>
								<?php else: ?>
									<option value="<?= $lang['code'] ?>"><?= $lang['name'] ?></option>
								<?php endif ?>
							<?php endforeach ?>
						</select>
						<input type="submit" name="update_theme" value="<?= $this->base->text('change', 'button') ?>" class="btn btn-primary btn-pill">
					</div>
				</div>
			</form>
		</div>
	</div>
        <div class="card mb-3">
                <div class="card-header">
                        <div class="card-title"><?= $this->base->text('security', 'heading') ?></div>
                </div>
                <div class="card-body">
                        <?= form_open('settings') ?>
                                <div class="row">
                                        <div class="col-sm-12">
                                          <?php if ($this->oauth->is_active('github')) : ?>
                        <div>
                                <a href="?enable_oauth=true" class="mb-2 btn btn-dark w-100"><em class="fab fa-github me-2"></em><?= $this->base->text('github_signin', 'button') ?></a>
                        </div>
                  <?php endif ?>
                                                <label class="form-label"><?= $this->base->text('new_password', 'label') ?></label>
                                                <input type="password" name="password" placeholder="<?= $this->base->text('new_password', 'label') ?>" class="form-control mb-2">
                                                <label class="form-label"><?= $this->base->text('confirm_password', 'label') ?></label>
                                                <input type="password" name="password1" placeholder="<?= $this->base->text('confirm_password', 'label') ?>" class="form-control mb-2">
                                                <label class="form-label"><?= $this->base->text('old_password', 'label') ?></label>
                                                <input type="password" name="old_password" placeholder="<?= $this->base->text('old_password', 'label') ?>" class="form-control mb-2">
                                                <input type="submit" name="update_password" value="<?= $this->base->text('change', 'button') ?>" class="btn btn-primary btn-pill">
                                        </div>
                                </div>
                        </form>
                        <hr class="my-3">
                        <div class="row">
                                <div class="col-sm-12">
                                        <h3 class="card-title h5">Two factor authentication</h3>
                                        <?php if ($twofa_enabled): ?>
                                                <p class="text-muted mb-2">Two factor authentication is enabled. You will be asked for a code during login.</p>
                                                <?= form_open('settings') ?>
                                                        <button type="submit" name="disable_2fa" class="btn btn-outline-danger btn-pill">Disable two factor authentication</button>
                                                </form>
                                        <?php elseif ($twofa_pending_secret): ?>
                                                <p class="text-muted">Scan the QR code below with your authenticator app and enter the generated code to enable 2FA.</p>
                                                <?php if ($twofa_provisioning): ?>
                                                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=<?= urlencode($twofa_provisioning) ?>" alt="2FA QR code" class="mb-2">
                                                <?php endif; ?>
                                                <p class="text-muted">Secret: <strong><?= twofa_format_secret($twofa_pending_secret) ?></strong></p>
                                                <?= form_open('settings') ?>
                                                        <label class="form-label">Authentication code</label>
                                                        <input type="text" name="code" class="form-control mb-2" placeholder="123456" autocomplete="one-time-code">
                                                        <button type="submit" name="confirm_2fa" class="btn btn-primary btn-pill">Confirm two factor authentication</button>
                                                </form>
                                        <?php else: ?>
                                                <p class="text-muted">Secure your account with an authenticator app that generates time based one time passwords.</p>
                                                <?= form_open('settings') ?>
                                                        <button type="submit" name="start_2fa" class="btn btn-outline-primary btn-pill">Enable two factor authentication</button>
                                                </form>
                                        <?php endif; ?>
                                </div>
                        </div>
                </div>
        </div>
</div>
