<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Gocng Formpage</title>

    <!-- Fonts -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>

<body class="antialiased">

    {{-- @php
    $conversionCost = request('conversion_cost'); // Capture the conversion cost from the query parameter
@endphp --}}

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @php
        // Retrieve data from session
        $salary = session('salary', '');
        $downPayment = session('down_payment', '');
        $conversionCost = session('conversion_cost', 0);
        $eligibleAmount = session('eligible_amount', 0);
        $newEquity = session('new_equity', 0);
    @endphp

    @php
        $conversionCost = request('conversion_cost'); // Capture the conversion cost from the query parameter
    @endphp


    <div class="container formpage mt-5">
        <div class="centered-wrapper formpage">
            <form action="{{ route('check-eligibility') }}" method="POST">
                @csrf
                <!-- Image Section -->
                <div class="text-center mb-4">
                    <img src="{{ asset('gocng-logo.png') }}" alt="Search Image" class="img-fluid"
                        style="max-width: 230px; padding-top:50px;">
                </div>

                <!-- Cost of Conversion Section -->
                <input type="hidden" name="conversion_cost" value="{{ $conversionCost }}">


                <div class="fulltext">
                    <h1 id="conversionCostText" style=" padding-bottom: 35px;">
                        Cost of conversion: N{{ number_format($conversionCost) }}</h1>
                </div>

                <!-- Input Section -->
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label style="margin-right: 58px; color: #787775;">Your Monthly Salary</label>
                        <input type="number" name="salary" class="form-control"
                            placeholder="Your Monthly Salary Amount" id="salary" value="{{ $salary }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label style="margin-right: 58px; color: #787775;">Your Down Payment</label>
                        <input type="number" name="down_payment" id="downPayment" class="form-control"
                            placeholder="Your Down Payment/Equity" value="{{ $downPayment }}">
                    </div>
                </div>

                <button type="button" id="checkEligibility" onclick="calculateEligibility()"
                    class="btn btn-primary credit">Check Eligibility</button>


                <!-- Results Section -->
                <div class="elitextsresult mt-3">
                    <div class="eligtext">
                        <h3 id="eligibleAmount">You are Eligible for this amount: N{{ number_format($eligibleAmount) }}
                            based on your monthly income</h3>
                    </div>

                    <div class="eligtext">
                        <h3 id="newEquity">You can increase your equity to: N{{ number_format($newEquity) }} to
                            increase
                            your chance of acceptance</h3>
                    </div>
                </div>



                <input type="hidden" name="_id" value="{{ $result['id'] ? $result['id']['value'] : '' }}">
                <input type="hidden" name="apply_now" value="true">
                <div id="applyNowButton" style="display: none;">
                    <button type="submit" class="btn btn-primary credit">Apply Now</button>
                </div>


            </form>

        </div>
    </div>
    <script>
        // Pre-fill values using data passed from the session
        const costOfConversion = parseFloat("{{ $conversionCost }}") || 0;

        function calculateEligibility() {
            const downPayment = parseFloat(document.getElementById("downPayment").value) || 0;
            const salary = parseFloat(document.getElementById("salary").value) || 0;
            const eligibleAmount = (salary * 0.3) * 12;
            const newEquity = costOfConversion - eligibleAmount;

            document.getElementById("eligibleAmount").innerHTML =
                `You are Eligible for this amount: N${eligibleAmount.toLocaleString()} based on your monthly income`;
            document.getElementById("newEquity").innerHTML =
                `Please increase your equity to be eligible to apply. You can increase your equity to: N${newEquity.toLocaleString()} to increase your chance of acceptance`;

            // Show/hide the "Apply Now" button based on down payment and new equity
            const applyButton = document.getElementById("applyNowButton");

            if (downPayment >= newEquity) {
                applyButton.style.display = 'block'; // Show the Apply Now button
                // Show SweetAlert encouraging the user to apply
                Swal.fire({
                    icon: 'success',
                    title: 'You are eligible!',
                    text: 'You meet the equity requirements. Please click "Apply Now" to proceed with your application.',
                    confirmButtonText: 'Got it!'
                });
            } else {
                applyButton.style.display = 'none'; // Hide the Apply Now button

                // Replace the alert with SweetAlert
                Swal.fire({
                    icon: 'warning',
                    title: 'Increase Your Equity!',
                    text: `You can increase your equity to: N${newEquity.toLocaleString()} to increase your chance of acceptance.`,
                    confirmButtonText: 'Got it!'
                });
            }

        }
    </script>

</body>

</html>
