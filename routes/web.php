<?php

use App\Http\Controllers\Guru\ArchiveController;
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
use App\Http\Controllers\Siswa\Kelas\LessonAssignmentController;
use App\Http\Controllers\Guru\ClassController;
use App\Http\Controllers\Guru\LessonController;
use App\Http\Controllers\Guru\AssignmentController;
use App\Http\Controllers\Guru\ProgressController;
use App\Http\Controllers\Guru\StudentsController;
use App\Http\Controllers\Guru\LeaderController;
use App\Http\Controllers\Guru\SecretaryController;
use PhpParser\Builder\ClassConst;

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
        //manage class
        Route::get('/create_class', [ClassController::class, 'createClass'])->name('create_class');
        Route::post('/store_class', [ClassController::class, 'store'])->name('store_class');
        Route::get('/course/{id}', [ClassController::class, 'index'])->name('course');
        Route::get('/edit_class/{id}', [ClassController::class, 'edit'])->name('edit_class');
        Route::post('/update_class', [ClassController::class, 'update'])->name('update_class');
        Route::get('/delete_class/{id}', [ClassController::class, 'delete'])->name('delete_class');
        //manage lesson
        Route::get('/lessons/{id}', [LessonController::class, 'index'])->name('lessons');
        Route::get('/create_lesson/{id}', [LessonController::class, 'create'])->name('create_lesson');
        Route::post('/insert_lesson', [LessonController::class, 'insert'])->name('insert_lesson');
        Route::get('/show_lesson/{classroom_id}/{lesson_id}', [LessonController::class, 'show'])->name('show_lesson');
        Route::get('/download_lesson/{lesson_id}', [LessonController::class, 'download'])->name('download_lesson');
        Route::get('/edit_lesson/{lesson_id}', [LessonController::class, 'edit'])->name('edit_lesson');
        Route::post('/update_lesson/{lesson_id}', [LessonController::class, 'update'])->name('update_lesson');
        Route::get('/delete_lesson/{lesson_id}', [LessonController::class, 'delete'])->name('delete_lesson');
        Route::get('/delete_attachment/{lesson_id}', [LessonController::class, 'delete_attachment'])->name('delete_attachment');
        //manage assignment
        Route::get('/create_assignment/{classroom_id}', [AssignmentController::class, 'create'])->name('create_assignment');
        Route::post('/insert_assignment', [AssignmentController::class, 'insert'])->name('insert_assignment');
        Route::get('/show_assignment/{classroom_id}/{assignment_id}', [AssignmentController::class, 'show'])->name('show_assignment');
        Route::get('/edit_assignment/{assignment_id}', [AssignmentController::class, 'edit'])->name('edit_assignment');
        Route::get('/delete_assignment/{assignment_id}', [AssignmentController::class, 'delete'])->name('delete_assignment');
        Route::get('/download_assignment/{assignment_id}', [AssignmentController::class, 'download'])->name('download_assignment');
        Route::get('/edit_assignment/{assignment_id}', [AssignmentController::class, 'edit'])->name('edit_assignment');
        Route::post('/update_assignment/{assignment_id}', [AssignmentController::class, 'update'])->name('update_assignment');
        Route::get('/delete_attachment_asg/{assignment_id}', [AssignmentController::class, 'delete_attachment'])->name('delete_attachment_asg');
        // manage students
        Route::get('/students/{classroom_id}', [StudentsController::class, 'index'])->name('students');
        Route::get('/delete_student/{user_id}', [StudentsController::class, 'delete'])->name('delete_student');
        Route::get('/groups/{classroom_id}', [StudentsController::class, 'groups'])->name('groups');
        //evaluation
        Route::get('/progress/{group_id}', [ProgressController::class, 'index'])->name('progress');
        Route::post('/evaluate', [ProgressController::class, 'evaluate'])->name('evaluate');
        //leader data
        Route::get('/leader_concept/{group_id}', [LeaderController::class, 'leader_concept'])->name('leader_concept');
        Route::get('/leader_concept_data/{group_id}', [LeaderController::class, 'leader_concept_data'])->name('leader_concept_data');
        Route::get('/leader_inbox/{group_id}', [LeaderController::class, 'leader_inbox'])->name('leader_inbox');
        Route::get('/leader_inbox_data/{group_id}', [LeaderController::class, 'leader_inbox_data'])->name('leader_inbox_data');
        Route::get('/detail_inbox/{id}/{group_id}', [LeaderController::class, 'leader_detail_inbox'])->name('leader_detail_inbox');
        Route::get('/disposition/{id}/{group_id}', [LeaderController::class, 'disposition'])->name('leader_dispositon_progress');
        Route::get('/inbox_retensi/{group_id}', [LeaderController::class, 'inbox_retention'])->name('leader_inbox_retention');
        Route::get('/outbox_retensi/{group_id}', [LeaderController::class, 'outbox_retention'])->name('leader_outbox_retention');
        Route::get('/outbox_retensix/{group_id}', [LeaderController::class, 'outbox_retentionx'])->name('leader_outbox_retentionx');
        //secretary data
        //Klasfikasi
        Route::get('/klasifikasi/{group_id}', [SecretaryController::class, 'classification'])->name('secretary_classification_progress');

        //surat masuk
        Route::get('/secretary_inbox/{group_id}', [SecretaryController::class, 'inbox'])->name('inbox_secretary_progress');
        Route::get('/x/{group_id}', [SecretaryController::class, 'x'])->name('x');
        Route::get('/inbox_detail/{id}/{group_id}', [SecretaryController::class, 'inbox_detail'])->name('inbox_detail_secretary');
        Route::get('/disposition_progress/{id}', [SecretaryController::class, 'disposition'])->name('secretary_dispositon_progress');
        //konsep surat
        Route::get('/konsep_surat/{group_id}', [SecretaryController::class, 'concept'])->name('data_concept_progress');
        // Route::get('/lihat_surat/{id}/{group_id}', [SecretaryController::class, 'mail'])->name('mail');
        Route::get('/detail_surat_keluar/{id}', [SecretaryOutbox::class, 'detailMail'])->name('creatdetailMaile_outbox');
        Route::get('/export_pdf/{id}', [SecretaryOutbox::class, 'exportPDF'])->name('exportPDF');

        Route::get('/secretary_inbox_retensi/{group_id}', [SecretaryController::class, 'inbox_retention'])->name('inbox_retention_sec_progress');
        Route::get('/secretary_outbox_retensi/{group_id}', [SecretaryController::class, 'outbox_retention'])->name('outbox_retention_sec_progress');

        //arsiparis
        Route::get('/inbox_archive_progress/{group_id}', [ArchiveController::class, 'inbox_archive_progress'])->name('inbox_archive_progress');
        Route::get('/inbox_detail_progress/{id}/{group_id}', [ArchiveController::class, 'inbox_detail_progress'])->name('inbox_detail_progress');
        Route::get('/disposition_archive/{id}', [ArchiveController::class, 'disposition'])->name('disposition_archive');
        Route::get('/inbox_retensi_archive/{group_id}', [ArchiveController::class, 'inbox_retensi_archive'])->name('inbox_retensi_archive');
        Route::get('/outbox_retensi_archive/{group_id}', [ArchiveController::class, 'outbox_retensi_archive'])->name('outbox_retensi_archive');
    });
});
Route::middleware(['auth', 'role:2'])->group(function () {

    // Pengelompokan Route Siswa dan Kelompok
    Route::prefix('siswa')->group(function () {
        //tugas
        Route::get('/tugas/{id_tugas}', [LessonAssignmentController::class, 'tugas'])->name('tugas');
        Route::get('/materi/{id_materi}', [LessonAssignmentController::class, 'materi'])->name('materi');
        Route::get('/download_tugas/{id_tugas}', [LessonAssignmentController::class, 'download_tugas'])->name('download_tugas');
        Route::get('/download_materi/{id_materi}', [LessonAssignmentController::class, 'download_materi'])->name('download_materi');


        // Manajemen Kelas pada Siswa
        Route::get('/daftar_kelas', [ClassListController::class, 'index'])->name('std_list_class');
        Route::get('/classdetail', [ClassDetailController::class, 'index'])->name('std_classdetail');
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
