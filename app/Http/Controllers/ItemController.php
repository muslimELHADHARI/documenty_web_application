<?php

namespace App\Http\Controllers;

use App\Models\Item; // Assuming you have an Item model for storing documents/books
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Activity; // Assuming you have an Item model for storing documents/books

class ItemController extends Controller
{
    public function show($id)
    {
        // Fetch the item by ID, only if it's approved
        $item = Item::where('id', $id)->where('approved', 1)->firstOrFail();

        // Return a view with the item details
        return view('include.show', compact('item'));
    }

    public function index()
    {
        // Fetch only approved items from the database
        $items = Item::where('approved', 1)->orderBy('created_at', 'desc')->get();
        $unreadNotificationsCount = Auth::user()->unreadNotifications->count();
        // Pass the items to the view
        return view('include.main', compact('items', 'unreadNotificationsCount'));
    }

    public function store(Request $request)
    {
        // Validate the incoming data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required',
            'description' => 'required|string',
            'cover' => 'required|file|mimes:jpg,jpeg,png|max:20480', // Max file size 10MB
            'file' => 'required|file|mimes:pdf,doc,docx,epub,mp4|max:20480', // Max file size 10MB
        ]);

        // Store the uploaded file in the 'documents' directory
        $filePath = $request->file('file')->store('documents', 'public');
        $coverPath = $request->file('cover')->store('documents', 'public');
        // Create a new item (document or book)
        Item::create([
            'user_id' => Auth::id(), // Assuming each item is associated with a user
            'title' => $validatedData['title'],
            'category' => $validatedData['category'],
            'description' => $validatedData['description'],
            'file_path' => $filePath,
            'cover_path' => $coverPath,
        ]);
        $this->storeActivity("You added " . $validatedData['title']);
        // Redirect back with a success message
        return back()->with('success', 'Item added successfully!');
    }
    public function storeActivity($description)
    {
        $user = Auth::user();

        Activity::create([
            'description' => $description,
            'user_id' => $user->id,
        ]);
    }
}
