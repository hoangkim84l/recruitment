<?php
//region Fronend
Route::group(['middleware' => 'localization', 'prefix' => Session::get('locale')], function () {
    $this->get('/trang-chu', 'HomeController@index')->name('home');
    Route::post('/lang', [
        'as' => 'switchLang',
        'uses' => 'LangController@postLang',
    ]);

// Home page
    Route::name('home')->get('/', 'HomeController@index');
// introduce page
    Route::name('introduce')->get('/ve-chung-toi', 'HomeController@introduce');
// contact page
    Route::name('contact')->get('/lien-he', 'HomeController@contact');
/*if you want authentication*/
//Route::get('admin/profile', function () {})->middleware('auth');


Auth::routes();

//region Registration Routes...
$this->get('dang-nhap', 'Auth\LoginController@showLoginForm')->name('login');
$this->get('/scouters/dang-ky', 'Auth\RegisterController@showRegistrationForm')->name('registers');
$this->get('/employers/dang-ky', 'Auth\RegisterController@employerRegistration')->name('registere');
//endregion
//scouter/jobs 
Route::get('/scouters/tim-viec-lam', 'Scouters\JobsController@index')->name('scouterjobsindex');
Route::get('/viec-lam/chi-tiet/{id}', 'Jobs\JobsController@detail')->name('viec-lam/chi-tiet');
Route::any('/scouters/viec-lam/tim-viec-lam', 'Scouters\JobsController@search')->name('scouterjobsearch');
Route::get('/scouters/tim-viec', 'Scouters\JobsController@checkJobsType')->name('scouters/tim-viec');

/*-- Scouters --*/
Route::get('/scouters', 'Scouters\ScoutersController@index')->name('scouter');
Route::get('/scouters/gioi-thieu-viec-lam', 'Scouters\ScoutersController@introjob')->name('introjob');
Route::get('/scouters/ho-so-ca-nhan', 'Scouters\ScoutersController@profile')->name('profile');
Route::post('/scouters/ho-so-ca-nhan', 'Scouters\ScoutersController@profile')->name('profile');

Route::get('/scouters/tai-khoan', 'Scouters\ScoutersController@account')->name('account');
Route::post('/scouters/tai-khoan', 'Scouters\ScoutersController@account')->name('account');
Route::post('/scouters/accountajax', 'Scouters\ScoutersController@accountAjax')->name('accountajax');
Route::post('/scouters/editpassajax', 'Scouters\ScoutersController@editPassAjax')->name('editpassajax');
Route::post('/scouters/getpathajax', 'Scouters\ScoutersController@getPathAjax')->name('getpathajax');
Route::post('/scouters/fileupajax', 'Scouters\ScoutersController@fileUploadAjax')->name('fileupajax');

Route::get('/scouters/danh-sach-ban-be', 'Scouters\ScoutersController@friend')->name('friend');
Route::post('/scouters/danh-sach-ban-be', 'Scouters\ScoutersController@friend')->name('friend');
Route::get('/scouters/danh-sach-ban-be/{id}', 'Scouters\ScoutersController@update')->name('update');
Route::post('/scouters/danh-sach-ban-be/{id}', 'Scouters\ScoutersController@update')->name('update');
Route::post('/scouters/removecheckajax', 'Scouters\ScoutersController@removeCheckAjax')->name('removecheckajax');
Route::post('/scouters/deleteajax', 'Scouters\ScoutersController@deleteAjax')->name('deleteajax');

Route::get('/scouters/gioi-thieu', 'Scouters\ScoutersController@intro')->name('intro');
Route::get('/scouters/gioi-thieu/chi-tiet/{id}', 'Scouters\ScoutersController@introDetail');
Route::any('/scouters/search', 'Scouters\ScoutersController@search')->name('scouters/search');

Route::get('/scouters/bonus', 'Scouters\ScoutersController@bonus')->name('bonus');
Route::post('/viec-lam/chi-tiet/select', 'Jobs\JobsController@sendMailSeclectAjax')->name('viec-lam/select');
Route::post('/viec-lam/chi-tiet/add', 'Jobs\JobsController@addFriendSendMailAjax')->name('viec-lam/add');

//companies
$this->get('/companies', 'Companies\CompaniesController@index')->name('company'); 
Route::get('/companies/detail/{id}', 'Companies\CompaniesController@detail')->name('companies/detail');
$this->get('/companies/createjob', 'Companies\CompaniesController@postjob')->name('company.createjob');
$this->get('/companies/account', 'Companies\CompaniesController@company_account')->name('company.account');

$this->get('/companies/profile', 'Companies\CompaniesController@company_profile')->name('company.profile');
$this->get('/companies/quan-ly-scouters', 'Companies\ScoutersController@index')->name('scouterdetail');
// $this->get('/companies/quan-ly-scouters/chi-tiet', 'Companies\ScoutersController@details')->name('scouterdetail');

//companies/candidates
Route::get('/companies/danh-sach-ung-tuyen', 'Companies\CandidatesController@index')->name('candidateindex')->middleware('auth');
Route::post('/companies/updatenoteajax', 'Companies\CandidatesController@updateNoteAjax')->name('updatenoteajax');
Route::post('/companies/updatestatusajax', 'Companies\CandidatesController@updateStatusAjax')->name('updatestatusajax');
Route::post('/companies/deletecandidateajax', 'Companies\CandidatesController@deleteCandidateAjax')->name('deletecandidateajax');
Route::any('/companies/searchcandidate', 'Companies\CandidatesController@searchCandidate')->name('searchcandidate');

//companies/jobs
Route::get('/companies/danh-sach-viec-lam', 'Companies\JobsController@index')->name('jobindex')->middleware('auth');
Route::post('/companies/deletejobajax', 'Companies\JobsController@deleteJobAjax')->name('deletejobajax');
Route::post('/companies/deletemultijobajax', 'Companies\JobsController@deleteMultiJobAjax')->name('deletemultijobajax');
Route::any('/companies/jobsearch', 'Companies\JobsController@searchJob')->name('seachjobajax');

//companies/scouters 
Route::get('/companies/quan-ly-scouters', 'Companies\ScoutersController@index')->name('scouterindex');
Route::get('/companies/quan-ly-scouters/chi-tiet/{id}', 'Companies\ScoutersController@details')->name('companies/quan-ly-scouters/chi-tiet');

//company detail
Route::get('/companies/quan-ly-scouters/chi-tiet/{id}', 'Companies\ScoutersController@details')->name('companies/quan-ly-scouters/chi-tiet');
Route::any('/companies/searchscouter', 'Companies\ScoutersController@searchScouter')->name('searchscouter');
Route::post('/companies/updatebonusstatus', 'Companies\ScoutersController@updateBonusStatusAjax')->name('updatebonusstatus');

//region Jobs
Route::get('/jobs/detail/{id}', 'Jobs\JobsController@detail')->name('/jobs/detail'); 
});
//endregion
//endregion
//region Backend
/*
|--------------------------------------------------------------------------
| Backend
|--------------------------------------------------------------------------|
*/
$this->get('cms/login', 'Auth\LoginController@showLoginForm')->name('cms/login');
$this->post('dang-nhap', 'Auth\LoginController@login');
$this->post('logout', 'Auth\LoginController@logout')->name('logout');

$this->post('dang-ky', 'Auth\RegisterController@register');
//region Password Reset Routes...
$this->get('quen-mat-khau', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
$this->get('quen-mat-khau/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('quen-mat-khau', 'Auth\ResetPasswordController@reset');
$this->get('home/changePassword', 'HomeController@changePassword')->name('changePassword');
//Auth::routes();
//endregion

//company
$this->post('/companies/profile', 'Companies\CompaniesController@company_profile')->name('company.profile');
$this->put('/companies/profile', 'Companies\CompaniesController@company_profile')->name('company.profile');
$this->put('/companies/createjob', 'Companies\CompaniesController@postjob')->name('company.createjob');
$this->post('/companies/createjob', 'Companies\CompaniesController@postjob')->name('company.createjob');
$this->post('/companies/account', 'Companies\CompaniesController@company_account')->name('company.account');
//region CMS
/*
 *Manager Users admin
 */
Route::get('/cms/users', 'Cms\UsersController@index')->name('cms/users');
//Tạo user mới
Route::get('/cms/users/create', 'Cms\UsersController@create')->name('cms/users/create');
Route::post('/cms/users/store', 'Cms\UsersController@store')->name('cms/users/store');
//update user mới
Route::get('/cms/users/edit/{id}', 'Cms\UsersController@edit')->name('cms/user/edit');
Route::get('/cms/users/editScouter/{id}', 'Cms\UsersController@edit')->name('cms/user/editScouter');
Route::get('/cms/users/editCompanies/{id}', 'Cms\UsersController@edit')->name('cms/user/editCompanies');
Route::post('/cms/users/update', 'Cms\UsersController@update')->name('cms/user/update');
Route::post('/cms/users/updatepassword', 'Cms\UsersController@updatePassword')->name('cms/user/updatepassword');
Route::post('/cms/users/updateAccount', 'Cms\UsersController@updateAccount')->name('cms/user/updateAccount');
Route::get('/cms/users/listApplies/{id}', 'Cms\UsersController@listApplies')->name('cms/users/listApplies');
Route::get('/cms/users/export-file', 'Cms\UsersController@exportFile')->name('users.export.file');
//xem và xóa user
Route::get('/cms/users/thong-tin-ca-nhan/{id}', 'Cms\UsersController@show')->name('cms/users/thong-tin-ca-nhan');
Route::delete('/cms/users/destroy/{id}', 'Cms\UsersController@destroy')->name('cms/users/destroy');
//search user
Route::any('/cms/users/search', 'Cms\UsersController@search')->name('cms/user/search');
/**
 * Manager Jobs admin
 */
Route::get('/cms/jobs', 'Cms\JobsController@index')->name('cms/jobs');
Route::get('/cms/jobs/create', 'Cms\JobsController@create')->name('cms/jobs/create');
Route::post('/cms/jobs/store', 'Cms\JobsController@create')->name('cms/jobs/store');
Route::get('/cms/jobs/edit/{id}', 'Cms\JobsController@edit')->name('cms/jobs/edit');
Route::post('/cms/jobs/update', 'Cms\JobsController@update')->name('cms/jobs/update');
Route::delete('/cms/jobs/destroy/{id}', 'Cms\JobsController@destroy')->name('cms/jobs/destroy');
Route::get('/cms/jobs/export-file', 'Cms\JobsController@exportFile')->name('jobs.export.file');
Route::any('/cms/jobs/search', 'Cms\JobsController@search')->name('cms/jobs/search');
/**
 * Manager applies
 */
Route::get('/cms/applies', 'Cms\AppliesController@index')->name('cms/applies');
$this->get('/cms/applies/edit/{id}', 'Cms\AppliesController@edit')->name('cms/applies/edit');
Route::post('/cms/applies/update', 'Cms\AppliesController@update')->name('cms/applies/update');
Route::delete('/cms/applies/destroy/{id}', 'Cms\AppliesController@destroy')->name('cms/applies/destroy');
Route::any('/cms/applies/search', 'Cms\AppliesController@search')->name('cms/applies/search');
/**
 * Manager candidates
 */
Route::get('/cms/candidates', 'Cms\CandidatesController@index')->name('cms/candidates');
Route::delete('/cms/candidates/destroy/{id}', 'Cms\CandidatesController@destroy')->name('cms/candidates/destroy');
Route::get('/cms/candidates/export-file', 'Cms\CandidatesController@exportFile')->name('candidates.export.file');
Route::any('/cms/candidates/search', 'Cms\CandidatesController@search')->name('cms/candidates/search');
//endregion
//endregion
