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

class UserController extends BaseController
{


    public function register(Request $request)
    {
        $dataValidated = $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
        $dataValidated['password'] = Hash::make($request->password);

        $user = User::create($dataValidated);

        $token = $user->createToken('ElLibroDeFran')->accessToken;

        return response()->json(['token' => $token], 200);
    }
    /**
     * User Login
     */
    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $success['token'] = $user->createToken('ElLibroDeFran')->accessToken;
            $success['user'] = $user->email;
            return $this->sendResponse($success, 'Login success');
        } else {
            return $this->sendError('Unauthorized', ['error' => 'Unauthorized']);
        }
    }
    /**
     * Returns Authenticated User Details
     *
     * @return \Illuminate\Http\JsonResponse
     */


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::all();
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
        $property = auth()->user()->book()->find($id);

        if (!$property) {
            return response()->json([
                'success' => false,
                'message' => 'Property with id ' . $id . ' not found'
            ], 400);
        }

        return response()->json([
            'success' => true,
            'data' => $property->toArray()
        ], 200);
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
        if (User::where('id', $id)->exists()) {
            $user = User::find($id);
            $user->update($request->all());
            return response()->json([
                'success' => true,
                'data' => $user->toArray()
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
        if (User::where('id', $id)->exists()) {
            $user = User::find($id);
            $user->delete();
            return response()->json([
                'success' => true,
                'data' => $user->toArray()
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Property with id ' . $id . ' not found'
            ], 400);
        }
    }
}
