<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use Illuminate\Http\Request;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('libri',[BookController::class, 'index']
)->name('book.index');

Route::get('dettaglio/{id}', [BookController::class, 'show'])->name('book.show');


Route::get('contact_us', [BookController::class, 'contact_us'])->name('contattaci');


Route::post('contact_us', [BookController::class, 'contact_us_send'])->name('contattaci.send');

// inserimento libro
Route::get('inserisci_libro', [BookController::class, 'create'])->name('book.create')->middleware('auth');
Route::post('inserisci_libro', [BookController::class, 'store'])->name('book.store')->middleware('auth');

//cancellazione libro
Route::delete('cancella_libro/{id}', [BookController::class, 'destroy'])->name('book.destroy')->middleware('auth');

//modifica libro
Route::get('modifica_libro/{id}', [BookController::class, 'edit'])->name('book.edit')->middleware('auth');
Route::put('modifica_libro/{id}', [BookController::class, 'update'])->name('book.update')->middleware('auth');

//profilo utente
Route::get('user/profilo', [BookController::class, 'profile'])->name('profile')->middleware('auth');