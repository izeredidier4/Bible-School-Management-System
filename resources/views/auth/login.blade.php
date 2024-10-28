<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <style>
        .fa-user::before {
            content: "\f007";
        }
    </style>
</head>
<body style="background-color:ghostwhite;" >
  <br> 
<section class="" style="height:600px; ">
  <div class="container py-3 h-120">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-xl-10">
        <div class="card rounded-4 text-white" style="margin-top:140px; ">
          <div class="row g-0">
            <div class=" bg-primary col-lg-6" >
              <div class="card-body p-md-4 mx-md-4">
               
              <br> 

                <form method="POST" action="{{ route('login') }}">
                  @csrf

                  <p>Please login to your account</p>
                  <br>

                  <div class="form-outline mb-3">
                    <input name="username"  id="form2Example11" class="form-control"
                      placeholder="Enter username" />
                    <label class="form-label" for="form2Example11">Username</label>
                    @if ($errors->has('username'))
                    <div class="alert alert-danger">{{ $errors->first('username') }}</div>
                @endif
                  </div>

                  <div class="form-outline mb-3">
                    <input name="password" type="password" placeholder="Enter password" id="form2Example22" class="form-control" />
                    <label class="form-label" for="form2Example22">Password</label>
                    @if ($errors->has('password'))
                    <div class="alert alert-danger">{{ $errors->first('password') }}</div>
                @endif
                  </div>

                  <div class="text-center pt-1 mb-5  pb-2">
                    <button style="margin-left: -120px;" type="submit" class="btn btn-warning">
                      <i class="fas fa-sign-in-alt"></i> Log in
                  </button>        
                    <a class="" style="margin-left: 20px; color:aliceblue;" href="#!">Forgot password?</a>
                  </div>

                  <div class="d-flex align-items-center justify-content-center pb-4">
                    <p style="margin-left: -80px;" class="mb-0 me-2">Don't have an account?</p>
                    <a class="btn btn-success"  href="/register">Create New</a>
                  </div>

                </form>

              </div>
            </div>
            <div class="col-lg-6 d-flex align-items-center gradient-custom-2" >
              <div class="text-dark px-3 py-4 p-md-5 mx-md-4">
              <div class="text-center" style="margin-top: -15px;">
                <img src="/images/logo.png"
                    style="width: 165px; height:140px; text-align:center;" alt="logo">
                </div>
                
                <br> 
                <h2 style="margin-top:30px; font-style:inherit; font-family: 'Times New Roman'; text-align:center;color:mediumblue;" class="mb-5"><b>Children Bible School Management System</b> </h2>
                <br> 
                <p class="small mb-0" style="margin-top:40px; font-style:italic; color:goldenrod ;font-family:Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;">Train up a child in the way he should go, and when he is old, he will not depart from it.</p>
                <p class="small mb-0" style="font-style: italic; color:goldenrod; font-family:Cambria, Cochin, Georgia, Times, 'Times New Roman', serif; text-align:center;"><b>~Proverbs 22:6~</b></p> 

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
</body>
</html>