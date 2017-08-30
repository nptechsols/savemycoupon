<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Route::get('/', function () {
//     return view('auth/login');
// });

Route::get('/', 'HomeController@user_redirect');

// Route::resource('/coupons',
// 				 ['middleware' => 'auth',  function () {
//     return view('CouponController');
// }]);

// Route::resource('/websites',['middleware' => 'auth', function () {
//     return view('WebsiteController');
// }]);

// Route::get('coupons', [
//     'middleware' => 'auth',
//     'uses' => 'CouponController'
// ]);

// Route::get('websites', [
//     'middleware' => 'auth',
//     'uses' => 'WebsiteController'
// ]);


Route::resource("/coupons","CouponController"); 

Route::resource("/websites","WebsiteController"); 

Route::auth();

Route::get('admin/profile', ['middleware' => 'admin', function () {  
    return view('CouponController@index');
}]);




Route::get('search',array('as'=>'search','uses'=>'SearchController@search'));
Route::get('autocomplete',array('as'=>'autocomplete','uses'=>'SearchController@autocomplete'));

// Route::get('/coupons', 'CouponController@index');
