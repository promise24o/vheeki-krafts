<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>404 - Page Not Found | Vheeki Krafts</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body {
	background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
	min-height: 100vh;
	display: flex;
	align-items: center;
	justify-content: center;
	font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}
.error-container {
	text-align: center;
	color: white;
	padding: 2rem;
}
.error-code {
	font-size: 150px;
	font-weight: bold;
	line-height: 1;
	text-shadow: 4px 4px 8px rgba(0,0,0,0.3);
	animation: float 3s ease-in-out infinite;
}
@keyframes float {
	0%, 100% { transform: translateY(0px); }
	50% { transform: translateY(-20px); }
}
.error-message {
	font-size: 24px;
	margin: 20px 0;
	text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
}
.error-description {
	font-size: 16px;
	margin-bottom: 30px;
	opacity: 0.9;
}
.btn-home {
	background: white;
	color: #667eea;
	padding: 12px 40px;
	border-radius: 50px;
	text-decoration: none;
	font-weight: 600;
	display: inline-block;
	transition: all 0.3s ease;
	box-shadow: 0 4px 15px rgba(0,0,0,0.2);
}
.btn-home:hover {
	transform: translateY(-2px);
	box-shadow: 0 6px 20px rgba(0,0,0,0.3);
	color: #764ba2;
}
.illustration {
	max-width: 400px;
	margin: 0 auto 30px;
}
</style>
</head>
<body>
	<div class="error-container">
		<div class="illustration">
			<svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
				<circle cx="100" cy="100" r="80" fill="rgba(255,255,255,0.1)" stroke="white" stroke-width="2"/>
				<text x="100" y="120" font-size="60" fill="white" text-anchor="middle" font-weight="bold">404</text>
			</svg>
		</div>
		<div class="error-code">404</div>
		<h1 class="error-message">Oops! Page Not Found</h1>
		<p class="error-description">
			The page you're looking for seems to have wandered off.<br>
			Let's get you back on track!
		</p>
		<a href="<?= base_url() ?>" class="btn-home">
			<i class="bi bi-house-door"></i> Back to Home
		</a>
		<div class="mt-4">
			<a href="<?= base_url('shop') ?>" class="text-white text-decoration-none me-3">Shop</a>
			<a href="<?= base_url('contact') ?>" class="text-white text-decoration-none">Contact Us</a>
		</div>
	</div>
</body>
</html>