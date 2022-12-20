<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Book::orderBy('created_at', 'asc')->get();  //returns values in ascending order
        
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
            'tittle' => 'required',
            'author' => 'required',
            'isbn' => 'required',
            'publish_date' => 'required',
        ]);
  
        $task = new Book;
        $task->tittle = $request->input('tittle'); //retrieving user inputs
        $task->author = $request->input('author');  //retrieving user inputs
        $task->isbn=$request->input('isbn');
        $task->publish_date=$request->input('publish_date');

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
        return Book::findorFail($id);
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
            'tittle' => 'required',
            'author' => 'required',
            'isbn' => 'required',
            'publish_date' => 'required',
        ]);
  
        $task = Book::findorFail($id);
        $task->tittle = $request->input('tittle'); 
        $task->author = $request->input('author'); 
        $task->isbn=$request->input('isbn');
        $task->publish_date=$request->input('publish_date');

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
        $task = Book::findorFail($id); 
        if($task->delete())
        { 
            return 'deleted successfully';
        }
    }
}
