<x-header></x-header>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="icon" type="image/x-icon" href="{{URL::asset('/image/logo.png')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="container mt-4 h-100">
                <div class="row justify-content-center">
                    <div class="col-lg-8 mt-4">
                        <h1>Profile</h1>
                        <br>
                        <section style="background-color: #eee;">
                            <div class="container py-5">
                                <div class="row justify-content-center">
                                    <div class="col-lg-12">
                                        <div class="card mb-4">
                                            <div class="card-body text-center">
                                                
                                                <h5 class="my-3">Account Details</h5>
                                                <div class="card mb-4">
                                                    <div class="card-body">
                                                        @foreach($user as $userDetail)
                                                        <div class="row">
                                                            <div class="col-sm-3">
                                                                <p class="mb-0">Name</p>
                                                            </div>
                                                            <div class="col-sm-9">
                                                                <p class="text-muted mb-0">{{$userDetail -> name}}</p>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="col-sm-3">
                                                                <p class="mb-0">Email</p>
                                                            </div>
                                                            <div class="col-sm-9">
                                                                <p class="text-muted mb-0">{{$userDetail -> email}}</p>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="col-sm-3">
                                                                <p class="mb-0">Phone number</p>
                                                            </div>
                                                            <div class="col-sm-9">
                                                                <p class="text-muted mb-0">{{$userDetail -> name}}</p>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        @endforeach
                                                        <a href="{{ route('logout') }}" class="btn btn-lg btn-outline-dark">Log out</a>
                                                        <a href="{{ route('logout') }}" class="btn btn-lg btn-outline-dark">View bookings</a>
                                                        <a href="{{ route('logout') }}" class="btn btn-lg btn-outline-dark">Delete account</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
