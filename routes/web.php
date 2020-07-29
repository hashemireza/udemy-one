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
    return view('welcome');
});

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');


Route::resource('questions', 'QuestionController');
// Route::post('questions/{question}/answers', 'AnswerController@store')->name('answer.store');
Route::resource('questions.answers', 'AnswerController')->except('index', 'show', 'create');
Route::post('answer/{answer}/accept', 'AcceptAnswerController')->name('answers.accept');
