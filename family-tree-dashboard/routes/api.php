<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FamilyController;
use App\Http\Controllers\FamilyMemberController;
use App\Models\FamilyMember;

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

// Family API Routes
Route::get('/families', [FamilyController::class, 'index']);
Route::post('/families', [FamilyController::class, 'storeApi']);
Route::get('/families/{id}', [FamilyController::class, 'show']);
Route::put('/families/{id}', [FamilyController::class, 'update']);
Route::delete('/families/{id}', [FamilyController::class, 'destroy']);

// Family Members API Routes
Route::get('/families/{familyId}/members', [FamilyMemberController::class, 'index']);
Route::post('/families/{familyId}/members', [FamilyMemberController::class, 'storeApi']);
Route::get('/families/{familyId}/members/{id}', [FamilyMemberController::class, 'show']);
Route::put('/families/{familyId}/members/{id}', [FamilyMemberController::class, 'updateApi']);
Route::delete('/families/{familyId}/members/{id}', [FamilyMemberController::class, 'destroyApi']);
// Public API Routes (no authentication needed)
Route::get('/share/{token}', [FamilyController::class, 'shareData']);

