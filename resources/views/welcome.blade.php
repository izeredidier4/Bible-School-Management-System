<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Children Bible School Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

    <!-- SweetAlert CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.js"></script>

    <style>
        body {
            background-image: url('/images/child.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            color: #f0f8ff; /* Lighter text color for better readability */
        }

        /* Dark overlay on the background */
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.6);
            z-index: -1;
        }

        .transparent-header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background-color: rgba(255, 255, 255, 0.5);
            padding: 10px;
            z-index: 999;
            backdrop-filter: blur(10px);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .transparent-header img {
            margin-left: 50px;
        }

        .btn-group {
            margin-right: 50px;
            gap: 10px;
        }

        .main-content {
            padding-top: 200px;
            text-align: center;
            color: #f0f8ff;
        }

        .main-content h2 {
            font-weight: bold;
            margin-bottom: 20px;
            color: #f0f8ff;
        }

        .feature-card {
            background-color: rgba(255, 255, 255, 0.3);
            opacity: 0.9;
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s;
            color: #333;
        }

        .feature-card:hover {
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.9);
        }

        .feature-icon {
            font-size: 80px;
            color: #f0f8ff;
            margin-bottom: 20px;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            padding: 12px 24px;
            font-size: 18px;
            border-radius: 6px;
            margin-top: 40px;
        }

        .btn-primary:hover {
            background-color: #0069d9;
            border-color: #0062cc;
        }

        .moving-text {
            display: inline-block;
            animation: slide-in 2s ease-in-out;
        }

        @keyframes slide-in {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>
    <div class="overlay"></div>

    <div class="transparent-header">
        <img src="images/logo.png" alt="Logo" width="120" height="100">
        <div class="btn-group">
            <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
            <a href="{{ route('register') }}" class="btn btn-primary">Register</a>
        </div>
    </div>

    <div class="main-content">
        <div class="container">
            <h2>
                <span class="moving-text">WELCOME TO THE CHILDREN BIBLE SCHOOL MANAGEMENT SYSTEM</span>
            </h2>
        </div>

        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="card feature-card">
                        <i class="fas fa-book-open feature-icon"></i>
                        <h4>Lesson Planning</h4>
                        <p>Plan and organize engaging lessons for an enriching educational experience.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card feature-card">
                        <i class="fas fa-check-circle feature-icon"></i>
                        <h4>Attendance Tracking</h4>
                        <p>Track attendance records accurately for each child in Sabbath School programs.</p>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center mt-5">
                <div class="col-md-8 text-center">
                    <a href="{{ route('login') }}" class="btn btn-primary btn-lg">Get Started</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
