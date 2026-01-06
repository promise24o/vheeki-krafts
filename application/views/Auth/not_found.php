<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            padding: 12px 30px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-block;
            margin: 5px;
        }
        .btn-home:hover {
            background: #f8f9fa;
            color: #764ba2;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        }
    </style>
</head>
<body>
    <div class="error-container">
        <div class="error-code">404</div>
        <div class="error-message">Oops! Page Not Found</div>
        <div class="error-description">
            The page you're looking for doesn't exist or has been moved.
        </div>
        <div>
            <a href="<?= base_url() ?>" class="btn-home">Go Home</a>
            <a href="<?= base_url('shop') ?>" class="btn-home">Browse Shop</a>
            <a href="<?= base_url('contact') ?>" class="btn-home">Contact Us</a>
        </div>
    </div>
</body>
</html>
