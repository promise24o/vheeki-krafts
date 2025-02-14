<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Lightning Layers Farm Ltd offers a cutting-edge SAAS platform designed to streamline and optimize poultry farm operations, providing modern tools for efficient farm management.">
	<meta name="keywords" content="poultry farm software, SAAS for poultry farms, farm management software, responsive admin template, poultry operations, dashboard template">
	<meta name="author" content="SoftPath Tech">
	<link rel="icon" href="<?= base_url()  ?>assets/dashboard/images/favicon.png" type="image/x-icon">
	<link rel="shortcut icon" href="<?= base_url()  ?>assets/dashboard/images/favicon.png" type="image/x-icon">
	<title>Lightning Layers Farm Ltd <?= $page_title ?></title>
	<!-- Google font-->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;300;400;500;600;700;800&amp;display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="<?= base_url()  ?>assets/dashboard/css/font-awesome.css">
	<!-- ico-font-->
	<link rel="stylesheet" type="text/css" href="<?= base_url()  ?>assets/dashboard/css/vendors/icofont.css">
	<!-- Themify icon-->
	<link rel="stylesheet" type="text/css" href="<?= base_url()  ?>assets/dashboard/css/vendors/themify.css">
	<!-- Flag icon-->
	<link rel="stylesheet" type="text/css" href="<?= base_url()  ?>assets/dashboard/css/vendors/flag-icon.css">
	<!-- Feather icon-->
	<link rel="stylesheet" type="text/css" href="<?= base_url()  ?>assets/dashboard/css/vendors/feather-icon.css">
	<!-- Plugins css start-->
	<link rel="stylesheet" type="text/css" href="<?= base_url()  ?>assets/dashboard/css/vendors/slick.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url()  ?>assets/dashboard/css/vendors/slick-theme.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url()  ?>assets/dashboard/css/vendors/scrollbar.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url()  ?>assets/dashboard/css/vendors/animate.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url()  ?>assets/dashboard/css/vendors/datatables.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<!-- Plugins css Ends-->
	<!-- Bootstrap css-->
	<link rel="stylesheet" type="text/css" href="<?= base_url()  ?>assets/dashboard/css/vendors/bootstrap.css">
	<!-- App css-->
	<link rel="stylesheet" type="text/css" href="<?= base_url()  ?>assets/dashboard/css/style.css">
	<link id="color" rel="stylesheet" href="<?= base_url()  ?>assets/dashboard/css/color-1.css" media="screen">
	<!-- Responsive css-->
	<link rel="stylesheet" type="text/css" href="<?= base_url()  ?>assets/dashboard/css/responsive.css">
	<link href="https://cdn.jsdelivr.net/npm/@flaticon/flaticon-uicons@3.3.1/css/all/all.min.css" rel="stylesheet" type="text/css">

</head>

<body>
	<!-- loader starts-->
	<div class="loader-wrapper">
		<div class="loader">
			<div class="loader4"></div>
		</div>
	</div>
	<!-- loader ends-->
	<!-- tap on top starts-->
	<div class="tap-top"><i data-feather="chevrons-up"></i></div>
	<!-- tap on tap ends-->
	<!-- page-wrapper Start-->
	<div class="page-wrapper compact-wrapper" id="pageWrapper">
		<!-- Page Header Start-->
		<div class="page-header">
			<div class="header-wrapper row m-0">
				<form class="form-inline search-full col" action="#" method="get">
					<div class="form-group w-100">
						<div class="Typeahead Typeahead--twitterUsers">
							<div class="u-posRelative">
								<input class="demo-input Typeahead-input form-control-plaintext w-100" type="text" placeholder="Search Riho .." name="q" title="" autofocus>
								<div class="spinner-border Typeahead-spinner" role="status"><span class="sr-only">Loading... </span></div><i class="close-search" data-feather="x"></i>
							</div>
							<div class="Typeahead-menu"> </div>
						</div>
					</div>
				</form>
				<div class="header-logo-wrapper col-auto p-0">
					<div class="logo-wrapper"> <a href="<?= base_url()  ?>"><img class="img-fluid for-light" src="<?= base_url()  ?>assets/dashboard/images/logo/logo-light.png" alt="logo-light"><img class="img-fluid for-dark" src="<?= base_url()  ?>assets/dashboard/images/logo/logo.png" alt="logo-dark"></a></div>
					<div class="toggle-sidebar"> <i class="status_toggle middle sidebar-toggle" data-feather="align-center"></i></div>
				</div>
				<div class="left-header col-xxl-5 col-xl-6 col-lg-5 col-md-4 col-sm-3 p-0">
					<div> <a class="toggle-sidebar" href="#"> <i class="iconly-Category icli"> </i></a>
						<div class="d-flex align-items-center gap-2 ">
							<h4 class="f-w-600">Welcome <?= $this->session->userdata("admin_name") ?></h4><img class="mt-0" src="<?= base_url()  ?>assets/dashboard/images/hand.gif" alt="hand-gif">
						</div>
					</div>
					<div class="welcome-content d-xl-block d-none">
						<span class="text-truncate col-12">Here’s what’s happening on your poultry farm today.</span>
					</div>

				</div>
				<div class="nav-right col-xxl-7 col-xl-6 col-md-7 col-8 pull-right right-header p-0 ms-auto">
					<ul class="nav-menus">
						<li class="d-md-block d-none">
							<div class="form search-form mb-0">
								<div class="input-group"><span class="input-icon">
										<svg>
											<use href="<?= base_url()  ?>assets/dashboard/svg/icon-sprite.svg#search-header"></use>
										</svg>
										<input class="w-100" type="search" placeholder="Search"></span></div>
							</div>
						</li>
						<li class="d-md-none d-block">
							<div class="form search-form mb-0">
								<div class="input-group"> <span class="input-show">
										<svg id="searchIcon">
											<use href="<?= base_url()  ?>assets/dashboard/svg/icon-sprite.svg#search-header"></use>
										</svg>
										<div id="searchInput">
											<input type="search" placeholder="Search">
										</div>
									</span></div>
							</div>
						</li>

						<li>
							<div class="mode"><i class="moon" data-feather="moon"> </i></div>
						</li>

						<li class="profile-nav onhover-dropdown">
							<div class="media profile-media"><img class="b-r-10" src="<?= base_url()  ?>assets/dashboard/images/user/user.png" alt="" width="40">
								<div class="media-body d-xxl-block d-none box-col-none">
									<div class="d-flex align-items-center gap-2"> <span><?= $this->session->userdata("admin_name") ?> </span><i class="middle fa fa-angle-down"> </i></div>
									<p class="mb-0 font-roboto">Admin</p>
								</div>
							</div>
							<ul class="profile-dropdown onhover-show-div">
								<li><a href="user-profile.html"><i data-feather="user"></i><span>My Profile</span></a></li>
								<li> <a href="edit-profile.html"> <i data-feather="settings"></i><span>Settings</span></a></li>
								<li><a class="btn btn-pill btn-outline-primary btn-sm" href="<?= base_url('logout') ?>">Log Out</a></li>
							</ul>
						</li>
					</ul>
				</div>
				<script class="result-template" type="text/x-handlebars-template">
					<div class="ProfileCard u-cf">                        
            <div class="ProfileCard-avatar"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-airplay m-0"><path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path><polygon points="12 15 17 21 7 21 12 15"></polygon></svg></div>
            <div class="ProfileCard-details"> 
            <div class="ProfileCard-realName">{{name}}</div>
            </div> 
            </div>
          </script>
				<script class="empty-template" type="text/x-handlebars-template"><div class="EmptyMessage">Your search turned up 0 results. This most likely means the backend is down, yikes!</div></script>
			</div>
		</div>
		<!-- Page Header Ends                              -->
		<!-- Page Body Start-->
		<div class="page-body-wrapper">
			<!-- Page Sidebar Start-->
			<div class="sidebar-wrapper" data-layout="stroke-svg">
				<div class="logo-wrapper"><a href="<?= base_url()  ?>"><img class="img-fluid" src="<?= base_url()  ?>assets/dashboard/images/logo/logo-light.png" alt="" style="width:50px"></a>
					<div class="back-btn"><i class="fa fa-angle-left"> </i></div>
					<div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div>
				</div>
				<div class="logo-icon-wrapper"><a href="<?= base_url()  ?>"><img class="img-fluid" src="<?= base_url()  ?>assets/dashboard/images/logo/logo-light.png" alt="" style="width: 50px;"></a></div>
				<nav class="sidebar-main">
					<div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
					<div id="sidebar-menu">
						<ul class="sidebar-links" id="simple-bar">
							<li class="back-btn"><a href="<?= base_url()  ?>"><img class="img-fluid" src="<?= base_url()  ?>assets/dashboard/images/logo/logo-icon.png" alt=""></a>
								<div class="mobile-back text-end"> <span>Back </span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
							</li>
							<li class="pin-title sidebar-main-title">
								<div>
									<h6>Pinned</h6>
								</div>
							</li>
							<li class="sidebar-list"><i class="fa fa-thumb-tack"></i>
								<a class="sidebar-link sidebar-title link-nav" href="<?= base_url('admin/dashboard') ?>">
									<i class="fi fi-rr-dashboard text-white"></i>
									<span>Dashboard</span>
								</a>
							</li>

							<li class="sidebar-list"><i class="fa fa-thumb-tack"></i>
								<a class="sidebar-link sidebar-title link-nav" href="<?= base_url('admin/livestock') ?>">
									<i class="fi fi-rr-cow text-white"></i>
									<span>Livestock</span>
								</a>
							</li>
							<li class="sidebar-list"><i class="fa fa-thumb-tack"></i>
								<a class="sidebar-link sidebar-title link-nav" href="<?= base_url('admin/purchase') ?>">
									<i class="fi fi-rr-shopping-cart-add text-white"></i>
									<span>Purchase</span>
								</a>
							</li>

							<li class="sidebar-list"><i class="fa fa-thumb-tack"></i>
								<a class="sidebar-link sidebar-title" href="#">
									<i class="fi fi-tr-house-chimney text-white"></i>
									<span>Shed</span>
								</a>
								<ul class="sidebar-submenu">
									<li><a href="<?= base_url('admin/shed_list') ?>">Shed List</a></li>
									<li><a href="<?= base_url('admin/assign_shed') ?>">Assign to Shed</a></li>
									<li><a href="<?= base_url('admin/death_list') ?>">Death List</a></li>
									<li><a href="<?= base_url('admin/transfer_list') ?>">Transfer List</a></li>
								</ul>
							</li>

							<li class="sidebar-list"><i class="fa fa-thumb-tack"></i>
								<a class="sidebar-link sidebar-title" href="#">
									<i class="fi fi-rr-syringe text-white"></i>
									<span>Vaccine</span>
								</a>
								<ul class="sidebar-submenu">
									<li><a href="<?= base_url('admin/vaccine-list') ?>">Vaccine List</a></li>
									<li><a href="<?= base_url('admin/vaccination-schedule') ?>">Vaccination Schedule</a></li>
									<li><a href="<?= base_url('admin/vaccine-purchase') ?>">Vaccine Purchase</a></li>
								</ul>
							</li>

							<li class="sidebar-list"><i class="fa fa-thumb-tack"></i>
								<a class="sidebar-link sidebar-title" href="#">
									<i class="fi fi-rr-route text-white"></i>
									<span>Routing</span>
								</a>
								<ul class="sidebar-submenu">
									<li><a href="<?= base_url('admin/food-history') ?>">Food History</a></li>
									<li><a href="<?= base_url('admin/food-list') ?>">Food List</a></li>
									<li><a href="<?= base_url('admin/food-stock-list') ?>">Food Stock List</a></li>
									<li><a href="<?= base_url('admin/food-purchase-list') ?>">Food Purchase List</a></li>
								</ul>
							</li>

							<li class="sidebar-list"><i class="fa fa-thumb-tack"></i>
								<a class="sidebar-link sidebar-title" href="#">
									<i class="fi fi-rr-tools text-white"></i>
									<span>Production</span>
								</a>
								<ul class="sidebar-submenu">
									<li><a href="<?= base_url('admin/production-list') ?>">Production List</a></li>
									<li><a href="<?= base_url('admin/production-category') ?>">Production Category</a></li>
									<li><a href="<?= base_url('admin/reproduction-list') ?>">Reproduction List</a></li>
								</ul>
							</li>

							<li class="sidebar-list"><i class="fa fa-thumb-tack"></i>
								<a class="sidebar-link sidebar-title" href="#">
									<i class="fi fi-rr-wallet text-white"></i>
									<span>Sales</span>
								</a>
								<ul class="sidebar-submenu">
									<li><a href="<?= base_url('admin/livestock-sales-list') ?>">Livestock Sales List</a></li>
									<li><a href="<?= base_url('admin/product-sales-list') ?>">Product Sales List</a></li>
								</ul>
							</li>

							<li class="sidebar-list"><i class="fa fa-thumb-tack"></i>
								<a class="sidebar-link sidebar-title" href="#">
									<i class="fi fi-rr-credit-card text-white"></i>
									<span>Payments</span>
								</a>
								<ul class="sidebar-submenu">
									<li><a href="<?= base_url('admin/supplier-payments') ?>">Supplier Payments</a></li>
									<li><a href="<?= base_url('admin/client-payments') ?>">Client Payments</a></li>
									<li><a href="<?= base_url('admin/staff-payments') ?>">Staff Payments</a></li>
								</ul>
							</li>

							<li class="sidebar-list"><i class="fa fa-thumb-tack"></i>
								<a class="sidebar-link sidebar-title" href="#">
									<i class="fi fi-rr-chart-pie-alt text-white"></i>
									<span>Expenses</span>
								</a>
								<ul class="sidebar-submenu">
									<li><a href="<?= base_url('admin/expense-list') ?>">Expense List</a></li>
									<li><a href="<?= base_url('admin/expense-category') ?>">Expense Category</a></li>
								</ul>
							</li>

							<li class="sidebar-list"><i class="fa fa-thumb-tack"></i>
								<a class="sidebar-link sidebar-title" href="#">
									<i class="fi fi-rr-document text-white"></i>
									<span>Report</span>
								</a>
								<ul class="sidebar-submenu">
									<li><a href="<?= base_url('admin/purchase-report') ?>">Purchase Report</a></li>
									<li><a href="<?= base_url('admin/sale-report') ?>">Sale Report</a></li>
									<li><a href="<?= base_url('admin/death-report') ?>">Death Report</a></li>
									<li><a href="<?= base_url('admin/food-stock-report') ?>">Food Stock Report</a></li>
									<li><a href="<?= base_url('admin/vaccine-stock-report') ?>">Vaccine Stock Report</a></li>
									<li><a href="<?= base_url('admin/production-stock-report') ?>">Production Stock Report</a></li>
									<li><a href="<?= base_url('admin/supplier-report') ?>">Supplier Report</a></li>
									<li><a href="<?= base_url('admin/client-report') ?>">Client Report</a></li>
									<li><a href="<?= base_url('admin/staff-report') ?>">Staff Report</a></li>
									<li><a href="<?= base_url('admin/other-expense-report') ?>">Other Expense Report</a></li>
									<li><a href="<?= base_url('admin/shed-analysis-report') ?>">Shed Analysis Report</a></li>
									<li><a href="<?= base_url('admin/batch-analysis-report') ?>">Batch Analysis Report</a></li>
									<li><a href="<?= base_url('admin/financial-report') ?>">Financial Report</a></li>
								</ul>
							</li>

							<li class="sidebar-list"><i class="fa fa-thumb-tack"></i>
								<a class="sidebar-link sidebar-title link-nav" href="<?= base_url('admin/suppliers') ?>">
									<i class="fi fi-rr-user text-white"></i>
									<span>Supplier</span>
								</a>
							</li>

							<li class="sidebar-list"><i class="fa fa-thumb-tack"></i>
								<a class="sidebar-link sidebar-title" href="#">
									<i class="fi fi-rr-customer-care text-white"></i>
									<span>Client</span>
								</a>
								<ul class="sidebar-submenu">
									<li><a href="<?= base_url() ?>admin/clients">Client List</a></li>
								</ul>
							</li>

							<li class="sidebar-list"><i class="fa fa-thumb-tack"></i>
								<a class="sidebar-link sidebar-title" href="#">
									<i class="fi fi-rr-users-alt text-white"></i>
									<span>Staff</span>
								</a>
								<ul class="sidebar-submenu">
									<li><a href="<?= base_url() ?>admin/staff/listStaff">Staff List</a></li>
								</ul>
							</li>

							<li class="sidebar-list"><i class="fa fa-thumb-tack"></i>
								<a class="sidebar-link sidebar-title" href="">
									<i class="fa fa-gears text-white"></i>
									<span>Settings</span>
								</a>
								<ul class="sidebar-submenu">
									<li><a href="<?= base_url() ?>admin/settings">Settings</a></li>
									<li><a href="<?= base_url() ?>admin/unit_setup">Unit Setup</a></li>
								</ul>
							</li>

							<li class="sidebar-list"><i class="fa fa-thumb-tack"></i>
								<a class="sidebar-link sidebar-title link-nav" href="<?= base_url() ?>admin/profile">
									<i class="fa fa-user text-white"></i>
									<span>Profile</span>
								</a>
							</li>


						</ul>
						<div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
					</div>
				</nav>
			</div>
