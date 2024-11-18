<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\Used;

class AppController extends Controller
{
    //
    //     public function saveData(Request $request)
    //     {
    //     //     // Validate incoming request data
    //     //     // return $request;
    //     //     $validatedData=$request->all();
    //     //     // $validatedData = $request->validate([
    //     //     //     'salutation' => 'required|string|max:10',
    //     //     //     'first_name' => 'required|string|max:255',
    //     //     //     'last_name' => 'required|string|max:255',
    //     //     //     'gender_c' => 'required|string|max:10',
    //     //     //     'phone_mobile' => 'required|string|max:15',
    //     //     //     'email1' => 'required|email',
    //     //     //     'employment_status_c' => 'required|string|max:10',
    //     //     //     'state_c' => 'required|string|max:20',
    //     //     //     'age_range_c' => 'required|string|max:20',
    //     //     //     'vehicle_make_c' => 'required|string|max:30',
    //     //     //     'year_of_manufacture_c' => 'required|string|max:30',
    //     //     //     'vehicle_registration_number_c' => 'required|string|max:30',
    //     //     //     'vehicle_vin_c' => 'required|string|',
    //     //     //     'date_entered' => 'required|string|',
    //     //     //     'workplace' => 'required|string|',
    //     //     // ]);

    //     //     // return $validatedData;

    //     //     // Combine existing data (from API) with new inputs
    //     //     $userData = [
    //     //         'salutation' => $validatedData['salutation'],
    //     //         'first_name' => $validatedData['first_name'],
    //     //         'last_name' => $validatedData['last_name'],
    //     //         'gender_c' => $validatedData['gender_c'],
    //     //         'phone_mobile' => $validatedData['phone_mobile'],
    //     //         'email1' => $validatedData['email1'], // Mapping 'email1' to 'email'
    //     //         'employment_status_c' => $validatedData['employment_status_c'],
    //     //         'state_c' => $validatedData['state_c'],
    //     //         'age_range_c' => $validatedData['age_range_c'],
    //     //         'vehicle_current_fuel_type_c' => $validatedData['vehicle_current_fuel_type_c'],
    //     //         'vehicle_make_c' => $validatedData['vehicle_make_c'],
    //     //         'year_of_manufacture_c' => $validatedData['year_of_manufacture_c'],
    //     //         'vehicle_registration_number_c' => $validatedData['vehicle_registration_number_c'],
    //     //         'vehicle_vin_c' => $validatedData['vehicle_vin_c'],
    //     //         'date_entered' => $validatedData['date_entered'],
    //     //         'workplace' => $validatedData['workplace'],
    //     //         'engine' => $validatedData['engine'],
    //     //     ];

    //     //     // Save the combined data
    //     //     $user = Used::updateOrCreate(
    //     //         ['email' => $userData['email1']], // Find user by email
    //     //         $userData // Update or create with all combined data
    //     //     );



    //     //     // Redirect to a confirmation or another page, e.g., 'thank you' page
    //     //     return redirect()->route('eligibility')->with('success', 'Data processed , you can now check your Eligibilty');
    //     // }



    // }
         public function saveData(Request $request)
{
        // Validate incoming request data
        $validatedData = $request->all();

         // Define engine types and their costs
    $engineCosts = [
        'V4 Engine' => 950000,
        'V6 Engine' => 1200000,
        'V8 Engine' => 1400000,
    ];

    // Retrieve selected engine type and get the conversion cost
    $selectedEngine = $validatedData['engine'];
    $conversionCost = $engineCosts[$selectedEngine] ?? 0;

    // Prepare data for the API request
    $apiData = [
        '_id' => $validatedData['_id'] ?? null,
        'place_of_work' => $validatedData['place_of_work'],
        'engine' => $selectedEngine,
        'pass' => '8xhlYx_94{e$',
    ];
        if (is_null($apiData['_id'])) {
            return redirect()->route('formpage')->with('error', 'User ID (_id) is required to update data.');
        }


        // Send a POST request to the external API
        $response = Http::asForm()
            ->post('https://datastore.oncloud.com.ng/payload/update/', $apiData);

            if ($response->successful()) {
                // Redirect to eligibility route with the conversion cost as a query parameter
                return redirect()->route('eligibility', ['conversion_cost' => $conversionCost])
                    ->with('success', 'Data updated successfully; you can now check your eligibility.');
            } else {
                return redirect()->route('eligibility')->with('error', 'Failed to update data.');
            }
    }

    public function checkEligibility(Request $request)
{
    // Validate the request data
    $validatedData = $request->all();


    // Prepare the API payload
    $apiData = [
        '_id' => $validatedData['_id'] ?? null,
        'salary' => $validatedData['salary'],
        'equity' => $validatedData['down_payment'],
        'apply_now' => $validatedData['apply_now'],
        'pass' => '8xhlYx_94{e$',
    ];

    // Send the POST request to the external API
    $response = Http::asForm()
    ->post('https://datastore.oncloud.com.ng/payload/eligibility/', $apiData);

    // Log response details for debugging
    Log::info('API Response Status:', ['status' => $response->status()]);
    Log::info('API Response Body:', ['body' => $response->body()]);

    // Calculate eligible amount and new equity
    $salary = floatval($validatedData['salary'] ?? 0);
    $conversionCost = floatval($request->input('conversion_cost'));
    $eligibleAmount = ($salary * 0.3) * 12;
    $newEquity = $conversionCost - $eligibleAmount;

    session([
        'salary' => $validatedData['salary'],
        'down_payment' => $validatedData['down_payment'],
        'conversion_cost' => $conversionCost,
        'eligible_amount' => $eligibleAmount,
        'new_equity' => $newEquity,
    ]);

    // Check the response from the API
    if ($response->successful()) {
        // Redirect to the welcome route without the conversion cost parameter
        return redirect()->route('welcome')
            ->with('success', 'Congrats! Your application was successful. Our team will contact you soon.');
    } else {
        return redirect()->route('eligibility')
            ->with('error', 'Failed to check eligibility.');
    }

}

// public function applyNow(Request $request)
// {
//     // Validate the request, allowing _id to be nullable for testing
//     $validatedData = $request->validate([
//         '_id' => 'nullable|string',
//         'apply_now' => 'required|boolean',
//         'pass' => 'required|string',
//     ]);

//     if (empty($validatedData['_id'])) {
//         return redirect()->route('eligibility')->with('error', 'The application cannot be processed without a valid ID.');
//     }

//     // Prepare the API payload
//     $apiData = [
//         '_id' => $validatedData['_id'],
//         'apply_now' => $validatedData['apply_now'],
//         'pass' => $validatedData['pass'],
//     ];

//     // Make the POST request to the external API
//     $response = Http::post('https://datastore.oncloud.com.ng/payload/apply', $apiData);

//     // Check the API response and redirect accordingly
//     if ($response->successful()) {
//         return redirect()->route('eligibility')->with('success', 'Application submitted successfully!');
//     } else {
//         return redirect()->route('eligibility')->with('error', 'Failed to submit application. Please try again.');
//     }
// }

}
