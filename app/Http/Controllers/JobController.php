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
            'description' => 'required|string'
        ]);

        Job::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
        ]);
        return redirect()->route('jobs.index');
    }
}
