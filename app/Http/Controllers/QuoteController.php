<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class QuoteController extends Controller
{
    public function getRandomQuote()
    {
        // Fetch the quote from the ZenQuotes API
        $response = Http::get('https://zenquotes.io/api/random');

        // Check if the request was successful
        if ($response->successful()) {
            return response()->json($response->json());
        } else {
            return response()->json(['error' => 'Failed to fetch quote'], 500);
        }
    }
}
