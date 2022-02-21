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

Route::get('/', function () {
    return view('Home');
});

Route::view('/Home', 'home')->name('aHome');

//login
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('mShowLogin');
/*Route::post('/login', 'Auth\LoginController@login')->name('aShowLogin');
Route::get('/logout', 'Auth\LoginController@logout')->name('aShowLogout'); */

Route::get('/error', function () { {
        return view('error');
    }
})->name('aMostrarError');

Route::prefix('platforms')->group(function () {
    Route::match(['get', 'post'], '/', 'PlatformController@mList')->name('platforms.aList');
    //Route::get('/view/{id}', 'PlatformController@mView')->name('platforms.aShowOne');
    Route::get('/create', 'PlatformController@mCreate')->name('platforms.aCreate');
    Route::get('/{id}/edit', 'PlatformController@mShowForm')->name('platforms.aShowForm');

    Route::post('/store', 'PlatformController@mStore')->name('platforms.aStore');
    Route::post('/{platform}/update', 'PlatformController@mUpdate')->name('platforms.aUpdate');
    Route::delete('/{platform}/delete', 'PlatformController@mDelete')->name('platforms.aDelete');
});

Route::prefix('languages')->group(function () {
    Route::match(['get', 'post'], '/', 'LanguageController@mList')->name('languages.aList');
    //Route::get('/view/{id}', 'LanguageController@mView')->name('languages.aShowOne');
    Route::get('/create', 'LanguageController@mCreate')->name('languages.aCreate');
    Route::get('/{id}/edit', 'LanguageController@mShowForm')->name('languages.aShowForm');

    Route::post('/store', 'LanguageController@mStore')->name('languages.aStore');
    Route::post('/{language}/update', 'LanguageController@mUpdate')->name('languages.aUpdate');
    Route::delete('/{language}/delete', 'LanguageController@mDelete')->name('languages.aDelete');
});

Route::prefix('directors')->group(function () {
    Route::match(['get', 'post'], '/', 'DirectorController@mList')->name('directors.aList');
    Route::get('/{id}/view', 'DirectorController@mView')->name('directors.aShowOne');
    Route::get('/create', 'DirectorController@mCreate')->name('directors.aCreate');
    Route::get('/{id}/edit', 'DirectorController@mShowForm')->name('directors.aShowForm');

    Route::post('/store', 'DirectorController@mStore')->name('directors.aStore');
    Route::post('/{director}/update', 'DirectorController@mUpdate')->name('directors.aUpdate');
    Route::delete('/{director}/delete', 'DirectorController@mDelete')->name('directors.aDelete');
});

Route::prefix('actors')->group(function () {
    Route::match(['get', 'post'], '/', 'ActorController@mList')->name('actors.aList');
    Route::get('/{id}/view', 'ActorController@mView')->name('actors.aShowOne');
    Route::get('/create', 'ActorController@mCreate')->name('actors.aCreate');
    Route::get('/{id}/edit', 'ActorController@mShowForm')->name('actors.aShowForm');

    Route::post('/store', 'ActorController@mStore')->name('actors.aStore');
    Route::post('/{actor}/update', 'ActorController@mUpdate')->name('actors.aUpdate');
    Route::delete('/{actor}/delete', 'ActorController@mDelete')->name('actors.aDelete');
});

Route::prefix('series')->group(function () {
    Route::match(['get', 'post'], '/', 'SerieController@mList')->name('series.aList');
    Route::get('/{id}/view', 'SerieController@mView')->name('series.aShowOne');
    Route::get('/create', 'SerieController@mCreate')->name('series.aCreate');
    Route::match(['get', 'post','delete'], '/{id}/edit', 'SerieController@mShowForm')->name('series.aShowForm');

    Route::post('/store', 'SerieController@mStore')->name('series.aStore');
    Route::post('/{serie}/update', 'SerieController@mUpdate')->name('series.aUpdate');
    Route::delete('/{serie}/delete', 'SerieController@mDelete')->name('series.aDelete');

    /**Adicionales */
    Route::post('/addActor', 'SerieController@mAddActor')->name('series.aAddActor');
    Route::delete('/deleteActor', 'SerieController@mDeleteActor')->name('series.aDeleteActor');

    Route::post('/addLanguage', 'SerieController@mAddLanguage')->name('series.aAddLanguage');
    Route::delete('/deletelanguage', 'SerieController@mDeleteLanguage')->name('series.aDeleteLanguage');
});