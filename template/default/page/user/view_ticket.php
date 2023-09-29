<div class="container-xl">
	<div class="page-header d-print-none">
		<h2 class="page-title py-3">
			<?= $this->base->text($title, 'title') ?>
		</h2>
	</div>
	<div class="card mb-3">
		<div class="card-header">
			<div class="card-title"><?= $this->base->text('information', 'heading') ?></div>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col-sm-6">
					<div class="row align-items-center">
						<span class="col"><?= $this->base->text('status', 'table') ?>:</span>
						<span class="col-auto ms-auto">
							<?php if ($ticket['ticket_status'] == 'open'): ?>
								<span class="badge bg-orange">
									<?= $this->base->text($ticket['ticket_status'], 'table') ?>
								</span>
							<?php elseif ($ticket['ticket_status'] == 'support' OR $ticket['ticket_status'] == 'customer'): ?>
								<span class="badge bg-green">
									<?= $this->base->text($ticket['ticket_status'], 'table') ?>
								</span>
							<?php elseif ($ticket['ticket_status'] == 'closed'): ?>
								<span class="badge bg-red">
									<?= $this->base->text($ticket['ticket_status'], 'table') ?>
								</span>
							<?php endif ?>
						</span>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="row align-items-center">
						<span class="col"><?= $this->base->text('open_by', 'table') ?>:</span>
						<span class="col-auto ms-auto"><?= $this->user->get_name() ?></span>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="row align-items-center">
						<span class="col"><?= $this->base->text('open_at', 'table') ?>:</span>
						<span class="col-auto ms-auto"><?= date('d-m-Y', $ticket['ticket_time']) ?></span>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="row align-items-center">
						<span class="col"><?= $this->base->text('last_reply', 'table') ?>:</span>
						<span class="col-auto ms-auto"><?php if(count($replies)>0): ?>
						<?= date('d-m-Y', $replies[count($replies)-1]['reply_time']); ?>
						<?php else: ?>
							NEVER
						<?php endif; ?>
						</span>
					</div>
				</div>
			</div>
		</div>
		<div class="card-footer">
			<div class="row align-items-center">
				<span class="col"><?= $this->base->text('subject', 'table') ?>:</span>
				<span class="col-auto ms-auto"><?= $ticket['ticket_subject'] ?></span>
			</div>
		</div>
	</div>
	<div class="card mb-3">
		<div class="card-header d-block">
			<div class="row align-items-center">
				<span class="col">
					<span class="avatar avatar-xs me-2" style="background-image: url(<?= base_url() ?>assets/<?= $this->base->get_template() ?>/img/user.png)"></span>
					<?= $this->user->get_name() ?>
				</span>
				<span class="col-auto ms-auto"><?= date('d-m-Y', $ticket['ticket_time']) ?></span>
			</div>
		</div>
		<div class="card-body pb-0">
			<div>
				<?= $ticket['ticket_content'] ?>
			</div>
		</div>
	</div>
	<?php if (count($replies) > 0): ?>
		<?php foreach ($replies as $reply): ?>
			<?php if ($reply['reply_by'] == $this->user->get_key()): 
				$reply_name = $this->user->get_name();
				$ico = $this->user->get_avatar();
			 else:
			  	$reply_name = $this->ticket->get_admin_name($reply['reply_by']);
			  	$ico = base_url().'assets/<?= $this->base->get_template() ?>/img/fav.png';
			 endif ?>
			<div class="card mb-3">
				<div class="card-header d-block">
					<div class="row align-items-center">
						<span class="col">
							<span class="avatar avatar-xs me-2" style="background-image: url(<?= $ico ?>)"></span>
							<?= $reply_name ?>
						</span>
						<span class="col-auto ms-auto"><?= date('d-m-Y', $reply['reply_time']) ?></span>
					</div>
				</div>
				<div class="card-body pb-0">
					<div>
						<?= $reply['reply_content'] ?>
					</div>
				</div>
			</div>
		<?php endforeach ?>
	<?php else: ?>
		<div class="card mb-3">
			<div class="card-body">
				<?= $this->base->text('no_reply_found', 'paragraph') ?>
			</div>
		</div>
	<?php endif ?>
	<?php if ($ticket['ticket_status'] == 'closed'): ?>
		<div class="card mb-3">
			<div class="card-body">
				<?= $this->base->text('ticket_closed', 'paragraph') ?> <a href="<?= base_url().'ticket/view/'.$ticket['ticket_key'].'?open=true' ?>"><?= $this->base->text('here', 'button') ?></a> <?= $this->base->text('to_reopen', 'paragraph') ?>
			</div>
		</div>
	<?php else: ?>
		<div class="card mb-3" id="box">
			<div class="card-header">
				<div class="card-title"><?= $this->base->text('make_a_reply', 'heading') ?></div>
			</div>
			<div class="card-body">
				<?= form_open('ticket/view/'.$ticket['ticket_key']) ?>
					<div class="mb-2">
						<textarea id="editor" class="form-control" name="content" placeholder="Content..."></textarea>
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
					<div>
						<input type="submit" name="reply" value="<?= $this->base->text('add_reply', 'button') ?>" class="btn btn-primary btn-pill">
						<a href="<?= base_url().'ticket/view/'.$ticket['ticket_key'].'?close=true' ?>" class="btn btn-pill btn-danger"><?= $this->base->text('close_ticket', 'button') ?></a>
					</div>
				</form>
			</div>
		</div>
	<?php endif ?>
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