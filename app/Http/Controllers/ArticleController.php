<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ArticleController extends Controller
{
    /**
     * Display a listing of published news articles.
     */
    public function index(Request $request): View
    {
        $categorySlug = $request->get('kategori');
        $search = $request->get('q');

        $query = Article::with(['category', 'author'])
            ->where('status', 'published');

        if (!empty($categorySlug)) {
            $query->whereHas('category', function ($q) use ($categorySlug) {
                $q->where('slug', $categorySlug);
            });
        }

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('summary', 'like', "%{$search}%");
            });
        }

        $articles = $query->latest('published_at')->paginate(9)->withQueryString();
        $categories = Category::withCount(['articles' => function ($q) {
            $q->where('status', 'published');
        }])->get();

        return view('articles.index', compact('articles', 'categories', 'categorySlug', 'search'));
    }

    /**
     * Display the specified news article.
     */
    public function show(string $slug): View
    {
        $article = Article::with(['category', 'author'])
            ->where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        // Increment views count safely
        $article->increment('views_count');

        // Related articles
        $relatedArticles = Article::with('category')
            ->where('category_id', $article->category_id)
            ->where('id', '!=', $article->id)
            ->where('status', 'published')
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('articles.show', compact('article', 'relatedArticles'));
    }
}
