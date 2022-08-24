<div class="container-xl">
	<div class="page-header d-print-none">
		<h2 class="page-title py-3">
			Client Info
		</h2>
	</div>
	<div class="card mb-3">
		<div class="card-body">
			<div class="row">
				<div class="col-md-4 text-center py-3">
					<img src="<?= $this->user->get_user_avatar($info['user_key']) ?>" class="img-fluid rounded">
				</div>
				<div class="col-md-8">
					<div class="row py-3">
						<p class="col-md-6">
							ID: <?= char8($info['user_id'].':'.$info['user_date'].':'.$info['user_key']) ?>
						</p>
						<p class="col-md-6">
							Name: <?= $info['user_name'] ?>
						</p>
						<p class="col-md-6">
							Email: <?= $info['user_email'] ?>
						</p>
						<p class="col-md-6">
							Secret Key: <?= $info['user_key'] ?>
						</p>
						<p class="col-md-6">
							Login Agent: <?php if ($this->user->get_oauth($info['user_key'])): ?>
								Oauth
							<?php else: ?>
								Built-in
							<?php endif ?>
						</p>
						<p class="col-md-6">
							Status: <?php if ($info['user_status'] == 'inactive'): ?>
										<span class="badge bg-yellow">
											<?= $info['user_status'] ?>
										</span>
									<?php elseif ($info['user_status'] == 'active'): ?>
										<span class="badge bg-green">
											<?= $info['user_status'] ?>
										</span>
									<?php endif ?>						</p>
						<p class="col-md-6">
							Registered: <?= date('d-m-Y', $info['user_date']) ?>
						</p>
						<div class="col-12">
							<?php if($info['user_status'] !== 'active'): ?>
								<a href="?active=true" class="btn btn-success">Activate</a>
							<?php endif ?>
							<a href="?login=true" class="btn btn-primary">Login</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>