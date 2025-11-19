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
                                <option value="light" selected="true"><?= $this->base->text('light', 'label') ?></option>
                                <option value="dark"><?= $this->base->text('dark', 'label') ?></option>
							<?php
							elseif(get_cookie('theme', true) == 'dark'):
							?>
                                <option value="light"><?= $this->base->text('light', 'label') ?></option>
                                <option value="dark" selected="true"><?= $this->base->text('dark', 'label') ?></option>
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
		</div>
	</div>
</div>
