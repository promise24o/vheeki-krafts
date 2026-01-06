<main id="content" class="wrapper layout-page">
	<section class="z-index-2 position-relative pb-2 mb-12">
		<div class="bg-body-secondary mb-3">
			<div class="container">
				<nav class="py-4 lh-30px" aria-label="breadcrumb">
					<ol class="breadcrumb justify-content-center py-1 mb-0">
						<li class="breadcrumb-item"><a title="Home" href="<?= base_url() ?>">Home</a></li>
						<li class="breadcrumb-item"><a title="Shop" href="<?= base_url('shop') ?>">Shop</a></li>
						<li class="breadcrumb-item active" aria-current="page"><?= htmlspecialchars($product['product_name']) ?></li>
					</ol>
				</nav>
			</div>
		</div>
	</section>
	<section class="container pt-6 pb-13 pb-lg-20">
		<div class="row ">
			<div class="col-md-6 pe-lg-13">
				<div class="row">
					<?php if (!empty($product_images) && count($product_images) > 1): ?>
					<div class="col-xl-2 pe-xl-0 order-1 order-xl-0 mt-5 mt-xl-0">
						<div id="vertical-slider-thumb" class="slick-slider slick-slider-thumb ps-1 ms-n3 me-n4 mx-xl-0" data-slick-options='{"arrows":false,"asNavFor":"#vertical-slider-slides","dots":false,"focusOnSelect":true,"responsive":[{"breakpoint":1260,"settings":{"vertical":false}}],"slidesToShow":4,"vertical":true}'>
							<?php foreach ($product_images as $image): ?>
								<img src="<?= base_url($image['image_path']) ?>" 
								     class="cursor-pointer mx-3 mx-xl-0 px-0 mb-xl-7" 
								     width="75" 
								     height="100" 
								     title="<?= htmlspecialchars($product['product_name']) ?>" 
								     alt="<?= htmlspecialchars($product['product_name']) ?>">
							<?php endforeach; ?>
						</div>
					</div>
					<?php endif; ?>
					<div class="<?= (!empty($product_images) && count($product_images) > 1) ? 'col-xl-10 ps-xl-8' : 'col-12' ?> pe-xl-0 order-0 order-xl-1">
						<?php if (!empty($product_images)): ?>
							<?php if (count($product_images) > 1): ?>
								<div id="vertical-slider-slides" class="slick-slider slick-slider-arrow-inside slick-slider-dots-inside slick-slider-dots-light g-0" data-slick-options='{"arrows":true,"asNavFor":"#vertical-slider-thumb","dots":true,"slidesToShow":1,"vertical":false}'>
									<?php foreach ($product_images as $image): ?>
										<a href="<?= ($image['image_path']) ?>" data-gallery="product-gallery">
											<img src="<?= ($image['image_path']) ?>" 
											     width="540" 
											     height="720" 
											     title="<?= htmlspecialchars($product['product_name']) ?>" 
											     class="h-auto w-100" 
											     alt="<?= htmlspecialchars($product['product_name']) ?>"
											     style="object-fit: cover;">
										</a>
									<?php endforeach; ?>
								</div>
							<?php else: ?>
								<img src="<?= ($product_images[0]['image_path']) ?>" 
								     class="w-100 h-auto" 
								     alt="<?= htmlspecialchars($product['product_name']) ?>"
								     style="object-fit: cover; max-height: 720px;">
							<?php endif; ?>
						<?php else: ?>
							<img src="https://plus.unsplash.com/premium_photo-1705262413765-5fe7a310d4e6" 
							     class="w-100 h-auto" 
							     alt="No image available"
							     style="object-fit: cover; max-height: 720px;">
						<?php endif; ?>
					</div>
				</div>
			</div>
			<div class="col-md-6 pt-md-0 pt-10">
				<p class="d-flex align-items-center mb-6">
					<?php if ($product['discount_price'] && $product['discount_price'] < $product['price']): ?>
						<span class="text-decoration-line-through">₦<?= number_format($product['price'], 2) ?></span>
						<span class="fs-18px text-body-emphasis ps-6 fw-bold">₦<?= number_format($product['discount_price'], 2) ?></span>
						<?php 
						$discount_percent = round((($product['price'] - $product['discount_price']) / $product['price']) * 100);
						?>
						<span class="badge text-bg-primary fs-6 fw-semibold ms-7 px-6 py-3"><?= $discount_percent ?>%</span>
					<?php else: ?>
						<span class="fs-18px text-body-emphasis fw-bold">₦<?= number_format($product['price'], 2) ?></span>
					<?php endif; ?>
				</p>
				<h1 class="mb-4 pb-2 fs-4"><?= htmlspecialchars($product['product_name']) ?></h1>
				<div class="d-flex align-items-center fs-15px mb-6">
					<p class="mb-0 fw-semibold text-body-emphasis">4.0</p>
					<div class="d-flex align-items-center fs-12px justify-content-center mb-0 px-6 rating-result">
						<div class="rating">
							<div class="empty-stars">
								<span class="star"><svg class="icon star-o">
										<use xlink:href="#star-o"></use>
									</svg></span>
								<span class="star"><svg class="icon star-o">
										<use xlink:href="#star-o"></use>
									</svg></span>
								<span class="star"><svg class="icon star-o">
										<use xlink:href="#star-o"></use>
									</svg></span>
								<span class="star"><svg class="icon star-o">
										<use xlink:href="#star-o"></use>
									</svg></span>
								<span class="star"><svg class="icon star-o">
										<use xlink:href="#star-o"></use>
									</svg></span>
							</div>
							<div class="filled-stars" style="width: 80%">
								<span class="star"><svg class="icon star text-primary">
										<use xlink:href="#star"></use>
									</svg></span>
								<span class="star"><svg class="icon star text-primary">
										<use xlink:href="#star"></use>
									</svg></span>
								<span class="star"><svg class="icon star text-primary">
										<use xlink:href="#star"></use>
									</svg></span>
								<span class="star"><svg class="icon star text-primary">
										<use xlink:href="#star"></use>
									</svg></span>
								<span class="star"><svg class="icon star text-primary">
										<use xlink:href="#star"></use>
									</svg></span>
							</div>
						</div>
					</div>
					<a href="#" class="border-start ps-6 text-body">Read 2947 reviews</a>
				</div>
				<p class="fs-15px"><?= nl2br(htmlspecialchars($product['description'])) ?></p>
				
				<?php if ($product['stock_quantity'] > 0): ?>
					<div class="mb-4">
						<span class="badge bg-success"><i class="far fa-check-circle me-1"></i> In Stock (<?= $product['stock_quantity'] ?> available)</span>
					</div>
				<?php else: ?>
					<div class="mb-4">
						<span class="badge bg-danger"><i class="far fa-times-circle me-1"></i> Out of Stock</span>
					</div>
				<?php endif; ?>
				
				<form class="product-info-custom" id="addToCartForm">
					<input type="hidden" name="product_id" value="<?= $product['product_id'] ?>">
					<input type="hidden" name="selected_size" id="selected_size" value="">
					<input type="hidden" name="selected_color" id="selected_color" value="">
					<input type="hidden" name="selected_tags" id="selected_tags" value="">
					
					<?php if (!empty($product['sizes'])): ?>
						<?php $sizes = json_decode($product['sizes'], true); ?>
						<?php if (!empty($sizes) && is_array($sizes)): ?>
						<div class="form-group mb-4">
							<label class="fw-semibold text-body-emphasis mb-2">Available Sizes:</label>
							<div class="d-flex flex-wrap gap-2">
								<?php foreach ($sizes as $size): ?>
									<?php if (!empty(trim($size))): ?>
									<button type="button" class="btn btn-outline-secondary size-option" data-size="<?= htmlspecialchars(trim($size)) ?>">
										<?= htmlspecialchars(trim($size)) ?>
									</button>
									<?php endif; ?>
								<?php endforeach; ?>
							</div>
						</div>
						<?php endif; ?>
					<?php endif; ?>
					
					<?php if (!empty($product['colors'])): ?>
						<?php $colors = json_decode($product['colors'], true); ?>
						<?php if (!empty($colors) && is_array($colors)): ?>
						<div class="form-group mb-4">
							<label class="fw-semibold text-body-emphasis mb-2">Available Colors:</label>
							<div class="d-flex flex-wrap gap-2">
								<?php foreach ($colors as $color): ?>
									<?php if (!empty(trim($color))): ?>
									<button type="button" class="btn btn-outline-secondary color-option" data-color="<?= htmlspecialchars(trim($color)) ?>">
										<?= htmlspecialchars(trim($color)) ?>
									</button>
									<?php endif; ?>
								<?php endforeach; ?>
							</div>
						</div>
						<?php endif; ?>
					<?php endif; ?>
					
					<?php if (!empty($product['tags'])): ?>
						<?php $tags = json_decode($product['tags'], true); ?>
						<?php if (!empty($tags) && is_array($tags)): ?>
						<div class="form-group mb-4">
							<label class="fw-semibold text-body-emphasis mb-2">Tags:</label>
							<div class="d-flex flex-wrap gap-2">
								<?php foreach ($tags as $tag): ?>
									<?php if (!empty(trim($tag))): ?>
									<span class="badge bg-secondary fs-6 px-3 py-2">
										<?= htmlspecialchars(trim($tag)) ?>
									</span>
									<?php endif; ?>
								<?php endforeach; ?>
							</div>
						</div>
						<?php endif; ?>
					<?php endif; ?>
					
					<div class="form-group mb-4">
						<label class="fw-semibold text-body-emphasis mb-2">Quantity:</label>
						<div class="input-group" style="max-width: 150px;">
							<button type="button" class="btn btn-outline-secondary" id="decreaseQty">-</button>
							<input type="number" name="quantity" id="quantity" class="form-control text-center" value="1" min="1" max="<?= $product['stock_quantity'] ?>" readonly>
							<button type="button" class="btn btn-outline-secondary" id="increaseQty">+</button>
						</div>
					</div>
					
					<button type="submit" class="btn btn-lg btn-dark mb-7 mt-3 w-100 btn-hover-bg-primary btn-hover-border-primary" <?= $product['stock_quantity'] <= 0 ? 'disabled' : '' ?>>
						<i class="far fa-shopping-cart me-2"></i>Add To Cart
					</button>
				</form>
				<ul class="single-product-meta list-unstyled border-top pt-7 mt-7">
					<li class="d-flex mb-4 pb-2 align-items-center">
						<span class="text-body-emphasis fw-semibold fs-14px">SKU:</span>
						<span class="ps-4"><?= htmlspecialchars($product['sku']) ?></span>
					</li>
					<?php if (!empty($product['category_name'])): ?>
					<li class="d-flex mb-4 pb-2 align-items-center">
						<span class="text-body-emphasis fw-semibold fs-14px">Category:</span>
						<span class="ps-4"><?= htmlspecialchars($product['category_name']) ?></span>
					</li>
					<?php endif; ?>
					<li class="d-flex mb-4 pb-2 align-items-center">
						<span class="text-body-emphasis fw-semibold fs-14px">Share:</span>
						<ul class="list-inline d-flex align-items-center mb-0 col-8 col-lg-10 ps-4">
							<li class="list-inline-item me-7">
								<a href="#" onclick="shareOnTwitter(); return false;" class="fs-14px text-body product-info-share" data-bs-toggle="tooltip" data-bs-title="Share on Twitter">
									<i class="fab fa-twitter"></i>
								</a>
							</li>
							<li class="list-inline-item me-7">
								<a href="#" onclick="shareOnFacebook(); return false;" class="fs-14px text-body product-info-share" data-bs-toggle="tooltip" data-bs-title="Share on Facebook">
									<i class="fab fa-facebook-f"></i>
								</a>
							</li>
							<li class="list-inline-item me-7">
								<a href="#" onclick="shareOnWhatsApp(); return false;" class="fs-14px text-body product-info-share" data-bs-toggle="tooltip" data-bs-title="Share on WhatsApp">
									<i class="fab fa-whatsapp"></i>
								</a>
							</li>
							<li class="list-inline-item me-7">
								<a href="#" onclick="copyProductLink(); return false;" class="fs-14px text-body product-info-share" data-bs-toggle="tooltip" data-bs-title="Copy Link">
									<i class="far fa-link"></i>
								</a>
							</li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</section>
 <div class="border-top w-100"></div>
	<section class="container pt-15 pb-12 pt-lg-17 pb-lg-20">
		<div class="collapse-tabs">
			<ul class="nav nav-tabs border-0 justify-content-center pb-12 d-none d-md-flex" id="productTabs" role="tablist">
				<li class="nav-item" role="presentation">
					<button class="nav-link m-auto fw-semibold py-0 px-8 fs-4 fs-lg-3 border-0 text-body-emphasis active" id="product-details-tab" data-bs-toggle="tab" data-bs-target="#product-details" type="button" role="tab" aria-controls="product-details" aria-selected="true">Product Details</button>
				</li>
				<li class="nav-item" role="presentation">
					<button class="nav-link m-auto fw-semibold py-0 px-8 fs-4 fs-lg-3 border-0 text-body-emphasis" id="care-instructions-tab" data-bs-toggle="tab" data-bs-target="#care-instructions" type="button" role="tab" aria-controls="care-instructions" aria-selected="false">Care Instructions</button>
				</li>
				<li class="nav-item" role="presentation">
					<button class="nav-link m-auto fw-semibold py-0 px-8 fs-4 fs-lg-3 border-0 text-body-emphasis" id="materials-tab" data-bs-toggle="tab" data-bs-target="#materials" type="button" role="tab" aria-controls="materials" aria-selected="false">Materials</button>
				</li>
			</ul>
			<div class="tab-content">
				<div class="tab-inner">
					<div class="tab-pane fade active show" id="product-details" role="tabpanel" aria-labelledby="product-details-tab" tabindex="0">
						<div class="card border-0 bg-transparent">
							<div class="card-header border-0 bg-transparent px-0 py-4 product-tabs-mobile d-block d-md-none">
								<h5 class="mb-0">
									<button class="btn lh-2 fs-5 py-3 px-6 shadow-none w-100 border text-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-product-detail" aria-expanded="false" aria-controls="collapse-product-detail">Product Detail</button>
								</h5>
							</div>
							<div class="collapse show border-md-0 border p-md-0 p-6" id="collapse-product-detail">
								<?php if (!empty($product['story'])): ?>
									<div class="row">
										<!--<?php if (!empty($product_images)): ?>-->
										<!--	<div class="col-12 col-lg-6 pe-lg-10 pe-xl-20">-->
										<!--		<img src="<?= base_url($product_images[0]['image_path']) ?>" class="w-100 rounded" alt="<?= htmlspecialchars($product['product_name']) ?>" width="470" height="540" style="object-fit: cover;">-->
										<!--	</div>-->
										<!--<?php endif; ?>-->
										<div class="pb-3 <?= !empty($product_images) ? 'col-12 col-lg-6 pt-12 pt-lg-0' : 'col-12' ?>">
											<?= nl2br(htmlspecialchars($product['story'])) ?>
										</div>
									</div>
								<?php else: ?>
									<div class="text-center py-8">
										<p class="text-muted">No product details available.</p>
									</div>
								<?php endif; ?>
							</div>
						</div>
					</div>
					<div class="tab-pane fade" id="care-instructions" role="tabpanel" aria-labelledby="care-instructions-tab" tabindex="0">
						<div class="card border-0 bg-transparent">
							<div class="card-header border-0 bg-transparent px-0 py-4 product-tabs-mobile d-block d-md-none">
								<h5 class="mb-0">
									<button class="btn lh-2 fs-5 py-3 px-6 shadow-none w-100 border text-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-care" aria-expanded="false" aria-controls="collapse-care">Care Instructions</button>
								</h5>
							</div>
							<div class="collapse border-md-0 border p-md-0 p-6" id="collapse-care">
								<?php if (!empty($product['care_instructions'])): ?>
									<div class="pb-3">
										<?= nl2br(htmlspecialchars($product['care_instructions'])) ?>
									</div>
								<?php else: ?>
									<div class="text-center py-8">
										<p class="text-muted">No care instructions available for this product.</p>
									</div>
								<?php endif; ?>
							</div>
						</div>
					</div>
					<div class="tab-pane fade" id="materials" role="tabpanel" aria-labelledby="materials-tab" tabindex="0">
						<div class="card border-0 bg-transparent">
							<div class="card-header border-0 bg-transparent px-0 py-4 product-tabs-mobile d-block d-md-none">
								<h5 class="mb-0">
									<button class="btn lh-2 fs-5 py-3 px-6 shadow-none w-100 border text-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-materials" aria-expanded="false" aria-controls="collapse-materials">Materials</button>
								</h5>
							</div>
							<div class="collapse border-md-0 border p-md-0 p-6" id="collapse-materials">
								<?php if (!empty($product['materials'])): ?>
									<div class="pb-3">
										<?= nl2br(htmlspecialchars($product['materials'])) ?>
									</div>
								<?php else: ?>
									<div class="text-center py-8">
										<p class="text-muted">No materials information available for this product.</p>
									</div>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</main>

<script>
const productData = {
	name: <?= json_encode($product['product_name']) ?>,
	url: window.location.href,
	price: '₦<?= number_format($product['discount_price'] ?: $product['price'], 2) ?>',
	description: <?= json_encode(substr($product['description'], 0, 200)) ?>,
	image: <?= json_encode(!empty($product_images) ? ($product_images[0]['image_path']) : "https://plus.unsplash.com/premium_photo-1705262413765-5fe7a310d4e6") ?>
};

document.addEventListener('DOMContentLoaded', function() {
	const sizeButtons = document.querySelectorAll('.size-option');
	const colorButtons = document.querySelectorAll('.color-option');
	const selectedSizeInput = document.getElementById('selected_size');
	const selectedColorInput = document.getElementById('selected_color');
	
	sizeButtons.forEach(button => {
		button.addEventListener('click', function() {
			sizeButtons.forEach(btn => btn.classList.remove('active', 'btn-dark'));
			sizeButtons.forEach(btn => btn.classList.add('btn-outline-secondary'));
			
			this.classList.remove('btn-outline-secondary');
			this.classList.add('active', 'btn-dark');
			
			selectedSizeInput.value = this.getAttribute('data-size');
		});
	});
	
	colorButtons.forEach(button => {
		button.addEventListener('click', function() {
			colorButtons.forEach(btn => btn.classList.remove('active', 'btn-dark'));
			colorButtons.forEach(btn => btn.classList.add('btn-outline-secondary'));
			
			this.classList.remove('btn-outline-secondary');
			this.classList.add('active', 'btn-dark');
			
			selectedColorInput.value = this.getAttribute('data-color');
		});
	});
	
	const addToCartForm = document.getElementById('addToCartForm');
	if (addToCartForm) {
		addToCartForm.addEventListener('submit', function(e) {
			e.preventDefault();
			
			const hasSizes = sizeButtons.length > 0;
			const hasColors = colorButtons.length > 0;
			
			if (hasSizes && !selectedSizeInput.value) {
				if (typeof toastr !== 'undefined') {
					toastr.warning('Please select a size');
				} else {
					alert('Please select a size');
				}
				return false;
			}
			
			if (hasColors && !selectedColorInput.value) {
				if (typeof toastr !== 'undefined') {
					toastr.warning('Please select a color');
				} else {
					alert('Please select a color');
				}
				return false;
			}
			
			// Submit form via AJAX
			const formData = new FormData(this);
			const submitButton = this.querySelector('button[type="submit"]');
			const originalText = submitButton.innerHTML;
			
			// Show loading state
			submitButton.disabled = true;
			submitButton.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Adding...';
			
			fetch('<?= base_url("landing/cart_add") ?>', {
				method: 'POST',
				body: formData,
				headers: {
					'X-Requested-With': 'XMLHttpRequest'
				}
			})
			.then(response => response.json())
			.then(data => {
				if (data.success) {
					if (typeof toastr !== 'undefined') {
						toastr.success('Product added to cart successfully!');
					} else {
						alert('Product added to cart successfully!');
					}
					
					// Update cart count if cart icon exists
					const cartCountElements = document.querySelectorAll('.cart-count');
					cartCountElements.forEach(element => {
						element.textContent = data.cart_count || 0;
					});
				} else {
					if (typeof toastr !== 'undefined') {
						toastr.error(data.message || 'Failed to add product to cart');
					} else {
						alert(data.message || 'Failed to add product to cart');
					}
				}
			})
			.catch(error => {
				console.error('Error:', error);
				if (typeof toastr !== 'undefined') {
					toastr.error('An error occurred. Please try again.');
				} else {
					alert('An error occurred. Please try again.');
				}
			})
			.finally(() => {
				// Restore button state
				submitButton.disabled = false;
				submitButton.innerHTML = originalText;
			});
		});
	}
});

function shareOnFacebook() {
	const url = encodeURIComponent(productData.url);
	const img = encodeURIComponent(productData.image);
	const title = encodeURIComponent(productData.name);
	window.open(`https://www.facebook.com/sharer/sharer.php?u=${url}&picture=${img}&title=${title}`, '_blank', 'width=600,height=400');
}

function shareOnTwitter() {
	const text = encodeURIComponent(`Check out ${productData.name} - ${productData.price}`);
	const url = encodeURIComponent(productData.url);
	const img = encodeURIComponent(productData.image);
	window.open(`https://twitter.com/intent/tweet?text=${text}&url=${url}&image=${img}`, '_blank', 'width=600,height=400');
}

function shareOnWhatsApp() {
	const text = encodeURIComponent(`Check out ${productData.name} - ${productData.price}\n${productData.url}`);
	window.open(`https://wa.me/?text=${text}`, '_blank');
}

function copyProductLink() {
	navigator.clipboard.writeText(productData.url).then(() => {
		if (typeof toastr !== 'undefined') toastr.success('Product link copied to clipboard!');
		else alert('Product link copied to clipboard!');
	}).catch(err => {
		const tempInput = document.createElement('input');
		tempInput.value = productData.url;
		document.body.appendChild(tempInput);
		tempInput.select();
		document.execCommand('copy');
		document.body.removeChild(tempInput);
		if (typeof toastr !== 'undefined') toastr.success('Product link copied to clipboard!');
		else alert('Product link copied to clipboard!');
	});
}
</script>



