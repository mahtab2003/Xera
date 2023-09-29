<div class="container-xl">
	<div class="page-header d-print-none">
		<h2 class="page-title py-3">
			Settings
		</h2>
	</div>
	<div class="card mb-3">
		<div class="card-header">
			<div class="card-title">General</div>
		</div>
		<div class="card-body">
			<?= form_open('admin/account/settings/'.$id) ?>
				<div class="row">
					<div class="col-sm-12">
						<label class="form-label">Account Label</label>
						<input type="text" name="label" placeholder="Account label..." class="form-control mb-2" value="<?= $data['account_label'] ?>">
						<input type="submit" name="update_label" value="Change" class="btn btn-primary btn-pill">
					</div>
				</div>
			</form>
		</div>
	</div>
	<div class="card mb-3">
		<div class="card-header">
			<div class="card-title">Security</div>
		</div>
		<div class="card-body">
			<?= form_open('admin/account/settings/'.$id) ?>
				<div class="row">
					<div class="col-sm-12">
						<label class="form-label">New password</label>
						<input type="password" name="password" class="form-control mb-2" placeholder="New password...">
						<label class="form-label">Old password</label>
						<input type="password" name="old_password" class="form-control mb-2" placeholder="Old password...">
						<input type="submit" name="update_password" value="Change" class="btn btn-primary btn-pill">
					</div>
				</div>
			</form>
		</div>
	</div>
	<div class="card mb-3">
		<div class="card-header">
			<div class="card-title">Deactivation</div>
		</div>
		<div class="card-body">
			<?= form_open('admin/account/settings/'.$id) ?>
				<div class="row">
					<div class="col-sm-12">
						<div class="alert alert-danger">
							Please remove all domains and subdomains before deactivating your account otherwise all domains and subdomains on this account will be locked forever.
						</div>
						<label class="form-label">Reason</label>
						<textarea name="reason" class="form-control mb-2" placeholder="Reason for account deactivation..."></textarea>
						<input type="submit" name="deactivate" class="btn btn-danger btn-pill" value="Deactivate">
					</div>
				</div>
			</form>
		</div>
	</div>
</div>