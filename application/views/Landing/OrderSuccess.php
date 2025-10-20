<main id="content" class="wrapper layout-page">
	<section class="container container-xxl pt-15 pb-15 pt-lg-17 pb-lg-20">
		<div class="row justify-content-center">
			<div class="col-lg-8">
				<div class="text-center mb-5">
					<div class="mb-4">
						<svg class="text-success" style="width: 100px; height: 100px;" fill="currentColor" viewBox="0 0 20 20">
							<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
						</svg>
					</div>
					<h2 class="mb-3">Order Placed Successfully!</h2>
					<p class="text-muted fs-5">Thank you for your purchase</p>
				</div>

				<div class="card border-0 shadow-sm mb-4">
					<div class="card-body p-6">
						<div class="row">
							<div class="col-md-6 mb-3 mb-md-0">
								<label class="text-muted small d-block mb-2">Order Number:</label>
								<h5 class="mb-0"><?= $order['order_number'] ?></h5>
							</div>
							<div class="col-md-6 text-md-end">
								<label class="text-muted small d-block mb-2">Order Date:</label>
								<h6 class="mb-0"><?= date('F d, Y', strtotime($order['created_at'])) ?></h6>
							</div>
						</div>
					</div>
				</div>

				<div class="alert alert-info mb-4">
					<h6 class="alert-heading">
						<i class="bi bi-info-circle me-2"></i>What's Next?
					</h6>
					<ul class="mb-0 ps-4">
						<li>A confirmation email has been sent to <strong><?= htmlspecialchars($order['customer_email']) ?></strong></li>
						<li>Our team will contact you within 24 hours to arrange delivery</li>
						<li><strong>Important:</strong> Delivery charges will be discussed and paid separately</li>
						<li>You can track your order status using the order number above</li>
					</ul>
				</div>

				<div class="card border-0 shadow-sm mb-4">
					<div class="card-body p-6">
						<h5 class="card-title mb-4">Order Summary</h5>
						
						<?php foreach ($order['items'] as $item): ?>
						<div class="d-flex align-items-center mb-3 pb-3 border-bottom">
							<img src="<?= $item['image'] ?: base_url('assets/admin/images/placeholder.png') ?>" 
								 alt="<?= htmlspecialchars($item['product_name']) ?>" 
								 class="rounded me-3" 
								 style="width: 60px; height: 60px; object-fit: cover;">
							<div class="flex-grow-1">
								<h6 class="mb-0"><?= htmlspecialchars($item['product_name']) ?></h6>
								<small class="text-muted">Qty: <?= $item['quantity'] ?></small>
							</div>
							<span class="fw-bold">₦<?= number_format($item['subtotal'], 2) ?></span>
						</div>
						<?php endforeach; ?>

						<div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
							<h5 class="mb-0">Total Paid:</h5>
							<h4 class="mb-0 text-primary">₦<?= number_format($order['total_amount'], 2) ?></h4>
						</div>
					</div>
				</div>

				<div class="text-center">
					<a href="<?= base_url('order/track?order_id=' . $order['order_number']) ?>" 
					   class="btn btn-primary btn-lg me-2 mb-2">
						<i class="bi bi-geo-alt me-2"></i>Track Order
					</a>
					<a href="<?= base_url('shop') ?>" class="btn btn-outline-primary btn-lg mb-2">
						<i class="bi bi-bag me-2"></i>Continue Shopping
					</a>
				</div>
			</div>
		</div>
	</section>
</main>
