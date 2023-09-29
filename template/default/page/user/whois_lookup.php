<div class="container-xl">
	<div class="page-header d-print-none">
		<h2 class="page-title py-3">
			<?= $this->base->text($title, 'title') ?>
		</h2>
	</div>
	<div class="card mb-2">
		<div class="card-header">
			<div class="card-title"><?= $this->base->text($title, 'title') ?></div>
		</div>
		<div class="card-body">
			<form action="<?= base_url() ?>whois/lookup" method="GET">
				<div class="mb-0">
					<div class="row">
						<div class="col-md-12">
							<input type="text" name="domain" class="form-control mb-2" placeholder="<?= $this->base->text('domain_name', 'label') ?>" value="<?php if ($this->input->get('domain') !== false): echo(strtolower($this->input->get('domain')));endif ?>" required>
						</div>
					</div>
					<input name="lookup" type="submit" class="btn btn-primary" value="<?= $this->base->text('lookup', 'button') ?>">
				</div>
			</form>
		</div>
	</div>
	<div class="card">
		<div class="card-header">
			<div class="card-title"><?= $this->base->text('search_result', 'heading') ?></div>
		</div>
		<div>
			<?php if ($this->input->get('domain')): ?>
				<?php if (validateDomain($this->input->get('domain'))): ?>
					<div>
						<pre class="mb-0"><?= trim(lookUpDomain($this->input->get('domain'))) ?></pre>
					</div>
				<?php else: ?>
					<div class="card-body">
						<?= $this->base->text('invalid_domain', 'error') ?>
					</div>
				<?php endif ?>
			<?php else: ?>
				<div class="card-body">
					<?= $this->base->text('search_note', 'paragraph') ?>
				</div>
			<?php endif ?>
		</div>
	</div>
</div>