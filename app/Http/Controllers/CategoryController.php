<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
    use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::latest()->paginate(10);
        $data['categories'] = $categories;
        return view('categories.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            
        ]);

        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'category created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $data['category'] = $category;
        return view('admin.categories.edit', $data);   
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,',
        ]);

        $category = Category::findOrFail($id);
        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(Category $category)
    // {
    // }

    public function destroy($id) {
        $category = Category::findOrFail($id);

        if ($category->article()->exists()) {
            return redirect()->back()->with('error', 'The category cannot be deleted because there are still related articles.');
        }

        $category->delete();
        return redirect()->route('admin.categories.index')->with('success','Category deleted successfully');
    }
}
