<?php

namespace App\Http\Controllers\Api\V1;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;

class AuthController extends Controller
{
  public function register(Request $request)
  {
    // name, email, password
    $validator = Validator::make($request->all(), [
      'name' => ['required', 'string', 'max:255'],
      'email' => ['required', 'email', 'max:255', 'email:rfc,dns',  'unique:' . User::class],
      'password' => ['required', 'confirmed', Rules\Password::defaults()],
    ], [
      // 'email.email' => 'This email is not exsists'
      'email.email' => 'The email format or domain is invalid',
    ]);


    if ($validator->fails()) {
      return ApiResponse::sendResponse('Register Validation Errors', $validator->messages()->all(), 422);
    }

    /**
     * First: let's create the user in the DB
     */
    $user = User::create([
      'name' => $request->name,
      'email' => $request->email,
      'password' => Hash::make($request->password),
    ]);

    /**
     * Second: Let's create the token
     */

    /**
     * This is from the trait itself
     * public function createToken(string $name, array $abilities = ['*'], DateTimeInterface $expiresAt = null)
     */
    $data['token'] = $user->createToken('APIcourse')->plainTextToken;
    $data['name'] = $user->name;
    $data['email'] = $user->email;


    return ApiResponse::sendResponse('User Account Created Successfully', $data, 201);
  }
}
