<div class="body-wrapper">
<div class="body-wrapper-inner">
  <div class="container-fluid">
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
      <div class="card-body px-4 py-3">
        <div class="row align-items-center">
          <div class="col-9">
            <h4 class="fw-semibold mb-8">Add Review</h4>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a class="text-muted text-decoration-none" href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
                <li class="breadcrumb-item"><a class="text-muted text-decoration-none" href="<?= base_url('admin/reviews') ?>">Reviews</a></li>
                <li class="breadcrumb-item active" aria-current="page">Add Review</li>
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

    <!-- Add Review Form -->
    <div class="card">
      <div class="card-body">
        <?php if (isset($error)): ?>
          <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>

        <form method="post" action="<?= base_url('admin/add_review') ?>">
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label for="author_name" class="form-label">Author Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="author_name" name="author_name" required 
                       value="<?= set_value('author_name') ?>">
                <div class="form-text">Enter the name of the review author</div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="author_image" class="form-label">Author Image URL</label>
                <input type="text" class="form-control" id="author_image" name="author_image" 
                       value="<?= set_value('author_image') ?>">
                <div class="form-text">Optional: URL to author's profile image</div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label for="sort_order" class="form-label">Sort Order</label>
                <input type="number" class="form-control" id="sort_order" name="sort_order" 
                       value="<?= set_value('sort_order', 0) ?>" min="0">
                <div class="form-text">Order in which this review appears (0 for auto-assign)</div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="is_active" class="form-label">Status</label>
                <div class="form-check form-switch">
                  <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" checked>
                  <label class="form-check-label" for="is_active">
                    Active (visible on website)
                  </label>
                </div>
              </div>
            </div>
          </div>

          <div class="mb-3">
            <label for="testimonial_text" class="form-label">Testimonial Text <span class="text-danger">*</span></label>
            <textarea class="form-control" id="testimonial_text" name="testimonial_text" rows="6" required
                      placeholder="Enter the customer's review or testimonial..."><?= set_value('testimonial_text') ?></textarea>
            <div class="form-text">The actual review content that will be displayed on the website</div>
          </div>

          <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">
              <i class="ti ti-plus me-1"></i>Add Review
            </button>
            <a href="<?= base_url('admin/reviews') ?>" class="btn btn-secondary">
              <i class="ti ti-arrow-left me-1"></i>Back to Reviews
            </a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
</div>
