<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Author;
use App\Models\Book;
use App\Http\Controllers\Api\AuthorController;
use App\Http\Controllers\Api\BookController;


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

Route::post("login", [AuthorController::class,"login"])->name("login");
Route::post("register", [AuthorController::class,"register"])->name("register");

Route::group(["middleware"=>["auth:api"]],function(){

Route::get("profile",[AuthorController::class,"profile"])->name("profile");
Route::post("logout",[AuthorController::class,"logout"])->name("logout");

Route::post("create-book", [BookController::class,"create"])->name("create-book");
Route::get("list-books", [BookController::class,"list"])->name("list-books");
Route::get("single-book/{id}", [BookController::class,"single_book"])->name("single-book");
Route::post("update-book/{id}", [BookController::class,"update"])->name("update-book");
Route::get("delete-book/{id}", [BookController::class,"delete"])->name("delete-book");



});
