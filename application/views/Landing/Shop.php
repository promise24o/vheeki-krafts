<main id="content" class="wrapper layout-page">
	<section class="page-title z-index-2 position-relative">
		<div class="bg-body-secondary">
			<div class="container">
				<nav class="py-4 lh-30px" aria-label="breadcrumb">
					<ol class="breadcrumb justify-content-center py-1">
						<li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">Shop</li>
					</ol>
				</nav>
			</div>
		</div>
		<div class="text-center py-13">
			<div class="container">
				<h2 class="mb-0">Artwork Collection</h2>
			</div>
		</div>
	</section>

	<section class="container container-xxl">
		<div class="tool-bar mb-11 align-items-center justify-content-between d-lg-flex">
			<div class="tool-bar-left mb-6 mb-lg-0 fs-18px">
				We found <span class="text-body-emphasis fw-semibold"><?= count($products) ?></span> products available for you
			</div>
			<div class="tool-bar-right align-items-center d-lg-flex">
				<ul class="list-unstyled d-flex align-items-center list-inline mb-0">
					<li class="list-inline-item me-0 w-100 w-lg-auto">
						<select class="form-select w-100 w-lg-auto" name="orderby" id="sortProducts">
							<option value="">Default sorting</option>
							<option value="price_asc">Price: Low to High</option>
							<option value="price_desc">Price: High to Low</option>
							<option value="name_asc">Name: A-Z</option>
							<option value="name_desc">Name: Z-A</option>
							<option value="newest">Newest First</option>
						</select>
					</li>
					<li class="list-inline-item d-none d-lg-block ms-7">
						<a data-bs-toggle="offcanvas" href="#offcanvasFilter" role="button" 
						   class="btn btn-hover-border-primary btn-hover-bg-primary btn-hover-text-light btn-dark">
							<svg class="icon icon-SlidersHorizontal fs-4 me-4">
								<use xlink:href="#icon-SlidersHorizontal"></use>
							</svg> Filter
						</a>
					</li>
					<li class="list-inline-item d-lg-none ms-auto">
						<a data-bs-toggle="offcanvas" href="#offcanvasFilter" role="button" 
						   class="btn btn-hover-border-primary btn-hover-bg-primary btn-hover-text-light btn-dark">
							<svg class="icon icon-SlidersHorizontal fs-4 me-4">
								<use xlink:href="#icon-SlidersHorizontal"></use>
							</svg> Filter
						</a>
					</li>
				</ul>
			</div>
		</div>
	</section>

	<!-- Filter Sidebar -->
	<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasFilter">
		<div class="offcanvas-header">
			<h5 class="offcanvas-title fs-3">Filter Products</h5>
			<button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
		</div>
		<div class="offcanvas-body">
			<aside class="primary-sidebar">
				<!-- Categories -->
				<div class="widget widget-product-category mb-7">
					<h4 class="widget-title fs-5 mb-6">Category</h4>
					<ul class="navbar-nav">
						<li class="nav-item">
							<a href="<?= base_url('shop') ?>" class="text-reset d-block text-decoration-none text-body-emphasis-hover py-2">
								<span class="text-hover-underline">All Categories</span>
							</a>
						</li>
						<?php foreach ($categories as $cat): ?>
						<li class="nav-item">
							<a href="<?= base_url('shop?category=' . $cat['category_id']) ?>" 
							   class="text-reset d-block text-decoration-none text-body-emphasis-hover py-2 <?= (isset($_GET['category']) && $_GET['category'] == $cat['category_id']) ? 'fw-bold text-primary' : '' ?>">
								<span class="text-hover-underline"><?= htmlspecialchars($cat['category_name']) ?></span>
							</a>
						</li>
						<?php endforeach; ?>
					</ul>
				</div>

				<!-- Highlights -->
				<div class="widget widget-product-highlight mb-7">
					<h4 class="widget-title fs-5 mb-6">Highlights</h4>
					<ul class="navbar-nav">
						<li class="nav-item">
							<a href="<?= base_url('shop?highlight=best_seller') ?>" 
							   class="text-reset d-block text-decoration-none text-body-emphasis-hover py-2 <?= (isset($_GET['highlight']) && $_GET['highlight'] == 'best_seller') ? 'fw-bold text-primary' : '' ?>">
								<span class="text-hover-underline">Best Sellers</span>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= base_url('shop?highlight=new_arrival') ?>" 
							   class="text-reset d-block text-decoration-none text-body-emphasis-hover py-2 <?= (isset($_GET['highlight']) && $_GET['highlight'] == 'new_arrival') ? 'fw-bold text-primary' : '' ?>">
								<span class="text-hover-underline">New Arrivals</span>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= base_url('shop?highlight=on_sale') ?>" 
							   class="text-reset d-block text-decoration-none text-body-emphasis-hover py-2 <?= (isset($_GET['highlight']) && $_GET['highlight'] == 'on_sale') ? 'fw-bold text-primary' : '' ?>">
								<span class="text-hover-underline">On Sale</span>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= base_url('shop?highlight=hot_item') ?>" 
							   class="text-reset d-block text-decoration-none text-body-emphasis-hover py-2 <?= (isset($_GET['highlight']) && $_GET['highlight'] == 'hot_item') ? 'fw-bold text-primary' : '' ?>">
								<span class="text-hover-underline">Hot Items</span>
							</a>
						</li>
					</ul>
				</div>

				<!-- Price Range -->
				<div class="widget widget-product-price mb-7">
					<h4 class="widget-title fs-5 mb-6">Price Range</h4>
					<ul class="navbar-nav">
						<li class="nav-item">
							<a href="<?= base_url('shop') ?>" class="text-reset d-block text-decoration-none text-body-emphasis-hover py-2">
								<span class="text-hover-underline">All Prices</span>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= base_url('shop?price=0-30000') ?>" class="text-reset d-block text-decoration-none text-body-emphasis-hover py-2">
								<span class="text-hover-underline">₦0 - ₦30,000</span>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= base_url('shop?price=30000-40000') ?>" class="text-reset d-block text-decoration-none text-body-emphasis-hover py-2">
								<span class="text-hover-underline">₦30,000 - ₦40,000</span>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= base_url('shop?price=40000-50000') ?>" class="text-reset d-block text-decoration-none text-body-emphasis-hover py-2">
								<span class="text-hover-underline">₦40,000 - ₦50,000</span>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= base_url('shop?price=50000-999999') ?>" class="text-reset d-block text-decoration-none text-body-emphasis-hover py-2">
								<span class="text-hover-underline">₦50,000+</span>
							</a>
						</li>
					</ul>
				</div>

				<!-- Clear Filters -->
				<div class="widget">
					<a href="<?= base_url('shop') ?>" class="btn btn-outline-dark w-100">Clear All Filters</a>
				</div>
			</aside>
		</div>
	</div>

	<!-- Products Grid -->
	<div class="container container-xxl pb-16 pb-lg-18 mb-lg-3">
		<?php if (empty($products)): ?>
			<div class="text-center py-15">
				<svg class="icon fs-1 text-muted mb-4" style="width: 100px; height: 100px;">
					<use xlink:href="#icon-shopping-bag-open-light"></use>
				</svg>
				<h3 class="mb-3">No Products Found</h3>
				<p class="text-muted">Try adjusting your filters or browse all products</p>
				<a href="<?= base_url('shop') ?>" class="btn btn-primary mt-4">View All Products</a>
			</div>
		<?php else: ?>
			<div class="row gy-50px" id="productsGrid">
				<?php foreach ($products as $product): 
					$primary_image = '';
					if (!empty($product['images'])) {
						$primary_image = $product['images'][0]['image_path'];
					}
					$display_price = $product['discount_price'] ? $product['discount_price'] : $product['price'];
				?>
				<div class="col-sm-6 col-lg-4 col-xl-3 product-item" 
					 data-price="<?= $display_price ?>" 
					 data-name="<?= htmlspecialchars($product['product_name']) ?>"
					 data-date="<?= strtotime($product['created_at']) ?>">
					<div class="card card-product grid-1 bg-transparent border-0" data-animate="fadeInUp">
						<figure class="card-img-top position-relative mb-7 overflow-hidden">
							<a href="<?= base_url('product/' . $product['product_slug']) ?>" 
							   class="hover-zoom-in d-block" 
							   title="<?= htmlspecialchars($product['product_name']) ?>">
								<?php if ($primary_image): ?>
									<img src="<?= $primary_image ?>" 
										 class="img-fluid w-100" 
										 alt="<?= htmlspecialchars($product['product_name']) ?>" 
										 style="height: 400px; object-fit: cover;">
								<?php else: ?>
									<img src="<?= base_url('assets/admin/images/placeholder.png') ?>" 
										 class="img-fluid w-100" 
										 alt="<?= htmlspecialchars($product['product_name']) ?>"
										 style="height: 400px; object-fit: cover;">
								<?php endif; ?>
							</a>
							
							<!-- Badges -->
							<div class="position-absolute product-flash z-index-2" style="top: 10px; left: 10px;">
								<?php if ($product['is_on_sale'] && $product['discount_price']): 
									$discount_percent = round((($product['price'] - $product['discount_price']) / $product['price']) * 100);
								?>
									<span class="badge badge-product-flash on-sale bg-primary mb-2">-<?= $discount_percent ?>%</span><br>
								<?php endif; ?>
								<?php if ($product['is_new_arrival']): ?>
									<span class="badge badge-product-flash on-new bg-success mb-2">New</span><br>
								<?php endif; ?>
								<?php if ($product['is_hot_item']): ?>
									<span class="badge badge-product-flash bg-danger mb-2">Hot</span><br>
								<?php endif; ?>
								<?php if ($product['is_best_seller']): ?>
									<span class="badge badge-product-flash bg-warning text-dark">Best Seller</span>
								<?php endif; ?>
							</div>

							<!-- Quick Actions -->
							<div class="position-absolute d-flex z-index-2 product-actions horizontal" style="bottom: 20px; right: 20px;">
								<a class="text-body-emphasis bg-body bg-dark-hover text-light-hover rounded-circle square product-action shadow-sm add-to-cart-btn" 
								   href="javascript:void(0)" 
								   data-product-id="<?= $product['product_id'] ?>"
								   data-bs-toggle="tooltip" 
								   data-bs-placement="top" 
								   title="Add To Cart">
									<svg class="icon icon-shopping-bag-open-light">
										<use xlink:href="#icon-shopping-bag-open-light"></use>
									</svg>
								</a>
							</div>
						</figure>

						<div class="card-body text-center p-0">
							<span class="d-flex align-items-center price text-body-emphasis fw-bold justify-content-center mb-3 fs-6">
								<?php if ($product['discount_price']): ?>
									<del class="text-body fw-500 me-4 fs-13px">₦<?= number_format($product['price'], 2) ?></del>
									<ins class="text-decoration-none">₦<?= number_format($product['discount_price'], 2) ?></ins>
								<?php else: ?>
									₦<?= number_format($product['price'], 2) ?>
								<?php endif; ?>
							</span>
							
							<h4 class="product-title card-title text-primary-hover text-body-emphasis fs-15px fw-500 mb-3">
								<a class="text-decoration-none text-reset" href="<?= base_url('product/' . $product['product_slug']) ?>">
									<?= htmlspecialchars($product['product_name']) ?>
								</a>
							</h4>

							<?php if ($product['review_count'] > 0): ?>
							<div class="d-flex align-items-center fs-12px justify-content-center">
								<div class="rating">
									<div class="empty-stars">
										<?php for ($i = 0; $i < 5; $i++): ?>
										<span class="star">
											<svg class="icon star-o">
												<use xlink:href="#star-o"></use>
											</svg>
										</span>
										<?php endfor; ?>
									</div>
									<div class="filled-stars" style="width: <?= ($product['rating_average'] / 5) * 100 ?>%">
										<?php for ($i = 0; $i < 5; $i++): ?>
										<span class="star">
											<svg class="icon star text-primary">
												<use xlink:href="#star"></use>
											</svg>
										</span>
										<?php endfor; ?>
									</div>
								</div>
								<span class="reviews ms-4 pt-3 fs-14px"><?= $product['review_count'] ?> reviews</span>
							</div>
							<?php endif; ?>

							<?php if ($product['stock_quantity'] <= 0): ?>
								<div class="mt-3">
									<span class="badge bg-danger">Out of Stock</span>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
</main>

<script>
// Sort products
document.getElementById('sortProducts')?.addEventListener('change', function() {
	const sortValue = this.value;
	const grid = document.getElementById('productsGrid');
	const items = Array.from(grid.querySelectorAll('.product-item'));
	
	items.sort((a, b) => {
		switch(sortValue) {
			case 'price_asc':
				return parseFloat(a.dataset.price) - parseFloat(b.dataset.price);
			case 'price_desc':
				return parseFloat(b.dataset.price) - parseFloat(a.dataset.price);
			case 'name_asc':
				return a.dataset.name.localeCompare(b.dataset.name);
			case 'name_desc':
				return b.dataset.name.localeCompare(a.dataset.name);
			case 'newest':
				return parseInt(b.dataset.date) - parseInt(a.dataset.date);
			default:
				return 0;
		}
	});
	
	items.forEach(item => grid.appendChild(item));
});

// Add to cart functionality
document.querySelectorAll('.add-to-cart-btn').forEach(btn => {
	btn.addEventListener('click', function() {
		const productId = this.dataset.productId;
		
		fetch('<?= base_url("cart/add") ?>', {
			method: 'POST',
			headers: {
				'Content-Type': 'application/x-www-form-urlencoded',
			},
			body: 'product_id=' + productId + '&quantity=1'
		})
		.then(response => response.json())
		.then(data => {
			if (data.success) {
				// Show success message
				toastr.success('Product added to cart!');
				// Update cart count in header
				const cartCount = document.getElementById('cartCount');
				const sideCartCount = document.getElementById('sideCartCount');
				if (cartCount) {
					cartCount.textContent = data.cart_count;
				}
				if (sideCartCount) {
					sideCartCount.textContent = data.cart_count;
				}
			} else {
				toastr.error(data.message || 'Failed to add product to cart');
			}
		})
		.catch(error => {
			console.error('Error:', error);
			toastr.error('An error occurred. Please try again.');
		});
	});
});
</script>
