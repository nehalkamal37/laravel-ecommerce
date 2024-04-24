<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Dash\UsersController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], 
    function(){ 

Route::get('/dashboard', function () {
    return view('dash.index');
})->middleware(['auth', 'verified','dashaccess'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(['auth', 'verified','dashaccess'])->as('dashboard.')->prefix('dashboard')
->group( function(){

Route::get('/', function () {
    return view('dash.index');
})->name('home') ;
      
Route::resources([
    'users'=> UsersController::class,
    'categories'=> CategoryController::class,
    'products'=> ProductController::class,
    
]);
    }
); 

         // no need to be verified
    Route::get('/', [HomeController::class ,'index'])->name('main');
    Route::resources([
         'carts'=>CartController::class,
        
    ]);

});

Route::get('/php', function() {
    return phpinfo();
});



require __DIR__.'/auth.php';
