<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Models\User;
use App\Models\Order;
use App\Enum\OrderStatus;
use Validator;
use JWTAuth;

class TrackOrderController extends Controller
{
    public function track(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'order_number' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $user = User::where('email', $request->input('email'))->first();
        if ($user) {
            $order = Order::where('order_number', $request->input('order_number'))->first();
            if ($order) {
                $status = $this->getOrderStatus($order->status);
                return response()->json([
                    'status' => $status,
                    'order_number' => $order->order_number,
                ]);
            }
        }
        return response()->json(['message' => 'Order not found'], 404);
    }
    private function getOrderStatus($status)
    {
        switch ($status) {
            case OrderStatus::PENDING:
                return 'Pending';
            case OrderStatus::CANCELLED:
                return 'Cancelled';
            case OrderStatus::CONFIRMED:
                return 'Confirmed';
            case OrderStatus::PROCESSING:
                return 'Processing';
            case OrderStatus::COMPLETE:
                return 'Complete';
            default:
                return 'Unknown Status';
        }
    }
}
