@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6">

    {{-- 1. HERO SECTION --}}
    <section class="text-center pt-16 pb-24">
        <h1 class="text-5xl md:text-7xl font-bold text-white fh mb-6">
            The Future of <br> <span class="flickers">Offensive Security</span>
        </h1>
        <p class="text-lg md:text-xl text-slate-400 max-w-3xl mx-auto mb-10">
            HephaCode menghubungkan organisasi Anda dengan komunitas elit peneliti keamanan global untuk menemukan dan memperbaiki celah keamanan paling kritis - lebih cepat.
        </p>
        <br>
        <div class="flex flex-col sm:flex-row justify-center items-center gap-6">
            <a href="{{ route('register') }}?type=hunter" 
               class="w-full sm:w-auto bg-cyan-500 text-slate-900 font-bold py-3 px-8 rounded-md hover:bg-cyan-400 transition-colors duration-300 btn-glow text-lg">
                Start Hacking
            </a>
            <br>
            <a href="{{ route('register') }}?type=company" 
               class="w-full sm:w-auto bg-slate-700/50 text-white font-bold py-3 px-8 rounded-md border border-slate-600 hover:border-cyan-500 hover:text-cyan-400 transition-colors duration-300 text-lg">
                Launch a Program
            </a>
        </div>
    </section>

    {{-- 2. AUDIENCE SPLIT SECTION --}}
    <section class="py-24">
        <div class="grid md:grid-cols-2 gap-8">
            
            {{-- FOR HACKERS (HUNTERS) --}}
            <div class="bg-slate-800/50 p-8 rounded-lg border border-slate-700 hover:border-cyan-500 hover:-translate-y-2 transition-all duration-300 group flex flex-col text-center md:text-left">
                <h3 class="text-sm font-bold text-cyan-400 uppercase fh mb-3">For Researchers</h3>
                <h2 class="text-3xl font-bold text-white mb-4">Join The Hunt</h2>
                <p class="text-slate-400 mb-6 flex-grow">
                    Dapatkan bayaran untuk keahlian Anda. Akses program eksklusif dari perusahaan terkemuka, laporkan kerentanan, dan bangun reputasi Anda di komunitas keamanan global.
                </p>
                <a href="{{ route('register') }}?type=hunter" class="text-cyan-400 font-semibold group-hover:underline">
                    Become a Hunter &rarr;
                </a>
            </div>

            {{-- FOR COMPANIES (ORGANIZATIONS) --}}
            <div class="bg-slate-800/50 p-8 rounded-lg border border-slate-700 hover:border-red-500 hover:-translate-y-2 transition-all duration-300 group flex flex-col text-center md:text-left">
                <h3 class="text-sm font-bold text-red-400 uppercase fh mb-3">For Organizations</h3>
                <h2 class="text-3xl font-bold text-white mb-4">Secure Your Assets</h2>
                <p class="text-slate-400 mb-6 flex-grow">
                    Manfaatkan kekuatan *crowdsourced security*. Luncurkan program *bug bounty* atau *pentest* Anda, terima laporan valid, dan kelola kerentanan dari satu dashboard terpusat.
                </p>
                <a href="{{ route('register') }}?type=company" class="text-red-400 font-semibold group-hover:underline">
                    Partner With Us &rarr;
                </a>
            </div>

        </div>
    </section>

    {{-- 3. HOW IT WORKS SECTION --}}
    <section class="py-24 text-center">
        <h2 class="text-4xl font-bold text-white mb-4">How It Works</h2>
        <p class="text-slate-400 max-w-xl mx-auto mb-16">Platform kami menyederhanakan proses keamanan untuk kedua belah pihak.</p>
        
        <div class="grid md:grid-cols-3 gap-8 text-left">
            {{-- Step 1 --}}
            <div class="bg-slate-800/30 p-6 rounded-lg border border-slate-700">
                <span class="text-3xl font-bold text-cyan-400 fh">01.</span>
                <h3 class="text-2xl font-semibold text-white mt-4 mb-2">Launch</h3>
                <p class="text-slate-400 text-sm">Perusahaan menentukan ruang lingkup, aturan, dan hadiah (bounty) untuk program keamanan mereka.</p>
            </div>
            {{-- Step 2 --}}
            <div class="bg-slate-800/30 p-6 rounded-lg border border-slate-700">
                <span class="text-3xl font-bold text-cyan-400 fh">02.</span>
                <h3 class="text-2xl font-semibold text-white mt-4 mb-2">Hunt</h3>
                <p class="text-slate-400 text-sm">Ribuan peneliti keamanan etis mencari kerentanan berdasarkan ruang lingkup yang ditentukan.</p>
            </div>
            {{-- Step 3 --}}
            <div class="bg-slate-800/30 p-6 rounded-lg border border-slate-700">
                <span class="text-3xl font-bold text-cyan-400 fh">03.</span>
                <h3 class="text-2xl font-semibold text-white mt-4 mb-2">Secure</h3>
                <p class="text-slate-400 text-sm">Laporan divalidasi, hadiah dibayarkan, dan perusahaan memperbaiki celah keamanan sebelum dieksploitasi.</p>
            </div>
        </div>
    </section>

    {{-- 4. FINAL CTA --}}
    <section class="py-24 text-center bg-slate-800/40 rounded-lg border border-slate-700">
        <h2 class="text-4xl font-bold text-white mb-4">Ready to Secure Your Future?</h2>
        <p class="text-slate-400 max-w-xl mx-auto mb-10">
            Baik Anda seorang *hacker* yang mencari tantangan atau perusahaan yang ingin bertahan, HephaCode adalah solusinya.
        </p>
        <br>
        <a href="{{ route('register') }}" 
           class="bg-cyan-500 text-slate-900 font-bold py-3 px-8 rounded-md hover:bg-cyan-400 transition-colors duration-300 btn-glow text-lg">
            Get Started Now
        </a>
    </section>

</div>
@endsection