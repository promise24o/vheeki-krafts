<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<script src="<?= base_url() ?>assets/landing/vendors/jquery/jquery-3.7.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<style>
	.toast-success {
		background-color: #28a745 !important;
		color: white !important;
	}

	.toast-error {
		background-color: #dc3545 !important;
		color: white !important;
	}

	.toast-message,
	.toast-title {
		color: white !important;
	}
</style>

<!-- SHOW TOASTR NOTIFICATION -->
<?php if ($this->session->flashdata('success') != "") : ?>
	<script type="text/javascript">
		toastr.success('<?php echo $this->session->flashdata("success"); ?>', "Success Message", {
			timeOut: 5000,
			closeButton: true,
			debug: false,
			newestOnTop: true,
			progressBar: true,
			positionClass: "toast-top-right",
			preventDuplicates: true,
			onclick: null,
			showDuration: "300",
			hideDuration: "1000",
			extendedTimeOut: "1000",
			showEasing: "swing",
			hideEasing: "linear",
			showMethod: "fadeIn",
			hideMethod: "fadeOut",
			tapToDismiss: false
		})
	</script>
<?php endif; ?>

<!-- SHOW TOASTR NOTIFICATION -->
<?php if ($this->session->flashdata('error') != "") : ?>
	<script type="text/javascript">
		toastr.error('<?php echo $this->session->flashdata("error"); ?>', "Error Message", {
			timeOut: 5000,
			closeButton: true,
			debug: false,
			newestOnTop: true,
			progressBar: true,
			positionClass: "toast-top-right",
			preventDuplicates: true,
			onclick: null,
			showDuration: "300",
			hideDuration: "1000",
			extendedTimeOut: "1000",
			showEasing: "swing",
			hideEasing: "linear",
			showMethod: "fadeIn",
			hideMethod: "fadeOut",
			tapToDismiss: false
		})
	</script>
<?php endif; ?>

</html>
