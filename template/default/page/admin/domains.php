<div class="container-xl">
	<div class="page-header d-print-none">
		<div class="row align-items-center">
			<div class="col">
				<h2 class="page-title py-3">
					Domain Extensions
				</h2>
			</div>
		</div>
	</div>
	<div class="card mb-3 rounded">
		<div class="card-header">
			<div class="card-title">
				Add Extension
			</div>
		</div>
		<div class="card-body">
		<form action="">
			<div class="mb-0">
				<div class="row g-2">
					<div class="col">
						<input type="text" name="domain" class="form-control" placeholder="Domain name...">
					</div>
					<div class="col-auto">
						<input type="submit" name="add_domain" value="Add" class="btn btn-primary">
					</div>
				</div>
			</div>
		</form>
		</div>
	</div>
	<div class="card">
		<div class="card-header">
			<div class="card-title">
				Total Extensions
			</div>
		</div>
		<div class="table-responsive">
			<table class="table  card-table table-transparent text-nowrap card-table">
				<thead>
					<tr>
						<th width="5%">ID</th>
						<th width="90%">Domain</th>
						<th width="5%">Action</th>
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
							<a href="?rm_domain=true&domain=<?= $item['domain_name'] ?>" class="btn btn-sm btn-red rounded">Delete</a>
						</td>
					</tr>
					<?php $count += 1 ?>
				<?php endforeach ?>
			<?php else: ?>
				<tr class="text-center">
					<td colspan="2">Nothing found</td>
				</tr>
			<?php endif; ?>
			</table>
		</div>
		<div class="card-footer py-2">
			<?= count($list) ?> Domains
		</div>
	</div>
</div>