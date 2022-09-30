<?php

use App\Http\Controllers\ListingController;
use App\Http\Controllers\UserController;
use App\Models\Listing;
use Illuminate\Http\Request;
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

// Common Resource Routes:
// index - Show all listings
// show - Show single listing
// create - Show form to create new listing
// store - Store new listing
// edit - Show form to edit listing
// update - Update listing
// destroy - Delete listing 



// All listings
Route::get('/', 
[ListingController::class, 
'index']);



//Show Create Form
Route::get('/listings/create', 
[ListingController::class, 
'create']);

//Store listing data
Route::post('/listings', 
[ListingController::class,
'store']);

//Show Edit form
Route::get('/listings/{listing}/edit',
[ListingController::class,'edit']);

//Update Listing
Route::put('/listings/{listing}',
[ListingController::class,'update']);

//Delete Listing
Route::delete('/listings/{listing}',
[ListingController::class,'destroy']);

//Single listings
Route::get('/listings/{listing}', 
[ListingController::class,
'show']);

//Show Register/Create form
Route::get('register',
 [UserController::class,
 'create']);

 //Create New user
 Route::post('users',
 [UserController::class, 
 'store']);