@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6">

    {{-- Header: Title and New Report Button --}}
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-4xl font-bold text-white flickers">My Bug Reports</h1>
        <a href="{{ route('bugs.create') }}" 
           class="bg-cyan-500 text-slate-900 font-bold py-2 px-5 rounded-md hover:bg-cyan-400 transition-colors duration-300 btn-glow">
           + New Report
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-700/30 border border-green-500 text-green-300 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    {{-- Start of Card Grid Layout --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        
        @forelse($reports as $bug)
            {{-- Card design based on HephaCode theme --}}
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
                            <span class="text-slate-400 text-sm">Status:</span>
                            <span class="text-slate-200 font-medium capitalize">{{ $bug->status }}</span>
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

                {{-- Card Footer: Action Buttons --}}
                <div class="flex items-center justify-end gap-4">
                    <a href="{{ route('bugs.edit', $bug) }}" class="text-sm font-medium text-yellow-400 hover:text-yellow-300 transition-colors">Edit</a> |
                    <form action="{{ route('bugs.destroy', $bug) }}" method="POST" class="inline" onsubmit="return confirm('Delete this report?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-sm font-medium text-red-400 hover:text-red-300 transition-colors">Delete</button>
                    </form>
                </div>
            </div>
        
        @empty
            {{-- Empty State --}}
            <div class="md:col-span-2 lg:col-span-3 text-center py-16 bg-slate-800/30 rounded-lg border border-slate-700">
                <p class="text-slate-500 text-lg">No reports yet.</p>
                <a href="{{ route('bugs.create') }}" 
                   class="mt-4 inline-block bg-cyan-500 text-slate-900 font-bold py-2 px-5 rounded-md hover:bg-cyan-400 transition-colors duration-300 btn-glow">
                   Submit Your First Report
                </a>
            </div>
        @endforelse {{-- <--- This was the typo, now fixed --}}

    </div>
    {{-- End of Card Grid Layout --}}

</div>
@endsection