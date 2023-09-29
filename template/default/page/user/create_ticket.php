<div class="container-xl">
	<div class="page-header d-print-none">
		<h2 class="page-title py-3">
			<?= $this->base->text($title, 'title') ?>
		</h2>
	</div>
	<div class="card p-2 mb-3">
		<div class="card-body">
			<?= form_open('ticket/create') ?>
				<div class="row">
					<div class="col-md-12">
						<label class="form-label"><?= $this->base->text('subject', 'label') ?></label>
						<input type="text" name="subject" placeholder="<?= $this->base->text('subject', 'label') ?>" class="form-control mb-2">
					</div>
					<div class="col-sm-12 mb-2">
						<label class="form-label"><?= $this->base->text('content', 'label') ?></label>
						<textarea id="editor" class="form-control" name="content" placeholder="<?= $this->base->text('content', 'label') ?>"></textarea>
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
						<input type="submit" name="create" value="<?= $this->base->text('create', 'button') ?>" class="btn btn-primary btn-pill">
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript" src="<?= base_url() ?>assets/<?= $this->base->get_template() ?>/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
	ClassicEditor
		.create( document.querySelector( '#editor' ), {
			 toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'save' ]
		} )
		.then( editor => {
			window.editor = editor;
		} )
		.catch( err => {
			console.error( err.stack );
		} );
</script>