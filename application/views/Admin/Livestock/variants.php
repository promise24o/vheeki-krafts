<div class="page-body">
	<div class="container-fluid">
		<div class="page-title">
			<div class="row">
				<div class="col-6">
					<h4>Livestock Variant Management</h4>
				</div>
				<div class="col-6">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"> <a href="<?= base_url() ?>"><svg class="stroke-icon">
									<use href="<?= base_url() ?>assets/dashboard/svg/icon-sprite.svg#stroke-home"></use>
								</svg></a></li>
						<li class="breadcrumb-item">Livestock List</li>
						<li class="breadcrumb-item active">Livestock Variant</li>
					</ol>
				</div>
			</div>
		</div>



		<div class="card">
			<div class="card-header">
				<i class="fi fi-rr-list"></i>List of Livestock Variants for <?= $livestock->ls_name ?>
			</div>
			<div class="card-body">
				<div class="d-flex justify-content-between mb-3">
					<a data-bs-toggle="modal" data-bs-target="#addVariantModal" class="btn btn-primary">
						<i class="fi fi-rs-add"></i> Add New Variant
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
								<th>Variant Name</th>
								<th>Purchase Quantity </th>
								<th>Description</th>
								<th>Options</th>
							</tr>
						</thead>
						<tbody>
							<?php $count = 1; ?>
							<?php foreach ($variants as $variant): ?>
								<tr>
									<td><?= $count++ ?></td>
									<td><?= $variant->lst_title ?></td>
									<td><?= $variant->purchase_quantity ?></td>
									<td><?= $variant->lst_description ?></td>
									<td>
										<button type="button" class="btn btn-warning btn-sm mb-2" data-bs-toggle="modal" data-bs-target="#editVariantModal<?= $variant->encrypted_id ?>">
											<i class="fi fi-rr-edit"></i> Edit
										</button>
										<a href="<?= base_url('admin/delete_variant/' . $variant->encrypted_id) ?>" onclick="return confirm('Are you sure you want to delete this variant?');">
											<button type="button" class="btn btn-danger btn-sm mb-2">
												<i class="fi fi-rr-trash"></i> Delete
											</button>
										</a>
									</td>
								</tr>

								<!-- Edit Variant Modal -->
								<div class="modal fade" id="editVariantModal<?= $variant->encrypted_id ?>" tabindex="-1" aria-labelledby="editVariantModalLabel" aria-hidden="true">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<h4 class="modal-title" id="editVariantModalLabel">Edit Variant</h4>
												<button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
											</div>
											<div class="modal-body">
												<form role="form" action="<?= base_url('admin/update_livestock_variant/' . $variant->encrypted_id) ?>" method="post">
													<div class="form-group mb-3">
														<label for="variantTitle">Variant Title <span class="text-danger">*</span></label>
														<input type="text" class="form-control" name="title" id="variantTitle" value="<?= $variant->lst_title ?>" required>
													</div>
													<div class="form-group mb-3">
														<label for="variantDescription">Description</label>
														<textarea name="description" class="form-control" id="variantDescription" rows="3"><?= $variant->lst_description ?></textarea>
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

<!-- Add Variant Modal -->
<div class="modal fade" id="addVariantModal" tabindex="-1" aria-labelledby="addVariantModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="addVariantModalLabel">Add New Variant</h4>
				<button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form role="form" action="<?= base_url('admin/add_livestock_variant/' . $livestock->ls_id) ?>" method="post">

					<input type="hidden" name="livestock_id" value="<?= $livestock->ls_id ?>">

					<div class="form-group mb-3">
						<label for="livestockName">Livestock Name</label>
						<input type="text" class="form-control" name="livestock_name" id="livestockName" value="<?= $livestock->ls_name ?>" readonly>
					</div>
					<div class="form-group mb-3">
						<label for="variantTitle">Type Title <span class="text-danger">*</span></label>
						<input type="text" class="form-control" name="variant_title" id="variantTitle" placeholder="Enter Title" required>
					</div>
					<div class="form-group mb-3">
						<label for="variantDescription">Description</label>
						<textarea name="variant_description" class="form-control" id="variantDescription" rows="3" placeholder="Enter Description"></textarea>
					</div>
					<div class="text-center mt-3">
						<button type="submit" class="btn btn-primary">
							<i class="fi fi-rr-paper-plane"></i> Submit
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
