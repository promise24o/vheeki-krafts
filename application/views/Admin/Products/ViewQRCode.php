<div class="body-wrapper-inner">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-8 mx-auto">
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                  <h5 class="card-title fw-semibold mb-1">Product QR Code</h5>
                  <p class="mb-0 text-muted"><?= htmlspecialchars($product['product_name']) ?></p>
                </div>
                <a href="<?= base_url('admin/products') ?>" class="btn btn-secondary">
                  <i class="ti ti-arrow-left me-2"></i>Back to Products
                </a>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="card bg-light">
                    <div class="card-body text-center">
                      <h6 class="card-subtitle mb-3">QR Code</h6>
                      <?php if (!empty($product['qr_code']) && file_exists('./uploads/qrcodes/' . $product['qr_code'])): ?>
                        <img src="<?= base_url('uploads/qrcodes/' . $product['qr_code']) ?>" 
                             alt="QR Code" 
                             class="img-fluid mb-3" 
                             style="max-width: 300px;">
                        
                        <div class="d-grid gap-2">
                          <a href="<?= base_url('admin/download_qr_code/' . $product['product_id']) ?>" 
                             class="btn btn-primary">
                            <i class="ti ti-download me-2"></i>Download QR Code
                          </a>
                          <button type="button" 
                                  class="btn btn-outline-secondary" 
                                  onclick="regenerateQRCode(<?= $product['product_id'] ?>)">
                            <i class="ti ti-refresh me-2"></i>Regenerate QR Code
                          </button>
                        </div>
                      <?php else: ?>
                        <div class="alert alert-warning">
                          <i class="ti ti-alert-circle me-2"></i>
                          QR Code not found. Click below to generate.
                        </div>
                        <button type="button" 
                                class="btn btn-primary" 
                                onclick="regenerateQRCode(<?= $product['product_id'] ?>)">
                          <i class="ti ti-qrcode me-2"></i>Generate QR Code
                        </button>
                      <?php endif; ?>
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="card">
                    <div class="card-body">
                      <h6 class="card-subtitle mb-3">Product Information</h6>
                      
                      <div class="mb-3">
                        <label class="form-label fw-bold">Product Name:</label>
                        <p class="mb-0"><?= htmlspecialchars($product['product_name']) ?></p>
                      </div>

                      <div class="mb-3">
                        <label class="form-label fw-bold">SKU:</label>
                        <p class="mb-0"><code><?= $product['sku'] ?></code></p>
                      </div>

                      <?php if (!empty($product['encrypted_id'])): ?>
                        <div class="mb-3">
                          <label class="form-label fw-bold">Product ID:</label>
                          <div class="input-group">
                            <input type="text" 
                                   class="form-control" 
                                   id="encrypted_id" 
                                   value="<?= $product['encrypted_id'] ?>" 
                                   readonly>
                            <button class="btn btn-outline-secondary" 
                                    type="button" 
                                    onclick="copyToClipboard('encrypted_id')">
                              <i class="ti ti-copy"></i>
                            </button>
                          </div>
                          <small class="text-muted">This unique ID is encoded in the QR code</small>
                        </div>
                      <?php endif; ?>

                      <div class="mb-3">
                        <label class="form-label fw-bold">Product URL:</label>
                        <div class="input-group">
                          <input type="text" 
                                 class="form-control" 
                                 id="product_url" 
                                 value="<?= base_url('product/' . (!empty($product['encrypted_id']) ? $product['encrypted_id'] : $product['product_slug'])) ?>" 
                                 readonly>
                          <button class="btn btn-outline-secondary" 
                                  type="button" 
                                  onclick="copyToClipboard('product_url')">
                            <i class="ti ti-copy"></i>
                          </button>
                        </div>
                        <small class="text-muted">Scan the QR code to visit this URL</small>
                      </div>

                      <div class="mb-3">
                        <label class="form-label fw-bold">Price:</label>
                        <p class="mb-0">
                          <?php if (!empty($product['discount_price'])): ?>
                            <span class="text-decoration-line-through text-muted">₦<?= number_format($product['price'], 2) ?></span>
                            <span class="text-success fw-bold ms-2">₦<?= number_format($product['discount_price'], 2) ?></span>
                          <?php else: ?>
                            <span class="fw-bold">₦<?= number_format($product['price'], 2) ?></span>
                          <?php endif; ?>
                        </p>
                      </div>

                      <div class="mb-3">
                        <label class="form-label fw-bold">Category:</label>
                        <p class="mb-0"><?= $product['category_name'] ?></p>
                      </div>
                    </div>
                  </div>

                  <div class="card mt-3">
                    <div class="card-body">
                      <h6 class="card-subtitle mb-3">Usage Instructions</h6>
                      <ul class="mb-0">
                        <li>Download the QR code image</li>
                        <li>Print it on product packaging or labels</li>
                        <li>Customers can scan to view product details</li>
                        <li>QR code links directly to product page</li>
                      </ul>
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
function copyToClipboard(elementId) {
  const element = document.getElementById(elementId);
  element.select();
  element.setSelectionRange(0, 99999); // For mobile devices
  
  navigator.clipboard.writeText(element.value).then(function() {
    // Show success message
    const btn = element.nextElementSibling;
    const originalHTML = btn.innerHTML;
    btn.innerHTML = '<i class="ti ti-check"></i>';
    btn.classList.add('btn-success');
    btn.classList.remove('btn-outline-secondary');
    
    setTimeout(function() {
      btn.innerHTML = originalHTML;
      btn.classList.remove('btn-success');
      btn.classList.add('btn-outline-secondary');
    }, 2000);
  });
}

function regenerateQRCode(productId) {
  if (!confirm('Are you sure you want to regenerate the QR code? The old QR code will be replaced.')) {
    return;
  }
  
  const btn = event.target;
  const originalHTML = btn.innerHTML;
  btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Generating...';
  btn.disabled = true;
  
  fetch('<?= base_url("admin/regenerate_qr_code/") ?>' + productId, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    }
  })
  .then(response => response.json())
  .then(data => {
    if (data.success) {
      alert('QR code regenerated successfully!');
      location.reload();
    } else {
      alert('Failed to regenerate QR code: ' + data.message);
      btn.innerHTML = originalHTML;
      btn.disabled = false;
    }
  })
  .catch(error => {
    alert('Error: ' + error);
    btn.innerHTML = originalHTML;
    btn.disabled = false;
  });
}
</script>
