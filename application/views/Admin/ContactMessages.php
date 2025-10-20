<div class="body-wrapper">
<div class="body-wrapper-inner">
  <div class="container-fluid">
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
      <div class="card-body px-4 py-3">
        <div class="row align-items-center">
          <div class="col-9">
            <h4 class="fw-semibold mb-8">Contact Messages</h4>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a class="text-muted text-decoration-none" href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Contact Messages</li>
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
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php endif; ?>

    <?php if ($this->session->flashdata('error')): ?>
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="ti ti-alert-circle me-2"></i><?= $this->session->flashdata('error') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php endif; ?>

    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-4">
          <h5 class="card-title mb-0">
            All Messages 
            <?php if ($unread_count > 0): ?>
              <span class="badge bg-danger rounded-pill"><?= $unread_count ?> Unread</span>
            <?php endif; ?>
          </h5>
        </div>

        <?php if (empty($messages)): ?>
          <div class="text-center py-5">
            <i class="ti ti-inbox fs-1 text-muted"></i>
            <p class="text-muted mt-3">No messages yet</p>
          </div>
        <?php else: ?>
          <div class="table-responsive">
            <table class="table table-hover align-middle">
              <thead class="table-light">
                <tr>
                  <th style="width: 50px;"></th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Subject</th>
                  <th>Date</th>
                  <th style="width: 150px;">Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($messages as $message): ?>
                  <tr class="<?= $message['is_read'] == 0 ? 'table-active fw-semibold' : '' ?>">
                    <td class="text-center">
                      <?php if ($message['is_read'] == 0): ?>
                        <i class="ti ti-mail text-primary fs-5" title="Unread"></i>
                      <?php else: ?>
                        <i class="ti ti-mail-opened text-muted fs-5" title="Read"></i>
                      <?php endif; ?>
                    </td>
                    <td><?= htmlspecialchars($message['name']) ?></td>
                    <td><?= htmlspecialchars($message['email']) ?></td>
                    <td>
                      <?= htmlspecialchars(substr($message['subject'], 0, 50)) ?>
                      <?= strlen($message['subject']) > 50 ? '...' : '' ?>
                    </td>
                    <td>
                      <small><?= date('M d, Y h:i A', strtotime($message['created_at'])) ?></small>
                    </td>
                    <td>
                      <a href="<?= base_url('admin/view_contact_message/' . $message['id']) ?>" 
                         class="btn btn-sm btn-primary" title="View Message">
                        <i class="ti ti-eye"></i>
                      </a>
                      <a href="<?= base_url('admin/delete_contact_message/' . $message['id']) ?>" 
                         class="btn btn-sm btn-danger" 
                         onclick="return confirm('Are you sure you want to delete this message?')"
                         title="Delete">
                        <i class="ti ti-trash"></i>
                      </a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>
</div>
