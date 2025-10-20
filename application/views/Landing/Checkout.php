<main id="content" class="wrapper layout-page">
	<section class="page-title z-index-2 position-relative">
		<div class="bg-body-secondary">
			<div class="container">
				<nav class="py-4 lh-30px" aria-label="breadcrumb">
					<ol class="breadcrumb justify-content-center py-1">
						<li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
						<li class="breadcrumb-item"><a href="<?= base_url('cart') ?>">Cart</a></li>
						<li class="breadcrumb-item active" aria-current="page">Checkout</li>
					</ol>
				</nav>
			</div>
		</div>
		<div class="text-center py-13">
			<div class="container">
				<h2 class="mb-0">Checkout</h2>
			</div>
		</div>
	</section>

	<section class="container container-xxl pt-15 pb-15 pt-lg-17 pb-lg-20">
		<?php if (empty($cart_items)): ?>
			<div class="alert alert-warning">
				<i class="bi bi-exclamation-triangle me-2"></i>
				Your cart is empty. Please add items before checking out.
			</div>
			<a href="<?= base_url('shop') ?>" class="btn btn-primary">Continue Shopping</a>
		<?php else: ?>
			<form id="checkoutForm" method="post">
				<div class="row">
					<div class="col-lg-7">
						<!-- Customer Information -->
						<div class="card border-0 shadow-sm mb-4">
							<div class="card-body p-6">
								<h5 class="card-title mb-4">Customer Information</h5>
								
								<div class="row">
									<div class="col-md-6 mb-3">
										<label for="first_name" class="form-label">First Name <span class="text-danger">*</span></label>
										<input type="text" class="form-control" id="first_name" name="first_name" required>
									</div>
									<div class="col-md-6 mb-3">
										<label for="last_name" class="form-label">Last Name <span class="text-danger">*</span></label>
										<input type="text" class="form-control" id="last_name" name="last_name" required>
									</div>
								</div>

								<div class="mb-3">
									<label for="email" class="form-label">Email Address <span class="text-danger">*</span></label>
									<input type="email" class="form-control" id="email" name="email" required>
								</div>

								<div class="mb-3">
									<label for="phone" class="form-label">Phone Number <span class="text-danger">*</span></label>
									<input type="tel" class="form-control" id="phone" name="phone" required>
								</div>
							</div>
						</div>

						<!-- Shipping Address -->
						<div class="card border-0 shadow-sm mb-4">
							<div class="card-body p-6">
								<h5 class="card-title mb-4">Shipping Address</h5>

								<div class="mb-3">
									<label for="address" class="form-label">Street Address <span class="text-danger">*</span></label>
									<input type="text" class="form-control" id="address" name="address" placeholder="House number and street name" required>
								</div>

								<div class="mb-3">
									<label for="address_2" class="form-label">Apartment, suite, etc. (optional)</label>
									<input type="text" class="form-control" id="address_2" name="address_2">
								</div>

								<div class="row">
									<div class="col-md-6 mb-3">
										<label for="city" class="form-label">City <span class="text-danger">*</span></label>
										<input type="text" class="form-control" id="city" name="city" required>
									</div>
									<div class="col-md-6 mb-3">
										<label for="state" class="form-label">State <span class="text-danger">*</span></label>
										<select class="form-select" id="state" name="state" required>
											<option value="">Select State</option>
											<option value="Lagos">Lagos</option>
											<option value="Abuja">Abuja</option>
											<option value="Kano">Kano</option>
											<option value="Rivers">Rivers</option>
											<option value="Oyo">Oyo</option>
											<option value="Kaduna">Kaduna</option>
											<!-- Add more Nigerian states -->
										</select>
									</div>
								</div>

								<div class="mb-3">
									<label for="postal_code" class="form-label">Postal Code</label>
									<input type="text" class="form-control" id="postal_code" name="postal_code">
								</div>
							</div>
						</div>

						<!-- Order Notes -->
						<div class="card border-0 shadow-sm mb-4">
							<div class="card-body p-6">
								<h5 class="card-title mb-4">Order Notes (Optional)</h5>
								<textarea class="form-control" id="order_notes" name="order_notes" rows="4" 
										  placeholder="Notes about your order, e.g. special notes for delivery"></textarea>
							</div>
						</div>
					</div>

					<div class="col-lg-5">
						<!-- Order Summary -->
						<div class="card border-0 shadow-sm sticky-top" style="top: 100px;">
							<div class="card-body p-6">
								<h5 class="card-title mb-4">Order Summary</h5>

								<!-- Cart Items -->
								<div class="mb-4">
									<?php foreach ($cart_items as $item): ?>
									<div class="d-flex justify-content-between align-items-center mb-3 pb-3 border-bottom">
										<div class="d-flex align-items-center">
											<img src="<?= $item['image'] ?: base_url('assets/admin/images/placeholder.png') ?>" 
												 alt="<?= htmlspecialchars($item['product_name']) ?>" 
												 class="rounded me-3" 
												 style="width: 50px; height: 50px; object-fit: cover;">
											<div>
												<h6 class="mb-0 small"><?= htmlspecialchars($item['product_name']) ?></h6>
												<small class="text-muted">Qty: <?= $item['quantity'] ?></small>
											</div>
										</div>
										<span class="fw-bold">₦<?= number_format($item['subtotal'], 2) ?></span>
									</div>
									<?php endforeach; ?>
								</div>

								<!-- Pricing -->
								<div class="d-flex justify-content-between mb-2">
									<span>Subtotal:</span>
									<span class="fw-bold">₦<?= number_format($cart_total, 2) ?></span>
								</div>

								<div class="alert alert-warning mb-3">
									<i class="bi bi-exclamation-circle me-2"></i>
									<small><strong>Important:</strong> Delivery charges are NOT included in this payment. Our team will contact you to arrange delivery and payment for shipping costs.</small>
								</div>

								<hr>

								<div class="d-flex justify-content-between mb-4">
									<span class="fs-5 fw-bold">Total to Pay:</span>
									<span class="fs-5 fw-bold text-primary">₦<?= number_format($cart_total, 2) ?></span>
								</div>

								<!-- Payment Method -->
								<div class="mb-4">
									<h6 class="mb-3">Payment Method</h6>
									<div class="form-check mb-2">
										<input class="form-check-input" type="radio" name="payment_method" id="paystack" value="paystack" checked>
										<label class="form-check-label d-flex align-items-center" for="paystack">
											<!-- <img src="<?= base_url() ?>/assets/landing/images/others/paystack.webp" alt="Paystack" style="height: 20px;" class="me-2"> -->
											Pay with Paystack (Card, Bank Transfer, USSD)
										</label>
									</div>
								</div>

								<button type="submit" class="btn btn-primary w-100 btn-lg mb-3" id="paystackBtn">
									<i class="bi bi-lock me-2"></i>Pay ₦<?= number_format($cart_total, 2) ?>
								</button>

								<div class="text-center">
									<small class="text-muted">
										<i class="bi bi-shield-check me-1"></i>
										Your payment information is secure
									</small>
								</div>
							</div>
						</div>
					</div>
				</div>
			</form>
		<?php endif; ?>
	</section>
</main>

<script src="https://js.paystack.co/v1/inline.js"></script>
<script>
document.getElementById('checkoutForm')?.addEventListener('submit', function(e) {
	e.preventDefault();

	// Validate form
	if (!this.checkValidity()) {
		this.reportValidity();
		return;
	}

	// Get form data
	const formData = new FormData(this);
	const email = formData.get('email');
	const amount = <?= $cart_total * 100 ?>; // Paystack amount in kobo

	// Initialize Paystack
	const handler = PaystackPop.setup({
		key: '<?= $paystack_public_key ?>', // Replace with your Paystack public key
		email: email,
		amount: amount,
		currency: 'NGN',
		ref: 'VK-' + Math.floor((Math.random() * 1000000000) + 1),
		metadata: {
			custom_fields: [
				{
					display_name: "Customer Name",
					variable_name: "customer_name",
					value: formData.get('first_name') + ' ' + formData.get('last_name')
				},
				{
					display_name: "Phone Number",
					variable_name: "phone",
					value: formData.get('phone')
				}
			]
		},
		callback: function(response) {
			// Payment successful
			toastr.success('Payment successful! Processing your order...');
			
			// Send order data to server
			const orderData = new FormData(document.getElementById('checkoutForm'));
			orderData.append('payment_reference', response.reference);
			orderData.append('payment_status', 'paid');

			fetch('<?= base_url("checkout/process") ?>', {
				method: 'POST',
				body: orderData
			})
			.then(response => response.json())
			.then(data => {
				if (data.success) {
					window.location.href = '<?= base_url("order/success/") ?>' + data.order_id;
				} else {
					toastr.error('Order processing failed. Please contact support with reference: ' + response.reference);
				}
			})
			.catch(error => {
				console.error('Error:', error);
				toastr.error('An error occurred. Please contact support with reference: ' + response.reference);
			});
		},
		onClose: function() {
			toastr.warning('Payment cancelled');
		}
	});

	handler.openIframe();
});
</script>
