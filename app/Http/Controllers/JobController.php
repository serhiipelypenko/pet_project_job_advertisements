<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class JobController extends Controller
{
    public function index() : View {
        $jobs = Job::all();
        return view('jobs.index')->with('jobs', $jobs);
    }

    public function create() : View {
        return view('jobs.create');
    }

    public function show(Job $job): string
    {
        return view('jobs.show')->with('job', $job);
    }

    public function edit(string $id){

    }

    public function update(Request $request, string $id){

    }

    public function destroy(string $id){

    }

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

        Job::create($validatedData);
        return redirect()->route('jobs.index')->with('success', 'Job listings created successfully.');
    }
}
