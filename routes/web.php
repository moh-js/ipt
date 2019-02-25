<?php

Auth::routes();

// Dashboard
Route::get('/', function () {
    return redirect()->route('home');
});
Route::get('/dashboard', 'HomeController@index')->name('home');

// Change password for the first login
Route::post('/changePassword', 'HomeController@changePassword')->name('changePass');

// for querying regions and district for vue JS
Route::get('regions', 'Admin\LocationController@getRegions');
Route::get('districts/{id}', 'Admin\LocationController@getDistrict');

Route::get('get-regions', 'Student\SubmissionController@Regions');
Route::get('get-district/{id}', 'Student\SubmissionController@District');



/*--------------------------------------------------------------------------
| Admin  																|
|--------------------------------------------------------------------------*/
// Admin User Add
Route::get('/dashboard/user', 'Admin\UserController@index')->name('user');
Route::post('/dashboard/user/addAdmin', 'Admin\UserController@adminImport')->name('admin.import');
Route::post('/dashboard/user/addStudent', 'Admin\UserController@StudentImport')->name('student.import');
Route::post('/dashboard/user/addSupervisor', 'Admin\UserController@superImport')->name('supervisor.import');
// Download Sample
Route::get('dashboard/adownload', 'Admin\UserController@adminSample')->name('admin.download');
Route::get('dashboard/sdownload', 'Admin\UserController@studentSample')->name('student.download');
Route::get('dashboard/mdownload', 'Admin\UserController@markerSample')->name('marker.download');
Route::get('dashboard/vdownload', 'Admin\UserController@superSample')->name('supervisor.download');
Route::post('/dashboard/user/addMarker', 'Admin\UserController@markerImport')->name('marker.import');

// Admin News
Route::resource('dashboard/info', 'Admin\InformationController');

// Admin Location
Route::resource('dashboard/location', 'Admin\LocationController');

// More info
Route::get('dashboard/arrival/information', 'Admin\MoreController@arrival')->name('info.arrival');
Route::get('dashboard/arrival/information/{id}', 'Admin\MoreController@arrivalData')->name('info.arrival.id');

// Supervision
Route::get('dashboard/supervision/student-list', 'Admin\SupervisionController@studentList')->name('admin.students');
Route::get('dashboard/supervision/supervisor-list', 'Admin\SupervisionController@superList')->name('admin.supers');
Route::get('dashboard/supervision/assign', 'Admin\SupervisionController@assignPage')->name('admin.assign.view');
Route::post('dashboard/supervision/assign/action', 'Admin\SupervisionController@assign')->name('admin.assign');



/*--------------------------------------------------------------------------
| Student  																|
|--------------------------------------------------------------------------*/
// Student Location
Route::get('/dashboard/vacancy', 'Student\StudentLocController@index')->name('student.loc');

// Student Submission
Route::get('/dashboard/submission/arrival', 'Student\SubmissionController@arrival')->name('sub.arrival');
Route::post('/dashboard/submission/arrivalform', 'Student\SubmissionController@arrival_store')->name('arrival.store');
Route::get('dashboard/submission/logbook&report', 'Student\LogbookController@index')->name('logbook.index');
Route::post('dashboard/submission/logbook&report/upload', 'Student\LogbookController@store')->name('logbook.upload');

// Student Upload Confirmation
Route::post('dashboard/submission/logbook&report/uploadConfirm/{id}', 'Student\LogbookController@confirm')->name('logbook.confirm');

// Student remove arrival note
Route::post('dashboard/submission/arrival/change', 'Student\StudentLocController@change')->name('change.arrival');

// Student News
Route::get('/dashboard/news/show', 'Student\NewsController@index')->name('news.show');
Route::get('/dashboard/news/read/{id}', 'Student\NewsController@read')->name('news.read');

 // Student request placement
Route::post('dashboard/location/request/{id}', 'Student\StudentLocController@request')->name('request.placement');



/*--------------------------------------------------------------------------
| Marker  																|
|--------------------------------------------------------------------------*/
Route::get('dashboard/students/logbooks', 'Marker\LogbookController@logbook')->name('logbook.show');
Route::get('dashboard/students/{id}', 'Marker\LogbookController@markStudent')->name('logbook.mark');
Route::get('dashboard/students/open_logbook/{id}', 'Marker\LogbookController@openLogbook')->name('logbook.open');

// Open student logbook and report
Route::get('dashboard/students/open_report/{id}', 'Marker\LogbookController@openReport')->name('report.open');
Route::post('dashboard/students/logbooks/store/{id}', 'Marker\LogbookController@store')->name('logbook.store');

// List all student results of specific department
Route::get('dashboard/students/performance/list', 'Marker\PerformanceController@listStudent')->name('student.list');

// Download student results in excel and pdf
Route::get('dashboard/students/performance/list/excel', 'Marker\PerformanceController@excel')->name('student.excel');
Route::get('dashboard/students/performance/list/pdf', 'Marker\PerformanceController@pdf')->name('student.pdf');




/*--------------------------------------------------------------------------
| Supervisor  																|
|--------------------------------------------------------------------------*/
Route::get('dashboar/supervisor/{id}', 'Super\SuperviseController@induSuper')->name('industrial.mark');
Route::get('dashboar/supervisor/add/{id}', 'Super\SuperviseController@uniSuper')->name('university.mark');

// Assigned Student List
Route::get('dashboard/supervise/student_list', 'Super\SuperviseController@studentList')->name('super.student_list');