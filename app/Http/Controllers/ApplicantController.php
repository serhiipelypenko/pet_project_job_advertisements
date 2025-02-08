<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Job;
use App\Mail\JobApplied;
use Illuminate\Support\Facades\Mail;

class ApplicantController extends Controller
{
    public function store(Request $request, Job $job): RedirectResponse
    {
        // Check if the user has already applied
        $existingApplication = Applicant::where('job_id', $job->id)
            ->where('user_id', auth()->id())
            ->exists();

        if($existingApplication) {
            return redirect()->back()->with('error', 'You have already applied for this job');
        }

           $validatedDate = $request->validate([
               'full_name' => 'required|string',
               'contact_phone' => 'string',
               'contact_email' => 'required|string|email',
               'message' => 'required|string',
               'location' => 'string',
               'resume' => 'required|file|mimes:pdf|max:2048',
           ]);

           if ($request->hasFile('resume')) {
               $path = $request->file('resume')->store('resume', 'public');
               $validatedDate['resume_path'] = $path;
           }

           $application = new Applicant($validatedDate);
           $application->job_id = $job->id;
           $application->user_id = auth()->id();
           $application->save();

           Mail::to($job->user->email)->send(new JobApplied($application, $job));

           return redirect()->back()->with('success', 'Your application has been submitted!');
    }

    // @desc  Delete job application
    // @route DELETE  /applicants/{applicant}
    public function destroy($id): RedirectResponse
    {
        $applicant = Applicant::findOrFail($id);
        $applicant->delete();
        return redirect()->route('dashboard')->with('success', 'Applicant deleted successfully.');
    }
}
