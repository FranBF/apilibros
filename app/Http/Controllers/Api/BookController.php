<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Validation\{Validator};
use Laravel\Passport\Passport;

class BookController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Book::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $book = new Book;
        $book->name = $request->name;
        $book->author = $request->author;
        $book->user_id = $request->user_id;
        $book->ISBN = $request->ISBN;
        $book->category = $request->category;
        $book->save();
        return response()->json([
            'success' => true,
            'data' => $book->toArray()
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Book::where('id', $id)->exists()) {
            $book = Book::find($id);
            return response()->json([
                'success' => true,
                'data' => $book->toArray()
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Property with id ' . $id . ' not found'
            ], 400);
        }
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
        if (Book::where('id', $id)->exists()) {
            $book = Book::find($id);
            $book->update($request->all());
            return response()->json([
                'success' => true,
                'data' => $book->toArray()
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Property with id ' . $id . ' not found'
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Book::where('id', $id)->exists()) {
            $book = Book::find($id);
            $book->delete();
            return response()->json([
                'success' => true,
                'data' => $book->toArray()
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Property with id ' . $id . ' not found'
            ], 400);
        }
    }
}
