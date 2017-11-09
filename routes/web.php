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

Auth::routes();

Route::get('/', [
    'uses' => 'UserController@index',
    'as' => 'user',
    'name' => 'user'
]);

Route::get('/compaign', [
    'uses' => 'CompaignController@index',
    'as' => 'compaign',
    'name' => 'compaign'
]);

Route::get('campaign/create', [
    'uses' => 'CompaignController@create',
    'as' => 'campaign.create'
]);

Route::post('user/voucher-generate', [
    'uses' => 'UserController@generateVoucher',
    'as' => 'voucher.generate'
]);

Route::post('compaign', [
    'uses' => 'CompaignController@store',
    'as' => 'campaign.store'
]);

Route::post('invite-client', [
    'uses' => 'UserController@inviteClient',
    'as' => 'user.invite-client'
]);

