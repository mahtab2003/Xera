<div class="page page-center">
    <div class="container-tight py-4">
        <div class="text-center mb-4">
            <a href="<?= base_url() ?>" class="navbar-brand navbar-brand-autodark">Xera</a>
        </div>
        <div class="card card-md">
            <div class="card-body">
                <h2 class="card-title text-center mb-4">Two Factor Authentication</h2>
                <?= form_open('2fa') ?>
                    <div class="mb-3">
                        <label class="form-label">Authentication code</label>
                        <input type="text" name="code" class="form-control" placeholder="123456" autocomplete="one-time-code">
                    </div>
                    <div class="form-footer">
                        <button type="submit" name="verify_2fa" class="btn btn-primary w-100">Verify and continue</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="text-center text-muted mt-3">
            <a href="<?= base_url('login') ?>">Return to login</a>
        </div>
    </div>
</div>
