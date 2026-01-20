<div class="container-xl">
	<div class="page-header d-print-none">
		<div class="row align-items-center">
			<div class="col">
            <h2 class="page-title py-3">
                <?= $this->base->text('email_templates', 'title') ?>
            </h2>
			</div>
		</div>
	</div>
	<div class="card mb-3 border-bottom-0 rounded">
		<div class="card-header">
            <div class="card-title"><?= $this->base->text('your_templates', 'heading') ?></div>
		</div>
		<div class="table-responsive">
			<table class="table card-table table-vcenter table-transparent text-nowrap table-nowrap">
				<thead>
					<tr>
                        <th width="5%">ID</th>
                        <th width="75%"><?= $this->base->text('subject', 'table') ?></th>
                        <th width="15%">Trigger</th>
                        <th width="5%" class="text-center"><?= $this->base->text('action', 'table') ?></th>
					</tr>
				</thead>
				<tbody>
					<?php if (count($list) > 0): ?>
						<?php foreach ($list as $item): ?>
							<tr>
								<td><?php echo $count = $count ?? 1 ?></td>
								<td><?= $item['email_subject'] ?></td>
								<td><?= strtoupper($item['email_id']) ?></td>
                                <td><a href="<?= base_url().'email/edit/'.$item['email_id'] ?>" class="btn btn-sm"><?= $this->base->text('manage', 'button') ?></a></td>
							</tr>
						<?php $count += 1; ?>
						<?php endforeach; ?>
					<?php else: ?>
						<tr>
                            <td colspan="5" class="text-center"><?= $this->base->text('nothing_to_show', 'paragraph') ?></td>
						</tr>
					<?php endif ?>
				</tbody>
			</table>
		</div>
		<div class="card-footer py-2">
            <div class=""><?= count($list) ?> Sendable Emails</div>
		</div>
	</div>
</div>