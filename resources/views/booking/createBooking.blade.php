<x-header></x-header>
<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Booking</title>
    <link rel="icon" type="image/x-icon" href="{{URL::asset('/image/logo.png')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>


<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="container mt-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-xl-10">
                        <div class="card text-black" style="border-radius:10px">
                            <div class="row g-0">
                                <div class="col-lg-6">
                                    <div class="card-header mb-4"> {{ isset($url) ? ucwords($url) : ""}} {{ __('Make An Appointment') }}</div>
                                    <div class="card-body p-md-0 mx-md-5">
                                        @isset($url)
                                        <form method="POST" action='{{ url("login/$url") }}' aria-label="{{ __('Login') }}">
                                            @else
                                            <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                                                @endisset
                                                @csrf
                                                <div class="form-outline mb-4">
                                                    <label for="date" class="form-label">{{ __('Select A Date') }}</label>

                                                    <input id="date" type="date" class="form-control @error('date') is-invalid @enderror" name="date" value="{{ old('date') }}" required autocomplete="date" autofocus>
                                                    @error('date')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror

                                                </div>
                                                <div class="form-outline mb-4">
                                                    <label for="time" class="form-label">{{ __('Select An Hour') }}</label>

                                                    <input id="time" type="time" class="form-control @error('password') is-invalid @enderror" name="time" required autocomplete="time">
                                                    @error('time')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror

                                                </div>

                                                <div class="form-outline mb-4">
                                                    <label for="text" class="form-label">{{ __('Enter Service ID') }}</label>

                                                    <input id="text" type="text" class="form-control @error('serviceID') is-invalid @enderror" name="serviceID" required autocomplete="serviceID">
                                                    @error('serviceID')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="serviceOptions">Select Your Desired Services</label>
                                                    <select multiple class="form-control" id="serviceOpions" name="selectedOptions[]">
                                                        <option value="option1">Service 1</option>
                                                        <option value="option2">Service 2</option>
                                                        <option value="option3">Service 3</option>
                                                        <option value="option4">Service 4</option>
                                                    </select>
                                                </div>

                                                <div>
                                                    @if(isset($selectedOptions))
                                                    Selected options: {{ implode(', ', $selectedOptions) }}
                                                    @endif
                                                </div>


                                                <div class="form-outline mb-4">
                                                    <label for="name" class="form-label">{{ __('Enter Your Name') }}</label>
                                                   
                                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" required autocomplete="name">
                                                    @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror

                                                </div>

                                                <div class="form-outline mb-4">
                                                    <label for="phone" class="form-label">{{ __('Enter Your Mobile Phone') }}</label>

                                                    <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" required autocomplete="phone">
                                                    @error('phone')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror

                                                </div>
                                                <div class="text-center pt-1 mt-5 mb-5 pb-1">
                                                    <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="submit">
                                                        {{ __('Create') }}
                                                    </button>
                                                </div>
                                            </form>
                                    </div>
                                </div>
                                <div class="col-sm-6 px-0 d-none d-sm-block">
                                    <div class="text-center">
                                        <h4 class="mt-3 mb-4 pb-1">Services</h4>
                                        <!-- <div style="border-bottom: 1px solid; width:50%;"></div> -->
                                    </div>
                                    <div class="text-left">
                                        <div class="mb-3">
                                            <img src="{{URL::asset('/image/haircut.jpg')}}" style="width: 99px; margin-right:5px;" alt="logo">
                                            Service 1: Cut | include wash & styling
                                        </div>
                                        <div class="mb-3">
                                            <img src="{{URL::asset('/image/perm.png')}}" style="width: 106px;" alt="logo">
                                            Service 2: Perm | include wash & styling
                                        </div>
                                        <div class="mb-3">
                                            <img src="{{URL::asset('/image/hairdye.jpg')}}" style="width: 110px;" alt="logo">
                                            Service 3: Color | include wash & styling
                                        </div>
                                        <div class="mb-3">
                                            <img src="{{URL::asset('/image/treatment.jpg')}}" style="width: 110px;" alt="logo">
                                            Service 4: Treatment | include wash & styling
                                        </div>
                                    </div>
                                    <div class="text-left" style="font-size:13px;margin-top:40px; margin-left:6px; margin-right:6px;">
                                        * Appointment are limited to 6 people per day.
                                        Please come with your own mask. Please keep
                                        social distancing. Please do not engage verbally
                                        with our assitants or ask them to get their mask off
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

</html>