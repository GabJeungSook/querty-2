<?php

use App\Livewire\Admin\Reports;
use App\Livewire\Admin\Accounts;
use App\Livewire\Facility\Cases;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Users\ListUsers;
use App\Livewire\Admin\Facilities;
use App\Livewire\Facility\Patients;
use App\Livewire\Facility\Diagnosis;
use Illuminate\Support\Facades\Route;
use App\Livewire\Facility\PatientHistory;
use App\Livewire\Facility\Dashboard as FacilityDashboard;
use App\Livewire\Facility\UserManagement;

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

Route::get('/dashboard', function () {
    if(auth()->user()->role_id === 1)
    {
        return redirect()->route('admin.dashboard');
    }else{
        return redirect()->route('facility.dashboard');
    }
})->name('dashboard');

Route::get('admin/dashboard', Dashboard::class)->middleware(['auth', 'verified', 'role:admin'])->name('admin.dashboard');
Route::get('admin/accounts', Accounts::class)->middleware(['auth', 'verified', 'role:admin'])->name('admin.accounts');
Route::get('admin/facilities', Facilities::class)->middleware(['auth', 'verified', 'role:admin'])->name('admin.facilities');
Route::get('admin/reports', Reports::class)->middleware(['auth', 'verified', 'role:admin'])->name('admin.reports');


// facility routes
Route::get('/facility/dashboard', FacilityDashboard::class)->middleware(['auth', 'verified', 'role:facility,staff'])->name('facility.dashboard');
Route::get('/facility/cases', Cases::class)->middleware(['auth', 'verified'])->name('facility.cases');
Route::get('/facility/patients', Patients::class)->middleware(['auth', 'verified', 'role:facility,staff'])->name('facility.patients');
Route::get('/facility/user-management', UserManagement::class)->middleware(['auth', 'verified', 'role:facility,staff'])->name('facility.user-management');
Route::get('/facility/diagnosis', Diagnosis::class)->middleware(['auth', 'verified', 'role:facility,staff'])->name('facility.diagnosis');
//route with parameter record
Route::get('/facility/patient-history/{record}', PatientHistory::class)->middleware(['auth', 'verified', 'role:facility,staff'])->name('facility.patient-history');
});
