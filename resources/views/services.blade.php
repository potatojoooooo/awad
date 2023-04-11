<x-header></x-header>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services</title>
    <link rel="icon" type="image/x-icon" href="{{URL::asset('/image/about-us.jpg')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="container mt-4 h-100">
                <h1>Our Services</h1><br>
                @if(isset($services) && count($services) > 0)
                <h4>We offer a variety of beauty services to help you look and feel your best. Choose from the following:</h4><br>
                <ul class="list-group">

                    <li class="list-group-item">
                        <div class="d-flex justify-content-between">
                            <div>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th style="width: 30%">
                                                <h4>Service</h4>
                                            </th>
                                            <th style="width: 50%">
                                                <h4>Description</h4>
                                            </th>
                                            <th style="width: 20%">
                                                <h4>Price</h4>
                                            </th>
                                        </tr>
                                    </thead>
                                    @foreach($services as $service)
                                    <tbody>

                                        <tr>
                                            <td>
                                                <h5>{{$service->name}}</h5>
                                                <img src="data:image/png;base64,{{ base64_encode($service->image) }}" alt="{{ $service->name }}" width="100">

                                            </td>
                                            <td class="service-description">
                                                <h6>{{$service->description}}</h6>
                                            </td>
                                            <td>
                                                <h4>RM {{$service->price}}</h4>
                                                <a href="{{ route('booking.createBooking') }}">
                                                    <button type="button" class="btn btn-outline-dark mr-2">Book Now</button>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </li>
                </ul>
                @else
                <h4>No services available at the moment.</h4>
                @endif
            </div>

        </div>
    </div>
</body>
<x-footer></x-footer>

</html>