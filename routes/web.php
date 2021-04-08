<?php

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

Auth::routes(["verify" => true]);
Route::get('/', 'HomeController@home')->name('home');
Route::get('/home', 'HomeController@home')->name('home');
Route::get('/instructor/registration', 'HomeController@instructorRegistration')->name('instructorRegistration');
Route::get('/student/registration', 'HomeController@studentRegistration')->name('studentRegistration');
Route::post('/process/email', 'HomeController@processEmailCheck')->name('processEmail');
Route::get('/process/email', 'HomeController@processEmailCheck')->name('processEmail');
Route::post('/process/security/question', 'HomeController@processSecurityQuestion')->name('processSecurityQuestion');
Route::get('/process/security/question', 'HomeController@processSecurityQuestion')->name('processSecurityQuestion');
Route::post('process/change-password', 'HomeController@processPasswordReset')->name('processPasswordReset');

Route::post('/save/instructor', 'HomeController@saveInstructor')->name('saveInstructor');
Route::post('/register/student', 'HomeController@saveStudent')->name('registerStudent');


Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

Route::get('/groups', 'GroupController@index')->name('groups');
Route::get('/groups/create', 'GroupController@create')->name('createGroup');
Route::post('/groups/save', 'GroupController@store')->name('saveGroup');
Route::get('/groups/show/{id}', 'GroupController@show')->name('showGroup');
Route::get('/groups/edit/{id}', 'GroupController@edit')->name('editGroup');
Route::post('/groups/update/{id}', 'GroupController@update')->name('updateGroup');
Route::get('/groups/delete/{id}', 'GroupController@destroy')->name('deleteGroup');
Route::get('/groups/add/student/{id}', 'GroupController@addStudent')->name('addStudentGroup');
Route::post('/groups/save/student/{id}', 'GroupController@saveStudent')->name('saveStudentGroup');
Route::get('/groups/remove/student/{id}', 'GroupController@removeStudent')->name('removeStudent');
Route::get('/groups/add/mark/{id}', 'GroupController@addMark')->name('addMarkGroup');
Route::post('/groups/save/mark/{id}', 'GroupController@saveMark')->name('saveMarkGroup');
Route::get('/groups/remove-groups', 'GroupController@deleteAllGroups')->name('deleteAllGroups');

Route::get('/evaluations', 'EvaluationController@index')->name('evaluations');
Route::get('/evaluations/create', 'EvaluationController@create')->name('createEvaluation');
Route::post('/evaluations/save', 'EvaluationController@store')->name('saveEvaluation');
Route::get('/evaluations/show/{id}', 'EvaluationController@show')->name('showEvaluation');
Route::get('/evaluations/edit/{id}', 'EvaluationController@edit')->name('editEvaluation');
Route::post('/evaluations/update/{id}', 'EvaluationController@update')->name('updateEvaluation');
Route::get('/evaluations/delete/{id}', 'EvaluationController@destroy')->name('deleteEvaluation');

Route::get('/students', 'StudentController@index')->name('students');
Route::get('/students/create', 'StudentController@create')->name('createStudent');
Route::post('/students/save', 'StudentController@store')->name('saveStudent');
Route::get('/students/show/{id}', 'StudentController@show')->name('showStudent');
Route::get('/students/edit/{id}', 'StudentController@edit')->name('editStudent');
Route::post('/students/update/{id}', 'StudentController@update')->name('updateStudent');
Route::get('/students/delete/{id}', 'StudentController@destroy')->name('deleteStudent');
Route::get('/students/marks/{id}', 'StudentController@marks')->name('markStudent');
Route::get('/students/print-mark/{id}', 'StudentController@printMark')->name('printMark');
Route::get('/students/print/pdf', 'StudentController@printStudents')->name('printStudents');
Route::get('/students/print/excel', 'StudentController@exportStudents')->name('exportStudents');
Route::get('/students/print/csv', 'StudentController@exportCSV')->name('exportStudentsCSV');

Route::get('/students/add-instructor-role/{id}', 'StudentController@giveInstructorRole')->name('giveInstructorRole');
Route::get('/students/remove-instructor-role/{id}', 'StudentController@removeInstructorRole')->name('removeInstructorRole');

Route::get('/students/edit/mark/{id}', 'StudentController@editStudentMark')->name('editStudentMark');
Route::post('/students/update/mark/{id}', 'StudentController@updateStudentMark')->name('updateStudentMark');
Route::get('/students/remove', 'StudentController@deleteAllStudents')->name('deleteAllStudents');

Route::get('/groups/edit/mark/{id}', 'GroupController@editGroupMark')->name('editGroupMark');
Route::post('/groups/update/mark/{id}', 'GroupController@updateGroupMark')->name('updateGroupMark');


Route::get('/students/upload/view', 'StudentController@callUploadView')->name('callUploadView');
Route::post('/students/upload', 'StudentController@upload')->name('upload');

Route::get('/group/generate/view', 'GroupController@callGroupView')->name('callGroupView');
Route::post('/students/generate', 'GroupController@generateGroups')->name('generateGroups');

//rubric
Route::get('/rubrics/evaluations', 'RubricController@index')->name('rubrics');
Route::get('/rubrics/create/{id}', 'RubricController@createRubric')->name('createRubric');
Route::get('/sub-rubrics/create/{id}', 'RubricController@createSubRubric')->name('createSubRubric');
Route::get('/sub-sub/rubrics/create/{id}', 'RubricController@createSubSubRubric')->name('createSubSubRubric');
Route::get('/rubrics/view/{id}', 'RubricController@viewRubric')->name('viewRubric');
Route::get('/sub-rubrics/view/{id}', 'RubricController@viewSubRubric')->name('viewSubRubric');
Route::get('/sub-sub-rubrics/view/{id}', 'RubricController@viewSubSubRubric')->name('viewSubSubRubric');
Route::post('/rubrics/save/{id}', 'RubricController@storeRubric')->name('saveRubric');
Route::post('/sub-rubrics/save/{id}', 'RubricController@storeSubRubric')->name('saveSubRubric');
Route::post('/sub-sub-rubrics/save/{id}', 'RubricController@storeSubSubRubric')->name('saveSubSubRubric');
Route::post('/rubrics/generate/{id}', 'RubricController@generateRubric')->name('generateRubric');
Route::get('/rubrics/evaluation/{evaluationId}/group/{groupId}', 'RubricController@groupRubric')->name('groupRubric');
Route::get('/rubrics/edit/{id}', 'RubricController@edit')->name('editRubric');
Route::post('/rubrics/update/{id}', 'RubricController@update')->name('updateRubric');
Route::get('/rubrics/delete/{id}', 'RubricController@destroy')->name('deleteRubric');



//Rubric Marks
Route::post('/rubrics/marking/{id}', 'RubricController@addRubricMark')->name('addRubricMark');
Route::post('/sub-rubrics/marking/{id}', 'RubricController@addSubRubricMark')->name('addSubRubricMark');
Route::post('/sub-sub-rubrics/marking/{id}', 'RubricController@addSubSubRubricMark')->name('addSubSubRubricMark');

//edit rubric
Route::get('/rubrics/edit/{id}', 'RubricController@editRubric')->name('editRubric');
Route::get('/sub-rubrics/edit/{id}', 'RubricController@editSubRubric')->name('editSubRubric');
Route::get('/sub-sub-rubrics/edit/{id}', 'RubricController@editSubSubRubric')->name('editSubSubRubric');

//edit rubric
Route::post('/rubrics/update/{id}', 'RubricController@updateRubric')->name('updateRubric');
Route::post('/sub-rubrics/update/{id}', 'RubricController@updateSubRubric')->name('updateSubRubric');
Route::post('/sub-sub-rubrics/update/{id}', 'RubricController@updateSubSubRubric')->name('updateSubSubRubric');

Route::get('/marks/index', 'MarkController@index')->name('viewMarks');
Route::post('/marks/print', 'MarkController@print')->name('print-mark-report');

Route::get('/user/profile', 'UserController@profile')->name('profile');
Route::post('/user/profile/update', 'UserController@update')->name('updateProfile');
Route::post('/change-student-password', 'UserController@updateStudentPassword')->name('updateStudentPassword');
Route::get('/student-instructor', 'UserController@studentInstructor')->name('studentInstructor');

