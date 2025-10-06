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
		<div class="col-md-4">
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
								Registered Clients
							</div>
							<div class="text-muted">
								<?= $this->user->get_count('active') + $this->user->get_count('inactive') ?> in total
							</div>
						</div>
					</div>
					<div class="py-2" id="clients-chart"></div>
				</div>
			</div>
		</div>
		<div class="col-md-4">
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
								Hosting Accounts
							</div>
							<div class="text-muted">
								<?= $this->account->get_count('active') + $this->account->get_count('suspended') + $this->account->get_count('deactivated') ?> in total
							</div>
						</div>
					</div>
					<div class="py-2" id="accounts-chart"></div>
				</div>
			</div>
		</div>
		<div class="col-md-4">
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
								Support Tickets
							</div>
							<div class="text-muted">
								<?= $ci_tickets ?> in total
							</div>
						</div>
					</div>
					<div class="py-2" id="tickets-chart"></div>
				</div>
			</div>
		</div>
	</div>
	<div class="page-header d-print-none">
		<div class="row align-items-center">
			<div class="col">
				<h2 class="page-title py-3">
					Tools
				</h2>
			</div>
		</div>
	</div>
	<div class="row row-cards">
		<div class="col-md-4 col-lg-3 pb-2">
			<div class="card card-sm">
				<div class="card-body">
					<div class="row align-items-center">
						<div class="col-auto">
							<span class="text-white bg-orange avatar">
								<em class="fa fa-info"></em>
							</span>
						</div>
						<div class="col">
							<div class="font-weight-medium">
								About Xera
							</div>
							<div class="text-muted">
								<a href="<?= base_url() ?>about" class="text-muted" target="_blank">View here.</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-4 col-lg-3 pb-2">
			<div class="card card-sm">
				<div class="card-body">
					<div class="row align-items-center">
						<div class="col-auto">
							<span class="text-white bg-yellow avatar">
								<em class="fa fa-upload"></em>
							</span>
						</div>
						<div class="col">
							<div class="font-weight-medium">
								Check Updates
							</div>
							<div class="text-muted">
								<a href="<?= base_url() ?>update" class="text-muted" target="_blank">Check here.</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-4 col-lg-3 pb-2">
			<div class="card card-sm">
				<div class="card-body">
					<div class="row align-items-center">
						<div class="col-auto">
							<span class="text-white bg-info avatar">
								<em class="fa fa-book"></em>
							</span>
						</div>
						<div class="col">
							<div class="font-weight-medium">
								Documentation
							</div>
							<div class="text-muted">
								<a href="https://github.com/mahtab2003/Xera/blob/dev/Setup-Guide.md" class="text-muted" target="_blank">Setup Guide</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-4 col-lg-3 pb-2">
			<div class="card card-sm">
				<div class="card-body">
					<div class="row align-items-center">
						<div class="col-auto">
							<span class="text-white bg-green avatar">
								<em class="fa fa-bullhorn"></em>
							</span>
						</div>
						<div class="col">
							<div class="font-weight-medium">
								Need Help?
							</div>
							<div class="text-muted">
								<a href="https://github.com/mahtab2003/Xera/issues" class="text-muted" target="_blank">Open an issue in GitHub.</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-4 col-lg-3 pb-2">
			<div class="card card-sm">
				<div class="card-body">
					<div class="row align-items-center">
						<div class="col-auto">
							<span class="text-white bg-purple avatar">
								<em class="fa fa-tools"></em>
							</span>
						</div>
						<div class="col">
							<div class="font-weight-medium">
								Contribute
							</div>
							<div class="text-muted">
								<a href="https://github.com/mahtab2003/Xera/#help" class="text-muted" target="_blank">Check here.</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-4 col-lg-3 pb-2">
			<div class="card card-sm">
				<div class="card-body">
					<div class="row align-items-center">
						<div class="col-auto">
							<span class="text-white bg-pink avatar">
								<em class="fa fa-thumbs-up"></em>
							</span>
						</div>
						<div class="col">
							<div class="font-weight-medium">
								Like Xera?
							</div>
							<div class="text-muted">
								<a href="https://github.com/mahtab2003/Xera" class="text-muted" target="_blank">Star us on GitHub.</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-4 col-lg-3 pb-2">
			<div class="card card-sm">
				<div class="card-body">
					<div class="row align-items-center">
						<div class="col-auto">
							<span class="text-white bg-cyan avatar">
								<em class="fa fa-file-alt"></em>
							</span>
						</div>
						<div class="col">
							<div class="font-weight-medium">
								Terms of Service
							</div>
							<div class="text-muted">
								<a href="<?= base_url() ?>tos" class="text-muted" target="_blank">View here.</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-4 col-lg-3 pb-2">
			<div class="card card-sm">
				<div class="card-body">
					<div class="row align-items-center">
						<div class="col-auto">
							<span class="text-white bg-teal avatar">
								<em class="fa fa-file"></em>
							</span>
						</div>
						<div class="col">
							<div class="font-weight-medium">
								License
							</div>
							<div class="text-muted">
								<a href="<?= base_url() ?>license" class="text-muted" target="_blank">View here.</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="<?= base_url() ?>assets/<?= $this->base->get_template() ?>/js/apexcharts.min.js"></script>
<script type="text/javascript">
	var options = {
		series: [<?= $this->user->get_count('active'); ?>, <?= $this->user->get_count('inactive'); ?>],
		chart: {
			type: 'donut'
		},
		labels: ['Active', 'Inactive'],
		responsive: [{
			breakpoint: 480,
			options: {
				chart: {
					width: 275
				},
				legend: {
					position: 'bottom'
				}
			}
		}]
	};
	var options1 = {
		series: [<?= $this->account->get_count('active'); ?>, <?= $this->account->get_count('suspended') + $this->account->get_count('deactivated'); ?>],
		chart: {
			type: 'donut'
		},
		labels: ['Active', 'Inactive'],
		responsive: [{
			breakpoint: 480,
			options: {
				chart: {
					width: 275
				},
				legend: {
					position: 'bottom'
				}
			}
		}]
	};
	var options2 = {
		series: [<?= $this->ticket->get_count('open'); ?>, <?= $this->ticket->get_count('customer') + $this->ticket->get_count('support'); ?>, <?= $this->ticket->get_count('closed'); ?>],
		chart: {
			type: 'donut'
		},
		labels: ['Open', 'Replied', 'Closed'],
		responsive: [{
			breakpoint: 480,
			options: {
				chart: {
					width: 275
				},
				legend: {
					position: 'bottom'
				}
			}
		}]
	};
	var chart = new ApexCharts(document.querySelector("#clients-chart"), options);
	chart.render();
	var chart1 = new ApexCharts(document.querySelector("#accounts-chart"), options1);
	chart1.render();
	var chart2 = new ApexCharts(document.querySelector("#tickets-chart"), options2);
	chart2.render();
</script>
