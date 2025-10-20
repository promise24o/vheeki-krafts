<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= isset($page_title) ? $page_title . ' - ' : '' ?>Vheeki Krafts Admin</title>
  <link rel="shortcut icon" type="image/png" href="<?= base_url() ?>assets/landing/images/others/favicon.png" />
  <link rel="stylesheet" href="<?= base_url() ?>assets/admin/css/styles.min.css" />
  <style>
    .sidebar-nav .sidebar-item .sidebar-link.active {
      background-color: var(--bs-primary);
      color: white;
    }
  </style>
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
          <a href="<?= base_url('admin/dashboard') ?>" class="text-nowrap logo-img">
            <h4 class="text-primary mb-0">Vheeki Krafts</h4>
          </a>
          <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-6"></i>
          </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
          <ul id="sidebarnav">
            <li class="nav-small-cap">
              <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-4"></iconify-icon>
              <span class="hide-menu">Home</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link <?= $this->uri->segment(2) == 'dashboard' ? 'active' : '' ?>" href="<?= base_url('admin/dashboard') ?>" aria-expanded="false">
                <i class="ti ti-layout-dashboard"></i>
                <span class="hide-menu">Dashboard</span>
              </a>
            </li>
            
            <li class="nav-small-cap">
              <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-4"></iconify-icon>
              <span class="hide-menu">Catalog</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link <?= in_array($this->uri->segment(2), ['products', 'add_product', 'edit_product']) ? 'active' : '' ?>" href="<?= base_url('admin/products') ?>" aria-expanded="false">
                <i class="ti ti-package"></i>
                <span class="hide-menu">Products</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link <?= $this->uri->segment(2) == 'categories' ? 'active' : '' ?>" href="<?= base_url('admin/categories') ?>" aria-expanded="false">
                <i class="ti ti-category"></i>
                <span class="hide-menu">Categories</span>
              </a>
            </li>
            
            <li class="nav-small-cap">
              <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-4"></iconify-icon>
              <span class="hide-menu">Sales</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link <?= in_array($this->uri->segment(2), ['orders', 'view_order']) ? 'active' : '' ?>" href="<?= base_url('admin/orders') ?>" aria-expanded="false">
                <i class="ti ti-shopping-cart"></i>
                <span class="hide-menu">Orders</span>
                <?php 
                $this->load->model('crud_model');
                $pending_orders = $this->crud_model->get_pending_orders_count();
                if ($pending_orders > 0): ?>
                  <span class="badge bg-warning ms-auto"><?= $pending_orders ?></span>
                <?php endif; ?>
              </a>
            </li>
            
            <li class="nav-small-cap">
              <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-4"></iconify-icon>
              <span class="hide-menu">Customer</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link <?= $this->uri->segment(2) == 'reviews' ? 'active' : '' ?>" href="<?= base_url('admin/reviews') ?>" aria-expanded="false">
                <i class="ti ti-message-dots"></i>
                <span class="hide-menu">Reviews</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link <?= $this->uri->segment(2) == 'contact_messages' || $this->uri->segment(2) == 'view_contact_message' ? 'active' : '' ?>" href="<?= base_url('admin/contact_messages') ?>" aria-expanded="false">
                <i class="ti ti-mail"></i>
                <span class="hide-menu">Contact Messages</span>
                <?php 
                $this->load->model('crud_model');
                $unread = $this->crud_model->get_unread_messages_count();
                if ($unread > 0): ?>
                  <span class="badge bg-danger ms-auto"><?= $unread ?></span>
                <?php endif; ?>
              </a>
            </li>
            
            <li class="nav-small-cap">
              <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-4"></iconify-icon>
              <span class="hide-menu">Content</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link <?= $this->uri->segment(2) == 'banners' ? 'active' : '' ?>" href="<?= base_url('admin/banners') ?>" aria-expanded="false">
                <i class="ti ti-photo"></i>
                <span class="hide-menu">Homepage Banners</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link <?= $this->uri->segment(2) == 'site_settings' ? 'active' : '' ?>" href="<?= base_url('admin/site_settings') ?>" aria-expanded="false">
                <i class="ti ti-settings"></i>
                <span class="hide-menu">Site Settings</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link <?= $this->uri->segment(2) == 'payment_settings' ? 'active' : '' ?>" href="<?= base_url('admin/payment_settings') ?>" aria-expanded="false">
                <i class="ti ti-credit-card"></i>
                <span class="hide-menu">Payment Settings</span>
              </a>
            </li>
            
            <li class="nav-small-cap">
              <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-4"></iconify-icon>
              <span class="hide-menu">Tools</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link <?= $this->uri->segment(2) == 'bulk_upload' ? 'active' : '' ?>" href="<?= base_url('admin/bulk_upload') ?>" aria-expanded="false">
                <i class="ti ti-upload"></i>
                <span class="hide-menu">Bulk Upload</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="<?= base_url() ?>" target="_blank" aria-expanded="false">
                <i class="ti ti-external-link"></i>
                <span class="hide-menu">View Store</span>
              </a>
            </li>
          </ul>
        </nav>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->
    
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      <header class="app-header">
        <nav class="navbar navbar-expand-lg navbar-light">
          <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
              <a class="nav-link sidebartoggler" id="headerCollapse" href="javascript:void(0)">
                <i class="ti ti-menu-2"></i>
              </a>
            </li>
          </ul>
          <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
              <li class="nav-item dropdown">
                <a class="nav-link" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown" aria-expanded="false">
                  <img src="<?= base_url('assets/admin/images/profile/user-1.jpg') ?>" alt="" width="35" height="35" class="rounded-circle">
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                  <div class="message-body">
                    <a href="<?= base_url('admin/profile') ?>" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-user fs-6"></i>
                      <p class="mb-0 fs-3">My Profile</p>
                    </a>
                    <a href="<?= base_url('auth/logout') ?>" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!--  Header End -->
