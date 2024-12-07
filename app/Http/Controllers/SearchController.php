<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item; // Use the correct model

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query'); // Get the search term

        // Perform search query on the Item model, adjusting the fields as necessary
        $results = Item::where('title', 'like', "%{$query}%")
            ->orWhere('description', 'like', "%{$query}%") // You can add more fields if needed
            ->get();

        // Return the search results to a view
        return view('include.results', compact('results'));
    }
}
