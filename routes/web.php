<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Employees\Index as EmployeesIndex;
use App\Livewire\Forms\Create as FormsCreate;
use App\Livewire\Forms\Show as FormsShow;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        $user = auth()->user();

        if ($user->role === 'admin') {
            return redirect('/admin');
        }

        return redirect('/user');
    })->name('dashboard');

    Route::get('/user', function () {
        return view('user.dashboard');
    })->name('user.dashboard');

    Route::get('/form/{form}', FormsShow::class)->name('forms.show');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::get('/employees', EmployeesIndex::class)->name('employees.index');
    Route::get('/forms/create', FormsCreate::class)->name('forms.create');
});

require __DIR__.'/auth.php';
