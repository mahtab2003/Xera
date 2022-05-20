<div class="container-xl">
	<div class="page-header d-print-none">
		<h2 class="page-title py-3">
			Domain Checker
		</h2>
	</div>
	<div class="row">
		<div class="col-md-8">
			<div class="card mb-2">
				<div class="card-header">
					<div class="card-title">Domain Checker</div>
				</div>
				<div class="card-body">
					<div class="form">
						<div class="mb-0">
							<div class="row g-2">
								<div class="col">
									<input type="text" name="domain" class="form-control" placeholder="Domain name..." id="domain" value="<?php if ($domain !== false): 
											echo($domain);
									 	endif ?>">
								</div>
								<div class="col-auto">
									<a href="#" id="search" class="btn btn-primary">Search</a>
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
						<div class="card-title">Search Result</div>
					</div>
					<?php if($domain == false): ?>
						<div class="card-body">
							The search result will be displayed here once a domain name is searched.
						</div>
					<?php elseif ($data !== false): ?>
						<table class="table card-table table-transparent">
							<tr>
								<td>Account</td>
								<td><?= $data[3] ?></td>
							</tr>
							<tr>
								<td>Status</td>
								<td><?= $data[0] ?></td>
							</tr>
							<tr>
								<td>NS 1</td>
								<td>
									<?php if ($data[0] === 'ACTIVE'): ?>
										OK
									<?php else: ?>
										Error
									<?php endif ?>
								</td>
							</tr>
							<tr>
								<td>NS 2</td>
								<td>
									<?php if ($data[0] === 'ACTIVE'): ?>
										OK
									<?php else: ?>
										Error
									<?php endif ?>
								</td>
							</tr>
						</table>
					<?php else: ?>
						<div class="card-body">
							Sorry! this domain name is not assosiated with any of our web hosting accounts.
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
		search.href = '<?= base_url() ?>' + 'u/domain_checker/' + domain.value;
	}
</script>