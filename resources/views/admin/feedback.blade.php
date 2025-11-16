@extends('layouts.app')
@section('title', 'Manajemen Feedback')
@section('content')
<div class="container" style="margin-top:32px;">
    <h1 style="text-align:center;font-size:2rem;font-weight:700;margin-bottom:18px;">Manajemen Feedback</h1>
    <a class="admin-menu-tile" href="{{ route('admin.dashboard') }}" style="display:inline-block;margin-bottom:18px;">Kembali ke Dashboard</a>
    @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
    <div style="overflow-x:auto;margin-top:18px;">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Rating</th>
                    <th>Komentar</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($feedback as $f)
                <tr>
                    <td>{{ $f['name'] }}</td>
                    <td>{{ $f['rating'] }} ⭐</td>
                    <td>{{ $f['comment'] }}</td>
                    <td>
                        <span class="admin-status-badge admin-status-badge--{{ $f['approved'] ? 'confirmed' : 'pending' }}">
                            {{ $f['approved'] ? 'Disetujui' : 'Menunggu' }}
                        </span>
                    </td>
                    <td>
                        @if(!$f['approved'])
                            <form method="POST" action="{{ route('admin.feedback.approve', $f['id']) }}" style="display:inline;">
                                @csrf
                                <button type="submit" class="admin-action-btn admin-action-btn--edit">Approve</button>
                            </form>
                        @endif
                        <form method="POST" action="{{ route('admin.feedback.delete', $f['id']) }}" style="display:inline;">
                            @csrf
                            <button type="submit" class="admin-action-btn admin-action-btn--delete" onclick="return confirm('Yakin hapus feedback ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection 