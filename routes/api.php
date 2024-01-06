<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {

    // Revoke all tokens...
$request->user->tokens()->delete();

// Revoke the token that was used to authenticate the current request...
$request->request->user()->currentAccessToken()->delete();

// Revoke a specific token...
$request->user->tokens()->where('id', $tokenId)->delete();
    return $request->user();

});
Route::post('/tokens/create', function (Request $request) {
$token = $request->user()->createToken($request->token_name);

return ['token' => $token->plainTextToken];
});
