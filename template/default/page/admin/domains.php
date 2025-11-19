<div class="container-xl">
	<div class="page-header d-print-none">
		<div class="row align-items-center">
			<div class="col">
                <h2 class="page-title py-3">
                    <?= $this->base->text('domain_extensions', 'title') ?>
                </h2>
			</div>
		</div>
	</div>
	<div class="card mb-3 rounded">
		<div class="card-header">
            <div class="card-title">
                <?= $this->base->text('add_extension', 'heading') ?>
            </div>
		</div>
		<div class="card-body">
		<form action="">
			<div class="mb-0">
				<div class="row g-2">
					<div class="col">
                        <input type="text" name="domain" class="form-control" placeholder="<?= $this->base->text('domain_name', 'label') ?>...">
					</div>
					<div class="col-auto">
                        <input type="submit" name="add_domain" value="<?= $this->base->text('add', 'button') ?>" class="btn btn-primary">
					</div>
				</div>
			</div>
		</form>
		</div>
	</div>
	<div class="card">
		<div class="card-header">
            <div class="card-title">
                <?= $this->base->text('total_extensions', 'heading') ?>
            </div>
		</div>
		<div class="table-responsive">
			<table class="table  card-table table-transparent text-nowrap card-table">
				<thead>
					<tr>
                        <th width="5%">ID</th>
                        <th width="90%">&nbsp;<?= $this->base->text('domain', 'table') ?></th>
                        <th width="5%">&nbsp;<?= $this->base->text('action', 'table') ?></th>
					</tr>
				</thead>
				<?php if(count($list)>0): ?>
				<?php $count = 1 ?>
				<?php foreach ($list as $item): ?>
					<tr>
						<td>
							<?= $count ?>
						</td>
						<td>
							<?= $item['domain_name'] ?>
						</td>
						<td>
                            <a href="?rm_domain=true&domain=<?= $item['domain_name'] ?>" class="btn btn-sm btn-red rounded"><?= $this->base->text('delete', 'button') ?></a>
						</td>
					</tr>
					<?php $count += 1 ?>
				<?php endforeach ?>
			<?php else: ?>
				<tr class="text-center">
                    <td colspan="2"><?= $this->base->text('nothing_to_show', 'paragraph') ?></td>
				</tr>
			<?php endif; ?>
			</table>
		</div>
		<div class="card-footer py-2">
			<?= count($list) ?> Domains
		</div>
	</div>
</div>