<div class="container-fluid">
  <!-- Page Header -->
  <div class="card bg-light-info shadow-none position-relative overflow-hidden">
    <div class="card-body px-4 py-3">
      <div class="row align-items-center">
        <div class="col-9">
          <h4 class="fw-semibold mb-8">Payment Settings</h4>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a class="text-muted" href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
              <li class="breadcrumb-item active" aria-current="page">Payment Settings</li>
            </ol>
          </nav>
        </div>
        <div class="col-3">
          <div class="text-center mb-n5">
            <i class="ti ti-credit-card" style="font-size: 100px; opacity: 0.1;"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <!-- Paystack Settings -->
    <div class="col-lg-8">
      <div class="card">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
              <h5 class="card-title fw-semibold mb-1">Paystack Configuration</h5>
              <p class="text-muted mb-0">Configure your Paystack payment gateway settings</p>
            </div>
            <img src="https://paystack.com/assets/img/logo/logo.svg" alt="Paystack" style="height: 30px;">
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

          <form method="post" action="<?= base_url('admin/save_payment_settings') ?>">
            <!-- Test Mode Toggle -->
            <div class="mb-4">
              <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="testMode" name="paystack_test_mode" value="1" 
                       <?= (isset($settings['paystack_test_mode']) && $settings['paystack_test_mode'] == '1') ? 'checked' : '' ?>>
                <label class="form-check-label fw-semibold" for="testMode">
                  Test Mode
                  <small class="text-muted d-block">Enable this to use test API keys for testing payments</small>
                </label>
              </div>
            </div>

            <hr class="my-4">

            <!-- Public Key -->
            <div class="mb-4">
              <label for="publicKey" class="form-label fw-semibold">
                Public Key
                <span class="text-danger">*</span>
              </label>
              <div class="input-group">
                <span class="input-group-text"><i class="ti ti-key"></i></span>
                <input type="text" 
                       class="form-control" 
                       id="publicKey" 
                       name="paystack_public_key" 
                       value="<?= isset($settings['paystack_public_key']) ? htmlspecialchars($settings['paystack_public_key']) : '' ?>"
                       placeholder="Enter your Paystack public key"
                       required>
              </div>
              <small class="text-muted">
                Your Paystack public key (starts with pk_[test/live]_ followed by your key)
              </small>
            </div>

            <!-- Secret Key -->
            <div class="mb-4">
              <label for="secretKey" class="form-label fw-semibold">
                Secret Key
                <span class="text-danger">*</span>
              </label>
              <div class="input-group">
                <span class="input-group-text"><i class="ti ti-lock"></i></span>
                <input type="password" 
                       class="form-control" 
                       id="secretKey" 
                       name="paystack_secret_key" 
                       value="<?= isset($settings['paystack_secret_key']) ? htmlspecialchars($settings['paystack_secret_key']) : '' ?>"
                       placeholder="Enter your Paystack secret key"
                       required>
                <button class="btn btn-outline-secondary" type="button" id="toggleSecret">
                  <i class="ti ti-eye"></i>
                </button>
              </div>
              <small class="text-muted">
                Your Paystack secret key (starts with sk_[test/live]_ followed by your key)
              </small>
            </div>

            <!-- Webhook URL -->
            <div class="mb-4">
              <label for="webhookUrl" class="form-label fw-semibold">Webhook URL</label>
              <div class="input-group">
                <input type="text" 
                       class="form-control" 
                       id="webhookUrl" 
                       value="<?= base_url('webhook/paystack') ?>"
                       readonly>
                <button class="btn btn-outline-secondary" type="button" onclick="copyWebhook()">
                  <i class="ti ti-copy"></i> Copy
                </button>
              </div>
              <small class="text-muted">
                Add this URL to your Paystack dashboard under Settings → Webhooks
              </small>
            </div>

            <!-- Currency -->
            <div class="mb-4">
              <label for="currency" class="form-label fw-semibold">Currency</label>
              <select class="form-select" id="currency" name="paystack_currency">
                <option value="NGN" <?= (isset($settings['paystack_currency']) && $settings['paystack_currency'] == 'NGN') ? 'selected' : '' ?>>Nigerian Naira (NGN)</option>
                <option value="USD" <?= (isset($settings['paystack_currency']) && $settings['paystack_currency'] == 'USD') ? 'selected' : '' ?>>US Dollar (USD)</option>
                <option value="GHS" <?= (isset($settings['paystack_currency']) && $settings['paystack_currency'] == 'GHS') ? 'selected' : '' ?>>Ghanaian Cedi (GHS)</option>
                <option value="ZAR" <?= (isset($settings['paystack_currency']) && $settings['paystack_currency'] == 'ZAR') ? 'selected' : '' ?>>South African Rand (ZAR)</option>
              </select>
            </div>

            <!-- Payment Channels -->
            <div class="mb-4">
              <label class="form-label fw-semibold">Payment Channels</label>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="channelCard" name="paystack_channels[]" value="card" checked>
                <label class="form-check-label" for="channelCard">Card Payment</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="channelBank" name="paystack_channels[]" value="bank" checked>
                <label class="form-check-label" for="channelBank">Bank Transfer</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="channelUssd" name="paystack_channels[]" value="ussd" checked>
                <label class="form-check-label" for="channelUssd">USSD</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="channelQr" name="paystack_channels[]" value="qr">
                <label class="form-check-label" for="channelQr">QR Code</label>
              </div>
            </div>

            <hr class="my-4">

            <!-- Submit Button -->
            <div class="d-flex gap-2">
              <button type="submit" class="btn btn-primary">
                <i class="ti ti-device-floppy me-2"></i>Save Settings
              </button>
              <button type="button" class="btn btn-outline-primary" id="testConnection">
                <i class="ti ti-plug me-2"></i>Test Connection
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Help & Documentation -->
    <div class="col-lg-4">
      <!-- Status Card -->
      <div class="card">
        <div class="card-body">
          <h5 class="card-title fw-semibold mb-3">Payment Status</h5>
          <div class="d-flex align-items-center mb-3">
            <div class="me-3">
              <span class="badge bg-<?= !empty($settings['paystack_public_key']) ? 'success' : 'warning' ?> rounded-circle p-2">
                <i class="ti ti-<?= !empty($settings['paystack_public_key']) ? 'check' : 'alert-triangle' ?> fs-4"></i>
              </span>
            </div>
            <div>
              <h6 class="mb-0">
                <?= !empty($settings['paystack_public_key']) ? 'Configured' : 'Not Configured' ?>
              </h6>
              <small class="text-muted">
                <?= !empty($settings['paystack_public_key']) ? 'Paystack is ready' : 'Add your API keys' ?>
              </small>
            </div>
          </div>
          <div class="d-flex align-items-center">
            <div class="me-3">
              <span class="badge bg-<?= (isset($settings['paystack_test_mode']) && $settings['paystack_test_mode'] == '1') ? 'warning' : 'success' ?> rounded-circle p-2">
                <i class="ti ti-<?= (isset($settings['paystack_test_mode']) && $settings['paystack_test_mode'] == '1') ? 'flask' : 'rocket' ?> fs-4"></i>
              </span>
            </div>
            <div>
              <h6 class="mb-0">
                <?= (isset($settings['paystack_test_mode']) && $settings['paystack_test_mode'] == '1') ? 'Test Mode' : 'Live Mode' ?>
              </h6>
              <small class="text-muted">
                <?= (isset($settings['paystack_test_mode']) && $settings['paystack_test_mode'] == '1') ? 'Using test keys' : 'Using live keys' ?>
              </small>
            </div>
          </div>
        </div>
      </div>

      <!-- Quick Guide -->
      <div class="card">
        <div class="card-body">
          <h5 class="card-title fw-semibold mb-3">
            <i class="ti ti-help me-2"></i>Quick Guide
          </h5>
          <ol class="ps-3 mb-0">
            <li class="mb-2">
              <strong>Get API Keys:</strong>
              <small class="d-block text-muted">
                Login to <a href="https://dashboard.paystack.com/" target="_blank">Paystack Dashboard</a>
              </small>
            </li>
            <li class="mb-2">
              <strong>Navigate to Settings:</strong>
              <small class="d-block text-muted">
                Go to Settings → API Keys & Webhooks
              </small>
            </li>
            <li class="mb-2">
              <strong>Copy Keys:</strong>
              <small class="d-block text-muted">
                Copy your Public and Secret keys
              </small>
            </li>
            <li class="mb-2">
              <strong>Paste Here:</strong>
              <small class="d-block text-muted">
                Paste the keys in the form above
              </small>
            </li>
            <li class="mb-0">
              <strong>Test:</strong>
              <small class="d-block text-muted">
                Use test mode first, then switch to live
              </small>
            </li>
          </ol>
        </div>
      </div>

      <!-- Test Cards -->
      <div class="card">
        <div class="card-body">
          <h5 class="card-title fw-semibold mb-3">
            <i class="ti ti-credit-card me-2"></i>Test Cards
          </h5>
          <p class="text-muted small mb-3">Use these cards in test mode:</p>
          
          <div class="mb-3">
            <strong>Successful Payment:</strong>
            <div class="font-monospace small">
              <div>Card: 4084 0840 8408 4081</div>
              <div>CVV: 408</div>
              <div>Expiry: 12/30</div>
              <div>PIN: 0000</div>
            </div>
          </div>

          <div class="mb-0">
            <strong>Failed Payment:</strong>
            <div class="font-monospace small">
              <div>Card: 5060 6666 6666 6666</div>
              <div>CVV: 123</div>
              <div>Expiry: 12/30</div>
            </div>
          </div>
        </div>
      </div>

      <!-- Resources -->
      <div class="card">
        <div class="card-body">
          <h5 class="card-title fw-semibold mb-3">
            <i class="ti ti-book me-2"></i>Resources
          </h5>
          <ul class="list-unstyled mb-0">
            <li class="mb-2">
              <a href="https://paystack.com/docs" target="_blank" class="text-decoration-none">
                <i class="ti ti-external-link me-1"></i>Paystack Documentation
              </a>
            </li>
            <li class="mb-2">
              <a href="https://dashboard.paystack.com/" target="_blank" class="text-decoration-none">
                <i class="ti ti-external-link me-1"></i>Paystack Dashboard
              </a>
            </li>
            <li class="mb-0">
              <a href="https://paystack.com/docs/payments/test-payments/" target="_blank" class="text-decoration-none">
                <i class="ti ti-external-link me-1"></i>Test Payment Guide
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
// Toggle secret key visibility
document.getElementById('toggleSecret').addEventListener('click', function() {
  const secretInput = document.getElementById('secretKey');
  const icon = this.querySelector('i');
  
  if (secretInput.type === 'password') {
    secretInput.type = 'text';
    icon.classList.remove('ti-eye');
    icon.classList.add('ti-eye-off');
  } else {
    secretInput.type = 'password';
    icon.classList.remove('ti-eye-off');
    icon.classList.add('ti-eye');
  }
});

// Copy webhook URL
function copyWebhook() {
  const webhookInput = document.getElementById('webhookUrl');
  webhookInput.select();
  document.execCommand('copy');
  
  alert('Webhook URL copied to clipboard!');
}

// Test connection
document.getElementById('testConnection').addEventListener('click', function() {
  const publicKey = document.getElementById('publicKey').value;
  const secretKey = document.getElementById('secretKey').value;
  
  if (!publicKey || !secretKey) {
    alert('Please enter both Public and Secret keys first');
    return;
  }
  
  this.disabled = true;
  this.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Testing...';
  
  fetch('<?= base_url("admin/test_paystack_connection") ?>', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded',
    },
    body: `public_key=${encodeURIComponent(publicKey)}&secret_key=${encodeURIComponent(secretKey)}`
  })
  .then(response => response.json())
  .then(data => {
    if (data.success) {
      alert('✓ Connection successful!\n\n' + data.message);
    } else {
      alert('✗ Connection failed!\n\n' + data.message);
    }
  })
  .catch(error => {
    alert('Error testing connection: ' + error);
  })
  .finally(() => {
    this.disabled = false;
    this.innerHTML = '<i class="ti ti-plug me-2"></i>Test Connection';
  });
});
</script>
