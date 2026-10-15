<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CertificationSchemeController;
use App\Http\Controllers\StudentController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\CertificationScheme;
use App\Models\Student;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welkome');
}) ->name('welkome');

Route::get('/home', function () {
    $students = Student::latest()->take(3)->get(['name', 'major']);

    return view('home', compact('students'));
})->name('home');


Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('students', StudentController::class)->except(['index', 'show']);
    Route::resource('certification-schemes', CertificationSchemeController::class)
        ->parameters(['certification-schemes' => 'certificationScheme'])
        ->except(['show']);
});

Route::middleware('auth')->group(function () {
    Route::get('/students', [StudentController::class, 'index'])->name('students.index');
    Route::get('/students/{student}', [StudentController::class, 'show'])->name('students.show');

    Route::get('/dashboard', function () {
        $user = Auth::user();

        if (! $user instanceof User || ! $user->isAdmin()) {
            return view('user-dashboard', [
                'students' => Student::with('certificationScheme')->latest()->take(5)->get(),
                'studentCount' => Student::count(),
            ]);
        }

        return view('dashboard', [
            'studentCount' => Student::count(),
            'schemeCount' => CertificationScheme::count(),
        ]);
    })->name('dashboard');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
