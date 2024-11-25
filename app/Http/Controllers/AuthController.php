<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Models\User;
use App\Models\Address;
use Validator;
use JWTAuth;
use Carbon\Carbon; // Import Carbon
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        try {
            // Validate the input data
            $request->validate([
                'email' => 'required|email',
                'password' => 'required|string',
            ]);

            // Get credentials from the request
            $credentials = $request->only('email', 'password');

            // Attempt to generate JWT token
            if (!$token = JWTAuth::attempt($credentials, ['exp' => Carbon::now()->addDays(7)->timestamp])) {
                return response()->json(['error' => 'Invalid Credentials'], 401);
            }

            // Find the user by email
            $user = User::where('email', $credentials['email'])->first();
            if (!$user) {
                return response()->json(['error' => 'User not found'], 404);
            }

            // Check if the user's email is verified
            if ($user->email_verified == 0) {
                return response()->json(['error' => 'Unable to Login, Please Verify your Mail First'], 403);
            }

            // Success: return token and user info
            return response()->json([
                'token' => $token,
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'title' => $user->title,
                    'designation' => $user->designation,
                    'mobile_code' => $user->mobile_code,
                    'mobile_number' => $user->mobile_number,
                    'email_verified' => $user->email_verified,
                    'role' => $user->role,
                    'email' => $user->email,
                ]
            ], 200);

        } catch (JWTException $e) {
            // Catch JWT-specific issues
            return response()->json(['error' => 'Could not create token: ' . $e->getMessage()], 500);
        } catch (\Exception $e) {
            // Catch all other exceptions
            return response()->json(['error' => 'Failed: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|min:8|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);

        $userId = $user->id;
        $verificationUrl = url("https://smartprintsa.com/api/verifyEmail/{$userId}");
        $userEmail = $user->email;

        // Define your HTML content with a placeholder for verification URL
        $htmlContent = "
        <!doctype html>
        <html lang='en'>
        <head>
        <meta charset='utf-8'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <title>Smartprintsa</title>
        <style>
            html, body { background-color: #fff; color: #636b6f; font-family: 'Raleway', sans-serif; font-weight: 100; height: 100vh; margin: 0; }
            .full-height { height: 100vh; }
            .flex-center { align-items: center; display: flex; justify-content: center; }
            .content { text-align: center; }
            .title { font-size: 54px; }
            .button { display: inline-block; padding: 10px 20px; font-size: 20px; color: #ffffff; background: linear-gradient(to right, #fc953b, #ff6469); text-decoration: none; border-radius: 5px; margin-top: 20px; }
            .m-b-md { margin-bottom: 30px; }
        </style>
        </head>
        <body>
            <div class='flex-center position-ref full-height'>
                <div class='content'>
                    <div class='title m-b-md'>
                        You can login from Smartprintsa Now!
                    </div>
                    <a href='{$verificationUrl}' class='button'>Verify Email</a>
                </div>
            </div>
        </body>
        </html>";

        try {
            Mail::html($htmlContent, function ($message) use ($userEmail) {
                $message->from('sikander0302khan@gmail.com', 'Smartprintsa Support');
                $message->to($userEmail)->subject('Email Verification From Smartprintsa');
            });
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return response()->json(['message' => 'User registered successfully. Please check your email for verification.'], 201);
    }
    // $token = JWTAuth::fromUser($user);
    // $userDetail = User::where('id', $user->id)->first();
    // return response()->json(['token' => $token, 'user' => $userDetail], 200);

    /**
     * Update the specified resource in storage.
     */
    public function verify($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => 'User not found.'], 404);
        }

        if ($user->email_verified) {
            return "<html>
                    <head>
                        <title>Email Verified</title>
                        <style>
                            body { 
                                font-family: 'Raleway', sans-serif; 
                                background-color: #f8f9fa; 
                                color: #333; 
                                text-align: center; 
                                margin: 0; 
                                padding: 0;
                            }
                            .container {
                                display: flex;
                                justify-content: center;
                                align-items: center;
                                height: 100vh;
                                flex-direction: column;
                            }
                            h1 {
                                font-size: 48px;
                                margin-bottom: 20px;
                            }
                            p {
                                font-size: 20px;
                                margin-bottom: 30px;
                            }
                            .button {
                                padding: 10px 20px;
                                font-size: 20px;
                                color: white;
                                background: linear-gradient(to right, #fc953b, #ff6469);
                                text-decoration: none;
                                border-radius: 5px;
                            }
                        </style>
                    </head>
                    <body>
                        <div class='container'>
                            <h1>Email Already Verified</h1>
                            <p>You have already verified your email.</p>
                            <a href='localhost:'8000/login' target='_blank' class='button'>Go to Login</a>
                        </div>
                    </body>
                </html>";
        }

        $user->email_verified = true;
        $user->save();

        return "<html>
                    <head>
                        <title>Email Verified</title>
                        <style>
                            body { 
                                font-family: 'Raleway', sans-serif; 
                                background-color: #f8f9fa; 
                                color: #333; 
                                text-align: center; 
                                margin: 0; 
                                padding: 0;
                            }
                            .container {
                                display: flex;
                                justify-content: center;
                                align-items: center;
                                height: 100vh;
                                flex-direction: column;
                            }
                            h1 {
                                font-size: 48px;
                                margin-bottom: 20px;
                            }
                            p {
                                font-size: 20px;
                                margin-bottom: 30px;
                            }
                            .button {
                                padding: 10px 20px;
                                font-size: 20px;
                                color: white;
                                background: linear-gradient(to right, #fc953b, #ff6469);
                                text-decoration: none;
                                border-radius: 5px;
                            }
                        </style>
                    </head>
                    <body>
                        <div class='container'>
                            <h1>Email Verified Successfully!</h1>
                            <p>Thank you for verifying your email. You can now log in.</p>
                            <a href='https://smartprintsa.com/login' target='_blank' class='button'>Go to Login</a>
                        </div>
                    </body>
                </html>";
    }


    public function profile(request $request)
    {
        try {
            $authUser = JWTAuth::parseToken()->authenticate();
            $userId = $authUser->id;
            $address = Address::where('user_id', $userId);
            // return "ok";
            return response()->json([
                'user' => $authUser,
                'address' => $address
            ], 200);
        } catch (JWTException $e) {
            return response()->json(['error' => 'Failed.' . $e->getMessage()], 500);
        }
    }

    public function profileUpdate(request $request)
    {
        try {
            $authUser = JWTAuth::parseToken()->authenticate();
            $validator = Validator::make($request->all(), [
                'title' => 'sometimes|string',
                'designation' => 'sometimes|string',
                'mobile_code' => 'sometimes|string',
                'mobile_number' => 'sometimes|string',
            ]);

            $authUser = JWTAuth::parseToken()->authenticate();
            $authUser->update($request->only([
                'title',
                'designation',
                'mobile_code',
                'mobile_number',
            ]));

            return response()->json(['message' => 'Profile updated successfully']);
        } catch (JWTException $e) {
            return response()->json(['error' => 'Failed.' . $e->getMessage()], 500);
        }
    }

    public function changePassword(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'current_password' => 'required',
                'new_password' => 'required|min:8|confirmed',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }

            try {
                $authUser = JWTAuth::parseToken()->authenticate();
            } catch (JWTException $e) {
                return response()->json(['error' => 'Token is invalid or not provided'], 401);
            }

            if (!\Hash::check($request->current_password, $authUser->password)) {
                return response()->json(['error' => 'Current password is incorrect.'], 400);
            }

            $authUser->password = bcrypt($request->new_password);
            $authUser->save();
            return response()->json(['message' => 'Password updated successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed.' . $e->getMessage()], 500);
        }
    }

}
