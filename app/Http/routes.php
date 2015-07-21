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

//Route::get('/', 'Enterphace\EnterphaceController@index');
//Route::get('/', 'FlatTemplate\FlatTemplateController@flatadmincms');
//Route::get('home', 'HomeController@index');

// for Chimporter
//Route::get('/', 'Chimporter\ChimporterController@welcome');
Route::get('/', 'HomeController@index');
Route::get('home', 'HomeController@index');


/*
|--------------------------------------------------------------------------
| Csv To MySql - Application Routes
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'csvtomysql'], function()
{
	Route::get('/','Chimporter\CsvToMysqlImportController@index');
	Route::post('addfile', ['as' => 'addCsvFile', 'uses' => 'Chimporter\CsvToMysqlImportController@addFile']);
	
	Route::get('mapper', 'Chimporter\CsvToMysqlImportController@mapColumns');
	Route::post('paircolumns', ['as' => 'pairCsvRowsTableColumns', 'uses' => 'Chimporter\CsvToMysqlImportController@pairColumns']);
	
	Route::get('importdata', 'Chimporter\CsvToMysqlImportController@importDataTable');
	Route::post('readytoimportdata', ['as' => 'dataImportToDatabase', 'uses' => 'Chimporter\CsvToMysqlImportController@importData']);
    	
	/*Route::get('list', function()
    	{
        	// Matches The "/csvtomysql/list" URL
    	});*/
});
/*Route::get('csvtomysql','Chimporter\CsvToMysqlController@index');
Route::post('csvtomysql/addfile', ['as' => 'addCsvFile', 'uses' => 'Chimporter\CsvToMysqlController@addFile']);
//Route::get('csvtomysql/pairColumns', 'Chimporter\CsvToMysqlController@pairColumns');
Route::post('csvtomysql/paircolumns', ['as' => 'pairCsvRowsTableColumns', 'uses' => 'Chimporter\CsvToMysqlController@pairColumns']);
Route::post('csvtomysql/importdata', ['as' => 'dataImportToDatabase', 'uses' => 'Chimporter\CsvToMysqlController@importData']);*/

//Route::get('flatadmincms','FlatTemplate\FlatTemplateController@flatadmincms');





Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
