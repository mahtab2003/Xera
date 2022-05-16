<div class="container-xl">
	<div class="page-header d-print-none">
		<h2 class="page-title py-3">
			Create Ticket
		</h2>
	</div>
	<div class="card p-2 mb-3">
		<div class="card-body">
			<?= form_open('u/create_ticket') ?>
				<div class="row">
					<div class="col-md-12">
						<label class="form-label">Subject</label>
						<input type="text" name="subject" placeholder="Subject" class="form-control mb-2">
					</div>
					<div class="col-sm-12 mb-2">
						<label class="form-label">Content</label>
						<textarea id="editor" class="form-control" name="content"></textarea>
					</div>
					<?php if($this->grc->is_active()):?>
						<div class="col-sm-12 mb-2">
							<div class="g-recaptcha" data-sitekey="<?= $this->grc->get_site_key();?>"></div>
							<script src='https://www.google.com/recaptcha/api.js' async defer ></script>
						</div>
					<?php endif ?>
					<div class="col-sm-12">
						<input type="submit" name="create" value="Create" class="btn btn-primary btn-pill">
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript" src="<?= base_url() ?>assets/ckeditor/ckeditor.js"></script>
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