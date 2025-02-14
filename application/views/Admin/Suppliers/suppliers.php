<div class="page-body">
	<div class="container-fluid">
		<div class="page-title">
			<div class="row">
				<div class="col-6">
					<h4>Supplier Management</h4>
				</div>
				<div class="col-6">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"> <a href="<?= base_url() ?>"><svg class="stroke-icon">
									<use href="<?= base_url() ?>assets/dashboard/svg/icon-sprite.svg#stroke-home"></use>
								</svg></a></li>
						<li class="breadcrumb-item">Supplier List</li>
						<li class="breadcrumb-item active">Supplier Management</li>
					</ol>
				</div>
			</div>
		</div>

		<div class="card">
			<div class="card-header">
				<i class="fi fi-rr-list"></i>List of Suppliers
			</div>
			<div class="card-body">
				<div class="d-flex justify-content-between mb-3">
					<a data-bs-toggle="modal" data-bs-target="#addSupplierModal" class="btn btn-primary">
						<i class="fi fi-rs-add"></i> Add New Supplier
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
							<?php foreach ($suppliers as $supplier): ?>
								<tr>
									<td><?= $count++ ?></td>
									<td>
										<img src="<?= $this->crud_model->get_image_url('suppliers', $supplier->id) ?>" alt="Supplier Image" class="img-thumbnail" style="width: 50px; height: 50px;">
									</td>
									<td><?= $supplier->name ?></td>
									<td><?= $supplier->email ?></td>
									<td><?= $supplier->phone ?></td>
									<td><?= $supplier->address ?></td>
									<td>
										<button type="button" class="btn btn-warning btn-sm mb-2" data-bs-toggle="modal" data-bs-target="#editClientModal<?= $supplier->id ?>">
											<i class="fi fi-rr-edit"></i> Edit
										</button>
										<a href="<?= base_url('admin/delete_supplier/' . $supplier->encrypted_id) ?>" onclick="return confirm('Are you sure you want to delete this supplier?');">
											<button type="button" class="btn btn-danger btn-sm mb-2">
												<i class="fi fi-rr-trash"></i> Delete
											</button>
										</a>
										<a href="<?= base_url('admin/supplier_ledgers/' . $supplier->encrypted_id) ?>">
											<button type="button" class="btn btn-info btn-sm mb-2">
												<i class="fi fi-rr-credit-card"></i> Ledgers
											</button>
										</a>
									</td>
								</tr>

								<!-- Edit Modal -->
								<div class="modal fade" id="editClientModal<?= $supplier->id ?>" tabindex="-1" aria-labelledby="editClientModalLabel" aria-hidden="true">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<h4 class="modal-title" id="editClientModalLabel">Edit Supplier</h4>
												<button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
											</div>
											<div class="modal-body">
												<form role="form" action="<?= base_url('admin/update_supplier/' . $supplier->encrypted_id) ?>" method="post" enctype="multipart/form-data">
													<div class="form-group mb-3">
														<label for="supplierName">Name <span class="text-danger">*</span></label>
														<input type="text" class="form-control" name="name" id="supplierName" value="<?= $supplier->name ?>" placeholder="Enter name" required>
													</div>
													<div class="form-group mb-3">
														<label for="supplierEmail">Email</label>
														<input type="email" class="form-control" name="email" id="supplierEmail" value="<?= $supplier->email ?>" placeholder="Enter email">
													</div>
													<div class="form-group mb-3">
														<label for="supplierPhone">Phone <span class="text-danger">*</span></label>
														<input type="text" class="form-control" name="phone" id="supplierPhone" value="<?= $supplier->phone ?>" placeholder="Enter phone" required>
													</div>
													<div class="form-group mb-3">
														<label for="supplierAddress">Address</label>
														<input type="text" class="form-control" name="address" id="supplierAddress" value="<?= $supplier->address ?>" placeholder="Enter address">
													</div>
													<div class="form-group mb-3">
														<label for="supplierDescription">Description</label>
														<textarea name="description" class="form-control" id="supplierDescription" rows="3" placeholder="Enter description"><?= $supplier->description ?></textarea>
													</div>
													<div class="form-group mb-3">
														<label for="supplierImage">Photo</label>
														<input type="file" class="form-control" name="supplier_image" id="supplierImage">
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

<div class="modal fade" id="addSupplierModal" tabindex="-1" aria-labelledby="addSupplierModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="addSupplierModalLabel">Add New Supplier</h4>
				<button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">`
				<form role="form" action="<?= base_url('admin/add_supplier') ?>" method="post" enctype="multipart/form-data">
					<div class="form-group mb-3">
						<label for="supplierName">Name <span class="text-danger">*</span></label>
						<input type="text" class="form-control" name="name" id="supplierName" placeholder="Enter name" required>
					</div>
					<div class="form-group mb-3">
						<label for="supplierEmail">E-mail</label>
						<input type="email" class="form-control" name="email" id="supplierEmail" placeholder="Enter email">
					</div>
					<div class="form-group mb-3">
						<label for="supplierPhone">Phone <span class="text-danger">*</span></label>
						<input type="text" class="form-control" name="phone" id="supplierPhone" placeholder="Enter phone number" required>
					</div>
					<div class="form-group mb-3">
						<label for="supplierAddress">Address</label>
						<input type="text" class="form-control" name="address" id="supplierAddress" placeholder="Enter address">
					</div>
					<div class="form-group mb-3">
						<label for="supplierDescription">Description</label>
						<textarea name="description" class="form-control" id="supplierDescription" rows="5" placeholder="Enter description" style="height: auto !important;"></textarea>
					</div>
					<div class="form-group mb-3">
						<label for="supplierImage">Image</label>
						<input type="file" class="form-control" name="supplier_image" id="supplierImage">
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
