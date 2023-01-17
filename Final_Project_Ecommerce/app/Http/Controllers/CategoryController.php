<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{

    public function __construct()
    {
        // Middleware to check the current user is admin or not.

        $this->middleware(['admin'], ['except' => ['index']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::all();

        if (is_null($category)) {
            return response()->json([
                "success" => false,
                "message" => "Category not found.",
            ]);
        }
        return response()->json([
            "success" => true,
            "message" => "Category List",
            "data" => $category
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
        ]);

        if ($validator->fails()) {
            return response()->json([
                "success" => false,
                "message" => "Validation Error.",
                "data" =>  $validator->errors()
            ]);
        }
        $input['slug'] = Str::slug($request->name, '-');

        $category = Category::create($input);
        return response()->json([
            "success" => true,
            "message" => "Category Stored successfully.",
            "data" => $category,
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
        $category = Category::find($id);
        if (is_null($category)) {
            return response()->json([
                "success" => false,
                "message" => "Category not found.",
            ]);
        }
        return response()->json([
            "success" => true,
            "message" => "Category retrieved successfully..",
            "data" => $category
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
        $category = Category::find($id);
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                "success" => false,
                "message" => "Validation Error.",
                "data" =>  $validator->errors()
            ]);
        }
        $category->name = $input['name'];
        $category->slug = Str::slug($input['name'], '-');
        $category->save();
        return response()->json([
            "success" => true,
            "message" => "Category Updated successfully.",
            "data" => $category,
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
        $category = Category::find($id);
        if (is_null($category)) {
            return response()->json([
                "success" => false,
                "message" => "Category not found.",
            ]);
        }
        $category->delete();
        return response()->json([
            "success" => true,
            "message" => "Category deleted successfully.",
            "data" => $category,
        ]);
    }
}