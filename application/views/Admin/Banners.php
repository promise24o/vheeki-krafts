<div class="body-wrapper">
<div class="body-wrapper-inner">
  <div class="container-fluid">
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
      <div class="card-body px-4 py-3">
        <div class="row align-items-center">
          <div class="col-9">
            <h4 class="fw-semibold mb-8">Homepage Banners</h4>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a class="text-muted text-decoration-none" href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Banners</li>
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
          <h5 class="card-title fw-semibold mb-0">Manage Slider Banners</h5>
          <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addBannerModal">
            <i class="ti ti-plus me-2"></i>Add New Banner
          </button>
        </div>

        <div class="table-responsive">
          <table class="table table-hover align-middle">
            <thead class="table-light">
              <tr>
                <th>Preview</th>
                <th>Content</th>
                <th>Button</th>
                <th>Order</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php if (!empty($banners)): ?>
                <?php foreach ($banners as $banner): ?>
                  <tr>
                    <td>
                      <img src="<?= base_url('uploads/banners/' . $banner['background_image']) ?>" 
                           alt="Banner" 
                           class="rounded" 
                           style="width: 120px; height: 60px; object-fit: cover;">
                    </td>
                    <td>
                      <div>
                        <small class="text-muted"><?= htmlspecialchars($banner['subtitle']) ?></small>
                        <h6 class="mb-0"><?= str_replace('<br>', ' ', $banner['title']) ?></h6>
                      </div>
                    </td>
                    <td>
                      <span class="badge bg-primary"><?= htmlspecialchars($banner['button_text']) ?></span>
                      <br><small class="text-muted"><?= htmlspecialchars($banner['button_link']) ?></small>
                    </td>
                    <td>
                      <span class="badge bg-secondary"><?= $banner['sort_order'] ?></span>
                    </td>
                    <td>
                      <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" 
                               <?= $banner['is_active'] ? 'checked' : '' ?>
                               onchange="toggleStatus(<?= $banner['banner_id'] ?>)">
                      </div>
                    </td>
                    <td>
                      <div class="btn-group" role="group">
                        <button type="button" 
                                class="btn btn-sm btn-outline-primary" 
                                onclick="editBanner(<?= $banner['banner_id'] ?>)"
                                data-bs-toggle="tooltip" 
                                title="Edit">
                          <i class="ti ti-edit"></i>
                        </button>
                        <button type="button" 
                                class="btn btn-sm btn-outline-danger" 
                                onclick="deleteBanner(<?= $banner['banner_id'] ?>)"
                                data-bs-toggle="tooltip" 
                                title="Delete">
                          <i class="ti ti-trash"></i>
                        </button>
                      </div>
                    </td>
                  </tr>
                <?php endforeach; ?>
              <?php else: ?>
                <tr>
                  <td colspan="6" class="text-center py-5">
                    <i class="ti ti-photo-off fs-6 text-muted"></i>
                    <p class="text-muted mt-2 mb-0">No banners found. Add your first banner!</p>
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

<!-- Add Banner Modal -->
<div class="modal fade" id="addBannerModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form method="post" action="<?= base_url('admin/add_banner') ?>" enctype="multipart/form-data">
        <div class="modal-header">
          <h5 class="modal-title">Add New Banner</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label">Subtitle <span class="text-danger">*</span></label>
              <input type="text" class="form-control" name="subtitle" required 
                     placeholder="e.g., Discover Unique Crafts">
              <small class="text-muted">Small text above main title</small>
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label">Title <span class="text-danger">*</span></label>
              <input type="text" class="form-control" name="title" required 
                     placeholder="e.g., Handmade<br>Masterpieces">
              <small class="text-muted">Use &lt;br&gt; for line break</small>
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label">Button Text <span class="text-danger">*</span></label>
              <input type="text" class="form-control" name="button_text" required 
                     placeholder="e.g., Shop Now">
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label">Button Link <span class="text-danger">*</span></label>
              <input type="text" class="form-control" name="button_link" required 
                     placeholder="e.g., /shop">
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label">Sort Order <span class="text-danger">*</span></label>
              <input type="number" class="form-control" name="sort_order" required value="1" min="1">
              <small class="text-muted">Display order (1, 2, 3...)</small>
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label">Status</label>
              <div class="form-check form-switch mt-2">
                <input class="form-check-input" type="checkbox" name="is_active" checked>
                <label class="form-check-label">Active</label>
              </div>
            </div>

            <div class="col-12 mb-3">
              <label class="form-label">Background Image <span class="text-danger">*</span></label>
              <input type="file" class="form-control" name="background_image" required accept="image/*">
              <small class="text-muted">Recommended: 1920x1080px, max 5MB</small>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Add Banner</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Edit Banner Modal -->
<div class="modal fade" id="editBannerModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form method="post" id="editBannerForm" enctype="multipart/form-data">
        <div class="modal-header">
          <h5 class="modal-title">Edit Banner</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label">Subtitle <span class="text-danger">*</span></label>
              <input type="text" class="form-control" name="subtitle" id="edit_subtitle" required>
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label">Title <span class="text-danger">*</span></label>
              <input type="text" class="form-control" name="title" id="edit_title" required>
              <small class="text-muted">Use &lt;br&gt; for line break</small>
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label">Button Text <span class="text-danger">*</span></label>
              <input type="text" class="form-control" name="button_text" id="edit_button_text" required>
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label">Button Link <span class="text-danger">*</span></label>
              <input type="text" class="form-control" name="button_link" id="edit_button_link" required>
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label">Sort Order <span class="text-danger">*</span></label>
              <input type="number" class="form-control" name="sort_order" id="edit_sort_order" required min="1">
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label">Status</label>
              <div class="form-check form-switch mt-2">
                <input class="form-check-input" type="checkbox" name="is_active" id="edit_is_active">
                <label class="form-check-label">Active</label>
              </div>
            </div>

            <div class="col-12 mb-3">
              <label class="form-label">Background Image</label>
              <div id="current_image_preview" class="mb-2"></div>
              <input type="file" class="form-control" name="background_image" accept="image/*">
              <small class="text-muted">Leave empty to keep current image</small>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Update Banner</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
const banners = <?= json_encode($banners) ?>;

function editBanner(bannerId) {
  const banner = banners.find(b => b.banner_id == bannerId);
  if (!banner) return;

  document.getElementById('edit_subtitle').value = banner.subtitle;
  document.getElementById('edit_title').value = banner.title;
  document.getElementById('edit_button_text').value = banner.button_text;
  document.getElementById('edit_button_link').value = banner.button_link;
  document.getElementById('edit_sort_order').value = banner.sort_order;
  document.getElementById('edit_is_active').checked = banner.is_active == 1;

  // Show current image
  const preview = document.getElementById('current_image_preview');
  preview.innerHTML = `<img src="<?= base_url('uploads/banners/') ?>${banner.background_image}" class="img-thumbnail" style="max-height: 100px;">`;

  // Set form action
  document.getElementById('editBannerForm').action = '<?= base_url('admin/edit_banner/') ?>' + bannerId;

  // Show modal
  new bootstrap.Modal(document.getElementById('editBannerModal')).show();
}

function deleteBanner(bannerId) {
  if (!confirm('Are you sure you want to delete this banner? This action cannot be undone.')) return;

  fetch('<?= base_url('admin/delete_banner/') ?>' + bannerId, {
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

function toggleStatus(bannerId) {
  fetch('<?= base_url('admin/toggle_banner_status/') ?>' + bannerId, {
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
