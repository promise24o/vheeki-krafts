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
						<li class="breadcrumb-item">Staff Payment</li>
						<li class="breadcrumb-item active">Farm Management</li>
					</ol>
				</div>
			</div>
		</div>

		<div class="card">

			<div class="card-body">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12">
						<div class="card p-3 mb-4">
							<div class="row">
								<div class="col-md-4">
									<p><strong>Basic Information</strong></p>
									<table class="table">
										<tbody>
											<tr>
												<td width="40%">
													<img class="img-thumbnail" style="height: 140px; min-width: 140px; border-radius: 5px;" src="<?= $this->crud_model->get_image_url('staff', $staff_details->id) ?>" alt="No img">
												</td>
												<td width="60%">
													<p><strong>Staff:</strong> <?= $staff_details->name ?></p>
													<p><strong>E-mail:</strong> <?= $staff_details->email ?></p>
													<p><strong>Phone:</strong> <?= $staff_details->phone ?></p>
													<p><strong>Address:</strong> <?= $staff_details->address ?></p>
													<p><strong>Note:</strong> <?= $staff_details->description ?? 'No notes available' ?></p>
												</td>

											</tr>
										</tbody>
									</table>
								</div>
								<div class="col-md-4 text-center">
									<div>
										<ul class="list-unstyled">
											<li>
												<span><i class="fas fa-money-bill fs-3"></i></span>
											</li>
										</ul>
									</div>
									<div>
										<p><strong>Total Payment Amount</strong></p>
										<h3><?= number_format($total_payment_amount, 2) ?></h3>
									</div>

								</div>
								<div class="col-md-4 text-center">
									<div>
										<ul class="list-unstyled">
											<li>
												<span><i class="fas fa-money-bill-alt fs-3"></i></span>
											</li>
										</ul>
									</div>
									<div>
										<p>Payment Count</p>
										<h3><?= number_format($total_payment_count) ?></h3>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="card">
			<div class="card-header">
				<i class="fi fi-rr-list"></i>List of Farm Staff
			</div>
			<div class="card-body">
				<div class="card-header">
					<div class="d-flex justify-content-between mb-3">
						<div class="action-left">
							<a href="<?= base_url('admin/staff') ?>" class="btn btn-info px-3"><i class="fi fi-rr-angle-circle-left"></i></a>
							<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPaymentModal"><i class="fi fi-rr-add"></i> Add Payment</button>
						</div>
						<button class="btn btn-secondary" onclick="javascript:window.print();">
							<i class="fi fi-rr-print"></i> Print
						</button>
					</div>
				</div>
				<div class="table-responsive">
					<table id="basic-2" class="table table-striped table-bordered">
						<thead>
							<tr>
								<th>SL. No.</th>
								<th>Payment Amount</th>
								<th>Paid By</th>
								<th>Reference</th>
								<th>Date</th>
								<th>Description</th>
								<th>Created By</th>
								<th>Created At</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							<?php $count = 1; ?>
							<?php foreach ($payments as $payment): ?>
								<tr>
									<td><?= $count++ ?></td>
									<td><?= number_format($payment->sfp_payment_amount, 2) ?></td>
									<td><?= $payment->sfp_paid_by ?></td>
									<td><?= $payment->sfp_reference ?></td>
									<td><?= $payment->sfp_date ?></td>
									<td><?= $payment->sfp_description ?></td>
									<td><?= $payment->created_by_name ?></td>
									<td><?= $payment->sfp_created_at ?></td>
									<td>
										<a href="<?= base_url('admin/delete_staff_payment/' . $payment->sfp_id) ?>" onclick="return confirm('Are you sure you want to delete this payment?');">
											<button type="button" class="btn btn-danger btn-sm mb-2">
												<i class="fi fi-rr-trash"></i> Delete
											</button>
										</a>
									</td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>



			</div>
		</div>

	</div>
</div>

<div class="modal fade" id="addPaymentModal" tabindex="-1" aria-labelledby="addPaymentModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="addPaymentModalLabel">Add Client Payment</h4>
				<button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form role="form" action="<?= base_url('admin/add_staff_payment/' . $staff_details->encrypted_id) ?>" method="post">
					<div class="form-group mb-3">
						<label for="clientName">Name</label>
						<input type="text" class="form-control" name="name" id="clientName" value=" <?= $staff_details->name ?>" readonly>
					</div>
					<div class="form-group mb-3">
						<label for="paymentAmount">Payment Amount <span class="text-danger">*</span></label>
						<input type="number" class="form-control" name="payment_amount" id="paymentAmount" placeholder="Enter payment amount" required>
					</div>
					<div class="form-group mb-3">
						<label for="paidBy">Paid By</label>
						<select class="form-select" name="paid_by" id="paidBy" required>
							<option value="cash">Cash</option>
							<option value="cheque">Cheque</option>
							<option value="transfer">Transfer</option>
						</select>
					</div>
					<div class="form-group mb-3">
						<label for="referenceNumber">Ref. No</label>
						<input type="text" class="form-control" name="reference_number" id="referenceNumber" placeholder="Enter reference number">
					</div>
					<div class="form-group mb-3">
						<label for="paymentDate">Date <span class="text-danger">*</span></label>
						<input type="date" class="form-control" name="payment_date" id="paymentDate" value="2025-01-19" required>
					</div>
					<div class="form-group mb-3">
						<label for="paymentDescription">Description</label>
						<textarea name="description" class="form-control" id="paymentDescription" rows="5" placeholder="Enter description" style="height: auto !important;"></textarea>
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
