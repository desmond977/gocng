<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Used;

class AppController extends Controller
{
    //
    public function saveData(Request $request)
    {
        // Validate incoming request data
        // return $request;
        $validatedData=$request->all();
        // $validatedData = $request->validate([
        //     'salutation' => 'required|string|max:10',
        //     'first_name' => 'required|string|max:255',
        //     'last_name' => 'required|string|max:255',
        //     'gender_c' => 'required|string|max:10',
        //     'phone_mobile' => 'required|string|max:15',
        //     'email1' => 'required|email',
        //     'employment_status_c' => 'required|string|max:10',
        //     'state_c' => 'required|string|max:20',
        //     'age_range_c' => 'required|string|max:20',
        //     'vehicle_make_c' => 'required|string|max:30',
        //     'year_of_manufacture_c' => 'required|string|max:30',
        //     'vehicle_registration_number_c' => 'required|string|max:30',
        //     'vehicle_vin_c' => 'required|string|',
        //     'date_entered' => 'required|string|',
        //     'workplace' => 'required|string|',
        // ]);

        // return $validatedData;

        // Combine existing data (from API) with new inputs
        $userData = [
            'salutation' => $validatedData['salutation'],
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'gender_c' => $validatedData['gender_c'],
            'phone_mobile' => $validatedData['phone_mobile'],
            'email1' => $validatedData['email1'], // Mapping 'email1' to 'email'
            'employment_status_c' => $validatedData['employment_status_c'],
            'state_c' => $validatedData['state_c'],
            'age_range_c' => $validatedData['age_range_c'],
            'vehicle_current_fuel_type_c' => $validatedData['vehicle_current_fuel_type_c'],
            'vehicle_make_c' => $validatedData['vehicle_make_c'],
            'year_of_manufacture_c' => $validatedData['year_of_manufacture_c'],
            'vehicle_registration_number_c' => $validatedData['vehicle_registration_number_c'],
            'vehicle_vin_c' => $validatedData['vehicle_vin_c'],
            'date_entered' => $validatedData['date_entered'],
            'workplace' => $validatedData['workplace'],
            'engine' => $validatedData['engine'],
        ];

        // Save the combined data
        $user = Used::updateOrCreate(
            ['email' => $userData['email1']], // Find user by email
            $userData // Update or create with all combined data
        );



        // Redirect to a confirmation or another page, e.g., 'thank you' page
        return redirect()->route('eligibility')->with('success', 'Data processed , you can now check your Eligibilty');
    }


}
