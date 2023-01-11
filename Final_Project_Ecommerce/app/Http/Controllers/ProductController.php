<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return response()->json([
        "success" => true,
        "message" => "Product List",
        "data" => $products
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
        'name' => 'required',
        'description' => 'required',
        'quatity'=>'required',
        'status'=>'required',
        'price'=>'required',
        'category_is'=>'required'
        ]);

        if($validator->fails())
        {
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $product = Product::create($input);
        return response()->json([
        "success" => true,
        "message" => "Product created successfully.",
        "data" => $product
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
        $product = Product::find($id);
        if (is_null($product)) {
        return $this->sendError('Product not found.');
        }
        return response()->json([
        "success" => true,
        "message" => "Product retrieved successfully.",
        "data" => $product
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
        $product=Product::find($id);
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required',
            'description' => 'required',
            'quatity'=>'required',
            'status'=>'required',
            'price'=>'required',
            'image'=>'required',
            'category_is'=>'required'
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        $product->name = $input['name'];
        $product->description = $input['description'];
        $product->quatity = $input['quantity'];
        $product->status = $input['status'];
        $product->price = $input['price'];
        $product->image = $input['image'];
        $product->category_id=$input['category_id'];
        $product->save();

        return response()->json([
        "success" => true,
        "message" => "Product updated successfully.",
        "data" => $product
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
        $product=Product::find($id);
        $product->delete();
        return response()->json([
        "success" => true,
        "message" => "Product deleted successfully.",
        "data" => $product
        ]);
    }
}
