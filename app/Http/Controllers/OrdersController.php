<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Enum\OrderStatus;
use App\Models\OrderItem;
use App\Models\Product;
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

class OrdersController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $authUser = JWTAuth::parseToken()->authenticate();
            
            $validator = Validator::make($request->all(), [
                'total_amount' => 'required|numeric',
                'shipping_address' => 'required|string',
                'cart_id' => 'required|array',
        ]);
        
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $cartIds = $request->input('cart_id');
        
        DB::beginTransaction();
        try {
            $order = Order::create([
                'user_id' => $authUser->id,
                'total_amount' => $request->input('total_amount'),
                'shipping_address' => $request->input('shipping_address'),
                'status' => OrderStatus::PENDING,
            ]);
            
            $cartItems = Cart::whereIn('id', $cartIds)->get();
            foreach( $cartItems as $cartItem) {
                
                $product = Product::find($cartItem->product_id);
                $price = $product ? $product->price : 0;
                $categoryId = $product ? $product->category_id : Null;
                $subcategoryId = $product ? $product->subcategory_id : Null;
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cartItem->product_id,
                    'category_id' => $categoryId,
                    'subcategory_id' =>$subcategoryId,
                    'quantity' => $cartItem->quantity,
                    'design_id' => $cartItem->design_id,
                    'unit_price' => $cartItem->unit_price,
                    'size' => $cartItem->size,
                    'side' => $cartItem->side,
                    'note' => $cartItem->note,
                    'days' => $cartItem->days,
                ]);
            }
            $order->load('orderItems');
            DB::commit();
            return response()->json([
                'order' => $order,
                'user' => $authUser, 
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Failed to create order. ' . $e->getMessage()], 500);
        }
        } catch (JWTException $e) {
            return response()->json(['error' => 'Failed.'. $e->getMessage()], 500);
        }
    }



    /**
     * Display the specified resource.
     */
    public function show(request $request)
    {
        try {
            $authUser = JWTAuth::parseToken()->authenticate();
            $userId = $authUser->id;
            $orders = Order::with(['user', 'orderItems.product.attributes', 'orderItems.design'])
            ->where('user_id', $userId)
            ->get();
            if ($orders->isEmpty()) {
                return response()->json(['error' => 'No Orders Found for this User.'], 404);
            }
            return response()->json(['orders' => $orders], 200);
        } catch (JWTException $e) {
            return response()->json(['error' => 'Failed.'. $e->getMessage()], 500);
        }  
    }  

    /**
     * get all the specified resource in storage.
     */
    public function index(Request $request)
    {
        try {
            $authUser = JWTAuth::parseToken()->authenticate();      
            $allOrders = Order::with(['user', 'orderItems.product.attributes', 'orderItems.design'])->get();
            return response()->json(['allOrders' => $allOrders], 200);
        } catch (JWTException $e) {
            return response()->json(['error' => 'Failed.'. $e->getMessage()], 500);
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
