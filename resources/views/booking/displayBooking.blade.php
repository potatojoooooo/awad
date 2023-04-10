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
    <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
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
                            <th>Action</th>
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
                            <td>
                                @foreach ($booking->services as $service)
                                {{ $service->name }}
                                @if (!$loop->last)
                                <br>
                                @endif
                                @endforeach
                            </td>

                            <td>
                                <a href="{{ route('booking.updateBooking') }}">
                                    <button type="button" class="btn btn-outline-dark mr-2">update</button>
                                </a>

                                <!-- <button type="button" class="btn btn-outline-dark mr-2" data-toggle="modal" data-target="#deleteModal">delete</button> -->
                                <!-- <form action="{{ route('booking.deleteBooking', $booking->id)}}" >
                                                    @csrf
                                                    @method('deleteBooking')
                                                    <button type="submit" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">Delete</button>
                                                </form>

                                <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="demoModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Confirm Delete?</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure you want to delete this booking {{$booking -> id}}? </p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger"><a style="text-decoration: none; color: white;" href={{ "deleteBooking/".$booking -> id}}>Delete</a></button>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal" data-bookingid="{{ $booking->id }}">Delete</button>

                                <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="demoModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Confirm Delete?</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure you want to delete booking <span id="bookingId"></span>? </p>
                                            </div>
                                            <div class="modal-footer">
                                                <form id="deleteForm" action="{{ route('booking.deleteBooking', $booking->id)}}">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                </form>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <script>
                                    $('#deleteModal').on('show.bs.modal', function(event) {
                                        var button = $(event.relatedTarget);
                                        var bookingId = button.data('bookingid');
                                        var modal = $(this);
                                        modal.find('#bookingId').text(bookingId);
                                        modal.find('#deleteForm').attr('action', "{{ url('deleteBooking') }}/" + bookingId);
                                    });
                                </script>


                            </td>
                        </tr>

                        @endif
                        @endforeach
                        @else
                        <h4>No booking made at the moment.</h4>
                        @endif
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>