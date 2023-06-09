<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\CustomerController;


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


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/employee/enquete', [EmployeeController::class, 'index'])->name('employee.index');
    // Route::get('/employee/enquete', [EmployeeController::class, 'index']);
    Route::get('/employee/enquete/create', [EmployeeController::class, 'create'])->name('employee.create');
    Route::post('/employee/enquete', [EmployeeController::class, 'store'])->name('employee.store');
    Route::get('/employee/enquete/{enquete}/edit', [EmployeeController::class, 'edit'])->name('employee.edit');
    Route::put('/employee/enquete/{edit}', [EmployeeController::class, 'update'])->name('employee.update');
    Route::delete('/employee/enquete/{enquete}', [EmployeeController::class, 'destroy'])->name('employee.destroy');



    Route::get('/employee/question', [EmployeeController::class, 'question_index'])->name('employee.question.index');
    Route::get('/employee/question/create', [EmployeeController::class, 'question_create'])->name('employee.question.create');
    Route::post('/employee/question', [EmployeeController::class, 'question_store'])->name('employee.question.store');
    Route::get('/employee/question/{question}/edit', [EmployeeController::class, 'question_edit'])->name('employee.question.edit');
    Route::put('/employee/question/{edit}', [EmployeeController::class, 'question_update'])->name('employee.question.update');
    Route::delete('/employee/question/{question}', [EmployeeController::class, 'question_destroy'])->name('employee.question.destroy');

    Route::get('/employee/question/enquete/create/{question_id}', [EmployeeController::class, 'enqueteQuestion'])->name('employee.enquetequestion.create');

    Route::post('/employee/question/enquete', [EmployeeController::class, 'enqueteQuestion_store'])->name('employee.enquetequestion.store');



    // Route::get('/employee/enquete', [EmployeeController::class, 'question_enquete'])->name('getQuestionsEnquete');



    Route::get('/customer', [CustomerController::class, 'index'])->name('customer.index');
    Route::get('/customer/{enquete_id}/questions', [CustomerController::class, 'enqueteQuestion'])->name('customer.enquetequestion');
    Route::get('/customer/{enquete_id}/question/{question_id}/answer', [CustomerController::class, 'showAnswerForm'])->name('customer.showAnswerForm');
    Route::post('/customer/{enquete_id}/question/{question_id}/answer', [CustomerController::class, 'submitAnswer'])->name('customer.submitAnswer');

    


    Route::get('/customer/create', [CustomerController::class, 'create'])->name('customer.create');
    Route::post('/customer', [CustomerController::class, 'store'])->name('customer.store');

});


require __DIR__.'/auth.php';
