<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DetailReportController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ExcelController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/register', function () {
//     return view('register');
// });
Route::get('/', function () {
    return view('login');
});

Route::get('/',[AuthController::class,'login']);
Route::post('/auth', [AuthController::class, 'auth']);

Route::middleware(['checkLevel:Admin'])->group(function () {
    Route::get('/home', [AuthController::class, 'home']);
    Route::get('/profile', [AuthController::class, 'profile']);
    Route::get('/user', [AuthController::class, 'showuser']);
    Route::get('/adduser', [AuthController::class, 'createuser']);
    Route::post('/adduser', [AuthController::class, 'adduser']);
    Route::get('/delete/{id}', [AuthController::class, 'delete']);
    Route::get('update/{id}', [AuthController::class, 'update']);
    Route::post('edit/{id}', [AuthController::class, 'edit']);
    Route::get('/logout', [AuthController::class, 'logout']);

    Route::get('/event', [EventController::class, 'showevent']);
    Route::get('/create_event', [EventController::class, 'addevent']);
    Route::post('/create_event', [EventController::class, 'createevent']);
    Route::get('/event/edit_event/{id}', [EventController::class, 'editevent']);
    Route::post('/event/edit_event/{id}', [EventController::class, 'updateevent']);
    Route::get('/deleteevent/{id}', [EventController::class, 'deleteevent']);

    Route::get('/task', [TaskController::class, 'showtask']);
    Route::get('/task/create/{id}', [TaskController::class, 'addtask']);
    Route::post('/task/create/{id}', [TaskController::class, 'createtask']);
    Route::get('/task/update/{id}', [TaskController::class, 'edittask']);
    Route::post('/task/update/{id}', [TaskController::class, 'updatetask']);
    Route::get('/deletetask/{id}', [TaskController::class, 'deletetask']);

    Route::get('/subtask/{id}', [TaskController::class, 'showsubtask']);
    Route::get('/create-subtask/{id}', [TaskController::class, 'addsubtask']);
    Route::post('/create-subtask/{id}', [TaskController::class, 'createsubtask']);
    Route::get('/update-subtask/{id}', [TaskController::class, 'editsubtask']);
    Route::post('/update-subtask/{id}', [TaskController::class, 'updatesubtask']);
    Route::get('/deletesubtask/{id}', [TaskController::class, 'deletesubtask']);

    Route::get('/subSubtask/{id}', [TaskController::class, 'showsubSubtask']);
    Route::get('/create-subSubtask/{id}', [TaskController::class, 'addsubSubtasks']);
    Route::post('/create-subSubtask/{id}', [TaskController::class, 'addsubSubtask']);
    // Route::get('/completeSubSubTask/{id}', [TaskController::class,'completeSubSubTask']);
    Route::get('/edit-subSubtask/{id}', [TaskController::class, 'edit']);
    Route::post('/edit-subSubtask/{id}', [TaskController::class, 'update']);
    Route::get('/deletesubSubTask/{id}', [TaskController::class, 'delete']);

    Route::get('/report', [ReportController::class, 'show']);
    Route::get('/report/create_report/{id}', [ReportController::class, 'add']);
    Route::post('/report/create_report/{id}', [ReportController::class, 'create']);
    Route::get('/report/update/{id}', [ReportController::class, 'edit']);
    Route::post('/report/update/{id}', [ReportController::class, 'update']);
    Route::get('/deletereport/{id}', [ReportController::class, 'delete']);

    Route::get('/detailReport', [DetailReportController::class, 'show']);
    Route::get('/addDetailReport/{id}', [DetailReportController::class, 'add']);
    Route::post('/addDetailReport/{id}', [DetailReportController::class, 'create']);
    Route::get('/updateDetail/{id}', [DetailReportController::class, 'edit']);
    Route::post('/updateDetail/{id}', [DetailReportController::class, 'update']);
    Route::get('/deleteDetail/{id}', [DetailReportController::class, 'delete']);

    Route::get('/tasks/export', [ExcelController::class, 'export'])->name('tasks.export');
    // Route::get('/member',[MemberController::class,'show']);

    // Route::get('/member/showmember',[MemberController::class,'show']);
});

Route::middleware(['checkLevel:Member'])->group(function () {
    Route::get('/member/home', [AuthController::class, 'home']);

    Route::get('/member/user', [AuthController::class, 'showuser']);


    Route::get('/member/event', [EventController::class, 'showevent']);
    Route::get('/member/create_event', [EventController::class, 'addevent']);
    Route::post('/member/create_event', [EventController::class, 'createevent']);
    Route::get('/member/edit_event/{id}', [EventController::class, 'editevent']);
    Route::post('/member/edit_event/{id}', [EventController::class, 'updateevent']);
    Route::get('/member/deleteevent/{id}', [EventController::class, 'deleteevent']);

    Route::get('/member/mytask', [TaskController::class, 'mytask']);

    Route::get('/member/task', [TaskController::class, 'showtask']);
    Route::get('/filter', [TaskController::class, 'selectEvents']);
    Route::get('/member/task/create/{id}', [TaskController::class, 'addtask']);
    Route::post('/member/task/create/{id}', [TaskController::class, 'createtask']);
    Route::get('/member/task/update/{id}', [TaskController::class, 'edittask']);
    Route::post('/member/task/update/{id}', [TaskController::class, 'updatetask']);
    Route::get('/member/deletetask/{id}', [TaskController::class, 'deletetask']);

    Route::get('/member/subtask/{id}', [TaskController::class, 'showsubtask']);
    Route::get('/member/create-subtask/{id}', [TaskController::class, 'addsubtask']);
    Route::post('/member/create-subtask/{id}', [TaskController::class, 'createsubtask']);
    Route::get('/member/update-subtask/{id}', [TaskController::class, 'editsubtask']);
    Route::post('/member/update-subtask/{id}', [TaskController::class, 'updatesubtask']);
    Route::get('/member/deletesubtask/{id}', [TaskController::class, 'delete']);


    Route::get('/member/subSubtask/{id}', [TaskController::class, 'showsubSubtask']);
    Route::get('/member/create-subSubtask/{id}', [TaskController::class, 'addsubSubtasks']);
    Route::post('/member/create-subSubtask/{id}', [TaskController::class, 'addsubSubtask']);
    Route::get('/member/edit-subSubtask/{id}', [TaskController::class, 'edit']);
    Route::post('/member/edit-subSubtask/{id}', [TaskController::class, 'update']);
    Route::get('/member/deletesubSubTask/{id}', [TaskController::class, 'delete']);

    Route::get('/member/report', [ReportController::class, 'show']);
    Route::get('/member/create_report/{id}', [ReportController::class, 'add']);
    Route::post('/member/create_report/{id}', [ReportController::class, 'create']);
    Route::get('/member/report/update/{id}', [ReportController::class, 'edit']);
    Route::post('/member/report/update/{id}', [ReportController::class, 'update']);
    Route::get('/member/deletereport/{id}', [ReportController::class, 'delete']);


    Route::get('/member/detailReport', [DetailReportController::class, 'show']);
    Route::get('/member/addDetailReport/{id}', [DetailReportController::class, 'add']);
    Route::post('/member/addDetailReport/{id}', [DetailReportController::class, 'create']);
    Route::get('/member/updateDetail/{id}', [DetailReportController::class, 'edit']);
    Route::post('/member/updateDetail/{id}', [DetailReportController::class, 'update']);
    Route::get('/member/deleteDetail/{id}', [DetailReportController::class, 'delete']);



    Route::get('/member/showmember',[MemberController::class,'show']);
    Route::get('/member/addmember/{id}',[MemberController::class,'addmember']);
    Route::post('/member/addmember/{id}',[MemberController::class,'createmember']);
    Route::get('/member/delete/{id}',[MemberController::class,'delete']);
    Route::get('/member/edit/{id}',[MemberController::class,'edit']);
    Route::post('/member/edit/{id}',[MemberController::class,'update']);



    Route::get('/member/profile', [AuthController::class, 'profile']);
    Route::get('/member/profupdate/{id}', [AuthController::class, 'profupdate']);
    Route::post('/member/profupdate/{id}',[AuthController::class,'edit']);

    Route::get('/member/tasks/export', [ExcelController::class, 'export']);
    Route::get('/member/logout', [AuthController::class, 'logout']);

});

Route::get('/unauthorized', function () {
    return view('unauthorize');
});
