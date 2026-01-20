<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donor;
use App\Models\Project;
use App\Models\Donation;
use App\Models\Beneficiary;

class CharityController extends Controller
{
    public function home()
    {
        $projects = Project::getActiveProjects(3);
        $totalDonations = Donation::getTotalAmount();
        $totalBeneficiaries = Beneficiary::getTotalCount();
        
        return view('home', compact('projects', 'totalDonations', 'totalBeneficiaries'));
    }

    public function donate()
    {
        $projects = Project::getActiveProjects();
        
        return view('donate', compact('projects'));
    }

    public function processDonation(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'nullable|string',
            'amount' => 'required|numeric|min:100',
            'project_id' => 'required|exists:projects,id',
            'payment_method' => 'required|string'
        ]);

        // Find or create donor
        $donor = Donor::findOrCreateByEmail($validated['email'], [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone']
        ]);

        // Get project
        $project = Project::findOrFail($validated['project_id']);

        // Create donation
        Donation::createDonation(
            $donor->id,
            $project->title,
            $validated['amount'],
            $validated['payment_method']
        );

        // Update project raised amount
        $project->addDonation($validated['amount']);

        return redirect()->route('home')->with('success', 'Thank you for your donation! Payment processed successfully.');
    }

    public function dashboard()
    {
        $recentDonations = Donation::getRecentWithDonor(10);
        $projects = Project::all();
        $totalDonors = Donor::count();
        $totalDonations = Donation::getTotalAmount();
        $totalBeneficiaries = Beneficiary::getTotalCount();
        
        return view('dashboard', compact('recentDonations', 'projects', 'totalDonors', 'totalDonations', 'totalBeneficiaries'));
    }
}