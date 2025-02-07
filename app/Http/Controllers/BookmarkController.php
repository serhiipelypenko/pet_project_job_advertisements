<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Job;

class BookmarkController extends Controller
{
    public function index() : View {
        $user = Auth::user();
        $bookmarks = $user->bookmarkedJobs()->orderBy('job_user_bookmarks.created_at')->paginate(9);
        return view('jobs.bookmarked')->with('bookmarks', $bookmarks);
    }

    public function store(Job $job) : RedirectResponse {
        $user = Auth::user();

        //Check if the job is already bookmarked
        if($user->bookmarkedJobs()->where('job_id', $job->id)->exists()) {
            return back()->with('status', 'Job is already bookmarked');
        }

        //Create new bookmark
        $user->bookmarkedJobs()->attach($job->id);

        return back()->with('success', 'Job has been bookmarked');

    }

    public function destroy(Job $job) : RedirectResponse {
        $user = Auth::user();

        //Check if the job is not bookmarked
        if(!$user->bookmarkedJobs()->where('job_id', $job->id)->exists()) {
            return back()->with('status', 'Job is not bookmarked');
        }

        //Remove bookmark
        $user->bookmarkedJobs()->detach($job->id);

        return back()->with('success', 'Bookmarked job has been deleted');

    }
}
