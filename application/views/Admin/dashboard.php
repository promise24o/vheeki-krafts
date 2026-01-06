<div class="body-wrapper">
      <div class="body-wrapper-inner">
        <div class="container-fluid">
          <!--  Row 1 - Statistics Cards -->
          <div class="row">
            <div class="col-lg-3 col-md-6">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex align-items-center">
                    <div class="me-3">
                      <span class="btn btn-primary rounded-circle round-48 hstack justify-content-center">
                        <i class="ti ti-package fs-6"></i>
                      </span>
                    </div>
                    <div>
                      <h3 class="mb-0 fw-bolder"><?= $total_products ?></h3>
                      <p class="mb-0 text-muted">Total Products</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex align-items-center">
                    <div class="me-3">
                      <span class="btn btn-success rounded-circle round-48 hstack justify-content-center">
                        <i class="ti ti-shopping-cart fs-6"></i>
                      </span>
                    </div>
                    <div>
                      <h3 class="mb-0 fw-bolder"><?= isset($total_orders) ? $total_orders : 0 ?></h3>
                      <p class="mb-0 text-muted">Total Orders</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex align-items-center">
                    <div class="me-3">
                      <span class="btn btn-warning rounded-circle round-48 hstack justify-content-center">
                        <i class="ti ti-clock fs-6"></i>
                      </span>
                    </div>
                    <div>
                      <h3 class="mb-0 fw-bolder"><?= isset($pending_orders) ? $pending_orders : 0 ?></h3>
                      <p class="mb-0 text-muted">Pending Orders</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex align-items-center">
                    <div class="me-3">
                      <span class="btn btn-info rounded-circle round-48 hstack justify-content-center">
                        <i class="ti ti-currency-naira fs-6"></i>
                      </span>
                    </div>
                    <div>
                      <h3 class="mb-0 fw-bolder">₦<?= isset($total_revenue) ? number_format($total_revenue, 0) : 0 ?></h3>
                      <p class="mb-0 text-muted">Total Revenue</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Row 2 - Secondary Stats -->
          <div class="row">
            <div class="col-lg-3 col-md-6">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex align-items-center">
                    <div class="me-3">
                      <span class="btn btn-secondary rounded-circle round-48 hstack justify-content-center">
                        <i class="ti ti-category fs-6"></i>
                      </span>
                    </div>
                    <div>
                      <h3 class="mb-0 fw-bolder"><?= $total_categories ?></h3>
                      <p class="mb-0 text-muted">Categories</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex align-items-center">
                    <div class="me-3">
                      <span class="btn btn-warning rounded-circle round-48 hstack justify-content-center">
                        <i class="ti ti-message-dots fs-6"></i>
                      </span>
                    </div>
                    <div>
                      <h3 class="mb-0 fw-bolder"><?= $pending_reviews ?></h3>
                      <p class="mb-0 text-muted">Pending Reviews</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex align-items-center">
                    <div class="me-3">
                      <span class="btn btn-danger rounded-circle round-48 hstack justify-content-center">
                        <i class="ti ti-mail fs-6"></i>
                      </span>
                    </div>
                    <div>
                      <h3 class="mb-0 fw-bolder"><?= isset($unread_messages) ? $unread_messages : 0 ?></h3>
                      <p class="mb-0 text-muted">Unread Messages</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Recent Products -->
          <div class="row">
            <div class="col-lg-8">
              <div class="card w-100">
                <div class="card-body">
                  <div class="d-md-flex align-items-center">
                    <div>
                      <h4 class="card-title">Recent Products</h4>
                      <p class="card-subtitle">Latest products added to your store</p>
                    </div>
                    <div class="ms-auto">
                      <a href="<?= base_url('admin/products') ?>" class="btn btn-primary">View All</a>
                    </div>
                  </div>
                  <div class="table-responsive mt-4">
                    <table class="table mb-0 text-nowrap align-middle">
                      <thead>
                        <tr>
                          <th>Product</th>
                          <th>Category</th>
                          <th>Price</th>
                          <th>Status</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if (!empty($recent_products)): ?>
                          <?php foreach ($recent_products as $product): ?>
                            <tr>
                              <td>
                                <div class="d-flex align-items-center">
                                  <div class="me-3">
                                   <img src="<?= $product['main_image']?>" 
                                     alt="<?= htmlspecialchars($product['product_name']) ?>" 
                                     width="50" height="50" class="rounded"
                                     onerror="this.src='<?= base_url('assets/admin/images/placeholder.png') ?>'">
                                  </div>
                                  <div>
                                    <h6 class="mb-0"><?= htmlspecialchars($product['product_name']) ?></h6>
                                    <small class="text-muted"><?= $product['sku'] ?></small>
                                  </div>
                                </div>
                              </td>
                              <td><?= htmlspecialchars($product['category_name']) ?></td>
                              <td>
                                <?php if ($product['discount_price']): ?>
                                  <span class="text-decoration-line-through text-muted">$<?= number_format($product['price'], 2) ?></span>
                                  <span class="text-success fw-bold">$<?= number_format($product['discount_price'], 2) ?></span>
                                <?php else: ?>
                                  <span class="fw-bold">$<?= number_format($product['price'], 2) ?></span>
                                <?php endif; ?>
                              </td>
                              <td>
                                <?php if ($product['is_active']): ?>
                                  <span class="badge bg-success">Active</span>
                                <?php else: ?>
                                  <span class="badge bg-secondary">Inactive</span>
                                <?php endif; ?>
                              </td>
                              <td>
                                <a href="<?= base_url('admin/edit_product/' . $product['product_id']) ?>" class="btn btn-sm btn-outline-primary">Edit</a>
                              </td>
                            </tr>
                          <?php endforeach; ?>
                        <?php else: ?>
                          <tr>
                            <td colspan="5" class="text-center py-4">
                              <p class="text-muted">No products found. <a href="<?= base_url('admin/add_product') ?>">Add your first product</a></p>
                            </td>
                          </tr>
                        <?php endif; ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
