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

Route::get('/', 'HomeController@index')->middleware('auth')->name('home');

Route::post('/contacto', 'ContactController@index')->name('contact_post');

Route::get('/buscar', 'SearchController@index')->middleware('auth')->name('search');

Route::get('/reuniones_de_ciclo', 'MeetingsController@index')->middleware('auth')->name('meetings');
Route::get('/reuniones_de_ciclo/descargar/{file_id}', 'MeetingsController@download_file')->middleware('auth')->name('meetings_download_file');
Route::get('/reuniones_de_ciclo/listar/{folder_id}', 'MeetingsController@get_folder_contents')->middleware('auth')->name('meetings_list_folder');
Route::post('reuniones_de_ciclo//compartir','MeetingsController@share')->middleware('auth')->name('share_file');




Route::get('/cursos', 'CoursesController@index')->middleware('auth')->name('courses');
Route::get('/cursos/{course_id}', 'CoursesController@getCourse')->middleware('auth')->name('course');
Route::get('/cursos/{course_id}/etapas/{course_stage_id}', 'CourseStagesController@getCourseStage')->middleware('auth')->name('course_stage');

Route::post('cursos/compartir','CoursesController@share')->middleware('auth')->name('share_course');

Route::get('/biblioteca', 'LibraryController@index')->middleware('auth')->name('library');
Route::get('/biblioteca/articulo/{post_id}', 'LibraryController@getPost')->middleware('auth')->name('library_post');
Route::post('biblioteca/articulo/share','LibraryController@share')->middleware('auth')->name('library.share');

Route::get('/categorias_producto', 'ProductCategoriesController@index')->middleware('auth')->name('product_categories');
Route::get('/categorias_producto/{product_category_id}', 'ProductCategoriesController@getCategory')->middleware('auth')->name('product_categories_detail');
Route::get('/categorias_producto/{product_category_id}/subcategorias/{product_subcategories_id}', 'ProductSubcategoriesController@getSubcategory')->middleware('auth')->name('product_subcategories_detail');

Route::get('/sitemap', 'SitemapController@index')->middleware('auth')->name('sitemap');

Route::post('producto/compartir','ProductCategoriesController@share')->middleware('auth')->name('share_product');


Route::post('/metricas', 'MetricController@send_metric')->name('metric_post');


Route::get('/reset/{token}', 'ResetPasswordController@show_reset_password_form')->name('reset_form');
Route::post('/reset/{token}', 'ResetPasswordController@reset_password')->name('reset_password');
Route::get('/recover', 'ResetPasswordController@index')->name('recover');
Route::post('/recover', 'ResetPasswordController@recover')->name('recover_post');

Route::get('/logout', 'AuthenticationController@logout')->name('logout');

Route::get('/login', 'AuthenticationController@index')->name('login');
Route::post('/login', 'AuthenticationController@authenticate')->name('login_post');

Route::get('/login/tac', 'AuthenticationController@tac')->name('tac');
Route::get('/login/tac_save', 'AuthenticationController@tac_save')->name('tac_save');

Route::get('/ping', 'PingController@index')->name('ping');


Route::resource('like','LikesController',['only' => [
    'store', 'destroy'
]]);

Route::resource('comment','CommentsController',['only' => [
    'store', 'destroy', 'index'
]]);


Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function(){
    Route::get('/', 'AuthenticationController@index');
    Route::get('/login', 'AuthenticationController@index')->name('admin_login');
    Route::post('/login', 'AuthenticationController@authenticate')->name('admin_login_post');

    Route::get('/dashboard', 'DashboardController@index')->name('admin_dashboard');

    /*
     * Admin Product Related Routes
     */
    Route::get('/productos', 'ProductsController@index')->name('admin_products');

    Route::get('/productos/add', 'ProductsController@add_form')->name('admin_products_add');
    Route::post('/productos/add', 'ProductsController@create_product')->name('admin_products_add_post');

    Route::get('/productos/edit/{product_id}', 'ProductsController@edit_form')->name('admin_products_edit');
    Route::post('/productos/edit/{product_id}', 'ProductsController@edit_product')->name('admin_products_edit_post');

    Route::delete('/products/delete/{product_id}', 'ProductsController@delete_product')->name('admin_products_delete');

    /*
     * Admin Questions Related Routes
     */
    Route::get('/preguntas', 'QuestionsController@index')->name('admin_questions');

    Route::get('/preguntas/add', 'QuestionsController@add_form')->name('admin_questions_add');
    Route::post('/preguntas/add', 'QuestionsController@create_question')->name('admin_questions_add_post');

    Route::get('/preguntas/edit/{question_id}', 'QuestionsController@edit_form')->name('admin_questions_edit');
    Route::post('/preguntas/edit/{question_id}', 'QuestionsController@edit_question')->name('admin_questions_edit_post');

    Route::delete('/preguntas/delete/{question_id}', 'QuestionsController@delete_question')->name('admin_questions_delete');

    /*
     * Admin Course Related Routes
     */
    Route::get('/cursos', 'CoursesController@index')->name('admin_courses');

    Route::get('/cursos/add', 'CoursesController@add_form')->name('admin_courses_add');
    Route::post('/cursos/add', 'CoursesController@create_course')->name('admin_courses_add_post');

    Route::get('/cursos/edit/{course_id}', 'CoursesController@edit_form')->name('admin_courses_edit');
    Route::post('/cursos/edit/{course_id}', 'CoursesController@edit_course')->name('admin_courses_edit_post');

    Route::delete('/cursos/delete/{course_id}', 'CoursesController@delete_course')->name('admin_courses_delete');

    /*
     * Admin Course Stages Related Routes
     */
    Route::get('/etapas_curso', 'CourseStagesController@index')->name('admin_course_stages');

    Route::get('/etapas_curso/add', 'CourseStagesController@add_form')->name('admin_course_stages_add');
    Route::post('/etapas_curso/add', 'CourseStagesController@create_course_stage')->name('admin_course_stages_add_post');

    Route::get('/etapas_curso/edit/{course_stage_id}', 'CourseStagesController@edit_form')->name('admin_course_stages_edit');
    Route::post('/etapas_curso/edit/{course_stage_id}', 'CourseStagesController@edit_course_stage')->name('admin_course_stages_edit_post');

    Route::delete('/etapas_curso/delete/{course_stage_id}', 'CourseStagesController@delete_course_stage')->name('admin_course_stages_delete');

    Route::get('/contacto', 'ContactController@index')->name('admin_contact_edit');
    Route::post('/contacto', 'ContactController@edit_contact')->name('admin_contact_edit_post');

    Route::get('/notificaciones', 'NotificationConfigurationsController@index')->name('admin_notification_configuration_edit');
    Route::post('/notificaciones', 'NotificationConfigurationsController@edit_configurations')->name('admin_notification_configuration_edit_post');


    Route::get('/novedad', 'NewsController@index')->name('admin_news_edit');
    Route::post('/novedad', 'NewsController@edit_news')->name('admin_news_edit_post');


    /*
     * Meetings Relates Routes
     */

    //admin_meetings_categories_list
    Route::get('/reuniones_de_ciclo/categorias', 'MeetingsController@index')->name('admin_meetings_categories_list');
    Route::post('/reuniones_de_ciclo/categorias', 'MeetingsController@create_category')->name('admin_meetings_categories_post');
    Route::delete('/reuniones_de_ciclo/categorias/{category_folder_id}', 'MeetingsController@delete_category')->name('admin_meetings_categories_delete');
    Route::put('/reuniones_de_ciclo/categorias/{category_folder_id}', 'MeetingsController@edit_category')->name('admin_meetings_categories_edit');

    Route::delete('/reuniones_de_ciclo/carpetas/{folder_id}', 'MeetingsController@delete_folder')->name('admin_meetings_folder_delete');
    Route::post('/reuniones_de_ciclo/carpetas', 'MeetingsController@create_folder')->name('admin_meetings_folder_post');
    Route::put('/reuniones_de_ciclo/carpetas/{folder_id}', 'MeetingsController@edit_folder')->name('admin_meetings_folder_edit');

    Route::get('/reuniones_de_ciclo/carpetas', 'MeetingsController@get_contents')->name('admin_meetings_get_folder_contents');
    Route::delete('/reuniones_de_ciclo/archivos/{file_id}', 'MeetingsController@delete_file')->name('admin_meetings_file_delete');
    Route::post('/reuniones_de_ciclo/archivos', 'MeetingsController@create_file')->name('admin_meetings_file_post');



    /*
     * Admin Text Related Routes
     */
    Route::get('/textos', 'TextsController@index')->name('admin_texts');
    Route::get('/textos/edit/{text_id}', 'TextsController@edit_form')->name('admin_texts_edit');
    Route::post('/textos/edit/{text_id}', 'TextsController@edit_text')->name('admin_texts_edit_post');


    /*
     * Admin Product Category Related Routes
     */
    Route::get('/categorias_producto', 'ProductCategoriesController@index')->name('admin_product_categories');

    Route::get('/categorias_producto/add', 'ProductCategoriesController@add_form')->name('admin_product_categories_add');
    Route::post('/categorias_producto/add', 'ProductCategoriesController@create_category')->name('admin_product_categories_add_post');

    Route::get('/categorias_producto/edit/{product_category_id}', 'ProductCategoriesController@edit_form')->name('admin_product_categories_edit');
    Route::post('/categorias_producto/edit/{product_category_id}', 'ProductCategoriesController@edit_category')->name('admin_product_categories_edit_post');

    Route::delete('/categorias_producto/delete/{product_category_id}', 'ProductCategoriesController@delete_category')->name('admin_product_categories_delete');







    /*
     * Admin Product SubCategory Related Routes
     */
    Route::get('/subcategorias_producto', 'ProductSubcategoriesController@index')->name('admin_product_subcategories');

    Route::get('/subcategorias_producto/add', 'ProductSubcategoriesController@add_form')->name('admin_product_subcategories_add');
    Route::post('/subcategorias_producto/add', 'ProductSubcategoriesController@create_subcategory')->name('admin_product_subcategories_add_post');

    Route::get('/subcategorias_producto/edit/{product_category_id}', 'ProductSubcategoriesController@edit_form')->name('admin_product_subcategories_edit');
    Route::post('/subcategorias_producto/edit/{product_category_id}', 'ProductSubcategoriesController@edit_subcategory')->name('admin_product_subcategories_edit_post');

    Route::delete('/subcategorias_producto/delete/{product_category_id}', 'ProductSubcategoriesController@delete_subcategory')->name('admin_product_subcategories_delete');

    Route::get('/subcategorias_producto/json', 'ProductSubcategoriesController@get_subcategories_from_category')->name('admin_product_subcategories_get_json');


    Route::resource('events', 'EventsController');

    Route::resource('posts', 'PostsController');

    Route::resource('users', 'UserController');

});