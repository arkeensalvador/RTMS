<?php

use App\Http\Controllers\backend\ContributionsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
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

function set_active($route)
{
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

Route::get('view-project-index/{id}', [\App\Http\Controllers\backend\ProjectController::class, 'viewProjectIndex'])->name('viewProjectIndex');

Route::get('/projects', [App\Http\Controllers\backend\ProjectController::class, ''])->name('AddProjectsIndex');
Route::get('/view-project-index/{funding_agency}', [App\Http\Controllers\backend\ProjectController::class, 'ViewProjects'])->name('ViewProjects');
Route::get('/add-projects-index', [App\Http\Controllers\backend\ProjectController::class, 'AddProjectsIndex'])->name('AddProjectsIndex');

Route::post('insert-projects', [App\Http\Controllers\backend\ProjectController::class, 'InsertProjects'])->name('InsertProjects');
Route::get('/add-sub-projects/{funding_agency}', [App\Http\Controllers\backend\ProjectController::class, 'InsertSubProjects'])->name('InsertSubProjects');
// Route::get('/add-personnel-index/{id}', [App\Http\Controllers\backend\ProjectController::class, 'InsertProjectsPersonnelIndex'])->name('InsertProjectsPersonnelIndex');
Route::post('insert-projects-personnel', [App\Http\Controllers\backend\ProjectController::class, 'InsertProjectsPersonnel'])->name('InsertProjectsPersonnel');
Route::get('/delete-staff/{id}', [App\Http\Controllers\backend\ProjectController::class, 'DeleteStaff'])->name('DeleteStaff');

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
Route::post('/staff/multi-delete', [ProjectController::class, 'multiDelete'])->name('posts.multi-delete');

// Program Details Route
Route::get('view-program-index/{programID}', [\App\Http\Controllers\backend\ProgramsController::class, 'ViewProgramIndex'])->name('ViewProgramIndex');

Route::get('/upload-program-files-index/{programID}', [\App\Http\Controllers\backend\ProgramsController::class, 'UploadProgramFilesIndex'])->name('UploadProgramFilesIndex');

Route::post('form/save', [App\Http\Controllers\backend\ProgramsController::class, 'saveRecord'])->name('form/save');

// download files
Route::get('download/{id}', [App\Http\Controllers\backend\ProgramsController::class, 'download']);

// report
Route::get('/report-index', [App\Http\Controllers\backend\ReportController::class, 'reportIndex'])->name('reportIndex');

//upload files
Route::post('/files', [FileUpload::class, 'storeFiles'])->name('storeFiles');

Route::post('store-multi-file-ajax', [FileUpload::class, 'storeMultiFile']);
Route::get('upload-file/{programID}', [FileUpload::class, 'createFormProgram'])->name('uploadFileProgram');
Route::post('/upload-file', [FileUpload::class, 'fileUpload'])->name('fileUpload');
Route::get('/delete-file/{id}', [FileUpload::class, 'DeleteFile'])->name('DeleteFile');
Route::get('download/{id}', [FileUpload::class, 'download']);

// upload files project
Route::get('project-upload-file/{id}', [FileUpload::class, 'createFormProject'])->name('uploadFileProject');;
Route::post('/project-upload-file', [FileUpload::class, 'ProjectFileUpload'])->name('ProjectFileUpload');
Route::get('/delete-file-project/{id}', [FileUpload::class, 'DeleteFileProject'])->name('DeleteFileProject');
// Route::get('download-project/{id}', [FileUpload::class, 'downloadProject']);


// Add Program Personnel


// R & D Management and Coordination
Route::get('/rdmc-index', [App\Http\Controllers\backend\ReportController::class, 'rdmcIndex'])->name('rdmcIndex');
Route::get('/rdmc-monitoring-evaluation', [App\Http\Controllers\backend\ReportController::class, 'monitoringEvaluation'])->name('monitoringEvaluation');
Route::get('/rdmc-projects', [App\Http\Controllers\backend\ReportController::class, 'rdmcProjects'])->name('rdmcProjects');
Route::get('/rdmc-activities', [App\Http\Controllers\backend\ReportController::class, 'rdmcActivities'])->name('rdmcActivities');
Route::get('/rdmc-activities-add', [App\Http\Controllers\backend\ReportController::class, 'rdmcAddActivities'])->name('rdmcAddActivities');
Route::get('/projects-add', [App\Http\Controllers\backend\ReportController::class, 'projectsAdd'])->name('projectsAdd');
Route::get('/program-projects-add', [App\Http\Controllers\backend\ReportController::class, 'programProjectsAdd'])->name('programProjectsAdd');
Route::get('/projects-under-program/{programID}', [App\Http\Controllers\backend\ReportController::class, 'projectsUnderProgramIndex'])->name('projectsUnderProgramIndex');
Route::get('/projects-u-program-add/{programID}', [App\Http\Controllers\backend\ReportController::class, 'projectsUnderProgramAdd'])->name('projectsUnderProgramAdd');
Route::get('/projects-u-program-edit/{programID}/{$id}', [App\Http\Controllers\backend\ReportController::class, 'projectsUnderProgramEdit'])->name('projectsUnderProgramEdit');
Route::get('/sub-projects-view/{projectID}', [App\Http\Controllers\backend\ReportController::class, 'subProjectsView'])->name('subProjectsView');
Route::get('/sub-projects-add/{id}', [App\Http\Controllers\backend\ReportController::class, 'ProjectSubProjectsAdd'])->name('ProjectSubProjectsAdd');
Route::get('/sub-projects-add', [App\Http\Controllers\backend\ReportController::class, 'ProjectSubProjectsAdd2'])->name('ProjectSubProjectsAdd2');
Route::get('/rdmc-create-program', [App\Http\Controllers\backend\ReportController::class, 'rdmcCreateProgram'])->name('rdmcCreateProgram');
Route::get('/edit-no-program-project/{id}', [App\Http\Controllers\backend\ProjectController::class, 'EditNoProgramProjectIndex'])->name('EditNoProgramProjectIndex');
Route::get('/rdmc-choose-program', [App\Http\Controllers\backend\ReportController::class, 'rdmcChooseProgram'])->name('rdmcChooseProgram');
Route::get('/aihrs', [App\Http\Controllers\backend\ReportController::class, 'aihrsIndex'])->name('aihrsIndex');
Route::get('/rdmc-linkages-index', [App\Http\Controllers\backend\ReportController::class, 'linkagesIndex'])->name('linkagesIndex');
Route::get('/rdmc-linkages-add', [App\Http\Controllers\backend\ReportController::class, 'linkagesAddIndex'])->name('linkagesAddIndex');
Route::get('/rdmc-dbinfosys-index', [App\Http\Controllers\backend\ReportController::class, 'dbInfoSys'])->name('dbInfoSys');
Route::get('/rdmc-dbinfosys-add', [App\Http\Controllers\backend\ReportController::class, 'dbInfoSysAdd'])->name('dbInfoSysAdd');
Route::get('/rdmc-regional', [App\Http\Controllers\backend\ReportController::class, 'regional_index'])->name('regional_index');
Route::get('/rdmc-regional-add', [App\Http\Controllers\backend\ReportController::class, 'regional_add_index'])->name('regional_add_index');
Route::get('/rdmc-regional-participants', [App\Http\Controllers\backend\ReportController::class, 'regional_participants_index'])->name('regional_participants_index');
Route::get('/rdmc-regional-participants-add', [App\Http\Controllers\backend\ReportController::class, 'regional_participants_add_index'])->name('regional_participants_add_index');

// Regional
Route::post('/add-regional', [App\Http\Controllers\backend\RegionalController::class, 'regional_add'])->name('regional_add');
Route::get('/delete-regional/{id}', [App\Http\Controllers\backend\RegionalController::class, 'regional_delete']);
Route::get('/edit-regional/{id}', [App\Http\Controllers\backend\RegionalController::class, 'regional_edit'])->name('regional_edit');
Route::post('/update-regional/{id}', [App\Http\Controllers\backend\RegionalController::class, 'regional_update'])->name('regional_update');

// Regional Participants
Route::post('/add-regional-participants', [App\Http\Controllers\backend\RegionalController::class, 'regional_participants_add'])->name('regional_participants_add');
Route::get('/delete-regional-participants/{id}', [App\Http\Controllers\backend\RegionalController::class, 'regional_participants_delete']);
Route::get('/edit-regional-participants/{id}', [App\Http\Controllers\backend\RegionalController::class, 'regional_participants_edit'])->name('regional_participants_edit');
Route::post('/update-regional-participants/{id}', [App\Http\Controllers\backend\RegionalController::class, 'regional_participants_update'])->name('regional_participants_update');

// Projects Under Program
Route::post('/add-project', [App\Http\Controllers\backend\ProjectController::class, 'AddProject'])->name('AddProject');
Route::get('/edit-project/{id}', [App\Http\Controllers\backend\ProjectController::class, 'EditProject'])->name('EditProject');
Route::post('/update-project/{id}', [App\Http\Controllers\backend\ProjectController::class, 'UpdateProject'])->name('UpdateProject');
Route::get('/delete-project/{id}', [App\Http\Controllers\backend\ProjectController::class, 'DeleteProject']);
Route::post('/add-project-personnel', [\App\Http\Controllers\backend\ProjectController::class, 'AddProjectPersonnel'])->name('AddProjectPersonnel');
Route::get('/add-project-personnel/{id}', [App\Http\Controllers\backend\ProjectController::class, 'InsertProjectsPersonnelIndex'])->name('InsertProjectsPersonnelIndex');


// SUB PROJECTS

Route::get('/view-subprojects', [App\Http\Controllers\backend\SubprojectController::class, 'viewSubProjectIndex'])->name('viewSubProjectIndex');
Route::get('/view-subprojects/{projectID}/{id}', [App\Http\Controllers\backend\SubprojectController::class, 'viewSubProject'])->name('viewSubProject');
Route::post('/add-sub-project', [App\Http\Controllers\backend\SubprojectController::class, 'AddSubProject'])->name('AddSubProject');
Route::get('/edit-sub-project/{projectID}/{id}', [App\Http\Controllers\backend\SubprojectController::class, 'editSubProject'])->name('editSubProject');
Route::post('/update-sub-project/{projectID}/{id}', [App\Http\Controllers\backend\SubprojectController::class, 'UpdateSubProject'])->name('UpdateSubProject');
Route::get('/delete-sub-project/{id}', [App\Http\Controllers\backend\SubprojectController::class, 'DeleteSubProject']);
Route::post('/add-sub-project-personnel', [\App\Http\Controllers\backend\SubprojectController::class, 'AddSubProjectPersonnel'])->name('AddSubProjectPersonnel');
Route::get('/add-sub-project-personnel/{id}', [App\Http\Controllers\backend\SubprojectController::class, 'InsertSubProjectsPersonnelIndex'])->name('InsertSubProjectsPersonnelIndex');
Route::get('/delete-sp-staff/{id}', [App\Http\Controllers\backend\SubprojectController::class, 'DeleteSPStaff'])->name('DeleteSPStaff');

// SUB PROJECT FILE UPLOAD
Route::get('sub-project-upload-file/{projectID}/{id}', [FileUpload::class, 'createFormSubProject'])->name('uploadFileSubProject');;
Route::post('/sub-project-upload-file', [FileUpload::class, 'SubProjectFileUpload'])->name('SubProjectFileUpload');
Route::get('/delete-file-project/{id}', [FileUpload::class, 'DeleteFileProject'])->name('DeleteFileProject');


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
Route::post('/update-strategic/{id}', [App\Http\Controllers\backend\StrategicController::class, 'UpdateStrategic'])->name('UpdateStrategic');
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
Route::get('/cbg-contributions', [App\Http\Controllers\backend\ReportController::class, 'cbgContributions'])->name('cbgContributions');
Route::get('/cbg-meetings', [App\Http\Controllers\backend\ReportController::class, 'cbgMeetings'])->name('cbgMeetings');
Route::get('/cbg-initiatives', [App\Http\Controllers\backend\ReportController::class, 'cbgInitiatives'])->name('cbgInitiatives');
Route::get('/cbg-awards', [App\Http\Controllers\backend\ReportController::class, 'cbgAwards'])->name('cbgAwards');
Route::get('/cbg-equipment', [App\Http\Controllers\backend\ReportController::class, 'cbgEquipment'])->name('cbgEquipment');
Route::get('/cbg-meetings-add', [App\Http\Controllers\backend\ReportController::class, 'cbgMeetingsAdd'])->name('cbgMeetingsAdd');
Route::get('/cbg-training-add', [App\Http\Controllers\backend\ReportController::class, 'cbgTrainingAdd'])->name('cbgTrainingAdd');
Route::get('/cbg-awards-add', [App\Http\Controllers\backend\ReportController::class, 'cbgAwardsAdd'])->name('cbgAwardsAdd');
Route::get('/cbg-equipment-add', [App\Http\Controllers\backend\ReportController::class, 'cbgEquipmentAdd'])->name('cbgEquipmentAdd');

// Contributions
Route::post('/add-contributions', [App\Http\Controllers\backend\ContributionsController::class, 'con_add'])->name('con_add');
Route::get('/delete-contributions/{id}', [App\Http\Controllers\backend\ContributionsController::class, 'con_delete']);
Route::get('/edit-contributions/{id}', [App\Http\Controllers\backend\ContributionsController::class, 'con_edit'])->name('con_edit');
Route::post('/update-contributions/{id}', [App\Http\Controllers\backend\ContributionsController::class, 'con_update'])->name('con_update');

//Initiatives 
Route::post('/add-initiatives', [App\Http\Controllers\backend\InitiativesController::class, 'ini_add'])->name('ini_add');
Route::get('/delete-initiatives/{id}', [App\Http\Controllers\backend\InitiativesController::class, 'ini_delete']);
Route::get('/edit-initiatives/{id}', [App\Http\Controllers\backend\InitiativesController::class, 'ini_edit'])->name('ini_edit');
Route::post('/update-initiatives/{id}', [App\Http\Controllers\backend\InitiativesController::class, 'ini_update'])->name('ini_update');

// Meetings
Route::post('/add-meetings', [App\Http\Controllers\backend\MeetingController::class, 'meeting_add'])->name('meeting_add');
Route::get('/delete-meeting/{id}', [App\Http\Controllers\backend\MeetingController::class, 'meeting_delete']);
Route::get('/edit-meeting/{id}', [App\Http\Controllers\backend\MeetingController::class, 'meeting_edit'])->name('meeting_edit');
Route::post('/update-meetings/{id}', [App\Http\Controllers\backend\MeetingController::class, 'meeting_update'])->name('meeting_update');

// Policy
Route::get('/policy-index', [App\Http\Controllers\backend\ReportController::class, 'policyIndex'])->name('policyIndex');
Route::get('/policy-prc', [App\Http\Controllers\backend\ReportController::class, 'policyPrc'])->name('policyPrc');
Route::get('/policy-prc-add', [App\Http\Controllers\backend\PolicyController::class, 'prc_add_index'])->name('prc_add_index');
Route::get('/policy-formulated-add', [App\Http\Controllers\backend\PolicyController::class, 'formulated_add_index'])->name('formulated_add_index');
Route::get('/policy-formulated', [App\Http\Controllers\backend\ReportController::class, 'policyFormulated'])->name('policyFormulated');

// Best paper
Route::post('/add-best-paper', [App\Http\Controllers\backend\ReportController::class, 'best_paper_add'])->name('best_paper_add');
Route::post('/update-best-paper/{id}', [App\Http\Controllers\backend\ReportController::class, 'best_paper_update'])->name('best_paper_update');
Route::get('/delete-best-paper/{id}', [App\Http\Controllers\backend\ReportController::class, 'best_paper_delete']);
// POLICY PRC
Route::post('/add-prc', [App\Http\Controllers\backend\PolicyController::class, 'prc_add'])->name('prc_add');
Route::get('/delete-prc/{id}', [App\Http\Controllers\backend\PolicyController::class, 'prc_delete']);
Route::get('/edit-prc/{id}', [App\Http\Controllers\backend\PolicyController::class, 'prc_edit'])->name('prc_edit');
Route::post('/update-prc/{id}', [App\Http\Controllers\backend\PolicyController::class, 'prc_update'])->name('prc_update');

// POLICY FORMULATED
Route::post('/add-formulated', [App\Http\Controllers\backend\PolicyController::class, 'formulated_add'])->name('formulated_add');
Route::get('/delete-formulated/{id}', [App\Http\Controllers\backend\PolicyController::class, 'formulated_delete']);
Route::get('/edit-formulated/{id}', [App\Http\Controllers\backend\PolicyController::class, 'formulated_edit'])->name('formulated_edit');
Route::post('/update-formulated/{id}', [App\Http\Controllers\backend\PolicyController::class, 'formulated_update'])->name('formulated_update');

// Researchers
Route::get('/researcher-index', [App\Http\Controllers\backend\ResearcherController::class, 'researcherIndex'])->name('researcherIndex');
Route::get('/researcher-add', [App\Http\Controllers\backend\ResearcherController::class, 'researcherAdd'])->name('researcherAdd');
Route::get('/delete-researcher/{id}', [App\Http\Controllers\backend\ResearcherController::class, 'DeleteResearcher']);
Route::post('/add-researcher', [\App\Http\Controllers\backend\ResearcherController::class, 'AddResearcher'])->name('AddResearcher');
Route::get('/edit-researcher/{id}', [App\Http\Controllers\backend\ResearcherController::class, 'EditResearcher'])->name('EditResearcher');
Route::get('/view-researcher/{id}', [App\Http\Controllers\backend\ResearcherController::class, 'ViewResearcher'])->name('ViewResearcher');
Route::post('/update-researcher/{id}', [\App\Http\Controllers\backend\ResearcherController::class, 'UpdateResearcher'])->name('UpdateResearcher');

// RDMC ACTIVITIES
Route::post('/add-activities', [App\Http\Controllers\backend\ActivitiesController::class, 'AddActivities'])->name('AddActivities');
Route::get('/edit-activity/{id}', [App\Http\Controllers\backend\ActivitiesController::class, 'EditActivity'])->name('EditActivity');
Route::post('/update-activity/{id}', [App\Http\Controllers\backend\ActivitiesController::class, 'UpdateActivity'])->name('UpdateActivity');
Route::get('/delete-activity/{id}', [App\Http\Controllers\backend\ActivitiesController::class, 'DeleteActivity'])->name('DeleteActivity');

//TTP 
Route::post('/add-ttp', [App\Http\Controllers\backend\ResultsUtilizationController::class, 'AddTtp'])->name('AddTtp');
Route::get('/edit-ttp/{id}', [App\Http\Controllers\backend\ResultsUtilizationController::class, 'EditTtp'])->name('EditTtp');
Route::post('/update-ttp/{id}', [App\Http\Controllers\backend\ResultsUtilizationController::class, 'UpdateTtp'])->name('UpdateTtp');
Route::get('/delete-ttp/{id}', [App\Http\Controllers\backend\ResultsUtilizationController::class, 'DeleteTtp'])->name('DeleteTtp');

//TTM 
Route::post('/add-ttm', [App\Http\Controllers\backend\ResultsUtilizationController::class, 'AddTtm'])->name('AddTtm');
Route::get('/edit-ttm/{id}', [App\Http\Controllers\backend\ResultsUtilizationController::class, 'EditTtm'])->name('EditTtm');
Route::post('/update-ttm/{id}', [App\Http\Controllers\backend\ResultsUtilizationController::class, 'UpdateTtm'])->name('UpdateTtm');
Route::get('/delete-ttm/{id}', [App\Http\Controllers\backend\ResultsUtilizationController::class, 'DeleteTtm'])->name('DeleteTtm');

//TPA
Route::post('/add-tpa', [App\Http\Controllers\backend\ResultsUtilizationController::class, 'AddTpa'])->name('AddTpa');
Route::get('/edit-tpa/{id}', [App\Http\Controllers\backend\ResultsUtilizationController::class, 'EditTpa'])->name('EditTpa');
Route::post('/update-tpa/{id}', [App\Http\Controllers\backend\ResultsUtilizationController::class, 'UpdateTpa'])->name('UpdateTpa');
Route::get('/delete-tpa/{id}', [App\Http\Controllers\backend\ResultsUtilizationController::class, 'DeleteTpa'])->name('DeleteTpa');

// CBG Trainings
Route::post('/add-training', [App\Http\Controllers\backend\TrainingsController::class, 'AddTraining'])->name('AddTraining');
Route::get('/edit-training/{id}', [App\Http\Controllers\backend\TrainingsController::class, 'EditTraining'])->name('EditTraining');
Route::post('/update-training/{id}', [App\Http\Controllers\backend\TrainingsController::class, 'UpdateTraining'])->name('UpdateTraining');
Route::get('/delete-training/{id}', [App\Http\Controllers\backend\TrainingsController::class, 'DeleteTraining'])->name('DeleteTraining');

// CBG Awards
Route::post('/add-award', [App\Http\Controllers\backend\AwardsController::class, 'AddAward'])->name('AddAward');
Route::get('/edit-award/{id}', [App\Http\Controllers\backend\AwardsController::class, 'EditAward'])->name('EditAward');
Route::post('/update-award/{id}', [App\Http\Controllers\backend\AwardsController::class, 'UpdateAward'])->name('UpdateAward');
Route::get('/delete-award/{id}', [App\Http\Controllers\backend\AwardsController::class, 'DeleteAward'])->name('DeleteAward');

// CBG Expenditures
Route::post('/add-equipment', [App\Http\Controllers\backend\EquipmentController::class, 'AddEquipment'])->name('AddEquipment');
Route::get('/edit-equipment/{id}', [App\Http\Controllers\backend\EquipmentController::class, 'EditEquipment'])->name('EditEquipment');
Route::post('/update-equipment/{id}', [App\Http\Controllers\backend\EquipmentController::class, 'UpdateEquipment'])->name('UpdateEquipment');
Route::get('/delete-equipment/{id}', [App\Http\Controllers\backend\EquipmentController::class, 'DeleteEquipment'])->name('DeleteEquipment');

// Report List
Route::get('/report-list', [App\Http\Controllers\backend\ReportListController::class, 'reportListIndex'])->name('reportListIndex');
Route::get('/report-test', [App\Http\Controllers\backend\ReportListController::class, 'reportTest'])->name('reportTest');
Route::get('/reports/pdf', [App\Http\Controllers\backend\ReportListController::class, 'createPDF']);

//Download templates
Route::get('download-template-user', [App\Http\Controllers\backend\UserController::class, 'downloadTemplate']);
Route::get('download-template-programs', [App\Http\Controllers\backend\ProgramsController::class, 'downloadTemplate']);
Route::get('download-template-researcher', [App\Http\Controllers\backend\ResearcherController::class, 'downloadTemplate']);
Route::get('download-template-agency', [App\Http\Controllers\backend\AgencyController::class, 'downloadTemplate']);
Route::get('download-template-projects', [App\Http\Controllers\backend\ProjectController::class, 'downloadTemplate']);
Route::get('download-template-under-program-projects', [App\Http\Controllers\backend\ProjectController::class, 'downloadTemplate2']);
Route::get('download-template-subprojects', [App\Http\Controllers\backend\SubprojectController::class, 'downloadTemplate']);

// IMPORT TO DB
Route::post('/import-file', [App\Http\Controllers\backend\ImportController::class, 'importExcel'])->name('importExcel');

// AJAX REQUEST
Route::get('/get-researchers', [App\Http\Controllers\backend\ResultsUtilizationController::class, 'getResearchers'])->name('getResearchers');

// register email
Route::post('/register', [App\Http\Controllers\backend\UserController::class, 'register']);