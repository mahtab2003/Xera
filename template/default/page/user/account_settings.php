<div class="container-xl">
	<div class="page-header d-print-none">
		<h2 class="page-title py-3">
			<?= $this->base->text($title, 'title') ?>
		</h2>
	</div>
	<div class="card mb-3">
		<div class="card-header">
			<div class="card-title"><?= $this->base->text('general', 'heading') ?></div>
		</div>
		<div class="card-body">
			<?= form_open('account/settings/'.$id) ?>
				<div class="row">
					<div class="col-sm-12">
						<label class="form-label"><?= $this->base->text('account_label', 'label') ?></label>
						<input type="text" name="label" placeholder="<?= $this->base->text('account_label', 'label') ?>" class="form-control mb-2" value="<?= $data['account_label'] ?>">
						<input type="submit" name="update_label" value="<?= $this->base->text('change', 'button') ?>" class="btn btn-primary btn-pill">
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
			<?= form_open('account/settings/'.$id) ?>
				<div class="row">
					<div class="col-sm-12">
						<label class="form-label"><?= $this->base->text('new_password', 'label') ?></label>
						<input type="password" name="password" class="form-control mb-2" placeholder="<?= $this->base->text('new_password', 'label') ?>">
						<label class="form-label"><?= $this->base->text('old_password', 'label') ?></label>
						<input type="password" name="old_password" class="form-control mb-2" placeholder="<?= $this->base->text('old_password', 'label') ?>">
						<input type="submit" name="update_password" value="<?= $this->base->text('change', 'button') ?>" class="btn btn-primary btn-pill">
					</div>
				</div>
			</form>
		</div>
	</div>
	<div class="card mb-3">
		<div class="card-header">
			<div class="card-title"><?= $this->base->text('deactivation', 'heading') ?></div>
		</div>
		<div class="card-body">
			<?= form_open('account/settings/'.$id) ?>
				<div class="row">
					<div class="col-sm-12">
						<div class="alert alert-danger">
							<?= $this->base->text('account_warning', 'paragraph') ?>
						</div>
						<label class="form-label"><?= $this->base->text('reason', 'label') ?></label>
						<textarea name="reason" class="form-control mb-2" placeholder="<?= $this->base->text('reason', 'label') ?>"></textarea>
						<input type="submit" name="deactivate" class="btn btn-danger btn-pill" value="<?= $this->base->text('deactivate', 'button') ?>">
					</div>
				</div>
			</form>
		</div>
	</div>
</div>