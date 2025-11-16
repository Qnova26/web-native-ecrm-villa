@extends('layouts.app')
@section('title', 'Data Tamu')
@section('content')
<div class="container" style="margin-top:32px;">
    <h1 style="text-align:center;font-size:2rem;font-weight:700;margin-bottom:18px;">Data Tamu</h1>
    <a class="admin-menu-tile" href="{{ route('admin.dashboard') }}" style="display:inline-block;margin-bottom:18px;">Kembali ke Dashboard</a>
    <div style="overflow-x:auto;margin-top:18px;">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>No. HP</th>
                    <th>Total Menginap</th>
                    <th>Terakhir Menginap</th>
                </tr>
            </thead>
            <tbody>
                @foreach($guests as $g)
                <tr>
                    <td>{{ $g['name'] }}</td>
                    <td>{{ $g['email'] }}</td>
                    <td>{{ $g['phone'] }}</td>
                    <td>{{ $g['total_stays'] }}</td>
                    <td>{{ $g['last_stay'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection 