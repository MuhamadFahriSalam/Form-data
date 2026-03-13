<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Employees\Index as EmployeesIndex;
use App\Livewire\Forms\Create as FormsCreate;
use App\Livewire\Forms\Respondents;
use App\Livewire\Forms\Show as FormsShow;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', [LoginController::class, 'showUserLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('website.login');

Route::get('/admin/login', [LoginController::class, 'showAdminLogin'])->name('admin.login');
Route::post('/admin/login', [LoginController::class, 'adminLogin'])->name('admin.login.submit');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () {
        return view('user.dashboard');
    })->name('dashboard');

    Route::get('/user', function () {
        return view('user.dashboard');
    })->name('user.dashboard');

    Route::get('/form/{form}', FormsShow::class)->name('forms.show');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
Route::get('/forms/closed', function () {

    $closedForms = \App\Models\Form::withCount('submissions')
        ->whereNotNull('closes_at')
        ->where('closes_at', '<', now())
        ->latest('closes_at')
        ->get();

    return view('admin.closed-forms', compact('closedForms'));

})->name('forms.closed');

    Route::get('/forms/{form}/respondents', Respondents::class)
        ->name('forms.respondents');
    Route::get('/admin/dashboard', Dashboard::class)->name('admin.dashboard');
    Route::get('/employees', EmployeesIndex::class)->name('employees.index');
    Route::get('/forms/create', FormsCreate::class)->name('forms.create');
});
