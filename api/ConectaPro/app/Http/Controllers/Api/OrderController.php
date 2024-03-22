<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function list() {
        $orders = Order::with('user', 'specialist', 'service')->get();
        $list = [];
        foreach ($orders as $order) {
            $user = $order->user;
            $specialist = $order->specialist;
            $service = $order->service;

            $object = [
                "id" => $order->id,
                "user" => [
                    "id" => $user->id,
                    "name" => $user->name,
                    "surname" => $user->surname,
                ],
                "specialist" => [
                    "id" => $specialist->id,
                    "name" => $specialist->name,
                    "surname" => $specialist->surname,
                ],
                "service" => [
                    "id" => $service->id,
                    "name" => $service->name,
                ],
                "name" => $order->name,
                "phone" => $order->phone,
                "email" => $order->email,
                "additional_details" => $order->additional_details,
                "order_status" => $order->order_status,
                "created_at" => $order->created_at,
                "updated_at" => $order->updated_at
            ];
            array_push($list, $object);
        }
        return $list;
    }

    public function item($id) {
        $order = Order::with('user', 'specialist', 'service')->find($id);
    
        if (!$order) {
            return response()->json(['error' => 'Orden no encontrada'], 404);
        }
    
        $user = $order->user;
        $specialist = $order->specialist;
        $service = $order->service;

        $object = [
            "id" => $order->id,
            "user" => [
                "id" => $user->id,
                "name" => $user->name,
                "surname" => $user->surname,
            ],
            "specialist" => [
                "id" => $specialist->id,
                "name" => $specialist->name,
                "surname" => $specialist->surname,
            ],
            "service" => [
                "id" => $service->id,
                "name" => $service->name,
            ],
            "name" => $order->name,
            "phone" => $order->phone,
            "email" => $order->email,
            "additional_details" => $order->additional_details,
            "order_status" => $order->order_status,
            "created_at" => $order->created_at,
            "updated_at" => $order->updated_at
        ];
    
        return $object;
    }


    public function create(Request $request) {
        $data = $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|string',
            'additional_details' => 'nullable|string',
            'service_id' => 'required|int',
            'specialist_id' => 'required|int',
            'user_id' => 'required|int',
            'order_status' => 'required|string',
        ]);

        $order = Order::create([
            'name' => $data['name'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'additional_details' => $data['additional_details'],
            'service_id' => $data['service_id'],
            'specialist_id' => $data['specialist_id'],
            'user_id' => $data['user_id'],
            'order_status' => $data['order_status'],
        ]);

        if ($order) {
            return response()->json(['message' => 'Order created successfully', 'data' => $order], 201);
        } else {
            return response()->json(['error' => 'Failed to create order'], 500);
        }
    }

    public function update(Request $request) {
        $data = $request->validate([
            'id' => 'required|int',
            'name' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|string',
            'additional_details' => 'nullable|string',
            'service_id' => 'required|int',
            'specialist_id' => 'required|int',
            'user_id' => 'required|int',
            'order_status' => 'required|string',
        ]);
    
        $order = Order::find($data['id']);
    
        if (!$order) {
            return response()->json(['error' => 'Recomendación no encontrada'], 404);
        }
    
        $order->name = $data['name'];
        $order->phone = $data['phone'];
        $order->email = $data['email'];
        $order->additional_details = $data['additional_details'];
        $order->service_id = $data['service_id'];
        $order->specialist_id = $data['specialist_id'];
        $order->user_id = $data['user_id'];
        $order->order_status = $data['order_status'];

        if ($order->save()) {
            return response()->json(['message' => 'Order updated successfully', 'data' => $order], 200);
        } else {
            return response()->json(['error' => 'Failed to update order'], 500);
        }
    }



    public function delete($id) {
        $order = Order::find($id);

        if (!$order) {
            return response()->json(['error' => 'Order not found'], 404);
        }

        if ($order->delete()) {
            return response()->json(['message' => 'Order deleted successfully'], 200);
        } else {
            return response()->json(['error' => 'Failed to delete order'], 500);
        }
    }

    
}
