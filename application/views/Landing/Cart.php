<main id="content" class="wrapper layout-page">
	<section class="page-title z-index-2 position-relative">
		<div class="bg-body-secondary">
			<div class="container">
				<nav class="py-4 lh-30px" aria-label="breadcrumb">
					<ol class="breadcrumb justify-content-center py-1">
						<li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
						<li class="breadcrumb-item"><a href="<?= base_url('shop') ?>">Shop</a></li>
						<li class="breadcrumb-item active" aria-current="page">Shopping Cart</li>
					</ol>
				</nav>
			</div>
		</div>
		<div class="text-center py-13">
			<div class="container">
				<h2 class="mb-0">Shopping Cart</h2>
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

		<?php if ($this->session->flashdata('error')): ?>
			<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<i class="bi bi-exclamation-triangle me-2"></i><?= $this->session->flashdata('error') ?>
				<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
			</div>
		<?php endif; ?>

		<?php if (empty($cart_items)): ?>
			<div class="text-center py-15">
				<svg class="icon fs-1 text-muted mb-4" style="width: 100px; height: 100px;">
					<use xlink:href="#icon-shopping-bag-open-light"></use>
				</svg>
				<h3 class="mb-3">Your Cart is Empty</h3>
				<p class="text-muted mb-5">Looks like you haven't added any items to your cart yet.</p>
				<a href="<?= base_url('shop') ?>" class="btn btn-primary px-11">Continue Shopping</a>
			</div>
		<?php else: ?>
			<div class="row">
				<div class="col-lg-8">
					<div class="card border-0 shadow-sm mb-4">
						<div class="card-body p-0">
							<div class="table-responsive">
								<table class="table align-middle mb-0">
									<thead class="bg-light">
										<tr>
											<th class="ps-6 py-4">Product</th>
											<th class="py-4">Price</th>
											<th class="py-4">Quantity</th>
											<th class="py-4">Subtotal</th>
											<th class="pe-6 py-4"></th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($cart_items as $item): ?>
										<tr>
											<td class="ps-6 py-4">
												<div class="d-flex align-items-center">
													<img src="<?= $item['image'] ?: base_url('assets/admin/images/placeholder.png') ?>" 
														 alt="<?= htmlspecialchars($item['product_name']) ?>" 
														 class="rounded me-4" 
														 style="width: 80px; height: 80px; object-fit: cover;">
													<div>
														<h6 class="mb-1">
															<a href="<?= base_url('product/' . $item['product_slug']) ?>" 
															   class="text-decoration-none text-body-emphasis">
																<?= htmlspecialchars($item['product_name']) ?>
															</a>
														</h6>
														<small class="text-muted">SKU: <?= $item['sku'] ?></small>
													</div>
												</div>
											</td>
											<td class="py-4">
												<?php if ($item['discount_price']): ?>
													<div>
														<del class="text-muted small">₦<?= number_format($item['price'], 2) ?></del><br>
														<span class="fw-bold text-success">₦<?= number_format($item['discount_price'], 2) ?></span>
													</div>
												<?php else: ?>
													<span class="fw-bold">₦<?= number_format($item['price'], 2) ?></span>
												<?php endif; ?>
											</td>
											<td class="py-4">
												<div class="input-group" style="width: 130px;">
													<button class="btn btn-outline-secondary btn-sm update-quantity" 
															data-cart-id="<?= $item['cart_id'] ?>" 
															data-action="decrease" 
															type="button">-</button>
													<input type="number" 
														   class="form-control form-control-sm text-center quantity-input" 
														   value="<?= $item['quantity'] ?>" 
														   min="1" 
														   max="<?= $item['stock_quantity'] ?>"
														   data-cart-id="<?= $item['cart_id'] ?>"
														   readonly>
													<button class="btn btn-outline-secondary btn-sm update-quantity" 
															data-cart-id="<?= $item['cart_id'] ?>" 
															data-action="increase" 
															type="button">+</button>
												</div>
												<small class="text-muted d-block mt-1"><?= $item['stock_quantity'] ?> available</small>
											</td>
											<td class="py-4">
												<span class="fw-bold item-subtotal">
													₦<?= number_format($item['subtotal'], 2) ?>
												</span>
											</td>
											<td class="pe-6 py-4">
												<button class="btn btn-sm btn-outline-danger remove-item" 
														data-cart-id="<?= $item['cart_id'] ?>"
														title="Remove">
													<i class="bi bi-trash"></i>
												</button>
											</td>
										</tr>
										<?php endforeach; ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>

					<div class="d-flex justify-content-between">
						<a href="<?= base_url('shop') ?>" class="btn btn-outline-dark">
							<i class="bi bi-arrow-left me-2"></i>Continue Shopping
						</a>
						<button type="button" class="btn btn-outline-danger" id="clearCart">
							<i class="bi bi-trash me-2"></i>Clear Cart
						</button>
					</div>
				</div>

				<div class="col-lg-4">
					<div class="card border-0 shadow-sm sticky-top" style="top: 100px;">
						<div class="card-body p-6">
							<h5 class="card-title mb-4">Order Summary</h5>
							
							<div class="d-flex justify-content-between mb-3">
								<span>Subtotal:</span>
								<span class="fw-bold" id="cartSubtotal">₦<?= number_format($cart_total, 2) ?></span>
							</div>

							<div class="alert alert-info mb-4">
								<i class="bi bi-info-circle me-2"></i>
								<small><strong>Note:</strong> Delivery charges will be calculated at checkout based on your location.</small>
							</div>

							<hr>

							<div class="d-flex justify-content-between mb-4">
								<span class="fs-5 fw-bold">Total:</span>
								<span class="fs-5 fw-bold text-primary" id="cartTotal">₦<?= number_format($cart_total, 2) ?></span>
							</div>

							<a href="<?= base_url('checkout') ?>" class="btn btn-primary w-100 btn-lg mb-3">
								Proceed to Checkout
							</a>

							<div class="text-center">
								<small class="text-muted">
									<i class="bi bi-shield-check me-1"></i>
									Secure Checkout with Paystack
								</small>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php endif; ?>
	</section>
</main>

<script>
// Update quantity
document.querySelectorAll('.update-quantity').forEach(btn => {
	btn.addEventListener('click', function() {
		const cartId = this.dataset.cartId;
		const action = this.dataset.action;
		const input = document.querySelector(`input[data-cart-id="${cartId}"]`);
		let quantity = parseInt(input.value);
		const max = parseInt(input.max);

		if (action === 'increase' && quantity < max) {
			quantity++;
		} else if (action === 'decrease' && quantity > 1) {
			quantity--;
		} else {
			return;
		}

		updateCartItem(cartId, quantity);
	});
});

// Remove item
document.querySelectorAll('.remove-item').forEach(btn => {
	btn.addEventListener('click', function() {
		const cartId = this.dataset.cartId;
		if (confirm('Are you sure you want to remove this item from your cart?')) {
			removeCartItem(cartId);
		}
	});
});

// Clear cart
document.getElementById('clearCart')?.addEventListener('click', function() {
	if (confirm('Are you sure you want to clear your entire cart?')) {
		window.location.href = '<?= base_url("cart/clear") ?>';
	}
});

function updateCartItem(cartId, quantity) {
	fetch('<?= base_url("cart/update") ?>', {
		method: 'POST',
		headers: {
			'Content-Type': 'application/x-www-form-urlencoded',
		},
		body: `cart_id=${cartId}&quantity=${quantity}`
	})
	.then(response => response.json())
	.then(data => {
		if (data.success) {
			toastr.success('Cart updated successfully');
			setTimeout(() => location.reload(), 500);
		} else {
			toastr.error(data.message || 'Failed to update cart');
		}
	})
	.catch(error => {
		console.error('Error:', error);
		toastr.error('An error occurred. Please try again.');
	});
}

function removeCartItem(cartId) {
	fetch('<?= base_url("cart/remove") ?>', {
		method: 'POST',
		headers: {
			'Content-Type': 'application/x-www-form-urlencoded',
		},
		body: `cart_id=${cartId}`
	})
	.then(response => response.json())
	.then(data => {
		if (data.success) {
			toastr.success('Item removed from cart');
			setTimeout(() => location.reload(), 500);
		} else {
			toastr.error(data.message || 'Failed to remove item');
		}
	})
	.catch(error => {
		console.error('Error:', error);
		toastr.error('An error occurred. Please try again.');
	});
}
</script>
