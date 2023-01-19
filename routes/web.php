<?php

use App\Http\Controllers\HomeController;
use App\Http\Livewire\AnnouncementsCreateForm;
use App\Http\Livewire\AnnouncementsEditForm;
use App\Http\Livewire\AnnouncementsIndex;
use App\Http\Livewire\SettingsForm;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', HomeController::class)->name('home');

Route::get('announcements', AnnouncementsIndex::class)->name('announcements.index');
Route::get('announcements/create', AnnouncementsCreateForm::class)->name('announcements.create');
Route::get('announcements/{announcement}/edit', AnnouncementsEditForm::class)->name('announcements.edit');

Route::get('/settings', SettingsForm::class)->name('settings');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
