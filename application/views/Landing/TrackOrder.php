<section class="py-10 py-lg-15">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- Page Header -->
                <div class="text-center mb-8">
                    <h1 class="fs-2 mb-4">Track Your Order</h1>
                    <p class="text-muted">Enter your order number or tracking number to see the status of your order</p>
                </div>

                <!-- Tracking Form -->
                <div class="card shadow-sm mb-8">
                    <div class="card-body p-6">
                        <form id="trackingForm" method="get" action="<?= base_url('track-order') ?>">
                            <div class="mb-4">
                                <label for="trackingNumber" class="form-label fw-semibold">Order Number or Tracking Number</label>
                                <input type="text" 
                                       class="form-control form-control-lg" 
                                       id="trackingNumber" 
                                       name="number" 
                                       placeholder="e.g., VK-1234567890-5678 or VK-TRACK-20241020-1234"
                                       value="<?= isset($_GET['number']) ? htmlspecialchars($_GET['number']) : '' ?>"
                                       required>
                                <small class="text-muted">You can find this in your order confirmation email</small>
                            </div>
                            <button type="submit" class="btn btn-primary btn-lg w-100">
                                <i class="far fa-search me-2"></i> Track Order
                            </button>
                        </form>
                    </div>
                </div>

                <?php if (isset($error)): ?>
                    <!-- Error Message -->
                    <div class="alert alert-danger d-flex align-items-center" role="alert">
                        <i class="far fa-exclamation-circle me-3 fs-4"></i>
                        <div><?= $error ?></div>
                    </div>
                <?php endif; ?>

                <?php if (isset($order)): ?>
                    <!-- Order Found -->
                    <div class="card shadow-sm mb-6">
                        <div class="card-header bg-primary text-white py-4">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <h5 class="mb-0">Order #<?= $order['order_number'] ?></h5>
                                    <?php if ($order['tracking_number']): ?>
                                        <small>Tracking: <?= $order['tracking_number'] ?></small>
                                    <?php endif; ?>
                                </div>
                                <div class="col-md-6 text-md-end mt-2 mt-md-0">
                                    <?php
                                    $status_badges = [
                                        'pending' => 'bg-warning',
                                        'processing' => 'bg-info',
                                        'shipped' => 'bg-primary',
                                        'delivered' => 'bg-success',
                                        'cancelled' => 'bg-danger'
                                    ];
                                    $badge_class = $status_badges[$order['order_status']] ?? 'bg-secondary';
                                    ?>
                                    <span class="badge <?= $badge_class ?> fs-6 px-3 py-2"><?= ucfirst($order['order_status']) ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-6">
                            <!-- Order Info -->
                            <div class="row mb-6">
                                <div class="col-md-6">
                                    <h6 class="text-muted mb-2">Order Date</h6>
                                    <p class="mb-0"><?= date('F d, Y h:i A', strtotime($order['created_at'])) ?></p>
                                </div>
                                <div class="col-md-6">
                                    <h6 class="text-muted mb-2">Total Amount</h6>
                                    <p class="mb-0 fw-bold fs-5">₦<?= number_format($order['total_amount'], 2) ?></p>
                                </div>
                            </div>

                            <!-- Shipping Address -->
                            <div class="mb-6">
                                <h6 class="text-muted mb-2">Shipping Address</h6>
                                <address class="mb-0">
                                    <strong><?= htmlspecialchars($order['customer_name']) ?></strong><br>
                                    <?= nl2br(htmlspecialchars($order['shipping_address'])) ?><br>
                                    <?= htmlspecialchars($order['city']) ?>, <?= htmlspecialchars($order['state']) ?>
                                    <?php if ($order['postal_code']): ?>
                                        <br><?= htmlspecialchars($order['postal_code']) ?>
                                    <?php endif; ?>
                                </address>
                            </div>

                            <!-- Order Items -->
                            <div class="mb-6">
                                <h6 class="text-muted mb-3">Order Items</h6>
                                <div class="table-responsive">
                                    <table class="table table-borderless">
                                        <tbody>
                                            <?php foreach ($order['items'] as $item): ?>
                                                <tr>
                                                    <td style="width: 80px;">
                                                        <img src="<?= $item['image'] ?: base_url('assets/admin/images/placeholder.png') ?>" 
                                                             alt="<?= htmlspecialchars($item['product_name']) ?>" 
                                                             class="rounded"
                                                             style="width: 60px; height: 60px; object-fit: cover;">
                                                    </td>
                                                    <td>
                                                        <div class="fw-semibold"><?= htmlspecialchars($item['product_name']) ?></div>
                                                        <small class="text-muted">Qty: <?= $item['quantity'] ?></small>
                                                    </td>
                                                    <td class="text-end">₦<?= number_format($item['total_price'], 2) ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- Tracking Timeline -->
                            <div>
                                <h6 class="text-muted mb-4">Tracking History</h6>
                                <div class="tracking-timeline">
                                    <?php if (!empty($order['tracking_logs'])): ?>
                                        <?php foreach ($order['tracking_logs'] as $index => $log): ?>
                                            <div class="tracking-item <?= $index === 0 ? 'active' : '' ?>">
                                                <div class="tracking-icon">
                                                    <?php
                                                    $icons = [
                                                        'pending' => 'fa-clock',
                                                        'processing' => 'fa-cog',
                                                        'shipped' => 'fa-truck',
                                                        'delivered' => 'fa-check-circle',
                                                        'cancelled' => 'fa-times-circle'
                                                    ];
                                                    $icon = $icons[$log['status']] ?? 'fa-circle';
                                                    ?>
                                                    <i class="far <?= $icon ?>"></i>
                                                </div>
                                                <div class="tracking-content">
                                                    <div class="d-flex justify-content-between align-items-start mb-1">
                                                        <h6 class="mb-0"><?= htmlspecialchars($log['message']) ?></h6>
                                                        <small class="text-muted"><?= date('M d, Y h:i A', strtotime($log['created_at'])) ?></small>
                                                    </div>
                                                    <small class="text-muted">By: <?= htmlspecialchars($log['created_by']) ?></small>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <div class="text-center text-muted py-4">
                                            <i class="far fa-info-circle fs-3 mb-2"></i>
                                            <p class="mb-0">No tracking updates available yet</p>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Help Section -->
                    <div class="text-center">
                        <p class="text-muted mb-3">Need help with your order?</p>
                        <a href="<?= base_url('contact') ?>" class="btn btn-outline-primary">
                            <i class="far fa-envelope me-2"></i> Contact Support
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<style>
.tracking-timeline {
    position: relative;
    padding-left: 0;
}

.tracking-item {
    position: relative;
    padding-left: 60px;
    padding-bottom: 30px;
}

.tracking-item:last-child {
    padding-bottom: 0;
}

.tracking-item::before {
    content: '';
    position: absolute;
    left: 20px;
    top: 40px;
    bottom: -10px;
    width: 2px;
    background: #e9ecef;
}

.tracking-item:last-child::before {
    display: none;
}

.tracking-icon {
    position: absolute;
    left: 0;
    top: 0;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: #f8f9fa;
    border: 2px solid #dee2e6;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    color: #6c757d;
}

.tracking-item.active .tracking-icon {
    background: #5d87ff;
    border-color: #5d87ff;
    color: white;
}

.tracking-content {
    background: #f8f9fa;
    padding: 15px;
    border-radius: 8px;
    border-left: 3px solid #dee2e6;
}

.tracking-item.active .tracking-content {
    background: #e7f1ff;
    border-left-color: #5d87ff;
}
</style>
