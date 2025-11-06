@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6">
    <h1 class="text-4xl font-bold text-white mb-6 flickers">All Bug Reports</h1>

    <!-- @if(session('success'))
        <div class="bg-green-700/30 border border-green-500 text-green-300 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif -->

    {{-- Start of new Card Grid Layout --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
        
        @forelse($reports as $bug)
            {{-- This card design is based on your HephaCode example --}}
            <div class="bg-slate-800/50 p-6 rounded-lg border border-slate-700 hover:border-cyan-500 hover:-translate-y-2 transition-all duration-300 group flex flex-col justify-between">
                
                {{-- Card Header: Title and Severity --}}
                <div>
                    <div class="flex justify-between items-start mb-4">
                        <h3 class="text-xl font-semibold text-white group-hover:text-cyan-400 transition duration-300 pr-4">{{ $bug->title }}</h3>
                        
                        {{-- Dynamic Severity Badge --}}
                        @php
                            $severityClass = '';
                            if ($bug->severity === 'critical') $severityClass = 'bg-red-500/20 text-red-400 border-red-500/50';
                            elseif ($bug->severity === 'high') $severityClass = 'bg-yellow-500/20 text-yellow-400 border-yellow-500/50';
                            else $severityClass = 'bg-cyan-500/20 text-cyan-400 border-cyan-500/50';
                        @endphp
                        <span class="text-xs font-bold capitalize px-3 py-1 rounded-full border {{ $severityClass }} flex-shrink-0">{{ $bug->severity }}</span>
                    </div>

                    {{-- Card Body: Meta Info --}}
                    <div class="space-y-3 mb-6">
                        <div class="flex justify-between">
                            <span class="text-slate-400 text-sm">Hunter:</span>
                            <span class="text-slate-200 font-medium">{{ $bug->user->name }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-slate-400 text-sm">Status:</span>
                            <span class="text-slate-200 font-medium capitalize">{{ $bug->status }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-slate-400 text-sm">Bounty:</span>
                            <span class="text-slate-200 font-medium">{{ $bug->bounty_amount ? '$'.number_format($bug->bounty_amount, 2) : '-' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-slate-400 text-sm">Proof:</span>
                            @if($bug->proof_url)
                                <a href="{{ $bug->proof_url }}" target="_blank" class="text-cyan-400 hover:underline text-sm font-medium">View Proof</a>
                            @else
                                <span class="text-slate-500 text-sm">-</span>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Card Footer: Update Form --}}
                <div>
                    <form method="POST" action="{{ route('admin.bugs.updateStatus', $bug) }}">
                        @csrf
                        <div class="grid grid-cols-2 gap-3">
                            {{-- Status Dropdown --}}
                            <div>
                                <label for="status-{{ $bug->id }}" class="block text-xs font-medium text-slate-400 mb-1">Status</label>
                                <select name="status" id="status-{{ $bug->id }}" class="w-full bg-slate-900 border border-slate-700 rounded text-white px-2 py-2 text-sm focus:ring-cyan-500 focus:border-cyan-500">
                                    @foreach(['submitted', 'reviewed', 'rewarded', 'rejected'] as $status)
                                        <option value="{{ $status }}" {{ $bug->status === $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Bounty Input --}}
                            <div>
                                <label for="bounty-{{ $bug->id }}" class="block text-xs font-medium text-slate-400 mb-1">Bounty</label>
                                <input type="number" name="bounty_amount" id="bounty-{{ $bug->id }}" step="0.01" value="{{ $bug->bounty_amount }}" placeholder="Reward $" 
                                       class="w-full bg-slate-700/50 border border-slate-600 rounded-md py-2 px-3 text-slate-300 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 transition-colors">
                            </div>
                        </div>
                        
                        {{-- Submit Button --}}
                        <button type="submit" class="mt-4 w-full bg-cyan-500 text-slate-900 font-bold py-2 px-3 rounded-md hover:bg-cyan-400 transition btn-glow text-sm">
                            Update
                        </button>
                    </form>
                </div>
            </div>
        
        @empty
            {{-- Empty State --}}
            <div class="md:col-span-2 lg:col-span-3 text-center py-16 bg-slate-800/30 rounded-lg border border-slate-700">
                <p class="text-slate-500 text-lg">No bug reports found.</p>
            </div>
        @endforelse

    </div>
    {{-- End of new Card Grid Layout --}}

</div>
@endsection