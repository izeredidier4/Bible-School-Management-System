<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
    <title>Register</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <style>
        body {
            background-color: ghostwhite;
            overflow: hidden; /* Prevent scrolling */
        }

        .card {
            margin-top: 40px;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            height: auto; /* Allow the height to adjust */
        }

        .form-outline {
            margin-bottom: 1rem; /* Reduced margin */
        }

        .form-label {
            font-weight: 600;
        }

        .btn-warning {
            background-color: #ffcc00;
            border: none;
            width: 100%; /* Full width */
        }

        .btn-warning:hover {
            background-color: #e6b800;
        }

        .gradient-custom-2 {
            background: linear-gradient(45deg, #f3e5f5, #e1bee7);
        }

        .text-dark {
            color: #2c3e50;
        }

        .text-center img {
            margin-top: -50px; /* Adjusted for centering */
            width: 150px; /* Reduced size */
            height: auto;
        }

        .quote {
            font-style: italic;
            color: goldenrod;
            font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
            text-align: center;
            margin-top: 10px; /* Reduced margin */
        }

        .footer-link {
            color: aliceblue;
            margin-top: 10px; /* Reduced margin */
        }

        @media (max-width: 576px) {
            .card {
                height: auto; /* Allow card to resize on small screens */
            }
        }
    </style>
</head>

<body>
    <section class="h-100">
        <div class="container py-3 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-10">
                    <div class="card text-white">
                        <div class="row g-0">
                            <div class="bg-primary col-lg-6 d-flex flex-column justify-content-center">
                                <div class="card-body p-md-4 mx-md-4">
                                    <form method="POST" action="{{ route('register') }}">
                                        @csrf
                                        <p class="text-center"><b>Please register for your account</b></p>

                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-outline">
                                                    <input name="name" id="formName" value="{{ old('name') }}"
                                                        class="form-control" placeholder="Enter Full Name" required />
                                                    <label class="form-label" for="formName">Name</label>
                                                    @if ($errors->has('name'))
                                                    <div class="alert alert-danger">{{ $errors->first('name') }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-outline">
                                                    <input name="username" id="formUsername" value="{{ old('username') }}"
                                                        class="form-control" placeholder="Enter Username" required />
                                                    <label class="form-label" for="formUsername">Username</label>
                                                    @if ($errors->has('username'))
                                                    <div class="alert alert-danger">{{ $errors->first('username') }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-outline mb-3">
                                            <input name="email" type="email" id="formEmail" value="{{ old('email') }}"
                                                class="form-control" placeholder="Enter Email Address" required />
                                            <label class="form-label" for="formEmail">Email</label>
                                            @if ($errors->has('email'))
                                            <div class="alert alert-danger">{{ $errors->first('email') }}</div>
                                            @endif
                                        </div>

                                        <div class="form-outline mb-3">
                                            <input name="phoneNumber" id="formPhone" value="{{ old('phoneNumber') }}"
                                                class="form-control" placeholder="Enter your Phone Number" required />
                                            <label class="form-label" for="formPhone">Phone Number</label>
                                            @if ($errors->has('phoneNumber'))
                                            <div class="alert alert-danger">{{ $errors->first('phoneNumber') }}</div>
                                            @endif
                                        </div>

                                        
                                           
                                        <div class="form-outline mb-3">
                                                    <select class="form-select" name="role" id="role" required>
                                                        <option value="" disabled selected>Select Role</option>
                                                        <option value="Parent">Parent</option>
                                                        <option value="Teacher">Teacher</option>
                                                        <option value="Child">Child</option>
                                                    </select>
                                                    <label class="form-label" for="role">Role</label>
                                                </div>
                                            

                                            <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-outline">
                                                    <input name="password" type="password" id="formPassword"
                                                        class="form-control" placeholder="Enter Password" required />
                                                    <label class="form-label" for="formPassword">Password</label>
                                                    @if ($errors->has('password'))
                                                    <div class="alert alert-danger">{{ $errors->first('password') }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                        

                                    
                                            <div class="col-md-6">
                                                <div class="form-outline">
                                                    <input id="password_confirmation" type="password" class="form-control"
                                                        name="password_confirmation" required autocomplete="new-password"
                                                        placeholder="Confirm Password" />
                                                    <label class="form-label" for="password_confirmation">Confirm Password</label>
                                                </div>
                                            </div>
                                            </div>

                                        <div class="text-center pt-1 mb-3 pb-3">
                                            <button type="submit" class="btn btn-warning">
                                                <i class="fas fa-user-plus"></i> Register
                                            </button>
                                            <a class="footer-link" href="/login">Already have an account?</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                                <div class="text-dark px-3 py-4 p-md-5 mx-md-4">
                                    <div class="text-center">
                                        <img src="/images/logo.png" alt="logo">
                                    </div>
                                    <h2 class="text-center" style="margin-top:30px; color:mediumblue;"><b>Children Bible School Management System</b></h2>
                                    <p class="quote">Train up a child in the way he should go, and when he is old, he will not depart from it.</p>
                                    <p class="quote"><b>~Proverbs 22:6~</b></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
