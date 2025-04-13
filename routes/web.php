<?php


use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\MissionController;
use App\Http\Controllers\PersonController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');


    Route::resource('people', PersonController::class);
    Route::resource('missions', MissionController::class);
    Route::resource('departments', DepartmentController::class);


    Route::get('missions/{id}/generate-docx', [MissionController::class, 'generateDocx'])->name('missions.generate-docx');
    Route::get('missions/{id}/generate-pdf', [MissionController::class, 'generatePdf'])->name('missions.generate-pdf');
    Route::get('missions/export/{format}', [MissionController::class, 'export'])->name('missions.export');
    Route::get('missions/{mission}/export-docx', [MissionController::class, 'exportDocx'])->name('missions.export.docx');
    Route::get('missions/{mission}/print', [MissionController::class, 'print'])->name('missions.print');

    Route::get('departments/export/{format}', [DepartmentController::class, 'export'])->name('departments.export');


});


