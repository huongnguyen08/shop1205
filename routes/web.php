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
Route::get('/',[
	'as' => 'trangchu',
	'uses' => 'PageController@getIndex'
]);


// Route::get('menu',[
// 	'as' => 'menu',
// 	'uses' => 'PageController@getMenu'
// ]);

Route::get('food-type',[
	'as' => 'food-type',
	'uses' => 'PageController@getFoodByType'
]);

Route::get('load-food-by-type/{id_type}',[
	'as' => 'ajax-load-food-by-type',
	'uses' => 'PageController@ajaxGetFoodByType'
]);

Route::get('ajax-paginator',[
	'as' => 'ajax-paginator',
	'uses' => 'PageController@ajaxGetProductPagination'
]);

Route::get('search',[
	'as' => 'search',
	'uses' => 'PageController@getSearch'
]);


Route::get('cart',[
	'as' => 'cart',
	'uses' => 'PageController@getCart'
]);

Route::get('get-product',[
	'as' => 'getProductPagination',
	'uses' => 'PageController@getProductPagination'
]);

Route::get('menu-detail/{id?}',[
	'as' => 'menu-detail',
	'uses' => 'PageController@getDetailMenu'
]);