<div class="container-fluid">
  <!-- Page Header -->
  <div class="card bg-light-info shadow-none position-relative overflow-hidden">
    <div class="card-body px-4 py-3">
      <div class="row align-items-center">
        <div class="col-9">
          <h4 class="fw-semibold mb-8">Order Details</h4>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a class="text-muted" href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
              <li class="breadcrumb-item"><a class="text-muted" href="<?= base_url('admin/orders') ?>">Orders</a></li>
              <li class="breadcrumb-item active" aria-current="page"><?= $order['order_number'] ?></li>
            </ol>
          </nav>
        </div>
        <div class="col-3">
          <div class="text-center mb-n5">
            <i class="ti ti-file-invoice" style="font-size: 100px; opacity: 0.1;"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <!-- Order Information -->
    <div class="col-lg-8">
      <!-- Order Status Card -->
      <div class="card">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
              <h5 class="card-title fw-semibold mb-1">Order #<?= $order['order_number'] ?></h5>
              <small class="text-muted">Placed on <?= date('F d, Y \a\t h:i A', strtotime($order['created_at'])) ?></small>
            </div>
            <div class="d-flex gap-2">
              <button class="btn btn-outline-primary btn-sm" onclick="window.print()">
                <i class="ti ti-printer me-1"></i> Print Invoice
              </button>
              <a href="<?= base_url('admin/orders') ?>" class="btn btn-outline-secondary btn-sm">
                <i class="ti ti-arrow-left me-1"></i> Back to Orders
              </a>
            </div>
          </div>

          <!-- Status Update -->
          <div class="row mb-4">
            <div class="col-md-6">
              <label class="form-label fw-semibold">Order Status</label>
              <select class="form-select" id="orderStatus">
                <option value="pending" <?= $order['order_status'] == 'pending' ? 'selected' : '' ?>>Pending</option>
                <option value="processing" <?= $order['order_status'] == 'processing' ? 'selected' : '' ?>>Processing</option>
                <option value="shipped" <?= $order['order_status'] == 'shipped' ? 'selected' : '' ?>>Shipped</option>
                <option value="delivered" <?= $order['order_status'] == 'delivered' ? 'selected' : '' ?>>Delivered</option>
                <option value="cancelled" <?= $order['order_status'] == 'cancelled' ? 'selected' : '' ?>>Cancelled</option>
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label fw-semibold">Payment Status</label>
              <select class="form-select" id="paymentStatus">
                <option value="pending" <?= $order['payment_status'] == 'pending' ? 'selected' : '' ?>>Pending</option>
                <option value="paid" <?= $order['payment_status'] == 'paid' ? 'selected' : '' ?>>Paid</option>
                <option value="failed" <?= $order['payment_status'] == 'failed' ? 'selected' : '' ?>>Failed</option>
                <option value="refunded" <?= $order['payment_status'] == 'refunded' ? 'selected' : '' ?>>Refunded</option>
              </select>
            </div>
          </div>
          <button class="btn btn-primary" id="updateStatusBtn">
            <i class="ti ti-check me-1"></i> Update Status
          </button>
        </div>
      </div>

      <!-- Order Items -->
      <div class="card">
        <div class="card-body">
          <h5 class="card-title fw-semibold mb-4">Order Items</h5>
          <div class="table-responsive">
            <table class="table table-borderless">
              <thead class="table-light">
                <tr>
                  <th>Product</th>
                  <th class="text-center">Quantity</th>
                  <th class="text-end">Price</th>
                  <th class="text-end">Subtotal</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($order_items as $item): ?>
                  <tr>
                    <td>
                      <div class="d-flex align-items-center">
                        <img src="<?= $item['image'] ?: base_url('assets/admin/images/placeholder.png') ?>" 
                             alt="<?= htmlspecialchars($item['product_name']) ?>" 
                             class="rounded me-3" 
                             width="60" 
                             height="60"
                             style="object-fit: cover;">
                        <div>
                          <h6 class="mb-0"><?= htmlspecialchars($item['product_name']) ?></h6>
                          <small class="text-muted">SKU: <?= $item['sku'] ?></small>
                        </div>
                      </div>
                    </td>
                    <td class="text-center align-middle">
                      <span class="badge bg-light-secondary text-dark"><?= $item['quantity'] ?></span>
                    </td>
                    <td class="text-end align-middle">₦<?= number_format($item['price'], 2) ?></td>
                    <td class="text-end align-middle fw-semibold">₦<?= number_format($item['subtotal'], 2) ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
              <tfoot class="border-top">
                <tr>
                  <td colspan="3" class="text-end fw-semibold">Subtotal:</td>
                  <td class="text-end">₦<?= number_format($order['total_amount'], 2) ?></td>
                </tr>
                <tr>
                  <td colspan="3" class="text-end fw-semibold">Shipping:</td>
                  <td class="text-end">₦0.00</td>
                </tr>
                <tr class="border-top">
                  <td colspan="3" class="text-end fw-bold fs-5">Total:</td>
                  <td class="text-end fw-bold fs-5 text-primary">₦<?= number_format($order['total_amount'], 2) ?></td>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
      </div>

      <!-- Order Notes -->
      <?php if (!empty($order['order_notes'])): ?>
      <div class="card">
        <div class="card-body">
          <h5 class="card-title fw-semibold mb-3">Order Notes</h5>
          <p class="text-muted mb-0"><?= nl2br(htmlspecialchars($order['order_notes'])) ?></p>
        </div>
      </div>
      <?php endif; ?>
    </div>

    <!-- Customer & Shipping Info -->
    <div class="col-lg-4">
      <!-- Customer Information -->
      <div class="card">
        <div class="card-body">
          <h5 class="card-title fw-semibold mb-4">Customer Information</h5>
          <div class="mb-3">
            <label class="text-muted small">Name</label>
            <p class="mb-0 fw-semibold"><?= htmlspecialchars($order['customer_name']) ?></p>
          </div>
          <div class="mb-3">
            <label class="text-muted small">Email</label>
            <p class="mb-0"><?= htmlspecialchars($order['customer_email']) ?></p>
          </div>
          <div class="mb-0">
            <label class="text-muted small">Phone</label>
            <p class="mb-0"><?= htmlspecialchars($order['customer_phone']) ?></p>
          </div>
        </div>
      </div>

      <!-- Shipping Address -->
      <div class="card">
        <div class="card-body">
          <h5 class="card-title fw-semibold mb-4">Shipping Address</h5>
          <address class="mb-0">
            <?= nl2br(htmlspecialchars($order['shipping_address'])) ?><br>
            <?= htmlspecialchars($order['city']) ?>, <?= htmlspecialchars($order['state']) ?><br>
            <?php if ($order['postal_code']): ?>
              <?= htmlspecialchars($order['postal_code']) ?><br>
            <?php endif; ?>
          </address>
        </div>
      </div>

      <!-- Payment Information -->
      <div class="card">
        <div class="card-body">
          <h5 class="card-title fw-semibold mb-4">Payment Information</h5>
          <div class="mb-3">
            <label class="text-muted small">Payment Method</label>
            <p class="mb-0 fw-semibold"><?= ucfirst($order['payment_method']) ?></p>
          </div>
          <div class="mb-3">
            <label class="text-muted small">Payment Status</label>
            <p class="mb-0">
              <?php
              $payment_badges = [
                'pending' => 'bg-warning',
                'paid' => 'bg-success',
                'failed' => 'bg-danger',
                'refunded' => 'bg-info'
              ];
              $badge_class = $payment_badges[$order['payment_status']] ?? 'bg-secondary';
              ?>
              <span class="badge <?= $badge_class ?>"><?= ucfirst($order['payment_status']) ?></span>
            </p>
          </div>
          <?php if ($order['payment_reference']): ?>
          <div class="mb-0">
            <label class="text-muted small">Payment Reference</label>
            <p class="mb-0"><code><?= htmlspecialchars($order['payment_reference']) ?></code></p>
          </div>
          <?php endif; ?>
        </div>
      </div>

      <!-- Tracking Number -->
      <div class="card">
        <div class="card-body">
          <h5 class="card-title fw-semibold mb-3">Tracking Information</h5>
          <?php if (!empty($order['tracking_number'])): ?>
            <div class="mb-3">
              <label class="text-muted small">Tracking Number</label>
              <p class="mb-0 fw-semibold">
                <code class="fs-5"><?= htmlspecialchars($order['tracking_number']) ?></code>
                <button class="btn btn-sm btn-outline-secondary ms-2" onclick="copyTracking()">
                  <i class="ti ti-copy"></i> Copy
                </button>
              </p>
            </div>
            <a href="<?= base_url('track-order?number=' . $order['tracking_number']) ?>" target="_blank" class="btn btn-sm btn-outline-primary">
              <i class="ti ti-external-link"></i> View Public Tracking
            </a>
          <?php else: ?>
            <p class="text-muted mb-3">No tracking number assigned yet</p>
            <button class="btn btn-primary" id="generateTrackingBtn">
              <i class="ti ti-plus"></i> Generate Tracking Number
            </button>
          <?php endif; ?>
        </div>
      </div>

      <!-- Order Timeline -->
      <div class="card">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="card-title fw-semibold mb-0">Tracking Logs</h5>
            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addLogModal">
              <i class="ti ti-plus"></i> Add Log
            </button>
          </div>
          <div class="timeline-widget" id="trackingLogs">
            <?php 
            $this->load->model('crud_model');
            $tracking_logs = $this->crud_model->get_tracking_logs($order['order_id']);
            if (!empty($tracking_logs)): 
            ?>
              <?php foreach ($tracking_logs as $index => $log): ?>
                <div class="timeline-item d-flex position-relative pb-3">
                  <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                    <span class="timeline-badge bg-<?= $index === 0 ? 'primary' : 'secondary' ?> rounded-circle"></span>
                    <?php if ($index < count($tracking_logs) - 1): ?>
                      <span class="timeline-badge-border d-block"></span>
                    <?php endif; ?>
                  </div>
                  <div class="timeline-desc fs-3 text-dark mt-n1 ms-3 flex-grow-1">
                    <div class="d-flex justify-content-between">
                      <p class="mb-0 fw-semibold"><?= htmlspecialchars($log['message']) ?></p>
                      <span class="badge bg-light-<?= $log['status'] == 'delivered' ? 'success' : 'info' ?> text-dark">
                        <?= ucfirst($log['status']) ?>
                      </span>
                    </div>
                    <small class="text-muted">
                      <?= date('M d, Y h:i A', strtotime($log['created_at'])) ?> 
                      by <?= htmlspecialchars($log['created_by']) ?>
                    </small>
                  </div>
                </div>
              <?php endforeach; ?>
            <?php else: ?>
              <div class="text-center text-muted py-4">
                <i class="ti ti-info-circle fs-1 mb-2"></i>
                <p class="mb-0">No tracking logs yet</p>
              </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Add Tracking Log Modal -->
<div class="modal fade" id="addLogModal" tabindex="-1" aria-labelledby="addLogModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addLogModalLabel">Add Tracking Log</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="addLogForm">
          <div class="mb-3">
            <label for="logStatus" class="form-label">Status</label>
            <select class="form-select" id="logStatus" required>
              <option value="pending">Pending</option>
              <option value="processing">Processing</option>
              <option value="shipped">Shipped</option>
              <option value="delivered">Delivered</option>
              <option value="cancelled">Cancelled</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="logMessage" class="form-label">Message</label>
            <textarea class="form-control" id="logMessage" rows="3" required placeholder="Enter tracking update message..."></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="saveLogBtn">Add Log</button>
      </div>
    </div>
  </div>
</div>

<script>
// Update order status
document.getElementById('updateStatusBtn').addEventListener('click', function() {
  const orderId = <?= $order['order_id'] ?>;
  const orderStatus = document.getElementById('orderStatus').value;
  const paymentStatus = document.getElementById('paymentStatus').value;

  if (confirm('Are you sure you want to update this order?')) {
    fetch('<?= base_url("admin/update_order") ?>', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
      },
      body: `order_id=${orderId}&order_status=${orderStatus}&payment_status=${paymentStatus}`
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        alert('Order updated successfully');
        location.reload();
      } else {
        alert('Failed to update order');
      }
    })
    .catch(error => {
      console.error('Error:', error);
      alert('An error occurred');
    });
  }
});

// Generate tracking number
<?php if (empty($order['tracking_number'])): ?>
document.getElementById('generateTrackingBtn').addEventListener('click', function() {
  if (confirm('Generate a tracking number for this order?')) {
    fetch('<?= base_url("admin/generate_tracking_number") ?>', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
      },
      body: 'order_id=<?= $order['order_id'] ?>'
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        alert('Tracking number generated: ' + data.tracking_number);
        location.reload();
      } else {
        alert('Failed to generate tracking number');
      }
    })
    .catch(error => {
      console.error('Error:', error);
      alert('An error occurred');
    });
  }
});
<?php endif; ?>

// Copy tracking number
function copyTracking() {
  const tracking = '<?= $order['tracking_number'] ?? '' ?>';
  navigator.clipboard.writeText(tracking).then(() => {
    alert('Tracking number copied to clipboard!');
  });
}

// Add tracking log
document.getElementById('saveLogBtn').addEventListener('click', function() {
  const status = document.getElementById('logStatus').value;
  const message = document.getElementById('logMessage').value;

  if (!message.trim()) {
    alert('Please enter a message');
    return;
  }

  fetch('<?= base_url("admin/add_tracking_log") ?>', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded',
    },
    body: `order_id=<?= $order['order_id'] ?>&status=${status}&message=${encodeURIComponent(message)}`
  })
  .then(response => response.json())
  .then(data => {
    if (data.success) {
      alert('Tracking log added successfully');
      location.reload();
    } else {
      alert('Failed to add tracking log');
    }
  })
  .catch(error => {
    console.error('Error:', error);
    alert('An error occurred');
  });
});
</script>

<style>
@media print {
  .btn, nav, .card-title, .sidebar, header, .breadcrumb {
    display: none !important;
  }
  .card {
    border: none !important;
    box-shadow: none !important;
  }
}

.timeline-badge {
  width: 12px;
  height: 12px;
}

.timeline-badge-border {
  width: 2px;
  height: 100%;
  background-color: #e9ecef;
}
</style>
