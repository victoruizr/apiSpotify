<?php

use App\Http\Controllers\AuthControllerUsers;
use Illuminate\Support\Facades\Route;

Route::post("/registerUser",[AuthControllerUsers::class,'registerUser']);
