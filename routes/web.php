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
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\VisitorsController;
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

Route::middleware(['auth:sanctum','verified',])->group(function (){
    //Check Auth Dashboard
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    Route::middleware(['role:User'])->group(function(){
        Route::get('/user/dashboard', [CreateCitizenUser::class, 'userDashboard'])->name('userDashboard');
    });

    //Super Admin Routes
    Route::middleware('role:Super_Admin')->group(function(){
        Route::get('/super/admin', [AdminRegisterController::class, 'SuperAdminDashboard']);
    });


    //Admin Routes
    Route::middleware(['role:Admin'])->group(function(){

        Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('adminDashboard');

        //Admin profile
        Route::get('my/profile', [AdminProfileController::class, 'profileShow'])->name('myprofile');
        Route::post('change/password', [AdminProfileController::class, 'changePassword'])->name('password.change');
        Route::post('/update/profile-photo', [AdminProfileController::class, 'updatePhoto'])->name('photo.update');


        Route::prefix('citizen')->group(function(){
            //Citizen Controller
            Route::get('/all', [CitizenController::class, 'index'])->name('citizens');
            Route::get('/edit/{id}', [CitizenController::class, 'edit']);
            Route::get('/delete/{id}', [CitizenController::class, 'delete']);
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

            //Update Citizen Image
            Route::post('/profile-picture', [CitizenController::class, 'updateCitizenImage'])->name('citizen.updateProfile');

            //Admin Access
            Route::post('/edit/permission/{id}', [CitizenController::class, 'updateAdminPermission'])->name('permission.update');

            //User Access
            Route::post('/add/user/{id}', [CitizenController::class, 'createCitizenUser'])->name('register.user');

        });

        Route::prefix('generate')->group(function(){
            Route::get('/certificates',[pdfController::class, 'index'])->name('form');
            Route::post('/form/Certifacate of Indigency',[pdfController::class, 'generate'])->name('generate_form');
        });

        //Settigns
        Route::prefix('settings')->group(function(){
            Route::get('/purok', [SettingsController::class, 'purok'])->name('purok');
            Route::get('/purok/all', [SettingsController::class, 'getPurok'])->name('purok.get');
            Route::post('/purok/add',[SettingsController::class, 'addPurok'])->name('purok.store');
            Route::post('/get-purok', [SettingsController::class, 'getPurokDetails'])->name('purokGet');
            Route::post('/update-purok', [SettingsController::class, 'updatePurok'])->name('purok.update');
            Route::post('/delete-pruok', [SettingsController::class, 'deletePurok'])->name('purok.delete');
            Route::resource('/roles', RolesController::class);
            Route::get('/barangay_profile', [SettingsController::class, 'barangay'])->name( 'barangay');
        });

        //User Management
        Route::prefix('users')->group(function(){
            Route::get('/list', [UserManagementController::class, 'index'])->name('users.index');
        });

        //Events and Announcements
        Route::prefix('events')->group(function(){
            Route::get('/all', [EventsController::class, 'index'])->name('events');
            Route::post('/create', [EventsController::class, 'createEvent'])->name('event.create');
        });

        //Visitors
        Route::prefix('visitors')->group(function(){
            Route::get('/all', [VisitorsController::class, 'visitorAll'])->name('visitor.get');
            Route::get('/log-book', [VisitorsController::class, 'index'])->name('logbook');
            Route::post('/create', [VisitorsController::class, 'create'])->name('visitor.create');
            Route::get('/download', [VisitorsController::class, 'VisitorExport'])->name('visitor.download');
        });

        //Test
        Route::get('/test', [TestController::class, 'index']);
        Route::post('/test/add', [TestController::class, 'addCitizen'])->name('citizen.store');
        Route::get('/roles', [CitizenController::class,'getRoles']);
        Route::get('/test/get', [TestController::class, 'getCitizen'])->name('citizen.get');
        Route::post('/test/get-citizen', [TestController::class, 'getCitizenDetails'])->name('citizenGet');
        Route::post('/test/update-citizen', [TestController::class, 'updateCitizen'])->name('citizenUpdate');
        Route::post('/test/delete-citizen', [TestController::class, 'deleteCitizen'])->name('citizenDelete');
    });

});

