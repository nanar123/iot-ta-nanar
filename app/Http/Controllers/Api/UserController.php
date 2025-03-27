<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::orderBy('name', 'asc')->get();
        return response()->json([
            'message'   => 'Berhasil menampilkan data user',
            'data'      => $users
        ], 200);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store_user(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'phone_number' => 'nullable'
        ]);

        // Hash the password before storing it
        $validated['password'] = Hash::make($validated['password']);

        // Create a new user with the validated data
        $user = User::create($validated);

        // Generate a token for the user
        $token = $user->createToken('YourAppName')->plainTextToken;

        // Return a JSON response indicating success
        return response()->json([
            'message' => 'Berhasil menambahkan user baru',
            'data' => $user->makeHidden(['password']), // Hide the password
            'token' => $token // Include the token in the response
        ], 201);
    }


    // Login_User
    public function login_user(Request $request)
    {
        // Validasi input pengguna
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Cari pengguna berdasarkan email
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'The provided credentials are incorrect.'
            ], 401);
        }

        // Buat token baru
        $token = $user->createToken('YourAppName')->plainTextToken;

        return response()->json([
            'message' => 'Login successful',
            'token' => $token,
            'user' => $user
        ]);
    }



    /**
     * Display the specified resource.
     */
    public function show_user(string $id)
    {
        $user = User::find($id);
        return response()->json([
            'message'   => 'Berhasil menampilkan user ',
            'data'      => $user
        ], 201);
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name'      => [
                'required',
                'string',
                'min:3',
                'max:255'
            ],
            'email'     => [
                'required',
                'email',
                'unique:users,email,' . $id
            ],
            'password'  => [
                'nullable',
                'min:8'
            ],
            // 'role'  => [
            //     'required',
            //     'in:admin,user'
            // ],
            'phone_number'  => [
                'nullable',
            ],

            // 'password_confirmation' => [
            //     'required',
            //     'same:password'
            // ]
        ]);

        if ($request->filled('password')) {
            $validated['password'] = bcrypt($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user = User::find($id);
        $user->update($validated);

        return response()->json([
            'message'   => 'Berhasil mengupdate user ',
            'data'      => $user
        ], 200);
    }



    // /**
    //  * Remove the specified resource from storage.
    //  */
    public function destroy_user(string $id)
    {
        $user = User::find($id);
        $user->delete();

        return response()->json([
            'message'   => 'Berhasil menghapus user ',
            'data'      => $user
        ], 200);
    }



    public function logout_user(Request $request)
    {
        // Get the authenticated user
        $user = Auth::user();

        // Revoke the current access token
        $request->user()->currentAccessToken()->delete();

        // Return a response indicating successful logout
        return response()->json([
            'message' => 'Logout Successfully !!!'
        ], 200);
    }
}
