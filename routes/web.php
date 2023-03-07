<?php

use App\Http\Livewire\SettingsForm;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\PropertiesIndex;
use App\Http\Controllers\HomeController;
use App\Http\Livewire\AnnouncementsIndex;
use App\Http\Livewire\PropertiesEditForm;
use App\Http\Livewire\PropertiesCreateForm;
use App\Http\Livewire\AnnouncementsEditForm;
use App\Http\Livewire\AnnouncementsCreateForm;
use App\Http\Livewire\ExpenseCreateForm;
use App\Http\Livewire\ExpenseShow;
use App\Http\Livewire\ExpensesIndex;
use App\Http\Livewire\ExtraordinaryFeesCreateForm;
use App\Http\Livewire\ExtraordinaryFeeShow;
use App\Http\Livewire\ExtraordinaryFeesIndex;
use App\Http\Livewire\FinancesIndex;
use App\Http\Livewire\FinesCreateForm;
use App\Http\Livewire\FineShow;
use App\Http\Livewire\FinesIndex;
use App\Http\Livewire\IncomeCreateForm;
use App\Http\Livewire\IncomeShow;
use App\Http\Livewire\IncomesIndex;
use App\Http\Livewire\PropertyShow;
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

/* FINANZAS */
Route::get('finances/', FinancesIndex::class)->name('finances.index');
Route::get('finances/expenses', ExpensesIndex::class)->name('finances.expenses.index');
Route::get('finances/expenses/create', ExpenseCreateForm::class)->name('finances.expenses.create');
Route::get('finances/expenses/{expense}', ExpenseShow::class)->name('finances.expenses.show');

Route::get('finances/incomes', IncomesIndex::class)->name('finances.incomes.index');
Route::get('finances/incomes/create', IncomeCreateForm::class)->name('finances.incomes.create');
Route::get('finances/incomes/{income}', IncomeShow::class)->name('finances.incomes.show');

/* inmuebles */
Route::get('/properties/fines', FinesIndex::class)->name('properties.fines.index');
Route::get('/properties/fines/create', FinesCreateForm::class)->name('properties.fines.create');
Route::get('/properties/fines/{fine}', FineShow::class)->name('properties.fines.show');

Route::get('/properties/extraordinary-fees', ExtraordinaryFeesIndex::class)->name('properties.extraordinary-fees.index');
Route::get('/properties/extraordinary-fees/create', ExtraordinaryFeesCreateForm::class)->name('properties.extraordinary-fees.create');
Route::get('/properties/extraordinary-fees/{extraordinaryFee}', ExtraordinaryFeeShow::class)->name('properties.extraordinary-fees.show');


Route::get('/properties', PropertiesIndex::class)->name('properties.index');
Route::get('/properties/create', PropertiesCreateForm::class)->name('properties.create');
Route::get('/properties/{property}/edit', PropertiesEditForm::class)->name('properties.edit');
Route::get('/properties/{property}', PropertyShow::class)->name('properties.show');


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
