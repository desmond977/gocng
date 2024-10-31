<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
{{-- {{var_dump($result['email'])}} --}}
@php
    // die;
@endphp

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

            <!-- Form Section -->
            <form action="{{ route('saveData') }}" method="POST" class="text-center">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="lableresult"> Salutations</label>
                        <input type="text" name="salutation"
                            value="{{ $result['salutation'] ? $result['salutation']['value'] : '' }}"
                            class="form-control"  readonly required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="lableresult"> First Name</label>
                        <input type="text" value="{{ $result['first_name'] ? $result['first_name']['value'] : '' }}"
                            name="first_name" class="form-control"  readonly required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="lableresult"> Last Name</label>
                        <input type="text"
                            value="{{ $result['last_name'] ? $result['last_name']['value'] : '' }}" class="form-control"
                            name="last_name" readonly required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="lableresult"> Gender </label>
                        <input type="text" value="{{ $result['gender_c'] ? $result['gender_c']['value'] : '' }}"
                            name="gender_c" class="form-control"  readonly required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="lableresult"> Phone Number</label>
                        <input type="tel" name="phone_mobile"
                            value="{{ $result['phone_mobile'] ? $result['phone_mobile']['value'] : '' }}"
                            class="form-control"  readonly required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="lableresult"> Email</label>
                        <input type="email" value="{{ $result['email1'] ? $result['email1']['value'] : '' }}"
                            name="email1" class="form-control"  readonly required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="lableresult"> Employment Status</label>
                        <input type="text"
                            value="{{ $result['employment_status_c'] ? $result['employment_status_c']['value'] : '' }}"
                            name="employment_status_c" class="form-control"  readonly required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="lableresult"> State</label>
                        <input type="text" name="state_c"
                            value="{{ $result['state_c'] ? $result['state_c']['value'] : '' }}" class="form-control"
                             readonly required>
                    </div>
                </div>

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label class="lableresult"> Age Range</label>
                        <input type="text"
                            value="{{ $result['age_range_c'] ? $result['age_range_c']['value'] : '' }}"
                             class="form-control" name="age_range_c" readonly required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="lableresult"> Vehicle Make</label>
                        <input type="text"
                            value="{{ $result['vehicle_make_c'] ? $result['vehicle_make_c']['value'] : '' }}"
                             class="form-control"  name="vehicle_make_c" readonly required>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="lableresult"> Year of Manufacture</label>
                        <input type="text"
                            value="{{ $result['year_of_manufacture_c'] ? $result['year_of_manufacture_c']['value'] : '' }}"
                             class="form-control"  name="year_of_manufacture_c" readonly required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="lableresult"> Vehicle Reg number</label>
                        <input type="text"
                            value="{{ $result['vehicle_registration_number_c'] ? $result['vehicle_registration_number_c']['value'] : '' }}"
                             class="form-control" name="vehicle_registration_number_c"  readonly required>
                    </div>
                </div>

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label class="lableresult"> Vehicle Vin Number</label>
                        <input type="text"
                            value="{{ $result['vehicle_vin_c'] ? $result['vehicle_vin_c']['value'] : '' }}"
                             class="form-control" name="vehicle_vin_c" readonly required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="lableresult"> Date Entered</label>
                        <input type="text"
                            value="{{ $result['date_entered'] ? $result['date_entered']['value'] : '' }}"
                             class="form-control" name="date_entered"  readonly required>
                    </div>




                </div>



                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label class="lableresult"> Current Fuel Type</label>
                        <input type="text"
                            value="{{ $result['vehicle_current_fuel_type_c'] ? $result['vehicle_current_fuel_type_c']['value'] : '' }}"
                             class="form-control" name="vehicle_current_fuel_type_c" readonly required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="lableresult"> Place of work</label>
                        <input type="tel" name="workplace" class="form-control" id="workplace" placeholder="Your place of work "
                            required>
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label class="lableresult"> Type of Engine</label>
                        <select name="engine" class="form-control" id="engine">
                            <option value="" disabled selected>Choose an option</option>
                            <option value="V4 Engine"> V4 Engine</option>
                            <option value="V6 Engine"> V6 Engine</option>
                            <option value="V8 Engine"> V8 Engine</option>
                        </select>
                    </div>


                </div>
                <div class="mt-3">
                    <button type="submit" class="btn btn-primarycredit">Continue Credit Assesment</button>
                </div>
            </form>


        </div>
    </div>
</body>

</html>
