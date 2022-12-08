<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
</div>
<section class="vh-100" style="background-color: #eee;">
  <div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-12 col-xl-11">
        <div class="card text-black" style="border-radius: 25px;">
          <div class="card-body p-md-5">
            <div class="row justify-content-center">
              <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up</p>

                <form action="register.php" method="POST" class="mx-1 mx-md-4">
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" name= "name" class="form-control" >
                    </div>
                    <div class="mb-3">
                        <label  class="form-label">Email</label>
                        <input type="email" name= "email" class="form-control" >
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name= "password" class="form-control">
                    </div>
                    <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                        <button type="submit" name="register" class="btn btn-primary btn-lg">Register</button>
                    </div>

                </form>

              </div>
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