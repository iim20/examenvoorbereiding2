<?php
namespace App\Http\Controllers;


use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\FaqController;


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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/faq', function () {
    return view('faq');
});

Route::get('/products', function () {
    return view('products');
});

Route::get('/faq', [FaqController::class, 'index'])->name('faq.index');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Employee
    Route::get('/employee', [EmployeeController::class, 'index']);
    Route::get('/employee/enquete', [EmployeeController::class, 'enquete_index'])->name('employee.enquete.index');
    Route::get('/employee/enquete/create', [EmployeeController::class, 'create'])->name('employee.enquete.create');
    Route::post('/employee/enquete/store', [EmployeeController::class, 'store'])->name('employee.enquete.store');
    Route::get('/employee/enquete/{enquete}/edit', [EmployeeController::class, 'edit'])->name('employee.enquete.edit');
    Route::put('/employee/enquete/{enquete}', [EmployeeController::class, 'update'])->name('employee.enquete.update');
    Route::delete('/employee/enquete/{enquete}', [EmployeeController::class, 'destroy'])->name('employee.enquete.destroy');

    // Employee bewerkt users
    Route::get('employee/users', [EmployeeController::class, 'usersIndex'])->name('employee.users.index');
    Route::get('employee/users/{user}/edit', [EmployeeController::class, 'userEdit'])->name('employee.user.edit');
    Route::put('employee/users/{edit}', [EmployeeController::class, 'userUpdate'])->name('employee.user.update');
    Route::delete('employee/users/{user}', [EmployeeController::class, 'userDestroy'])->name('employee.user.destroy');

    // Employee beheert questions
    Route::get('/employee/question', [EmployeeController::class, 'question_index'])->name('employee.question.index');
    Route::get('/employee/question/create', [EmployeeController::class, 'question_create'])->name('employee.question.create');
    Route::post('/employee/question', [EmployeeController::class, 'question_store'])->name('employee.question.store');
    Route::get('/employee/question/{question}/edit', [EmployeeController::class, 'question_edit'])->name('employee.question.edit');
    Route::put('/employee/question/{edit}', [EmployeeController::class, 'question_update'])->name('employee.question.update');
    Route::delete('/employee/question/{question}', [EmployeeController::class, 'question_destroy'])->name('employee.question.destroy');

    // Koppel route aan enquete
    Route::get('/employee/question/enquete/create/{question_id}', [EmployeeController::class, 'enqueteQuestion'])->name('employee.enquetequestion.create');
    Route::post('/employee/question/enquete', [EmployeeController::class, 'enqueteQuestion_store'])->name('employee.enquetequestion.store');



    // Klanten
    Route::get('/customer', [CustomerController::class, 'index'])->name('customer.index');
    Route::get('/customer/enquete/{enquete_id}', [CustomerController::class, 'show'])->name('customer.show');




    // Categorie
    Route::get('/categorie/food', [CategorieController::class, 'food'])->name('categorie.food');
    Route::get('/categorie/sport', [CategorieController::class, 'sport'])->name('categorie.sport');
    Route::get('/categorie/health', [CategorieController::class, 'health'])->name('categorie.health');
    Route::get('/categorie/computer', [CategorieController::class, 'computer'])->name('categorie.computer');

});









 





Route::resource('categorie', CategorieController::class)
    ->name('*', 'categorie');

Route::resource('product', ProductController::class)
    ->middleware(['auth'])->name('*', 'product');
Route::get('product/create', [ProductController::class, 'create'])->name('product.create');
Route::post('product/approve/{id}', [ProductController::class, 'productApprove'])->name('product.approve');
Route::get('product/approve/{id}', [ProductController::class, 'productApprove'])->name('product.approve');




require __DIR__.'/auth.php';
