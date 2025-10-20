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
										<a href="<?= base_url($image['image_path']) ?>" data-gallery="product-gallery">
											<img src="<?= base_url($image['image_path']) ?>" 
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
								<img src="<?= base_url($product_images[0]['image_path']) ?>" 
								     class="w-100 h-auto" 
								     alt="<?= htmlspecialchars($product['product_name']) ?>"
								     style="object-fit: cover; max-height: 720px;">
							<?php endif; ?>
						<?php else: ?>
							<img src="<?= base_url('assets/admin/images/placeholder.png') ?>" 
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
								<div class="row">
									<div class="col-12 col-lg-6 pe-lg-10 pe-xl-20">
										<img src="#" data-src="/assets/images/shop/product-details-img.jpg" class="w-100 lazy-image" alt="" width="470" height="540">
									</div>
									<div class="pb-3 col-12 col-lg-6 pt-12 pt-lg-0">
										<p class="fw-semibold text-body-emphasis mb-2 pb-4">For Art Lovers & Interior Decorators</p>
										<p class="mb-2 pb-4">Handcrafted canvas artwork created with premium materials and artistic vision. Each piece is unique and adds character to any living space.</p>
										<p class="mb-9">Transform your home with this beautiful handcrafted canvas art. Made with high-quality materials and attention to detail, this piece brings warmth and personality to any room. Perfect for modern and traditional interiors alike.</p>
										<p class="fw-semibold text-body-emphasis mb-2 pb-4">Features</p>
										<ul class="mb-7 ps-6">
											<li class="mb-1">High-quality canvas material</li>
											<li class="mb-1">Handcrafted with attention to detail</li>
											<li class="mb-1">Ready to hang</li>
											<li class="mb-1">Unique artistic design</li>
											<li>Available in multiple sizes</li>
										</ul>
									</div>
								</div>
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
								<div class="pb-3">
									<p class="fw-semibold text-body-emphasis mb-2 pb-4">Follow these care guidelines to maintain your artwork:</p>
									<ul class="ps-6 mb-8">
										<li class="mb-3">Keep away from direct sunlight to prevent fading</li>
										<li class="mb-3">Dust gently with a soft, dry cloth</li>
										<li class="mb-3">Avoid exposure to moisture and humidity</li>
										<li class="mb-3">Handle with clean, dry hands</li>
										<li class="mb-3">Store in a cool, dry place if not displayed</li>
										<li>Frame or mount properly to prevent damage</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<div class="tab-pane fade" id="materials" role="tabpanel" aria-labelledby="materials-tab" tabindex="0">
						<div class="card-header border-0 bg-transparent px-0 py-4 product-tabs-mobile d-block d-md-none">
							<h5 class="mb-0">
								<button class="btn lh-2 fs-5 py-3 px-6 shadow-none w-100 border text-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-materials" aria-expanded="false" aria-controls="collapse-materials">Materials</button>
							</h5>
						</div>
						<div class="collapse border-md-0 border p-md-0 p-6" id="collapse-materials">
							<div class="pb-3">
								<div class="table-responsive mb-5">
									<table class="table table-borderless mb-0">
										<tbody>
											<tr>
												<td class="ps-0 py-5 pe-5 text-body-emphasis">Canvas</td>
												<td class="text-end py-5 ps-5 pe-0">100% Cotton Canvas</td>
											</tr>
											<tr>
												<td class="ps-0 py-5 pe-5 text-body-emphasis">Paint</td>
												<td class="text-end py-5 ps-5 pe-0">Acrylic Paint</td>
											</tr>
											<tr>
												<td class="ps-0 py-5 pe-5 text-body-emphasis">Frame</td>
												<td class="text-end py-5 ps-5 pe-0">Wooden Frame (Optional)</td>
											</tr>
											<tr>
												<td class="ps-0 py-5 pe-5 text-body-emphasis">Finish</td>
												<td class="text-end py-5 ps-5 pe-0">Protective Varnish</td>
											</tr>
											<tr>
												<td class="ps-0 py-5 pe-5 text-body-emphasis">Dimensions</td>
												<td class="text-end py-5 ps-5 pe-0">16x20 inches / 24x36 inches</td>
											</tr>
										</tbody>
									</table>
								</div>
								<p class="mb-0">Perfect for art enthusiasts and interior decorators. Each piece is handcrafted with premium materials ensuring durability and artistic quality. Our canvas artworks are designed to be conversation starters and focal points in any room.</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</main>

<script>
// Product data for sharing
const productData = {
	name: <?= json_encode($product['product_name']) ?>,
	url: window.location.href,
	price: '₦<?= number_format($product['discount_price'] ?: $product['price'], 2) ?>',
	description: <?= json_encode(substr($product['description'], 0, 200)) ?>
};

// Quantity controls
document.getElementById('decreaseQty').addEventListener('click', function() {
	const qtyInput = document.getElementById('quantity');
	let qty = parseInt(qtyInput.value);
	if (qty > 1) {
		qtyInput.value = qty - 1;
	}
});

document.getElementById('increaseQty').addEventListener('click', function() {
	const qtyInput = document.getElementById('quantity');
	let qty = parseInt(qtyInput.value);
	const max = parseInt(qtyInput.max);
	if (qty < max) {
		qtyInput.value = qty + 1;
	}
});

// Add to cart
document.getElementById('addToCartForm').addEventListener('submit', function(e) {
	e.preventDefault();
	
	const formData = new FormData(this);
	const submitBtn = this.querySelector('button[type="submit"]');
	const originalText = submitBtn.innerHTML;
	
	submitBtn.disabled = true;
	submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Adding...';
	
	fetch('<?= base_url("cart/add") ?>', {
		method: 'POST',
		body: formData
	})
	.then(response => response.json())
	.then(data => {
		if (data.success) {
			// Show success message
			if (typeof toastr !== 'undefined') {
				toastr.success('Product added to cart!');
			} else {
				alert('Product added to cart!');
			}
			
			// Update cart count
			const cartCount = document.getElementById('cartCount');
			const sideCartCount = document.getElementById('sideCartCount');
			if (cartCount) {
				cartCount.textContent = data.cart_count;
			}
			if (sideCartCount) {
				sideCartCount.textContent = data.cart_count;
			}
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
			toastr.error('An error occurred');
		} else {
			alert('An error occurred');
		}
	})
	.finally(() => {
		submitBtn.disabled = false;
		submitBtn.innerHTML = originalText;
	});
});

// Social sharing functions
function shareOnFacebook() {
	const url = encodeURIComponent(productData.url);
	window.open(`https://www.facebook.com/sharer/sharer.php?u=${url}`, '_blank', 'width=600,height=400');
}

function shareOnTwitter() {
	const text = encodeURIComponent(`Check out ${productData.name} - ${productData.price}`);
	const url = encodeURIComponent(productData.url);
	window.open(`https://twitter.com/intent/tweet?text=${text}&url=${url}`, '_blank', 'width=600,height=400');
}

function shareOnWhatsApp() {
	const text = encodeURIComponent(`Check out ${productData.name} - ${productData.price}\n${productData.url}`);
	window.open(`https://wa.me/?text=${text}`, '_blank');
}

function copyProductLink() {
	navigator.clipboard.writeText(productData.url).then(() => {
		if (typeof toastr !== 'undefined') {
			toastr.success('Product link copied to clipboard!');
		} else {
			alert('Product link copied to clipboard!');
		}
	}).catch(err => {
		console.error('Failed to copy:', err);
		// Fallback method
		const tempInput = document.createElement('input');
		tempInput.value = productData.url;
		document.body.appendChild(tempInput);
		tempInput.select();
		document.execCommand('copy');
		document.body.removeChild(tempInput);
		
		if (typeof toastr !== 'undefined') {
			toastr.success('Product link copied to clipboard!');
		} else {
			alert('Product link copied to clipboard!');
		}
	});
}
</script>
