<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<div class="mt-5" style="border-bottom: 3px solid lightgray">
    <div class="container mb-2">
        <div class="d-flex justify-content-between">
            <div class="salon-name">
                <h1>jo salone</h1>
            </div>
            <div class="d-inline-flex">
                @if(session()->has('user_id'))
                <a href="{{ route('profile.user', ['id' => session()->get('user_id')]) }}">
                    <button type="button" class="btn" style="border: none; font-size: 35px">
                        <i class="fa fa-user" aria-hidden="true"></i>
                    </button>
                </a>
                @elseif(session()->has('admin_id'))
                <a href="{{ route('profile.admin', ['id' => session()->get('admin_id')]) }}">
                    <button type="button" class="btn" style="border: none; font-size: 35px">
                        <i class="fa fa-user" aria-hidden="true"></i>
                    </button>
                </a>
                @else
                <a href="{{ route('loginRegister') }}">
                    <button type="button" class="btn" style="border: none; font-size: 35px">
                        <i class="fa fa-user" aria-hidden="true"></i>
                    </button>
                </a>
                @endif

            </div>

        </div>
        <ul id="nav" class="nav d-flex justify-content-between mt-5">
            @if(session()->has('user_id'))
            <li><a class="btn btn-link text-dark" href="{{ route('home.user', ['id' => session()->get('user_id')]) }}">
                    <h4>home</h4>
                </a></li>
            <li><a class="btn btn-link text-dark" href="{{ route('services.user', ['id' => session()->get('user_id')]) }}">
                    <h4>services</h4>
                </a></li>
            <li><a class="btn btn-link text-dark" href="{{ route('booking.user', ['id' => session()->get('user_id')]) }}">
                    <h4>bookings</h4>
                </a></li>
            <li><a class="btn btn-link text-dark" href="{{ route('aboutus') }}">
                    <h4>about us</h4>
                </a></li>
            <li><a class="btn btn-link text-dark" href="{{ route('contactus') }}">
                    <h4>contact us</h4>
                </a></li>
            @elseif(session()->has('admin_id'))
            <li><a class="btn btn-link text-dark" href="{{ route('home.admin', ['id' => session()->get('admin_id')]) }}">
                    <h4>home</h4>
                </a></li>
            <li><a class="btn btn-link text-dark" href="{{ route('services.admin', ['id' => session()->get('admin_id')]) }}">
                    <h4>services</h4>
                </a></li>
            <li><a class="btn btn-link text-dark" href="{{ route('booking.admin') }}">
                    <h4>bookings</h4>
                </a></li>
            <li><a class="btn btn-link text-dark" href="{{ route('aboutus') }}">
                    <h4>about us</h4>
                </a></li>
            <li><a class="btn btn-link text-dark" href="{{ route('contactus') }}">
                    <h4>contact us</h4>
                </a></li>
            @else
            <li><a class="btn btn-link text-dark" href="{{ route('home') }}">
                    <h4>home</h4>
                </a></li>
            <li><a class="btn btn-link text-dark" href="{{ route('services') }}">
                    <h4>services</h4>
                </a></li>
            <li><a class="btn btn-link text-dark" href="{{ route('booking.user') }}">
                    <h4>bookings</h4>
                </a></li>
            <li><a class="btn btn-link text-dark" href="{{ route('aboutus') }}">
                    <h4>about us</h4>
                </a></li>
            <li><a class="btn btn-link text-dark" href="{{ route('contactus') }}">
                    <h4>contact us</h4>
                </a></li>
                @endif
        </ul>

    </div>
</div>