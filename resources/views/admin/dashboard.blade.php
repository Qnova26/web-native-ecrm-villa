@extends('layouts.app')
@section('title', 'Admin Dashboard')
@section('content')
<div class="container" style="margin-top:32px;">
    <h1 style="text-align:center;font-size:2rem;font-weight:700;margin-bottom:18px;">Admin Dashboard</h1>
    <div style="display:flex;gap:24px;flex-wrap:wrap;justify-content:center;">
        <div class="room-card" style="min-width:180px;flex:1 1 180px;text-align:center;">
            <h3>Total Booking</h3>
            <div class="price" style="font-size:2rem;">{{ count($bookings) }}</div>
        </div>
        <div class="room-card" style="min-width:180px;flex:1 1 180px;text-align:center;">
            <h3>Total Tamu</h3>
            <div class="price" style="font-size:2rem;">{{ count($guests) }}</div>
        </div>
        <div class="room-card" style="min-width:180px;flex:1 1 180px;text-align:center;">
            <h3>Feedback</h3>
            <div class="price" style="font-size:2rem;">{{ count($feedback) }}</div>
        </div>
        <div class="room-card" style="min-width:180px;flex:1 1 180px;text-align:center;">
            <h3>Promo Aktif</h3>
            <div class="price" style="font-size:2rem;">{{ count($promo) }}</div>
        </div>
    </div>
    <div class="admin-menu-group">
        <a class="admin-menu-tile" href="{{ route('admin.bookings') }}">Manajemen Booking</a>
        <a class="admin-menu-tile" href="{{ route('admin.guests') }}">Data Tamu</a>
        <a class="admin-menu-tile" href="{{ route('admin.feedback') }}">Feedback</a>
        <a class="admin-menu-tile" href="{{ route('admin.promo') }}">Promo</a>
    </div>
</div>
@endsection 