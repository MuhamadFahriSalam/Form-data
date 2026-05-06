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
use App\Exports\QuizResultsExport;
use Maatwebsite\Excel\Facades\Excel;

/*
|--------------------------------------------------------------------------
| LANDING PAGE
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
})->name('landing');

/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/

// User Login
Route::get('/login', [LoginController::class, 'showUserLogin'])
    ->name('login');

Route::post('/login', [LoginController::class, 'login'])
    ->name('website.login');

// Admin Login
Route::get('/admin/login', [LoginController::class, 'showAdminLogin'])
    ->name('admin.login');

Route::post('/admin/login', [LoginController::class, 'adminLogin'])
    ->name('admin.login.submit');

// Logout
Route::post('/logout', [LoginController::class, 'logout'])
    ->name('logout');

/*
|--------------------------------------------------------------------------
| USER ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    // Dashboard User
    Route::get('/dashboard', function () {
        return view('user.dashboard');
    })->name('dashboard');

    Route::get('/user', function () {
        return view('user.dashboard');
    })->name('user.dashboard');

    // Form User
    Route::get('/form/{form}', FormsShow::class)
        ->name('forms.show');

    // Quiz Play
    Route::get('/quiz/play/{quiz}', Play::class)
        ->name('quiz.play');
});

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])->group(function () {

    // Dashboard Admin
    Route::get('/admin/dashboard', Dashboard::class)
        ->name('admin.dashboard');

    // Employees
    Route::get('/employees', EmployeesIndex::class)
        ->name('employees.index');

    // Create Form
    Route::get('/forms/create', FormsCreate::class)
        ->name('forms.create');

    // Form Respondents
    Route::get('/forms/{form}/respondents', Respondents::class)
        ->name('forms.respondents');

    // Closed Forms
    Route::get('/forms/closed', function () {

        $closedForms = \App\Models\Form::withCount('submissions')
            ->whereNotNull('closes_at')
            ->where('closes_at', '<', now())
            ->latest('closes_at')
            ->get();

        return view('admin.closed-forms', compact('closedForms'));

    })->name('forms.closed');

    // Closed Quiz
    Route::get('/quiz/closed', function () {

        $closedQuiz = \App\Models\Quiz::withCount('questions')
            ->whereNotNull('end_at')
            ->where('end_at', '<', now())
            ->latest('end_at')
            ->get();

        return view('admin.closed-quiz', compact('closedQuiz'));

    })->name('quiz.closed.admin');

    // Quiz Create
    Route::get('/quiz/create', QuizCreate::class)
        ->name('quiz.create');

    // Quiz Manage
    Route::get('/quiz/manage/{quiz}', Play::class)
        ->name('quiz.manage');

    // Edit Form
    Route::get('/forms/{form}/edit', Create::class)
        ->name('forms.edit');

    // Quiz Results
    Route::get('/quiz/{quiz}/results', Results::class)
        ->name('quiz.results');

    // Export Quiz Result
    Route::get('/quiz/{quiz}/export', function ($quizId) {

        return Excel::download(
            new QuizResultsExport($quizId),
            'hasil-quiz.xlsx'
        );

    })->name('quiz.export');
});