<div class="page-body">
	<div class="container-fluid">
		<div class="page-title">
			<div class="row">
				<div class="col-6">
					<h4>Livestock Management</h4>
				</div>
				<div class="col-6">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"> <a href="<?= base_url() ?>"><svg class="stroke-icon">
									<use href="<?= base_url() ?>assets/dashboard/svg/icon-sprite.svg#stroke-home"></use>
								</svg></a></li>
						<li class="breadcrumb-item">Purchase</li>
						<li class="breadcrumb-item active">Livestock Management</li>
					</ol>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-xl-3 col-sm-6">
				<div class="card o-hidden small-widget">
					<div class="card-body total-project border-b-primary border-2">
						<span class="f-light f-w-500 f-14">Total Purchased</span>
						<div class="project-details">
							<div class="project-counter">
								<h5 class="f-w-600">94,736</h5>
							</div>
							<div class="product-sub bg-blue-light">
								<svg class="invoice-icon">
									<use href="../assets/svg/icon-sprite.svg#road"></use>
								</svg>
							</div>
						</div>
						<ul class="bubbles">
							<li class="bubble"></li>
							<li class="bubble"></li>
							<li class="bubble"></li>
							<li class="bubble"></li>
							<li class="bubble"></li>
							<li class="bubble"></li>
							<li class="bubble"></li>
							<li class="bubble"></li>
							<li class="bubble"></li>
						</ul>
					</div>
				</div>
			</div>

			<div class="col-xl-3 col-sm-6">
				<div class="card o-hidden small-widget">
					<div class="card-body total-project border-b-primary border-2">
						<span class="f-light f-w-500 f-14">Reproduction</span>
						<div class="project-details">
							<div class="project-counter">
								<h5 class="f-w-600">3,335,005</h5>
							</div>
							<div class="product-sub bg-blue-light">
								<svg class="invoice-icon">
									<use href="../assets/svg/icon-sprite.svg#road"></use>
								</svg>
							</div>
						</div>
						<ul class="bubbles">
							<li class="bubble"></li>
							<li class="bubble"></li>
							<li class="bubble"></li>
							<li class="bubble"></li>
							<li class="bubble"></li>
							<li class="bubble"></li>
							<li class="bubble"></li>
							<li class="bubble"></li>
							<li class="bubble"></li>
						</ul>
					</div>
				</div>
			</div>

			<div class="col-xl-3 col-sm-6">
				<div class="card o-hidden small-widget">
					<div class="card-body total-project border-b-secondary border-2">
						<span class="f-light f-w-500 f-14">Assigned to Shed</span>
						<div class="project-details">
							<div class="project-counter">
								<h5 class="f-w-600">3,437,835</h5>
							</div>
							<div class="product-sub bg-blue-light">
								<svg class="invoice-icon">
									<use href="../assets/svg/icon-sprite.svg#road"></use>
								</svg>
							</div>
						</div>
						<ul class="bubbles">
							<li class="bubble"></li>
							<li class="bubble"></li>
							<li class="bubble"></li>
							<li class="bubble"></li>
							<li class="bubble"></li>
							<li class="bubble"></li>
							<li class="bubble"></li>
							<li class="bubble"></li>
							<li class="bubble"></li>
						</ul>
					</div>
				</div>
			</div>

			<div class="col-xl-3 col-sm-6">
				<div class="card o-hidden small-widget">
					<div class="card-body total-project border-b-info border-2">
						<span class="f-light f-w-500 f-14">Total Unassigned</span>
						<div class="project-details">
							<div class="project-counter">
								<h5 class="f-w-600">-8,094</h5>
							</div>
							<div class="product-sub bg-blue-light">
								<svg class="invoice-icon">
									<use href="../assets/svg/icon-sprite.svg#road"></use>
								</svg>
							</div>
						</div>
						<ul class="bubbles">
							<li class="bubble"></li>
							<li class="bubble"></li>
							<li class="bubble"></li>
							<li class="bubble"></li>
							<li class="bubble"></li>
							<li class="bubble"></li>
							<li class="bubble"></li>
							<li class="bubble"></li>
							<li class="bubble"></li>
						</ul>
					</div>
				</div>
			</div>
		</div>


		<div class="card">
			<div class="card-header">
				<i class="fi fi-rr-list"></i>List of Purchases
			</div>
			<div class="card-body">
				<div class="d-flex justify-content-between mb-3">
					<a href="<?= base_url('admin/add_new_purchase') ?>" class="btn btn-primary">
						<i class="fi fi-rs-add"></i> Add New Purchase
					</a>
					<div class="btn-group">
						<button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#informationPopup"><i class="fi fi-rr-info"></i> Information</button>
						<button class="btn btn-info" onclick="javascript:window.print();">
							<i class="fi fi-rr-print"></i> Print
						</button>
					</div>
				</div>
				<div class="table-responsive">
					<table id="basic-2" class="table table-striped table-bordered">
						<thead>
							<tr>
								<th>SL. No.</th>
								<th>Purchase Bill</th>
								<th>Purchase Date</th>
								<th>Supplier</th>
								<th>Total Purchased</th>
								<th>Options</th>
							</tr>
						</thead>
						<tbody>
							<?php $count = 1; ?>
							<?php foreach ($livestocks as $livestock): ?>
								<tr>
									<td><?= $count++ ?></td>
									<td><?= $livestock->purchase_bill ?></td>
									<td><?= $livestock->purchase_date ?></td>
									<td><?= $livestock->supplier ?></td>
									<td><?= $livestock->total_purchased ?></td>
									<td>
										<a href="<?= base_url('admin/invoice/' . $livestock->encrypted_id) ?>">
											<button type="button" class="btn btn-info btn-sm">
												<i class="fi fi-rr-file-invoice"></i> INVOICE
											</button>
										</a>
										<?php if (isset($livestock->editable) && $livestock->editable): ?>
											<button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal<?= $livestock->encrypted_id ?>">
												<i class="fi fi-rr-edit"></i> Edit
											</button>
											<a href="<?= base_url('admin/delete_livestock/' . $livestock->encrypted_id) ?>">
												<button type="button" class="btn btn-danger btn-sm">
													<i class="fi fi-rr-trash"></i> Delete
												</button>
											</a>
										<?php endif; ?>
									</td>
								</tr>
								<div class="modal fade" id="editModal<?= $livestock->encrypted_id ?>" tabindex="-1" aria-hidden="true">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
											</div>
											<div class="modal-body">
												<form action="<?= base_url('admin/update_livestock/' . $livestock->encrypted_id) ?>" method="post">
													<div class="form-group mb-3">
														<input type="text" class="form-control" name="name" value="<?= $livestock->name ?>" required>
													</div>
													<div class="form-group mb-3">
														<textarea name="description" class="form-control" rows="3"><?= $livestock->description ?></textarea>
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

<div class="modal fade" id="addLivestockModal" tabindex="-1" aria-labelledby="addLivestockModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="addLivestockModalLabel">Add New Livestock</h4>
				<button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form role="form" action="<?= base_url('admin/add_livestock') ?>" method="post" enctype="multipart/form-data">
					<div class="form-group mb-3">
						<label for="livestockName">Livestock Name <span class="text-danger">*</span></label>
						<input type="text" class="form-control" name="name" id="livestockName" placeholder="Enter livestock name" required>
					</div>
					<div class="form-group mb-3">
						<label for="livestockDescription">Description</label>
						<textarea name="description" class="form-control" id="livestockDescription" rows="5" placeholder="Enter description"></textarea>
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

<div class="modal fade" id="informationPopup" tabindex="-1" aria-labelledby="informationPopupLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header bg-purple">
				<h5 class="modal-title" id="informationPopupLabel"><strong><i class="fa-solid fa-circle-info"></i> Basic Information</strong></h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-12">
						<ol class="information__modal__ol">
							<li>
								<p>You will not be able to purchase livestock without creating "<b>livestock</b>" and <b>variant</b>.</p>
							</li>
							<li>
								<p>So, at first click "<b>Add New Livestock</b>" button and create new livestock.</p>
							</li>
							<li>
								<p>Then create livestock variant under created livestock to click <b>Add Variant</b> button.</p>
							</li>
							<li>
								<p>After creating this, go to purchase module and purchase livestock.</p>
							</li>
							<li>
								<p>After purchasing livestock under created livestock and you will not be able to delete livestock and variant. You will be able to edit these.</p>
							</li>
						</ol>
					</div>
				</div>
				<div class="text-end">
					<button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fa-solid fa-xmark"></i> Close</button>
				</div>
			</div>
		</div>
	</div>
</div>
