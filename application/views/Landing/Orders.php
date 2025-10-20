<main id="content" class="wrapper layout-page">
	<section class="page-title z-index-2 position-relative">
		<div class="bg-body-secondary">
			<div class="container">
				<nav class="py-4 lh-30px" aria-label="breadcrumb">
					<ol class="breadcrumb justify-content-center py-1">
						<li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">My Orders</li>
					</ol>
				</nav>
			</div>
		</div>
		<div class="text-center py-13">
			<div class="container">
				<h2 class="mb-0">My Orders</h2>
			</div>
		</div>
	</section>

	<section class="container container-xxl pt-15 pb-15 pt-lg-17 pb-lg-20">
		<?php if ($this->session->flashdata('success')): ?>
			<div class="alert alert-success alert-dismissible fade show" role="alert">
				<i class="bi bi-check-circle me-2"></i><?= $this->session->flashdata('success') ?>
				<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
			</div>
		<?php endif; ?>

		<!-- Order Tracking Form -->
		<div class="card border-0 shadow-sm mb-5">
			<div class="card-body p-6">
				<h5 class="card-title mb-4">Track Your Order</h5>
				<form action="<?= base_url('order/track') ?>" method="get" class="row g-3">
					<div class="col-md-8">
						<input type="text" class="form-control" name="order_id" placeholder="Enter your Order ID (e.g., VK-123456)" required>
					</div>
					<div class="col-md-4">
						<button type="submit" class="btn btn-primary w-100">
							<i class="bi bi-search me-2"></i>Track Order
						</button>
					</div>
				</form>
			</div>
		</div>

		<?php if (empty($orders)): ?>
			<div class="text-center py-15">
				<svg class="icon fs-1 text-muted mb-4" style="width: 100px; height: 100px;">
					<use xlink:href="#icon-shopping-bag-open-light"></use>
				</svg>
				<h3 class="mb-3">No Orders Yet</h3>
				<p class="text-muted mb-5">You haven't placed any orders yet.</p>
				<a href="<?= base_url('shop') ?>" class="btn btn-primary px-11">Start Shopping</a>
			</div>
		<?php else: ?>
			<div class="row">
				<?php foreach ($orders as $order): ?>
				<div class="col-12 mb-4">
					<div class="card border-0 shadow-sm">
						<div class="card-body p-6">
							<div class="row align-items-center mb-4">
								<div class="col-md-8">
									<h5 class="mb-2">Order #<?= $order['order_number'] ?></h5>
									<p class="text-muted mb-0">
										<small>
											<i class="bi bi-calendar me-2"></i>
											Placed on <?= date('F d, Y', strtotime($order['created_at'])) ?>
										</small>
									</p>
								</div>
								<div class="col-md-4 text-md-end mt-3 mt-md-0">
									<?php
									$status_class = '';
									switch($order['order_status']) {
										case 'pending':
											$status_class = 'bg-warning';
											break;
										case 'processing':
											$status_class = 'bg-info';
											break;
										case 'shipped':
											$status_class = 'bg-primary';
											break;
										case 'delivered':
											$status_class = 'bg-success';
											break;
										case 'cancelled':
											$status_class = 'bg-danger';
											break;
										default:
											$status_class = 'bg-secondary';
									}
									?>
									<span class="badge <?= $status_class ?> text-uppercase px-3 py-2">
										<?= $order['order_status'] ?>
									</span>
								</div>
							</div>

							<hr>

							<!-- Order Items -->
							<div class="mb-4">
								<?php foreach ($order['items'] as $item): ?>
								<div class="d-flex align-items-center mb-3">
									<img src="<?= $item['image'] ?: base_url('assets/admin/images/placeholder.png') ?>" 
										 alt="<?= htmlspecialchars($item['product_name']) ?>" 
										 class="rounded me-3" 
										 style="width: 60px; height: 60px; object-fit: cover;">
									<div class="flex-grow-1">
										<h6 class="mb-1"><?= htmlspecialchars($item['product_name']) ?></h6>
										<small class="text-muted">Quantity: <?= $item['quantity'] ?> × ₦<?= number_format($item['price'], 2) ?></small>
									</div>
									<div class="text-end">
										<span class="fw-bold">₦<?= number_format($item['subtotal'], 2) ?></span>
									</div>
								</div>
								<?php endforeach; ?>
							</div>

							<hr>

							<!-- Order Summary -->
							<div class="row">
								<div class="col-md-6">
									<h6 class="mb-2">Shipping Address:</h6>
									<p class="text-muted small mb-0">
										<?= htmlspecialchars($order['shipping_address']) ?><br>
										<?= htmlspecialchars($order['city']) ?>, <?= htmlspecialchars($order['state']) ?>
									</p>
								</div>
								<div class="col-md-6 text-md-end mt-3 mt-md-0">
									<h6 class="mb-2">Order Total:</h6>
									<p class="fs-4 fw-bold text-primary mb-0">₦<?= number_format($order['total_amount'], 2) ?></p>
									<small class="text-muted">Payment: <?= ucfirst($order['payment_status']) ?></small>
								</div>
							</div>

							<hr>

							<!-- Actions -->
							<div class="d-flex justify-content-between align-items-center">
								<div>
									<?php if ($order['payment_status'] == 'paid'): ?>
										<span class="badge bg-success">
											<i class="bi bi-check-circle me-1"></i>Paid
										</span>
									<?php else: ?>
										<span class="badge bg-warning">
											<i class="bi bi-clock me-1"></i>Payment Pending
										</span>
									<?php endif; ?>
								</div>
								<div>
									<a href="<?= base_url('order/track?order_id=' . $order['order_number']) ?>" 
									   class="btn btn-outline-primary btn-sm me-2">
										<i class="bi bi-geo-alt me-1"></i>Track Order
									</a>
									<a href="<?= base_url('order/details/' . $order['order_id']) ?>" 
									   class="btn btn-primary btn-sm">
										<i class="bi bi-eye me-1"></i>View Details
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</section>
</main>
