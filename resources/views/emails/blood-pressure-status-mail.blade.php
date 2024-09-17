<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Pressure Status Alert</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            padding: 0;
            margin: 0;
        }

        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            padding: 20px 0;
            background-color: #ef4444;
            color: white;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }

        .logo {
            margin-bottom: 20px;
        }

        .logo img {
            max-width: 150px; /* Adjust logo size */
        }

        .header h1 {
            font-size: 24px;
            font-weight: bold;
            margin: 0;
        }

        .body-content {
            padding: 20px;
            color: #333;
        }

        .body-content p {
            margin-bottom: 20px;
            line-height: 1.5;
            font-size: 16px;
        }

        .button {
            display: inline-block;
            background-color: #ef4444;
            color: white;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
            text-align: center;
        }

        .footer {
            margin-top: 20px;
            text-align: center;
            color: #aaa;
            font-size: 14px;
        }

        .footer p {
            margin-bottom: 10px;
        }

        .footer a {
            color: #ef4444;
            text-decoration: none;
        }

        /* Responsive Design */
        @media (max-width: 600px) {
            .container {
                padding: 10px;
            }

            .header h1 {
                font-size: 20px;
            }

            .body-content p {
                font-size: 14px;
            }

            .button {
                padding: 10px 20px;
                font-size: 14px;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <!-- Header -->
        <div class="header">
            <!-- Logo Section -->
            <div class="logo">
                <img src="https://sksu-hims.me/images/sksu1.png" alt="Logo" style="width: 50px;">
            </div>
            <h1>Blood Pressure Status Alert</h1>
        </div>

        <!-- Body Content -->
        <div class="body-content">
            <p>Hello {{$name ?? ''}},</p>

            <p>
                This is an important alert regarding your recent blood pressure reading. Based on the data we have on file, your current blood pressure status is: <strong>{{$status ??''}}</strong>.
            </p>

            <p>
                Based on your current blood pressure status, we recommend taking the following steps to manage your health and well-being:
            </p>

            <p>
                <strong>Health Tips:</strong> {{$suggestion ??''}}
            </p>

            <p>
                It’s important to monitor your blood pressure regularly. If your symptoms persist or worsen, we strongly recommend consulting with your healthcare provider for professional medical advice and treatment.
            </p>

            <!-- Button -->

        </div>

        <!-- Footer -->
        <div class="footer">
            <p> SKSU HEALTH INFORMATION MANAGEMENT SYSTEM (HIMS)</p>

        </div>
    </div>

</body>
</html>
