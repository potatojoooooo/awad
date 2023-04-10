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
                <h1>View bookings</h1>
                <table class="table mt-4">
                    <thead>
                        <tr>
                            <th>Booking ID</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Services</th>
                            <th>Delete / Update</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(session()->has('user_id'))
                            @if(isset($bookings) && count($bookings) > 0)
                                @foreach($bookings as $booking)
                                    @if($booking->userID == session('user_id'))
                                    <tr>
                                        <td>{{$booking -> id}}</td>
                                        <td>{{$booking -> date}}</td>
                                        <td>{{$booking -> time}}</td>
                                        <td>{{$booking -> serviceID}}</td>
                                        <td>
                                            <a href="{{ route('booking.updateBooking') }}">
                                                <button type="button" class="btn btn-outline-dark mr-2">update</button>
                                            </a>
                                            <button type="button" class="btn btn-outline-dark mr-2">delete</button>
                                        </td>
                                    </tr>
                                    @endif
                                @endforeach
                                @else
                                <h4>Please register or log in to existing account to view bookings!</h4>
                            @endif
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>