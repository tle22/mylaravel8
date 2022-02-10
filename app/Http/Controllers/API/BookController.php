<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Book::get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $requestData = $request->all();
        if ($request->hasFile('image')) {
            $filename = $request->file('image')->store('uploads', 'public');
            $requestData['image'] = asset('storage/' . $filename);
        }

        $book = Book::create($requestData);
        return ["success" => true, "data" => $book];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Book::findOrFail($id);
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
        $requestData = $request->all();
        if ($request->hasFile('image')) {
            $filename = $request->file('image')->store('uploads', 'public');
            $requestData['image'] = asset('storage/' . $filename);
        }

        $book = Book::findOrFail($id);
        $success = $book->update($requestData);
        return ["success" => $success];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $success = $book->delete();
        return ["success" => $success];
    }
}
