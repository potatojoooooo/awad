<x-header></x-header>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Register</title>
    <link rel="icon" type="image/x-icon" href="{{URL::asset('/image/about-us.jpg')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="container mt-4 h-100">
                <div class="container py-5 h-100">
                    <div class="row d-flex justify-content-center align-items-center h-100">
                        <div class="col-xl-10">
                            <div class="card rounded-3 text-black">
                                <div class="row g-0">
                                    <div class="row">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="card-body p-md-5 mx-md-4">
                                                    <div class="text-center pt-1 mb-5 pb-1">
                                                        <a href="{{ route('register.user') }}">
                                                            <button class="btn btn-light btn-block fa-lg gradient-custom-2 mb-3" type="button" style="border: 2px solid black;">Register an account</button>
                                                        </a>
                                                        <h3 class="mb-0 me-2">Register an account now to enjoy more benefits from jo salone</h3><br>
                                                        <h4 class="mb-0 me-2">✓ birthday benefits</h4><br>
                                                        <h4 class="mb-0 me-2">✓ yearly promotions</h4><br>
                                                        <h4 class="mb-0 me-2">✓ early bird products</h4>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6" style="border-left: 2px solid black;">
                                                <div class="card-body p-md-5 mx-md-4">
                                                    <div class="text-center pt-1 mb-5 pb-1">
                                                    <a href="{{ route('login') }}">
                                                            <button class="btn btn-light btn-block fa-lg gradient-custom-2 mb-3" type="button" style="border: 2px solid black;">Log in</button>
                                                        </a>
                                                        <h3 class="mb-0 me-2">Log in now to make booking and enjoy membership benefits!</h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</body>

</html>