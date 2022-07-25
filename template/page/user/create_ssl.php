<div class="container-xl">
	<div class="page-header d-print-none">
		<h2 class="page-title py-3">
			Create SSL
		</h2>
	</div>
	<div class="card p-2 mb-3">
		<div class="card-body">
			<?= form_open('u/create_ssl') ?>
				<div class="row">
					<div class="col-sm-12 mb-2">
						<label class="form-label">CSR Code</label>
						<textarea class="form-control" name="csr" placeholder="CSR code here...." style="min-height: 250px;"></textarea>
					</div>
					<?php if($this->grc->is_active()):?>
						<div class="mb-2">
							<?php if($this->grc->get_type() == "google"):?>
								<div class="g-recaptcha" data-sitekey="<?= $this->grc->get_site_key();?>"></div>
								<script src='https://www.google.com/recaptcha/api.js' async defer ></script>
							<?php else: ?>
								<div id='captcha' class='h-captcha' data-sitekey="<?= $this->grc->get_site_key();?>"></div>
								<script src='https://hcaptcha.com/1/api.js' async defer ></script>
							<?php endif ?>
						</div>
					<?php endif ?>
					<div class="col-sm-12">
						<input type="submit" name="create" value="Request" class="btn btn-primary btn-pill">
					</div>
				</div>
			</form>
		</div>
	</div>
</div>