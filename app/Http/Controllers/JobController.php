<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class JobController extends Controller
{
    // @desc Show all job listings
    // @route GET /jobs
    public function index() : View {
        $jobs = Job::all();
        return view('jobs.index')->with('jobs', $jobs);
    }

    // @desc Show create job form
    // @route GET /jobs/create
    public function create() : View {
        return view('jobs.create');
    }

    // @desc Display a single job listing
    // @route GET /jobs/{$id}
    public function show(Job $job): string
    {
        return view('jobs.show')->with('job', $job);
    }

    // @desc Show edit job form
    // @route GET /jobs/edit/{$id}
    public function edit(Job $job) : View {
        return view('jobs.edit')->with('job', $job);
    }

    // @desc Update job listing
    // @route PUT /jobs/{$id}
    public function update(Request $request, Job $job){
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'salary' => 'required|integer',
            'tags' => 'nullable|string',
            'job_type' => 'required|string',
            'remote' => 'required|boolean',
            'requirements' => 'nullable|string',
            'benefits' => 'nullable|string',
            'address' => 'nullable|string',
            'city' => 'nullable|string',
            'state' => 'nullable|string',
            'zipcode' => 'nullable|string',
            'contact_email' => 'required|string',
            'contact_phone' => 'nullable|string',
            'company_name' => 'required|string',
            'company_description' => 'nullable|string',
            'company_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'company_website' => 'nullable|url',
        ]);

        // Check for image
        if($request->hasFile('company_logo')){
            //Delete old logo
            Storage::delete('public/logos/'.basename($job->company_logo));

            $path = $request->file('company_logo')->store('logos', 'public');
            //Add path to validate data
            $validatedData['company_logo'] = $path;
        }

        $job->update($validatedData);
        return redirect()->route('jobs.index')->with('success', 'Job listings update successfully.');
    }

    // @desc Save job to database
    // @route POST /jobs
    public function store(Request $request): RedirectResponse {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'salary' => 'required|integer',
            'tags' => 'nullable|string',
            'job_type' => 'required|string',
            'remote' => 'required|boolean',
            'requirements' => 'nullable|string',
            'benefits' => 'nullable|string',
            'address' => 'nullable|string',
            'city' => 'nullable|string',
            'state' => 'nullable|string',
            'zipcode' => 'nullable|string',
            'contact_email' => 'required|string',
            'contact_phone' => 'nullable|string',
            'company_name' => 'required|string',
            'company_description' => 'nullable|string',
            'company_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'company_website' => 'nullable|url',
        ]);

        //HardCode user ID
        $validatedData['user_id'] = 1;

        // Check for image
        if($request->hasFile('company_logo')){
            $path = $request->file('company_logo')->store('logos', 'public');
            //Add path to validate data
            $validatedData['company_logo'] = $path;
        }

        Job::create($validatedData);
        return redirect()->route('jobs.index')->with('success', 'Job listings created successfully.');
    }

    // @desc Delete a job listing
    // @route DELETE /jobs/{$id}
    public function destroy(Job $job) : RedirectResponse {
        //If logo, then delete it
        if($job->company_logo){
            Storage::delete('public/logos/' . $job->company_logo);
        }

        $job->delete();
        return redirect()->route('jobs.index')->with('success', 'Job listings deleted successfully.');
    }
}
