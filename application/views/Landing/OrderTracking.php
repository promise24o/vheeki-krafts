<main id="content" class="wrapper layout-page">
	<section class="page-title z-index-2 position-relative">
		<div class="bg-body-secondary">
			<div class="container">
				<nav class="py-4 lh-30px" aria-label="breadcrumb">
					<ol class="breadcrumb justify-content-center py-1">
						<li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">Track Order</li>
					</ol>
				</nav>
			</div>
		</div>
		<div class="text-center py-13">
			<div class="container">
				<h2 class="mb-0">Track Your Order</h2>
			</div>
		</div>
	</section>

	<section class="container container-xxl pt-15 pb-15 pt-lg-17 pb-lg-20">
		<?php if (isset($error)): ?>
			<div class="alert alert-danger">
				<i class="bi bi-exclamation-triangle me-2"></i><?= $error ?>
			</div>
			<div class="text-center">
				<a href="<?= base_url('orders') ?>" class="btn btn-primary">View My Orders</a>
			</div>
		<?php elseif (isset($order)): ?>
			<!-- Order Header -->
			<div class="card border-0 shadow-sm mb-5">
				<div class="card-body p-6">
					<div class="row align-items-center">
						<div class="col-md-8">
							<h4 class="mb-2">Order #<?= $order['order_number'] ?></h4>
							<p class="text-muted mb-0">
								<i class="bi bi-calendar me-2"></i>
								Placed on <?= date('F d, Y \a\t h:i A', strtotime($order['created_at'])) ?>
							</p>
						</div>
						<div class="col-md-4 text-md-end mt-3 mt-md-0">
							<?php
							$status_class = '';
							$status_icon = '';
							switch($order['order_status']) {
								case 'pending':
									$status_class = 'bg-warning';
									$status_icon = 'clock';
									break;
								case 'processing':
									$status_class = 'bg-info';
									$status_icon = 'gear';
									break;
								case 'shipped':
									$status_class = 'bg-primary';
									$status_icon = 'truck';
									break;
								case 'delivered':
									$status_class = 'bg-success';
									$status_icon = 'check-circle';
									break;
								case 'cancelled':
									$status_class = 'bg-danger';
									$status_icon = 'x-circle';
									break;
								default:
									$status_class = 'bg-secondary';
									$status_icon = 'question-circle';
							}
							?>
							<span class="badge <?= $status_class ?> text-uppercase px-4 py-3 fs-6">
								<i class="bi bi-<?= $status_icon ?> me-2"></i><?= $order['order_status'] ?>
							</span>
						</div>
					</div>
				</div>
			</div>

			<!-- Order Timeline -->
			<div class="card border-0 shadow-sm mb-5">
				<div class="card-body p-6">
					<h5 class="card-title mb-5">Order Status Timeline</h5>
					
					<div class="position-relative">
						<!-- Timeline -->
						<div class="timeline">
							<!-- Order Placed -->
							<div class="timeline-item <?= in_array($order['order_status'], ['pending', 'processing', 'shipped', 'delivered']) ? 'completed' : '' ?>">
								<div class="timeline-marker">
									<i class="bi bi-check-circle-fill"></i>
								</div>
								<div class="timeline-content">
									<h6 class="mb-1">Order Placed</h6>
									<p class="text-muted small mb-0"><?= date('M d, Y h:i A', strtotime($order['created_at'])) ?></p>
								</div>
							</div>

							<!-- Processing -->
							<div class="timeline-item <?= in_array($order['order_status'], ['processing', 'shipped', 'delivered']) ? 'completed' : ($order['order_status'] == 'pending' ? 'active' : '') ?>">
								<div class="timeline-marker">
									<?php if (in_array($order['order_status'], ['processing', 'shipped', 'delivered'])): ?>
										<i class="bi bi-check-circle-fill"></i>
									<?php else: ?>
										<i class="bi bi-circle"></i>
									<?php endif; ?>
								</div>
								<div class="timeline-content">
									<h6 class="mb-1">Processing</h6>
									<p class="text-muted small mb-0">Your order is being prepared</p>
								</div>
							</div>

							<!-- Shipped -->
							<div class="timeline-item <?= in_array($order['order_status'], ['shipped', 'delivered']) ? 'completed' : ($order['order_status'] == 'processing' ? 'active' : '') ?>">
								<div class="timeline-marker">
									<?php if (in_array($order['order_status'], ['shipped', 'delivered'])): ?>
										<i class="bi bi-check-circle-fill"></i>
									<?php else: ?>
										<i class="bi bi-circle"></i>
									<?php endif; ?>
								</div>
								<div class="timeline-content">
									<h6 class="mb-1">Shipped</h6>
									<p class="text-muted small mb-0">Your order is on the way</p>
								</div>
							</div>

							<!-- Delivered -->
							<div class="timeline-item <?= $order['order_status'] == 'delivered' ? 'completed' : ($order['order_status'] == 'shipped' ? 'active' : '') ?>">
								<div class="timeline-marker">
									<?php if ($order['order_status'] == 'delivered'): ?>
										<i class="bi bi-check-circle-fill"></i>
									<?php else: ?>
										<i class="bi bi-circle"></i>
									<?php endif; ?>
								</div>
								<div class="timeline-content">
									<h6 class="mb-1">Delivered</h6>
									<p class="text-muted small mb-0">Order has been delivered</p>
								</div>
							</div>

							<?php if ($order['order_status'] == 'cancelled'): ?>
							<!-- Cancelled -->
							<div class="timeline-item cancelled">
								<div class="timeline-marker">
									<i class="bi bi-x-circle-fill"></i>
								</div>
								<div class="timeline-content">
									<h6 class="mb-1 text-danger">Order Cancelled</h6>
									<p class="text-muted small mb-0">This order has been cancelled</p>
								</div>
							</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>

			<div class="row">
				<!-- Order Items -->
				<div class="col-lg-8">
					<div class="card border-0 shadow-sm mb-4">
						<div class="card-body p-6">
							<h5 class="card-title mb-4">Order Items</h5>
							
							<?php foreach ($order['items'] as $item): ?>
							<div class="d-flex align-items-center mb-4 pb-4 border-bottom">
								<img src="<?= $item['image'] ?: base_url('assets/admin/images/placeholder.png') ?>" 
									 alt="<?= htmlspecialchars($item['product_name']) ?>" 
									 class="rounded me-4" 
									 style="width: 80px; height: 80px; object-fit: cover;">
								<div class="flex-grow-1">
									<h6 class="mb-1"><?= htmlspecialchars($item['product_name']) ?></h6>
									<p class="text-muted small mb-0">
										Quantity: <?= $item['quantity'] ?> × ₦<?= number_format($item['price'], 2) ?>
									</p>
								</div>
								<div class="text-end">
									<span class="fw-bold">₦<?= number_format($item['subtotal'], 2) ?></span>
								</div>
							</div>
							<?php endforeach; ?>

							<div class="d-flex justify-content-between align-items-center mt-4">
								<h5 class="mb-0">Total:</h5>
								<h4 class="mb-0 text-primary">₦<?= number_format($order['total_amount'], 2) ?></h4>
							</div>
						</div>
					</div>
				</div>

				<!-- Order Details -->
				<div class="col-lg-4">
					<!-- Shipping Information -->
					<div class="card border-0 shadow-sm mb-4">
						<div class="card-body p-6">
							<h6 class="card-title mb-4">Shipping Information</h6>
							
							<div class="mb-3">
								<label class="text-muted small">Customer Name:</label>
								<p class="mb-0 fw-semibold"><?= htmlspecialchars($order['customer_name']) ?></p>
							</div>

							<div class="mb-3">
								<label class="text-muted small">Email:</label>
								<p class="mb-0"><?= htmlspecialchars($order['customer_email']) ?></p>
							</div>

							<div class="mb-3">
								<label class="text-muted small">Phone:</label>
								<p class="mb-0"><?= htmlspecialchars($order['customer_phone']) ?></p>
							</div>

							<div class="mb-0">
								<label class="text-muted small">Shipping Address:</label>
								<p class="mb-0">
									<?= htmlspecialchars($order['shipping_address']) ?><br>
									<?= htmlspecialchars($order['city']) ?>, <?= htmlspecialchars($order['state']) ?>
									<?php if ($order['postal_code']): ?>
										<br><?= htmlspecialchars($order['postal_code']) ?>
									<?php endif; ?>
								</p>
							</div>
						</div>
					</div>

					<!-- Payment Information -->
					<div class="card border-0 shadow-sm">
						<div class="card-body p-6">
							<h6 class="card-title mb-4">Payment Information</h6>
							
							<div class="mb-3">
								<label class="text-muted small">Payment Method:</label>
								<p class="mb-0 text-capitalize"><?= $order['payment_method'] ?></p>
							</div>

							<div class="mb-3">
								<label class="text-muted small">Payment Status:</label>
								<p class="mb-0">
									<?php if ($order['payment_status'] == 'paid'): ?>
										<span class="badge bg-success">Paid</span>
									<?php else: ?>
										<span class="badge bg-warning">Pending</span>
									<?php endif; ?>
								</p>
							</div>

							<?php if ($order['payment_reference']): ?>
							<div class="mb-0">
								<label class="text-muted small">Payment Reference:</label>
								<p class="mb-0"><code><?= $order['payment_reference'] ?></code></p>
							</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>

			<!-- Actions -->
			<div class="text-center mt-5">
				<a href="<?= base_url('orders') ?>" class="btn btn-outline-primary me-2">
					<i class="bi bi-arrow-left me-2"></i>Back to Orders
				</a>
				<a href="<?= base_url('shop') ?>" class="btn btn-primary">
					<i class="bi bi-bag me-2"></i>Continue Shopping
				</a>
			</div>
		<?php else: ?>
			<!-- Search Form -->
			<div class="card border-0 shadow-sm">
				<div class="card-body p-6 text-center">
					<h5 class="card-title mb-4">Enter Your Order ID</h5>
					<form action="<?= base_url('order/track') ?>" method="get" class="row g-3 justify-content-center">
						<div class="col-md-6">
							<input type="text" class="form-control form-control-lg" name="order_id" 
								   placeholder="e.g., VK-123456" required>
						</div>
						<div class="col-md-3">
							<button type="submit" class="btn btn-primary btn-lg w-100">
								<i class="bi bi-search me-2"></i>Track
							</button>
						</div>
					</form>
				</div>
			</div>
		<?php endif; ?>
	</section>
</main>

<style>
.timeline {
	position: relative;
	padding-left: 40px;
}

.timeline::before {
	content: '';
	position: absolute;
	left: 15px;
	top: 0;
	bottom: 0;
	width: 2px;
	background: #e0e0e0;
}

.timeline-item {
	position: relative;
	padding-bottom: 30px;
}

.timeline-marker {
	position: absolute;
	left: -40px;
	width: 32px;
	height: 32px;
	border-radius: 50%;
	background: #fff;
	border: 2px solid #e0e0e0;
	display: flex;
	align-items: center;
	justify-content: center;
	color: #999;
	font-size: 16px;
}

.timeline-item.completed .timeline-marker {
	background: #28a745;
	border-color: #28a745;
	color: #fff;
}

.timeline-item.active .timeline-marker {
	background: #007bff;
	border-color: #007bff;
	color: #fff;
	animation: pulse 2s infinite;
}

.timeline-item.cancelled .timeline-marker {
	background: #dc3545;
	border-color: #dc3545;
	color: #fff;
}

@keyframes pulse {
	0%, 100% {
		box-shadow: 0 0 0 0 rgba(0, 123, 255, 0.7);
	}
	50% {
		box-shadow: 0 0 0 10px rgba(0, 123, 255, 0);
	}
}
</style>
