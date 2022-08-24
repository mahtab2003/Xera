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
								<?= $ci_clients ?> in total
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
								<?= $ci_accounts ?> in total
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
	</div><div class="page-header d-print-none">
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
								<i class="fa fa-info"></i>
							</span>
						</div>
						<div class="col">
							<div class="font-weight-medium">
								About Xera
							</div>
							<div class="text-muted">
								<a href="<?= base_url() ?>e/about" class="text-muted" target="_blank">View here.</a>
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
								<i class="fa fa-upload"></i>
							</span>
						</div>
						<div class="col">
							<div class="font-weight-medium">
								Check Updates
							</div>
							<div class="text-muted">
								<a href="<?= base_url() ?>e/update" class="text-muted" target="_blank">Check here.</a>
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
								<i class="fa fa-book"></i>
							</span>
						</div>
						<div class="col">
							<div class="font-weight-medium">
								Documentation
							</div>
							<div class="text-muted">
								<a href="https://fourm.xera.eu.org" class="text-muted" target="_blank">Read here.</a>
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
								<i class="fa fa-bullhorn"></i>
							</span>
						</div>
						<div class="col">
							<div class="font-weight-medium">
								Need Help?
							</div>
							<div class="text-muted">
								<a href="mailto:mahtabhassan159@gmail.com" class="text-muted" target="_blank">Email here.</a>
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
								<i class="fa fa-tools"></i>
							</span>
						</div>
						<div class="col">
							<div class="font-weight-medium">
								Contribute
							</div>
							<div class="text-muted">
								<a href="https://github.com/mahtab2003/Xera/" class="text-muted" target="_blank">Check here.</a>
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
								<i class="fa fa-thumbs-up"></i>
							</span>
						</div>
						<div class="col">
							<div class="font-weight-medium">
								Like Xera?
							</div>
							<div class="text-muted">
								<a href="https://getmofhy.eu.org/#donate" class="text-muted" target="_blank">Donate here.</a>
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
								<i class="fa fa-file-alt"></i>
							</span>
						</div>
						<div class="col">
							<div class="font-weight-medium">
								Term of Services
							</div>
							<div class="text-muted">
								<a href="<?= base_url() ?>e/tos" class="text-muted" target="_blank">View here.</a>
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
								<i class="fa fa-file"></i>
							</span>
						</div>
						<div class="col">
							<div class="font-weight-medium">
								License
							</div>
							<div class="text-muted">
								<a href="<?= base_url() ?>e/license" class="text-muted" target="_blank">View here.</a>
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
		series: [<?= $this->account->get_count('active'); ?>, <?= $this->user->get_count('suspended') + $this->user->get_count('deactivated'); ?>],
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