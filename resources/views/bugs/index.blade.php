@extends('layouts.app')

@section('content')
<div class="container">
  <h2>Laporan Bug Anda</h2>
  <a href="{{ route('bugs.create') }}" class="btn btn-primary">+ Tambah Laporan</a>

  <table class="table mt-3">
    <tr>
      <th>Judul</th><th>Severity</th><th>Status</th><th>Aksi</th>
    </tr>
    @foreach($reports as $r)
    <tr>
      <td>{{ $r->title }}</td>
      <td>{{ $r->severity }}</td>
      <td>{{ $r->status }}</td>
      <td>
        <a href="{{ route('bugs.edit', $r->id) }}" class="btn btn-sm btn-warning">Edit</a>
        <form action="{{ route('bugs.destroy', $r->id) }}" method="POST" style="display:inline">
          @csrf @method('DELETE')
          <button class="btn btn-sm btn-danger">Hapus</button>
        </form>
      </td>
    </tr>
    @endforeach
  </table>
</div>
@endsection
