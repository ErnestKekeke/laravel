<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Verification Code</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #f4f6f8;
            font-family: Arial, Helvetica, sans-serif;
        }
        .container {
            max-width: 480px;
            margin: 40px auto;
            background-color: #ffffff;
            padding: 24px;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
        }
        .title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 12px;
            color: #222222;
        }
        .text {
            font-size: 14px;
            color: #555555;
            line-height: 1.5;
            margin-bottom: 20px;
        }
        .otp {
            font-size: 28px;
            font-weight: bold;
            letter-spacing: 4px;
            text-align: center;
            color: blue;
            margin: 20px 0;
        }
        .note {
            font-size: 12px;
            color: #888888;
            margin-top: 20px;
        }
        .footer {
            font-size: 12px;
            color: #aaaaaa;
            text-align: center;
            margin-top: 24px;
        }
    </style>
</head>
<body>
    <div class="container">
        @if ($lr == "registration") 
            <div class="title">Verify Your Email to Complete Registration</div>
        @else
            <div class="title">Email Verification for Login</div>
        @endif
        

        <div class="text">
            @if ($lr == "registration") 
                <p>Hi, {{ $fullname }}.</p>
            @endif
            Use the code below to complete your <b>{{ $lr }}</b>.
            This code will expire in <strong>3 minutes</strong>.
        </div>

        <div class="otp">{{ $otp }}</div>

        <div class="note">
            If you didn't request this code, you can safely ignore this email.
        </div>

        <div class="footer">
            © {{ date('Y-m-d H:i:s') }} Gloria Team
            {{-- © {{ now()->timezone(auth()->user()->timezone)->format('Y-m-d H:i:s') }} Gloria Team --}}
        </div>
    </div>
</body>
</html>


