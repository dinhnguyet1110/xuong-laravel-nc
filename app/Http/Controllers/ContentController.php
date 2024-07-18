<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Video;
use App\Models\Image;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContentController extends Controller
{
    // Lấy tất cả các bình luận của một bài viết cụ thể
    public function getArticleComments($articleId)
    {
        $article = Article::find($articleId);
        $comments = $article->comments;
        dd($comments);

    }

    // Lấy tất cả các đánh giá của một video cụ thể
    public function getVideoRatings($videoId)
    {
        $video = Video::find($videoId);
        $ratings = $video->ratings;
        dd($ratings);

    }

    // Lấy tất cả các bình luận của một người dùng cụ thể
    public function getUserComments($userId)
    {
        $comments = Comment::where('user_id', $userId)->get();
        dd($comments);
    }

    // Lấy trung bình đánh giá của một bài viết cụ thể
    public function getArticleAverageRating($articleId)
    {
        $article = Article::find($articleId);
        $averageRating = $article->ratings()->avg('rating');
        dd($averageRating);
    }

    // Lấy tất cả các bài viết, video, và hình ảnh được bình luận bởi một người dùng cụ thể
    public function getUserCommentedContent($userId)
    {
       
    }
    
    // Lấy danh sách các bài viết, video, và hình ảnh có đánh giá trung bình cao nhất
    public function getTopRatedContent()
    {
      
    }
}
