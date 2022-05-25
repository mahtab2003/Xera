<div class="container-xl">
	<div class="page-header d-print-none">
		<h2 class="page-title py-3">
			Create Account
		</h2>
	</div>
	<div class="card">
		<ul class="nav nav-tabs nav-fill">
			<li class="nav-item">
				<a class="nav-link active"  data-bs-toggle="tab" href="#checkdomain"><i class="fa fa-globe me-2"></i> Check Availiability</a>
			</li>
			<li class="nav-item">
				<a class="nav-link"  data-bs-toggle="tab" <?php if(isset($_SESSION['domain'])): ?>href="#configure"<?php else: ?>href="#" disabled<?php endif; ?>><i class="fa fa-cogs me-2"></i> Configure</a>
			</li>
			<li class="nav-item">
				<a class="nav-link"  data-bs-toggle="tab" <?php if(isset($_SESSION['done'])): ?>href="#done"<?php else: ?>href="#" disabled<?php endif; ?>><i class="fa fa-check-circle me-2"></i> Done</a>
			</li>
		</ul>
		<div class="card-body">
			<div class="tab-content">
				<div class="tab-pane active show" id="checkdomain">
					<ul class="nav nav-tabs mb-2">
						<li class="nav-item">
							<a class="nav-link active"  data-bs-toggle="tab" href="#subdomain">Subomain</a>
						</li>
						<li class="nav-item">
							<a class="nav-link"  data-bs-toggle="tab" href="#customdomain">Custom Domain</a>
						</li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane active" id="subdomain">
							<?= form_open('u/create_account') ?>
								<div class="">
									<div class="mb-2">
										<input type="text" name="domain" class="form-control" placeholder="domain name...">
									</div>
									<div class="mb-2">
										<select name="ext" class="form-control">
											<?php foreach ($this->mofh->list_exts() as $ext): ?>
												<option><?= $ext['domain_name'] ?></option>
											<?php endforeach ?>
										</select>
									</div>
									<div class="mb-2 d-grid">
										<input type="submit" name="check_subdomain" class="btn btn-primary" value="Check Availibilty">
									</div>
								</div>
							</form>
						</div>
						<div class="tab-pane" id="customdomain">
							<?= form_open('u/create_account') ?>
								<div class="">
									<div class="mb-2">
										<input type="text" name="domain" class="form-control" placeholder="domain name...">
									</div>
									<div class="mb-2 d-grid">
										<input type="submit" name="check_domain" class="btn btn-primary" value="Check Availibilty">
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
				<div class="tab-pane" id="configure">
					<?= form_open('u/create_account') ?>
						<div class="mb-2">
							<label class="form-label">Domain name</label>
							<input type="text" name="domain" value="<?php if(isset($_SESSION['domain'])): echo($_SESSION['domain']); endif ?>" class="form-control" readonly="true">
						</div>
						<div class="mb-2">
							<label class="form-label">Label</label>
							<input type="text" name="label" placeholder="Label for account..." class="form-control">
						</div>
						<div class="mb-2">
							<label class="form-label">Username</label>
							<input type="text" placeholder="Auto generated..." class="form-control" disabled="true">
						</div>
						<div class="mb-2">
							<label class="form-label">Password</label>
							<input type="text" placeholder="Password for account..." class="form-control">
						</div>
						<?php if($this->grc->is_active()):?>
							<div class="mb-2">
								<div class="g-recaptcha" data-sitekey="<?= $this->grc->get_site_key();?>"></div>
								<script src='https://www.google.com/recaptcha/api.js' async defer ></script>
							</div>
						<?php endif ?>
						<div class="mb-2">
							<input type="submit" name="create" value="Create Account" class="btn btn-primary">
						</div>
					</form>
				</div>
				<div class="tab-pane" id="done">
					<div class="text-center">
						<p>Everything have been setup correctly.</p>
						<a href="<?= base_url().'u/accounts' ?>" class="btn btn-primary">View Acounts</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>