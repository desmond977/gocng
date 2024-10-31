<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Used extends Authenticatable
{
    use HasFactory;

    // Define fillable properties that correspond to the fields in $userData
    protected $fillable = [
        'salutation',
        'first_name',
        'last_name',
        'gender_c',
        'phone_mobile',
        'email',
        'employment_status_c',
        'state_c',
        'age_range_c',
        'vehicle_current_fuel_type_c',
        'vehicle_make_c',
        'year_of_manufacture_c',
        'vehicle_registration_number_c',
        'vehicle_vin_c',
        'date_entered',
        'workplace',
        'engine',
    ];

    // You can add any additional relationships or custom methods here as needed
}
