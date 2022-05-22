<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Super_Admin\AdminRegisterController;
use App\Http\Controllers\Admin\CitizenController;
use App\Http\Controllers\Admin\pdfController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\Guest\CreateCitizenUser;
use App\Http\Controllers\Admin\EventsController;
use App\Http\Controllers\UserController;
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
Route::middleware(['guest'])->group( function () {
    Route::get('/', function(){
        return view('home.homepage');
    });

    Route::get('/register/citizen', [CreateCitizenUser::class, 'index'])->name('registerAsCitizen');
    Route::post('/register/new/citizen', [CreateCitizenUser::class, 'registerCitizen'])->name('register.citizen');

});


//Route::get('/admin', function (){
//   return view('layouts.admin');
//});
Route::middleware(['auth:sanctum','verified',])->group(function (){
    //Check Auth Dashboard
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');


    Route::middleware('role:User')->group(function(){
        Route::get('/user/dashboard', [CreateCitizenUser::class, 'userDashboard'])->name('userDashboard');
    });


    //Super Admin Routes
    Route::middleware('role:Super_Admin')->group(function(){
        Route::get('/super/admin', [AdminRegisterController::class, 'SuperAdminDashboard']);
    });


    //Admin Routes
    Route::middleware('role:Admin')->group(function(){

        Route::get('/admin/dashboard', [CitizenController::class, 'dashboard'])->name('adminDashboard');

        Route::prefix('user')->group(function(){
            Route::get('admin/user/profile', [UserController::class, 'profileShow'])->name('my.profile');
            Route::post('change/password', [UserController::class, 'changePassword'])->name('password.change');
        });

        Route::prefix('citizen')->group(function(){
            //dashboard
            //Citizen Controller
            Route::get('/all', [CitizenController::class, 'index'])->name('citizens');
            Route::get('/edit/{id}', [CitizenController::class, 'edit']);
            Route::get('/delete/{id}', [CitizenController::class, 'delete']);
            Route::get('/view/{id}', [CitizenController::class, 'view']);
            Route::post('/update/{id}', [CitizenController::class, 'update']);
            Route::get('/add/list', [CitizenController::class, 'addCitizenView'])->name('add.view');
            Route::post('/add', [CitizenController::class, 'addCitizen'])->name('store.citizen');

            //Import-Export-Ctizens
            Route::get('/download', [CitizenController::class, 'CitizensExport'])->name('export.citizen');
            Route::post('/import', [CitizenController::class, 'CitizensImport'])->name('import.citizen');
            Route::get('/template/download', [CitizenController::class, 'CitizensExportTemplate'])->name('template');
            //Recycle Bin
            Route::get('/restore/{id}', [CitizenController::class,'restore']);
            Route::get('/force-delete/{id}', [CitizenController::class, 'forceDelete']);
        });

        Route::prefix('generate')->group(function(){
            Route::get('/certificates',[pdfController::class, 'index'])->name('form');
            Route::post('/form/Certifacate of Indigency',[pdfController::class, 'generate'])->name('generate_form');
        });

        Route::prefix('settings')->group(function(){
            Route::get('/purok', [SettingsController::class, 'index'])->name('purok');
            Route::get('/purok/all', [SettingsController::class, 'getPurok'])->name('purok.get');
            Route::post('/purok/add',[SettingsController::class, 'addPurok'])->name('purok.store');
            Route::post('/get-purok', [SettingsController::class, 'getPurokDetails'])->name('purokGet');
            Route::post('/update-purok', [SettingsController::class, 'updatePurok'])->name('purok.update');
            Route::post('/delete-pruok', [SettingsController::class, 'deletePurok'])->name('purok.delete');
            Route::resource('/roles', RolesController::class);
            Route::get('/barangay_profile', [SettingsController::class, 'barangay'])->name( 'barangay');
        });

        //Events and Announcements
        Route::prefix('events')->group(function(){
            Route::get('/all', [EventsController::class, 'index'])->name('events');
            Route::post('/create', [EventsController::class, 'createEvent'])->name('event.create');
        });

        Route::get('/test', [TestController::class, 'index']);
        Route::post('/test/add', [TestController::class, 'addCitizen'])->name('citizen.store');
        Route::get('/roles', [CitizenController::class,'getRoles']);
        Route::get('/test/get', [TestController::class, 'getCitizen'])->name('citizen.get');
        Route::post('/test/get-citizen', [TestController::class, 'getCitizenDetails'])->name('citizenGet');
        Route::post('/test/update-citizen', [TestController::class, 'updateCitizen'])->name('citizenUpdate');
        Route::post('/test/delete-citizen', [TestController::class, 'deleteCitizen'])->name('citizenDelete');
    });

});

