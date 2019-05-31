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

Route::get('/', 'FrontpageController@index');
Route::get('/rss', 'FrontpageController@rss');
Route::get('อ่าน/{category}/{slug}', 'FrontpageController@article');
Route::get('ข่าวทั้งหมด', 'FrontpageController@articles');
Route::get('หมวดหมู่/{slug}', 'FrontpageController@categories');
Route::get('ป้ายข้อความ/{slug}', 'FrontpageController@tags');
Route::get('กิจกรรมทั้งหมด', 'FrontpageController@events');
Route::get('กิจกรรม/{slug}', 'FrontpageController@event');
Route::get('กลุ่มบริหารงาน/{slug}', 'FrontpageController@departments');
Route::get('กลุ่มสาระการเรียนรู้/{slug}', 'FrontpageController@courses');
Route::get('บุคลากร/{slug}', 'FrontpageController@personnel');
Route::get('ภาพกิจกรรมทั้งหมด/', 'FrontpageController@galleries');
Route::get('ภาพกิจกรรม/{slug}', 'FrontpageController@gallery');
Route::get('ดาวน์โหลด/{slug}', 'FrontpageController@document');
Route::get('ไฟล์เอกสารทั้งหมด', 'FrontpageController@documents');
Route::get('งานวิจัย/{slug}', 'FrontpageController@research');
Route::get('งานวิจัยทั้งหมด', 'FrontpageController@researches');
Route::get('รางวัล/{slug}', 'FrontpageController@award');
Route::get('ไฟล์/{slug}', function ($slug) {
    $file = App\File::where('slug', $slug)->firstOrFail();
    $file->increment('view');
    $file = 'documents/files/'.$file->file;
    $name = basename($file);
    return response()->download($file, $name);
});
Route::get('เกียรติประวัติ', 'FrontpageController@portfolios');
Route::get('ติดต่อเรา', 'ContactController@create');
Route::post('ติดต่อเรา', 'ContactController@store');

Auth::routes(['verify' => true, 'register' => false, 'login' => false]);
Route::get('dashboard', 'DashboardController@index')->name('dashboard');
Route::resource('dashboard/profile', 'ProfileController');
Route::resource('dashboard/password', 'PasswordController');
Route::resource('dashboard/user', 'UserController');
Route::resource('dashboard/category', 'CategoryController');
Route::resource('dashboard/article', 'ArticleController');
Route::resource('dashboard/tag', 'TagController');
Route::resource('dashboard/highlight', 'HighlightController');
Route::resource('dashboard/guidance', 'GuidanceController');
Route::resource('dashboard/document', 'DocumentController');
Route::resource('dashboard/file', 'FileController');
Route::resource('dashboard/gallery', 'GalleryController');
Route::resource('dashboard/picture', 'PictureController');
Route::resource('dashboard/event', 'EventController');
Route::resource('dashboard/department', 'DepartmentController');
Route::resource('dashboard/course', 'CourseController');
Route::resource('dashboard/personnel', 'PersonnelController');
Route::resource('dashboard/portfolio', 'PortfolioController');
Route::resource('dashboard/award', 'AwardController');
Route::resource('dashboard/research', 'ResearchController');
Route::resource('dashboard/message', 'MessageController');
Route::resource('dashboard/counter', 'CounterController');
Route::resource('dashboard/link', 'LinkController');
Route::resource('dashboard/contact', 'ContactController');
Route::resource('dashboard/reply', 'ReplyController');
Route::resource('dashboard/role', 'RoleController');

