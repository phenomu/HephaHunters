<?php

namespace App\Http\Controllers;

use App\Models\BugReport;
use Illuminate\Http\Request;

class BugReportController extends Controller
{
    // Tampilkan semua bug milik user (hunter)
    public function index()
    {
        $reports = BugReport::where('user_id', auth()->id())->get();
        return view('bugs.index', compact('reports'));
    }

    // Form tambah laporan
    public function create()
    {
        return view('bugs.create');
    }

    // Simpan laporan baru
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'severity' => 'required|in:low,medium,high,critical',
        ]);

        BugReport::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
            'severity' => $request->severity,
            'proof_url' => $request->proof_url,
        ]);

        return redirect()->route('bugs.index')->with('success', 'Laporan bug berhasil dikirim!');
    }

    // Edit laporan
    public function edit(BugReport $bug)
    {
        if ($bug->user_id !== auth()->id()) abort(403);
        return view('bugs.edit', compact('bug'));
    }

    // Update laporan
    public function update(Request $request, BugReport $bug)
    {
        if ($bug->user_id !== auth()->id()) abort(403);

        $bug->update($request->only('title', 'description', 'severity', 'proof_url'));
        return redirect()->route('bugs.index')->with('success', 'Laporan berhasil diperbarui.');
    }

    // Hapus laporan
    public function destroy(BugReport $bug)
    {
        if ($bug->user_id !== auth()->id()) abort(403);
        $bug->delete();
        return redirect()->route('bugs.index')->with('success', 'Laporan dihapus.');
    }

    // Admin lihat semua laporan
    public function all()
    {
        $reports = BugReport::with('user')->get();
        return view('bugs.admin_index', compact('reports'));
    }

    // Admin ubah status
    public function updateStatus(Request $request, BugReport $bug)
    {
        $bug->update([
            'status' => $request->status,
            'bounty_amount' => $request->bounty_amount,
        ]);
        return back()->with('success', 'Status laporan diperbarui.');
    }
}
