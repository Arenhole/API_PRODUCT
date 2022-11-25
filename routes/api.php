<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProduitController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('produits', [ProduitController::class, 'index'])->name('path.index');
Route::post('produit', [ProduitController::class, 'store'])->name('path.store');
Route::get('produit/{id}', [ProduitController::class, 'show'])->name('path.show');
Route::put('produit/{id}', [ProduitController::class, 'update'])->name('path.update');
Route::delete('produit/{id}', [ProduitController::class, 'destroy'])->name('path.destroy');
