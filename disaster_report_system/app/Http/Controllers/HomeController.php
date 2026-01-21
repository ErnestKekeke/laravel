<?php

namespace App\Http\Controllers;

use App\Models\DisasterType;
use App\Models\DisasterReport;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $disasterTypes = DisasterType::all();
        return view('home', compact('disasterTypes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'disaster_type_id' => 'required|exists:disaster_types,id',
            'reporter_name' => 'required|string|max:255',
            'reporter_phone' => 'required|string|max:20',
            'location' => 'required|string|max:255',
            'description' => 'required|string',
            'severity' => 'required|in:low,medium,high,critical',
        ]);

        DisasterReport::create($validated);

        return redirect()->route('home')->with('success', 'Disaster report submitted successfully!');
    }
}