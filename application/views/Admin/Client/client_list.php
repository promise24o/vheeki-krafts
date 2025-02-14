<div class="page-body">
	<div class="container-fluid">
		<div class="page-title">
			<div class="row">
				<div class="col-6">
					<h4>Client Management</h4>
				</div>
				<div class="col-6">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"> <a href="<?= base_url() ?>"><svg class="stroke-icon">
									<use href="<?= base_url() ?>assets/dashboard/svg/icon-sprite.svg#stroke-home"></use>
								</svg></a></li>
						<li class="breadcrumb-item">Client List</li>
						<li class="breadcrumb-item active">Client Management</li>
					</ol>
				</div>
			</div>
		</div>

		<div class="card">
			<div class="card-header">
				<i class="fi fi-rr-list"></i>List of Clients
			</div>
			<div class="card-body">
				<div class="d-flex justify-content-between mb-3">
					<a data-bs-toggle="modal" data-bs-target="#addClientModal" class="btn btn-primary">
						<i class="fi fi-rs-add"></i> Add New Client
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
							<?php foreach ($client_list as $client): ?>
								<tr>
									<td><?= $count++ ?></td>
									<td>
										<img src="<?= $this->crud_model->get_image_url('clients', $client->id) ?>" alt="Client Image" class="img-thumbnail" style="width: 50px; height: 50px;">
									</td>
									<td><?= $client->name ?></td>
									<td><?= $client->email ?></td>
									<td><?= $client->phone ?></td>
									<td><?= $client->address ?></td>
									<td>
										<button type="button" class="btn btn-warning btn-sm mb-2" data-bs-toggle="modal" data-bs-target="#editClientModal<?= $client->id ?>">
											<i class="fi fi-rr-edit"></i> Edit
										</button>
										<a href="<?= base_url('admin/delete_client/' . $client->encrypted_id) ?>" onclick="return confirm('Are you sure you want to delete this client?');">
											<button type="button" class="btn btn-danger btn-sm mb-2">
												<i class="fi fi-rr-trash"></i> Delete
											</button>
										</a>
										<a href="<?= base_url('admin/client_ledgers/' . $client->encrypted_id) ?>">
											<button type="button" class="btn btn-info btn-sm mb-2">
												<i class="fi fi-rr-credit-card"></i> Ledgers
											</button>
										</a>
									</td>
								</tr>

								<!-- Edit Modal -->
								<div class="modal fade" id="editClientModal<?= $client->id ?>" tabindex="-1" aria-labelledby="editClientModalLabel" aria-hidden="true">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<h4 class="modal-title" id="editClientModalLabel">Edit Client</h4>
												<button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
											</div>
											<div class="modal-body">
												<form role="form" action="<?= base_url('admin/update_client/' . $client->encrypted_id) ?>" method="post" enctype="multipart/form-data">
													<div class="form-group mb-3">
														<label for="clientName">Name <span class="text-danger">*</span></label>
														<input type="text" class="form-control" name="name" id="clientName" value="<?= $client->name ?>" placeholder="Enter name" required>
													</div>
													<div class="form-group mb-3">
														<label for="clientEmail">Email</label>
														<input type="email" class="form-control" name="email" id="clientEmail" value="<?= $client->email ?>" placeholder="Enter email">
													</div>
													<div class="form-group mb-3">
														<label for="clientPhone">Phone <span class="text-danger">*</span></label>
														<input type="text" class="form-control" name="phone" id="clientPhone" value="<?= $client->phone ?>" placeholder="Enter phone" required>
													</div>
													<div class="form-group mb-3">
														<label for="clientAddress">Address</label>
														<input type="text" class="form-control" name="address" id="clientAddress" value="<?= $client->address ?>" placeholder="Enter address">
													</div>
													<div class="form-group mb-3">
														<label for="clientDescription">Description</label>
														<textarea name="description" class="form-control" id="clientDescription" rows="3" placeholder="Enter description"><?= $client->description ?></textarea>
													</div>
													<div class="form-group mb-3">
														<label for="clientImage">Photo</label>
														<input type="file" class="form-control" name="client_image" id="clientImage">
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

<div class="modal fade" id="addClientModal" tabindex="-1" aria-labelledby="addClientModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="addClientModalLabel">Add New Client</h4>
				<button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form role="form" action="<?= base_url('admin/add_client') ?>" method="post" enctype="multipart/form-data">
					<div class="form-group mb-3">
						<label for="clientName">Name <span class="text-danger">*</span></label>
						<input type="text" class="form-control" name="name" id="clientName" placeholder="Enter name" required>
					</div>
					<div class="form-group mb-3">
						<label for="clientEmail">E-mail</label>
						<input type="email" class="form-control" name="email" id="clientEmail" placeholder="Enter email">
					</div>
					<div class="form-group mb-3">
						<label for="clientPhone">Phone <span class="text-danger">*</span></label>
						<input type="text" class="form-control" name="phone" id="clientPhone" placeholder="Enter phone number" required>
					</div>
					<div class="form-group mb-3">
						<label for="clientAddress">Address</label>
						<input type="text" class="form-control" name="address" id="clientAddress" placeholder="Enter address">
					</div>
					<div class="form-group mb-3">
						<label for="clientDescription">Description</label>
						<textarea name="description" class="form-control" id="clientDescription" rows="5" placeholder="Enter description" style="height: auto !important;"></textarea>
					</div>
					<div class="form-group mb-3">
						<label for="clientImage">Image</label>
						<input type="file" class="form-control" name="client_image" id="clientImage">
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
