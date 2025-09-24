<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Purchase Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f7f7f7;
            margin: 0;
            padding: 0;
        }
        .mail-container {
            max-width: 600px;
            margin: 20px auto;
            background: #ffffff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        h2 {
            color: #333333;
        }
        p {
            font-size: 14px;
            color: #555555;
            line-height: 1.6;
        }
        .code-box {
            background: #f0f0f0;
            padding: 10px 15px;
            border-radius: 6px;
            font-size: 16px;
            font-weight: bold;
            letter-spacing: 1px;
            margin: 15px 0;
        }
        .footer {
            margin-top: 25px;
            font-size: 12px;
            color: #888888;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="mail-container">
        <h2>Hello, {{ $name }}</h2>

        <p>Thank you for your purchase. We’re excited to have you on board.</p>

        <p><strong>Your Purchase Code is:</strong></p>
        <div class="code-box">
            {{ $code }}
        </div>

        <p>Please keep this code safe. You may need it for product activation or customer support.</p>

        <p>If you did not make this purchase, please contact our support team immediately.</p>

        <div class="footer">
            &copy; {{ date('Y') }} Xetlab. All rights reserved.  
            <br>
            This is an automated email, please do not reply.
        </div>
    </div>
</body>
</html>
