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
| ROOT REDIRECT
|--------------------------------------------------------------------------
*/
// Redirect root URL ke dashboard jika sudah login, atau ke login jika belum
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
// User login routes
Route::get('/login', [LoginController::class, 'showUserLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('website.login');

// Admin login routes
Route::get('/admin/login', [LoginController::class, 'showAdminLogin'])->name('admin.login');
Route::post('/admin/login', [LoginController::class, 'adminLogin'])->name('admin.login.submit');

// Logout route (bisa digunakan untuk user maupun admin)
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


/*
|--------------------------------------------------------------------------
| USER ROUTES (AUTH)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    // 🔥 Dashboard umum (bisa diisi dengan info quiz yang sudah diikuti, dll)
    Route::get('/dashboard', function () {
        return view('user.dashboard');
    })->name('dashboard');

    // 🔥 Dashboard user (bisa diisi dengan info quiz yang sudah diikuti, dll)
    Route::get('/user', function () {
        return view('user.dashboard');
    })->name('user.dashboard');

    // 🔥 Lihat form untuk user
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

    // 🔥 Dashboard admin
    Route::get('/admin/dashboard', Dashboard::class)->name('admin.dashboard');

    // 🔥 Daftar karyawan
    Route::get('/employees', EmployeesIndex::class)->name('employees.index');

    // 🔥 Buat form baru
    Route::get('/forms/create', FormsCreate::class)->name('forms.create');

    // 🔥 Daftar responden untuk setiap form
    Route::get('/forms/{form}/respondents', Respondents::class)
        ->name('forms.respondents');

    // 🔥 Daftar form yang sudah ditutup
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

    // 🔥 Export hasil quiz ke Excel
    Route::get('/quiz/{quiz}/export', function ($quizId) {
        return Excel::download(
            new QuizResultsExport($quizId),
            'hasil-quiz.xlsx'
        );
    })->name('quiz.export');
});