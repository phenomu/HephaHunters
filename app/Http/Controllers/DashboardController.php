<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\BugReport;
use Illuminate\Http\Request;


class DashboardController extends Controller
{
    // --- ADMIN DASHBOARD ---
    public function admin()
    {
        $stats = [
            'total_hunters' => User::where('role', 'hunter')->count(),
            'open_reports' => BugReport::where('status', 'submitted')->count(),
            'resolved_bugs' => BugReport::where('status', 'rewarded')->count(),
            'total_reports' => BugReport::count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }

    // --- HUNTER DASHBOARD ---
    public function hunter()
    {
        $userId = auth()->id();

        $stats = [
            'my_reports' => BugReport::where('user_id', $userId)->count(),
            'pending' => BugReport::where('user_id', $userId)->where('status', 'submitted')->count(),
            'rewarded' => BugReport::where('user_id', $userId)->where('status', 'rewarded')->count(),
            'bounty_total' => BugReport::where('user_id', $userId)->sum('bounty_amount'),
        ];

        return view('hunter.dashboard', compact('stats'));
    }
}
