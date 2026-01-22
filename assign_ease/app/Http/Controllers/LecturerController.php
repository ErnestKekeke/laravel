<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Assignment;
use App\Models\Submission;

class LecturerController extends Controller
{
    public function dashboard()
    {
        $lecturer = Auth::user();
        
        $assignments = Assignment::where('lecturer_id', $lecturer->id)
            ->withCount('submissions')
            ->latest()
            ->take(5)
            ->get();

        $totalAssignments = Assignment::where('lecturer_id', $lecturer->id)->count();
        $totalSubmissions = Submission::whereHas('assignment', function($query) use ($lecturer) {
            $query->where('lecturer_id', $lecturer->id);
        })->count();

        $recentSubmissions = Submission::whereHas('assignment', function($query) use ($lecturer) {
            $query->where('lecturer_id', $lecturer->id);
        })->with(['student', 'assignment'])
            ->latest()
            ->take(5)
            ->get();

        return view('lecturer.dashboard', compact('assignments', 'totalAssignments', 'totalSubmissions', 'recentSubmissions'));
    }

    public function assignments()
    {
        $lecturer = Auth::user();
        
        $assignments = Assignment::where('lecturer_id', $lecturer->id)
            ->withCount('submissions')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('lecturer.assignments', compact('assignments'));
    }

    public function createAssignment()
    {
        return view('lecturer.create-assignment');
    }

    public function storeAssignment(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'course_code' => 'required|string|max:50',
            'course_title' => 'required|string|max:255',
            'due_date' => 'required|date|after:now',
            'total_marks' => 'required|integer|min:1|max:100',
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
        ]);

        $lecturer = Auth::user();
        $validated['lecturer_id'] = $lecturer->id;

        // Handle file upload
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('assignments', $filename, 'public');
            $validated['file_path'] = $path;
        }

        Assignment::create($validated);

        return redirect()->route('lecturer.assignments')->with('success', 'Assignment created successfully!');
    }

    public function showAssignment($id)
    {
        $lecturer = Auth::user();
        
        $assignment = Assignment::where('id', $id)
            ->where('lecturer_id', $lecturer->id)
            ->withCount('submissions')
            ->firstOrFail();

        $submissions = Submission::where('assignment_id', $id)
            ->with('student')
            ->orderBy('submitted_at', 'desc')
            ->get();

        return view('lecturer.assignment-detail', compact('assignment', 'submissions'));
    }

    public function downloadSubmission($id)
    {
        $lecturer = Auth::user();
        
        $submission = Submission::whereHas('assignment', function($query) use ($lecturer) {
            $query->where('lecturer_id', $lecturer->id);
        })->findOrFail($id);

        return Storage::disk('public')->download($submission->file_path);
    }

    public function gradeSubmission(Request $request, $id)
    {
        $validated = $request->validate([
            'score' => 'required|integer|min:0',
            'feedback' => 'nullable|string',
        ]);

        $lecturer = Auth::user();
        
        $submission = Submission::whereHas('assignment', function($query) use ($lecturer) {
            $query->where('lecturer_id', $lecturer->id);
        })->findOrFail($id);

        $submission->update([
            'score' => $validated['score'],
            'feedback' => $validated['feedback'],
            'status' => 'graded',
        ]);

        return back()->with('success', 'Submission graded successfully!');
    }
}