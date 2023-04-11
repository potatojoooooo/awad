<x-header></x-header>
<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Booking</title>
    <link rel="icon" type="image/x-icon" href="{{URL::asset('/image/about-us.jpg')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js"></script>

</head>


<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="container mt-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-xl-10">
                    <div class="card text-black" style="border-radius:10px;">
                            <div class="row g-0">
                                <div class="col-lg-6">
                                    <div class="card-header mb-1"> {{ isset($url) ? ucwords($url) : ""}} {{ __('Make An Appointment') }}</div>
                                    <div class="card-body p-md-0 mx-md-5">
                                        <div class="text-center">
                                            <img src="{{URL::asset('/image/about-us.jpg')}}" style="width: 185px;" alt="logo">
                                        </div>

                                        @isset($url)
                                        <form method="POST" action="createBooking" aria-label="{{ __('CreateBooking') }}">
                                            @else
                                            <form method="POST" action="createBooking" aria-label="{{ __('CreateBooking') }}">
                                                @endisset
                                                @csrf
                                                <div class="form-outline mb-4 mt-5">

                                                    <label for="date" class="form-label">{{ __('Select A Date') }}</label>

                                                    <input id="date" type="date" class="form-control @error('date') is-invalid @enderror" name="date">
                                                    @error('date')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror

                                                </div>
                                                <div class="form-outline mb-4">
                                                    <label for="time" class="form-label">{{ __('Select An Hour') }}</label>

                                                    <input id="time" type="time" class="form-control @error('time') is-invalid @enderror" name="time">
                                                    @error('time')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror

                                                </div>

                                                <div class="form-outline mb-4">
                                                    <label for="serviceID" class="form-label">{{ __('Select Service ID') }}</label>
                                                    <div class="form-group">
                                                        <select name="services[]" id="services" class="selectpicker form-control @error('serviceID') is-invalid @enderror" multiple data-max-options="4">
                                                            @foreach($services as $service)
                                                            <option value="{{ $service->id }}" {{ in_array($service->id, old('services', [])) ? 'selected' : '' }}>{{ $service->id }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    @error('serviceID')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>

                                                <script>
                                                    // Get the select element
                                                    const selectElement = document.getElementById('serviceID');

                                                    // Add an event listener to the select element to listen for changes
                                                    selectElement.addEventListener('change', () => {
                                                        // Get the selected values
                                                        const selectedValues = Array.from(selectElement.selectedOptions, option => option.value);
                                                    });
                                                </script>

                                                <div class="text-center pt-1 mt-5 mb-5 pb-1">
                                                    <button class="btn btn-primary btn-block fa-lg gradient-custom-2" type="submit">
                                                        {{ __('Create') }}
                                                    </button>
                                                </div>
                                            </form>
                                    </div>
                                </div>
                                <div class="col-sm-6 px-0 d-none d-sm-block">
                                    <div class="text-center">
                                        <h4 class="mt-3 mb-5 pb-1">Services</h4>
                                    
                                    @if(isset($services) && count($services) > 0)
                                    <div class="text-left">
                                    <h6>We offer a variety of beauty services to help you look and feel your best. Choose from the following:</h6><br>
                                    </div>
                                    <ul class="list-group">
                                        @foreach($services as $service)
                                            <div class="d-flex flex-column justify-content-between">
                                                <div>
                                                    <img src="data:image/png;base64,{{ base64_encode($service->image) }}" alt="{{ $service->name }}" width="100">
                                                </div>
                                                <div>
                                                    <h5>Service {{$service -> id}}</h5>
                                                    <h6>{{$service -> name}}</h6>
                                                </div>
                                            </div>
                                        @endforeach
                                    </ul>
                                    @else
                                    <h4>No services available at the moment.</h4>
                                    @endif
                                    </div>
                                    <div class="d-flex flex-column text-justify justify-content-between mt-6">
                                        <h6>* Appointment are limited to 6 people per day.<br>
                                        Please come with your own mask. <br>Please keep
                                        social distancing. <br>Please do not engage verbally
                                        with our assitants or ask them <br>to get their mask off</h6>
                                    </div>
                                </div>
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