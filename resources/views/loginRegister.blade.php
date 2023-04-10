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
                <div class="container py-5">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="card border-0">
                                <div class="row g-0">
                                    <div class="col-md-6 bg-light">
                                        <div class="card-body p-5">
                                            <h3 class="card-title">Register an account now to enjoy more benefits from Jo Salone</h3>
                                            <ul class="list-unstyled mt-4">
                                                <li><i class="bi bi-check2 me-2"></i>Birthday benefits</li>
                                                <li><i class="bi bi-check2 me-2"></i>Yearly promotions</li>
                                                <li><i class="bi bi-check2 me-2"></i>Early bird products</li>
                                            </ul>
                                            <a href="{{ route('register.user') }}" class="btn btn-primary btn-block mt-4">Register an account</a>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card-body p-5">
                                            <h3 class="card-title">Log in now to make booking and enjoy membership benefits!</h3>
                                            <a href="{{ route('login') }}" class="btn btn-light btn-block mt-4">Log in</a>
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
<x-footer></x-footer>

</html>