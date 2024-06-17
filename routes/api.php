<?php

use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::group([
    'prefix' => 'v1',
    'as' => 'v1.',
], function () {
});

Route::fallback(function () {
    return 'Hm, the routing is wrong, you idiot';
});
