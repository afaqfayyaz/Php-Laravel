<?php

namespace App\Http\Controllers;

use App\Models\Checkout;
use App\Models\Checkouts;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Checkout::orderBy('created_at', 'asc')->get();
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
        $this->validate($request, [ //inputs are not empty or null
            'user_id' => 'required',
            'book_id' => 'required',
            'return_date' => 'required',
            'checkout_date' => 'required',
        ]);
  
        $task = new Checkout;
        $task->user_id = $request->input('user_id'); //retrieving user inputs
        $task->book_id = $request->input('book_id');  
        $task->return_date=$request->input('return_date');
        $task->checkout_date=$request->input('checkout_date');

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
        return Checkout::findorFail($id);
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
            'user_id' => 'required',
            'book_id' => 'required',
            'return_date' => 'required',
            'checkout_date' => 'required',
        ]);
  
        $task = Checkout::findorFail($id);
        $task->user_id = $request->input('user_id'); //retrieving user inputs
        $task->book_id = $request->input('book_id');  
        $task->return_date=$request->input('return_date');
        $task->checkout_date=$request->input('checkout_date');

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
        $task = Checkout::findorFail($id); 
        if($task->delete())
        { 
            return 'deleted successfully';
        }
    }
}
