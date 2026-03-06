<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;
use App\Models\Tag;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::latest()->with('user', 'category')->paginate(10);
        return view('articles.index', compact('articles'));
    }

    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all(); 
        $tags = Tag::all();

        return view('admin.articles.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id',
            'tags' => 'array',
            'tags.*' => 'exists:tags,id',
            'featured_image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048', 
        ]);

        $path = null;
        if ($request->hasFile('featured_image')) {
            $path = $request->file('featured_image')->store('articles', 'public');
        }

        $article = Article::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'category_id' => $request->category_id,
            'user_id' => Auth::id(), 
            'featured_image' => $path,
        ]);

        if ($request->has('tags')) {
            $article->tags()->attach($request->tags);
        }

        return redirect()->route('admin.articles.index')->with('success', 'Article published!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        $categories = \App\Models\Category::all();
        $tags = \App\Models\Tag::all();
        $articleTags = $article->tags->pluck('id')->toArray(); 
        
        return view('admin.articles.edit', compact('article', 'categories', 'tags', 'articleTags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $data = [
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'category_id' => $request->category_id,
        ];

        if ($request->hasFile('image')) {
            // Hapus file lama jika ada dan bukan dari seeder (bukan link http)
            if ($article->featured_image && !Str::startsWith($article->featured_image, 'http')) {
                Storage::disk('public')->delete($article->featured_image);
            }

            $data['featured_image'] = $request->file('image')->store('articles', 'public');
        }

        $article->update($data);
        $article->tags()->sync($request->tags);

        return redirect()->route('admin.articles.index')->with('success', 'Article updated!');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        $article->delete();
        return back()->with('success', 'article deleted successfully!');
    }


}
