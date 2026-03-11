<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Http\Request;
    use Illuminate\Support\Str;

class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $partners = Partner::with('user')->latest()->paginate(10);
        $data['partners'] = $partners;
        return view('admin.partners.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.partners.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'company_name' => 'required|string|max:255|unique:partners,company_name',
            'email' => 'required|email|unique:partners,email',
            'phone' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        Partner::create([
            'user_id' => auth()->id(),
            'company_name' => $request->company_name,
            'email' => $request->email,
            'description' => $request->description ?? '',
            'phone' => $request->phone,
            'address' => $request->address,
            'logo' => $request->logo,
        ]);

        return redirect()->route('admin.partners.index')->with('success', 'Partner created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $partner = Partner::with(['ads', 'user'])->findOrFail($id);
        $data['partner'] = $partner;
        return view('admin.partners.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $partner = Partner::findOrFail($id);
        $data['partner'] = $partner;
        return view('admin.partners.edit', $data);   
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'company_name' => 'required|string|max:255|unique:partners,company_name,',
            'email' => 'required|email|unique:partners,email,',
            'phone' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $partner = Partner::findOrFail($id);
        $partner->update([
            'company_name' => $request->company_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'logo' => $request->logo,
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
        $partner = Partner::findOrFail($id);

        if ($partner->ads()->exists()) {
            return redirect()->back()->with('error', 'The partner cannot be deleted because there are still related ads.');
        }

        $partner->delete();
        return redirect()->route('admin.categories.index')->with('success','Category deleted successfully');
    }
}
