<?php

use App\Models\Property;
use App\Http\Livewire\SettingsForm;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\PropertiesIndex;
use App\Http\Controllers\HomeController;
use App\Http\Livewire\AnnouncementsIndex;
use App\Http\Livewire\PropertiesEditForm;
use App\Http\Livewire\PropertiesCreateForm;
use App\Http\Livewire\AnnouncementsEditForm;
use App\Http\Livewire\AnnouncementsCreateForm;
use App\Http\Livewire\UserEditForm;
use App\Http\Livewire\UsersCreateForm;
use App\Http\Livewire\UsersIndex;

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

Route::get('/admin/users', UsersIndex::class)->name('admin.users.index');
Route::get('/admin/users/create', UsersCreateForm::class)->name('admin.users.create');
Route::get('/admin/users/{user}/edit', UserEditForm::class)->name('admin.users.edit');

Route::get('announcements', AnnouncementsIndex::class)->name('announcements.index');
Route::get('announcements/create', AnnouncementsCreateForm::class)->name('announcements.create');
Route::get('announcements/{announcement}/edit', AnnouncementsEditForm::class)->name('announcements.edit');

Route::get('/properties', PropertiesIndex::class)->name('properties.index');
Route::get('/properties/create', PropertiesCreateForm::class)->name('properties.create');
Route::get('/properties/{property}/edit', PropertiesEditForm::class)->name('properties.edit');

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
