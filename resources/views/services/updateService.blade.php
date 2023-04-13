<x-header></x-header>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Booking</title>
    <link rel="icon" type="image/x-icon" href="{{URL::asset('/image/about-us.jpg')}}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.min.css">
</head>

<body>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-6 mt-5">
                <div class="card text-black" style="border-radius:10px;">
                    <div class="card-header mb-1"> {{ 'Update service' }}</div>
                    <div class="card-body p-md-0 mx-md-5">
                        <form method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="name">Service Name:</label>
                                <input type="text" class="form-control" name="name" id="name" value="{{ $service->name }}" required>
                            </div>
                            <div class="form-group">
                                <label for="price">Price:</label>
                                <input type="number" class="form-control" name="price" id="price" value="{{ $service->price }}" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Description:</label>
                                <textarea class="form-control card-text" name="description" id="description" required>{{ $service->description }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="image">Image:</label>
                                <input type="file" class="form-control-file" name="image" id="image">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block btn-lg">Update Service</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js"></script>

</body>
<x-footer></x-footer>
</html>
