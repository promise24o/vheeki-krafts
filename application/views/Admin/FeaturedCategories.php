<div class="body-wrapper">
<div class="body-wrapper-inner">
  <div class="container-fluid">
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
      <div class="card-body px-4 py-3">
        <div class="row align-items-center">
          <div class="col-9">
            <h4 class="fw-semibold mb-8">Featured Categories</h4>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a class="text-muted text-decoration-none" href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Featured Categories</li>
              </ol>
            </nav>
          </div>
          <div class="col-3">
            <div class="text-center mb-n5">
              <img src="<?= base_url() ?>assets/admin/images/breadcrumb/ChatBc.png" alt="" class="img-fluid mb-n4">
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php if ($this->session->flashdata('success')): ?>
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="ti ti-check me-2"></i><?= $this->session->flashdata('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    <?php endif; ?>

    <?php if ($this->session->flashdata('error')): ?>
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="ti ti-alert-circle me-2"></i><?= $this->session->flashdata('error') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    <?php endif; ?>

    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-4">
          <h5 class="card-title fw-semibold mb-0">Manage Category Showcase</h5>
          <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
            <i class="ti ti-plus me-2"></i>Add Category
          </button>
        </div>

        <div class="table-responsive">
          <table class="table table-hover align-middle">
            <thead class="table-light">
              <tr>
                <th>Images</th>
                <th>Category</th>
                <th>Link</th>
                <th>Items</th>
                <th>Order</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php if (!empty($categories)): ?>
                <?php foreach ($categories as $category): ?>
                  <tr>
                    <td>
                      <div class="d-flex gap-2">
                        <img src="<?= base_url('uploads/categories/' . $category['image_light']) ?>" 
                             alt="Light" class="rounded" style="width: 60px; height: 60px; object-fit: cover;" title="Light mode">
                        <img src="<?= base_url('uploads/categories/' . $category['image_dark']) ?>" 
                             alt="Dark" class="rounded" style="width: 60px; height: 60px; object-fit: cover;" title="Dark mode">
                      </div>
                    </td>
                    <td>
                      <h6 class="mb-0"><?= htmlspecialchars($category['category_name']) ?></h6>
                    </td>
                    <td>
                      <small class="text-muted"><?= htmlspecialchars($category['category_link']) ?></small>
                    </td>
                    <td>
                      <span class="badge bg-info"><?= $category['item_count'] ?> items</span>
                    </td>
                    <td>
                      <span class="badge bg-secondary"><?= $category['sort_order'] ?></span>
                    </td>
                    <td>
                      <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" 
                               <?= $category['is_active'] ? 'checked' : '' ?>
                               onchange="toggleStatus(<?= $category['featured_id'] ?>)">
                      </div>
                    </td>
                    <td>
                      <div class="btn-group" role="group">
                        <button type="button" class="btn btn-sm btn-outline-primary" 
                                onclick="editCategory(<?= $category['featured_id'] ?>)"
                                data-bs-toggle="tooltip" title="Edit">
                          <i class="ti ti-edit"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-outline-danger" 
                                onclick="deleteCategory(<?= $category['featured_id'] ?>)"
                                data-bs-toggle="tooltip" title="Delete">
                          <i class="ti ti-trash"></i>
                        </button>
                      </div>
                    </td>
                  </tr>
                <?php endforeach; ?>
              <?php else: ?>
                <tr>
                  <td colspan="7" class="text-center py-5">
                    <i class="ti ti-category-off fs-6 text-muted"></i>
                    <p class="text-muted mt-2 mb-0">No categories found. Add your first category!</p>
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

<!-- Add Category Modal -->
<div class="modal fade" id="addCategoryModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form method="post" action="<?= base_url('admin/add_featured_category') ?>" enctype="multipart/form-data">
        <div class="modal-header">
          <h5 class="modal-title">Add Featured Category</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label">Category Name <span class="text-danger">*</span></label>
              <input type="text" class="form-control" name="category_name" required placeholder="e.g., Home Decor">
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label">Category Link <span class="text-danger">*</span></label>
              <input type="text" class="form-control" name="category_link" required placeholder="e.g., /shop?category=home-decor">
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label">Item Count <span class="text-danger">*</span></label>
              <input type="number" class="form-control" name="item_count" required value="0" min="0">
              <small class="text-muted">Number of products in this category</small>
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label">Sort Order <span class="text-danger">*</span></label>
              <input type="number" class="form-control" name="sort_order" required value="1" min="1">
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label">Light Mode Image <span class="text-danger">*</span></label>
              <input type="file" class="form-control" name="image_light" required accept="image/*">
              <small class="text-muted">For light theme (545x545px recommended)</small>
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label">Dark Mode Image <span class="text-danger">*</span></label>
              <input type="file" class="form-control" name="image_dark" required accept="image/*">
              <small class="text-muted">For dark theme (545x545px recommended)</small>
            </div>

            <div class="col-12 mb-3">
              <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" name="is_active" checked>
                <label class="form-check-label">Active</label>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Add Category</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Edit Category Modal -->
<div class="modal fade" id="editCategoryModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form method="post" id="editCategoryForm" enctype="multipart/form-data">
        <div class="modal-header">
          <h5 class="modal-title">Edit Featured Category</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label">Category Name <span class="text-danger">*</span></label>
              <input type="text" class="form-control" name="category_name" id="edit_category_name" required>
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label">Category Link <span class="text-danger">*</span></label>
              <input type="text" class="form-control" name="category_link" id="edit_category_link" required>
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label">Item Count <span class="text-danger">*</span></label>
              <input type="number" class="form-control" name="item_count" id="edit_item_count" required min="0">
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label">Sort Order <span class="text-danger">*</span></label>
              <input type="number" class="form-control" name="sort_order" id="edit_sort_order" required min="1">
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label">Light Mode Image</label>
              <div id="current_image_light_preview" class="mb-2"></div>
              <input type="file" class="form-control" name="image_light" accept="image/*">
              <small class="text-muted">Leave empty to keep current</small>
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label">Dark Mode Image</label>
              <div id="current_image_dark_preview" class="mb-2"></div>
              <input type="file" class="form-control" name="image_dark" accept="image/*">
              <small class="text-muted">Leave empty to keep current</small>
            </div>

            <div class="col-12 mb-3">
              <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" name="is_active" id="edit_is_active">
                <label class="form-check-label">Active</label>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Update Category</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
const categories = <?= json_encode($categories) ?>;

function editCategory(featuredId) {
  const category = categories.find(c => c.featured_id == featuredId);
  if (!category) return;

  document.getElementById('edit_category_name').value = category.category_name;
  document.getElementById('edit_category_link').value = category.category_link;
  document.getElementById('edit_item_count').value = category.item_count;
  document.getElementById('edit_sort_order').value = category.sort_order;
  document.getElementById('edit_is_active').checked = category.is_active == 1;

  // Show current images
  const lightPreview = document.getElementById('current_image_light_preview');
  lightPreview.innerHTML = `<img src="<?= base_url('uploads/categories/') ?>${category.image_light}" class="img-thumbnail" style="max-height: 80px;">`;
  
  const darkPreview = document.getElementById('current_image_dark_preview');
  darkPreview.innerHTML = `<img src="<?= base_url('uploads/categories/') ?>${category.image_dark}" class="img-thumbnail" style="max-height: 80px;">`;

  document.getElementById('editCategoryForm').action = '<?= base_url('admin/edit_featured_category/') ?>' + featuredId;
  new bootstrap.Modal(document.getElementById('editCategoryModal')).show();
}

function deleteCategory(featuredId) {
  if (!confirm('Are you sure you want to delete this category? This action cannot be undone.')) return;

  fetch('<?= base_url('admin/delete_featured_category/') ?>' + featuredId, {
    method: 'POST'
  })
  .then(response => response.json())
  .then(data => {
    if (data.success) {
      alert(data.message);
      location.reload();
    } else {
      alert('Error: ' + data.message);
    }
  })
  .catch(error => alert('Error: ' + error));
}

function toggleStatus(featuredId) {
  fetch('<?= base_url('admin/toggle_featured_category_status/') ?>' + featuredId, {
    method: 'POST'
  })
  .then(response => response.json())
  .then(data => {
    if (!data.success) {
      alert('Failed to update status');
      location.reload();
    }
  })
  .catch(error => {
    alert('Error: ' + error);
    location.reload();
  });
}

// Initialize tooltips
var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl)
});
</script>
