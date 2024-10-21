<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\ResetPassword;
use App\Http\Controllers\ChangePassword;            
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\DonController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\FrontOfficeController; // Adjust the namespace according to your structure

Route::get('/restaurants', [RestaurantController::class, 'index'])->name('restaurants.index'); // Affiche la liste des restaurants
Route::get('/restaurants/create', [RestaurantController::class, 'create'])->name('restaurants.create'); // Formulaire de création
Route::post('/restaurants/store', [RestaurantController::class, 'store'])->name('restaurants.store'); // Enregistrement des nouveaux restaurants
Route::get('/restaurants/{id}/edit', [RestaurantController::class, 'edit'])->name('restaurants.edit'); // Formulaire de modification
Route::put('/restaurants/update/{id}', [RestaurantController::class, 'update'])->name('restaurants.update'); // Mise à jour d'un restaurant
Route::delete('/restaurants/{restaurant}', [RestaurantController::class, 'destroy'])->name('restaurants.destroy');
// Route pour afficher le formulaire de création de don

// Route pour enregistrer le nouveau don


Route::get('/', function () {
    return auth()->check() ? redirect('/dashboard') : view('front.index');
});
Route::get('/frontassosiation', function () {
    return auth()->check() ? redirect('/dashboard') : view('associations\indexassociation');
});
Route::get('/frontrestaurant', function () {
    return auth()->check() ? redirect('/dashboard') : view('restaurant\indexrestaurant');
});
Route::get('/register/association', [RegisterController::class, 'createAssoc']);
Route::post('/register/association', [RegisterController::class, 'storeAssoc']);
	Route::get('/register', [RegisterController::class, 'create'])->middleware('guest')->name('register');
	Route::post('/register', [RegisterController::class, 'store'])->middleware('guest')->name('register.perform');
	Route::get('/login', [LoginController::class, 'show'])->middleware('guest')->name('login');
	Route::post('/login', [LoginController::class, 'login'])->middleware('guest')->name('login.perform');
	Route::get('/reset-password', [ResetPassword::class, 'show'])->middleware('guest')->name('reset-password');
	Route::get('/reset-password', [ResetPassword::class, 'show'])->middleware('guest')->name('reset-password');
Route::post('/reset-password/send', [ResetPassword::class, 'send'])->name('reset.password.send');
Route::post('/reset-password/verify', [ResetPassword::class, 'verify'])->name('reset.password.verify');
Route::post('/reset-password/reset', [ResetPassword::class, 'reset'])->name('reset.password.reset');
	Route::post('/reset-password', [ResetPassword::class, 'send'])->middleware('guest')->name('reset.perform');
	Route::get('/change-password', [ChangePassword::class, 'show'])->middleware('guest')->name('change-password');
	Route::post('/change-password', [ChangePassword::class, 'update'])->middleware('guest')->name('change.perform');
	Route::get('/dashboard', [HomeController::class, 'index'])->name('home')->middleware('auth');
Route::resource('stock', \App\Http\Controllers\StockController::class);


Route::resource('recommendations', \App\Http\Controllers\RecommendationController::class);


Route::resource('requests', \App\Http\Controllers\AssociationRequestController::class);
Route::resource('associations', \App\Http\Controllers\AssociationController::class);

Route::get('/about-us', [DonController::class, 'aboutUs'])->name('about-us');

Route::group(['middleware' => 'auth'], function () {
	Route::get('/virtual-reality', [PageController::class, 'vr'])->name('virtual-reality');
	Route::get('/rtl', [PageController::class, 'rtl'])->name('rtl');
	Route::get('/profile', [UserProfileController::class, 'show'])->name('profile');

	Route::post('/profile', [UserProfileController::class, 'update'])->name('profile.update');
	Route::get('/profile-static', [PageController::class, 'profile'])->name('profile-static');
	Route::get('/sign-in-static', [PageController::class, 'signin'])->name('sign-in-static');
	Route::get('/sign-up-static', [PageController::class, 'signup'])->name('sign-up-static');
	Route::get('/{page}', [PageController::class, 'index'])->name('page');
	Route::post('logout', [LoginController::class, 'logout'])->name('logout');

	Route::group(['middleware' => ['role:restaurant']], function () {
		Route::get('/restaurant/front', [DonController::class, 'front'])->name('frontoffice');
		Route::get('/restaurant/dons/create/{user_id}', [DonController::class, 'create'])->name('dons.create');
		Route::get('/restaurant/dons', [DonController::class, 'index'])->name('dons.index');
		Route::post('/restaurant/dons/store/{user_id}', [DonController::class, 'store'])->name('don.store');
		Route::get('/restaurant/profile', [UserProfileController::class, 'showprofile'])->name('profile');
		Route::post('/restaurant/profile', [UserProfileController::class, 'update'])->name('profile.update');
		Route::get('/dons/filter', [DonController::class, 'filter'])->name('dons.filter');


	});

	Route::group(['middleware' => ['role:admin']], function () {
	Route::get('/backoffice/users', [UserManagementController::class, 'index'])->name('users.index');
	Route::get('/backoffice/users/restaurants', [UserManagementController::class, 'indexRestaurantUsers'])->name('users.restaurants');
    Route::get('/backoffice/users/{user}/edit', [UserManagementController::class, 'edit'])->name('users.edit');
    Route::put('/backoffice/users/{user}', [UserManagementController::class, 'update'])->name('users.update');
    Route::delete('/backoffice/users/{user}', [UserManagementController::class, 'destroy'])->name('users.destroy');
	Route::post('/backoffice/users', [UserManagementController::class, 'store'])->name('users.store'); // <-- Ajoutez cette ligne

});

	
});
