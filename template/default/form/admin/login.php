<?= form_open('admin/login', ['class' => 'card card-md']) ?>
	<div class="card-body">
		<h2 class="card-title text-center mb-3">Login as admin</h2>
		<div class="mb-3">
			<label class="form-label">Email address</label>
			<input type="email" name="email" class="form-control" placeholder="Enter email">
		</div>
		<div class="mb-2">
			<label class="form-label">
				Password
				<span class="form-label-description">
					<a href="<?= base_url();?>admin/forget">I forgot password</a>
				</span>
			</label>
			<div class="input-group input-group-flat">
				<input type="password" class="form-control" id="password" placeholder="Password" name="password">
				<span class="input-group-text">
					<a href="#" class="link-secondary trigger" data-toggle='password' title="Show password" data-bs-toggle="tooltip">
						<i class="fa fa-eye"></i>
					</a>
				</span>
			</div>
		</div>
		<div class="mb-3">
			<label class="form-check">
				<input type="checkbox" name="checkbox" value="1" class="form-check-input"/>
				<span class="form-check-label">Remember me on this device</span>
			</label>
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
		<div class="form-footer mt-1">
			<input type="submit" class="btn btn-primary w-100" name="login" value="Sign in">
		</div>
	</div>
</form>