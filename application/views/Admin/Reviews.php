<div class="body-wrapper">
<div class="body-wrapper-inner">
  <div class="container-fluid">
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
      <div class="card-body px-4 py-3">
        <div class="row align-items-center">
          <div class="col-9">
            <h4 class="fw-semibold mb-8">Product Reviews</h4>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a class="text-muted text-decoration-none" href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Reviews</li>
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

    <!-- Statistics Cards -->
    <div class="row mb-4">
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <div class="d-flex align-items-center">
              <div class="rounded-circle bg-primary-subtle p-6 me-3">
                <i class="ti ti-message-dots fs-6 text-primary"></i>
              </div>
              <div>
                <h6 class="mb-0 text-muted">Total Reviews</h6>
                <h3 class="mb-0 fw-semibold"><?= $total_count ?></h3>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <div class="d-flex align-items-center">
              <div class="rounded-circle bg-success-subtle p-6 me-3">
                <i class="ti ti-check fs-6 text-success"></i>
              </div>
              <div>
                <h6 class="mb-0 text-muted">Approved</h6>
                <h3 class="mb-0 fw-semibold"><?= $approved_count ?></h3>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <div class="d-flex align-items-center">
              <div class="rounded-circle bg-warning-subtle p-6 me-3">
                <i class="ti ti-clock fs-6 text-warning"></i>
              </div>
              <div>
                <h6 class="mb-0 text-muted">Pending</h6>
                <h3 class="mb-0 fw-semibold"><?= $pending_count ?></h3>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Reviews Table -->
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-4">
          <h5 class="card-title fw-semibold mb-0">All Reviews</h5>
          <div class="d-flex gap-2">
            <button class="btn btn-success btn-sm" id="bulkApproveBtn" style="display:none;">
              <i class="ti ti-check me-1"></i>Approve Selected
            </button>
            <button class="btn btn-danger btn-sm" id="bulkDeleteBtn" style="display:none;">
              <i class="ti ti-trash me-1"></i>Delete Selected
            </button>
          </div>
        </div>

        <!-- Filters -->
        <div class="row mb-4">
          <div class="col-md-3">
            <input type="text" class="form-control" id="searchInput" placeholder="Search reviews..." value="<?= $this->input->get('search') ?>">
          </div>
          <div class="col-md-2">
            <select class="form-select" id="statusFilter">
              <option value="">All Status</option>
              <option value="1" <?= $this->input->get('status') == '1' ? 'selected' : '' ?>>Approved</option>
              <option value="0" <?= $this->input->get('status') == '0' ? 'selected' : '' ?>>Pending</option>
            </select>
          </div>
          <div class="col-md-2">
            <select class="form-select" id="ratingFilter">
              <option value="">All Ratings</option>
              <option value="5" <?= $this->input->get('rating') == '5' ? 'selected' : '' ?>>5 Stars</option>
              <option value="4" <?= $this->input->get('rating') == '4' ? 'selected' : '' ?>>4 Stars</option>
              <option value="3" <?= $this->input->get('rating') == '3' ? 'selected' : '' ?>>3 Stars</option>
              <option value="2" <?= $this->input->get('rating') == '2' ? 'selected' : '' ?>>2 Stars</option>
              <option value="1" <?= $this->input->get('rating') == '1' ? 'selected' : '' ?>>1 Star</option>
            </select>
          </div>
          <div class="col-md-2">
            <button class="btn btn-primary w-100" onclick="applyFilters()">
              <i class="ti ti-filter me-1"></i>Filter
            </button>
          </div>
          <div class="col-md-3 text-end">
            <a href="<?= base_url('admin/reviews') ?>" class="btn btn-outline-secondary">
              <i class="ti ti-refresh me-1"></i>Reset
            </a>
          </div>
        </div>

        <div class="table-responsive">
          <table class="table table-hover align-middle">
            <thead class="table-light">
              <tr>
                <th width="30">
                  <input type="checkbox" class="form-check-input" id="selectAll">
                </th>
                <th>Product</th>
                <th>Reviewer</th>
                <th>Rating</th>
                <th>Review</th>
                <th>Portfolio</th>
                <th>Status</th>
                <th>Date</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php if (!empty($reviews)): ?>
                <?php foreach ($reviews as $review): ?>
                  <tr>
                    <td>
                      <input type="checkbox" class="form-check-input review-checkbox" value="<?= $review['review_id'] ?>">
                    </td>
                    <td>
                      <div>
                        <h6 class="mb-0"><?= htmlspecialchars($review['product_name']) ?></h6>
                        <small class="text-muted">ID: <?= $review['product_id'] ?></small>
                      </div>
                    </td>
                    <td>
                      <div>
                        <h6 class="mb-0"><?= htmlspecialchars($review['customer_name']) ?></h6>
                        <small class="text-muted"><?= htmlspecialchars($review['customer_email']) ?></small>
                      </div>
                    </td>
                    <td>
                      <div class="d-flex align-items-center">
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                          <?php if ($i <= $review['rating']): ?>
                            <i class="ti ti-star-filled text-warning"></i>
                          <?php else: ?>
                            <i class="ti ti-star text-muted"></i>
                          <?php endif; ?>
                        <?php endfor; ?>
                        <span class="ms-2 fw-semibold"><?= $review['rating'] ?></span>
                      </div>
                    </td>
                    <td>
                      <div style="max-width: 300px;">
                        <p class="mb-0 text-truncate" title="<?= htmlspecialchars($review['review_text']) ?>">
                          <?= htmlspecialchars(substr($review['review_text'], 0, 100)) ?><?= strlen($review['review_text']) > 100 ? '...' : '' ?>
                        </p>
                      </div>
                    </td>
                    <td>
                      <?php if (!empty($review['reviewer_portfolio'])): ?>
                        <a href="<?= htmlspecialchars($review['reviewer_portfolio']) ?>" target="_blank" class="text-primary">
                          <i class="ti ti-external-link"></i> View
                        </a>
                      <?php else: ?>
                        <span class="text-muted">-</span>
                      <?php endif; ?>
                    </td>
                    <td>
                      <?php if ($review['is_approved']): ?>
                        <span class="badge bg-success">Approved</span>
                      <?php else: ?>
                        <span class="badge bg-warning">Pending</span>
                      <?php endif; ?>
                    </td>
                    <td>
                      <small><?= date('M d, Y', strtotime($review['created_at'])) ?></small>
                    </td>
                    <td>
                      <div class="btn-group" role="group">
                        <a href="<?= base_url('admin/view_review/' . $review['review_id']) ?>" 
                           class="btn btn-sm btn-outline-info" 
                           data-bs-toggle="tooltip" 
                           title="View Details">
                          <i class="ti ti-eye"></i>
                        </a>
                        <?php if (!$review['is_approved']): ?>
                          <button type="button" 
                                  class="btn btn-sm btn-outline-success" 
                                  onclick="approveReview(<?= $review['review_id'] ?>)"
                                  data-bs-toggle="tooltip" 
                                  title="Approve">
                            <i class="ti ti-check"></i>
                          </button>
                        <?php else: ?>
                          <button type="button" 
                                  class="btn btn-sm btn-outline-warning" 
                                  onclick="rejectReview(<?= $review['review_id'] ?>)"
                                  data-bs-toggle="tooltip" 
                                  title="Unapprove">
                            <i class="ti ti-x"></i>
                          </button>
                        <?php endif; ?>
                        <button type="button" 
                                class="btn btn-sm btn-outline-danger" 
                                onclick="deleteReview(<?= $review['review_id'] ?>)"
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
                  <td colspan="9" class="text-center py-5">
                    <i class="ti ti-message-off fs-6 text-muted"></i>
                    <p class="text-muted mt-2 mb-0">No reviews found</p>
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
// Select All Checkbox
document.getElementById('selectAll').addEventListener('change', function() {
  const checkboxes = document.querySelectorAll('.review-checkbox');
  checkboxes.forEach(checkbox => {
    checkbox.checked = this.checked;
  });
  toggleBulkButtons();
});

// Individual Checkbox
document.querySelectorAll('.review-checkbox').forEach(checkbox => {
  checkbox.addEventListener('change', toggleBulkButtons);
});

function toggleBulkButtons() {
  const checkedBoxes = document.querySelectorAll('.review-checkbox:checked');
  const bulkApproveBtn = document.getElementById('bulkApproveBtn');
  const bulkDeleteBtn = document.getElementById('bulkDeleteBtn');
  
  if (checkedBoxes.length > 0) {
    bulkApproveBtn.style.display = 'inline-block';
    bulkDeleteBtn.style.display = 'inline-block';
  } else {
    bulkApproveBtn.style.display = 'none';
    bulkDeleteBtn.style.display = 'none';
  }
}

// Apply Filters
function applyFilters() {
  const search = document.getElementById('searchInput').value;
  const status = document.getElementById('statusFilter').value;
  const rating = document.getElementById('ratingFilter').value;
  
  let url = '<?= base_url("admin/reviews") ?>?';
  const params = [];
  
  if (search) params.push('search=' + encodeURIComponent(search));
  if (status !== '') params.push('status=' + status);
  if (rating !== '') params.push('rating=' + rating);
  
  window.location.href = url + params.join('&');
}

// Approve Review
function approveReview(reviewId) {
  if (!confirm('Are you sure you want to approve this review?')) return;
  
  fetch('<?= base_url("admin/approve_review/") ?>' + reviewId, {
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

// Reject Review
function rejectReview(reviewId) {
  if (!confirm('Are you sure you want to unapprove this review?')) return;
  
  fetch('<?= base_url("admin/reject_review/") ?>' + reviewId, {
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

// Delete Review
function deleteReview(reviewId) {
  if (!confirm('Are you sure you want to delete this review? This action cannot be undone.')) return;
  
  fetch('<?= base_url("admin/delete_review/") ?>' + reviewId, {
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

// Bulk Approve
document.getElementById('bulkApproveBtn').addEventListener('click', function() {
  const checkedBoxes = document.querySelectorAll('.review-checkbox:checked');
  const reviewIds = Array.from(checkedBoxes).map(cb => cb.value);
  
  if (!confirm(`Approve ${reviewIds.length} selected review(s)?`)) return;
  
  fetch('<?= base_url("admin/bulk_approve_reviews") ?>', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded',
    },
    body: 'review_ids=' + JSON.stringify(reviewIds)
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
});

// Bulk Delete
document.getElementById('bulkDeleteBtn').addEventListener('click', function() {
  const checkedBoxes = document.querySelectorAll('.review-checkbox:checked');
  const reviewIds = Array.from(checkedBoxes).map(cb => cb.value);
  
  if (!confirm(`Delete ${reviewIds.length} selected review(s)? This action cannot be undone.`)) return;
  
  fetch('<?= base_url("admin/bulk_delete_reviews") ?>', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded',
    },
    body: 'review_ids=' + JSON.stringify(reviewIds)
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
});

// Initialize tooltips
var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl)
});
</script>
