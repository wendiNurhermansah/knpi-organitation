<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ArticleController extends Controller
{
    /**
     * Display a listing of articles.
     */
    public function index(Request $request): View
    {
        $status = $request->get('status');
        $search = $request->get('q');
        $category = $request->get('category_id');

        $query = Article::with(['category', 'author']);

        if (!empty($status)) {
            $query->where('status', $status);
        }

        if (!empty($category)) {
            $query->where('category_id', $category);
        }

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('summary', 'like', "%{$search}%");
            });
        }

        $articles = $query->latest()->paginate(10)->withQueryString();
        $categories = Category::all();

        return view('admin.articles.index', [
            'articles' => $articles,
            'categories' => $categories,
            'currentStatus' => $status,
            'currentCategory' => $category,
            'search' => $search,
        ]);
    }

    /**
     * Show form for creating a new article.
     */
    public function create(): View
    {
        $categories = Category::all();
        return view('admin.articles.create', compact('categories'));
    }

    /**
     * Store a newly created article.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'title' => ['required', 'string', 'max:255'],
            'summary' => ['required', 'string'],
            'content' => ['required', 'string'],
            'thumbnail' => ['nullable', 'image', 'max:4096'],
            'status' => ['required', 'in:draft,published,archived'],
        ]);

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        $validated['user_id'] = auth()->id() ?? 1;
        $validated['slug'] = Str::slug($validated['title']) . '-' . Str::random(5);
        if ($validated['status'] === 'published') {
            $validated['published_at'] = now();
        }

        Article::create($validated);

        return redirect()->route('admin.berita.index')
            ->with('success', 'Artikel berita kepemudaan berhasil diterbitkan.');
    }

    /**
     * Show the form for editing an article.
     */
    public function edit(Article $article): View
    {
        $categories = Category::all();
        return view('admin.articles.edit', compact('article', 'categories'));
    }

    /**
     * Update the specified article.
     */
    public function update(Request $request, Article $article): RedirectResponse
    {
        $validated = $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'title' => ['required', 'string', 'max:255'],
            'summary' => ['required', 'string'],
            'content' => ['required', 'string'],
            'thumbnail' => ['nullable', 'image', 'max:4096'],
            'status' => ['required', 'in:draft,published,archived'],
        ]);

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        if ($validated['status'] === 'published' && !$article->published_at) {
            $validated['published_at'] = now();
        }

        $article->update($validated);

        return redirect()->route('admin.berita.index')
            ->with('success', 'Artikel berita berhasil diperbarui.');
    }

    /**
     * Remove the specified article.
     */
    public function destroy(Article $article): RedirectResponse
    {
        $title = $article->title;
        $article->delete();

        return redirect()->route('admin.berita.index')
            ->with('success', "Artikel '{$title}' berhasil dihapus.");
    }
}
