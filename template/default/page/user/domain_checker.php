<div class="container-xl">
	<div class="page-header d-print-none">
		<h2 class="page-title py-3">
			<?= $this->base->text($title, 'title') ?>
		</h2>
	</div>
	<div class="row">
		<div class="col-md-8">
			<div class="card mb-2">
				<div class="card-header">
					<div class="card-title"><?= $this->base->text($title, 'title') ?></div>
				</div>
				<div class="card-body">
					<div class="form">
						<div class="mb-0">
							<div class="row g-2">
								<div class="col">
									<input type="text" name="domain" class="form-control" placeholder="<?= $this->base->text('domain_name', 'label') ?>" id="domain" value="<?php if ($domain !== false): 
											echo($domain);
									 	endif ?>">
								</div>
								<div class="col-auto">
									<a href="#" id="search" class="btn btn-primary"><?= $this->base->text('search', 'button') ?></a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="col-md-8">
				<div class="card mb-2">
					<div class="card-header">
						<div class="card-title"><?= $this->base->text('search_result', 'heading') ?></div>
					</div>
					<?php if($domain == false): ?>
						<div class="card-body">
							<?= $this->base->text('search_note', 'paragraph') ?>
						</div>
					<?php elseif ($data !== false): ?>
						<table class="table card-table table-transparent">
							<tr>
								<td><?= $this->base->text('account', 'heading') ?></td>
								<td><?= $data[3] ?></td>
							</tr>
							<tr>
								<td><?= $this->base->text('status', 'heading') ?></td>
								<td><?= $data[0] ?></td>
							</tr>
							<tr>
								<td><?= $this->base->text('nameserver', 'heading') ?> 1</td>
								<td>
									<?php if ($data[0] === 'ACTIVE'): ?>
										<?= $this->base->text('ok', 'label') ?>
									<?php else: ?>
										<?= $this->base->text('error', 'label') ?>
									<?php endif ?>
								</td>
							</tr>
							<tr>
								<td><?= $this->base->text('nameserver', 'heading') ?> 2</td>
								<td>
									<?php if ($data[0] === 'ACTIVE'): ?>
										<?= $this->base->text('ok', 'label') ?>
									<?php else: ?>
										<?= $this->base->text('error', 'label') ?>
									<?php endif ?>
								</td>
							</tr>
						</table>
					<?php else: ?>
						<div class="card-body">
							<?= $this->base->text('search_error', 'paragraph') ?>
						</div>
					<?php endif ?>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	var domain = document.getElementById('domain');
	domain.onchange = function(){
		var search = document.getElementById('search');
		search.href = '<?= base_url() ?>' + 'domain/checker/' + domain.value;
	}
</script>