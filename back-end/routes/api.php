<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PersonalProfileController;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix("auth")->group(function(){
    Route::post("/sendVerifyCode",[AuthController::class,"sendVerificationCode"]);
    Route::post("/verifyCode",[AuthController::class,"checkVerificationCode"]);
    Route::post("/login",[AuthController::class,"login"]);
    Route::post("/forgotPassword",[AuthController::class,"forgotPassword"]);
    Route::post("/resetPassword",[AuthController::class,"resetPassword"]);
});

Route::prefix("profile")->group(function(){
    Route::post("/editProfile",[PersonalProfileController::class,"editProfile"]);
});