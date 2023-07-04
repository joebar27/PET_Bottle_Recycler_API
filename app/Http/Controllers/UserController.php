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
        if ($credentials['password'] === $user->password) {
            // Mot de passe correct
            return $user;
            // return response()->json(['message' => 'Mot de passe correct'], 200);
        } else {
            // Mot de passe incorrect
            return response()->json(['message' => 'Mot de passe incorrect'], 401);
        }
    }

    public function userRegister(Request $request)
    {
        $credentials = $request->only('email');
        // Récupérer l'utilisateur par son email
        $user = User::where('email', $credentials['email'])->first();

        // Vérifier si l'utilisateur existe
        if ($user) {
            return response()->json(['message' => 'Utilisateur déjà existant'], 404);
        }
        if (!$user) {
            $user = User::create($request->all());
            return response()->json(['user' => $user], 201);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::create($request->all());
        return $user;
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
