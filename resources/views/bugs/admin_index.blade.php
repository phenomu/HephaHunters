@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6">
    <h1 class="text-4xl font-bold text-white mb-6 flickers">All Bug Reports</h1>

    @if(session('success'))
        <div class="bg-green-700/30 border border-green-500 text-green-300 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="w-full text-left border border-slate-700 bg-slate-800/40 rounded-lg">
            <thead class="text-cyan-400 border-b border-slate-700">
                <tr>
                    <th class="p-3">Title</th>
                    <th class="p-3">Hunter</th>
                    <th class="p-3">Severity</th>
                    <th class="p-3">Status</th>
                    <th class="p-3">Bounty</th>
                    <th class="p-3">Proof</th>
                    <th class="p-3">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($reports as $bug)
                    <tr class="border-b border-slate-700 hover:bg-slate-700/40 transition">
                        <td class="p-3 font-semibold text-white">{{ $bug->title }}</td>
                        <td class="p-3 text-slate-300">{{ $bug->user->name }}</td>
                        <td class="p-3 text-{{ $bug->severity === 'critical' ? 'red' : ($bug->severity === 'high' ? 'yellow' : 'cyan') }}-400 font-bold capitalize">{{ $bug->severity }}</td>
                        <td class="p-3 capitalize">{{ $bug->status }}</td>
                        <td class="p-3">{{ $bug->bounty_amount ? '$'.number_format($bug->bounty_amount, 2) : '-' }}</td>
                        <td class="p-3">
                            @if($bug->proof_url)
                                <a href="{{ $bug->proof_url }}" target="_blank" class="text-cyan-400 hover:underline">View</a>
                            @else
                                <span class="text-slate-500">-</span>
                            @endif
                        </td>
                        <td class="p-3">
                            <form method="POST" action="{{ route('admin.bugs.updateStatus', $bug) }}" class="flex flex-col gap-2">
                                @csrf
                                <select name="status" class="bg-slate-900 border border-slate-700 rounded text-white px-2 py-1 text-sm">
                                    @foreach(['submitted', 'reviewed', 'rewarded', 'rejected'] as $status)
                                        <option value="{{ $status }}" {{ $bug->status === $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
                                    @endforeach
                                </select>
                                <input type="number" name="bounty_amount" step="0.01" value="{{ $bug->bounty_amount }}" placeholder="Reward $" 
                                       class="bg-slate-900 border border-slate-700 rounded text-white px-2 py-1 text-sm">
                                <button type="submit" class="bg-cyan-500 text-slate-900 font-bold py-1 px-3 rounded-md hover:bg-cyan-400 transition btn-glow text-sm">
                                    Update
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="p-4 text-center text-slate-500">No bug reports found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
