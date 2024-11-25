<?php

namespace App\Http\Controllers;

use App\Models\DirectOrder;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Validator;
use JWTAuth;
use DB;

class DirectOrdersController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'string',
            'email' => 'required|string|email',
            'message' => 'string',
            'mobile' => 'string',
            'images.*' => 'image',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        DB::beginTransaction();        
        try {
            // Create the product
            $directOrder = DirectOrder::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'mobile' => $request->input('mobile'),
                'message' => $request->input('message'),
            ]);

            // Handling image upload
            // return "ok";
            if($request->hasFile('images')) {
                $images = $request->file('images');
                $imagePaths = [];
                
                foreach ($images as $image) {
                    // Generate a unique name for the image and store it
                    $fileName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('/Storage/QuateImages/'), $fileName);
                    $imagePaths[] = '/Storage/QuateImages/' . $fileName;
                }
                
                // Optionally: Save image paths to the product or another table
                $directOrder->update(['images' => json_encode($imagePaths)]);
            } else {
                $images = "null";
            }
    
            DB::commit();
            return response()->json(['directOrder' => $directOrder], 200);
    
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Failed to create directOrder.'], 500);
        }
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

        $directOrder = DirectOrder::all();
        return response()->json(['DirectOrders' => $directOrder], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $authUser = JWTAuth::parseToken()->authenticate();
        } catch (JWTException $e) {
            return response()->json(['error' => 'Token is invalid or not provided'], 401);
        }
        $directOrder = DirectOrder::find($id);
        if(!$directOrder) {
            return response()->json(['directOrder does not exist'], 401);
        }
        $result = $directOrder->delete();
        if($result) {
            return response()->json(['directOrder deleted']);
        }
    }
}
