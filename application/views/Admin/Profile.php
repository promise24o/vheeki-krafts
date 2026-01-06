<div class="body-wrapper">
    <div class="body-wrapper-inner">
        <div class="container-fluid">
            <!-- Page Header -->
            <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
                <div class="card-body px-4 py-3">
                    <div class="row align-items-center">
                        <div class="col-9">
                            <h4 class="fw-semibold mb-8">Admin Profile</h4>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a class="text-muted text-decoration-none" href="<?= base_url('admin/dashboard') ?>">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Profile</li>
                                </ol>
                            </nav>
                        </div>
                        <div class="col-3">
                            <div class="text-center mb-n5">
                                <img src="<?= base_url('assets/admin/images/breadcrumb/ChatBc.png') ?>" alt="" class="img-fluid mb-n4">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Flash Messages -->
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

            <div class="row">
                <!-- Profile Information Card -->
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <h5 class="mb-0 text-white">
                                <i class="ti ti-user me-2"></i>Profile Information
                            </h5>
                        </div>
                        <div class="card-body">
                            <form action="<?= base_url('admin/update_profile') ?>" method="POST">
                                <div class="mb-3">
                                    <label for="admin_name" class="form-label fw-semibold">Full Name</label>
                                    <input type="text" class="form-control" id="admin_name" name="admin_name" 
                                           value="<?= htmlspecialchars($admin['admin_name']) ?>" required>
                                </div>

                                <div class="mb-3">
                                    <label for="admin_email" class="form-label fw-semibold">Email Address</label>
                                    <input type="email" class="form-control" id="admin_email" name="admin_email" 
                                           value="<?= htmlspecialchars($admin['admin_email']) ?>" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Admin ID</label>
                                    <input type="text" class="form-control" value="<?= htmlspecialchars($admin['encrypted_id']) ?>" disabled>
                                    <small class="text-muted">This is your unique admin identifier</small>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Account Created</label>
                                    <input type="text" class="form-control" value="<?= date('F d, Y', strtotime($admin['created_at'])) ?>" disabled>
                                </div>

                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="ti ti-device-floppy me-2"></i>Update Profile
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Change Password Card -->
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header bg-warning">
                            <h5 class="mb-0 text-white">
                                <i class="ti ti-lock me-2"></i>Change Password
                            </h5>
                        </div>
                        <div class="card-body">
                            <form action="<?= base_url('admin/change_password') ?>" method="POST" id="changePasswordForm">
                                <div class="mb-3">
                                    <label for="current_password" class="form-label fw-semibold">Current Password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="current_password" 
                                               name="current_password" required>
                                        <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('current_password')">
                                            <i class="ti ti-eye"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="new_password" class="form-label fw-semibold">New Password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="new_password" 
                                               name="new_password" minlength="6" required>
                                        <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('new_password')">
                                            <i class="ti ti-eye"></i>
                                        </button>
                                    </div>
                                    <small class="text-muted">Minimum 6 characters</small>
                                </div>

                                <div class="mb-3">
                                    <label for="confirm_password" class="form-label fw-semibold">Confirm New Password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="confirm_password" 
                                               name="confirm_password" minlength="6" required>
                                        <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('confirm_password')">
                                            <i class="ti ti-eye"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="alert alert-info">
                                    <i class="ti ti-info-circle me-2"></i>
                                    <strong>Password Requirements:</strong>
                                    <ul class="mb-0 mt-2">
                                        <li>Minimum 6 characters long</li>
                                        <li>Use a strong, unique password</li>
                                        <li>Don't reuse old passwords</li>
                                    </ul>
                                </div>

                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-warning">
                                        <i class="ti ti-key me-2"></i>Change Password
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Account Security Info -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card border-start border-primary border-4">
                        <div class="card-body">
                            <h5 class="card-title mb-3">
                                <i class="ti ti-shield-check me-2 text-primary"></i>Account Security Tips
                            </h5>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="d-flex align-items-start mb-3">
                                        <i class="ti ti-lock-access fs-5 text-success me-2"></i>
                                        <div>
                                            <h6 class="mb-1">Use Strong Passwords</h6>
                                            <p class="text-muted mb-0 small">Combine letters, numbers, and symbols</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="d-flex align-items-start mb-3">
                                        <i class="ti ti-refresh fs-5 text-warning me-2"></i>
                                        <div>
                                            <h6 class="mb-1">Change Regularly</h6>
                                            <p class="text-muted mb-0 small">Update your password every 3-6 months</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="d-flex align-items-start mb-3">
                                        <i class="ti ti-user-shield fs-5 text-info me-2"></i>
                                        <div>
                                            <h6 class="mb-1">Keep It Private</h6>
                                            <p class="text-muted mb-0 small">Never share your admin credentials</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
function togglePassword(fieldId) {
    const field = document.getElementById(fieldId);
    const button = field.nextElementSibling;
    const icon = button.querySelector('i');
    
    if (field.type === 'password') {
        field.type = 'text';
        icon.classList.remove('ti-eye');
        icon.classList.add('ti-eye-off');
    } else {
        field.type = 'password';
        icon.classList.remove('ti-eye-off');
        icon.classList.add('ti-eye');
    }
}

// Password confirmation validation
document.getElementById('changePasswordForm').addEventListener('submit', function(e) {
    const newPassword = document.getElementById('new_password').value;
    const confirmPassword = document.getElementById('confirm_password').value;
    
    if (newPassword !== confirmPassword) {
        e.preventDefault();
        alert('New password and confirm password do not match!');
        return false;
    }
});
</script>
