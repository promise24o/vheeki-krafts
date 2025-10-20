<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Webhook extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('crud_model');
        $this->load->library('email');
    }

    /**
     * Paystack Webhook Handler
     * Receives payment notifications from Paystack
     */
    public function paystack() {
        // Log webhook received
        log_message('info', 'Paystack webhook received');

        // Only accept POST requests
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            exit();
        }

        // Retrieve the request's body
        $input = @file_get_contents("php://input");
        
        if (empty($input)) {
            log_message('error', 'Paystack webhook: Empty request body');
            http_response_code(400);
            exit();
        }

        // Parse the JSON
        $event = json_decode($input);

        if (!$event) {
            log_message('error', 'Paystack webhook: Invalid JSON');
            http_response_code(400);
            exit();
        }

        // Verify the webhook signature
        $secret_key = $this->crud_model->get_setting('paystack_secret_key');
        
        if (empty($secret_key)) {
            log_message('error', 'Paystack webhook: Secret key not configured');
            http_response_code(500);
            exit();
        }

        // Verify signature
        if (!isset($_SERVER['HTTP_X_PAYSTACK_SIGNATURE'])) {
            log_message('error', 'Paystack webhook: Missing signature header');
            http_response_code(400);
            exit();
        }

        $signature = $_SERVER['HTTP_X_PAYSTACK_SIGNATURE'];
        
        if ($signature !== hash_hmac('sha512', $input, $secret_key)) {
            log_message('error', 'Paystack webhook: Invalid signature');
            http_response_code(401);
            exit();
        }

        // Log the event
        log_message('info', 'Paystack webhook event: ' . $event->event);

        // Handle different event types
        switch ($event->event) {
            case 'charge.success':
                $this->handle_successful_payment($event->data);
                break;
                
            case 'charge.failed':
                $this->handle_failed_payment($event->data);
                break;
                
            case 'transfer.success':
                log_message('info', 'Transfer successful: ' . json_encode($event->data));
                break;
                
            case 'transfer.failed':
                log_message('info', 'Transfer failed: ' . json_encode($event->data));
                break;
                
            default:
                log_message('info', 'Unhandled Paystack event: ' . $event->event);
                break;
        }

        // Respond with 200 OK
        http_response_code(200);
        echo json_encode(['status' => 'success']);
    }

    /**
     * Handle successful payment
     */
    private function handle_successful_payment($data) {
        log_message('info', 'Processing successful payment: ' . $data->reference);

        // Get order by reference
        $order = $this->crud_model->get_order_by_reference($data->reference);

        if (!$order) {
            log_message('error', 'Order not found for reference: ' . $data->reference);
            return;
        }

        // Check if already processed
        if ($order['payment_status'] === 'paid') {
            log_message('info', 'Payment already processed for order: ' . $order['order_id']);
            return;
        }

        // Update order payment status
        $update_data = [
            'payment_status' => 'paid',
            'payment_method' => 'paystack',
            'transaction_id' => $data->reference,
            'paid_at' => date('Y-m-d H:i:s')
        ];

        if ($this->crud_model->update_order($order['order_id'], $update_data)) {
            log_message('info', 'Order payment confirmed: ' . $order['order_id']);

            // Add tracking log
            $this->crud_model->add_tracking_log(
                $order['order_id'],
                'processing',
                'Payment confirmed via Paystack. Amount: ₦' . number_format($data->amount / 100, 2),
                'System'
            );

            // Send confirmation email (optional)
            $this->send_payment_confirmation_email($order, $data);
        } else {
            log_message('error', 'Failed to update order: ' . $order['order_id']);
        }
    }

    /**
     * Handle failed payment
     */
    private function handle_failed_payment($data) {
        log_message('info', 'Processing failed payment: ' . $data->reference);

        // Get order by reference
        $order = $this->crud_model->get_order_by_reference($data->reference);

        if (!$order) {
            log_message('error', 'Order not found for reference: ' . $data->reference);
            return;
        }

        // Update order payment status
        $update_data = [
            'payment_status' => 'failed',
            'transaction_id' => $data->reference
        ];

        if ($this->crud_model->update_order($order['order_id'], $update_data)) {
            log_message('info', 'Order payment marked as failed: ' . $order['order_id']);

            // Add tracking log
            $this->crud_model->add_tracking_log(
                $order['order_id'],
                'pending',
                'Payment failed. Reason: ' . ($data->gateway_response ?? 'Unknown'),
                'System'
            );
        }
    }

    /**
     * Send payment confirmation email
     */
    private function send_payment_confirmation_email($order, $payment_data) {
        try {
            // Get site settings
            $site_name = $this->crud_model->get_setting('site_name') ?: 'Vheeki Krafts';
            $site_email = $this->crud_model->get_setting('site_email') ?: 'noreply@vheekikrafts.com';

            // Email configuration
            $this->email->from($site_email, $site_name);
            $this->email->to($order['email']);
            $this->email->subject('Payment Confirmation - Order #' . $order['order_number']);

            // Email body
            $message = "
                <html>
                <head>
                    <style>
                        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
                        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
                        .header { background: #4CAF50; color: white; padding: 20px; text-align: center; }
                        .content { padding: 20px; background: #f9f9f9; }
                        .footer { text-align: center; padding: 20px; font-size: 12px; color: #666; }
                        .amount { font-size: 24px; font-weight: bold; color: #4CAF50; }
                        table { width: 100%; border-collapse: collapse; margin: 20px 0; }
                        th, td { padding: 10px; text-align: left; border-bottom: 1px solid #ddd; }
                        th { background: #f0f0f0; }
                    </style>
                </head>
                <body>
                    <div class='container'>
                        <div class='header'>
                            <h1>✓ Payment Confirmed</h1>
                        </div>
                        <div class='content'>
                            <p>Dear {$order['customer_name']},</p>
                            <p>Your payment has been successfully processed!</p>
                            
                            <table>
                                <tr>
                                    <th>Order Number:</th>
                                    <td>{$order['order_number']}</td>
                                </tr>
                                <tr>
                                    <th>Transaction ID:</th>
                                    <td>{$payment_data->reference}</td>
                                </tr>
                                <tr>
                                    <th>Amount Paid:</th>
                                    <td class='amount'>₦" . number_format($payment_data->amount / 100, 2) . "</td>
                                </tr>
                                <tr>
                                    <th>Payment Method:</th>
                                    <td>Paystack ({$payment_data->channel})</td>
                                </tr>
                                <tr>
                                    <th>Date:</th>
                                    <td>" . date('F j, Y g:i A') . "</td>
                                </tr>
                            </table>
                            
                            <p><strong>What's Next?</strong></p>
                            <ul>
                                <li>Your order is now being processed</li>
                                <li>We'll contact you shortly to arrange delivery</li>
                                <li>Track your order at: <a href='" . base_url('track-order') . "'>Track Order</a></li>
                            </ul>
                            
                            <p>Thank you for shopping with us!</p>
                        </div>
                        <div class='footer'>
                            <p>&copy; " . date('Y') . " {$site_name}. All rights reserved.</p>
                            <p>If you have any questions, please contact us.</p>
                        </div>
                    </div>
                </body>
                </html>
            ";

            $this->email->message($message);
            $this->email->set_mailtype('html');

            if ($this->email->send()) {
                log_message('info', 'Payment confirmation email sent to: ' . $order['email']);
            } else {
                log_message('error', 'Failed to send payment confirmation email: ' . $this->email->print_debugger());
            }
        } catch (Exception $e) {
            log_message('error', 'Email error: ' . $e->getMessage());
        }
    }

    /**
     * Test webhook endpoint (for development only)
     * Remove or secure this in production
     */
    public function test() {
        if (ENVIRONMENT !== 'development') {
            show_404();
            return;
        }

        echo "<h2>Paystack Webhook Test</h2>";
        echo "<p>Webhook URL: " . base_url('webhook/paystack') . "</p>";
        echo "<p>Secret Key Configured: " . (!empty($this->crud_model->get_setting('paystack_secret_key')) ? 'Yes' : 'No') . "</p>";
        
        // Test data
        $test_event = [
            'event' => 'charge.success',
            'data' => [
                'reference' => 'TEST-' . time(),
                'amount' => 5000000, // 50,000 in kobo
                'channel' => 'card',
                'gateway_response' => 'Successful'
            ]
        ];

        echo "<h3>Sample Webhook Payload:</h3>";
        echo "<pre>" . json_encode($test_event, JSON_PRETTY_PRINT) . "</pre>";
        
        echo "<p><strong>Note:</strong> This test endpoint is only available in development mode.</p>";
    }
}
