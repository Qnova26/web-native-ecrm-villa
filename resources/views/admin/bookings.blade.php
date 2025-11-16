@extends('layouts.app')
@section('title', 'Manajemen Booking')
@section('content')
<div class="container" style="margin-top:32px;">
    <h1 style="text-align:center;font-size:2rem;font-weight:700;margin-bottom:18px;">Manajemen Booking</h1>
    <a class="admin-menu-tile" href="{{ route('admin.dashboard') }}" style="display:inline-block;margin-bottom:18px;">Kembali ke Dashboard</a>
    @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
    <div style="overflow-x:auto;margin-top:18px;">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Tipe Kamar</th>
                    <th>Check-in</th>
                    <th>Check-out</th>
                    <th>Jumlah Tamu</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookings as $b)
                <tr>
                    <td>{{ $b['name'] }}</td>
                    <td>{{ $b['email'] }}</td>
                    <td>{{ $b['room_type'] }}</td>
                    <td>{{ $b['check_in'] }}</td>
                    <td>{{ $b['check_out'] }}</td>
                    <td>{{ $b['guests'] }}</td>
                    <td>
                        <span class="admin-status-badge admin-status-badge--{{ strtolower($b['status']) }}">
                            {{ $b['status'] }}
                        </span>
                    </td>
                    <td>
                        <form method="POST" action="{{ route('admin.bookings.delete', $b['id']) }}" style="display:inline;">
                            @csrf
                            <button type="submit" class="admin-action-btn admin-action-btn--delete" onclick="return confirm('Yakin hapus booking ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection 