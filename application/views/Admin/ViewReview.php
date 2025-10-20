<div class="body-wrapper-inner">
  <div class="container-fluid">
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
      <div class="card-body px-4 py-3">
        <div class="row align-items-center">
          <div class="col-9">
            <h4 class="fw-semibold mb-8">Review Details</h4>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a class="text-muted text-decoration-none" href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
                <li class="breadcrumb-item"><a class="text-muted text-decoration-none" href="<?= base_url('admin/reviews') ?>">Reviews</a></li>
                <li class="breadcrumb-item active" aria-current="page">Review #<?= $review['review_id'] ?></li>
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

    <div class="row">
      <div class="col-lg-8">
        <!-- Review Content -->
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-start mb-4">
              <div>
                <h5 class="card-title fw-semibold mb-2">Review Content</h5>
                <div class="d-flex align-items-center mb-2">
                  <?php for ($i = 1; $i <= 5; $i++): ?>
                    <?php if ($i <= $review['rating']): ?>
                      <i class="ti ti-star-filled text-warning fs-5"></i>
                    <?php else: ?>
                      <i class="ti ti-star text-muted fs-5"></i>
                    <?php endif; ?>
                  <?php endfor; ?>
                  <span class="ms-2 fw-semibold fs-4"><?= $review['rating'] ?> / 5</span>
                </div>
              </div>
              <div>
                <?php if ($review['is_approved']): ?>
                  <span class="badge bg-success fs-3 px-3 py-2">
                    <i class="ti ti-check me-1"></i>Approved
                  </span>
                <?php else: ?>
                  <span class="badge bg-warning fs-3 px-3 py-2">
                    <i class="ti ti-clock me-1"></i>Pending
                  </span>
                <?php endif; ?>
              </div>
            </div>

            <div class="bg-light p-4 rounded mb-4">
              <p class="mb-0 fs-4" style="line-height: 1.8; white-space: pre-wrap;"><?= htmlspecialchars($review['review_text']) ?></p>
            </div>

            <div class="border-top pt-4">
              <h6 class="fw-semibold mb-3">Review Information</h6>
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label class="form-label text-muted">Review ID</label>
                  <p class="mb-0 fw-semibold">#<?= $review['review_id'] ?></p>
                </div>
                <div class="col-md-6 mb-3">
                  <label class="form-label text-muted">Submitted On</label>
                  <p class="mb-0 fw-semibold"><?= date('F d, Y \a\t h:i A', strtotime($review['created_at'])) ?></p>
                </div>
                <div class="col-md-6 mb-3">
                  <label class="form-label text-muted">Last Updated</label>
                  <p class="mb-0 fw-semibold"><?= date('F d, Y \a\t h:i A', strtotime($review['updated_at'])) ?></p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-4">
        <!-- Reviewer Information -->
        <div class="card mb-4">
          <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Reviewer Information</h5>
            
            <div class="mb-4">
              <label class="form-label text-muted">Full Name</label>
              <p class="mb-0 fw-semibold fs-4"><?= htmlspecialchars($review['customer_name']) ?></p>
            </div>

            <div class="mb-4">
              <label class="form-label text-muted">Email Address</label>
              <p class="mb-0">
                <a href="mailto:<?= htmlspecialchars($review['customer_email']) ?>" class="text-decoration-none">
                  <i class="ti ti-mail me-1"></i><?= htmlspecialchars($review['customer_email']) ?>
                </a>
              </p>
            </div>

            <div class="mb-4">
              <label class="form-label text-muted">Portfolio / Website</label>
              <?php if (!empty($review['reviewer_portfolio'])): ?>
                <p class="mb-0">
                  <a href="<?= htmlspecialchars($review['reviewer_portfolio']) ?>" target="_blank" class="text-decoration-none">
                    <i class="ti ti-external-link me-1"></i><?= htmlspecialchars($review['reviewer_portfolio']) ?>
                  </a>
                </p>
              <?php else: ?>
                <p class="mb-0 text-muted">Not provided</p>
              <?php endif; ?>
            </div>
          </div>
        </div>

        <!-- Product Information -->
        <div class="card mb-4">
          <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Product Information</h5>
            
            <div class="mb-3">
              <label class="form-label text-muted">Product Name</label>
              <p class="mb-0 fw-semibold"><?= htmlspecialchars($review['product_name']) ?></p>
            </div>

            <div class="mb-3">
              <label class="form-label text-muted">Product ID</label>
              <p class="mb-0"><?= $review['product_id'] ?></p>
            </div>

            <a href="<?= base_url('product/' . $review['product_slug']) ?>" target="_blank" class="btn btn-outline-primary w-100">
              <i class="ti ti-external-link me-2"></i>View Product Page
            </a>
          </div>
        </div>

        <!-- Actions -->
        <div class="card">
          <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Actions</h5>
            
            <div class="d-grid gap-2">
              <?php if (!$review['is_approved']): ?>
                <button type="button" class="btn btn-success" onclick="approveReview(<?= $review['review_id'] ?>)">
                  <i class="ti ti-check me-2"></i>Approve Review
                </button>
              <?php else: ?>
                <button type="button" class="btn btn-warning" onclick="rejectReview(<?= $review['review_id'] ?>)">
                  <i class="ti ti-x me-2"></i>Unapprove Review
                </button>
              <?php endif; ?>
              
              <button type="button" class="btn btn-danger" onclick="deleteReview(<?= $review['review_id'] ?>)">
                <i class="ti ti-trash me-2"></i>Delete Review
              </button>
              
              <a href="<?= base_url('admin/reviews') ?>" class="btn btn-outline-secondary">
                <i class="ti ti-arrow-left me-2"></i>Back to Reviews
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
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

function deleteReview(reviewId) {
  if (!confirm('Are you sure you want to delete this review? This action cannot be undone.')) return;
  
  fetch('<?= base_url("admin/delete_review/") ?>' + reviewId, {
    method: 'POST'
  })
  .then(response => response.json())
  .then(data => {
    if (data.success) {
      alert(data.message);
      window.location.href = '<?= base_url("admin/reviews") ?>';
    } else {
      alert('Error: ' + data.message);
    }
  })
  .catch(error => alert('Error: ' + error));
}
</script>
