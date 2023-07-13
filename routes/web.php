<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\FileUpload;
use Random\RandomException;

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

function set_active($route) {
    if (is_array($route)) {
        return in_array(Request::path(), $route) ? 'active' : '';
    }
    return Request::path() == $route ? 'active' : '';
}

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/datatables', function () {
    return view('backend.datatables');
});

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// User Management
Route::get('/all-user', [App\Http\Controllers\backend\UserController::class, 'AllUser'])->name('AllUser');
Route::get('/add-user-index', [App\Http\Controllers\backend\UserController::class, 'AddUserIndex'])->name('AddUserIndex');
Route::post('insert-user', [App\Http\Controllers\backend\UserController::class, 'InsertUser'])->name('InsertUser');
Route::get('/edit-user/{id}', [App\Http\Controllers\backend\UserController::class, 'EditUser'])->name('EditUser');
Route::post('update-user/{id}', [App\Http\Controllers\backend\UserController::class, 'UpdateUser'])->name('UpdateUser');
Route::get('/delete-user/{id}', [App\Http\Controllers\backend\UserController::class, 'DeleteUser'])->name('DeleteUser');

// Agency
Route::get('/add-agency-index', [App\Http\Controllers\backend\AgencyController::class, 'AddAgencyIndex'])->name('AddAgencyIndex');
Route::get('/all-agency', [App\Http\Controllers\backend\AgencyController::class, 'AllAgency'])->name('AllAgency');
Route::post('add-agency', [App\Http\Controllers\backend\AgencyController::class, 'AddAgency'])->name('AddAgency');
Route::get('/edit-agency/{id}', [App\Http\Controllers\backend\AgencyController::class, 'EditAgency'])->name('EditAgency');
Route::post('update-agency/{id}', [App\Http\Controllers\backend\AgencyController::class, 'EditAgencyProcess'])->name('EditAgencyProcess');
Route::get('/delete-agency/{id}', [App\Http\Controllers\backend\AgencyController::class, 'DeleteAgency'])->name('DeleteAgency');

// Projects
// Route::get('/all-projects', [App\Http\Controllers\backend\ProjectController::class, 'ShowAllProjects'])->name('ShowAllProjects');
Route::get('/edit-projects/{id}', [App\Http\Controllers\backend\UserController::class, 'EditProjects'])->name('EditProjects');
Route::post('update-projects/{id}', [App\Http\Controllers\backend\UserController::class, 'UpdateProjects'])->name('UpdateProjects');
Route::get('/delete-projects/{id}', [App\Http\Controllers\backend\UserController::class, 'DeleteProjects'])->name('DeleteProjects');


Route::get('/projects', [App\Http\Controllers\backend\ProjectController::class, ''])->name('AddProjectsIndex');
Route::get('/view-project/{funding_agency}', [App\Http\Controllers\backend\ProjectController::class, 'ViewProjects'])->name('ViewProjects');
Route::get('/add-projects-index', [App\Http\Controllers\backend\ProjectController::class, 'AddProjectsIndex'])->name('AddProjectsIndex');

Route::post('insert-projects', [App\Http\Controllers\backend\ProjectController::class, 'InsertProjects'])->name('InsertProjects');
Route::get('/add-sub-projects/{funding_agency}', [App\Http\Controllers\backend\ProjectController::class, 'InsertSubProjects'])->name('InsertSubProjects');
Route::get('/add-personnel-index/{id}', [App\Http\Controllers\backend\ProjectController::class, 'InsertProjectsPersonnelIndex'])->name('InsertProjectsPersonnelIndex');
Route::post('insert-projects-personnel', [App\Http\Controllers\backend\ProjectController::class, 'InsertProjectsPersonnel'])->name('InsertProjectsPersonnel');

// New project index
Route::get('/index-projects', [App\Http\Controllers\backend\AddProject::class, 'AllProjectsInfo'])->name('AllProjectsInfo');
// Route::post('insert-new-projects', [App\Http\Controllers\backend\UserController::class, 'InsertProjectInfo'])->name('InsertProjectInfo');

// Programs Route
Route::post('update-program/{programID}', [\App\Http\Controllers\backend\ProgramsController::class, 'UpdateProgram'])->name('UpdateProgram');
Route::get('/edit-program-index/{programID}', [\App\Http\Controllers\backend\ProgramsController::class, 'EditProgramIndex'])->name('EditProgramIndex');
Route::get('/delete-program/{id}', [App\Http\Controllers\backend\ProgramsController::class, 'DeleteProgram'])->name('DeleteProgram');

// Add Program Personnel
Route::post('/add-program-personnel', [\App\Http\Controllers\backend\ProgramsController::class, 'AddProgramPersonnel'])->name('AddProgramPersonnel');
// Route::post('/add-program-personnel', [\App\Http\Controllers\backend\ReportController::class, 'AddProgramPersonnel'])->name('AddProgramPersonnel');
Route::get('/add-program-personnel-index/{programID}', [\App\Http\Controllers\backend\ProgramsController::class, 'AddProgramPersonnelsIndex'])->name('AddProgramPersonnelsIndex');

// Program Details Route
Route::get('view-program-index/{programID}', [\App\Http\Controllers\backend\ProgramsController::class, 'ViewProgramIndex'])->name('ViewProgramIndex');

Route::get('/upload-program-files-index/{programID}', [\App\Http\Controllers\backend\ProgramsController::class, 'UploadProgramFilesIndex'])->name('UploadProgramFilesIndex');

Route::post('form/save', [App\Http\Controllers\backend\ProgramsController::class, 'saveRecord'])->name('form/save');

// download files
Route::get('download/{id}', [App\Http\Controllers\backend\ProgramsController::class, 'download']);

// report
Route::get('/report-index', [App\Http\Controllers\backend\ReportController::class, 'reportIndex'])->name('reportIndex');

//upload files
Route::get('upload-file/{programID}', [FileUpload::class, 'createForm'])->name('uploadFile');;
Route::post('/upload-file', [FileUpload::class, 'fileUpload'])->name('fileUpload');
Route::get('/delete-file/{id}', [FileUpload::class, 'DeleteFile'])->name('DeleteFile');
Route::get('download/{id}', [FileUpload::class, 'download']);


// Add Program Personnel


// R & D Management and Coordination
Route::get('/rdmc-index', [App\Http\Controllers\backend\ReportController::class, 'rdmcIndex'])->name('rdmcIndex');
Route::get('/rdmc-monitoring-evaluation', [App\Http\Controllers\backend\ReportController::class, 'monitoringEvaluation'])->name('monitoringEvaluation');
Route::get('/rdmc-projects', [App\Http\Controllers\backend\ReportController::class, 'rdmcProjects'])->name('rdmcProjects');
Route::get('/rdmc-activities', [App\Http\Controllers\backend\ReportController::class, 'rdmcActivities'])->name('rdmcActivities');
Route::get('/rdmc-activities-add', [App\Http\Controllers\backend\ReportController::class, 'rdmcAddActivities'])->name('rdmcAddActivities');
Route::get('/projects-add', [App\Http\Controllers\backend\ReportController::class, 'projectsAdd'])->name('projectsAdd');
Route::get('/program-projects-add', [App\Http\Controllers\backend\ReportController::class, 'programProjectsAdd'])->name('programProjectsAdd');
Route::get('/projects-u-program-add/{programID}', [App\Http\Controllers\backend\ReportController::class, 'projectsUnderProgramAdd'])->name('projectsUnderProgramAdd');
Route::get('/sub-projects-add', [App\Http\Controllers\backend\ReportController::class, 'subProjectsAdd'])->name('subProjectsAdd');
Route::get('/rdmc-create-program', [App\Http\Controllers\backend\ReportController::class, 'rdmcCreateProgram'])->name('rdmcCreateProgram');
Route::get('/projects-add-no-program', [App\Http\Controllers\backend\ReportController::class, 'projectsAddNoProgram'])->name('projectsAddNoProgram');
Route::get('/rdmc-choose-program', [App\Http\Controllers\backend\ReportController::class, 'rdmcChooseProgram'])->name('rdmcChooseProgram');
Route::get('/aihrs', [App\Http\Controllers\backend\ReportController::class, 'aihrsIndex'])->name('aihrsIndex');
Route::get('/rdmc-linkages-index', [App\Http\Controllers\backend\ReportController::class, 'linkagesIndex'])->name('linkagesIndex');
Route::get('/rdmc-linkages-add', [App\Http\Controllers\backend\ReportController::class, 'linkagesAddIndex'])->name('linkagesAddIndex');
Route::get('/rdmc-dbinfosys-index', [App\Http\Controllers\backend\ReportController::class, 'dbInfoSys'])->name('dbInfoSys');
Route::get('/rdmc-dbinfosys-add', [App\Http\Controllers\backend\ReportController::class, 'dbInfoSysAdd'])->name('dbInfoSysAdd');

// linkages
Route::post('/add-linkages', [App\Http\Controllers\backend\LinkagesController::class, 'AddLinkages'])->name('AddLinkages');
Route::get('/edit-linkages/{id}', [App\Http\Controllers\backend\LinkagesController::class, 'EditLinkages'])->name('EditLinkages');
Route::post('/update-linkages/{id}', [App\Http\Controllers\backend\LinkagesController::class, 'UpdateLinkages'])->name('UpdateLinkages');
Route::get('/delete-linkages/{id}', [App\Http\Controllers\backend\LinkagesController::class, 'DeleteLinkages']);

// DBINFOSYS
Route::post('/add-dbinfosys', [App\Http\Controllers\backend\DbinfosysController::class, 'AddDbinfosys'])->name('AddDbinfosys');
Route::get('/edit-dbinfosys/{id}', [App\Http\Controllers\backend\DbinfosysController::class, 'EditDbinfosys'])->name('EditDbinfosys');
Route::post('/update-dbinfosys/{id}', [App\Http\Controllers\backend\DbinfosysController::class, 'UpdateDbinfosys'])->name('UpdateDbinfosys');
Route::get('/delete-dbinfosys/{id}', [App\Http\Controllers\backend\DbinfosysController::class, 'DeleteDbinfosys']);

// Adding programs/projects
Route::post('add-programs', [\App\Http\Controllers\backend\ProgramsController::class, 'AddProgram'])->name('AddProgram');
Route::get('/rdmc-programs', [App\Http\Controllers\backend\ReportController::class, 'rdmcProgramsIndex'])->name('rdmcProgramsIndex');
Route::post('/add-projects', [App\Http\Controllers\backend\ReportController::class, 'AddProjects'])->name('AddProjects');

// Strategic activities
Route::get('/strategic-activities', [App\Http\Controllers\backend\ReportController::class, 'strategicActivities'])->name('strategicActivities');
Route::get('/add-strategic-index', [App\Http\Controllers\backend\ReportController::class, 'addStrategicActivities']);
Route::post('/add-strategic', [App\Http\Controllers\backend\StrategicController::class, 'addStrategic'])->name('addStrategic');
Route::get('/edit-strategic/{id}', [App\Http\Controllers\backend\StrategicController::class, 'editStrategic'])->name('editStrategic');
Route::get('/delete-strategic/{id}', [App\Http\Controllers\backend\StrategicController::class, 'DeleteStrategic'])->name('DeleteStrategic');


// R & D Results Utilization
Route::get('/rdru-index', [App\Http\Controllers\backend\ReportController::class, 'rdruIndex'])->name('rdruIndex');
Route::get('/rdru-ttp', [App\Http\Controllers\backend\ReportController::class, 'rdruTtp'])->name('rdruTtp');
Route::get('/rdru-add', [App\Http\Controllers\backend\ReportController::class, 'rdruAdd'])->name('rdruAdd');
Route::get('/rdru-ttm', [App\Http\Controllers\backend\ReportController::class, 'rdruTtm'])->name('rdruTtm');
Route::get('/rdru-ttm-add', [App\Http\Controllers\backend\ReportController::class, 'rdruTtmAdd'])->name('rdruTtmAdd');
Route::get('/rdru-tpa', [App\Http\Controllers\backend\ReportController::class, 'rdruTpa'])->name('rdruTpa');
Route::get('/rdru-tpa-add', [App\Http\Controllers\backend\ReportController::class, 'rdruTpaAdd'])->name('rdruTpaAdd');


// Cabability Building and Governance
Route::get('/cbg-index', [App\Http\Controllers\backend\ReportController::class, 'cbgIndex'])->name('cbgIndex');
Route::get('/cbg-training', [App\Http\Controllers\backend\ReportController::class, 'cbgTraining'])->name('cbgTraining');
Route::get('/cbg-awards', [App\Http\Controllers\backend\ReportController::class, 'cbgAwards'])->name('cbgAwards');
Route::get('/cbg-equipment', [App\Http\Controllers\backend\ReportController::class, 'cbgEquipment'])->name('cbgEquipment');
Route::get('/cbg-training-add', [App\Http\Controllers\backend\ReportController::class, 'cbgTrainingAdd'])->name('cbgTrainingAdd');
Route::get('/cbg-awards-add', [App\Http\Controllers\backend\ReportController::class, 'cbgAwardsAdd'])->name('cbgAwardsAdd');
Route::get('/cbg-equipment-add', [App\Http\Controllers\backend\ReportController::class, 'cbgEquipmentAdd'])->name('cbgEquipmentAdd');

// Researchers
Route::get('/researcher-index', [App\Http\Controllers\backend\ResearcherController::class, 'researcherIndex'])->name('researcherIndex');
Route::get('/researcher-add', [App\Http\Controllers\backend\ResearcherController::class, 'researcherAdd'])->name('researcherAdd');
Route::get('/delete-researcher/{id}', [App\Http\Controllers\backend\ResearcherController::class, 'DeleteResearcher']);
Route::post('/add-researcher', [\App\Http\Controllers\backend\ResearcherController::class, 'AddResearcher'])->name('AddResearcher');
Route::get('/edit-researcher/{id}', [App\Http\Controllers\backend\ResearcherController::class, 'EditResearcher'])->name('EditResearcher');
Route::post('/update-researcher/{id}', [\App\Http\Controllers\backend\ResearcherController::class, 'UpdateResearcher'])->name('UpdateResearcher');

// RDMC ACTIVITIES
Route::post('/add-activities', [App\Http\Controllers\backend\ActivitiesController::class, 'AddActivities'])->name('AddActivities');
Route::get('/edit-activity/{id}', [App\Http\Controllers\backend\ActivitiesController::class, 'EditActivity'])->name('EditActivity');
Route::post('/update-activity/{id}', [App\Http\Controllers\backend\ActivitiesController::class, 'UpdateActivity'])->name('UpdateActivity');
Route::get('/delete-activity/{id}', [App\Http\Controllers\backend\ActivitiesController::class, 'DeleteActivity'])->name('DeleteActivity');






