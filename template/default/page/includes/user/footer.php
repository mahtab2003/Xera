	</div>

	<div class="hidden-area" style="position: fixed; bottom: 0; right: 0;">
		<?php  
		if(isset($_SESSION['msg'])){
			$msg = json_decode($_SESSION['msg'], true);
			if($msg[0] == 0)
			{
				$class = 'danger';
			}
			else
			{
				$class = 'success';
			}
			$message = $msg[1];
			echo '<div class="alert alert-'.$class.' alert-dismissible" role="alert">
				'.$message.'
				<a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
				</div>';
			unset($_SESSION['msg']);
		}
		?>
	</div>
	
	<script src="<?= base_url()?>assets/<?= $this->base->get_template() ?>/js/jquery.slim.js"></script>
	<script src="<?= base_url()?>assets/<?= $this->base->get_template() ?>/js/tabler.min.js"></script>
</body>
</html>