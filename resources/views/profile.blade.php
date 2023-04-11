<x-header></x-header>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="icon" type="image/x-icon" href="{{URL::asset('/image/about-us.jpg')}}">
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
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-4">Account Details</h5>
                            @if(session()->has('user_id'))
                                @foreach($user as $userDetail)
                                <div class="row mb-3">
                                    <div class="col-sm-4">
                                        <p class="mb-0"><strong>Name</strong></p>
                                    </div>
                                    <div class="col-sm-8">
                                        <p class="text-muted mb-0">{{$userDetail -> name}}</p>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-4">
                                        <p class="mb-0"><strong>Email</strong></p>
                                    </div>
                                    <div class="col-sm-8">
                                        <p class="text-muted mb-0">{{$userDetail -> email}}</p>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-4">
                                        <p class="mb-0"><strong>Phone number</strong></p>
                                    </div>
                                    <div class="col-sm-8">
                                        <p class="text-muted mb-0">{{$userDetail -> phone}}</p>
                                    </div>
                                </div>
                                @endforeach
                            @endif
                            @if(session()->has('admin_id'))
                                @foreach($admin as $adminDetail)
                                <div class="row mb-3">
                                    <div class="col-sm-4">
                                        <p class="mb-0"><strong>Name</strong></p>
                                    </div>
                                    <div class="col-sm-8">
                                        <p class="text-muted mb-0">{{$adminDetail -> name}}</p>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-4">
                                        <p class="mb-0"><strong>Email</strong></p>
                                    </div>
                                    <div class="col-sm-8">
                                        <p class="text-muted mb-0">{{$adminDetail -> email}}</p>
                                    </div>
                                </div>
                                @endforeach
                            @endif
                            <div class="row justify-content-between mt-5">
                                <div class="col-sm-6">
                                    <a href="{{ route('logout') }}" class="btn btn-lg btn-danger w-100">Log out</a>
                                </div>
                                <div class="col-sm-6">
                                    <a href="{{ route('booking.displayBooking') }}" class="btn btn-lg btn-secondary w-100">View bookings</a>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-sm-12">
                                    <a href="{{ route('logout') }}" class="btn btn-lg btn-outline-danger w-100">Delete account</a>
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