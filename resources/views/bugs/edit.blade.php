@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6">
    <h1 class="text-4xl font-bold text-white mb-6 flickers">Edit Bug Report</h1>

    <form method="POST" action="{{ route('bugs.update', $bug) }}" 
          class="bg-slate-800/50 p-6 rounded-lg border border-slate-700 max-w-2xl mx-auto text-left space-y-5">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-slate-300 mb-1 font-semibold">Title</label>
            <input type="text" name="title" value="{{ $bug->title }}" 
                   class="w-full px-3 py-2 bg-slate-900 border border-slate-700 rounded text-white focus:border-cyan-400 outline-none">
        </div>

        <div>
            <label class="block text-slate-300 mb-1 font-semibold">Description</label>
            <textarea name="description" rows="5" class="w-full px-3 py-2 bg-slate-900 border border-slate-700 rounded text-white focus:border-cyan-400 outline-none">{{ $bug->description }}</textarea>
        </div>

        <div>
            <label class="block text-slate-300 mb-1 font-semibold">Severity</label>
            <select name="severity" class="w-full px-3 py-2 bg-slate-900 border border-slate-700 rounded text-white focus:border-cyan-400 outline-none">
                @foreach(['low', 'medium', 'high', 'critical'] as $level)
                    <option value="{{ $level }}" {{ $bug->severity === $level ? 'selected' : '' }}>{{ ucfirst($level) }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-slate-300 mb-1 font-semibold">Proof URL</label>
            <input type="url" name="proof_url" value="{{ $bug->proof_url }}" 
                   class="w-full px-3 py-2 bg-slate-900 border border-slate-700 rounded text-white focus:border-cyan-400 outline-none">
        </div>

        <button type="submit" class="bg-cyan-500 text-slate-900 font-bold py-2 px-6 rounded-md hover:bg-cyan-400 transition btn-glow">
            Update Report
        </button>
    </form>
</div>
@endsection
