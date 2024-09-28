<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Currency;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\CurrencyHistory;

class CurrencyController extends Controller
{
    //
    public function index()
{
    return response()->json(Currency::paginate(10));
}

public function getToken()
{
    // Generate a random email using a unique string
    $randomEmail = 'dummy_' . Str::random(10) . '@example.com';

    // Create a new user with the random email
    $user = User::create([
        'email' => $randomEmail,
        'name' => 'Just To Get Token',
        'password' => bcrypt('password'), // Set a default password
    ]);

    // Generate a new token for the user
    $token = $user->createToken('API Token')->plainTextToken;

    // Return the generated token
    return response()->json(['Token' => $token]);
}

public function show($id)
{
    return response()->json(Currency::findOrFail($id));
}

public function history($id)
{
    $history = CurrencyHistory::where('currency_id', $id)->get();
    return response()->json($history);
}

}
