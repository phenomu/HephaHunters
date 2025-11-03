<?php

namespace App\Http\Controllers;

use App\Models\BugReport;
use Illuminate\Http\Request;

class BugReportController extends Controller
{
    public function index()
    {
        $reports = BugReport::where('user_id', auth()->id())->latest()->get();
        return view('bugs.index', compact('reports'));
    }

    public function create()
    {
        return view('bugs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'severity' => 'required|in:low,medium,high,critical',
            'proof_url' => 'nullable|url'
        ]);

        BugReport::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
            'severity' => $request->severity,
            'proof_url' => $request->proof_url,
        ]);

        return redirect()
            ->route('bugs.index')
            ->with('success', 'Laporan bug berhasil dikirim!');
    }

    public function edit(BugReport $bug)
    {
        abort_if($bug->user_id !== auth()->id(), 403);
        return view('bugs.edit', compact('bug'));
    }

    public function update(Request $request, BugReport $bug)
    {
        abort_if($bug->user_id !== auth()->id(), 403);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'severity' => 'required|in:low,medium,high,critical',
            'proof_url' => 'nullable|url'
        ]);

        $bug->update($request->only('title', 'description', 'severity', 'proof_url'));

        return redirect()
            ->route('bugs.index')
            ->with('success', 'Laporan berhasil diperbarui.');
    }

    public function destroy(BugReport $bug)
    {
        abort_if($bug->user_id !== auth()->id(), 403);
        $bug->delete();

        return redirect()
            ->route('bugs.index')
            ->with('success', 'Laporan berhasil dihapus.');
    }

    public function all()
    {
        $reports = BugReport::with('user')->latest()->get();
        return view('bugs.admin_index', compact('reports'));
    }

    public function updateStatus(Request $request, BugReport $bug)
    {
        $request->validate([
            'status' => 'required|in:submitted,reviewed,rewarded,rejected',
            'bounty_amount' => 'nullable|numeric|min:0',
        ]);

        $bug->update([
            'status' => $request->status,
            'bounty_amount' => $request->bounty_amount ?? null,
        ]);

        return back()->with('success', 'Status laporan berhasil diperbarui.');
    }
}
