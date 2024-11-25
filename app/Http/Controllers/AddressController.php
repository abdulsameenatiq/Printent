<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Validator;
use JWTAuth;
use DB;


class AddressController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $authUser = JWTAuth::parseToken()->authenticate();
        } catch (JWTException $e) {
            return response()->json(['error' => 'Token is invalid or not provided'], 401);
        }

        $validator = Validator::make($request->all(), [
            'address_title' => 'required|string',
            'address_type' => 'required|string',
            'contact_person_name' => 'required|string',
            'mobile_number' => 'required|string',
            'email' => 'string',
            'country' => 'required|string',
            'city' => 'required|string',
            'location' => 'required|string',
            'street' => 'required|string',
            'postal_code' => 'required|numeric',
            'additional_code' => 'required|numeric',
            'building_name' => 'string',
            'building_no' => 'numeric',
            'floor_no' => 'numeric',     
            'unit_no' => 'numeric',       
            'notes' => 'string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $userId = $authUser->id;

        // Use try-catch to handle exceptions during address creation
        try {
            $address = Address::create([
                'user_id' => $userId,
                'address_title' => $request->input('address_title'),
                'address_type' => $request->input('address_type'),
                'contact_person_name' => $request->input('contact_person_name'),
                'mobile_number' => $request->input('mobile_number'),
                'email' => $request->input('email'),
                'country' => $request->input('country'),
                'city' => $request->input('city'),
                'location' => $request->input('location'),
                'street' => $request->input('street'),
                'postal_code' => $request->input('postal_code'),
                'additional_code' => $request->input('additional_code'),
                'building_name' => $request->input('building_name'),
                'building_no' => $request->input('building_no'),  // Updated
                'floor_no' => $request->input('floor_no'),        // Updated
                'unit_no' => $request->input('unit_no'),          // Updated
                'notes' => $request->input('notes'),
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to create address: ' . $e->getMessage()], 500);
        }

        return response()->json(['message' => 'Address created successfully', 'address' => $address], 201);
    }


    /**
     * Display the specified resource.
     */
    public function show(request $request)
    {
        try {
            $authUser = JWTAuth::parseToken()->authenticate();
        } catch (JWTException $e) {
            return response()->json(['error' => 'Token is invalid or not provided'], 401);
        }  
        $userId = $authUser->id;
        $address = Address::where('user_id', $userId)
        ->get();
        if ($address->isEmpty()) {
            return response()->json(['error' => 'No address Found for this User.'], 404);
        }
        return response()->json(['address' => $address], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Address $address)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Address $address)
    {
        //
    }
}
