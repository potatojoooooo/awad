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
                <h1>Our Services</h1><br>
                <h4>We offer a variety of beauty services to help you look and feel your best. Choose from the following:</h4><br>
                <ul class="list-group">
                    @foreach($services as $service)
                    <li class="list-group-item">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h4>{{$service -> name}}</h4>
                                <h5>RM {{$service -> price}}</h5>
                                <h5>{{$service -> description}}</h5>
                            </div>
                            <button type="button" class="btn btn-outline-dark mr-2">book now</button>
                        </div>
                    </li>
                    @endforeach
                </ul>

            </div>
        </div>
    </div>
</body>

</html>