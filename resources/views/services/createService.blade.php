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
                <div class="card text-black" style="border-radius:10px;">

                    <div class="card-header mb-1"> {{ 'Create service' }}</div>
                    <div class="card-body p-md-0 mx-md-5" style="text-align: center;">
                        <form method="post" enctype="multipart/form-data">
                            @csrf
                            <br>
                            <label style="width: 12%" for="name">Service Name:</label>
                            <input style="width: 50%" type="text" name="name" id="name" required>
                            <br>
                            <label style="width: 12%" for="price">Price:</label>
                            <input style="width: 50%" type="number" name="price" id="price" required>
                            <br>
                            <label style="width: 12%" for="description">Description:</label>
                            <textarea style="width: 50%" name="description" id="description" required></textarea>
                            <br>
                            <label style="width: 12%" for="image">Image:</label>
                            <input style="width: 50%" type="file" name="image" id="image">
                            <br>
                            <br>
                            <input type="submit" class="btn btn-primary btn-block fa-lg gradient-custom-2" value="Create Service">
                        </form>
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