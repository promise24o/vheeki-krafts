<?php
/**
 * Database Structure Checker
 * Run this file in your browser to check if the database structure is correct
 * URL: http://localhost:8080/vheeki-krafts/check_db.php
 */

// Database configuration
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'vheeki_krafts';

// Connect to database
$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "<h1>Database Structure Check</h1>";
echo "<p>Database: <strong>$database</strong></p>";

// Check orders table
echo "<h2>Orders Table Structure</h2>";
$result = $conn->query("DESCRIBE orders");

if ($result) {
    echo "<table border='1' cellpadding='5' style='border-collapse: collapse;'>";
    echo "<tr><th>Field</th><th>Type</th><th>Null</th><th>Key</th><th>Default</th></tr>";
    
    $columns = [];
    while ($row = $result->fetch_assoc()) {
        $columns[] = $row['Field'];
        echo "<tr>";
        echo "<td>{$row['Field']}</td>";
        echo "<td>{$row['Type']}</td>";
        echo "<td>{$row['Null']}</td>";
        echo "<td>{$row['Key']}</td>";
        echo "<td>" . ($row['Default'] ?? 'NULL') . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    
    // Check for required columns
    echo "<h3>Required Columns Check</h3>";
    $required = ['order_number', 'customer_name', 'customer_email', 'customer_phone', 
                 'shipping_address', 'city', 'state', 'postal_code', 'order_notes', 
                 'total_amount', 'payment_method', 'payment_status', 'payment_reference', 'order_status'];
    
    echo "<ul>";
    foreach ($required as $col) {
        $status = in_array($col, $columns) ? '✅' : '❌';
        echo "<li>$status <strong>$col</strong></li>";
    }
    echo "</ul>";
} else {
    echo "<p style='color: red;'>Error: " . $conn->error . "</p>";
}

// Check order_items table
echo "<h2>Order Items Table Structure</h2>";
$result = $conn->query("DESCRIBE order_items");

if ($result) {
    echo "<table border='1' cellpadding='5' style='border-collapse: collapse;'>";
    echo "<tr><th>Field</th><th>Type</th><th>Null</th><th>Key</th><th>Default</th></tr>";
    
    $columns = [];
    while ($row = $result->fetch_assoc()) {
        $columns[] = $row['Field'];
        echo "<tr>";
        echo "<td>{$row['Field']}</td>";
        echo "<td>{$row['Type']}</td>";
        echo "<td>{$row['Null']}</td>";
        echo "<td>{$row['Key']}</td>";
        echo "<td>" . ($row['Default'] ?? 'NULL') . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    
    // Check for required columns
    echo "<h3>Required Columns Check</h3>";
    $required = ['order_id', 'product_id', 'quantity', 'price', 'subtotal'];
    
    echo "<ul>";
    foreach ($required as $col) {
        $status = in_array($col, $columns) ? '✅' : '❌';
        echo "<li>$status <strong>$col</strong></li>";
    }
    echo "</ul>";
} else {
    echo "<p style='color: red;'>Error: " . $conn->error . "</p>";
}

// Test insert
echo "<h2>Test Order Creation</h2>";
$test_data = [
    'order_number' => 'TEST-' . time(),
    'customer_name' => 'Test Customer',
    'customer_email' => 'test@example.com',
    'customer_phone' => '1234567890',
    'shipping_address' => '123 Test St',
    'city' => 'Test City',
    'state' => 'Test State',
    'postal_code' => '12345',
    'order_notes' => 'Test order',
    'total_amount' => 100.00,
    'payment_method' => 'paystack',
    'payment_status' => 'pending',
    'payment_reference' => 'TEST-REF-' . time(),
    'order_status' => 'pending'
];

$fields = implode(', ', array_keys($test_data));
$placeholders = implode(', ', array_fill(0, count($test_data), '?'));
$types = str_repeat('s', count($test_data) - 1) . 'd'; // All strings except total_amount (double)

$stmt = $conn->prepare("INSERT INTO orders ($fields) VALUES ($placeholders)");

if ($stmt) {
    $stmt->bind_param($types, ...array_values($test_data));
    
    if ($stmt->execute()) {
        $order_id = $stmt->insert_id;
        echo "<p style='color: green;'>✅ Test order created successfully! Order ID: $order_id</p>";
        
        // Clean up test order
        $conn->query("DELETE FROM orders WHERE order_id = $order_id");
        echo "<p>Test order deleted.</p>";
    } else {
        echo "<p style='color: red;'>❌ Error creating test order: " . $stmt->error . "</p>";
    }
    $stmt->close();
} else {
    echo "<p style='color: red;'>❌ Error preparing statement: " . $conn->error . "</p>";
}

$conn->close();

echo "<hr>";
echo "<h3>Recommendations:</h3>";
echo "<ol>";
echo "<li>If any required columns are missing (❌), run: <code>database/fix_orders_schema.sql</code></li>";
echo "<li>If test order creation failed, check the error message above</li>";
echo "<li>Make sure to delete this file after checking (security risk)</li>";
echo "</ol>";
?>
