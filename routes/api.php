<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\AuthController;

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
    return $request->user();
});

Route::get('unauthorized', function () {
    return response()->json(['message' => 'Unauthorized'], 401);
})->name('login');
//public
// routes/api.php
Route::get('/test', function() {
    return response()->json(['message' => 'API is working!']);
});

// routes/api.php
Route::get('/db-test', function() {
    try {
        $host = env('PG_HOST');
        $port = env('PG_PORT');
        $db = env('PG_DB');
        $user = env('PG_USER');
        $password = env('PG_PASSWORD');
        $endpoint = env('PG_ENDPOINT');

        $connection_string = "host=" . $host . 
                           " port=" . $port . 
                           " dbname=" . $db . 
                           " user=" . $user . 
                           " password=" . $password . 
                           " options='endpoint=" . $endpoint . "'" .
                           " sslmode=require";

        $dbconn = pg_connect($connection_string);

        if (!$dbconn) {
            return response()->json([
                'database_connected' => false,
                'error' => pg_last_error()
            ]);
        }

        return response()->json([
            'database_connected' => true,
            'connection_info' => pg_version($dbconn)
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'database_connected' => false,
            'error' => $e->getMessage()
        ]);
    }
});
Route::post('/login', [AuthController::class, 'login']);
Route::post('/bookings', [BookingController::class, 'store']);
Route::get('/portfolio', [PortfolioController::class, 'index']);
Route::get('/portfolio/{id}', [PortfolioController::class, 'show']);
Route::get('/bookings', [BookingController::class, 'index']);
Route::patch('/bookings/{id}/status', [BookingController::class, 'updateStatus']);
Route::get('/bookings/stats', [BookingController::class, 'getStats']);
Route::get('/bookings/recent', [BookingController::class, 'getRecent']);

//protected
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);

    //bookings
    Route::get('/bookings/{id}', [BookingController::class, 'show']);
    Route::delete('/bookings/{id}', [BookingController::class, 'destroy']);

    // Portfolio (except index which is public)
    Route::post('/portfolio', [PortfolioController::class, 'store']);
    Route::put('/portfolio/{id}', [PortfolioController::class, 'update']);
    Route::delete('/portfolio/{id}', [PortfolioController::class, 'destroy']);
});
