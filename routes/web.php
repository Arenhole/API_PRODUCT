<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProduitController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('view/produit');
});

Route::get('view/produit', [ProduitController::class, 'indexView'])->name('path.indexView');
Route::get('view/produit/create', [ProduitController::class, 'create'])->name('path.create');
Route::post('produit', [ProduitController::class, 'storeView'])->name('path.storeView');
Route::get('view/produit/{id}', [ProduitController::class, 'showView'])->name('path.showView');
Route::get('view/produit/{id}/edit', [ProduitController::class, 'edit'])->name('path.edit');
Route::put('view/produit/{id}', [ProduitController::class, 'updateView'])->name('path.updateView');
Route::delete('produit/{id}', [ProduitController::class, 'destroyView'])->name('path.destroyView');
