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
						<li class="breadcrumb-item">Unit Setup</li>
						<li class="breadcrumb-item active">Farm Management</li>
					</ol>
				</div>
			</div>
		</div>

		<div class="card">
			<div class="card-header">
				<i class="fi fi-rr-list"></i> List Product Unit
			</div>
			<div class="card-body">
				<div class="d-flex justify-content-between mb-3">
					<a data-bs-toggle="modal" data-bs-target="#addUnitModal" class="btn btn-primary">
						<i class="fi fi-rs-add"></i> Add New Unit
					</a>
					<button class="btn btn-info" onclick="javascript:window.print();">
						<i class="fi fi-rr-print"></i> Print
					</button>
				</div>
				<div class="table-responsive">
					<table class="table table-striped table-bordered">
						<thead>
							<tr>
								<th>SL. No.</th>
								<th>Unit Name</th>
								<th>Descriptions</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							<?php $count = 1; ?>
							<?php foreach ($units as $unit): ?>
								<tr>
									<td><?= $count++ ?></td>
									<td><?= $unit['unit_name'] ?></td>
									<td><?= $unit['unit_description'] ?></td>
									<td>
										<button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editUnitModal<?= $unit['unit_id'] ?>" data-id="<?= $unit['unit_id'] ?>" data-name="<?= $unit['unit_name'] ?>" data-description="<?= $unit['unit_description'] ?>">
											<i class="fi fi-rr-edit"></i> Edit
										</button>
										<a href="<?= base_url('admin/delete_unit?unit_id=' . $unit['encrypted_id']) ?>" onclick="return confirm('Are you sure you want to delete this item?');">
											<button type="button" class="btn btn-danger">
												<i class="fi fi-rr-trash"></i> Delete
											</button>
										</a>
									</td>
								</tr>

								<!-- Edit Modal -->
								<div class="modal fade" id="editUnitModal<?= $unit['unit_id'] ?>" tabindex="-1" aria-labelledby="editUnitModalLabel" aria-hidden="true">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<h4 class="modal-title" id="editUnitModalLabel">Edit Unit</h4>
												<button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
											</div>
											<div class="modal-body">
												<form role="form" action="<?= base_url('admin/update_unit_settings/' . $unit['encrypted_id']) ?>" method="post" enctype="multipart/form-data">
													<div class="form-group">
														<label for="unitName">Name <span class="text-danger">*</span></label>
														<input type="text" class="form-control" name="un_name" id="unitName" value="<?= $unit['unit_name'] ?>" placeholder="Enter unit name" required>
													</div>
													<div class="form-group">
														<label for="unitDescription">Description</label>
														<textarea name="un_description" class="form-control" id="unitDescription" rows="5" placeholder="Enter description" style="height: auto !important;"><?= $unit['unit_description'] ?></textarea>
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
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>

			</div>
		</div>

	</div>
</div>

<div class="modal fade" id="addUnitModal" tabindex="-1" aria-labelledby="addUnitModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="addUnitModalLabel">Add New Unit</h4>
				<button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form role="form" action="<?= base_url('admin/create_unit_settings') ?>" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label for="unitName">Name <span class="text-danger">*</span></label>
						<input type="text" class="form-control" name="un_name" id="unitName" value="" placeholder="Enter unit name" required>
					</div>
					<div class="form-group">
						<label for="unitDescription">Description</label>
						<textarea name="un_description" class="form-control" id="unitDescription" rows="5" placeholder="Enter description" style="height: auto !important;"></textarea>
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
