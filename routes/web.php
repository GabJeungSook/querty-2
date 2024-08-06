<?php

use App\Livewire\Admin\Reports;
use App\Livewire\Admin\Accounts;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Users\ListUsers;
use App\Livewire\Admin\Facilities;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
Route::get('/dashboard', Dashboard::class)->middleware(['auth', 'verified', 'role:admin'])->name('admin.dashboard');
Route::get('/accounts', Accounts::class)->middleware(['auth', 'verified', 'role:admin'])->name('admin.accounts');
Route::get('/facilities', Facilities::class)->middleware(['auth', 'verified', 'role:admin'])->name('admin.facilities');
Route::get('/reports', Reports::class)->middleware(['auth', 'verified', 'role:admin'])->name('admin.reports');
});
