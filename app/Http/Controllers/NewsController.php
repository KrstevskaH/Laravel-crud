<?php

namespace App\Http\Controllers;
use Illuminate\Http\JsonResponse;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::latest()->paginate(10);
        return view('news.index', compact('news'));
    }

    public function create()
    {
        return view('news.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'details' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'in:active,inactive',
        ]);

        $imageName = $request->file('image')->getClientOriginalName();
        $request->file('image')->storeAs('public/news', $imageName);

        News::create([
            'title' => $request->input('title'),
            'details' => $request->input('details'),
            'image' => $imageName,
            'status' => $request->input('status', 'active'),
        ]);

        return redirect()->route('news.index')->with('success', 'News created successfully.');
    }

    public function edit(News $news): View
    {
        return view('news.edit', compact('news'));
    }

    public function update(Request $request, News $news): RedirectResponse
    {
        $request->validate([
            'title' => 'required',
            'details' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'in:active,inactive',
        ]);

        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($news->image) {
                Storage::delete('public/news/' . $news->image);
            }

            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();

            // Store the new image in the 'public' disk
            $image->storeAs('public/news', $imageName);

            // Update the news with the new image name
            $news->update([
                'title' => $request->input('title'),
                'details' => $request->input('details'),
                'image' => $imageName,
                'status' => $request->input('status'),
            ]);

            return redirect()->route('news.index')->with('success', 'News updated successfully with a new image.');
        }

        // No new image uploaded, update other fields without touching the image
        $news->update([
            'title' => $request->input('title'),
            'details' => $request->input('details'),
            'status' => $request->input('status'),
        ]);

        return redirect()->route('news.index')->with('success', 'News updated successfully without changing the image.');
    }

    public function destroy(News $news): RedirectResponse
    {
        // Delete the news image if it exists
        if ($news->image) {
            $imagePath = public_path('storage/news/' . $news->image);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }

        // Delete the news
        $news->delete();

        return redirect()->route('news.index')->with('success', 'News deleted successfully');
    }


  



public function filter(Request $request): JsonResponse
{
    $status = $request->input('status', 'all');
    logger("Received status: $status");

    $news = ($status === 'all') ? News::all() : News::where('status', $status)->get();

    return response()->json($news);
}
}
