<!-- Page Sidebar Ends-->
<div class="page-body">
	<div class="container-fluid">
		<div class="page-title">
			<div class="row">
				<div class="col-6">
					<h4>
						Farm Management</h4>
				</div>
				<div class="col-6">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"> <a href="<?= base_url()  ?>">
								<svg class="stroke-icon">
									<use href="<?= base_url()  ?>assets/dashboard/svg/icon-sprite.svg#stroke-home"></use>
								</svg></a></li>
						<li class="breadcrumb-item">Dashboard </li>
						<li class="breadcrumb-item active">Farm Management</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
	<!-- Container-fluid starts -->
	<div class="container-fluid">
		<?php $this->load->view('Admin/Components/dashboardcards'); ?>

		<div class="row">
			<?php $this->load->view('Admin/Components/incomeExpenseStatement'); ?>
			<?php $this->load->view('Admin/Components/quickList'); ?>
			<?php $this->load->view('Admin/Components/livestockStockChart'); ?>
			<?php $this->load->view('Admin/Components/foodStockList'); ?>
		</div>
	</div>
	<!-- Container-fluid Ends -->
</div>
