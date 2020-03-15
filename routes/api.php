<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::apiResource('persons', 'PersonController');
Route::apiResource('students', 'StudentController');
Route::apiResource('teachers', 'TeacherController');

Route::apiResource('subjects', 'SubjectController')->except(['store','update']);
Route::post('subjects/teacher/{teacher}', ['uses' => 'SubjectController@store', 'as' => 'subjects.store']);
Route::put('subjects/teacher/{teacher}/{subject}', ['uses' => 'SubjectController@update', 'as' => 'subjects.update']);

Route::apiResource('type_qualifications', 'TypeQualificationController');

Route::get('student/subject', ['uses' => 'StudentSubjectController@index', 'as' => 'student_subject.index']);
Route::post('student/{student}/subject/{subject}', ['uses' => 'StudentSubjectController@store', 'as' => 'student_subject.store']);
Route::delete('student/subject/{student_subject}', ['uses' => 'StudentSubjectController@destroy', 'as' => 'student_subject.delete']);

Route::apiResource('qualifications', 'QualificationController')->except(['store']);
Route::post('qualifications/student_subject/{student_subject}', ['uses' => 'QualificationController@store', 'as' => 'qualifications.store']);
Route::get('qualifications/student/{student}', ['uses' => 'QualificationController@student', 'as' => 'qualifications.student']);
Route::get('history', ['uses' => 'QualificationController@history', 'as' => 'qualifications.history']);