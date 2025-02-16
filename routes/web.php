<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContentController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {

    return view('welcome');
});


Route::get('articles/{articleId}/comments', [ContentController::class, 'getArticleComments']);
Route::get('videos/{videoId}/ratings', [ContentController::class, 'getVideoRatings']);
Route::get('users/{userId}/comments', [ContentController::class, 'getUserComments']);
Route::get('articles/{articleId}/average-rating', [ContentController::class, 'getArticleAverageRating']);
Route::get('users/{userId}/commented-content', [ContentController::class, 'getUserCommentedContent']);
Route::get('top-rated-content', [ContentController::class, 'getTopRatedContent']);



