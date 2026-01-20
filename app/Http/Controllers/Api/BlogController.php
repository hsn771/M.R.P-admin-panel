<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\JsonResponse;

class BlogController extends Controller
{
    /**
     * Get all blogs for the frontend
     */
    public function index(): JsonResponse
    {
        $blogs = Blog::orderBy('created_at', 'desc')
            ->get()
            ->map(function ($blog) {
                return [
                    'id' => $blog->id,
                    'title' => $blog->title,
                    'image' => $blog->image ? asset('storage/' . $blog->image) : null,
                    'description' => $blog->description,
                    'created_at' => $blog->created_at->toISOString(),
                    'updated_at' => $blog->updated_at->toISOString(),
                ];
            });

        return response()->json([
            'success' => true,
            'data' => $blogs,
        ]);
    }
}