<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f7f6;
            margin: 0;
            padding: 40px 20px;
            color: #333333;
        }

        .email-wrapper {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }

        .header {
            background-color: #10b981;
            /* Ctech Emerald Green */
            padding: 30px 20px;
            text-align: center;
        }

        .header h1 {
            color: #ffffff;
            margin: 0;
            font-size: 24px;
            letter-spacing: 1px;
        }

        .body-content {
            padding: 40px 30px;
            text-align: center;
        }

        .body-content p {
            font-size: 16px;
            line-height: 1.6;
            color: #555555;
            margin-bottom: 25px;
        }

        .btn {
            display: inline-block;
            background-color: #10b981;
            color: #ffffff !important;
            text-decoration: none;
            padding: 14px 30px;
            border-radius: 8px;
            font-weight: bold;
            font-size: 16px;
            margin-bottom: 25px;
        }

        .footer {
            background-color: #f9fafb;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #9ca3af;
            border-top: 1px solid #eeeeee;
        }

        .footer a {
            color: #10b981;
            word-break: break-all;
        }
    </style>
</head>

<body>
    <div class="email-wrapper">
        <div class="header">
            <h1>CTECH SYSTEMS</h1>
        </div>

        <div class="body-content">
            <h2 style="margin-top: 0; color: #1f2937;">Password Reset Request</h2>
            <p>Hello <strong>{{ $user->name }}</strong>,</p>
            <p>We received a request to reset the password for your Ctech Systems employee portal. Click the secure
                button below to choose a new password.</p>

            <a href="{{ $url }}" class="btn">Reset My Password</a>

            <p style="font-size: 14px;">If you did not request a password reset, you can safely ignore this email. Your
                account remains secure.</p>
        </div>

        <div class="footer">
            &copy; {{ date('Y') }} Ctech Systems Internal IT. All rights reserved.<br><br>
            If you're having trouble clicking the button, copy and paste the URL below into your web browser:<br>
            <a href="{{ $url }}">{{ $url }}</a>
        </div>
    </div>
</body>

</html>