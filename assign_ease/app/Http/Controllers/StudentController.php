<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Assignment;
use App\Models\Submission;

class StudentController extends Controller
{
    public function dashboard()
    {
        $student = Auth::user();
        
        $assignments = Assignment::with('lecturer')
            ->where('due_date', '>=', now())
            ->orderBy('due_date', 'asc')
            ->get();

        $submissions = Submission::where('student_id', $student->id)
            ->with('assignment')
            ->latest()
            ->get();

        return view('student.dashboard', compact('assignments', 'submissions'));
    }

    public function assignments()
    {
        $assignments = Assignment::with('lecturer')
            ->orderBy('due_date', 'desc')
            ->paginate(10);

        return view('student.assignments', compact('assignments'));
    }

    public function showAssignment($id)
    {
        $assignment = Assignment::with('lecturer')->findOrFail($id);
        $student = Auth::user();
        
        $submission = Submission::where('assignment_id', $id)
            ->where('student_id', $student->id)
            ->first();

        return view('student.assignment-detail', compact('assignment', 'submission'));
    }

    public function submitAssignment(Request $request, $id)
    {
        $request->validate([
            'file' => 'required|file|mimes:pdf,doc,docx,zip|max:10240',
        ]);

        $assignment = Assignment::findOrFail($id);
        $student = Auth::user();

        // Check if already submitted
        $existingSubmission = Submission::where('assignment_id', $id)
            ->where('student_id', $student->id)
            ->first();

        if ($existingSubmission) {
            return back()->with('error', 'You have already submitted this assignment.');
        }

        // Store file
        $file = $request->file('file');
        $filename = time() . '_' . $student->matric_number . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('submissions', $filename, 'public');

        // Determine status
        $status = now() > $assignment->due_date ? 'late' : 'submitted';

        // Create submission
        Submission::create([
            'assignment_id' => $id,
            'student_id' => $student->id,
            'file_path' => $path,
            'submitted_at' => now(),
            'status' => $status,
        ]);

        return back()->with('success', 'Assignment submitted successfully!');
    }

    public function submissions()
    {
        $student = Auth::user();
        
        $submissions = Submission::where('student_id', $student->id)
            ->with('assignment')
            ->orderBy('submitted_at', 'desc')
            ->paginate(10);

        return view('student.submissions', compact('submissions'));
    }
}