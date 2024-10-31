<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Gocng Formpage</title>

    <!-- Fonts -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <!-- Styles -->

</head>

<body class="antialiased">

    <div class="containerformpage mt-5">
        <div class="centered-wrapperformpage">
            <!-- Image Section -->
            <div class="text-center mb-4">
                <img src="{{ asset('gocng-logo.png') }}" alt="Search Image" class="img-fluid" style="max-width: 230px;">
            </div>

            <!-- field Section -->

            <div class=" fulltext">
                <h1 class="fivecylinder"> Cost of conversion: N1,200,000.00</h1>
                <h1 class="fourcylinder"> Cost of conversion: N950,000.00</h1>

            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <input type="tel" name="Phone" class="form-control" placeholder="Your Monthly Salary Amount" id=" ">
                </div>
                <div class="col-md-6 mb-3">
                    <input type="tel" name="Phone" class="form-control" placeholder="Your Down Payment/Equity" id=" ">
                </div>
            </div>
            <button type="submit" class="btn btn-primarycredit">Check Eligibily</button>

            <div class="notetext">
                {{-- <h3> Note: </h3> --}}
                <input type="text" name="Note" id="" placeholder="Note" class="note"> </textarea>
            </div>

          <div class="elitextsreslt">
            <div class="eligtext">
               <h3> Your are Eligible for this amount: 390,000,00 based on your monthly income</h3>
            </div>

            <div class="eligtext">
                <h3> You can increase your equity to: 390,000,00 to increace your chance of acceptance</h3>
             </div>
            </div>

        </div>
    </div>
    <!--note area-->




</body>

</html>
