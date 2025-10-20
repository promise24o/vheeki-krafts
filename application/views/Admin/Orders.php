<div class="container-fluid">
  <!-- Page Header -->
  <div class="card bg-light-info shadow-none position-relative overflow-hidden">
    <div class="card-body px-4 py-3">
      <div class="row align-items-center">
        <div class="col-9">
          <h4 class="fw-semibold mb-8">Orders Management</h4>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a class="text-muted" href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
              <li class="breadcrumb-item active" aria-current="page">Orders</li>
            </ol>
          </nav>
        </div>
        <div class="col-3">
          <div class="text-center mb-n5">
            <i class="ti ti-shopping-cart" style="font-size: 100px; opacity: 0.1;"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Statistics Cards -->
  <div class="row mb-4">
    <div class="col-lg-3 col-md-6">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <div class="me-3">
              <span class="round-40 rounded-circle bg-light-primary d-flex align-items-center justify-content-center">
                <i class="ti ti-shopping-cart text-primary fs-6"></i>
              </span>
            </div>
            <div>
              <h6 class="mb-0 fw-semibold">Total Orders</h6>
              <h4 class="mb-0"><?= $total_orders ?></h4>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <div class="me-3">
              <span class="round-40 rounded-circle bg-light-warning d-flex align-items-center justify-content-center">
                <i class="ti ti-clock text-warning fs-6"></i>
              </span>
            </div>
            <div>
              <h6 class="mb-0 fw-semibold">Pending</h6>
              <h4 class="mb-0"><?= $pending_orders ?></h4>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <div class="me-3">
              <span class="round-40 rounded-circle bg-light-success d-flex align-items-center justify-content-center">
                <i class="ti ti-check text-success fs-6"></i>
              </span>
            </div>
            <div>
              <h6 class="mb-0 fw-semibold">Completed</h6>
              <h4 class="mb-0"><?= $completed_orders ?></h4>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <div class="me-3">
              <span class="round-40 rounded-circle bg-light-info d-flex align-items-center justify-content-center">
                <i class="ti ti-currency-naira text-info fs-6"></i>
              </span>
            </div>
            <div>
              <h6 class="mb-0 fw-semibold">Total Revenue</h6>
              <h4 class="mb-0">₦<?= number_format($total_revenue, 2) ?></h4>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Orders Table -->
  <div class="card">
    <div class="card-body">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="card-title fw-semibold mb-0">All Orders</h5>
        <div class="d-flex gap-2">
          <input type="text" id="searchInput" class="form-control form-control-sm" placeholder="Search orders..." style="width: 250px;">
          <select id="statusFilter" class="form-select form-select-sm" style="width: 150px;">
            <option value="">All Status</option>
            <option value="pending">Pending</option>
            <option value="processing">Processing</option>
            <option value="shipped">Shipped</option>
            <option value="delivered">Delivered</option>
            <option value="cancelled">Cancelled</option>
          </select>
          <select id="paymentFilter" class="form-select form-select-sm" style="width: 150px;">
            <option value="">All Payments</option>
            <option value="pending">Pending</option>
            <option value="paid">Paid</option>
            <option value="failed">Failed</option>
            <option value="refunded">Refunded</option>
          </select>
        </div>
      </div>

      <div class="table-responsive">
        <table class="table table-hover align-middle text-nowrap" id="ordersTable">
          <thead class="table-light">
            <tr>
              <th>Order #</th>
              <th>Customer</th>
              <th>Date</th>
              <th>Items</th>
              <th>Total</th>
              <th>Payment</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($orders)): ?>
              <?php foreach ($orders as $order): ?>
                <tr data-order-id="<?= $order['order_id'] ?>" data-status="<?= $order['order_status'] ?>" data-payment="<?= $order['payment_status'] ?>">
                  <td>
                    <a href="<?= base_url('admin/view_order/' . $order['order_id']) ?>" class="text-primary fw-semibold">
                      <?= $order['order_number'] ?>
                    </a>
                  </td>
                  <td>
                    <div>
                      <h6 class="mb-0 fw-semibold"><?= htmlspecialchars($order['customer_name']) ?></h6>
                      <small class="text-muted"><?= htmlspecialchars($order['customer_email']) ?></small>
                    </div>
                  </td>
                  <td>
                    <small><?= date('M d, Y', strtotime($order['created_at'])) ?></small><br>
                    <small class="text-muted"><?= date('h:i A', strtotime($order['created_at'])) ?></small>
                  </td>
                  <td>
                    <span class="badge bg-light-secondary text-dark"><?= $order['items_count'] ?> items</span>
                  </td>
                  <td class="fw-semibold">₦<?= number_format($order['total_amount'], 2) ?></td>
                  <td>
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
                  </td>
                  <td>
                    <?php
                    $status_badges = [
                      'pending' => 'bg-warning',
                      'processing' => 'bg-info',
                      'shipped' => 'bg-primary',
                      'delivered' => 'bg-success',
                      'cancelled' => 'bg-danger'
                    ];
                    $status_badge = $status_badges[$order['order_status']] ?? 'bg-secondary';
                    ?>
                    <select class="form-select form-select-sm status-select" data-order-id="<?= $order['order_id'] ?>" style="width: 130px;">
                      <option value="pending" <?= $order['order_status'] == 'pending' ? 'selected' : '' ?>>Pending</option>
                      <option value="processing" <?= $order['order_status'] == 'processing' ? 'selected' : '' ?>>Processing</option>
                      <option value="shipped" <?= $order['order_status'] == 'shipped' ? 'selected' : '' ?>>Shipped</option>
                      <option value="delivered" <?= $order['order_status'] == 'delivered' ? 'selected' : '' ?>>Delivered</option>
                      <option value="cancelled" <?= $order['order_status'] == 'cancelled' ? 'selected' : '' ?>>Cancelled</option>
                    </select>
                  </td>
                  <td>
                    <div class="btn-group">
                      <a href="<?= base_url('admin/view_order/' . $order['order_id']) ?>" class="btn btn-sm btn-outline-primary" data-bs-toggle="tooltip" title="View Details">
                        <i class="ti ti-eye"></i>
                      </a>
                      <button type="button" class="btn btn-sm btn-outline-info print-invoice" data-order-id="<?= $order['order_id'] ?>" data-bs-toggle="tooltip" title="Print Invoice">
                        <i class="ti ti-printer"></i>
                      </button>
                      <button type="button" class="btn btn-sm btn-outline-danger delete-order" data-order-id="<?= $order['order_id'] ?>" data-bs-toggle="tooltip" title="Delete">
                        <i class="ti ti-trash"></i>
                      </button>
                    </div>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="8" class="text-center py-5">
                  <div class="text-muted">
                    <i class="ti ti-shopping-cart fs-1 d-block mb-2"></i>
                    <p class="mb-0">No orders found</p>
                  </div>
                </td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<script>
// Search and filter functionality
document.addEventListener('DOMContentLoaded', function() {
  const searchInput = document.getElementById('searchInput');
  const statusFilter = document.getElementById('statusFilter');
  const paymentFilter = document.getElementById('paymentFilter');
  const table = document.getElementById('ordersTable');
  const rows = table.querySelectorAll('tbody tr[data-order-id]');

  function filterTable() {
    const searchTerm = searchInput.value.toLowerCase();
    const statusValue = statusFilter.value.toLowerCase();
    const paymentValue = paymentFilter.value.toLowerCase();

    rows.forEach(row => {
      const text = row.textContent.toLowerCase();
      const status = row.dataset.status;
      const payment = row.dataset.payment;

      const matchesSearch = text.includes(searchTerm);
      const matchesStatus = !statusValue || status === statusValue;
      const matchesPayment = !paymentValue || payment === paymentValue;

      if (matchesSearch && matchesStatus && matchesPayment) {
        row.style.display = '';
      } else {
        row.style.display = 'none';
      }
    });
  }

  searchInput.addEventListener('input', filterTable);
  statusFilter.addEventListener('change', filterTable);
  paymentFilter.addEventListener('change', filterTable);

  // Status change handler
  document.querySelectorAll('.status-select').forEach(select => {
    select.addEventListener('change', function() {
      const orderId = this.dataset.orderId;
      const newStatus = this.value;
      
      if (confirm('Are you sure you want to change the order status?')) {
        fetch('<?= base_url("admin/update_order_status") ?>', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
          },
          body: `order_id=${orderId}&status=${newStatus}`
        })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            // Update row status attribute
            const row = this.closest('tr');
            row.dataset.status = newStatus;
            
            // Show success message
            alert('Order status updated successfully');
          } else {
            alert('Failed to update order status');
            // Revert select
            location.reload();
          }
        })
        .catch(error => {
          console.error('Error:', error);
          alert('An error occurred');
          location.reload();
        });
      } else {
        // Revert select
        location.reload();
      }
    });
  });

  // Delete order handler
  document.querySelectorAll('.delete-order').forEach(btn => {
    btn.addEventListener('click', function() {
      const orderId = this.dataset.orderId;
      
      if (confirm('Are you sure you want to delete this order? This action cannot be undone.')) {
        fetch('<?= base_url("admin/delete_order") ?>', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
          },
          body: `order_id=${orderId}`
        })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            location.reload();
          } else {
            alert('Failed to delete order');
          }
        })
        .catch(error => {
          console.error('Error:', error);
          alert('An error occurred');
        });
      }
    });
  });

  // Print invoice handler
  document.querySelectorAll('.print-invoice').forEach(btn => {
    btn.addEventListener('click', function() {
      const orderId = this.dataset.orderId;
      window.open('<?= base_url("admin/print_invoice/") ?>' + orderId, '_blank');
    });
  });

  // Initialize tooltips
  var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
  var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl);
  });
});
</script>
