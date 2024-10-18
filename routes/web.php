<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Models\User;


Route::get('/', function () {
    
    return view('register');
});

Route :: get('/home',function(){
    $users = User :: all(); 
    return view('home',['users'=> $users]);
});


Route ::post('/register',[UserController::class,'register']);
Route::put('/editUser/{user}', [UserController::class, 'editUser']);
Route::delete('/delete-user/{user}', [UserController::class, 'deleteUser']);
Route::get('/estados', [UserController::class, 'getStates']);
Route::get('/estados/{id}/cidades', [UserController::class, 'getCities']);