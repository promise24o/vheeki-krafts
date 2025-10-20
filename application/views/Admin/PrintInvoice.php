<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice - <?= $order['order_number'] ?></title>
    <link rel="stylesheet" href="<?= base_url() ?>assets/admin/css/styles.min.css" />
    <style>
        @media print {
            .no-print {
                display: none !important;
            }
            body {
                margin: 0;
                padding: 20px;
            }
        }
        body {
            font-family: Arial, sans-serif;
            padding: 40px;
        }
        .invoice-header {
            border-bottom: 3px solid #5d87ff;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .invoice-title {
            font-size: 32px;
            font-weight: bold;
            color: #5d87ff;
        }
        .invoice-details {
            margin-top: 30px;
        }
        .table {
            margin-top: 30px;
        }
        .total-row {
            background-color: #f8f9fa;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Print Button -->
        <div class="text-end mb-4 no-print">
            <button onclick="window.print()" class="btn btn-primary">
                <i class="ti ti-printer me-1"></i> Print Invoice
            </button>
            <button onclick="window.close()" class="btn btn-secondary">
                <i class="ti ti-x me-1"></i> Close
            </button>
        </div>

        <!-- Invoice Header -->
        <div class="invoice-header">
            <div class="row">
                <div class="col-6">
                    <h1 class="invoice-title">INVOICE</h1>
                    <p class="mb-0"><strong>Vheeki Krafts</strong></p>
                    <p class="mb-0">Handmade Artisanal Products</p>
                    <?php if (!empty($settings)): ?>
                        <?php foreach ($settings as $setting): ?>
                            <?php if ($setting['setting_name'] == 'contact_email'): ?>
                                <p class="mb-0">Email: <?= $setting['setting_value'] ?></p>
                            <?php endif; ?>
                            <?php if ($setting['setting_name'] == 'contact_phone'): ?>
                                <p class="mb-0">Phone: <?= $setting['setting_value'] ?></p>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <div class="col-6 text-end">
                    <h4>Order #<?= $order['order_number'] ?></h4>
                    <p class="mb-1"><strong>Date:</strong> <?= date('F d, Y', strtotime($order['created_at'])) ?></p>
                    <p class="mb-1"><strong>Status:</strong> 
                        <span class="badge bg-<?= $order['order_status'] == 'delivered' ? 'success' : 'warning' ?>">
                            <?= ucfirst($order['order_status']) ?>
                        </span>
                    </p>
                    <p class="mb-0"><strong>Payment:</strong> 
                        <span class="badge bg-<?= $order['payment_status'] == 'paid' ? 'success' : 'warning' ?>">
                            <?= ucfirst($order['payment_status']) ?>
                        </span>
                    </p>
                </div>
            </div>
        </div>

        <!-- Customer & Shipping Info -->
        <div class="row invoice-details">
            <div class="col-6">
                <h5 class="mb-3">Bill To:</h5>
                <p class="mb-1"><strong><?= htmlspecialchars($order['customer_name']) ?></strong></p>
                <p class="mb-1"><?= htmlspecialchars($order['customer_email']) ?></p>
                <p class="mb-0"><?= htmlspecialchars($order['customer_phone']) ?></p>
            </div>
            <div class="col-6">
                <h5 class="mb-3">Ship To:</h5>
                <address class="mb-0">
                    <?= nl2br(htmlspecialchars($order['shipping_address'])) ?><br>
                    <?= htmlspecialchars($order['city']) ?>, <?= htmlspecialchars($order['state']) ?><br>
                    <?php if ($order['postal_code']): ?>
                        <?= htmlspecialchars($order['postal_code']) ?>
                    <?php endif; ?>
                </address>
            </div>
        </div>

        <!-- Order Items Table -->
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Product</th>
                    <th>SKU</th>
                    <th class="text-center">Quantity</th>
                    <th class="text-end">Price</th>
                    <th class="text-end">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                <?php foreach ($order_items as $item): ?>
                    <tr>
                        <td><?= $i++ ?></td>
                        <td><?= htmlspecialchars($item['product_name']) ?></td>
                        <td><?= htmlspecialchars($item['sku']) ?></td>
                        <td class="text-center"><?= $item['quantity'] ?></td>
                        <td class="text-end">₦<?= number_format($item['price'], 2) ?></td>
                        <td class="text-end">₦<?= number_format($item['subtotal'], 2) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="5" class="text-end"><strong>Subtotal:</strong></td>
                    <td class="text-end">₦<?= number_format($order['total_amount'], 2) ?></td>
                </tr>
                <tr>
                    <td colspan="5" class="text-end"><strong>Shipping:</strong></td>
                    <td class="text-end">₦0.00</td>
                </tr>
                <tr class="total-row">
                    <td colspan="5" class="text-end"><strong>TOTAL:</strong></td>
                    <td class="text-end"><strong>₦<?= number_format($order['total_amount'], 2) ?></strong></td>
                </tr>
            </tfoot>
        </table>

        <!-- Order Notes -->
        <?php if (!empty($order['order_notes'])): ?>
        <div class="mt-4">
            <h5>Order Notes:</h5>
            <p class="text-muted"><?= nl2br(htmlspecialchars($order['order_notes'])) ?></p>
        </div>
        <?php endif; ?>

        <!-- Payment Info -->
        <?php if ($order['payment_reference']): ?>
        <div class="mt-4">
            <h5>Payment Information:</h5>
            <p class="mb-0"><strong>Payment Reference:</strong> <?= htmlspecialchars($order['payment_reference']) ?></p>
            <p class="mb-0"><strong>Payment Method:</strong> <?= ucfirst($order['payment_method']) ?></p>
        </div>
        <?php endif; ?>

        <!-- Footer -->
        <div class="mt-5 pt-4 border-top text-center">
            <p class="text-muted mb-0">Thank you for your business!</p>
            <p class="text-muted small">This is a computer-generated invoice and does not require a signature.</p>
        </div>
    </div>

    <script>
        // Auto-print on load (optional)
        // window.onload = function() { window.print(); }
    </script>
</body>
</html>
