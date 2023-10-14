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


Route::get('/profile',[App\Http\Controllers\profileController::class,'profile']);
Route::post('/checkUser',[App\Http\Controllers\CalculateServer::class,'checkUser']);

Route::get('/pdf', function () {
    return view('c');
});
Route::get('/test', function () {
    return view('problem.test');
});
Auth::routes(['verify'=>true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware(['auth']);
Route::get('/dashboard/{contestt}', [App\Http\Controllers\HomeController::class, 'index']);

Route::get('/r/{contest}',[App\Http\Controllers\ratingController::class,'list']);
Route::get('/rating',[App\Http\Controllers\ratingController::class,'list_geust']);

Route::get('/c/{contestt}',[App\Http\Controllers\contestController::class,'list']);
Route::get('/contest',[App\Http\Controllers\contestController::class,'list_geust']);
Route::get('/c/Detail/{contestt}',[App\Http\Controllers\contestController::class,'detail']);


Route::get('/contestant/accept/{id}',[App\Http\Controllers\contestantController::class,'accept'])->middleware(['auth']);
Route::get('/contestant/reject/{id}',[App\Http\Controllers\contestantController::class,'reject'])->middleware(['auth']);

Route::get('/u/{contest}',[App\Http\Controllers\userController::class,'list'])->middleware(['auth']);
Route::get('/u/{id}/{contestt}',[App\Http\Controllers\userController::class,'showDetail'])->middleware(['auth']);
Route::get('/deleteUser/{id}',[App\Http\Controllers\userController::class,'delete'])->middleware(['auth']);
Route::get('/uDetail/{username}/{contestt}',[App\Http\Controllers\userController::class,'userDetail']);
Route::get('/userByName/{name}/{contestt}',[App\Http\Controllers\userController::class,'userByName']);
Route::post('/profile/changeProfile',[App\Http\Controllers\userController::class,'changeProfile']);
Route::get('/profile/changePassword',[App\Http\Controllers\userController::class,'changePassword']);
Route::get('/deleteProfile',[App\Http\Controllers\userController::class,'deleteProfile']);

Route::get('/a/{contest}',[App\Http\Controllers\adminController::class,'list'])->middleware(['auth']);
Route::get('/addNewAdmin/{id}',[App\Http\Controllers\adminController::class,'addNewAdmin'])->middleware(['auth']);
Route::get('/a/{id}/{contestt}',[App\Http\Controllers\userController::class,'showDetail'])->middleware(['auth']);
Route::get('/removeAdmin/{id}',[App\Http\Controllers\adminController::class,'removeAdmin'])->middleware(['auth']);
Route::get('/searchUser/{user}',[App\Http\Controllers\adminController::class,'searchUser'])->middleware(['auth']);
Route::get('/setPermission/{user}',[App\Http\Controllers\adminController::class,'setPermission'])->middleware(['auth']);
Route::get('/checkContestTime/{contestt}',[App\Http\Controllers\livecontestController::class,'checkContestTime'])->middleware(['auth']);

// Team


// Country
Route::get('/addCountry',[App\Http\Controllers\countryController::class,'addCountry'])->middleware(['auth']);
Route::get('/cy/{contest}',[App\Http\Controllers\countryController::class,'list'])->middleware(['auth']);
Route::get('/editCountry{id}',[App\Http\Controllers\countryController::class,'editCountry'])->middleware(['auth']);
Route::get('/cy/delete/{id}',[App\Http\Controllers\countryController::class,'delete'])->middleware(['auth']);

// Problem
Route::get('/p/{contestt}',[App\Http\Controllers\problemController::class,'list'])->middleware(['auth']);
Route::get('/problems',[App\Http\Controllers\problemController::class,'list_geust']);
Route::get('/c_p/{contestt}',[App\Http\Controllers\problemController::class,'contestProblems'])->middleware(['auth']);
Route::get('/p/add/{contestt}',[App\Http\Controllers\problemController::class,'add'])->middleware(['auth']);
Route::get('/p/{id}/{contest?}',[App\Http\Controllers\problemController::class,'show'])->middleware(['auth']);
Route::get('/editProblem/{id}/{contestt}',[App\Http\Controllers\problemController::class,'editProblem'])->middleware(['auth']);
Route::get('/p/edit/{id}/{contestt}',[App\Http\Controllers\problemController::class,'edit'])->middleware(['auth']);
Route::get('/p/delete/{id}',[App\Http\Controllers\problemController::class,'delete'])->middleware(['auth']);

Route::get('/s/{contest}',[App\Http\Controllers\submissionController::class,'list'])->middleware(['auth']);
Route::get('/submission',[App\Http\Controllers\submissionController::class,'list_geust']);
Route::get('/s/only/{contest}',[App\Http\Controllers\submissionController::class,'listOnly'])->middleware(['auth']);
Route::get('/s/{contestt}/{problem}',[App\Http\Controllers\submissionController::class,'listDetail']);
// Route::get('/excecute/{contest}', [App\Http\Controllers\submissionController::class, 'execute']);
Route::post('/excecute/{contest}', [App\Http\Controllers\actionController::class, 'execute'])->middleware(['auth']);
Route::get('/ft/{contest}', [App\Http\Controllers\actionController::class, 'fecthtime']);
Route::get('/s/editor/{id}/{contest?}',[App\Http\Controllers\problemController::class,'Editor'])->middleware(['auth']);

Route::get('/searchTeam/{team}',[App\Http\Controllers\teamController::class,'searchTeam'])->middleware(['auth']);
Route::get('/searchOrganization/{org}',[App\Http\Controllers\teamController::class,'searchOrganization'])->middleware(['auth']);
Route::get('/joinTeam/{id}',[App\Http\Controllers\teamController::class,'joinTeam'])->middleware(['auth']);
Route::get('/t/edit/{id}',[App\Http\Controllers\teamController::class,'update'])->middleware(['auth']);
Route::get('/t/delete/{id}',[App\Http\Controllers\teamController::class,'delete'])->middleware(['auth']);
Route::get('/t/leaveTeam',[App\Http\Controllers\teamController::class,'leave'])->middleware(['auth']);

Route::get('/sfilter/{contestt}/{v}',[App\Http\Controllers\submissionController::class,'listAccepted']);
Route::get('/s_geust/{v}',[App\Http\Controllers\submissionController::class,'listAccepted_geust']);
Route::get('/feach_verdict',[App\Http\Controllers\submissionController::class,'execute2'])->middleware(['auth']);

Route::fallback(function () {
    return view('notfound');
});
