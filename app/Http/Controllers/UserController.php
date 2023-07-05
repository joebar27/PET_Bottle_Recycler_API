<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
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
     * User login.
     *
     * @return \Illuminate\Http\Response
     */
    public function userLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');
        // Récupérer l'utilisateur par son email
        $user = User::where('email', $credentials['email'])->first();
        // Vérifier si l'utilisateur existe
        if (!$user) {
            return response()->json(['message' => 'Utilisateur non trouvé'], 404);
        }
        // Vérifier si le mot de passe correspond
        if (Hash::check($credentials['password'], $user->password)) {
            // Mot de passe correct
            return response()->json(['user' => $user], 200);
        } else {
            // Mot de passe incorrect
            return response()->json(['message' => 'API Mot de passe incorrect'], 401);
        }
    }

    public function userRegister(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'phone' => 'required'
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->phone = $request->phone;
        $user->save();

        return response()->json(['user' => $user], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param string $username
     * @return \Illuminate\Http\Response
     */
    public function show($email)
    {
        $user = User::where('email', $email)->first();
        if ($user) {
            return $user;
        } else {
            return response()->json(['message' => 'User not found'], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user = User::find($user->id);
        $user->update($request->all());
        return $user;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user = User::find($user->id);
        $user->delete();
        return $user;
    }
}
