<?= form_open('forget', ['class' => 'card card-md']) ?>
	<div class="card-body">
		<h2 class="card-title text-center mb-3"><?= $this->base->text('forget_password', 'heading') ?></h2>
		<p class="text-muted mb-3"><?= $this->base->text('forget_password', 'paragraph') ?></p>
		<div class="mb-3">
			<label class="form-label"><?= $this->base->text('email_address', 'label') ?></label>
			<input type="email" name="email" class="form-control" placeholder="<?= $this->base->text('email_address', 'label') ?>">
		</div>
		<div class="form-footer mt-1">
			<input type="submit" class="btn btn-primary w-100" name="forget" value="<?= $this->base->text('send_me_link', 'button') ?>">
		</div>
	</div>
</form>
<div class="text-center text-muted mt-3">
	<?= $this->base->text('forget_it', 'heading') ?>, <a href="<?= base_url();?>login" tabindex="-1"><?= $this->base->text('send_me_back', 'heading') ?></a> <?= $this->base->text('to_screen', 'heading') ?>
</div>