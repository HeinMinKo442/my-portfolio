<?php

use App\Http\Controllers\Api\ContactInfoController;
use App\Http\Controllers\Api\PortfolioController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\SkillController;
use Illuminate\Support\Facades\Route;

Route::get('/portfolio', [PortfolioController::class, 'show']);

Route::apiResource('profiles', ProfileController::class);
Route::apiResource('projects', ProjectController::class);
Route::apiResource('skills', SkillController::class);
Route::apiResource('contact-info', ContactInfoController::class);
