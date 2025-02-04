<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class JobController extends Controller
{
    public function index() : View {
        $title = 'Available Jobs';
        $jobs = [
            'Web Developer',
            'Designer',
            'Programmer',
            'Database Administrator',
            'Software Engineer'
        ];
        return view('jobs.index', compact('title', 'jobs'));
    }

    public function create() : View {
        return view('jobs.create');
    }

    public function show(string $id): string
    {
        return view('jobs.show', compact('id'));
    }

    public function edit(string $id){

    }

    public function update(Request $request, string $id){

    }

    public function destroy(string $id){

    }

    public function store(Request $request) {
        $title = $request->input('title');
        $description = $request->input('description');

        return "Title : $title, Description : $description";
    }
}
