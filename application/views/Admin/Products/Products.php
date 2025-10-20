<div class="body-wrapper">
<div class="body-wrapper-inner">
    <div class="container-fluid">
      <div class="card">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
              <h5 class="card-title fw-semibold mb-1">Products Management</h5>
              <p class="mb-0 text-muted">Manage your product catalog</p>
            </div>
            <a href="<?= base_url('admin/add_product') ?>" class="btn btn-primary">
              <i class="ti ti-plus me-2"></i>Add Product
            </a>
          </div>

          <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <?= $this->session->flashdata('success') ?>
              <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
          <?php endif; ?>

          <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <?= $this->session->flashdata('error') ?>
              <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
          <?php endif; ?>

          <!-- Filters -->
          <div class="row mb-4">
            <div class="col-md-3">
              <select class="form-select" id="categoryFilter">
                <option value="">All Categories</option>
                <?php 
                $this->load->model('crud_model');
                $categories = $this->crud_model->get_all_categories();
                foreach ($categories as $category): ?>
                  <option value="<?= $category['category_id'] ?>"><?= htmlspecialchars($category['category_name']) ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="col-md-3">
              <select class="form-select" id="statusFilter">
                <option value="">All Status</option>
                <option value="1">Active</option>
                <option value="0">Inactive</option>
              </select>
            </div>
            <div class="col-md-6">
              <div class="input-group">
                <input type="text" class="form-control" id="searchInput" placeholder="Search products...">
                <button class="btn btn-outline-secondary" type="button">
                  <i class="ti ti-search"></i>
                </button>
              </div>
            </div>
          </div>

          <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
              <thead class="table-dark">
                <tr>
                  <th>Image</th>
                  <th>Product</th>
                  <th>Category</th>
                  <th>Price</th>
                  <th>Stock</th>
                  <th>Status</th>
                  <th>Highlights</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php if (!empty($products)): ?>
                  <?php foreach ($products as $product): ?>
                    <tr>
                      <td>
                        <img src="<?= base_url('uploads/products/thumb_' . $product['product_id'] . '.jpg') ?>" 
                             alt="<?= htmlspecialchars($product['product_name']) ?>" 
                             width="50" height="50" class="rounded"
                             onerror="this.src='<?= base_url('assets/admin/images/placeholder.png') ?>'">
                      </td>
                      <td>
                        <div>
                          <h6 class="mb-0"><?= htmlspecialchars($product['product_name']) ?></h6>
                          <small class="text-muted">SKU: <?= $product['sku'] ?></small>
                        </div>
                      </td>
                      <td><?= htmlspecialchars($product['category_name'] ?? 'No Category') ?></td>
                      <td>
                        <?php if ($product['discount_price']): ?>
                          <span class="text-decoration-line-through text-muted">₦<?= number_format($product['price'], 2) ?></span><br>
                          <span class="text-success fw-bold">₦<?= number_format($product['discount_price'], 2) ?></span>
                        <?php else: ?>
                          <span class="fw-bold">₦<?= number_format($product['price'], 2) ?></span>
                        <?php endif; ?>
                      </td>
                      <td>
                        <?php if ($product['stock_quantity'] > 0): ?>
                          <span class="badge bg-success"><?= $product['stock_quantity'] ?></span>
                        <?php else: ?>
                          <span class="badge bg-danger">Out of Stock</span>
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
                        <div class="d-flex flex-wrap gap-1">
                          <?php if ($product['is_best_seller']): ?>
                            <span class="badge bg-warning text-dark">Best Seller</span>
                          <?php endif; ?>
                          <?php if ($product['is_new_arrival']): ?>
                            <span class="badge bg-info">New</span>
                          <?php endif; ?>
                          <?php if ($product['is_on_sale']): ?>
                            <span class="badge bg-danger">Sale</span>
                          <?php endif; ?>
                          <?php if ($product['is_hot_item']): ?>
                            <span class="badge bg-primary">Hot</span>
                          <?php endif; ?>
                        </div>
                      </td>
                      <td>
                        <div class="btn-group" role="group">
                          <a href="<?= base_url('admin/edit_product/' . $product['encrypted_id']) ?>" 
                             class="btn btn-sm btn-outline-primary" data-bs-toggle="tooltip" title="Edit">
                            <i class="ti ti-edit"></i>
                          </a>
                          <a href="<?= base_url('admin/view_qr_code/' . $product['encrypted_id']) ?>" 
                             class="btn btn-sm btn-outline-success" data-bs-toggle="tooltip" title="QR Code">
                            <i class="ti ti-qrcode"></i>
                          </a>
                          <a href="<?= base_url('product/' . $product['product_slug']) ?>" 
                             class="btn btn-sm btn-outline-info" target="_blank" data-bs-toggle="tooltip" title="View">
                            <i class="ti ti-eye"></i>
                          </a>
                          <a href="<?= base_url('admin/delete_product/' . $product['encrypted_id']) ?>" 
                             class="btn btn-sm btn-outline-danger delete-btn" data-bs-toggle="tooltip" title="Delete">
                            <i class="ti ti-trash"></i>
                          </a>
                        </div>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                <?php else: ?>
                  <tr>
                    <td colspan="8" class="text-center py-4">
                      <div class="text-muted">
                        <i class="ti ti-package fs-1 d-block mb-2"></i>
                        <p class="mb-2">No products found</p>
                        <a href="<?= base_url('admin/add_product') ?>" class="btn btn-primary">Add Your First Product</a>
                      </div>
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

<script>
// Simple client-side filtering
document.addEventListener('DOMContentLoaded', function() {
  const searchInput = document.getElementById('searchInput');
  const categoryFilter = document.getElementById('categoryFilter');
  const statusFilter = document.getElementById('statusFilter');
  const tableRows = document.querySelectorAll('tbody tr');

  function filterTable() {
    const searchTerm = searchInput.value.toLowerCase();
    const selectedCategory = categoryFilter.value;
    const selectedStatus = statusFilter.value;

    tableRows.forEach(row => {
      if (row.cells.length === 1) return; // Skip "no products" row
      
      const productName = row.cells[1].textContent.toLowerCase();
      const category = row.cells[2].textContent;
      const statusBadge = row.cells[5].querySelector('.badge');
      const isActive = statusBadge && statusBadge.classList.contains('bg-success');
      
      let showRow = true;
      
      // Search filter
      if (searchTerm && !productName.includes(searchTerm)) {
        showRow = false;
      }
      
      // Category filter
      if (selectedCategory && !category.includes(selectedCategory)) {
        showRow = false;
      }
      
      // Status filter
      if (selectedStatus !== '') {
        if ((selectedStatus === '1' && !isActive) || (selectedStatus === '0' && isActive)) {
          showRow = false;
        }
      }
      
      row.style.display = showRow ? '' : 'none';
    });
  }

  searchInput.addEventListener('input', filterTable);
  categoryFilter.addEventListener('change', filterTable);
  statusFilter.addEventListener('change', filterTable);
});
</script>
