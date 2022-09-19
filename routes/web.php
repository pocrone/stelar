<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Siswa\Leader\LeaderRetention;
use App\Http\Controllers\Siswa\Kelas\CompanyController;
use App\Http\Controllers\Siswa\Archivist\ArchivistInbox;
use App\Http\Controllers\Siswa\Secretary\SecretaryInbox;
use App\Http\Controllers\Siswa\Kelas\ClassListController;
use App\Http\Controllers\Siswa\Secretary\SecretaryOutbox;
use App\Http\Controllers\Siswa\Leader\AutographController;
use App\Http\Controllers\Siswa\Secretary\SecretaryConcept;
use App\Http\Controllers\Siswa\Kelas\ClassDetailController;
use App\Http\Controllers\Siswa\Archivist\ArchivistDashboard;
use App\Http\Controllers\Siswa\Secretary\SecretaryDashboard;
use App\Http\Controllers\Siswa\Secretary\SecretaryRetention;
use App\Http\Controllers\Siswa\Archivist\ArchivistDisposition;
use App\Http\Controllers\Siswa\Archivist\ArchivistInboxRetention;
use App\Http\Controllers\Siswa\Archivist\ArchivistOutbox;
use App\Http\Controllers\Siswa\Secretary\SecretaryDisposition;
use App\Http\Controllers\Siswa\Leader\LeaderDashboardController;
use App\Http\Controllers\Siswa\Leader\LeaderInboxMailsContoller;
use App\Http\Controllers\Siswa\Secretary\SecretaryClassification;
use App\Http\Controllers\Siswa\Leader\LeaderDispositionController;
use App\Http\Controllers\Siswa\Leader\LeaderMailConceptController;
use App\Http\Controllers\Siswa\Leader\MailCorrectionController;

use App\Models\MailCorrection;

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
            Route::post('/delete_konsep_surat/{id}', [LeaderMailConceptController::class, 'destroy'])->name('delete_concept');
            Route::get('/konsep_surat_data', [LeaderMailConceptController::class, 'mail_concept_data'])->name('mailconcept_data');
            Route::get('/ttd', [AutographController::class, 'index'])->name('autograph');
            Route::post('/upload_ttd', [AutographController::class, 'store'])->name('store_autograph');
            Route::get('/inbox', [LeaderInboxMailsContoller::class, 'index'])->name('inbox');
            Route::get('/detail_inbox/{id}', [LeaderInboxMailsContoller::class, 'detailInbox'])->name('detail_inbox');
            Route::get('/disposition/{id}', [LeaderDispositionController::class, 'index'])->name('leader_dispositon');
            Route::post('/add_disposition/{id}', [LeaderDispositionController::class, 'store'])->name('leader_dispositon_add');
            Route::get('/inbox_retensi', [LeaderRetention::class, 'inbox_retention'])->name('inbox_retention');
            Route::get('/outbox_retensi', [LeaderRetention::class, 'outbox_retention'])->name('outbox_retention');
            Route::get('/koreksi_surat', [MailCorrectionController::class, 'index'])->name('mail_correct');
            Route::post('/add_koreksi_surat', [MailCorrectionController::class, 'store'])->name('add_mail_correct');
            // Route::get('/cek/{id}', [MailCorrectionController::class, 'getstatus_koreksi'])->name('mail_correct');
            Route::get('/detail_surat_keluar/{id}', [MailCorrectionController::class, 'viewMail'])->name('leader_detail_outbox');
            Route::get('/approve/{id}', [MailCorrectionController::class, 'approveAutograph'])->name('approve_sign');

            // Route::get('/inbox_data', [InboxMailsContoller::class, 'index'])->name('inbox_data');
        });

        //Pengelompokan Route Sekretaris
        Route::prefix('sekretaris')->group(function () {
            Route::get('/dashboard', [SecretaryDashboard::class, 'index'])->name('secretary_dashboard');
            //Klasfikasi
            Route::get('/klasifikasi', [SecretaryClassification::class, 'index'])->name('secretary_classification');
            Route::post('/tambah_klasifikasi',  [SecretaryClassification::class, 'store'])->name('add_classification');
            Route::post('/edit_concept/{id}',  [SecretaryClassification::class, 'edit'])->name('edit_classification');
            Route::post('delete_classification/{id}',  [SecretaryClassification::class, 'delete'])->name('delete_classification');
            //surat masuk
            Route::get('/inbox', [SecretaryInbox::class, 'index'])->name('inbox_secretary');
            Route::post('/add_inbox', [SecretaryInbox::class, 'store'])->name('add_inbox_secretary');
            Route::post('/file_inbox/{id}', [SecretaryInbox::class, 'upload_mail'])->name('file_inbox');

            Route::post('/edit_inbox/{id}', [SecretaryInbox::class, 'edit'])->name('edit_inbox_secretary');
            Route::get('/inbox_detail/{id}', [SecretaryInbox::class, 'inbox_detail'])->name('inbox_detail_secretary');
            Route::get('/disposition/{id}', [SecretaryDisposition::class, 'index'])->name('secretary_dispositon');
            Route::post('/add_disposition/{id}', [SecretaryDisposition::class, 'store'])->name('secretary_dispositon_add');
            //konsep surat
            Route::get('/konsep_surat', [SecretaryConcept::class, 'index'])->name('data_concept');
            //surat keluar


            Route::post('/file_outbox/{id}', [SecretaryOutbox::class, 'upload_mail'])->name('file_outbox');
            Route::get('/outbox', [SecretaryOutbox::class, 'index'])->name('outbox_data');
            Route::get('/buat_surat/{id}', [SecretaryOutbox::class, 'createOutbox'])->name('create_outbox');
            Route::post('/store_mail', [SecretaryOutbox::class, 'storeMail'])->name('store_mail');
            Route::get('/lihat_surat/{id}', [SecretaryOutbox::class, 'viewMail'])->name('viewMail');
            Route::get('/detail_surat_keluar/{id}', [SecretaryOutbox::class, 'detailMail'])->name('creatdetailMaile_outbox');
            Route::get('/export_pdf/{id}', [SecretaryOutbox::class, 'exportPDF'])->name('exportPDF');

            Route::get('/inbox_retensi', [SecretaryRetention::class, 'inbox_retention'])->name('inbox_retention_sec');
            Route::get('/outbox_retensi', [SecretaryRetention::class, 'outbox_retention'])->name('outbox_retention_sec');


            Route::get('pathtoimages/{var2}', [SecretaryOutbox::class, 'getAuthorizedImage'])->name('link_logo');
        });

        //Pengelompokan Route arsiparis
        Route::prefix('arsiparis')->group(function () {
            Route::get('/dashboard', [ArchivistDashboard::class, 'index'])->name('archivist_dashboard');

            Route::get('/inbox', [ArchivistInbox::class, 'index'])->name('inbox_archivist');
            Route::post('/add_inbox', [ArchivistInbox::class, 'store'])->name('add_inbox_archivist');
            Route::post('/set_class/{id}', [ArchivistInbox::class, 'edit_classification'])->name('set_class_archivist');
            Route::post('/set_retention/{id}', [ArchivistInbox::class, 'set_retention'])->name('set_retention_archivist');
            Route::post('/set_location/{id}', [ArchivistInbox::class, 'set_location'])->name('set_location_archivist');
            Route::get('/inbox_detail/{id}', [ArchivistInbox::class, 'inbox_detail'])->name('inbox_detail_archivist');
            Route::get('/disposition/{id}', [ArchivistDisposition::class, 'index'])->name('archivist_dispositon');
            Route::post('/add_disposition/{id}', [ArchivistDisposition::class, 'store'])->name('archivist_dispositon_add');

            Route::get('/inbox_retensi', [ArchivistInboxRetention::class, 'inbox_retention'])->name('inbox_retention_arc');
            Route::get('/outbox_retensi', [ArchivistInboxRetention::class, 'outbox_retention'])->name('outbox_retention_arc');

            Route::get('/outbox', [ArchivistOutbox::class, 'index'])->name('outbox_data_arc');
            Route::get('/lihat_surat/{id}', [ArchivistOutbox::class, 'viewMail'])->name('viewMail_arc');
            Route::post('/set_class_outbox/{id}', [ArchivistOutbox::class, 'edit_classification'])->name('set_class_archivist_out');
            Route::post('/set_retention_outbox/{id}', [ArchivistOutbox::class, 'set_retention'])->name('set_retention_archivist_out');
            Route::post('/set_location_outbox/{id}', [ArchivistOutbox::class, 'set_location'])->name('set_location_archivist_out');
        });
    });
});


require __DIR__ . '/auth.php';
