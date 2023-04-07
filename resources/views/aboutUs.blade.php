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
                <h1>About Us</h1>
                <div class="row">
                    <div class="col-md-6">
                        <h5>Jo Salone is a premier hair salon located in the heart of the city. We pride ourselves on providing exceptional service and creating a warm and welcoming atmosphere for our clients.</h5><br>
                        <h5>Our team of experienced stylists are passionate about helping you achieve the perfect look. We offer a full range of hair services, including haircuts, color, and styling, as well as nail and makeup services.</h5><br>
                        <h5>At Jo Salone, we believe that beauty starts from within. That's why we use only the best products, made from natural and organic ingredients, to keep your hair and skin healthy and glowing.</h5><br>
                        <h5>Visit us today and experience the Jo Salone difference!</h5>
                        <button type="button" class="btn btn-outline-dark mt-5">Make a booking now!</button>
                    </div>
                    <div class="col-md-6">
                        <img style="border: 2px solid black;" src="{{ asset('image/about-us.jpg') }}" alt="Jo Salone" class="img-fluid rounded mx-3 d-block">
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>