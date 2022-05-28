<?php

namespace App\Actions\Fortify;

use App\Models\Barangay;
use App\Models\Citizen;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use Spatie\Permission\Models\Permission;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     * @return \App\Models\Citizen
     */
    public function create(array $input)
    {
//        Validator::make($input, [
//            'name' => ['required', 'string', 'max:255'],
//            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
//            'password' => $this->passwordRules(),
//            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
//        ])->validate();
//
//
//
//        $bar =  Barangay::create([
//            'barangay_name' => $input['barangay'],
//        ]);
//
//        return User::create([
//            'name' => $input['name'],
//            'email' => $input['email'],
//            'password' => Hash::make($input['password']),
//            'barangay_id' => $bar->id,
//        ])->assignRole('Admin');

        Validator::make($input, [
            'email'         => ['required', 'string', 'email', 'max:255', 'unique:citizens'],
            'password'      => $this->passwordRules(),
            'first_name'    => ['required', 'max:255'],
            'last_name'     => ['required', 'max:255'],
            'barangay_name' => ['required', 'max:255', 'unique:barangays'],
        ])->validate();


        $barangay = Barangay::create([
            'barangay_name' => $input['barangay_name'],
        ]);


        $user = User::create([
            'name'          => $input['first_name']. ' '. $input['last_name'],
            'email'         => $input['email'],
            'password'      => Hash::make($input['password']),
            'barangay_id'   => $barangay->id,
        ])->assignRole('Admin');

        $user->givePermissionTo(Permission::all());

        Citizen::create([
            'first_name'    => $input['first_name'],
            'last_name'     => $input['last_name'],
            'email'         => $user['email'],
            'barangay_id'   => $barangay->id,
            'user_id'       => $user->id
        ]);

        return $user;
    }
}
