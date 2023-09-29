<div class="container-xl">
	<div class="page-header d-print-none">
		<h2 class="page-title py-3">
			<?= $this->base->text($title, 'title') ?>
		</h2>
	</div>
	<div class="card">
		<ul class="nav nav-tabs nav-fill">
			<li class="nav-item">
				<a class="nav-link active"  data-bs-toggle="tab" href="#checkdomain"><i class="fa fa-globe me-2"></i> <?= $this->base->text('check_domain', 'button') ?></a>
			</li>
			<li class="nav-item">
				<a class="nav-link"  data-bs-toggle="tab" <?php if(isset($_SESSION['domain'])): ?>href="#configure"<?php else: ?>href="#" disabled<?php endif; ?>><i class="fa fa-cogs me-2"></i> <?= $this->base->text('configure', 'button') ?></a>
			</li>
			<li class="nav-item">
				<a class="nav-link"  data-bs-toggle="tab" <?php if(isset($_SESSION['done'])): ?>href="#done"<?php else: ?>href="#" disabled<?php endif; ?>><i class="fa fa-check-circle me-2"></i> <?= $this->base->text('done', 'button') ?></a>
			</li>
		</ul>
		<div class="card-body">
			<div class="tab-content">
				<div class="tab-pane active show" id="checkdomain">
					<ul class="nav nav-tabs mb-2">
						<li class="nav-item">
							<a class="nav-link active"  data-bs-toggle="tab" href="#subdomain"><?= $this->base->text('subdomain', 'button') ?></a>
						</li>
						<li class="nav-item">
							<a class="nav-link"  data-bs-toggle="tab" href="#customdomain"><?= $this->base->text('custom_domain', 'button') ?></a>
						</li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane active" id="subdomain">
							<?= form_open('account/create') ?>
								<div class="">
									<div class="mb-2">
										<input type="text" name="domain" class="form-control" placeholder="<?= $this->base->text('domain_name', 'label') ?>">
									</div>
									<div class="mb-2">
										<select name="ext" class="form-control">
											<?php foreach ($this->mofh->list_exts() as $ext): ?>
												<option><?= $ext['domain_name'] ?></option>
											<?php endforeach ?>
										</select>
									</div>
									<div class="mb-2 d-grid">
										<input type="submit" name="check_subdomain" class="btn btn-primary" value="<?= $this->base->text('check_availibilty', 'button') ?>">
									</div>
								</div>
							</form>
						</div>
						<div class="tab-pane" id="customdomain">
							<?= form_open('account/create') ?>
								<div class="">
									<div class="mb-2">
										<input type="text" name="domain" class="form-control" placeholder="<?= $this->base->text('domain_name', 'label') ?>">
									</div>
									<div class="mb-2 d-grid">
										<input type="submit" name="check_domain" class="btn btn-primary" value="<?= $this->base->text('check_availibilty', 'button') ?>">
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
				<div class="tab-pane" id="configure">
					<?= form_open('account/create') ?>
						<div class="mb-2">
							<label class="form-label"><?= $this->base->text('domain_name', 'label') ?></label>
							<input type="text" name="domain" value="<?php if(isset($_SESSION['domain'])): echo($_SESSION['domain']); endif ?>" class="form-control" readonly="true">
						</div>
						<div class="mb-2">
							<label class="form-label"><?= $this->base->text('account_label', 'label') ?></label>
							<input type="text" name="label" placeholder="<?= $this->base->text('account_label', 'label') ?>" class="form-control">
						</div>
						<div class="mb-2">
							<label class="form-label"><?= $this->base->text('username', 'label') ?></label>
							<input type="text" placeholder="<?= $this->base->text('username', 'label') ?>" class="form-control" disabled="true">
						</div>
						<div class="mb-2">
							<label class="form-label"><?= $this->base->text('password', 'label') ?></label>
							<input type="text" placeholder="<?= $this->base->text('password', 'label') ?>" class="form-control">
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
						<div class="mb-2">
							<input type="submit" name="create" value="<?= $this->base->text('create_account', 'button') ?>" class="btn btn-primary">
						</div>
					</form>
				</div>
				<div class="tab-pane" id="done">
					<div class="text-center">
						<p><?= $this->base->text('account_created', 'paragraph') ?></p>
						<a href="<?= base_url().'u/accounts' ?>" class="btn btn-primary"><?= $this->base->text('view_accounts', 'button') ?></a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>