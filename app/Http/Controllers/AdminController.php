<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Activity;
use Illuminate\Support\Facades\DB;
use App\Notifications\DocumentApprovedNotification;

class AdminController extends Controller
{

    public function dashboard()
    {
        // Get all items
        $items = Item::orderBy('created_at', 'desc')->paginate(10);

        // Get the total count of items
        $totalCount = Item::count();

        // Get the categories and their counts
        $categories = Item::select('category', DB::raw('count(*) as count'))
            ->groupBy('category')
            ->get();

        // Prepare the data for the chart
        $categoryLabels = $categories->pluck('category');  // Get category names
        $categoryCounts = $categories->pluck('count');    // Get item counts for each category
        $PendingCount = Item::where('approved', false)->count();

        // Pass the data to the view
        return view('admin.dashboard', [
            'items' => $items,
            'totalCount' => $totalCount,
            'categories' => $categoryLabels,
            'counts' => $categoryCounts,
            'pendingcount' => $PendingCount,
        ]);
    }
    public function approveItem($id)
    {
        $item = Item::findOrFail($id);
        $item->approved = true;  // Set the 'approved' column to true
        $user = $item->user;  // Assuming 'user' relationship is defined in the Item model
        $user->notify(new DocumentApprovedNotification($item));
        $item->save();
        return redirect()->route('admin.dashboard')->with('success', 'Item approved successfully.');
    }

    public function manageItems()
    {
        // Fetching all items in descending order of creation
        $items = Item::orderBy('created_at', 'desc')->paginate(10);

        // Returning the items to the view
        return view('admin.manage-items', compact('items'));
    }

    public function deleteItem($id)
    {
        // Finding the item by its ID
        $item = Item::findOrFail($id);

        // Deleting the associated activity by matching the description
        Activity::where('description', $item->description)->delete();

        // Deleting the item
        $item->delete();

        // Redirecting back with a success message after deletion
        return redirect()->route('admin.dashboard')->with('success', 'Item and its associated activity deleted successfully.');
    }
}
