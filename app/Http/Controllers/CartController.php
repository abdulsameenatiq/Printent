<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Validator;
use JWTAuth;
use DB;

class CartController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {

            try {
                $authUser = JWTAuth::parseToken()->authenticate();
            } catch (JWTException $e) {
                return response()->json(['error' => 'Token is invalid or not provided'], 401);
            }
            $validator = Validator::make($request->all(), [
                'product_id' => 'required|integer',
                'design_id' => 'required|integer',
                'quantity' => 'required|integer',
                'size' => 'required|string',
                'side' => 'required|string',
                'total_price' => 'required|numeric',
                'unit_price' => 'required|numeric',
                'days' => 'required|integer',
                'note' => 'string',
    
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }
            $userId = $authUser->id;
            $cart = Cart::create([
                'product_id' => $request->input('product_id'),
                'design_id' => $request->input('design_id'),
                'quantity' => $request->input('quantity'),
                'size' => $request->input('size'),
                'side' => $request->input('side'),
                'total_price' => $request->input('total_price'),
                'unit_price' => $request->input('unit_price'),
                'days' => $request->input('days'),
                'note' => $request->input('note'),
                'user_id' => $userId,
            ]);
            // return'ok';
            
            if (!$cart) {
                return response()->json(['error' => 'Failed to add to cart.'], 500);
            }
    
            return response()->json(['cart' => $cart], 200);
        } catch(\Exception $e) {
            return response()->json(['error' => 'Failed.'. $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(request $request)
    {
        try {
            try {
                $authUser = JWTAuth::parseToken()->authenticate();
            } catch (JWTException $e) {
                return response()->json(['error' => 'Token is invalid or not provided'], 401);
            }  
            $userId = $authUser->id;
            $carts = Cart::where('user_id', $userId)
            ->with(['product.attributes', 'user', 'design'])
            ->get();
            if ($carts->isEmpty()) {
                return response()->json(['error' => 'No Carts Found for this User.'], 404);
            }
            return response()->json(['carts' => $carts], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed.'. $e->getMessage()], 500);
        }
    }    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            try {
                $authUser = JWTAuth::parseToken()->authenticate();
            } catch (JWTException $e) {
                return response()->json(['error' => 'Token is invalid or not provided'], 401);
            }
    
            $validator = Validator::make($request->all(), [
                'quantity' => 'required|integer',
            ]);
    
            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }
            $cart = Cart::find($id);
    
            if (!$cart) {
                return response()->json(['error' => 'Cart not found.'], 404);
            }
    
            if ($request->has('quantity')) {
                $cart->quantity = $request->input('quantity');
            }
    
            $cart->save();
    
            return response()->json(['cart' => $cart], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed.'. $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            try {
                $authUser = JWTAuth::parseToken()->authenticate();
            } catch (JWTException $e) {
                return response()->json(['error' => 'Token is invalid or not provided'], 401);
            }
            $Cart = Cart::find($id);
            $result = $Cart->delete();
            if($result) {
                return response()->json(['Cart deleted']);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed.'. $e->getMessage()], 500);
        }
    }
}
