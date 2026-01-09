<!doctype html>
<html lang="en" data-bs-theme="light">

<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Vheeki Krafts - Handmade Artisanal Products | <?= $title ?></title>
	<meta name="description" content="<?= $description ?>">
	<meta name="keywords" content="handmade crafts, artisanal products, Vheeki Krafts, unique gifts, new collections, best sellers, special offers">
	<meta name="robots" content="index, follow">
	<meta name="author" content="Vheeki Krafts">
	<meta property="og:title" content="Vheeki Krafts - Handmade Artisanal Products">
	<meta property="og:description" content="Explore Vheeki Krafts for unique handmade crafts, new collections, and exclusive offers. Shop now for quality artisanal products.">
	<meta property="og:type" content="website">
	<meta property="og:url" content="<?= base_url() ?>">
	<meta property="og:image" content="<?= base_url() ?>assets/landing/images/others/logo.png">
	<meta property="og:site_name" content="Vheeki Krafts">
	<meta name="twitter:card" content="summary_large_image">
	<meta name="twitter:title" content="Vheeki Krafts - Handmade Artisanal Products">
	<meta name="twitter:description" content="Shop unique handmade crafts at Vheeki Krafts. Discover our latest collections and special offers.">
	<meta name="twitter:image" content="<?= base_url() ?>assets/landing/images/others/logo.png">
	<link rel="canonical" href="<?= base_url() ?>">
	<link rel="icon" href="<?= base_url() ?>assets/landing/images/others/favicon.png">
	<link rel="stylesheet" href="<?= base_url() ?>assets/landing/vendors/lightgallery/css/lightgallery-bundle.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/landing/vendors/fontawesome/css/all.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/landing/vendors/animate/animate.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/landing/vendors/slick/slick.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/landing/vendors/mapbox-gl/mapbox-gl.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
	<link
		href="https://fonts.googleapis.com/css2?family=Urbanist:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
		rel="stylesheet">
	<link rel="stylesheet" href="<?= base_url() ?>assets/landing/css/theme.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>

<body>
	<header id="header" class="header header-sticky header-sticky-smart disable-transition-all z-index-5">
		<div class="bg-primary bg-opacity-15">
			<div class="container-xxl container d-flex py-4">
				<div class="w-50 d-none d-lg-block">
					<ul class="social-icons list-inline mb-0 fs-14">
						<?php if (!empty($settings['twitter_url'])): ?>
						<li class="list-inline-item">
							<a href="<?= htmlspecialchars($settings['twitter_url']) ?>" target="_blank" rel="noopener">
								<svg class="icon"><use xlink:href="#twitter"></use></svg>
							</a>
						</li>
						<?php endif; ?>
						<?php if (!empty($settings['facebook_url'])): ?>
						<li class="list-inline-item ms-6">
							<a href="<?= htmlspecialchars($settings['facebook_url']) ?>" target="_blank" rel="noopener">
								<svg class="icon"><use xlink:href="#facebook"></use></svg>
							</a>
						</li>
						<?php endif; ?>
						<?php if (!empty($settings['instagram_url'])): ?>
						<li class="list-inline-item ms-6">
							<a href="<?= htmlspecialchars($settings['instagram_url']) ?>" target="_blank" rel="noopener">
								<svg class="icon"><use xlink:href="#instagram"></use></svg>
							</a>
						</li>
						<?php endif; ?>
						<?php if (!empty($settings['youtube_url'])): ?>
						<li class="list-inline-item ms-6">
							<a href="<?= htmlspecialchars($settings['youtube_url']) ?>" target="_blank" rel="noopener">
								<svg class="icon"><use xlink:href="#youtube"></use></svg>
							</a>
						</li>
						<?php endif; ?>
					</ul>
				</div>
				<div class="w-100 text-center">
					<p class="mb-0 fs-14px fw-bold text-primary text-uppercase">
						<?= !empty($settings['announcement_text']) ? htmlspecialchars($settings['announcement_text']) : 'Free Delivery on all orders above ₦50,000' ?>
					</p>
				</div>
				<div class="w-50 d-none d-lg-block"></div>
			</div>
		</div>

		<div class="sticky-area">
			<div class="main-header nav navbar bg-body navbar-light navbar-expand-xl py-6 py-xl-0">
				<div class="container-xxl container">
					<!-- Mobile View -->
					<div class="d-flex d-xl-none w-100 align-items-center">
						<div class="w-72px">
							<button class="navbar-toggler border-0 shadow-none px-0 canvas-toggle p-4" type="button"
								data-bs-toggle="offcanvas" data-bs-target="#offCanvasNavBar">
								<span class="fs-24 toggle-icon"></span>
							</button>
						</div>
						<div class="d-flex mx-auto">
							<a href="<?= base_url() ?>" class="navbar-brand px-8 py-4 mx-auto">
								<img class="light-mode-img" src="<?= base_url() ?>assets/landing/images/others/logo-full-2.png" width="100" height="80" alt="Vheeki">
								<img class="dark-mode-img" src="<?= base_url() ?>assets/landing/images/others/logo-white.png" width="179" height="26" alt="Vheeki">
							</a>
						</div>
						<div class="icons-actions d-flex justify-content-end align-items-center gap-4 fs-28px text-body-emphasis">
							<div>
								<a class="position-relative lh-1 color-inherit text-decoration-none" href="#"
									data-bs-toggle="offcanvas" data-bs-target="#shoppingCart">
									<svg class="icon icon-shopping-bag-open-light"><use xlink:href="#icon-shopping-bag-open-light"></use></svg>
									<span id="cartCountMobile"
										class="badge bg-dark text-white position-absolute top-0 start-100 translate-middle mt-3 rounded-circle fs-12px d-flex align-items-center justify-content-center"
										style="width:18px;height:18px;font-size:10px;">
										<?php 
										$session_id = $this->session->userdata('session_id') ?: session_id();
										$this->session->set_userdata('session_id', $session_id);
										$this->load->model('crud_model');
										echo $this->crud_model->get_cart_count($session_id);
										?>
									</span>
								</a>
							</div>
							<div class="color-modes position-relative">
								<a class="bd-theme btn btn-link nav-link dropdown-toggle d-inline-flex align-items-center justify-content-center text-primary p-0 rounded-circle"
									href="#" data-bs-toggle="dropdown" data-bs-display="static">
									<svg class="bi my-1 theme-icon-active" width="20" height="20"><use href="#sun-fill"></use></svg>
								</a>
								<ul class="dropdown-menu dropdown-menu-end fs-14px" data-bs-popper="static">
									<li><button type="button" class="dropdown-item d-flex align-items-center active" data-bs-theme-value="light">
										<svg class="bi me-4 opacity-50"><use href="#sun-fill"></use></svg> Light
									</button></li>
									<li><button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="dark">
										<svg class="bi me-4 opacity-50"><use href="#moon-stars-fill"></use></svg> Dark
									</button></li>
									<li><button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="auto">
										<svg class="bi me-4 opacity-50"><use href="#circle-half"></use></svg> Auto
									</button></li>
								</ul>
							</div>
						</div>
					</div>

					<!-- Desktop View -->
					<div class="d-none d-xl-flex flex-column flex-xl-row w-100">
						<div class="w-auto w-xl-50 d-flex align-items-center">
							<div class="icons-actions d-none d-xl-flex justify-content-start me-auto fs-28px text-body-emphasis">
								<div class="pe-6 d-none d-xl-block">
									<a class="lh-1 color-inherit text-decoration-none" href="#" data-bs-toggle="offcanvas" data-bs-target="#searchModal">
										<svg class="icon icon-magnifying-glass-light fs-5"><use xlink:href="#icon-magnifying-glass-light"></use></svg>
									</a>
								</div>
							</div>
							<ul class="navbar-nav w-100 w-xl-auto">
								<li class="nav-item transition-all-xl-1 py-xl-11 py-0 px-xxl-8 px-xl-6">
									<a class="nav-link position-relative py-xl-0 px-xl-0 text-uppercase fw-semibold ls-1 fs-15px fs-xl-14px"
										href="<?= base_url() ?>">Home</a>
								</li>
								<li class="nav-item transition-all-xl-1 py-xl-11 py-0 px-xxl-8 px-xl-6">
									<a class="nav-link position-relative py-xl-0 px-xl-0 text-uppercase fw-semibold ls-1 fs-15px fs-xl-14px"
										href="<?= base_url('shop') ?>">Shop</a>
								</li>
								<li class="nav-item transition-all-xl-1 py-xl-11 py-0 px-xxl-8 px-xl-6 dropdown dropdown-hover">
									<a class="nav-link d-flex justify-content-between position-relative py-xl-0 px-xl-0 text-uppercase fw-semibold ls-1 fs-15px fs-xl-14px dropdown-toggle"
										href="#" data-bs-toggle="dropdown" id="menu-item-pages">
										Pages
									</a>
									<ul class="dropdown-menu py-6" aria-labelledby="menu-item-pages">
										<li><a class="dropdown-item pe-6 border-hover" href="<?= base_url('about') ?>"><span class="border-hover-target">About Us</span></a></li>
										<li><a class="dropdown-item pe-6 border-hover" href="<?= base_url('contact') ?>"><span class="border-hover-target">Contact Us</span></a></li>
									</ul>
								</li>
							</ul>
						</div>
						<div class="px-10 d-none d-xl-flex align-items-center">
							<a href="<?= base_url() ?>" class="navbar-brand px-8 py-4 mx-auto">
								<img class="light-mode-img" src="<?= base_url() ?>assets/landing/images/others/logo.png" width="179" height="26" alt="Vheeki Krafts">
								<img class="dark-mode-img" src="<?= base_url() ?>assets/landing/images/others/logo-white.png" width="179" height="26" alt="Vheeki Krafts">
							</a>
						</div>
						<div class="w-auto w-xl-50 d-flex align-items-center">
							<div class="icons-actions d-none d-xl-flex justify-content-end ms-auto fs-28px text-body-emphasis">
								<div class="px-5 d-none d-xl-inline-block">
									<a class="position-relative lh-1 color-inherit text-decoration-none" href="#"
										data-bs-toggle="offcanvas" data-bs-target="#shoppingCart">
										<svg class="icon icon-shopping-bag-open-light"><use xlink:href="#icon-shopping-bag-open-light"></use></svg>
										<span id="cartCount"
											class="badge bg-dark text-white position-absolute top-0 start-100 translate-middle mt-4 rounded-circle fs-13px p-0 square"
											style="--square-size: 18px">
											<?php 
											$session_id = $this->session->userdata('session_id') ?: session_id();
											$this->session->set_userdata('session_id', $session_id);
											$this->load->model('crud_model');
											echo $this->crud_model->get_cart_count($session_id);
											?>
										</span>
									</a>
								</div>
								<div class="color-modes position-relative ps-5">
									<a class="bd-theme btn btn-link nav-link dropdown-toggle d-inline-flex align-items-center justify-content-center text-primary p-0 rounded-circle"
										href="#" data-bs-toggle="dropdown" data-bs-display="static">
										<svg class="bi my-1 theme-icon-active"><use href="#sun-fill"></use></svg>
									</a>
									<ul class="dropdown-menu dropdown-menu-end fs-14px" data-bs-popper="static">
										<li><button type="button" class="dropdown-item d-flex align-items-center active" data-bs-theme-value="light">
											<svg class="bi me-4 opacity-50"><use href="#sun-fill"></use></svg> Light
										</button></li>
										<li><button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="dark">
											<svg class="bi me-4 opacity-50"><use href="#moon-stars-fill"></use></svg> Dark
										</button></li>
										<li><button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="auto">
											<svg class="bi me-4 opacity-50"><use href="#circle-half"></use></svg> Auto
										</button></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>

	<!-- Offcanvas Navigation -->
	<div class="navbar">
		<div id="offCanvasNavBar" class="offcanvas offcanvas-start" style="--bs-offcanvas-width: 310px">
			<div class="offcanvas-header bg-body-tertiary">
				<h3 class="offcanvas-title text-uppercase">Vheeki Krafts</h3>
				<button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
			</div>
			<hr class="mt-0">
			<div class="offcanvas-body pt-0 mb-2">
				<ul class="navbar-nav w-100">
					<li class="nav-item py-2 px-3">
						<a class="nav-link text-uppercase fw-semibold ls-1 fs-15px d-flex justify-content-between"
						   href="<?= base_url() ?>">Home</a>
					</li>
					<li class="nav-item py-2 px-3">
						<a class="nav-link text-uppercase fw-semibold ls-1 fs-15px d-flex justify-content-between"
						   href="<?= base_url('shop') ?>">Shop</a>
					</li>
					<li class="nav-item py-2 px-3 dropdown">
						<a class="nav-link text-uppercase fw-semibold ls-1 fs-15px dropdown-toggle d-flex justify-content-between"
						   href="#" role="button" data-bs-toggle="dropdown">Pages</a>
						<ul class="dropdown-menu border-0 shadow-sm mt-1">
							<li><a class="dropdown-item py-3 border-hover" href="<?= base_url('about') ?>"><span class="border-hover-target">About Us</span></a></li>
							<li><a class="dropdown-item py-3 border-hover" href="<?= base_url('contact') ?>"><span class="border-hover-target">Contact Us</span></a></li>
						</ul>
					</li>
				</ul>
			</div>
			<hr class="mb-0">
			<div class="offcanvas-footer bg-body-tertiary text-center py-3">
				<small>© 2025 Vheeki Krafts. All rights reserved.</small>
			</div>
		</div>
	</div>
</body>
</html>