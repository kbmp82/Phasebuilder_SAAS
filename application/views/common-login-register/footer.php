<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="<?php echo $this->config->base_url(); ?>signin/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo $this->config->base_url(); ?>signin/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo $this->config->base_url(); ?>signin/vendor/bootstrap/js/popper.js"></script>
	<script src="<?php echo $this->config->base_url(); ?>signin/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo $this->config->base_url(); ?>signin/vendor/select2/select2.min.js"></script>
	<script>
		$(".selection-2").select2({
			minimumResultsForSearch: 20,
			dropdownParent: $('#dropDownSelect1')
		});
	</script>
<!--===============================================================================================-->
	<script src="<?php echo $this->config->base_url(); ?>signin/vendor/daterangepicker/moment.min.js"></script>
	<script src="<?php echo $this->config->base_url(); ?>signin/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo $this->config->base_url(); ?>signin/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo $this->config->base_url(); ?>signin/js/main.js"></script>
 <script src="<?php echo base_url() ?>main/js/jquery.validate.min.js"></script>
    <script src="<?php echo base_url() ?>main/js/jquery.validate-init.js"></script>
</body>
</html>