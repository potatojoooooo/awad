<x-header></x-header>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" type="image/x-icon" href="{{URL::asset('/image/logo.png')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="container mt-4 h-100">
                <div class="jumbotron jumbotron-fluid bg-transparent">
                    <div class="container-fluid text-center has-bg-img ">
                        <h1 class="display-4 ">Welcome to Jo Salone</h1>
                        <p class="lead ">for him, for her.</p>
                        <img class="img-fluid rounded mx-3 d-block bg-img" src="{{ asset('image/salon-background.jpg') }}" alt="Jo Salone"><br>
                        <a href="" class="btn btn-lg btn-outline-dark">Make an appointment now</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</body>

</html>