<div class="container-xl">
	<div class="page-header d-print-none">
		<h2 class="page-title py-3">
			View Ticket
		</h2>
	</div>
	<div class="card mb-3">
		<div class="card-header">
			<div class="card-title">Information</div>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col-sm-6">
					<div class="row align-items-center">
						<span class="col">Status:</span>
						<span class="col-auto ms-auto">
							<?php if ($ticket['ticket_status'] == 'open'): ?>
								<span class="badge bg-orange">
									<?= $ticket['ticket_status'] ?>
								</span>
							<?php elseif ($ticket['ticket_status'] == 'support' OR $ticket['ticket_status'] == 'customer'): ?>
								<span class="badge bg-green">
									<?= $ticket['ticket_status'] ?>
								</span>
							<?php elseif ($ticket['ticket_status'] == 'closed'): ?>
								<span class="badge bg-red">
									<?= $ticket['ticket_status'] ?>
								</span>
							<?php endif ?>
						</span>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="row align-items-center">
						<span class="col">Opened by:</span>
						<span class="col-auto ms-auto"><?= $this->ticket->get_user_name($ticket['ticket_for']) ?></span>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="row align-items-center">
						<span class="col">Opened at:</span>
						<span class="col-auto ms-auto"><?= date('d-m-Y', $ticket['ticket_time']) ?></span>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="row align-items-center">
						<span class="col">Last Reply:</span>
						<span class="col-auto ms-auto"><?php if(count($replies)>0): ?>
						<?= date('d-m-Y', $replies[count($replies)-1]['reply_time']); ?>
						<?php else: ?>
							NEVER
						<?php endif; ?>
						</span>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="row align-items-center">
						<span class="col">User Email:</span>
						<span class="col-auto ms-auto"><?= $this->ticket->get_user_email($ticket['ticket_for']) ?></span>
					</div>
				</div>
			</div>
		</div>
		<div class="card-footer">
			<div class="row align-items-center">
				<span class="col">Subject:</span>
				<span class="col-auto ms-auto"><?= html_escape($ticket['ticket_subject']) ?></span>
			</div>
		</div>
	</div>
	<div class="card mb-3">
		<div class="card-header d-block">
			<div class="row align-items-center">
				<span class="col">
					<span class="avatar avatar-xs me-2" style="background-image: url(<?= base_url() ?>assets/<?= $this->base->get_template() ?>/img/user.png)"></span>
					<?= $this->ticket->get_user_name($ticket['ticket_for']) ?>
				</span>
				<span class="col-auto ms-auto"><?= date('d-m-Y', $ticket['ticket_time']) ?></span>
			</div>
		</div>
		<div class="card-body pb-0">
			<div>
				<?= html_escape($ticket['ticket_content']) ?>
			</div>
		</div>
	</div>
	<?php if (count($replies) > 0): ?>
        <?php
			if ($this->input->get('page')) :
				$mcount = $this->base->rpp() * $this->input->get('page') + 1;
			else :
				$mcount = 1;
			endif;
			$count = $mcount - 1;
			?>
        <div class="card mb-3">
            <div class="card-body pb-0">
		<?php foreach ($replies as $reply): ?>
			<?php if ($reply['reply_by'] !== $this->admin->get_key()): 
				$reply_name = $this->ticket->get_user_name($reply['reply_by']);
				$ico = base_url().'assets/'. $this->base->get_template(). '/img/user.png';
			 else:
			  	$reply_name = $this->ticket->get_admin_name($reply['reply_by']);
			  	$ico = base_url().'assets/'. $this->base->get_template(). '/img/fav.png';
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
						<?= html_escape($reply['reply_content']) ?>
					</div>
				</div>
			</div>
			<?php $count += 1; ?>
		<?php endforeach ?>
        <div class="card mb-3">
			<div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
			    	<div>
			    		Showing <?php if (isset($mcount)) : echo $mcount;
			    				else : echo 0;
			    				endif; ?> to <?php if (isset($count)) : echo $count;
											else : echo 0;
											endif; ?> of <?= $this->ticket->list_count_reply($id); ?> entries
			    	</div>
			    	<div>
			    		<?php $page = $this->input->get('page') ?? 0 ?>
			    		<ul class="pagination mb-0">
			    			<li class="page-item <?php if ($page < 1) : ?>disabled<?php endif ?>">
			    				<a class="page-link" <?php if ($page > 0) : ?>href="<?= base_url() ?>admin/ticket/view/<?= $id ?>?page=<?= $page - 1 ?>" <?php endif ?>>
			    					<span>&laquo;</span>
			    				</a>
			    			</li>
			    			<li class="page-item <?php if ($count >= $this->ticket->list_count_reply($id)) : ?>disabled<?php endif ?>">
			    				<a class="page-link" <?php if ($count < $this->ticket->list_count_reply($id)) : ?>href="<?= base_url() ?>admin/ticket/view/<?= $id ?>?page=<?= $page + 1 ?>" <?php endif ?>>
			    					<span>&raquo;</span>
			    				</a>
			    			</li>
			    		</ul>
			    	</div>
			    </div>
            </div>
        </div>
	</div>
    </div>
	<?php else: ?>
		<div class="card mb-3">
			<div class="card-body">
				No reply found.
			</div>
		</div>
	<?php endif ?>
	<?php if ($ticket['ticket_status'] == 'closed'): ?>
		<div class="card mb-3">
			<div class="card-status-start bg-red"></div>
			<div class="card-body">
				The ticket has been closed. Click <a href="<?= base_url().'admin/ticket/view/'.$ticket['ticket_key'].'?open=true' ?>">here</a> to re-open.
			</div>
		</div>
	<?php else: ?>
		<div class="card mb-3" id="box">
			<div class="card-header">
				<div class="card-title">Make a reply</div>
			</div>
			<div class="card-body">
				<?= form_open('admin/ticket/view/'.$ticket['ticket_key']) ?>
					<div class="mb-2">
						<textarea id="editor" class="form-control" name="content"></textarea>
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
							<?php elseif ($this->grc->get_type() == "turnstile") : ?>
								<script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
								<div class="cf-turnstile" data-sitekey="<?= $this->grc->get_site_key(); ?>" data-callback="javascriptCallback"></div>
							<?php endif ?>
						</div>
					<?php endif ?>
					<div>
						<input type="submit" name="reply" value="Add reply" class="btn btn-primary btn-pill">
						<a href="<?= base_url().'admin/ticket/view/'.$ticket['ticket_key'].'?close=true' ?>" class="btn btn-pill btn-danger">Close Ticket</a>
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