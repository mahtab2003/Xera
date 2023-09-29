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
			<form action="<?= base_url() ?>dns/lookup" method="GET">
				<div class="mb-0">
					<div class="row">
						<div class="col-md-6">
							<input type="text" name="domain" class="form-control mb-2" placeholder="<?= $this->base->text('domain_name', 'label') ?>" value="<?php if ($this->input->get('domain') !== false): echo(strtolower($this->input->get('domain')));endif ?>" required>
						</div>
						<div class="col-md-6">
							<select name="type" class="form-control mb-2">
								<option>A</option>
								<option>AAAA</option>
								<option>CNAME</option>
								<option>TXT</option>
								<option>MX</option>
								<option>NS</option>
							</select>
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
				<?php @$dns = dns_get_record($this->input->get('domain'), $type[$this->input->get('type')]); ?>
				<?php if ($dns): ?>
					<?php if ($dns): ?>
						<table class="table card-table table-responsive">
							<tr>
								<?php foreach ($fields[$this->input->get('type')] as $value): ?>
									<th><?= $value ?></th>
								<?php endforeach ?>
							</tr>
							<?php foreach ($dns as $key => $record): ?>
								<tr>
									<?php foreach ($fields[$this->input->get('type')] as $field => $value): ?>
										<td><?= $dns[$key][$field] ?></td>
									<?php endforeach ?>
								</tr>
							<?php endforeach ?>
						</table>
					<?php endif ?>
				<?php else: ?>
					<div class="card-body">
						<?= $this->base->text('cant_lookup', 'error') ?>
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