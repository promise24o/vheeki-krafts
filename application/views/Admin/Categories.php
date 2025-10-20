<div class="body-wrapper">
<div class="body-wrapper-inner">
    <div class="container-fluid">
      <div class="card">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
              <h5 class="card-title fw-semibold mb-1">Categories Management</h5>
              <p class="mb-0 text-muted">Organize your product catalog</p>
            </div>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
              <i class="ti ti-plus me-2"></i>Add Category
            </button>
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

          <!-- Search and Filter -->
          <div class="row mb-4">
            <div class="col-md-6">
              <div class="input-group">
                <input type="text" class="form-control" id="searchInput" placeholder="Search categories...">
                <button class="btn btn-outline-secondary" type="button">
                  <i class="ti ti-search"></i>
                </button>
              </div>
            </div>
            <div class="col-md-3">
              <select class="form-select" id="statusFilter">
                <option value="">All Status</option>
                <option value="1">Active</option>
                <option value="0">Inactive</option>
              </select>
            </div>
          </div>

          <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
              <thead class="table-dark">
                <tr>
                  <th>Image</th>
                  <th>Category</th>
                  <th>Description</th>
                  <th>Products Count</th>
                  <th>Status</th>
                  <th>Created</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php if (!empty($categories)): ?>
                  <?php foreach ($categories as $category): ?>
                    <tr>
                      <td>
                        <?php if (!empty($category['category_image']) && file_exists('./uploads/categories/' . $category['category_image'])): ?>
                          <img src="<?= base_url('uploads/categories/' . $category['category_image']) ?>" 
                               alt="<?= htmlspecialchars($category['category_name']) ?>" 
                               width="50" height="50" class="rounded">
                        <?php else: ?>
                          <div class="bg-light rounded d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                            <i class="ti ti-photo text-muted"></i>
                          </div>
                        <?php endif; ?>
                      </td>
                      <td>
                        <div>
                          <h6 class="mb-0"><?= htmlspecialchars($category['category_name']) ?></h6>
                          <small class="text-muted">Slug: <?= $category['category_slug'] ?></small>
                        </div>
                      </td>
                      <td>
                        <span class="text-truncate d-inline-block" style="max-width: 200px;" title="<?= htmlspecialchars($category['category_description']) ?>">
                          <?= !empty($category['category_description']) ? htmlspecialchars(substr($category['category_description'], 0, 50)) . '...' : 'No description' ?>
                        </span>
                      </td>
                      <td>
                        <span class="badge bg-info"><?= isset($category['products_count']) ? $category['products_count'] : 0 ?> products</span>
                      </td>
                      <td>
                        <?php if ($category['is_active']): ?>
                          <span class="badge bg-success">Active</span>
                        <?php else: ?>
                          <span class="badge bg-secondary">Inactive</span>
                        <?php endif; ?>
                      </td>
                      <td>
                        <small class="text-muted"><?= date('M d, Y', strtotime($category['created_at'])) ?></small>
                      </td>
                      <td>
                        <div class="btn-group" role="group">
                          <button type="button" class="btn btn-sm btn-outline-primary edit-category-btn" 
                                  data-bs-toggle="modal" data-bs-target="#editCategoryModal"
                                  data-id="<?= $category['category_id'] ?>"
                                  data-name="<?= htmlspecialchars($category['category_name']) ?>"
                                  data-slug="<?= $category['category_slug'] ?>"
                                  data-description="<?= htmlspecialchars($category['category_description']) ?>"
                                  data-active="<?= $category['is_active'] ?>"
                                  title="Edit">
                            <i class="ti ti-edit"></i>
                          </button>
                          <button type="button" class="btn btn-sm btn-outline-info toggle-status-btn"
                                  data-id="<?= $category['category_id'] ?>"
                                  data-status="<?= $category['is_active'] ?>"
                                  title="<?= $category['is_active'] ? 'Deactivate' : 'Activate' ?>">
                            <i class="ti ti-<?= $category['is_active'] ? 'eye-off' : 'eye' ?>"></i>
                          </button>
                          <button type="button" class="btn btn-sm btn-outline-danger delete-category-btn"
                                  data-id="<?= $category['category_id'] ?>"
                                  data-name="<?= htmlspecialchars($category['category_name']) ?>"
                                  title="Delete">
                            <i class="ti ti-trash"></i>
                          </button>
                        </div>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                <?php else: ?>
                  <tr>
                    <td colspan="7" class="text-center py-4">
                      <div class="text-muted">
                        <i class="ti ti-category fs-1 d-block mb-2"></i>
                        <p class="mb-2">No categories found</p>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                          Add Your First Category
                        </button>
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

<!-- Add Category Modal -->
<div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addCategoryModalLabel">Add New Category</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?= base_url('admin/add_category') ?>" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="row">
            <div class="col-md-8">
              <div class="mb-3">
                <label for="category_name" class="form-label">Category Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="category_name" name="category_name" required>
              </div>

              <div class="mb-3">
                <label for="category_slug" class="form-label">Category Slug</label>
                <input type="text" class="form-control" id="category_slug" name="category_slug" placeholder="auto-generated">
                <small class="text-muted">Leave empty to auto-generate from name</small>
              </div>

              <div class="mb-3">
                <label for="category_description" class="form-label">Description</label>
                <textarea class="form-control" id="category_description" name="category_description" rows="4" placeholder="Describe this category..."></textarea>
              </div>

              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" checked>
                <label class="form-check-label" for="is_active">
                  Active Category
                </label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="mb-3">
                <label for="category_image" class="form-label">Category Image</label>
                <input type="file" class="form-control" id="category_image" name="category_image" accept="image/*">
                <small class="text-muted">Recommended: 400x300px</small>
              </div>
              <div id="image-preview-add" class="mt-3"></div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">
            <i class="ti ti-plus me-2"></i>Add Category
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Edit Category Modal -->
<div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editCategoryModalLabel">Edit Category</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="editCategoryForm" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="row">
            <div class="col-md-8">
              <div class="mb-3">
                <label for="edit_category_name" class="form-label">Category Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="edit_category_name" name="category_name" required>
              </div>

              <div class="mb-3">
                <label for="edit_category_slug" class="form-label">Category Slug</label>
                <input type="text" class="form-control" id="edit_category_slug" name="category_slug">
              </div>

              <div class="mb-3">
                <label for="edit_category_description" class="form-label">Description</label>
                <textarea class="form-control" id="edit_category_description" name="category_description" rows="4"></textarea>
              </div>

              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="edit_is_active" name="is_active" value="1">
                <label class="form-check-label" for="edit_is_active">
                  Active Category
                </label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="mb-3">
                <label for="edit_category_image" class="form-label">Category Image</label>
                <input type="file" class="form-control" id="edit_category_image" name="category_image" accept="image/*">
                <small class="text-muted">Leave empty to keep current image</small>
              </div>
              <div id="image-preview-edit" class="mt-3"></div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">
            <i class="ti ti-device-floppy me-2"></i>Update Category
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
// Auto-generate slug from category name
document.getElementById('category_name').addEventListener('input', function() {
  const name = this.value;
  const slug = name.toLowerCase()
    .replace(/[^a-z0-9 -]/g, '')
    .replace(/\s+/g, '-')
    .replace(/-+/g, '-')
    .trim('-');
  document.getElementById('category_slug').value = slug;
});

// Edit category modal
document.querySelectorAll('.edit-category-btn').forEach(btn => {
  btn.addEventListener('click', function() {
    const id = this.dataset.id;
    const name = this.dataset.name;
    const slug = this.dataset.slug;
    const description = this.dataset.description;
    const active = this.dataset.active;

    document.getElementById('edit_category_name').value = name;
    document.getElementById('edit_category_slug').value = slug;
    document.getElementById('edit_category_description').value = description;
    document.getElementById('edit_is_active').checked = active == '1';
    
    document.getElementById('editCategoryForm').action = '<?= base_url("admin/edit_category/") ?>' + id;
  });
});

// Toggle category status
document.querySelectorAll('.toggle-status-btn').forEach(btn => {
  btn.addEventListener('click', function() {
    const id = this.dataset.id;
    const currentStatus = this.dataset.status;
    const newStatus = currentStatus == '1' ? '0' : '1';
    
    if (confirm('Are you sure you want to ' + (newStatus == '1' ? 'activate' : 'deactivate') + ' this category?')) {
      fetch('<?= base_url("admin/toggle_category_status") ?>', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({
          category_id: id,
          status: newStatus
        })
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          location.reload();
        } else {
          alert('Failed to update category status');
        }
      });
    }
  });
});

// Delete category
document.querySelectorAll('.delete-category-btn').forEach(btn => {
  btn.addEventListener('click', function() {
    const id = this.dataset.id;
    const name = this.dataset.name;
    
    if (confirm('Are you sure you want to delete the category "' + name + '"? This action cannot be undone.')) {
      window.location.href = '<?= base_url("admin/delete_category/") ?>' + id;
    }
  });
});

// Image preview for add modal
document.getElementById('category_image').addEventListener('change', function(e) {
  const preview = document.getElementById('image-preview-add');
  preview.innerHTML = '';
  
  if (e.target.files[0]) {
    const reader = new FileReader();
    reader.onload = function(e) {
      preview.innerHTML = `
        <img src="${e.target.result}" class="img-fluid rounded" style="max-height: 150px;">
      `;
    };
    reader.readAsDataURL(e.target.files[0]);
  }
});

// Image preview for edit modal
document.getElementById('edit_category_image').addEventListener('change', function(e) {
  const preview = document.getElementById('image-preview-edit');
  preview.innerHTML = '';
  
  if (e.target.files[0]) {
    const reader = new FileReader();
    reader.onload = function(e) {
      preview.innerHTML = `
        <img src="${e.target.result}" class="img-fluid rounded" style="max-height: 150px;">
      `;
    };
    reader.readAsDataURL(e.target.files[0]);
  }
});

// Search and filter functionality
document.addEventListener('DOMContentLoaded', function() {
  const searchInput = document.getElementById('searchInput');
  const statusFilter = document.getElementById('statusFilter');
  const tableRows = document.querySelectorAll('tbody tr');

  function filterTable() {
    const searchTerm = searchInput.value.toLowerCase();
    const selectedStatus = statusFilter.value;

    tableRows.forEach(row => {
      if (row.cells.length === 1) return; // Skip "no categories" row
      
      const categoryName = row.cells[1].textContent.toLowerCase();
      const statusBadge = row.cells[4].querySelector('.badge');
      const isActive = statusBadge && statusBadge.classList.contains('bg-success');
      
      let showRow = true;
      
      // Search filter
      if (searchTerm && !categoryName.includes(searchTerm)) {
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
  statusFilter.addEventListener('change', filterTable);
});
</script>
