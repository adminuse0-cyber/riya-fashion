<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClientReviewRequest;
use App\Http\Requests\UpdateClientReviewRequest;
use App\Models\ClientReview;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ClientReviewController extends Controller
{
    /**
     * Display a listing of all merchant reviews.
     */
    public function index(Request $request): View
    {
        $filter = $request->query('filter', 'all');

        $query = ClientReview::query()->orderBy('display_order')->orderByDesc('id');

        if ($filter === 'published') {
            $query->where('is_published', true);
        } elseif ($filter === 'draft') {
            $query->where('is_published', false);
        }

        $reviews = $query->get();

        $totalPublished = ClientReview::where('is_published', true)->count();
        $totalDraft = ClientReview::where('is_published', false)->count();

        return view('admin.reviews.index', compact('reviews', 'filter', 'totalPublished', 'totalDraft'));
    }

    /**
     * Show the form for creating a new merchant review.
     */
    public function create(): View
    {
        $nextOrder = (ClientReview::max('display_order') ?? 0) + 1;
        return view('admin.reviews.create', compact('nextOrder'));
    }

    /**
     * Store a newly created merchant review in the database.
     */
    public function store(StoreClientReviewRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['is_published'] = $request->boolean('is_published', false);

        // Null-out rating if empty string submitted
        if (isset($data['rating']) && $data['rating'] === '') {
            $data['rating'] = null;
        }

        ClientReview::create($data);

        return redirect()->route('admin.reviews.index')
            ->with('success', "Review from '{$data['client_name']}' added successfully. Review is currently " . ($data['is_published'] ? 'published.' : 'saved as draft.'));
    }

    /**
     * Show the form for editing the specified merchant review.
     */
    public function edit(ClientReview $review): View
    {
        return view('admin.reviews.edit', compact('review'));
    }

    /**
     * Update the specified merchant review in the database.
     */
    public function update(UpdateClientReviewRequest $request, ClientReview $review): RedirectResponse
    {
        $data = $request->validated();
        $data['is_published'] = $request->boolean('is_published', false);

        // Null-out rating if empty string submitted
        if (array_key_exists('rating', $data) && ($data['rating'] === '' || $data['rating'] === null)) {
            $data['rating'] = null;
        }

        $review->update($data);

        return redirect()->route('admin.reviews.index')
            ->with('success', "Review from '{$review->client_name}' updated successfully.");
    }

    /**
     * Remove the specified merchant review from the database.
     */
    public function destroy(ClientReview $review): RedirectResponse
    {
        $name = $review->client_name;
        $review->delete();

        return redirect()->route('admin.reviews.index')
            ->with('success', "Review from '{$name}' deleted successfully.");
    }

    /**
     * Quick toggle publish / unpublish status for a review.
     */
    public function toggleStatus(ClientReview $review): RedirectResponse
    {
        $review->is_published = !$review->is_published;
        $review->save();

        $statusText = $review->is_published ? 'published' : 'moved to draft';

        return back()->with('success', "Review from '{$review->client_name}' {$statusText} successfully.");
    }
}
