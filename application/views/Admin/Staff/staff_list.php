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
						<li class="breadcrumb-item">Staff List</li>
						<li class="breadcrumb-item active">Farm Management</li>
					</ol>
				</div>
			</div>
		</div>

		<div class="card">
			<div class="card-header">
				<i class="fi fi-rr-list"></i>List of Farm Staff
			</div>
			<div class="card-body">
				<div class="d-flex justify-content-between mb-3">
					<a data-bs-toggle="modal" data-bs-target="#addStaffModal" class="btn btn-primary">
						<i class="fi fi-rs-add"></i> Add New Staff
					</a>
					<button class="btn btn-info" onclick="javascript:window.print();">
						<i class="fi fi-rr-print"></i> Print
					</button>
				</div>
				<div class="table-responsive">
					<table id="basic-2" class="table table-striped table-bordered">
						<thead>
							<tr>
								<th>SL. No.</th>
								<th>Photo</th>
								<th>Name</th>
								<th>Email</th>
								<th>Phone</th>
								<th>Address</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							<?php $count = 1; ?>
							<?php foreach ($staff_list as $staff): ?>
								<tr>
									<td><?= $count++ ?></td>
									<td>
										<img src="<?= $this->crud_model->get_image_url('staff', $staff->id) ?>" alt="Staff Image" class="img-thumbnail" style="width: 50px; height: 50px;">
									</td>
									<td><?= $staff->name ?></td>
									<td><?= $staff->email ?></td>
									<td><?= $staff->phone ?></td>
									<td><?= $staff->address ?></td>
									<td>
										<button type="button" class="btn btn-warning btn-sm mb-2" data-bs-toggle="modal" data-bs-target="#editStaffModal<?= $staff->id ?>">
											<i class="fi fi-rr-edit"></i> Edit
										</button>
										<a href="<?= base_url('admin/delete_staff/' . $staff->encrypted_id) ?>" onclick="return confirm('Are you sure you want to delete this staff?');">
											<button type="button" class="btn btn-danger btn-sm mb-2">
												<i class="fi fi-rr-trash"></i> Delete
											</button>
										</a>
										<a href="<?= base_url('admin/staff_payments/' . $staff->encrypted_id) ?>">
											<button type="button" class="btn btn-info btn-sm mb-2">
												<i class="fi fi-rr-credit-card"></i> Payments
											</button>
										</a>
									</td>
								</tr>

								<!-- Edit Modal -->
								<div class="modal fade" id="editStaffModal<?= $staff->id ?>" tabindex="-1" aria-labelledby="editStaffModalLabel" aria-hidden="true">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<h4 class="modal-title" id="editStaffModalLabel">Edit Staff</h4>
												<button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
											</div>
											<div class="modal-body">
												<form role="form" action="<?= base_url('admin/update_staff/' . $staff->encrypted_id) ?>" method="post" enctype="multipart/form-data">
													<div class="form-group mb-3">
														<label for="staffName">Name <span class="text-danger">*</span></label>
														<input type="text" class="form-control" name="name" id="staffName" value="<?= $staff->name ?>" placeholder="Enter name" required>
													</div>
													<div class="form-group mb-3">
														<label for="staffEmail">Email</label>
														<input type="email" class="form-control" name="email" id="staffEmail" value="<?= $staff->email ?>" placeholder="Enter email">
													</div>
													<div class="form-group mb-3">
														<label for="staffPassword">Password</label>
														<input type="password" class="form-control" name="password" id="staffPassword" placeholder="Enter password">
													</div>
													<div class="form-group mb-3">
														<label for="staffPhone">Phone <span class="text-danger">*</span></label>
														<input type="text" class="form-control" name="phone" id="staffPhone" value="<?= $staff->phone ?>" placeholder="Enter phone" required>
													</div>
													<div class="form-group mb-3">
														<label for="staffAddress">Address</label>
														<input type="text" class="form-control" name="address" id="staffAddress" value="<?= $staff->address ?>" placeholder="Enter address">
													</div>
													<div class="form-group mb-3">
														<label for="staffDescription">Description</label>
														<textarea name="description" class="form-control" id="staffDescription" rows="3" placeholder="Enter description"><?= $staff->description ?></textarea>
													</div>
													<div class="form-group mb-3">
														<label for="staffImage">Photo</label>
														<input type="file" class="form-control" name="staff_image" id="staffImage">
													</div>
													<div class="text-center mt-3">
														<button type="submit" class="btn btn-primary">
															<i class="fi fi-rr-paper-plane"></i> Update
														</button>
													</div>
												</form>
											</div>
										</div>
									</div>
								</div>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>


			</div>
		</div>

	</div>
</div>

<div class="modal fade" id="addStaffModal" tabindex="-1" aria-labelledby="addStaffModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="addStaffModalLabel">Add New Staff</h4>
				<button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form role="form" action="<?= base_url('admin/add_staff') ?>" method="post" enctype="multipart/form-data">
					<div class="form-group mb-3">
						<label for="staffName">Name <span class="text-danger">*</span></label>
						<input type="text" class="form-control" name="name" id="staffName" placeholder="Enter name" required>
					</div>
					<div class="form-group mb-3">
						<label for="staffEmail">E-mail</label>
						<input type="email" class="form-control" name="email" id="staffEmail" placeholder="Enter email">
					</div>
					<div class="form-group mb-3">
						<label for="staffPhone">Phone <span class="text-danger">*</span></label>
						<input type="text" class="form-control" name="phone" id="staffPhone" placeholder="Enter phone number" required>
					</div>
					<div class="form-group mb-3">
						<label for="staffAddress">Address</label>
						<input type="text" class="form-control" name="address" id="staffAddress" placeholder="Enter address">
					</div>
					<div class="form-group mb-3">
						<label for="staffPassword">Password <span class="text-danger">*</span></label>
						<input type="password" class="form-control" name="password" id="staffPassword" placeholder="Enter password" required>
					</div>
					<div class="form-group mb-3">
						<label for="staffDescription">Description</label>
						<textarea name="description" class="form-control" id="staffDescription" rows="5" placeholder="Enter description" style="height: auto !important;"></textarea>
					</div>
					<div class="form-group mb-3">
						<label for="staffImage">Image</label>
						<input type="file" class="form-control" name="staff_image" id="staffImage">
					</div>
					<div class="text-center mt-3">
						<button type="submit" name="submit" class="btn btn-primary">
							<i class="fi fi-rr-paper-plane"></i> Submit
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
