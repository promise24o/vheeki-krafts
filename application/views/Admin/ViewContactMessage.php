<div class="body-wrapper">
<div class="body-wrapper-inner">
  <div class="container-fluid">
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
      <div class="card-body px-4 py-3">
        <div class="row align-items-center">
          <div class="col-9">
            <h4 class="fw-semibold mb-8">View Message</h4>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a class="text-muted text-decoration-none" href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
                <li class="breadcrumb-item"><a class="text-muted text-decoration-none" href="<?= base_url('admin/contact_messages') ?>">Contact Messages</a></li>
                <li class="breadcrumb-item active" aria-current="page">View Message</li>
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

    <?php if (empty($message)): ?>
      <div class="alert alert-warning">
        <i class="ti ti-alert-circle me-2"></i>Message not found.
      </div>
      <a href="<?= base_url('admin/contact_messages') ?>" class="btn btn-secondary">
        <i class="ti ti-arrow-left me-2"></i>Back to Messages
      </a>
    <?php else: ?>
      <div class="card">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-start mb-4">
            <div>
              <h5 class="card-title mb-2"><?= htmlspecialchars($message['subject']) ?></h5>
              <p class="text-muted mb-0">
                <small>
                  <i class="ti ti-clock me-1"></i>
                  Received: <?= date('F d, Y \a\t h:i A', strtotime($message['created_at'])) ?>
                </small>
              </p>
              <?php if ($message['is_read'] && $message['read_at']): ?>
                <p class="text-muted mb-0">
                  <small>
                    <i class="ti ti-eye me-1"></i>
                    Read: <?= date('F d, Y \a\t h:i A', strtotime($message['read_at'])) ?>
                  </small>
                </p>
              <?php endif; ?>
            </div>
            <div>
              <?php if ($message['is_read'] == 0): ?>
                <span class="badge bg-primary">New</span>
              <?php else: ?>
                <span class="badge bg-secondary">Read</span>
              <?php endif; ?>
            </div>
          </div>

          <hr>

          <div class="row mb-4">
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label text-muted fw-semibold">From:</label>
                <p class="mb-0"><?= htmlspecialchars($message['name']) ?></p>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label text-muted fw-semibold">Email:</label>
                <p class="mb-0">
                  <a href="mailto:<?= htmlspecialchars($message['email']) ?>" class="text-decoration-none">
                    <?= htmlspecialchars($message['email']) ?>
                  </a>
                </p>
              </div>
            </div>
          </div>

          <div class="mb-4">
            <label class="form-label text-muted fw-semibold">Message:</label>
            <div class="p-3 bg-light rounded">
              <p class="mb-0" style="white-space: pre-wrap;"><?= htmlspecialchars($message['message']) ?></p>
            </div>
          </div>

          <hr>

          <div class="d-flex gap-2">
            <a href="mailto:<?= htmlspecialchars($message['email']) ?>?subject=Re: <?= urlencode($message['subject']) ?>" 
               class="btn btn-primary">
              <i class="ti ti-mail me-2"></i>Reply via Email
            </a>
            <a href="<?= base_url('admin/contact_messages') ?>" class="btn btn-secondary">
              <i class="ti ti-arrow-left me-2"></i>Back to Messages
            </a>
            <a href="<?= base_url('admin/delete_contact_message/' . $message['id']) ?>" 
               class="btn btn-danger ms-auto" 
               onclick="return confirm('Are you sure you want to delete this message?')">
              <i class="ti ti-trash me-2"></i>Delete
            </a>
          </div>
        </div>
      </div>
    <?php endif; ?>
  </div>
</div>
</div>
