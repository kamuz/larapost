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

Route::get('/', 'PagesController@index');
Route::get('/about', 'PagesController@about');
Route::get('/services', 'PagesController@services');
Route::resource('posts', 'PostsController');
Auth::routes();

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

Route::get('/contact', 'PagesController@contact');
Route::post('/contact', 'PagesController@email')->name('contact.email');

Route::get('/test-email', function () {
    \Illuminate\Support\Facades\Mail::raw('Test email content', function ($message) {
        $message->to('your-email@example.com')
                ->subject('Test Email');
    });

    return 'Email sent';
});
