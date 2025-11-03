@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6">
    <h1 class="text-3xl font-bold text-white mb-6 flickers">Submit New Bug Report</h1>

    <div class="max-w-4xl mx-auto grid md:grid-cols-1 gap-12 bg-slate-800/50 border border-slate-700 rounded-lg p-8">
        <form id="bugForm" class="space-y-6">

            @csrf
            <div class="text-left">
                <label class="block text-slate-300 mb-2 font-semibold">Title</label>
                <input type="text" name="title" class="w-full bg-slate-700/50 border border-slate-600 rounded-md py-2 px-3 text-slate-300 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 transition-colors" required>
            </div>

            <div class="text-left">
                <label class="block text-slate-300 mb-2 font-semibold">Description</label>
                <textarea name="description" rows="5" class="w-full bg-slate-700/50 border border-slate-600 rounded-md py-2 px-3 text-slate-300 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 transition-colors" required></textarea>
            </div>

            <div class="text-left">
                <label class="block text-slate-300 mb-2 font-semibold">Severity</label>
                <select name="severity" class="w-full px-4 py-2 rounded-md bg-slate-900 border border-slate-700 text-slate-200 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500 outline-none" required>
                    <option value="low">Low</option>
                    <option value="medium">Medium</option>
                    <option value="high">High</option>
                    <option value="critical">Critical</option>
                </select>
            </div>

            <div class="text-left">
                <label class="block text-slate-300 mb-2 font-semibold">Proof URL (optional)</label>
                <input type="url" name="proof_url" class="w-full bg-slate-700/50 border border-slate-600 rounded-md py-2 px-3 text-slate-300 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 transition-colors" placeholder="https://example.com/proof">
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-cyan-500 text-slate-900 font-bold py-2 px-6 rounded-md btn-glow">
                    Submit Report
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Script AJAX + SweetAlert --}}
<script>
document.getElementById('bugForm').addEventListener('submit', async function (e) {
    e.preventDefault();

    const form = e.target;
    const formData = new FormData(form);

    try {
        const response = await fetch("{{ route('bugs.store') }}", {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": form.querySelector('input[name="_token"]').value,
            },
            body: formData
        });

        if (response.ok) {
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: 'Your bug report has been submitted.',
                background: '#0a0e1a',
                color: '#e0f2fe',
                confirmButtonColor: '#0ea5e9',
                showConfirmButton: false,
                timer: 2000
            }).then(() => {
                window.location.href = "{{ route('bugs.index') }}";
            });
            form.reset();
            form.reset();
        } else {
            const data = await response.json();
            Swal.fire({
                icon: 'error',
                title: 'Validation Error',
                text: data.message || 'Please check your input fields.',
                background: '#0a0e1a',
                color: '#e0f2fe',
                confirmButtonColor: '#ef4444'
            });
        }
    } catch (error) {
        Swal.fire({
            icon: 'error',
            title: 'Server Error',
            text: 'Failed to submit report. Please try again later.',
            background: '#0a0e1a',
            color: '#e0f2fe',
            confirmButtonColor: '#ef4444'
        });
    }
});
</script>
@endsection
