<div class="container-xl">
	<div class="page-header d-print-none">
		<h2 class="page-title py-3">
            <?= $this->base->text('edit_email', 'title') ?>
		</h2>
	</div>
	<div class="card p-2 mb-3">
		<div class="card-body">
			<?= form_open('email/edit/'.$email['email_id']) ?>
				<div class="row">
					<div class="col-md-12">
                        <label class="form-label"><?= $this->base->text('subject', 'table') ?></label>
						<input type="text" name="subject" placeholder="Subject" class="form-control mb-2" value="<?= $email['email_subject'] ?>">
					</div>
					<div class="col-sm-12 mb-2">
                        <label class="form-label"><?= $this->base->text('content', 'label') ?></label>
						<textarea class="form-control" name="content" style="min-height: 250px;"><?= $email['email_content'] ?></textarea>
					</div>
					<div class="col-sm-12 mb-3">
                        <label class="form-label"><?= $this->base->text('custom_variables', 'label') ?></label>
						<textarea class="form-control" readonly="true"><?= $email['email_doc'] ?></textarea>
					</div>
					<div class="col-sm-12">
                        <input type="submit" name="update" value="<?= $this->base->text('update', 'button') ?>" class="btn btn-primary btn-pill">
					</div>
				</div>
			</form>
		</div>
	</div>
</div>