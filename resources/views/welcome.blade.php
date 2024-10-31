<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>GO CNG</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <!-- Styles -->

</head>

<body class="antialiased">

    <div class="container mt-5">
        <div class="centered-wrapper">
        <!-- Image Section -->
        <div class="text-center mb-4">
            <img src="{{ asset('gocng-logo.png') }}" alt="Search Image" class="img-fluid" style="max-width: 230px;">
        </div>

        <!-- Form Section -->
        <form action=" {{ route('formpage') }}" method="GET" class="text-center">
            @csrf
            <div class="mb-3">
                <input type="text" name="phone" class="form-control" placeholder="Please Enter Your Phone Number.." style="width: 300px; padding: 10px;" required >
            </div>

            <button type="submit" class="btn btn-primary">
                Search <i class="fas fa-search ml-2"></i>
            </button>

         </form>
    </div>
</div>
</body>

</html>
