<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $order = Order::all();
        if (is_null($order)) {
            return response()->json([
                "success" => false,
                "message" => "No Order Registered",
            ]);
        }
        return response()->json([
            "success" => true,
            "message" => "Order List",
            "data" => $order
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'quantity' => 'required',
            'product_id' => 'required',
            'user_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                "success" => false,
                "message" => "Validation Error.",
                "data" =>  $validator->errors()
            ]);
        }

        $order = Order::create($input);
        return response()->json([
            "success" => true,
            "message" => "Order created successfully.",
            "data" => $order
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::find($id);
        if (is_null($order)) {
            return response()->json([
                "success" => false,
                "message" => "Order not found.",
            ]);
        }
        return response()->json([
            "success" => true,
            "message" => "Order retrieved successfully.",
            "data" => $order
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {


        $input = $request->all();
        $validator = Validator::make($input, [
            'quantity' => 'required',
            'product_id' => 'required',
            'user_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                "success" => false,
                "message" => "Validation Error.",
                "data" =>  $validator->errors()
            ]);
        }
        $order = Order::find($id);
        $order->quantity = $input['quantity'];
        $order->product_id = $input['product_id'];
        $order->user_id = $input['user_id'];
        $order->save();

        return response()->json([
            "success" => true,
            "message" => "Order Updated successfully.",
            "data" => $order
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::find($id);
        if (is_null($order)) {
            return response()->json([
                "success" => false,
                "message" => "Order not found.",
            ]);
        }
        $order->delete();
        return response()->json([
            "success" => true,
            "message" => "Order deleted successfully.",
            "data" => $order,
        ]);
    }
}