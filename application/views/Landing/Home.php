<main id="content" class="wrapper layout-page">
	<section>
		<div class="slick-slider hero hero-header-02 slick-slider-dots-inside"
			data-slick-options='{"arrows":false,"autoplay":true,"autoplaySpeed":9000,"cssEase":"ease-in-out","dots":false,"fade":true,"infinite":true,"slidesToShow":1,"speed":600}'>
			<?php if (!empty($banners)): ?>
				<?php foreach ($banners as $index => $banner): ?>
					<div class="vh-100 d-flex align-items-center">
						<div class="z-index-2 container container-xxl py-21 pt-xl-10 pb-xl-11">
							<div class="hero-content text-start">
								<div data-animate="fadeInDown">
									<p class="text-white mb-8 fw-semibold fs-4"><?= htmlspecialchars($banner['subtitle']) ?></p>
									<h1 class="mb-15 text-white hero-title-2 fw-500"><?= $banner['title'] ?></h1>
								</div>
								<a href="<?= base_url($banner['button_link']) ?>" data-animate="fadeInUp"
									class="pb-2 bg-transparent fw-semibold text-decoration-none hero-link btn btn-link p-0 text-white">
									<?= htmlspecialchars($banner['button_text']) ?>
									<svg class="icon">
										<use xlink:href="#icon-arrow-right"></use>
									</svg>
								</a>
							</div>
						</div>
						<div class="lazy-bg bg-overlay position-absolute z-index-1 w-100 h-100"
							data-bg-src="<?= base_url('uploads/banners/' . $banner['background_image']) ?>">
						</div>
						<div data-animate="fadeInDown"
							class="hero-creative-dots position-absolute bottom-0 mb-7 start-50 translate-middle-x">
							<?php for ($i = 0; $i < count($banners); $i++): ?>
								<span class="fs-5 fw-semibold text-white px-5 <?= $i == $index ? 'active' : '' ?> <?= $i == 0 && $index == 0 ? 'active-first' : '' ?> <?= $i == count($banners)-1 && $index == count($banners)-1 ? 'active-last' : '' ?>">
									<?= str_pad($i + 1, 2, '0', STR_PAD_LEFT) ?>.
								</span>
							<?php endfor; ?>
						</div>
					</div>
				<?php endforeach; ?>
			<?php else: ?>
				<!-- Fallback if no banners -->
				<div class="vh-100 d-flex align-items-center">
					<div class="z-index-2 container container-xxl py-21 pt-xl-10 pb-xl-11">
						<div class="hero-content text-start">
							<div data-animate="fadeInDown">
								<p class="text-white mb-8 fw-semibold fs-4">Welcome to</p>
								<h1 class="mb-15 text-white hero-title-2 fw-500">Vheeki<br>Krafts</h1>
							</div>
							<a href="<?= base_url('shop') ?>" data-animate="fadeInUp"
								class="pb-2 bg-transparent fw-semibold text-decoration-none hero-link btn btn-link p-0 text-white">
								Shop Now
								<svg class="icon">
									<use xlink:href="#icon-arrow-right"></use>
								</svg>
							</a>
						</div>
					</div>
					<div class="lazy-bg bg-overlay position-absolute z-index-1 w-100 h-100"
						data-bg-src="<?= base_url() ?>assets/landing/images/hero-slider/hero-slider-09.jpg">
					</div>
				</div>
			<?php endif; ?>
		</div>
	</section>
	<section id="our_best_sellers">
		<div class="pt-14 pb-14 pt-lg-19 pb-lg-16">
			<div class="container container-xxl mb-13 d-xl-flex">
				<div class="flex-grow-1 text-left" data-animate="fadeInUp">
					<h2 class="mb-5">Best Sellers</h2>
					<p class="fs-18px mb-0 mw-xl-40 mw-lg-50 mw-md-75">Explore our top-selling handmade crafts, loved by our customers for their quality and uniqueness.</p>
				</div>
			</div>
			<div class="container-fluid mb-4">
				<div class="slick-slider our-best-seller-4"
					data-slick-options='{"arrows":true,"centerMode":true,"centerPadding":"calc((100% - 1440px) / 2)","dots":true,"infinite":true,"responsive":[{"breakpoint":1200,"settings":{"arrows":false,"dots":false,"slidesToShow":3}},{"breakpoint":992,"settings":{"arrows":false,"dots":false,"slidesToShow":2}},{"breakpoint":576,"settings":{"arrows":false,"dots":false,"slidesToShow":1}}],"slidesToShow":4}'>
					<div data-animate="fadeInUp">
						<div class="card card-product grid-1 bg-transparent border-0">
							<figure class="card-img-top position-relative mb-7 overflow-hidden">
								<a href="<?= base_url('shop/product-details') ?>" class="hover-zoom-in d-block"
									title="Handwoven Basket">
									<img src="#"
										data-src="<?= base_url() ?>assets/landing/images/products/product-01-330x440.jpg"
										class="img-fluid lazy-image w-100" alt="Handwoven Basket" width="330"
										height="440">
								</a>
								<div class="position-absolute product-flash z-index-2"><span
										class="badge badge-product-flash on-sale bg-primary">-25%</span></div>
								<div class="position-absolute d-flex z-index-2 product-actions horizontal">
									<a class="text-body-emphasis bg-body bg-dark-hover text-light-hover rounded-circle square product-action shadow-sm add_to_cart"
										href="#" data-bs-toggle="tooltip" data-bs-placement="top"
										data-bs-title="Add To Cart">
										<svg class="icon icon-shopping-bag-open-light">
											<use xlink:href="#icon-shopping-bag-open-light"></use>
										</svg>
									</a>
									<a class="text-body-emphasis bg-body bg-dark-hover text-light-hover rounded-circle square product-action shadow-sm quick-view"
										href="#" data-bs-toggle="tooltip" data-bs-placement="top"
										data-bs-title="Quick View">
										<span data-bs-toggle="modal" data-bs-target="#quickViewModal"
											class="d-flex align-items-center justify-content-center">
											<svg class="icon icon-eye-light">
												<use xlink:href="#icon-eye-light"></use>
											</svg>
										</span>
									</a>
									<a class="text-body-emphasis bg-body bg-dark-hover text-light-hover rounded-circle square product-action shadow-sm wishlist"
										href="#" data-bs-toggle="tooltip" data-bs-placement="top"
										data-bs-title="Add To Wishlist">
										<svg class="icon icon-star-light">
											<use xlink:href="#icon-star-light"></use>
										</svg>
									</a>
									<a class="text-body-emphasis bg-body bg-dark-hover text-light-hover rounded-circle square product-action shadow-sm compare"
										href="<?= base_url('shop/compare') ?>" data-bs-toggle="tooltip" data-bs-placement="top"
										data-bs-title="Compare">
										<svg class="icon icon-arrows-left-right-light">
											<use xlink:href="#icon-arrows-left-right-light"></use>
										</svg>
									</a>
								</div>
							</figure>
							<div class="card-body text-center p-0">
								<span class="d-flex align-items-center price text-body-emphasis fw-bold justify-content-center mb-3 fs-6">
									<del class="text-body fw-500 me-4 fs-13px">$40.00</del>
									<ins class="text-decoration-none">$30.00</ins>
								</span>
								<h4 class="product-title card-title text-primary-hover text-body-emphasis fs-15px fw-500 mb-3">
									<a class="text-decoration-none text-reset" href="<?= base_url('shop/product-details') ?>">Handwoven Basket</a>
								</h4>
								<div class="d-flex align-items-center fs-12px justify-content-center">
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
									<span class="reviews ms-4 pt-3 fs-14px">2947 reviews</span>
								</div>
							</div>
						</div>
					</div>
					<div data-animate="fadeInUp">
						<div class="card card-product grid-1 bg-transparent border-0">
							<figure class="card-img-top position-relative mb-7 overflow-hidden">
								<a href="<?= base_url('shop/product-details') ?>" class="hover-zoom-in d-block"
									title="Ceramic Vase">
									<img src="#"
										data-src="<?= base_url() ?>assets/landing/images/products/product-02-330x440.jpg"
										class="img-fluid lazy-image w-100" alt="Ceramic Vase" width="330"
										height="440">
								</a>
								<div class="position-absolute d-flex z-index-2 product-actions horizontal">
									<a class="text-body-emphasis bg-body bg-dark-hover text-light-hover rounded-circle square product-action shadow-sm add_to_cart"
										href="#" data-bs-toggle="tooltip" data-bs-placement="top"
										data-bs-title="Add To Cart">
										<svg class="icon icon-shopping-bag-open-light">
											<use xlink:href="#icon-shopping-bag-open-light"></use>
										</svg>
									</a>
									<a class="text-body-emphasis bg-body bg-dark-hover text-light-hover rounded-circle square product-action shadow-sm quick-view"
										href="#" data-bs-toggle="tooltip" data-bs-placement="top"
										data-bs-title="Quick View">
										<span data-bs-toggle="modal" data-bs-target="#quickViewModal"
											class="d-flex align-items-center justify-content-center">
											<svg class="icon icon-eye-light">
												<use xlink:href="#icon-eye-light"></use>
											</svg>
										</span>
									</a>
									<a class="text-body-emphasis bg-body bg-dark-hover text-light-hover rounded-circle square product-action shadow-sm wishlist"
										href="#" data-bs-toggle="tooltip" data-bs-placement="top"
										data-bs-title="Add To Wishlist">
										<svg class="icon icon-star-light">
											<use xlink:href="#icon-star-light"></use>
										</svg>
									</a>
									<a class="text-body-emphasis bg-body bg-dark-hover text-light-hover rounded-circle square product-action shadow-sm compare"
										href="<?= base_url('shop/compare') ?>" data-bs-toggle="tooltip" data-bs-placement="top"
										data-bs-title="Compare">
										<svg class="icon icon-arrows-left-right-light">
											<use xlink:href="#icon-arrows-left-right-light"></use>
										</svg>
									</a>
								</div>
							</figure>
							<div class="card-body text-center p-0">
								<span class="d-flex align-items-center price text-body-emphasis fw-bold justify-content-center mb-3 fs-6">$20.00</span>
								<h4 class="product-title card-title text-primary-hover text-body-emphasis fs-15px fw-500 mb-3">
									<a class="text-decoration-none text-reset" href="<?= base_url('shop/product-details') ?>">Ceramic Vase</a>
								</h4>
								<div class="d-flex align-items-center fs-12px justify-content-center">
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
										<div class="filled-stars" style="width: 100%">
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
									<span class="reviews ms-4 pt-3 fs-14px">2947 reviews</span>
								</div>
							</div>
						</div>
					</div>
					<div data-animate="fadeInUp">
						<div class="card card-product grid-1 bg-transparent border-0">
							<figure class="card-img-top position-relative mb-7 overflow-hidden">
								<a href="<?= base_url('shop/product-details') ?>" class="hover-zoom-in d-block"
									title="Wooden Sculpture">
									<img src="#"
										data-src="<?= base_url() ?>assets/landing/images/products/product-03-330x440.jpg"
										class="img-fluid lazy-image w-100" alt="Wooden Sculpture" width="330"
										height="440">
								</a>
								<div class="position-absolute product-flash z-index-2"><span
										class="badge badge-product-flash on-new">New</span></div>
								<div class="position-absolute d-flex z-index-2 product-actions horizontal">
									<a class="text-body-emphasis bg-body bg-dark-hover text-light-hover rounded-circle square product-action shadow-sm add_to_cart"
										href="#" data-bs-toggle="tooltip" data-bs-placement="top"
										data-bs-title="Add To Cart">
										<svg class="icon icon-shopping-bag-open-light">
											<use xlink:href="#icon-shopping-bag-open-light"></use>
										</svg>
									</a>
									<a class="text-body-emphasis bg-body bg-dark-hover text-light-hover rounded-circle square product-action shadow-sm quick-view"
										href="#" data-bs-toggle="tooltip" data-bs-placement="top"
										data-bs-title="Quick View">
										<span data-bs-toggle="modal" data-bs-target="#quickViewModal"
											class="d-flex align-items-center justify-content-center">
											<svg class="icon icon-eye-light">
												<use xlink:href="#icon-eye-light"></use>
											</svg>
										</span>
									</a>
									<a class="text-body-emphasis bg-body bg-dark-hover text-light-hover rounded-circle square product-action shadow-sm wishlist"
										href="#" data-bs-toggle="tooltip" data-bs-placement="top"
										data-bs-title="Add To Wishlist">
										<svg class="icon icon-star-light">
											<use xlink:href="#icon-star-light"></use>
										</svg>
									</a>
									<a class="text-body-emphasis bg-body bg-dark-hover text-light-hover rounded-circle square product-action shadow-sm compare"
										href="<?= base_url('shop/compare') ?>" data-bs-toggle="tooltip" data-bs-placement="top"
										data-bs-title="Compare">
										<svg class="icon icon-arrows-left-right-light">
											<use xlink:href="#icon-arrows-left-right-light"></use>
										</svg>
									</a>
								</div>
							</figure>
							<div class="card-body text-center p-0">
								<span class="d-flex align-items-center price text-body-emphasis fw-bold justify-content-center mb-3 fs-6">$29.00</span>
								<h4 class="product-title card-title text-primary-hover text-body-emphasis fs-15px fw-500 mb-3">
									<a class="text-decoration-none text-reset" href="<?= base_url('shop/product-details') ?>">Wooden Sculpture</a>
								</h4>
								<div class="d-flex align-items-center fs-12px justify-content-center">
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
										<div class="filled-stars" style="width: 100%">
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
									<span class="reviews ms-4 pt-3 fs-14px">2947 reviews</span>
								</div>
							</div>
						</div>
					</div>
					<div data-animate="fadeInUp">
						<div class="card card-product grid-1 bg-transparent border-0">
							<figure class="card-img-top position-relative mb-7 overflow-hidden">
								<a href="<?= base_url('shop/product-details') ?>" class="hover-zoom-in d-block"
									title="Beaded Necklace">
									<img src="#"
										data-src="<?= base_url() ?>assets/landing/images/products/product-04-330x440.jpg"
										class="img-fluid lazy-image w-100" alt="Beaded Necklace" width="330"
										height="440">
								</a>
								<div class="position-absolute product-flash z-index-2"><span
										class="badge badge-product-flash on-sale bg-primary">-24%</span></div>
								<div class="position-absolute d-flex z-index-2 product-actions horizontal">
									<a class="text-body-emphasis bg-body bg-dark-hover text-light-hover rounded-circle square product-action shadow-sm add_to_cart"
										href="#" data-bs-toggle="tooltip" data-bs-placement="top"
										data-bs-title="Add To Cart">
										<svg class="icon icon-shopping-bag-open-light">
											<use xlink:href="#icon-shopping-bag-open-light"></use>
										</svg>
									</a>
									<a class="text-body-emphasis bg-body bg-dark-hover text-light-hover rounded-circle square product-action shadow-sm quick-view"
										href="#" data-bs-toggle="tooltip" data-bs-placement="top"
										data-bs-title="Quick View">
										<span data-bs-toggle="modal" data-bs-target="#quickViewModal"
											class="d-flex align-items-center justify-content-center">
											<svg class="icon icon-eye-light">
												<use xlink:href="#icon-eye-light"></use>
											</svg>
										</span>
									</a>
									<a class="text-body-emphasis bg-body bg-dark-hover text-light-hover rounded-circle square product-action shadow-sm wishlist"
										href="#" data-bs-toggle="tooltip" data-bs-placement="top"
										data-bs-title="Add To Wishlist">
										<svg class="icon icon-star-light">
											<use xlink:href="#icon-star-light"></use>
										</svg>
									</a>
									<a class="text-body-emphasis bg-body bg-dark-hover text-light-hover rounded-circle square product-action shadow-sm compare"
										href="<?= base_url('shop/compare') ?>" data-bs-toggle="tooltip" data-bs-placement="top"
										data-bs-title="Compare">
										<svg class="icon icon-arrows-left-right-light">
											<use xlink:href="#icon-arrows-left-right-light"></use>
										</svg>
									</a>
								</div>
							</figure>
							<div class="card-body text-center p-0">
								<span class="d-flex align-items-center price text-body-emphasis fw-bold justify-content-center mb-3 fs-6">
									<del class="text-body fw-500 me-4 fs-13px">$25.00</del>
									<ins class="text-decoration-none">$19.00</ins>
								</span>
								<h4 class="product-title card-title text-primary-hover text-body-emphasis fs-15px fw-500 mb-3">
									<a class="text-decoration-none text-reset" href="<?= base_url('shop/product-details') ?>">Beaded Necklace</a>
								</h4>
								<div class="d-flex align-items-center fs-12px justify-content-center">
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
									<span class="reviews ms-4 pt-3 fs-14px">2947 reviews</span>
								</div>
							</div>
						</div>
					</div>
					<div data-animate="fadeInUp">
						<div class="card card-product grid-1 bg-transparent border-0">
							<figure class="card-img-top position-relative mb-7 overflow-hidden">
								<a href="<?= base_url('shop/product-details') ?>" class="hover-zoom-in d-block"
									title="Embroidered Textile">
									<img src="#"
										data-src="<?= base_url() ?>assets/landing/images/products/product-05-330x440.jpg"
										class="img-fluid lazy-image w-100" alt="Embroidered Textile" width="330"
										height="440">
								</a>
								<div class="position-absolute product-flash z-index-2"><span
										class="badge badge-product-flash on-sale bg-primary">-26%</span></div>
								<div class="position-absolute d-flex z-index-2 product-actions horizontal">
									<a class="text-body-emphasis bg-body bg-dark-hover text-light-hover rounded-circle square product-action shadow-sm add_to_cart"
										href="#" data-bs-toggle="tooltip" data-bs-placement="top"
										data-bs-title="Add To Cart">
										<svg class="icon icon-shopping-bag-open-light">
											<use xlink:href="#icon-shopping-bag-open-light"></use>
										</svg>
									</a>
									<a class="text-body-emphasis bg-body bg-dark-hover text-light-hover rounded-circle square product-action shadow-sm quick-view"
										href="#" data-bs-toggle="tooltip" data-bs-placement="top"
										data-bs-title="Quick View">
										<span data-bs-toggle="modal" data-bs-target="#quickViewModal"
											class="d-flex align-items-center justify-content-center">
											<svg class="icon icon-eye-light">
												<use xlink:href="#icon-eye-light"></use>
											</svg>
										</span>
									</a>
									<a class="text-body-emphasis bg-body bg-dark-hover text-light-hover rounded-circle square product-action shadow-sm wishlist"
										href="#" data-bs-toggle="tooltip" data-bs-placement="top"
										data-bs-title="Add To Wishlist">
										<svg class="icon icon-star-light">
											<use xlink:href="#icon-star-light"></use>
										</svg>
									</a>
									<a class="text-body-emphasis bg-body bg-dark-hover text-light-hover rounded-circle square product-action shadow-sm compare"
										href="<?= base_url('shop/compare') ?>" data-bs-toggle="tooltip" data-bs-placement="top"
										data-bs-title="Compare">
										<svg class="icon icon-arrows-left-right-light">
											<use xlink:href="#icon-arrows-left-right-light"></use>
										</svg>
									</a>
								</div>
							</figure>
							<div class="card-body text-center p-0">
								<span class="d-flex align-items-center price text-body-emphasis fw-bold justify-content-center mb-3 fs-6">
									<del class="text-body fw-500 me-4 fs-13px">$39.00</del>
									<ins class="text-decoration-none">$29.00</ins>
								</span>
								<h4 class="product-title card-title text-primary-hover text-body-emphasis fs-15px fw-500 mb-3">
									<a class="text-decoration-none text-reset" href="<?= base_url('shop/product-details') ?>">Embroidered Textile</a>
								</h4>
								<div class="d-flex align-items-center fs-12px justify-content-center">
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
									<span class="reviews ms-4 pt-3 fs-14px">2947 reviews</span>
								</div>
							</div>
						</div>
					</div>
					<div data-animate="fadeInUp">
						<div class="card card-product grid-1 bg-transparent border-0">
							<figure class="card-img-top position-relative mb-7 overflow-hidden">
								<a href="<?= base_url('shop/product-details') ?>" class="hover-zoom-in d-block"
									title="Pottery Bowl">
									<img src="#"
										data-src="<?= base_url() ?>assets/landing/images/products/product-06-330x440.jpg"
										class="img-fluid lazy-image w-100" alt="Pottery Bowl" width="330"
										height="440">
								</a>
								<div class="position-absolute d-flex z-index-2 product-actions horizontal">
									<a class="text-body-emphasis bg-body bg-dark-hover text-light-hover rounded-circle square product-action shadow-sm add_to_cart"
										href="#" data-bs-toggle="tooltip" data-bs-placement="top"
										data-bs-title="Add To Cart">
										<svg class="icon icon-shopping-bag-open-light">
											<use xlink:href="#icon-shopping-bag-open-light"></use>
										</svg>
									</a>
									<a class="text-body-emphasis bg-body bg-dark-hover text-light-hover rounded-circle square product-action shadow-sm quick-view"
										href="#" data-bs-toggle="tooltip" data-bs-placement="top"
										data-bs-title="Quick View">
										<span data-bs-toggle="modal" data-bs-target="#quickViewModal"
											class="d-flex align-items-center justify-content-center">
											<svg class="icon icon-eye-light">
												<use xlink:href="#icon-eye-light"></use>
											</svg>
										</span>
									</a>
									<a class="text-body-emphasis bg-body bg-dark-hover text-light-hover rounded-circle square product-action shadow-sm wishlist"
										href="#" data-bs-toggle="tooltip" data-bs-placement="top"
										data-bs-title="Add To Wishlist">
										<svg class="icon icon-star-light">
											<use xlink:href="#icon-star-light"></use>
										</svg>
									</a>
									<a class="text-body-emphasis bg-body bg-dark-hover text-light-hover rounded-circle square product-action shadow-sm compare"
										href="<?= base_url('shop/compare') ?>" data-bs-toggle="tooltip" data-bs-placement="top"
										data-bs-title="Compare">
										<svg class="icon icon-arrows-left-right-light">
											<use xlink:href="#icon-arrows-left-right-light"></use>
										</svg>
									</a>
								</div>
							</figure>
							<div class="card-body text-center p-0">
								<span class="d-flex align-items-center price text-body-emphasis fw-bold justify-content-center mb-3 fs-6">$29.00</span>
								<h4 class="product-title card-title text-primary-hover text-body-emphasis fs-15px fw-500 mb-3">
									<a class="text-decoration-none text-reset" href="<?= base_url('shop/product-details') ?>">Pottery Bowl</a>
								</h4>
								<div class="d-flex align-items-center fs-12px justify-content-center">
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
										<div class="filled-stars" style="width: 100%">
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
									<span class="reviews ms-4 pt-3 fs-14px">2947 reviews</span>
								</div>
							</div>
						</div>
					</div>
					<div data-animate="fadeInUp">
						<div class="card card-product grid-1 bg-transparent border-0">
							<figure class="card-img-top position-relative mb-7 overflow-hidden">
								<a href="<?= base_url('shop/product-details') ?>" class="hover-zoom-in d-block"
									title="Leather Wallet">
									<img src="#"
										data-src="<?= base_url() ?>assets/landing/images/products/product-07-330x440.jpg"
										class="img-fluid lazy-image w-100" alt="Leather Wallet" width="330"
										height="440">
								</a>
								<div class="position-absolute d-flex z-index-2 product-actions horizontal">
									<a class="text-body-emphasis bg-body bg-dark-hover text-light-hover rounded-circle square product-action shadow-sm add_to_cart"
										href="#" data-bs-toggle="tooltip" data-bs-placement="top"
										data-bs-title="Add To Cart">
										<svg class="icon icon-shopping-bag-open-light">
											<use xlink:href="#icon-shopping-bag-open-light"></use>
										</svg>
									</a>
									<a class="text-body-emphasis bg-body bg-dark-hover text-light-hover rounded-circle square product-action shadow-sm quick-view"
										href="#" data-bs-toggle="tooltip" data-bs-placement="top"
										data-bs-title="Quick View">
										<span data-bs-toggle="modal" data-bs-target="#quickViewModal"
											class="d-flex align-items-center justify-content-center">
											<svg class="icon icon-eye-light">
												<use xlink:href="#icon-eye-light"></use>
											</svg>
										</span>
									</a>
									<a class="text-body-emphasis bg-body bg-dark-hover text-light-hover rounded-circle square product-action shadow-sm wishlist"
										href="#" data-bs-toggle="tooltip" data-bs-placement="top"
										data-bs-title="Add To Wishlist">
										<svg class="icon icon-star-light">
											<use xlink:href="#icon-star-light"></use>
										</svg>
									</a>
									<a class="text-body-emphasis bg-body bg-dark-hover text-light-hover rounded-circle square product-action shadow-sm compare"
										href="<?= base_url('shop/compare') ?>" data-bs-toggle="tooltip" data-bs-placement="top"
										data-bs-title="Compare">
										<svg class="icon icon-arrows-left-right-light">
											<use xlink:href="#icon-arrows-left-right-light"></use>
										</svg>
									</a>
								</div>
							</figure>
							<div class="card-body text-center p-0">
								<span class="d-flex align-items-center price text-body-emphasis fw-bold justify-content-center mb-3 fs-6">$29.00</span>
								<h4 class="product-title card-title text-primary-hover text-body-emphasis fs-15px fw-500 mb-3">
									<a class="text-decoration-none text-reset" href="<?= base_url('shop/product-details') ?>">Leather Wallet</a>
								</h4>
								<div class="d-flex align-items-center fs-12px justify-content-center">
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
										<div class="filled-stars" style="width: 100%">
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
									<span class="reviews ms-4 pt-3 fs-14px">2947 reviews</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section class="bg-section-3">
		<div class="container container-xxl">
			<div class="row align-items-end">
				<div class="col-lg-4 order-2 order-lg-1 px-xl-6 pb-16 pt-12 py-lg-18 py-xl-22"
					data-animate="fadeInUp">
					<div class="text-left">
						<p class="fs-15px mb-6 ls-1 text-body-emphasis fw-semibold">NEW COLLECTION</p>
						<h2 class="fs-20 w-md-50 w-lg-100 w-xl-80 mb-4 me-7 me-md-25">Explore Our Latest Craft Collection</h2>
						<p class="fs-18px mb-0 text-body-calculate">Handcrafted with love, our products showcase artisanal excellence for every home.</p>
					</div>
					<a href="<?= base_url('shop') ?>" class="mt-10 btn btn-white shadow-sm">Shop Collection</a>
				</div>
				<div class="col-lg-8 order-1 order-lg-2 d-flex justify-content-end">
  <img 
    class="lazy-image img-fluid light-mode-img" 
    src="#"
    data-src="<?= base_url() ?>assets/landing/images/others/other-bg.jpg" 
    alt="new-collection"
    style="width:100%; height:100%; object-fit:cover; object-position:right center;">
  
  <img 
    class="lazy-image dark-mode-img img-fluid" 
    src="#"
    data-src="<?= base_url() ?>assets/landing/images/others/other-bg.jpg" 
    alt="new-collection"
    style="width:100%; height:100%; object-fit:cover; object-position:right center;">
</div>

			</div>
		</div>
	</section>

	<section class="container container-xxl pt-15 pb-16 pb-lg-18 pt-lg-19">
		<div class="text-center" data-animate="fadeInUp">
			<p class="fs-15px mb-6 ls-1 text-body-emphasis fw-semibold">SHOP BY CATEGORIES</p>
			<h2 class="mb-6">Find Your Perfect Craft<br>Explore Our Categories</h2>
		</div>
		<div class="row mt-13">
			<?php if (!empty($categories)): ?>
				<?php foreach ($categories as $category): ?>
					<div class="col-lg-3 col-md-6 col-12" data-animate="fadeInUp">
						<div class="card border-0">
							<a href="<?= base_url('shop?category=' . $category['category_slug']) ?>" class="hover-shine img-scale overflow-hidden">
								<?php 
									$category_img = !empty($category['category_image']) 
										? base_url('uploads/categories/' . $category['category_image']) 
										: base_url('assets/landing/images/others/category-cover.jpg');
								?>
								<img class="lazy-image card-img-top img-scale-change img-fluid light-mode-img" src="#"
									data-src="<?= $category_img ?>" width="545"
									height="611" alt="<?= htmlspecialchars($category['category_name']) ?>">
								<img class="lazy-image dark-mode-img card-img-top img-scale-change img-fluid" src="#"
									data-src="<?= $category_img ?>"
									width="545" height="611" alt="<?= htmlspecialchars($category['category_name']) ?>">
							</a>
							<div class="card-body text-center px-0 py-7">
								<h4 class="card-title fw-semibold mb-5">
									<a href="<?= base_url('shop?category=' . $category['category_slug']) ?>">
										<?= htmlspecialchars($category['category_name']) ?>
									</a>
								</h4>
								<p class="card-text"><?= $category['product_count'] ?> items</p>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
		<div class="text-center mt-10">
			<a href="<?= base_url('shop') ?>" class="btn btn-outline-dark">
				Shop All Crafts
			</a>
		</div>
	</section>

	<?php if (isset($settings['promo_section_active']) && $settings['promo_section_active'] == '1'): ?>
	<section class="bg-section-3" data-animated-id="3">
		<div class="container container-xxl">
			<div class="row align-items-end">
				<div class="col-lg-4 order-2 order-lg-1 px-xl-6 pb-16 pt-12 py-lg-18 py-xl-22 animate__fadeInUp animate__animated" data-animate="fadeInUp">
					<div class="text-left">
						<p class="fs-15px mb-6 ls-1 text-body-emphasis fw-semibold">
							<?= isset($settings['promo_section_subtitle']) ? htmlspecialchars($settings['promo_section_subtitle']) : 'NEW COLLECTION' ?>
						</p>
						<h2 class="fs-20 w-md-50 w-lg-100 w-xl-80 mb-4 me-7 me-md-25">
							<?= isset($settings['promo_section_title']) ? htmlspecialchars($settings['promo_section_title']) : 'Discover Our Collection' ?>
						</h2>
						<p class="fs-18px mb-0 text-body-calculate">
							<?= isset($settings['promo_section_description']) ? htmlspecialchars($settings['promo_section_description']) : '' ?>
						</p>
					</div>
					<a href="<?= isset($settings['promo_section_button_link']) ? base_url($settings['promo_section_button_link']) : base_url('shop') ?>" 
					   class="mt-10 btn btn-white shadow-sm">
						<?= isset($settings['promo_section_button_text']) ? htmlspecialchars($settings['promo_section_button_text']) : 'Explore More' ?>
					</a>
				</div>
				<div class="col-lg-8 order-1 order-lg-2 animate__fadeIn animate__animated" data-animate="fadeIn">
					<?php if (isset($settings['promo_section_image_light']) && !empty($settings['promo_section_image_light'])): ?>
						<img class="img-fluid light-mode-img loaded" 
						     src="<?= base_url('uploads/promo/' . $settings['promo_section_image_light']) ?>" 
						     width="923" height="640" alt="Promo" loading="lazy">
					<?php else: ?>
						<img class="img-fluid light-mode-img loaded" 
						     src="<?= base_url() ?>assets/landing/images/others/other-bg.png" 
						     width="923" height="640" alt="Promo" loading="lazy">
					<?php endif; ?>
					
					<?php if (isset($settings['promo_section_image_dark']) && !empty($settings['promo_section_image_dark'])): ?>
						<img class="lazy-image dark-mode-img img-fluid" 
						     src="<?= base_url('uploads/promo/' . $settings['promo_section_image_dark']) ?>" 
						     width="923" height="640" alt="Promo" loading="lazy">
					<?php else: ?>
						<img class="lazy-image dark-mode-img img-fluid" 
						     src="<?= base_url() ?>assets/landing/images/others/other-bg-white.png" 
						     width="923" height="640" alt="Promo" loading="lazy">
					<?php endif; ?>
				</div>
			</div>
		</div>
	</section>
	<?php endif; ?>

</main>
