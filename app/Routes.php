<?php
/**
 * Routes - all standard Routes are defined here.
 *
 * @author David Carr - dave@daveismyname.com
 * @author Virgil-Adrian Teaca - virgil@giulianaeassociati.com
 * @version 3.0
 */


/** Define static routes. */

// The default Routing
Route::get('/',       'Main@index');
Route::get('subpage', 'Welcome@subPage');
Route::get('search', 'Welcome@search');
Route::get('about/dmca', 'Welcome@Dmca');
Route::get('about', 'Welcome@About');
Route::get('about/terms', 'Welcome@Terms');
Route::get('contact', 'Welcome@Contact');
Route::post('contact/send', 'Welcome@contactMsg');//array('before' => 'auth|csrf', 'uses' => 'Roles@store')
Route::get('videos', 'Welcome@Videos');
Route::get('music', 'Welcome@Music');

Route::get('add', 'Content@index');
Route::get( 'add/audio', array('before' => 'auth', 'uses' => 'Content@addAudio'));
Route::post( 'add/store', array('before' => 'auth', 'uses' => 'Content@store'));
Route::post( 'add/update', array('before' => 'auth', 'uses' => 'Content@UpdateFileContent'));
Route::post( 'add/updateinline', array('before' => 'auth', 'uses' => 'Content@UpdateFile'));
Route::post( 'add/updatevideoimg', array('before' => 'auth', 'uses' => 'Content@Updatevideoimg'));
Route::post( 'add/comment', array('before' => 'auth', 'uses' => 'Content@addComment'));
Route::post( 'add/deletecomment', array('before' => 'auth', 'uses' => 'Content@deleteComment'));
Route::any( 'add/video', array('before' => 'auth', 'uses' => 'Content@addVideo'));
Route::get('edit/{type}/{title}', array('before' => 'auth', 'uses' => 'Content@Editfile'));
Route::post('add/delete', array('before' => 'auth', 'uses' => 'Content@delete'));


Route::get('upgrade',  array('before' => 'auth', 'uses' => 'Upgrade@Upgrade'));
Route::get('successcheckout',  array('before' => 'auth', 'uses' => 'Upgrade@successCheckout'));
Route::get('failedcheckout',  array('before' => 'auth', 'uses' => 'Upgrade@failedCheckout'));
Route::post('paypal_ipn', 'Upgrade@my_ipn');

Route::get('video/{title}', 'Content@video');
Route::get('audio/{title}', 'Content@audio');
Route::get('sitemap.xml', 'Welcome@siteMap');


Route::any('download/file/{fileid}', 'Content@file');
Route::any('play/file/{fileid}/.file', 'Content@playfile');

/** End default Routes */
