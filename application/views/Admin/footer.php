	<!-- footer start-->
	<footer class="footer">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12 footer-copyright text-center">
					<p class="mb-0">
						<script>
							document.write(`Copyright ${new Date().getFullYear()} © Designed and Developed by SoftPath Tech`);
						</script>
					</p>

				</div>
			</div>
		</div>
	</footer>
	</div>
	</div>
	<!-- latest jquery-->
	<script src="<?= base_url()  ?>assets/dashboard/js/jquery.min.js"></script>
	<!-- Bootstrap js-->
	<script src="<?= base_url()  ?>assets/dashboard/js/bootstrap/bootstrap.bundle.min.js"></script>
	<!-- feather icon js-->
	<script src="<?= base_url()  ?>assets/dashboard/js/icons/feather-icon/feather.min.js"></script>
	<script src="<?= base_url()  ?>assets/dashboard/js/icons/feather-icon/feather-icon.js"></script>
	<!-- scrollbar js-->
	<script src="<?= base_url()  ?>assets/dashboard/js/scrollbar/simplebar.js"></script>
	<script src="<?= base_url()  ?>assets/dashboard/js/scrollbar/custom.js"></script>
	<!-- Sidebar jquery-->
	<script src="<?= base_url()  ?>assets/dashboard/js/config.js"></script>
	<!-- Plugins JS start-->
	<script src="<?= base_url()  ?>assets/dashboard/js/sidebar-menu.js"></script>
	<script src="<?= base_url()  ?>assets/dashboard/js/sidebar-pin.js"></script>
	<script src="<?= base_url()  ?>assets/dashboard/js/slick/slick.min.js"></script>
	<script src="<?= base_url()  ?>assets/dashboard/js/slick/slick.js"></script>
	<script src="<?= base_url()  ?>assets/dashboard/js/header-slick.js"></script>
	<script src="<?= base_url()  ?>assets/dashboard/js/chart/apex-chart/apex-chart.js"></script>
	<script src="<?= base_url()  ?>assets/dashboard/js/chart/apex-chart/stock-prices.js"></script>
	<script src="<?= base_url()  ?>assets/dashboard/js/chart/apex-chart/moment.min.js"></script>
	<script src="<?= base_url()  ?>assets/dashboard/js/notify/bootstrap-notify.min.js"></script>
	<!-- calendar js-->
	<script src="<?= base_url()  ?>assets/dashboard/js/dashboard/default.js"></script>
	<script src="<?= base_url()  ?>assets/dashboard/js/notify/index.js"></script>
	<script src="<?= base_url()  ?>assets/dashboard/js/typeahead/handlebars.js"></script>
	<script src="<?= base_url()  ?>assets/dashboard/js/typeahead/typeahead.bundle.js"></script>
	<script src="<?= base_url()  ?>assets/dashboard/js/typeahead/typeahead.custom.js"></script>
	<script src="<?= base_url()  ?>assets/dashboard/js/typeahead-search/handlebars.js"></script>
	<script src="<?= base_url()  ?>assets/dashboard/js/typeahead-search/typeahead-custom.js"></script>
	<script src="<?= base_url()  ?>assets/dashboard/js/height-equal.js"></script>
	<script src="<?= base_url()  ?>assets/dashboard/js/animation/wow/wow.min.js"></script>

	<script src="<?= base_url()  ?>assets/dashboard/js/datatable/datatables/jquery.dataTables.min.js"></script>
	<script src="<?= base_url()  ?>assets/dashboard/js/datatable/datatables/datatable.custom.js"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	
	<!-- Plugins JS Ends-->
	<!-- Theme js-->
	<script src="<?= base_url()  ?>assets/dashboard/js/script.js"></script>
	<script>
		new WOW().init();
	</script>



	<!-- SHOW TOASTR NOTIFICATION -->
	<?php if ($this->session->flashdata('success') != "") : ?>

		<script type="text/javascript">
			toastr.success('<?php echo $this->session->flashdata("success"); ?>', "Success Message", {
				timeOut: 500000000,
				closeButton: !0,
				debug: !1,
				newestOnTop: !0,
				progressBar: !0,
				positionClass: "toast-top-right",
				preventDuplicates: !0,
				onclick: null,
				showDuration: "300",
				hideDuration: "1000",
				extendedTimeOut: "1000",
				showEasing: "swing",
				hideEasing: "linear",
				showMethod: "fadeIn",
				hideMethod: "fadeOut",
				tapToDismiss: !1
			})
		</script>

	<?php endif; ?>

	<!-- SHOW TOASTR NOTIFICATION -->
	<?php if ($this->session->flashdata('error') != "") : ?>

		<script type="text/javascript">
			toastr.error('<?php echo $this->session->flashdata("error"); ?>', "Error Message", {
				positionClass: "toast-top-right",
				timeOut: 5e3,
				closeButton: !0,
				debug: !1,
				newestOnTop: !0,
				progressBar: !0,
				preventDuplicates: !0,
				onclick: null,
				showDuration: "300",
				hideDuration: "1000",
				extendedTimeOut: "1000",
				showEasing: "swing",
				hideEasing: "linear",
				showMethod: "fadeIn",
				hideMethod: "fadeOut",
				tapToDismiss: !1
			})
		</script>

	<?php endif; ?>

	</body>

	</html>
