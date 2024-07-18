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
        $comments = Comment::where('user_id', $userId)->get();
    
        $articles = $comments->filter(function ($comment) {
            return $comment->commentable_type == Article::class;
        })->pluck('commentable');
    
        $videos = $comments->filter(function ($comment) {
            return $comment->commentable_type == Video::class;
        })->pluck('commentable');
    
        $images = $comments->filter(function ($comment) {
            return $comment->commentable_type == Image::class;
        })->pluck('commentable');
    
        dd([
            'articles' => $articles,
            'videos' => $videos,
            'images' => $images,
        ]);
    }
    
    // Lấy danh sách các bài viết, video, và hình ảnh có đánh giá trung bình cao nhất
    public function getTopRatedContent()
    {
        $topRatedArticles = Article::with(['ratings' => function($query) {
            $query->select(DB::raw('rateable_id, AVG(rating) as average_rating'))
                  ->groupBy('rateable_id')
                  ->orderBy('average_rating', 'desc')
                  ->take(5);
        }])->get();
    
        $topRatedVideos = Video::with(['ratings' => function($query) {
            $query->select(DB::raw('rateable_id, AVG(rating) as average_rating'))
                  ->groupBy('rateable_id')
                  ->orderBy('average_rating', 'desc')
                  ->take(5);
        }])->get();
    
        $topRatedImages = Image::with(['ratings' => function($query) {
            $query->select(DB::raw('rateable_id, AVG(rating) as average_rating'))
                  ->groupBy('rateable_id')
                  ->orderBy('average_rating', 'desc')
                  ->take(5);
        }])->get();
    
        dd([
            'top_rated_articles' => $topRatedArticles,
            'top_rated_videos' => $topRatedVideos,
            'top_rated_images' => $topRatedImages,
        ]);
    }
}
