		</div>
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
	<script type="text/javascript">
		var coll = document.getElementsByClassName("trigger");
		var i;
		for (i = 0; i < coll.length; i++) {
		  coll[i].addEventListener("click", function() {
		    var contenter = this.getAttribute("data-toggle");
			var content = document.getElementById(contenter);
		    if (content.type === "password") {
			    content.type = "text";
		    } else if(content.type === "text") {
			    content.type = "password";
		    }
		  });
		}
	</script>
</body>
</html>
