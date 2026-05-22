<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function dashboard()
    {
        $pendingReviews = Review::where('status', 'pending')->count();
        return view('employee.dashboard', compact('pendingReviews'));
    }

    public function reviews()
    {
        $reviews = Review::with('reviewer', 'driver', 'ride')
                         ->where('status', 'pending')
                         ->latest()
                         ->paginate(10);

        return view('employee.reviews', compact('reviews'));
    }

    public function validateReview(Review $review)
    {
        $review->update(['status' => 'validated']);
        return back()->with('success', 'Avis validé.');
    }

    public function refuseReview(Review $review)
    {
        $review->update(['status' => 'refused']);
        return back()->with('success', 'Avis refusé.');
    }
}