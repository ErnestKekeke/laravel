<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assignment;
use App\Models\User;
use App\Models\Submission;

class HomeController extends Controller
{
    public function index()
    {
        $stats = [
            'total_assignments' => Assignment::count(),
            'total_lecturers' => User::where('role', 'lecturer')->count(),
            'total_students' => User::where('role', 'student')->count(),
            'total_submissions' => Submission::count(),
        ];

        return view('home', compact('stats'));
    }
}