<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Prouct;
use App\Models\Salle;
use App\Models\Reservation;

use App\Http\Controllers\ProductController;

use App\Http\Controllers\AuthController;

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true");
header("Content-type:application/json;charset=utf-8"); 
header("Access-Control-Allow-Methods: GET");
Route::get('/demo-url',  function  (Request $request)  {
  return response()->json(['Laravel 8 CORS Demo']);
});
header("Access-Control-Allow-Headers: Access-Control-Allow-Origin, Accept");
Route::post('/products','App\Http\Controllers\ProductController@store');
Route::post('/register','App\Http\Controllers\AuthController@register');
Route::post('/login','App\Http\Controllers\AuthController@login');
Route::get('/getUsers','App\Http\Controllers\AuthController@getUsers');
Route::delete('/delete/{id}','App\Http\Controllers\AuthController@delete');
Route::post('/addsalle','App\Http\Controllers\SalleController@addsalle');
Route::post('/addMaterial','App\Http\Controllers\MaterialController@addMaterial');
Route::delete('/deleteMateria/{id}','App\Http\Controllers\MaterialController@deleteMaterial');
Route::get('/getMaterial','App\Http\Controllers\MaterialController@getMaterial');
Route::get('/admn','App\Http\Controllers\AuthController@admn');
Route::post('salle/add', 'App\Http\Controllers\SalleController@store');
Route::put('salle/{id}','App\Http\Controllers\SalleController@update');
Route::delete('salle/{id}','App\Http\Controllers\SalleController@delete');
Route::post('searchData', 'App\Http\Controllers\SalleController@searchData'
);
Route::post('reservation/add', 'App\Http\Controllers\ReservationController@store');
Route::post('example', 'App\Http\Controllers\ReservationController@example');
Route::put('reservation/{id}','App\Http\Controllers\ReservationController@update');
Route::delete('reservation/{id}','App\Http\Controllers\ReservationController@delete');
Route::get('findList/{id}','App\Http\Controllers\ReservationController@findList');
Route::get('getReservations','App\Http\Controllers\ReservationController@getReservations');
Route::get('getParticular','App\Http\Controllers\ReservationController@getParticulars');
Route::get('findlist','App\Http\Controllers\ReservationController@findAllData');

// Route::get('getBySearch/{id}/{date}/{time}', function($id,$date,$time){
//   // $booking=Reservation::where('id_classroom',$id)
//   // ->whereBetween('date',[$check_in,$check_out])
//   // ->get();
//   $booking=Reservation::where('id_classroom',$id)
//             ->where('date','=',$date)
//             ->where('time','=',$time)
//             ->pluck('id_classroom')->all();
//  // $res = Reservation::where('date','=',$date)->pluck('id_classroom')->all();
//   //$res = Reservation::pluck('id_classroom')->where('time','=','5:41 A');
//   //$times= Reservation::where('date', '=',$date)->first();
//   $salle = Salle::whereNotIn('id', $booking)->get();
//  return $salle;
//   // if($booking){
//   //   return response()->json(['message'=>'salle exists'],200);  }
//   // else  return response()->json(['message'=>'salle not found'],404); ;
// }
//);

Route::post('material_reservation/add', 'App\Http\Controllers\MaterialReservationController@store');
Route::put('material_reservation/{id}','App\Http\Controllers\MaterialReservationController@update');
Route::delete('material_reservation/{id}','App\Http\Controllers\MaterialReservationController@delete');
Route::get('findMaterial/{id}','App\Http\Controllers\MaterialReservationController@findList');
Route::get('getAllReservations','App\Http\Controllers\MaterialReservationController@getReservations');
Route::get('salle',function(){return Salle::All();});
Route::get('salle/{id}',function($id){return Salle::find($id);});
Route::put('/updateuser/{id}','App\Http\Controllers\AuthController@update');

//protected routes : functions that needs auth
Route::group(['middleware'=>['auth:sanctum']] , function(){
    Route::post('/logout','App\Http\Controllers\AuthController@logout');
    Route::post('/destroy','App\Http\Controllers\AuthController@destroy');
});
  
