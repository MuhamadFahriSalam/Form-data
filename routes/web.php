<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Livewire\Employees\Index as EmployeesIndex;
use App\Livewire\Forms\Create as FormsCreate;
use App\Livewire\Forms\Show as FormsShow;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', [LoginController::class, 'showUserLogin'])->name('login');
Route::post('/login', [LoginController::class, 'userLogin'])->name('user.login');

Route::get('/admin/login', [LoginController::class, 'showAdminLogin'])->name('admin.login');
Route::post('/admin/login', [LoginController::class, 'adminLogin'])->name('admin.login.submit');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () {
        $user = auth()->user();
        if ($user->role === 'admin') {
            return redirect('/admin');
        }
        return redirect('/user');
    })->name('dashboard');

    Route::get('Dashboard', function () {
        return view('user.dashboard');
    })->name('user.dashboard');

    Route::get('/form/{form}', FormsShow::class)->name('forms.show');

});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::get('/employees', EmployeesIndex::class)->name('employees.index');
    Route::get('/forms/create', FormsCreate::class)->name('forms.create');
});
