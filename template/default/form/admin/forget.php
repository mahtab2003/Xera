<?= form_open('admin/forget', ['class' => 'card card-md']) ?>
	<div class="card-body">
		<h2 class="card-title text-center mb-3">Forgot password</h2>
		<p class="text-muted mb-3">Enter your email address and your password will be reset and emailed to you.</p>
		<div class="mb-3">
			<label class="form-label">Email address</label>
			<input type="email" name="email" class="form-control" placeholder="Enter email">
		</div>
		<div class="form-footer mt-1">
			<input type="submit" class="btn btn-primary w-100" name="forget" value="Send me a new password">
		</div>
	</div>
</form>
<div class="text-center text-muted mt-3">
	Forget it, <a href="<?= base_url();?>admin/login" tabindex="-1">send me back</a> to the sign in screen.
</div>