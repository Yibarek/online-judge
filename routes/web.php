<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers;
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


Route::get('/',[App\Http\Controllers\HomeController::class,'welcomePage']);

Route::get('/test', function () {
    return view('problem.test');
});
Route::get('/accessdenied', function () {
    return view('admin.accessdenied');
});

Route::get('/addProblem',[App\Http\Controllers\problemController::class,'addProblem']);

Route::get('/createContest',[App\Http\Controllers\contestController::class,'createContest']);

Route::get('/profile',[App\Http\Controllers\profileController::class,'profile']);
Route::post('/checkUser',[App\Http\Controllers\CalculateServer::class,'checkUser']);

Route::get('/pdf', function () {
    return view('c');
});
Route::get('/test', function () {
    return view('problem.test');
});
Auth::routes(['verify'=>true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware(['auth', 'verified']);
Route::get('/dashboard/{contestt}', [App\Http\Controllers\HomeController::class, 'index']);

Route::get('/r/{contest}',[App\Http\Controllers\ratingController::class,'list']);
Route::get('/rating',[App\Http\Controllers\ratingController::class,'list_geust']);

Route::get('/lc/scoreboard/{contestt}', [App\Http\Controllers\liveContestController::class, 'scoreboard']);
Route::get('/lc/scoreboard_geust/{contestt}', [App\Http\Controllers\liveContestController::class, 'scoreboard_geust']);
Route::get('/lc/clarification/{contest}', [App\Http\Controllers\livecontestController::class, 'clarification'])->middleware(['auth', 'verified']);
Route::get('/lc/contestants/{c_id}', [App\Http\Controllers\contestantController::class, 'list']);
Route::get('/lc/add/contestant/{contest}', [App\Http\Controllers\contestantController::class, 'add'])->middleware(['auth', 'verified']);
Route::get('/lc/complete/{contestt}', [App\Http\Controllers\contestController::class, 'complete'])->middleware(['auth', 'verified']);
Route::get('/lc/sendClarification/{contestt}', [App\Http\Controllers\liveContestController::class, 'sendClarification'])->middleware(['auth', 'verified']);
Route::get('/lc/selectChat/{user}/{contestt}', [App\Http\Controllers\liveContestController::class, 'loadClarification'])->middleware(['auth', 'verified']);

Route::get('/c/{contestt}',[App\Http\Controllers\contestController::class,'list']);
Route::get('/contest',[App\Http\Controllers\contestController::class,'list_geust']);
Route::get('/c/Detail/{contestt}',[App\Http\Controllers\contestController::class,'detail']);
Route::get('/createContest',[App\Http\Controllers\contestController::class,'createContest'])->middleware(['auth', 'verified']);
Route::post('/c/contestDetail/{contestt}',[App\Http\Controllers\contestController::class,'contestDetail'])->middleware(['auth', 'verified']);
Route::post('/c/contestSchedule/{contestt}',[App\Http\Controllers\contestController::class,'contestSchedule']);
Route::post('/c/contestProblemNo/{contestt}',[App\Http\Controllers\contestController::class,'contestProblemNo'])->middleware(['auth', 'verified']);
Route::post('/c/contestProblems/{contestt}',[App\Http\Controllers\contestController::class,'contestProblems'])->middleware(['auth', 'verified']);
Route::post('/c/savecontestProblems/{contestt}',[App\Http\Controllers\contestController::class,'saveContestProblems']);
Route::get('/c/addTestcases/{contestt}/{p_in_s}',[App\Http\Controllers\contestController::class,'addTestcases'])->middleware(['auth', 'verified']);
Route::get('/c/finishReg/{contestt}',[App\Http\Controllers\contestController::class,'finishContestReg'])->middleware(['auth', 'verified']);

Route::get('/c/toDetail/{contestt}',[App\Http\Controllers\contestController::class,'toDetail'])->middleware(['auth', 'verified']);
Route::get('/c/toSchedule/{contestt}',[App\Http\Controllers\contestController::class,'toSchedule'])->middleware(['auth', 'verified']);
Route::get('/c/toProblemNo/{contestt}',[App\Http\Controllers\contestController::class,'toNoOfProblems'])->middleware(['auth', 'verified']);
Route::get('/c/toProblems/{contestt}',[App\Http\Controllers\contestController::class,'toProblems'])->middleware(['auth', 'verified']);

Route::get('/contestant/accept/{id}',[App\Http\Controllers\contestantController::class,'accept'])->middleware(['auth', 'verified']);
Route::get('/contestant/reject/{id}',[App\Http\Controllers\contestantController::class,'reject'])->middleware(['auth', 'verified']);

Route::get('/u/{contest}',[App\Http\Controllers\userController::class,'list'])->middleware(['auth', 'verified']);
Route::get('/u/{id}/{contestt}',[App\Http\Controllers\userController::class,'showDetail'])->middleware(['auth', 'verified']);
Route::get('/deleteUser/{id}',[App\Http\Controllers\userController::class,'delete'])->middleware(['auth', 'verified']);
Route::get('/uDetail/{username}/{contestt}',[App\Http\Controllers\userController::class,'userDetail']);
Route::get('/userByName/{name}/{contestt}',[App\Http\Controllers\userController::class,'userByName']);
Route::post('/profile/changeProfile',[App\Http\Controllers\userController::class,'changeProfile']);
Route::get('/profile/changePassword',[App\Http\Controllers\userController::class,'changePassword']);
Route::get('/deleteProfile',[App\Http\Controllers\userController::class,'deleteProfile']);

Route::get('/a/{contest}',[App\Http\Controllers\adminController::class,'list'])->middleware(['auth', 'verified']);
Route::get('/addNewAdmin/{id}',[App\Http\Controllers\adminController::class,'addNewAdmin'])->middleware(['auth', 'verified']);
Route::get('/a/{id}/{contestt}',[App\Http\Controllers\userController::class,'showDetail'])->middleware(['auth', 'verified']);
Route::get('/removeAdmin/{id}',[App\Http\Controllers\adminController::class,'removeAdmin'])->middleware(['auth', 'verified']);
Route::get('/searchUser/{user}',[App\Http\Controllers\adminController::class,'searchUser'])->middleware(['auth', 'verified']);
Route::get('/setPermission/{user}',[App\Http\Controllers\adminController::class,'setPermission'])->middleware(['auth', 'verified']);
Route::get('/checkContestTime/{contestt}',[App\Http\Controllers\livecontestController::class,'checkContestTime'])->middleware(['auth', 'verified']);

Route::get('/createTeam',[App\Http\Controllers\teamController::class,'createTeam'])->middleware(['auth', 'verified']);
Route::get('/t/{contest}',[App\Http\Controllers\teamController::class,'list'])->middleware(['auth', 'verified']);
Route::get('/t/{name}',[App\Http\Controllers\teamController::class,'show'])->middleware(['auth', 'verified']);
Route::get('/t/delete/{id}',[App\Http\Controllers\teamController::class,'delete'])->middleware(['auth', 'verified']);

Route::get('/p/{contestt}',[App\Http\Controllers\problemController::class,'list'])->middleware(['auth', 'verified']);
Route::get('/problems',[App\Http\Controllers\problemController::class,'list_geust']);
Route::get('/c_p/{contestt}',[App\Http\Controllers\problemController::class,'contestProblems'])->middleware(['auth', 'verified']);
Route::get('/p/add/{contestt}',[App\Http\Controllers\problemController::class,'add'])->middleware(['auth', 'verified']);
Route::get('/p/{id}/{contest?}',[App\Http\Controllers\problemController::class,'show'])->middleware(['auth', 'verified']);
Route::get('/editProblem/{id}/{contestt}',[App\Http\Controllers\problemController::class,'editProblem'])->middleware(['auth', 'verified']);
Route::get('/p/edit/{id}/{contestt}',[App\Http\Controllers\problemController::class,'edit'])->middleware(['auth', 'verified']);
Route::get('/p/delete/{id}',[App\Http\Controllers\problemController::class,'delete'])->middleware(['auth', 'verified']);

Route::get('/s/{contest}',[App\Http\Controllers\submissionController::class,'list'])->middleware(['auth', 'verified']);
Route::get('/submission',[App\Http\Controllers\submissionController::class,'list_geust']);
Route::get('/s/only/{contest}',[App\Http\Controllers\submissionController::class,'listOnly'])->middleware(['auth', 'verified']);
Route::get('/s/{contestt}/{problem}',[App\Http\Controllers\submissionController::class,'listDetail']);
// Route::get('/excecute/{contest}', [App\Http\Controllers\submissionController::class, 'execute']);
Route::post('/excecute/{contest}', [App\Http\Controllers\actionController::class, 'execute'])->middleware(['auth', 'verified']);
Route::get('/s/editor/{id}/{contest?}',[App\Http\Controllers\problemController::class,'Editor'])->middleware(['auth', 'verified']);

Route::get('/searchTeam/{team}',[App\Http\Controllers\teamController::class,'searchTeam'])->middleware(['auth', 'verified']);
Route::get('/searchOrganization/{org}',[App\Http\Controllers\teamController::class,'searchOrganization'])->middleware(['auth', 'verified']);
Route::get('/joinTeam/{id}',[App\Http\Controllers\teamController::class,'joinTeam'])->middleware(['auth', 'verified']);
Route::get('/t/edit/{id}',[App\Http\Controllers\teamController::class,'update'])->middleware(['auth', 'verified']);
Route::get('/t/delete/{id}',[App\Http\Controllers\teamController::class,'delete'])->middleware(['auth', 'verified']);
Route::get('/t/leaveTeam',[App\Http\Controllers\teamController::class,'leave'])->middleware(['auth', 'verified']);

Route::get('/sfilter/{contestt}/{v}',[App\Http\Controllers\submissionController::class,'listAccepted']);
Route::get('/s_geust/{v}',[App\Http\Controllers\submissionController::class,'listAccepted_geust']);
Route::get('/feach_verdict',[App\Http\Controllers\submissionController::class,'execute2'])->middleware(['auth', 'verified']);

Route::fallback(function () {
    return view('notfound');
});
