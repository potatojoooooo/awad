<x-header></x-header>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="icon" type="image/x-icon" href="{{ URL::asset('image/about-us.jpg') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="container mt-4 h-100">
                <div class="jumbotron jumbotron-fluid bg-transparent">
                    <div class="container-fluid text-center has-bg-img ">
                        @if(session('message'))
                        <div class="alert alert-success">{{ session('message') }}</div>
                        <h1 class="display-4">Welcome to Jo Salone, Guest!</h1>
                        @elseif(session('deleteUser'))
                        <div class="alert alert-success">{{ session('deleteUser') }}</div>
                        <h1 class="display-4">Welcome to Jo Salone, Guest!</h1>
                        @elseif(session('deleteAdmin'))
                        <div class="alert alert-success">{{ session('deleteAdmin') }}</div>
                        <h1 class="display-4">Welcome to Jo Salone, Guest!</h1>
                        @elseif(Auth::guard('admin')->check())
                        <h1 class="display-4">Welcome to Jo Salone, {{ session('admin_name') }}!</h1>
                        <p class="lead">for him, for her.</p>
                        @elseif(Auth::guard('web')->check())
                        <h1 class="display-4">Welcome to Jo Salone, {{ session('user_name') }}!</h1>
                        <p class="lead">for him, for her.</p>
                        @else
                        <h1 class="display-4">Welcome to Jo Salone, Guest!</h1>
                        <p class="lead">for him, for her.</p>
                        @endif
                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" data-interval="2000">
                            <ol class="carousel-indicators">
                                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img class="d-block w-100" src="{{ asset('image/about-us.jpg') }}" alt="First slide">
                                </div>
                                <div class="carousel-item">
                                    <img class="d-block w-100" src="{{ asset('image/login.jpg') }}" alt="Second slide">
                                </div>
                                <div class="carousel-item">
                                    <img class="d-block w-100" src="{{ asset('image/salon-background.jpg') }}" alt="Third slide">
                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<x-footer></x-footer>

</html>