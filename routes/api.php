<?php
use App\Http\Controllers\API\APIController;

Route::get('/media/list', [APIController::class, 'getMediaData']);
Route::post('/media/updatestats', [APIController::class, 'updatestats']);