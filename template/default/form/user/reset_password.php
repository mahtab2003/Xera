<?= form_open('reset/password/' . $token, ['class' => 'card card-md']) ?>
<div class="card-body">
	<h2 class="card-title text-center mb-3"><?= $this->base->text('reset_password', 'heading') ?></h2>
	<div class="mb-2">
		<label class="form-label"><?= $this->base->text('password', 'label') ?></label>
		<div class="input-group input-group-flat">
			<input type="password" class="form-control" id="password" placeholder="<?= $this->base->text('password', 'label') ?>" name="password">
			<span class="input-group-text">
				<a href="#" class="link-secondary trigger" id="toggle-btn" data-toggle="password" title="Show password" data-bs-toggle="tooltip">
					<em class="fa fa-eye"></em>
				</a>
			</span>
		</div>
	</div>
	<div class="mb-3">
		<label class="form-label"><?= $this->base->text('password', 'label') ?></label>
		<div class="input-group input-group-flat">
			<input type="password" class="form-control" id="password1" placeholder="<?= $this->base->text('password', 'label') ?>" name="password1">
			<span class="input-group-text">
				<a href="#" class="link-secondary trigger" id="toggle-btn" data-toggle="password1" title="Show password" data-bs-toggle="tooltip">
					<em class="fa fa-eye"></em>
				</a>
			</span>
		</div>
	</div>
	<?php if ($this->grc->is_active()) : ?>
		<div class="mb-2">
			<?php if ($this->grc->get_type() == "google") : ?>
				<div class="g-recaptcha" data-sitekey="<?= $this->grc->get_site_key(); ?>"></div>
				<script src='https://www.google.com/recaptcha/api.js' async defer></script>
			<?php elseif ($this->grc->get_type() == "crypto") : ?>
				<script src='https://verifypow.com/lib/captcha.js' async></script>
				<div class='CRLT-captcha' data-hashes='256' data-key='<?= $this->grc->get_site_key(); ?>'>
					<em>Loading PoW Captcha...
						<br>
						If it doesn't load, please disable AdBlocker!</em>
				</div>
			<?php elseif ($this->grc->get_type() == "human") : ?>
				<div id='captcha' class='h-captcha' data-sitekey="<?= $this->grc->get_site_key(); ?>"></div>
				<script src='https://hcaptcha.com/1/api.js' async defer></script>
			<?php endif ?>
		</div>
	<?php endif ?>
	<div class="form-footer mt-1">
		<input type="submit" class="btn btn-primary w-100" name="reset" value="<?= $this->base->text('reset_password', 'button') ?>">
	</div>
</div>
</form>
<div class="text-center text-muted mt-3">
	<?= $this->base->text('create_an_account', 'heading') ?> <a href="<?= base_url(); ?>register" tabindex="-1"><?= $this->base->text('login', 'button') ?></a>
</div>