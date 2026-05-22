<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Ride;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_users' => User::count(),
            'total_rides' => Ride::count(),
            'pending_reviews' => Review::where('status', 'pending')->count(),
            'completed_rides' => Ride::where('status', 'completed')->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }

    public function reviews()
    {
        $reviews = Review::with('reviewer', 'driver', 'ride')
                         ->where('status', 'pending')
                         ->latest()
                         ->paginate(10);

        return view('admin.reviews', compact('reviews'));
    }

    public function validateReview(Review $review)
    {
        $review->update(['status' => 'validated']);
        return back()->with('success', 'Avis validé avec succès.');
    }

    public function refuseReview(Review $review)
    {
        $review->update(['status' => 'refused']);
        return back()->with('success', 'Avis refusé.');
    }
}