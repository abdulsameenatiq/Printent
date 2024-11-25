<?php

namespace App\Http\Controllers;

use App\Models\Quote;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Validator;
use JWTAuth;
use DB;

class QuoteController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
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
            // Create the product
            $quote = Quote::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'mobile' => $request->input('mobile'),
                'message' => $request->input('message'),
            ]);

            // Handling image upload
            if ($request->hasFile('images')) {
                $images = $request->file('images');
                $imagePaths = [];

                foreach ($images as $image) {
                    // Generate a unique name for the image and store it
                    $fileName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('/Storage/QuateImages/'), $fileName);
                    $imagePaths[] = '/Storage/QuateImages/' . $fileName;
                }

                // Optionally: Save image paths to the product or another table
                $quote->update(['images' => json_encode($imagePaths)]);
            } else {
                $images = "null";
            }

            DB::commit();
            return response()->json(['quote' => $quote], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Failed.'. $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Quote $quote)
    {
        try {
            $authUser = JWTAuth::parseToken()->authenticate();
            $quote = Quote::all();
            return response()->json(['quote' => $quote], 200);
        } catch (JWTException $e) {
            return response()->json(['error' => 'Failed.'. $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $authUser = JWTAuth::parseToken()->authenticate();
            $quote = Quote::find($id);
            if(!$quote) {
                return response()->json(['Quote does not exist'], 401);
            }
            $result = $quote->delete();
            if($result) {
                return response()->json(['Quote deleted']);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'Failed.'. $e->getMessage()], 500);
        }
    }
}
