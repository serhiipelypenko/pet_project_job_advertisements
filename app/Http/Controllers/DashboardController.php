<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
class DashboardController extends Controller
{
    // @desc Show all users job listings
    // @route GET /dashboard
    public function index(): View {
        // Get logged in user
        $user = Auth::user();

        $jobs = Job::where('user_id', $user->id)->get();

        return view('dashboard.index', compact('user','jobs'));
    }
}
