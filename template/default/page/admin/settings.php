<div class="container-xl">
	<div class="page-header d-print-none">
		<h2 class="page-title py-3">
            <?= $this->base->text('settings', 'title') ?>
		</h2>
	</div>
	<div class="card mb-3">
		<div class="card-header">
            <div class="card-title"><?= $this->base->text('general', 'heading') ?></div>
		</div>
		<div class="card-body">
			<?= form_open('admin/settings') ?>
				<div class="row">
					<div class="col-sm-12">
                        <label class="form-label"><?= $this->base->text('your_name', 'label') ?></label>
						<input type="text" name="name" class="form-control mb-2" value="<?= $this->admin->get_name() ?>">
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
			<?= form_open('admin/settings') ?>
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
			<?= form_open('admin/settings') ?>
				<div class="row">
					<div class="col-sm-12">
                        <label class="form-label"><?= $this->base->text('new_password', 'label') ?></label>
						<input type="password" name="password" class="form-control mb-2" placeholder="New password...">
                        <label class="form-label"><?= $this->base->text('confirm_password', 'label') ?></label>
						<input type="password" name="password1" class="form-control mb-2" placeholder="Confirm password...">
                        <label class="form-label"><?= $this->base->text('old_password', 'label') ?></label>
						<input type="password" name="old_password" class="form-control mb-2" placeholder="Old password...">
                        <input type="submit" name="update_password" value="<?= $this->base->text('change', 'button') ?>" class="btn btn-primary btn-pill">
					</div>
				</div>
			</form>
		</div>
	</div>
</div>