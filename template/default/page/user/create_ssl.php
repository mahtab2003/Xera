<div class="container-xl">
	<div class="page-header d-print-none">
		<h2 class="page-title py-3">
			<?= $this->base->text($title, 'title') ?>
		</h2>
	</div>
	<div class="card p-2 mb-3">
		<div class="card-body">
		<p> You can generate CSR and Private key from <a href="https://www.gogetssl.com/online-csr-generator/">Online CSR Generator</a>
			<?= form_open('ssl/create') ?>
				<div class="row">
					<div class="col-sm-12 mb-2">
						<label class="form-label"><?= $this->base->text('csr_code', 'label') ?></label>
						<textarea class="form-control" name="csr" placeholder="<?= $this->base->text('csr_code', 'label') ?>" style="min-height: 250px;"></textarea>
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
							<?php endif ?>
						</div>
					<?php endif ?>
					<div class="col-sm-12">
						<input type="submit" name="create" value="<?= $this->base->text('request', 'button') ?>" class="btn btn-primary btn-pill">
					</div>
				</div>
			</form>
		</div>
	</div>
</div>