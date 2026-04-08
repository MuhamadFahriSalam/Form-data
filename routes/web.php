<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Employees\Index as EmployeesIndex;
use App\Livewire\Forms\Create as FormsCreate;
use App\Livewire\Forms\Respondents;
use App\Livewire\Forms\Show as FormsShow;
use App\Livewire\Quiz\Create as QuizCreate;
use App\Livewire\Quiz\Play;
use App\Livewire\Forms\Create;
use App\Livewire\Quiz\Results;

/*
|--------------------------------------------------------------------------
| ROOT REDIRECT
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('dashboard')
        : redirect()->route('login');
});

/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/
Route::get('/login', [LoginController::class, 'showUserLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('website.login');

Route::get('/admin/login', [LoginController::class, 'showAdminLogin'])->name('admin.login');
Route::post('/admin/login', [LoginController::class, 'adminLogin'])->name('admin.login.submit');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


/*
|--------------------------------------------------------------------------
| USER ROUTES (AUTH)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () {
        return view('user.dashboard');
    })->name('dashboard');

    Route::get('/user', function () {
        return view('user.dashboard');
    })->name('user.dashboard');

    Route::get('/form/{form}', FormsShow::class)->name('forms.show');

    // 🔥 Quiz Play untuk user
    Route::get('/quiz/play/{quiz}', Play::class)->name('quiz.play');
});


/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/admin/dashboard', Dashboard::class)->name('admin.dashboard');

    Route::get('/employees', EmployeesIndex::class)->name('employees.index');

    Route::get('/forms/create', FormsCreate::class)->name('forms.create');

    Route::get('/forms/{form}/respondents', Respondents::class)
        ->name('forms.respondents');

    Route::get('/forms/closed', function () {

        $closedForms = \App\Models\Form::withCount('submissions')
            ->whereNotNull('closes_at')
            ->where('closes_at', '<', now())
            ->latest('closes_at')
            ->get();

        return view('admin.closed-forms', compact('closedForms'));

    })->name('forms.closed');

    // 🔥 FIX: quiz create tidak konflik lagi
    Route::get('/quiz/create', QuizCreate::class)->name('quiz.create');

    // 🔥 ADMIN PLAY (opsional, beda URL)
    Route::get('/quiz/manage/{quiz}', Play::class)->name('quiz.manage');

    // 🔥 Edit form (reusing Create component)
    Route::get('/forms/{form}/edit', Create::class)->name('forms.edit');

    // 🔥 Quiz results
    Route::get('/quiz/{quiz}/results', Results::class)
    ->name('quiz.results');

    // 🔥 Monitoring
    Route::get('/admin/monitoring', \App\Livewire\Admin\Monitoring::class)
    ->name('admin.monitoring');
});