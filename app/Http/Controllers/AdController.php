<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\Partner;
use Illuminate\Http\Request;

class AdController extends Controller
{
    /**
     * Display a listing of all ads.
     */
    public function index()
    {
        $ads = Ad::with('partner')->latest()->paginate(10);
        return view('admin.ads.index', compact('ads'));
    }

    /**
     * Show the form for creating a new ad.
     */
    public function create(Request $request)
    {
        $partners = Partner::all();
        $selectedPartnerId = $request->query('partner_id');
        return view('admin.ads.create', compact('partners', 'selectedPartnerId'));
    }

    /**
     * Store a newly created ad in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'partner_id' => 'required|exists:partners,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'url' => 'nullable|url',
            'position' => 'required|in:header,sidebar,footer',
            'status' => 'required|in:active,inactive,draft,pending',
        ]);

        $imagePath = $request->file('image')->store('ads', 'public');

        Ad::create([
            'partner_id' => $request->partner_id,
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imagePath,
            'url' => $request->url,
            'position' => $request->position,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.ads.index')->with('success', 'Ad created successfully!');
    }

    /**
     * Show the form for editing the specified ad.
     */
    public function edit($id)
    {
        $ad = Ad::findOrFail($id);
        $partners = Partner::all();
        return view('admin.ads.edit', compact('ad', 'partners'));
    }

    /**
     * Update the specified ad in storage.
     */
    public function update(Request $request, $id)
    {
        $ad = Ad::findOrFail($id);

        $request->validate([
            'partner_id' => 'required|exists:partners,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'url' => 'nullable|url',
            'position' => 'required|in:header,sidebar,footer',
            'status' => 'required|in:active,inactive,draft,pending',
        ]);

        $data = [
            'partner_id' => $request->partner_id,
            'title' => $request->title,
            'description' => $request->description,
            'url' => $request->url,
            'position' => $request->position,
            'status' => $request->status,
        ];

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('ads', 'public');
        }

        $ad->update($data);

        return redirect()->route('admin.ads.index')->with('success', 'Ad updated successfully!');
    }

    /**
     * Remove the specified ad from storage.
     */
    public function destroy($id)
    {
        $ad = Ad::findOrFail($id);
        $ad->delete();

        return redirect()->route('admin.ads.index')->with('success', 'Ad deleted successfully!');
    }
}
