<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\ArticleController;

Route::get('/', [AppController::class, 'loginPage'])->name('loginPage');
Route::post('/', [AppController::class, 'login'])->name('login');

//nanti ganti post biar ga bisa dimasukin lewat search bar browser
Route::post('/logout', [AppController::class, 'logout'])->name('logout');

Route::get('/register', [AppController::class, 'registerPage'])->name('registerPage');
Route::post('/register', [AppController::class, 'register'])->name('register');

Route::get('/home', [AppController::class, 'home'])->name('home')->middleware('authenticateUser');

Route::get('/pets', [AppController::class, 'petsPage'])->name('petsPage')->middleware('authenticateUser');
Route::post('/pets', [PetController::class, 'filterPets'])->name('filterPets');
Route::get('/pets/{pet}/detail', [AppController::class, 'petDetail'])->name('petDetail')->middleware('authenticateUser');
Route::post('/pet/favorite/{pet}', [PetController::class, 'addToFavorites'])->name('petFavorite');
Route::delete('/pet/favorite/{pet}', [PetController::class, 'removeFromFavorite'])->name('petFavorite');
Route::get('/newPet', [AppController::class, 'addNewPetPage'])->name('addNewPetPage')->middleware('authenticateUser');
Route::post('/newPet', [PetController::class, 'addNewPet'])->name('addNewPet');

Route::get('/articles', [AppController::class, 'articlesPage'])->name('articlesPage')->middleware('authenticateUser');
Route::post('/articles', [ArticleController::class, 'filterArticles'])->name('filterArticles');
Route::get('/articles/{article}/detail', [AppController::class, 'articleDetail'])->name('articleDetail')->middleware('authenticateUser');
Route::post('/article/favorite/{article}', [ArticleController::class, 'addToFavorites'])->name('articleFavorite');
Route::delete('/article/favorite/{article}', [ArticleController::class, 'removeFromFavorite'])->name('articleFavorite');
Route::get('/newArticle', [AppController::class, 'addNewArticlePage'])->name('addNewArticlePage')->middleware('authenticateUser');
Route::post('/newArticle', [ArticleController::class, 'addNewArticle'])->name('addNewArticle');

Route::get('/favorites', [AppController::class, 'favoritesPage'])->name('favoritesPage')->middleware('authenticateUser');


Route::get('/profile', [AppController::class, 'profilePage'])->name('profilePage')->middleware('authenticateUser');
Route::post('/profile', [UserController::class, 'profileUpdate'])->name('profileUpdate');

Route::get('/users', [AppController::class, 'users'])->name('users')->middleware('authenticateUser');