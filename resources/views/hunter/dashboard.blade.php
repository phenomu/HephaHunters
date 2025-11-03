@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6">
    <h1 class="text-4xl font-bold text-white mb-4 flickers">Hunter Dashboard</h1>
    <p class="text-slate-400 mb-10">Track your submitted bugs and explore active bounty programs.</p>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <div class="bg-slate-800/50 p-6 rounded-lg border border-slate-700 hover:border-cyan-500 transition-all">
            <h3 class="text-xl font-semibold text-white mb-2">My Reports</h3>
            <p class="text-3xl text-cyan-400 font-bold">5</p>
        </div>
        <div class="bg-slate-800/50 p-6 rounded-lg border border-slate-700 hover:border-cyan-500 transition-all">
            <h3 class="text-xl font-semibold text-white mb-2">Bounties Earned</h3>
            <p class="text-3xl text-green-400 font-bold">$250</p>
        </div>
        <div class="bg-slate-800/50 p-6 rounded-lg border border-slate-700 hover:border-cyan-500 transition-all">
            <h3 class="text-xl font-semibold text-white mb-2">Pending Review</h3>
            <p class="text-3xl text-yellow-400 font-bold">2</p>
        </div>
    </div>
</div>
@endsection
