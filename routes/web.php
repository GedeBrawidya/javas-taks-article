<?php

use Illuminate\Support\Facades\Route;
use App\Models\Article;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    $articles = Article::with(['category', 'user'])->latest()->paginate(9);
    $data['articles'] = $articles;
    return view('welcome', $data);
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
