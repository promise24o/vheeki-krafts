<div class="page-body">
	<div class="container-fluid">
		<div class="page-title">
			<div class="row">
				<div class="col-6">
					<h4>Farm Management</h4>
				</div>
				<div class="col-6">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"> <a href="<?= base_url() ?>"><svg class="stroke-icon">
									<use href="<?= base_url() ?>assets/dashboard/svg/icon-sprite.svg#stroke-home"></use>
								</svg></a></li>
						<li class="breadcrumb-item">Profile</li>
						<li class="breadcrumb-item active">Farm Management</li>
					</ol>
				</div>
			</div>
		</div>

		<div class="row d-flex justify-content-center">
			<div class="col-12 col-md-8">
				<div class="card">
					<div class="card-header">
						<h5>Profile Information</h5>
					</div>
					<div class="card-body">
						<form method="post" action="<?= base_url('admin/update_profile') ?>">
							<div class="form- mb-3">
								<label for="name">Name</label>
								<input type="text" class="form-control" id="name" name="name" value="<?= $profile['admin_name'] ?>" required>
							</div>
							<div class="form-group mb-3">
								<label for="email">Email</label>
								<input type="email" class="form-control" id="email" name="email" value="<?= $profile['admin_email'] ?>" readonly>
							</div>
							<div class="form-group mb-3">
								<label for="password">New Password</label>
								<input type="password" class="form-control" id="password" name="password" placeholder="Enter new password">
							</div>
							<div class="form-group mb-3">
								<label for="confirm_password">Confirm New Password</label>
								<input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm new password">
							</div>
							<div class="text-center mt-3">
								<button type="submit" name="submit" class="btn btn-primary">
									<i class="fi fi-rr-paper-plane"></i> Update Profile
								</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
