<div class="page-body">
	<div class="container-fluid">
		<div class="page-title">
			<div class="row">
				<div class="col-6">
					<h4>Supplier Ledger</h4>
				</div>
				<div class="col-6">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"> <a href="<?= base_url() ?>"><svg class="stroke-icon">
									<use href="<?= base_url() ?>assets/dashboard/svg/icon-sprite.svg#stroke-home"></use>
								</svg></a></li>
						<li class="breadcrumb-item">Supplier Ledger</li>
						<li class="breadcrumb-item active">Supplier Management</li>
					</ol>
				</div>
			</div>
		</div>

		<div class="card">
			<div class="card-body">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12">
						<div class="p-3 mb-4">
							<div class="row">
								<div class="col-md-3">
									<p><strong>Basic Information</strong></p>
									<table class="table">
										<tbody>
											<tr>
												<td width="40%">
													<img class="img-thumbnail" style="height: 140px; min-width: 140px; border-radius: 5px;" src="<?= $this->crud_model->get_image_url('suppliers', $supplier_details->id) ?>" alt="No img">
												</td>
												<td width="60%">
													<p><strong>Supplier:</strong> <?= $supplier_details->name ?></p>
													<p><strong>E-mail:</strong> <?= $supplier_details->email ?></p>
													<p><strong>Phone:</strong> <?= $supplier_details->phone ?></p>
													<p><strong>Address:</strong> <?= $supplier_details->address ?></p>
													<p><strong>Note:</strong> <?= $supplier_details->description ?? 'No notes available' ?></p>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
								<div class="col-md-3 text-center">
									<div>
										<ul class="list-unstyled">
											<li>
												<span><i class="fi fi-sr-money-bill-wave fs-3"></i></span>
											</li>
										</ul>
									</div>
									<div>
										<p><strong>Total Payable Amount</strong></p>
										<h3>NGN<?= number_format($total_payable_amount ?? 0, 2) ?></h3>
									</div>
								</div>
								<div class="col-md-3 text-center">
									<div>
										<ul class="list-unstyled">
											<li>
												<span><i class="fi fi-sr-money-bill-wave fs-3"></i></span>
											</li>
										</ul>
									</div>
									<div>
										<p><strong>Total Paid Amount</strong></p>
										<h3>NGN<?= number_format($total_paid_amount ?? 0, 2) ?></h3>
									</div>
								</div>
								<div class="col-md-3 text-center">
									<div>
										<ul class="list-unstyled">
											<li>
												<span><i class="fi fi-sr-money-bill-wave fs-3"></i></span>
											</li>
										</ul>
									</div>
									<div>
										<p><strong>Due Amount</strong></p>
										<h3>NGN<?= number_format($due_amount ?? 0, 2) ?></h3>
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
				<i class="fi fi-rr-list"></i>List of Supplier Ledger Entries
			</div>
			<div class="card-body">
				<div class="card-header">
					<div class="d-flex justify-content-between mb-3">
						<div class="action-left">
							<a href="<?= base_url('admin/clients') ?>" class="btn btn-info px-3"><i class="fi fi-rr-angle-circle-left"></i></a>
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
								<th>Sale Date</th>
								<th>Sale Type</th>
								<th>Total Receivable Amount</th>
								<th>Received Amount</th>
								<th>Due Amount</th>
								<th>Payment Status</th>
								<th>Payment Count</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							<?php $count = 1; ?>
							<?php foreach ($client_payments as $payment): ?>
								<tr>
									<td><?= $count++ ?></td>
									<td><?= $payment->sale_date ?></td>
									<td><?= $payment->sale_type ?></td>
									<td><?= number_format($payment->total_receivable_amount, 2) ?></td>
									<td><?= number_format($payment->received_amount, 2) ?></td>
									<td><?= number_format($payment->due_amount, 2) ?></td>
									<td><?= $payment->payment_status ?></td>
									<td><?= $payment->payment_count ?></td>
									<td>
										<a href="<?= base_url('admin/delete_client_payment/' . $payment->payment_id) ?>" onclick="return confirm('Are you sure you want to delete this payment?');">
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
