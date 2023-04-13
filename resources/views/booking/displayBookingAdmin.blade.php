<x-header></x-header>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Bookings</title>
    <link rel="icon" type="image/x-icon" href="{{URL::asset('/image/logo.png')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="container mt-4 h-100">
                <div class="d-flex justify-content-between align-items-center">
                    <h1>View All Bookings</h1>

                </div>

                @if(session('bookSuccess'))
                <div class="alert alert-success">{{ session('bookSuccess') }}</div>
                @elseif(session('deleteSuccess'))
                <div class="alert alert-success">{{ session('deleteSuccess') }}</div>
                @elseif(session('updateSuccess'))
                <div class="alert alert-success">{{ session('updateSuccess') }}</div>
                @endif
                <table class="table mt-4">
                    <thead>
                        <tr>
                            <th>Booking ID</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>User ID</th>
                            <th>Services</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(session()->has('admin_id'))
                        @if(isset($bookings) && count($bookings) > 0)
                        @foreach($bookings as $booking)
                        @if($booking-> userID)
                        <tr>
                            <td>{{$booking -> id}}</td>
                            <td>{{$booking -> date}}</td>
                            <td>{{$booking -> time}}</td>
                            <td>{{$booking -> userID}}</td>
                            <td>
                                @foreach ($booking->services as $service)
                                {{ $service->name }}
                                @if (!$loop->last)
                                <br>
                                @endif
                                @endforeach
                            </td>

                            <td>
                                @if(auth()->guard('admin')->check())

                                <a href="{{ route('booking.editBooking', $booking->id) }}">
                                    <button type="button" class="btn btn-outline-dark mr-2">Update</button>
                                </a>

                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal" data-bookingid="{{ $booking->id }}">Delete</button>

                                @endif

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
                                                @if(auth()->guard('admin')->check())

                                                <form id="deleteForm" action="{{ route('booking.delete', ['id' => $booking->id]) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                </form>
                                                @endif

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
                                        modal.find('#deleteForm').attr('action', "{{ route('booking.delete', ['id' => $booking->id]) }}".replace(':id', bookingId));
                                    });
                                </script>
                            </td>
                        </tr>

                        @endif
                        @endforeach
                        @else
                        <h4>No bookings available!</h4>
                        @endif
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>