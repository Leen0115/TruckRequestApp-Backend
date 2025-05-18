<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TruckRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Notifications\OrderStatusUpdated;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NewOrderCreated;

class TruckRequestController extends Controller
{
    // تخزين الطلب الجديد
    public function store(Request $request)
{
    $request->validate([
        'pickup_location' => 'required|string',
        'dropoff_location' => 'required|string',
        'pickup_time' => 'required|string',
        'delivery_time' => 'required|string',
        'truck_type' => 'required|string',
        'weight' => 'required|numeric',
        'cargo_type' => 'required|string',
        'note' => 'nullable|string',
    ]);

    $userId = Auth::id();

    if (!$userId) {
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    $requestData = TruckRequest::create([
        'pickup_location' => $request->pickup_location,
        'dropoff_location' => $request->dropoff_location,
        'pickup_time' => $request->pickup_time,
        'delivery_time' => $request->delivery_time,
        'truck_type' => $request->truck_type,
        'weight' => $request->weight,
        'cargo_type' => $request->cargo_type,
        'note' => $request->note,
        'user_id' => $userId,
    ]);

    // إرسال إشعار للأدمن (مؤقتًا أول مستخدم)
    $admin = User::first(); // لاحقًا نقدر نستخدم role أو is_admin
    if ($admin) {
        $admin->notify(new NewOrderCreated($requestData));
    }

    return response()->json([
        'message' => 'Truck request received successfully!',
        'data' => $requestData
    ]);
}
    

    // ترجع الطلبات الخاصة بالمستخدم الحالي Dashboard
    public function myRequests()
    {
        $userId = Auth::id();

        if (!$userId) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $requests = TruckRequest::where('user_id', $userId)
                                ->orderBy('created_at', 'desc')
                                ->get();

        return response()->json([
            'data' => $requests
        ]);
    }

    // ترجع كل الطلبات مع بيانات المستخدمين (لصفحة الأدمن)
    public function allRequests()
    {
        // return response()->json('All requests');
        $requests = TruckRequest::with('user')
                                ->orderBy('created_at', 'desc')
                                ->get();

        \Log::info('All requests:', ['requests' => $requests]);
        return response()->json([
            'data' => $requests
        ]);
    }

    // تلغي الطلب بناءً على ID وتتحقق أن الطلب يخص المستخدم الحالي
    public function cancel($id)
    {
        $request = TruckRequest::where('id', $id)
                               ->where('user_id', Auth::id())
                               ->first();

        if (!$request) {
            return response()->json(['message' => 'Request not found'], 404);
        }

        $request->status = 'Cancelled';
        $request->save();

        return response()->json(['message' => 'Request cancelled successfully']);
    }
public function updateStatus(Request $request, $id)
{
    $order = TruckRequest::findOrFail($id);
    $order->status = $request->status;
    $order->save();

    // إرسال إشعار للمستخدم صاحب الطلب
    $user = $order->user;
    $user->notify(new OrderStatusUpdated($order));

    return response()->json(['message' => 'Status updated and notification sent']);
}
public function update(Request $request, $id) {
    $order = TruckRequest::findOrFail($id);
    $order->pickup_location = $request->pickup_location;
    $order->dropoff_location = $request->dropoff_location;
    $order->pickup_time = $request->pickup_time;
    $order->delivery_time = $request->delivery_time;
    $order->truck_type = strtolower($request->truck_type);
    $order->weight = $request->weight;
    $order->cargo_type = $request->cargo_type;
    $order->note = $request->note;
    $order->save();

    return response()->json(['message' => 'Order updated successfully']);
}
}