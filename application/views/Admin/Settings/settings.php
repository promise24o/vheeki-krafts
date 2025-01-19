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
						<li class="breadcrumb-item">Settings</li>
						<li class="breadcrumb-item active">Farm Management</li>
					</ol>
				</div>
			</div>
		</div>

		<div class="card">
			<div class="card-body">
				<form role="form" action="<?= base_url('admin/update_settings') ?>" method="post" enctype="multipart/form-data">
					<div class="row">
						<div class="col-md-6">
							<div class="mb-3">
								<label for="exampleInputEmail1" class="form-label">System Name</label>
								<input type="text" class="form-control" name="name" value="<?= set_value('name', isset($settings['name']) ? $settings['name'] : ''); ?>" placeholder="System Name">
							</div>
							<div class="mb-3">
								<label for="exampleInputEmail1" class="form-label">Title</label>
								<input type="text" class="form-control" name="title" value="<?= set_value('title', isset($settings['title']) ? $settings['title'] : ''); ?>" placeholder="Title">
							</div>
							<div class="mb-3">
								<label for="exampleInputEmail1" class="form-label">Address</label>
								<input type="text" class="form-control" name="address" value="<?= set_value('address', isset($settings['address']) ? $settings['address'] : ''); ?>" placeholder="Address">
							</div>
							<div class="mb-3">
								<label for="exampleInputEmail1" class="form-label">Phone</label>
								<input type="text" class="form-control" name="phone" value="<?= set_value('phone', isset($settings['phone']) ? $settings['phone'] : ''); ?>" placeholder="Phone">
							</div>
							<div class="mb-3">
								<label for="exampleInputEmail1" class="form-label">E-mail</label>
								<input type="text" class="form-control" name="email" value="<?= set_value('email', isset($settings['email']) ? $settings['email'] : ''); ?>" placeholder="E-mail">
							</div>
						</div>

						<div class="col-md-6">
							<div class="mb-3">
								<label for="exampleInputEmail1" class="form-label">Currency</label>
								<input type="text" class="form-control" name="currency" value="<?= set_value('currency', isset($settings['currency']) ? $settings['currency'] : ''); ?>" placeholder="Currency">
							</div>

							<div class="mb-3">
								<label for="exampleInputEmail1" class="form-label">Livestock Unit</label>
								<input type="text" class="form-control" name="unit" value="<?= set_value('unit', isset($settings['unit']) ? $settings['unit'] : ''); ?>" placeholder="Livestock Unit">
							</div>

							<div class="mb-3">
								<label for="exampleInputEmail1" class="form-label">Date Format</label>
								<select class="form-select" name="date_format">
									<option value="d-m-Y" <?= isset($settings['date_format']) && $settings['date_format'] == 'd-m-Y' ? 'selected' : ''; ?>>dd-mm-yyyy</option>
									<option value="m/d/Y" <?= isset($settings['date_format']) && $settings['date_format'] == 'm/d/Y' ? 'selected' : ''; ?>>mm/dd/yyyy</option>
								</select>
							</div>

							<div class="mb-3">
								<label for="exampleInputEmail1" class="form-label">Login Title</label>
								<input type="text" class="form-control" name="login_title" value="<?= set_value('login_title', isset($settings['login_title']) ? $settings['login_title'] : ''); ?>" placeholder="Login Title">
							</div>

							<div class="row">
								<div class="mb-3 col-sm-6">
									<label for="exampleInputEmail1" class="form-label">Image</label>
									<input type="file" class="form-control" name="img_url">
								</div>
								<div class="mb-3 col-sm-6 text-center">
									<img class="img-thumbnail" style="height: 50px; width: 50px; margin-top: 15px;" src="<?= base_url('uploads/settings/logo.jpg')?>" alt="No Logo">
								</div>
							</div>
							<input type="hidden" name="id" value="<?= isset($settings['id']) ? $settings['id'] : ''; ?>">
						</div>
					</div>

					<div class="card-footer">
						<button type="submit" class="btn btn-primary btn-block w-100 py-2">Save Changes</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
