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
                        <img class="img-fluid rounded mx-3 d-block bg-img" src="{{ asset('image/salon-background.jpg') }}" alt="Jo Salone"><br>
                        <!-- <a href="{{ route('booking.createBooking') }}" class="btn btn-lg btn-outline-dark">Make an appointment now</a> -->
                        @elseif(Auth::guard('admin')->check())
                        <h1 class="display-4">Welcome to Jo Salone, {{ session('admin_name') }}!</h1>
                        <p class="lead">for him, for her.</p>
                        <img class="img-fluid rounded mx-3 d-block bg-img" src="{{ asset('image/salon-background.jpg') }}" alt="Jo Salone"><br>
                        <!-- <a href="{{ route('booking.createBooking') }}" class="btn btn-lg btn-outline-dark">Make an appointment now</a> -->
                        <!-- <a href="{{ route('logout') }}" class="btn btn-lg btn-outline-dark">Log out</a> -->
                        @elseif(Auth::guard('web')->check())
                        <h1 class="display-4">Welcome to Jo Salone, {{ session('user_name') }}!</h1>
                        <p class="lead">for him, for her.</p>
                        <img class="img-fluid rounded mx-3 d-block bg-img" src="{{ asset('image/salon-background.jpg') }}" alt="Jo Salone"><br>
                        <!-- <a href="{{ route('booking.displayBooking') }}" class="btn btn-lg btn-outline-dark">Display appointment made</a>
                        <a href="{{ route('logout') }}" class="btn btn-lg btn-outline-dark">Log out</a> -->
                        @else
                        <h1 class="display-4">Welcome to Jo Salone, Guest!</h1>
                        <p class="lead">for him, for her.</p>
                        <img class="img-fluid rounded mx-3 d-block bg-img" src="{{ asset('image/salon-background.jpg') }}" alt="Jo Salone"><br>
                        <!-- <a href="{{ route('booking.createBooking') }}" class="btn btn-lg btn-outline-dark">Make an appointment now</a> -->
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<x-footer></x-footer>
</html>