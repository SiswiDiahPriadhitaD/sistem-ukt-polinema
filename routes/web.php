<?php

use App\Http\Controllers\Auth\AssignUserToRoleController;
use App\Http\Controllers\Auth\RoleController;
use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Kesekretariatan\JurusanController;
use App\Http\Controllers\Kesekretariatan\KelompokUktController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

//baru
use App\Http\Controllers\MasterTable\PekerjaanAyahController;
use App\Http\Controllers\MasterTable\PekerjaanIbuController;
use App\Http\Controllers\MasterTable\PenghasilanAyahController;
use App\Http\Controllers\MasterTable\PenghasilanIbuController;
use App\Http\Controllers\MasterTable\JumlahPendapatanOrangTuaController;
use App\Http\Controllers\MasterTable\JumlahTanggunganController;
use App\Http\Controllers\MasterTable\StatusOrangTuaController;
use App\Http\Controllers\MasterTable\JumlahAnakController;
use App\Http\Controllers\MasterTable\JumlahOrangTinggalController;
use App\Http\Controllers\MasterTable\StatusKepemilikanRumahController;
use App\Http\Controllers\MasterTable\BesaranPLNController;
use App\Http\Controllers\MasterTable\BesaranPDAMController;
use App\Http\Controllers\MasterTable\BesaranPajakKendaraanMobilController;
use App\Http\Controllers\MasterTable\BesaranPajakKendaraanMotorController;
use App\Http\Controllers\Kesekretariatan\PeriodeController;
use App\Http\Controllers\Kesekretariatan\ProgramStudiController;
use App\Http\Controllers\Kemahasiswaan\MahasiswaController;
use App\Http\Controllers\Kemahasiswaan\MahasiswaDitolakController;
use App\Http\Controllers\Kemahasiswaan\MahasiswaDiverifikasiController;
use App\Http\Controllers\Perhitungan\MahasiswaPerhitunganController;

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

Route::get('/', [FrontEndController::class, 'index'])->name('front-end.index');


Route::middleware(['auth', 'verified', 'role:mahasiswa'])->group(function () {
    Route::get('/biodata', [FrontEndController::class, 'biodata'])->name('front-end.biodata');
    Route::post('/biodata-store', [FrontEndController::class, 'biodataStore'])->name('front-end.biodata-store');
    Route::get('/biodata-pendukung', [FrontEndController::class, 'biodataPendukung'])->name('front-end.biodata-pendukung');
    Route::post('/biodate-pendukung-store', [FrontEndController::class, 'biodataPendukungStore'])->name('front-end.biodata-pendukung-store');
    Route::get('/pengumuman', [FrontEndController::class, 'pengumuman'])->name('front-end.pengumuman');
});


Route::group(['middleware' => ['auth', 'verified', 'role:super-admin']], function () {

    Route::prefix('user-management')->group(function () {
        Route::post('/validate-user', [UserController::class, 'validateCreateUser'])->name('validate-create-user');
        Route::post('/validate-update-user', [UserController::class, 'validateUpdateUser'])->name('validate-update-user');
        Route::post('user/deactivate/{id}', [UserController::class, 'deactivate'])->name('user.deactivate');
        Route::post('user/restore/{id}', [UserController::class, 'restore'])->name('user.restore');
        Route::put('user/user-edit', [UserController::class, 'update'])->name('user.update');
        Route::post('user', [UserController::class, 'store'])->name('user.store');
        Route::get('user/{id}', [UserController::class, 'show'])->name('user.show');
        Route::get('user', [UserController::class, 'index'])->name('user.index');
    });

    Route::group(['prefix' => 'role-management'], function () {
        Route::post('/validate-role', [RoleController::class, 'validateCreateRole'])->name('validate-create-role');
        Route::post('/validate-update-role', [RoleController::class, 'validateUpdateRole'])->name('validate-update-role');
        Route::delete('role/{id}', [RoleController::class, 'destroy'])->name('role.destroy');
        Route::put('role/role-edit', [RoleController::class, 'update'])->name('role.update');
        Route::post('role', [RoleController::class, 'store'])->name('role.store');
        Route::get('role/{id}', [RoleController::class, 'show'])->name('role.show');
        Route::get('role', [RoleController::class, 'index'])->name('role.index');

        Route::get('assign-user', [AssignUserToRoleController::class, 'index'])->name('assign.user.index');
        Route::get('assign-user/create', [AssignUserToRoleController::class, 'create'])->name('assign.user.create');
        Route::post('assign-user', [AssignUserToRoleController::class, 'store'])->name('assign.user.store');
        Route::get('assing-user/{user}/edit', [AssignUserToRoleController::class, 'edit'])->name('assign.user.edit');
        Route::put('assign-user/{user}', [AssignUserToRoleController::class, 'update'])->name('assign.user.update');
    });

    Route::prefix('master-table')->group(function () {
        Route::resource('pekerjaan-ayah', PekerjaanAyahController::class);
        Route::resource('pekerjaan-ibu', PekerjaanIbuController::class);
        Route::resource('penghasilan-ayah', PenghasilanAyahController::class);
        Route::resource('penghasilan-ibu', PenghasilanIbuController::class);
        Route::resource('jumlah-pendapatan-orang-tua', JumlahPendapatanOrangTuaController::class);
        Route::resource('jumlah-tanggungan', JumlahTanggunganController::class);
        Route::resource('status-orang-tua', StatusOrangTuaController::class);
        Route::resource('jumlah-anak', JumlahAnakController::class);
        Route::resource('jumlah-orang-tinggal', JumlahOrangTinggalController::class);
        Route::resource('status-kepemilikan-rumah', StatusKepemilikanRumahController::class);
        Route::resource('besaran-pln', BesaranPLNController::class);
        Route::resource('besaran-pdam', BesaranPDAMController::class);
        Route::resource('besaran-pajak-kendaraan-mobil', BesaranPajakKendaraanMobilController::class);
        Route::resource('besaran-pajak-kendaraan-motor', BesaranPajakKendaraanMotorController::class);
    });

    Route::prefix('kesekretariatan')->group(function () {
        Route::resource('periode', PeriodeController::class);
        Route::get('/jurusan/list', [JurusanController::class, 'list'])->name('jurusan.list');
        Route::resource('jurusan', JurusanController::class);
        Route::get('/program-studi/list', [ProgramStudiController::class, 'list'])->name('program-studi.list');
        Route::get('/program-studi/list-to-mahasiswa', [ProgramStudiController::class, 'listToMahasiswa'])->name('program-studi.list-to-mahasiswa');
        route::resource('program-studi', ProgramStudiController::class);
        Route::resource('kelompok-ukt', KelompokUktController::class);
    });
});

Route::group(['middleware' => ['auth', 'verified', 'role:super-admin|wadir']], function () {
    Route::get('/profile', function () {
        return view('auth.profile');
    })->name('profile.index');
    Route::put('/profile/{id}', [ProfileController::class, 'update'])->name('profile.update');

    Route::prefix('kemahasiswaan')->group(function () {
        Route::resource('mahasiswa', MahasiswaController::class);
        Route::post('mahasiswa/import', [MahasiswaController::class, 'import'])->name('mahasiswa.import');
        Route::get('mahasiswa/details/{id}', [MahasiswaController::class, 'details'])->name('mahasiswa.details');
        Route::get('/kelompok-ukt/{id}', [MahasiswaController::class, 'getKelompokUktByProgramStudi'])->name('mahasiswa.kelompok-ukt-list');
        Route::put('/mahasiswa/{id}/update-status', [MahasiswaController::class, 'updateStatus'])->name('mahasiswa.update-status');
        Route::resource('mahasiswa-ditolak', MahasiswaDitolakController::class);
        Route::get('/mahasiswa/ditolak-table/{periode_id}', [MahasiswaDitolakController::class, 'showMahasiswaDitolak'])->name('mahasiswa.ditolak.table');
        Route::resource('mahasiswa-diverifikasi', MahasiswaDiverifikasiController::class);
        Route::get('/mahasiswa/diverifikasi-table/{periode_id}', [MahasiswaDiverifikasiController::class, 'showMahasiswaDiverifikasi'])->name('mahasiswa.diverifikasi.table');
    });
    Route::prefix('perhitungan')->group(function () {
        Route::resource('mahasiswa-perhitungan', MahasiswaPerhitunganController::class);
        Route::get('/mahasiswa/perhitungan-table/{periode_id}', [MahasiswaPerhitunganController::class, 'showMahasiswaPerhitungan'])->name('mahasiswa.perhitungan.table');
        Route::get('mahasiswa/details/{id}', [MahasiswaPerhitunganController::class, 'details'])->name('mahasiswa-perhitungan.details');
        Route::put('/mahasiswa/{id}/update-status-pehitungan', [MahasiswaPerhitunganController::class, 'updateStatus'])->name('mahasiswa.update-status-pehitungan');
    });
});
