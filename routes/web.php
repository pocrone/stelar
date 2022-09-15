<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

use App\Http\Controllers\Siswa\Kelas\CompanyController;
use App\Http\Controllers\Siswa\Kelas\ClassListController;
use App\Http\Controllers\Siswa\Leader\AutographController;
use App\Http\Controllers\Siswa\Kelas\ClassDetailController;
use App\Http\Controllers\Siswa\Leader\LeaderDashboardController;
use App\Http\Controllers\Siswa\Leader\LeaderDispositionController;
use App\Http\Controllers\Siswa\Leader\LeaderInboxMailsContoller;
use App\Http\Controllers\Siswa\Leader\LeaderMailConceptController;
use App\Http\Controllers\Siswa\Secretary\SecretaryClassification;
use App\Http\Controllers\Siswa\Secretary\SecretaryDashboard;

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

Route::get('/', function () {
    return view('index');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'role:1'])->group(function () {
    Route::prefix('guru')->group(function () {
    });
});
Route::middleware(['auth', 'role:2'])->group(function () {

    // Pengelompokan Route Siswa dan Kelompok
    Route::prefix('siswa')->group(function () {
        // Manajemen Kelas pada Siswa
        Route::get('/daftar_kelas', [ClassListController::class, 'index'])->name('std_list_class');
        Route::get('/classdetail/{id}', [ClassDetailController::class, 'index'])->name('std_classdetail');
        Route::get('/exitclass/{id}', [ClassDetailController::class, 'exitclass'])->name('std_exitclass');
        Route::post('/join_class', [ClassListController::class, 'joinClass'])->name('join_class');
        // Manajemen Kelompok pada Siswa
        Route::get('/company', [CompanyController::class, 'index'])->name('join_company');
        Route::post('/create_company', [CompanyController::class, 'createCompany'])->name('create_company');
        Route::get('/data_company', [CompanyController::class, 'dataCompany'])->name('data_company');
        Route::get('/joinCompany/{id}', [CompanyController::class, 'joinCompany'])->name('joinCompany');
        Route::post('exitCompany/{user_id}', [CompanyController::class, 'leaveGroup'])->name('exitCompany');
        Route::post('/deleteCompany/{group_id}', [CompanyController::class, 'deleteGroup'])->name('deleteCompany');

        //Pengelompokan Route pimpinan
        Route::prefix('pimpinan')->group(function () {
            Route::get('/dashboard', [LeaderDashboardController::class, 'index'])->name('leaderdashboard');
            Route::get('/konsep_surat', [LeaderMailConceptController::class, 'index'])->name('mailconcept');
            Route::post('/buat_konsep_surat', [LeaderMailConceptController::class, 'create'])->name('create_mailconcept');
            Route::post('/edit_konsep_surat/{id}', [LeaderMailConceptController::class, 'update'])->name('edit_mailconcept');
            Route::get('/konsep_surat_data', [LeaderMailConceptController::class, 'mail_concept_data'])->name('mailconcept_data');
            Route::get('/ttd', [AutographController::class, 'index'])->name('autograph');
            Route::post('/upload_ttd', [AutographController::class, 'store'])->name('store_autograph');
            Route::get('/inbox', [LeaderInboxMailsContoller::class, 'index'])->name('inbox');
            Route::get('/detail_inbox/{id}', [LeaderInboxMailsContoller::class, 'detailInbox'])->name('detail_inbox');
            Route::get('/disposition/{id}', [LeaderDispositionController::class, 'index'])->name('leader_dispositon');
            Route::post('/add_disposition/{id}', [LeaderDispositionController::class, 'store'])->name('leader_dispositon_add');

            // Route::get('/inbox_data', [InboxMailsContoller::class, 'index'])->name('inbox_data');
        });

        //Pengelompokan Route Sekretaris
        Route::prefix('sekretaris')->group(function () {
            Route::get('/dashboard', [SecretaryDashboard::class, 'index'])->name('secretary_dashboard');
            Route::get('/klasifikasi', [SecretaryClassification::class, 'index'])->name('secretary_classification');
            Route::post('/sekretaris/tambah_klasifikasi',  [SecretaryClassification::class, 'store'])->name('add_classification');
            Route::post('/sekretaris/edit_concept/{id}',  [SecretaryClassification::class, 'edit'])->name('edit_classification');
            Route::post('delete_classification/{id}',  [SecretaryClassification::class, 'delete'])->name('delete_classification');
        });
    });
});


require __DIR__ . '/auth.php';
