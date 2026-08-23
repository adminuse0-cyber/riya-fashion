<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGalleryItemRequest;
use App\Http\Requests\UpdateGalleryItemRequest;
use App\Models\GalleryItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class GalleryController extends Controller
{
    /**
     * Display a listing of all saree work and workshop gallery photographs.
     */
    public function index(Request $request): View
    {
        $selectedCategory = $request->query('category');
        $query = GalleryItem::query();

        if (!empty($selectedCategory) && $selectedCategory !== 'All') {
            $query->where('category', $selectedCategory);
        }

        $items = $query->orderBy('display_order')->orderByDesc('id')->get();
        $categories = GalleryItem::CATEGORIES;

        return view('admin.gallery.index', compact('items', 'categories', 'selectedCategory'));
    }

    /**
     * Show the form for uploading a new gallery photograph.
     */
    public function create(): View
    {
        $categories = GalleryItem::CATEGORIES;
        $nextOrder = (GalleryItem::max('display_order') ?? 0) + 1;

        return view('admin.gallery.create', compact('categories', 'nextOrder'));
    }

    /**
     * Store a newly uploaded gallery photograph in database and storage.
     */
    public function store(StoreGalleryItemRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['is_active'] = $request->boolean('is_active', true);
        $data['image_path'] = $request->file('image')->store('gallery', 'public');

        GalleryItem::create($data);

        return redirect()->route('admin.gallery.index')
            ->with('success', "Photograph '{$data['title']}' uploaded successfully.");
    }

    /**
     * Show the form for editing the specified gallery photograph.
     */
    public function edit(GalleryItem $gallery): View
    {
        $categories = GalleryItem::CATEGORIES;
        return view('admin.gallery.edit', compact('gallery', 'categories'));
    }

    /**
     * Update the specified gallery photograph in database.
     */
    public function update(UpdateGalleryItemRequest $request, GalleryItem $gallery): RedirectResponse
    {
        $data = $request->validated();
        $data['is_active'] = $request->boolean('is_active', false);

        if ($request->hasFile('image')) {
            if ($gallery->image_path && Storage::disk('public')->exists($gallery->image_path)) {
                Storage::disk('public')->delete($gallery->image_path);
            }
            $data['image_path'] = $request->file('image')->store('gallery', 'public');
        }

        $gallery->update($data);

        return redirect()->route('admin.gallery.index')
            ->with('success', "Photograph '{$gallery->title}' updated successfully.");
    }

    /**
     * Remove the specified gallery photograph from storage and database.
     */
    public function destroy(GalleryItem $gallery): RedirectResponse
    {
        $title = $gallery->title;

        if ($gallery->image_path && Storage::disk('public')->exists($gallery->image_path)) {
            Storage::disk('public')->delete($gallery->image_path);
        }

        $gallery->delete();

        return redirect()->route('admin.gallery.index')
            ->with('success', "Photograph '{$title}' deleted successfully.");
    }

    /**
     * Quick toggle publish / unpublish status for a gallery item.
     */
    public function toggleStatus(GalleryItem $gallery): RedirectResponse
    {
        $gallery->is_active = !$gallery->is_active;
        $gallery->save();

        $statusText = $gallery->is_active ? 'published' : 'unpublished';

        return back()->with('success', "Photograph '{$gallery->title}' {$statusText} successfully.");
    }
}
