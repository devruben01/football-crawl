<?php

use App\Http\Controllers\Api\GetCategoryList;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::group([
    'prefix' => 'v1',
    'as' => 'v1.',
], function () {
    Route::get('/category-list', GetCategoryList::class);
});

Route::fallback(function () {
    return 'Hm, the routing is wrong, you idiot';
});
