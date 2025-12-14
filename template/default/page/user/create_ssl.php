<div class="container-xl">
	<div class="page-header d-print-none">
		<h2 class="page-title py-3">
			<?= $this->base->text($title, 'title') ?>
		</h2>
	</div>
	<div class="card p-2 mb-3">
		<div class="card-body">
			<?= form_open('ssl/create') ?>
				<div class="row">
					<?php
					if ($acme_active) :
					?>
					<div class="col-sm-6">
						<label class="form-label">SSL Providers</label>
						<select class="form-control mb-2" name="type">
							<?php
							if ($this->acme->get_letsencrypt() != 'not-set' && $this->acme->get_letsencrypt() != '') {
							?>
							<option value="letsencrypt" selected="true">Let's Encrypt</option>
							<?php
							}
							?>
							<?php
							if ($this->ssl->is_active()) :
							?>
							<option value="gogetssl">GoGetSSL</option>
							<?php
							endif;
							?>
							<?php
							$zerossl = $this->acme->get_zerossl();
							if ($zerossl == 'not-set') {}
							elseif ($zerossl['url'] != '' && $zerossl['eab_kid'] != '' && $zerossl['eab_hmac_key'] != '') {
							?>
							<option value="zerossl">ZeroSSL</option>
							<?php
							}
							?>
							<?php
							$googletrust = $this->acme->get_googletrust();
							if ($googletrust == 'not-set') {

							} elseif ($googletrust['url'] != '' && $googletrust['eab_kid'] != '' && $googletrust['eab_hmac_key'] != '') {
							?>
							<option value="googletrust">Google Trust Services</option>
							<?php
							}
							?>
						</select>
					</div>
					<div class="col-sm-6 mb-2">
					<?php
					else :
					?>
					<input type="hidden" value="gogetssl" name="type">
					<div class="col-sm-12 mb-2">
					<?php
					endif;
					?>
						<label class="form-label"><?= $this->base->text('domain_name', 'label') ?></label>
						<input type="text" class="form-control" name="domain" placeholder="<?= $this->base->text('domain_name', 'label') ?>"/>
					</div>
					<?php if($this->grc->is_active()):?>
						<div class="mb-2">
							<?php if($this->grc->get_type() == "google"):?>
								<div class="g-recaptcha" data-sitekey="<?= $this->grc->get_site_key();?>"></div>
								<script src='https://www.google.com/recaptcha/api.js' async defer ></script>
							<?php elseif($this->grc->get_type() == "crypto"): ?>
								<script src='https://verifypow.com/lib/captcha.js' async></script>
				            	<div class='CRLT-captcha' data-hashes='256' data-key='<?= $this->grc->get_site_key();?>'>
				                    <em>Loading PoW Captcha...
				                    <br>
				                    If it doesn't load, please disable AdBlocker!</em>
				                </div>
							<?php elseif($this->grc->get_type() == "human"): ?>
								<div id='captcha' class='h-captcha' data-sitekey="<?= $this->grc->get_site_key();?>"></div>
								<script src='https://hcaptcha.com/1/api.js' async defer ></script>
							<?php elseif ($this->grc->get_type() == "turnstile") : ?>
								<script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
								<div class="cf-turnstile" data-sitekey="<?= $this->grc->get_site_key(); ?>" data-callback="javascriptCallback"></div>
							<?php endif ?>
						</div>
					<?php endif ?>
					<div class="col-sm-12">
						<button id="createButton" type="submit" name="create" value="<?= $this->base->text('request', 'button') ?>" class="btn btn-primary btn-pill" onclick="showLoading()">
    					    <span id="spinner" class="spinner-border" role="status" aria-hidden="true" style="display: none;"></span>
    					    <span id="buttonText"><?= $this->base->text('request', 'button') ?></span>
    					</button>
						<script>
						function showLoading() {
						    var spinner = document.getElementById('spinner');
						    var buttonText = document.getElementById('buttonText');
						    var submitButton = document.getElementById('createButton');
						
						    spinner.style.display = 'inline-block';
						    buttonText.style.display = 'none';
						    submitButton.classList.add('disabled');
						}
						</script>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
