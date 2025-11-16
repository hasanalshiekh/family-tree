<?php

use App\Http\Controllers\FamilyController;
use App\Http\Controllers\FamilyMemberController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// الصفحة الرئيسية
// routes/web.php

Route::get('/', [HomeController::class, 'index'])->name('welcome');
// أو إذا كنت تستخدم إصداراً قديماً من Laravel:
// Route::get('/', 'App\Http\Controllers\HomeController@index');

// إنشاء عائلة جديدة
Route::get('/family/create', [FamilyController::class, 'create'])->name('family.create');
Route::post('/family/store', [FamilyController::class, 'store'])->name('family.store');

// داش بورد العائلة
Route::get('/family/{id}/dashboard', [FamilyController::class, 'dashboard'])->name('family.dashboard');
Route::get('/family/{id}/tree', [FamilyController::class, 'tree'])->name('family.tree');

// مشاركة العائلة
Route::get('/share/{token}', [FamilyController::class, 'share'])->name('family.share');

// تصدير PDF
Route::get('/family/{id}/export-pdf', [FamilyController::class, 'exportPdf'])->name('family.export-pdf');

// إدارة أعضاء العائلة
Route::get('/family/{familyId}/member/create', [FamilyMemberController::class, 'create'])->name('family.member.create');
Route::post('/family/{familyId}/member/store', [FamilyMemberController::class, 'store'])->name('family.member.store');
Route::get('/family/{familyId}/member/{memberId}/edit', [FamilyMemberController::class, 'edit'])->name('family.member.edit');
Route::put('/family/{familyId}/member/{memberId}/update', [FamilyMemberController::class, 'update'])->name('family.member.update');
Route::delete('/family/{familyId}/member/{memberId}/delete', [FamilyMemberController::class, 'destroy'])->name('family.member.destroy');