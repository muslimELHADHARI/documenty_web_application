<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item; // Use the correct model

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query', '');
        $category = $request->input('category', 'all');

        $results = Item::query();

        // Apply search query
        if (!empty($query)) {
            $results->where(function ($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                    ->orWhere('description', 'like', "%{$query}%");
            });
        }

        // Apply category filter if not "all"
        if ($category !== 'all') {
            $results->where('category', $category);
        }

        // Only fetch approved items
        $results = $results->where('approved', 1)->get();

        return view('include.results', compact('results'));
    }
}
