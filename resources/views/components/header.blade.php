
<head><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"></head>
<div class="mt-5" style="border-bottom: 3px solid lightgray">
    <div class="container mb-2">
        <div class="d-flex justify-content-between">
            <div class="salon-name">
                <h1>jo salone</h1>
            </div>
            <div class="d-inline-flex">
                <button type="button" class="btn btn-outline-dark mr-2">book</button>
                <button type="button" class="btn" style="border: none; font-size: 35px"><i class="fa fa-user" aria-hidden="true"></i></button>
            </div>

        </div>
        <div class="nav-bar ">
            <ul id="nav" class="nav d-flex justify-content-between mt-5">
                <li><a class="btn btn-link text-dark" href="{{ route('home') }}">
                        <h4>home</h4>
                    </a></li>
                <li><a class="btn btn-link text-dark" href="">
                        <h4>services</h4>
                    </a></li>
                <li><a class="btn btn-link text-dark" href="">
                        <h4>bookings</h4>
                    </a></li>
                <li><a class="btn btn-link text-dark" href="{{ route('aboutus') }}">
                        <h4>about us</h4>
                    </a></li>
                <li><a class="btn btn-link text-dark" href="{{ route('contactus') }}">
                        <h4>contact us</h4>
                    </a></li>
            </ul>
        </div>
    </div>
</div>