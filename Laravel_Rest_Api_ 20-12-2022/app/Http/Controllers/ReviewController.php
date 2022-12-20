<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Review::orderBy('created_at', 'asc')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [ 
            'book_id' => 'required',
            'reviewer_name' => 'required',
            'content' => 'required',
            'rating' => 'required',
        ]);
  
        $task = new review;
        $task->book_id = $request->input('book_id'); 
        $task->reviewer_name = $request->input('reviewer_name'); 
        $task->content=$request->input('content');
        $task->rating=$request->input('rating');

        $task->save(); //storing values as an object
        return $task;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Review::findorFail($id);
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
        $this->validate($request, [ 
            'book_id' => 'required',
            'reviewer_name' => 'required',
            'content' => 'required',
            'rating' => 'required',
        ]);
  
        $task = Review::findorFail($id);
        $task->book_id = $request->input('book_id'); 
        $task->reviewer_name = $request->input('reviewer_name'); 
        $task->content=$request->input('content');
        $task->rating=$request->input('rating');

        $task->save(); //storing values as an object
        return $task;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Review::findorFail($id); 
        if($task->delete())
        { 
            return 'deleted successfully';
        }
    }
}
