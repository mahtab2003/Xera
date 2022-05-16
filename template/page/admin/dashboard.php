<div class="container-xl">
	<div class="page-header d-print-none">
		<div class="row align-items-center">
			<div class="col">
				<h2 class="page-title py-3">
					Dashboard
				</h2>
			</div>
		</div>
	</div>
	<div class="row row-cards">
		<div class="col-md-6 col-lg-3">
			<div class="card card-sm">
				<div class="card-body">
					<div class="row align-items-center">
						<div class="col-auto">
							<span class="text-white bg-orange avatar">
								<i class="fa fa-users"></i>
							</span>
						</div>
						<div class="col">
							<div class="font-weight-medium">
								Active Clients
							</div>
							<div class="text-muted">
								<?= $ci_clients ?> in total
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6 col-lg-3">
			<div class="card card-sm">
				<div class="card-body">
					<div class="row align-items-center">
						<div class="col-auto">
							<span class="text-white bg-yellow avatar">
								<i class="fa fa-server"></i>
							</span>
						</div>
						<div class="col">
							<div class="font-weight-medium">
								Active Accounts
							</div>
							<div class="text-muted">
								<?= $ci_accounts ?> in total
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6 col-lg-3">
			<div class="card card-sm">
				<div class="card-body">
					<div class="row align-items-center">
						<div class="col-auto">
							<span class="text-white bg-info avatar">
								<i class="fa fa-bullhorn"></i>
							</span>
						</div>
						<div class="col">
							<div class="font-weight-medium">
								Waiting Tickets
							</div>
							<div class="text-muted">
								<?= $ci_tickets ?> in total
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6 col-lg-3">
			<div class="card card-sm">
				<div class="card-body">
					<div class="row align-items-center">
						<div class="col-auto">
							<span class="text-white bg-purple avatar">
								<i class="fa fa-envelope-open"></i>
							</span>
						</div>
						<div class="col">
							<div class="font-weight-medium">
								Email Templates
							</div>
							<div class="text-muted">
								<?= $ci_templates ?> in total
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>