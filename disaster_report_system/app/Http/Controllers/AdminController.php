<?php

namespace App\Http\Controllers;

use App\Models\DisasterReport;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $reports = DisasterReport::with('disasterType')
            ->orderBy('created_at', 'desc')
            ->get();
        
        $totalReports = $reports->count();
        $pendingReports = $reports->where('status', 'pending')->count();
        $resolvedReports = $reports->where('status', 'resolved')->count();
        $criticalReports = $reports->where('severity', 'critical')->count();

        return view('admin.dashboard', compact(
            'reports',
            'totalReports',
            'pendingReports',
            'resolvedReports',
            'criticalReports'
        ));
    }

    public function updateStatus(Request $request, $id)
    {
        $report = DisasterReport::findOrFail($id);
        
        $validated = $request->validate([
            'status' => 'required|in:pending,in_progress,resolved',
        ]);

        $report->update($validated);

        return redirect()->route('admin.dashboard')->with('success', 'Report status updated successfully!');
    }
}