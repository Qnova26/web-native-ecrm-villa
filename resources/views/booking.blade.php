@extends('layouts.app')

@section('title', 'Booking | Green Point Retreats')
@section('content')
<div class="container booking-container">
    <h1 class="booking-title">Booking Kamar</h1>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="booking-main">
        <form method="POST" action="{{ route('booking.submit') }}" enctype="multipart/form-data" class="form-card booking-form">
            @csrf
            <div class="form-flex-2col">
                <div class="form-group">
                    <label for="name">Nama Lengkap</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required class="custom-form-input">
                    @error('name')<div class="alert alert-error">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required class="custom-form-input">
                    @error('email')<div class="alert alert-error">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label for="phone">No. HP</label>
                    <input type="text" name="phone" id="phone" value="{{ old('phone') }}" required class="custom-form-input">
                    @error('phone')<div class="alert alert-error">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label for="room_type">Tipe Kamar</label>
                    <select name="room_type" id="room_type" required class="custom-form-input">
                        <option value="">-- Pilih Kamar --</option>
                        @php
                            // Override harga kamar secara manual
                            $rooms[0]['price'] = 809900;
                            $rooms[1]['price'] = 1052000;
                            $rooms[2]['price'] = 1456000;
                        @endphp
                        @foreach($rooms as $i => $room)
                            <option value="{{ $room['type'] }}" @if(old('room_type')==$room['type']) selected @endif>
                                {{ $room['type'] }} (Rp {{ number_format($room['price'], 0, ',', '.') }}/malam)
                            </option>
                        @endforeach
                    </select>
                    @error('room_type')<div class="alert alert-error">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label for="check_in">Tanggal Check-in</label>
                    <input type="date" name="check_in" id="check_in" value="{{ old('check_in') }}" required class="custom-form-input">
                    @error('check_in')<div class="alert alert-error">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label for="check_out">Tanggal Check-out</label>
                    <input type="date" name="check_out" id="check_out" value="{{ old('check_out') }}" required class="custom-form-input">
                    @error('check_out')<div class="alert alert-error">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label for="guests">Jumlah Tamu</label>
                    <input type="number" name="guests" id="guests" min="1" max="10" value="{{ old('guests', 1) }}" required class="custom-form-input">
                    @error('guests')<div class="alert alert-error">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label for="ktp_file">Upload KTP (jpg/png, max 2MB)</label>
                    <input type="file" name="ktp_file" id="ktp_file" accept=".jpg,.png" required class="custom-form-input">
                    @error('ktp_file')<div class="alert alert-error">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label for="promo_code">Kode Promo (jika ada)</label>
                    <input type="text" name="promo_code" id="promo_code" value="{{ old('promo_code') }}" class="custom-form-input">
                    @error('promo_code')<div class="alert alert-error">{{ $message }}</div>@enderror
                </div>
                <div class="form-group form-group-full">
                    <label for="special_request">Permintaan Khusus</label>
                    <textarea name="special_request" id="special_request" rows="2" class="custom-form-textarea">{{ old('special_request') }}</textarea>
                    @error('special_request')<div class="alert alert-error">{{ $message }}</div>@enderror
                </div>
            </div>
            <button type="submit">Booking Sekarang</button>
        </form>
        <div class="booking-info">
            <h2>Info Tipe Kamar</h2>
            <div class="room-list">
                @foreach($rooms as $i => $room)
                <div class="room-card">
                    <div class="room-thumb-wrap">
                        <img src="{{ asset('images/Kamar_' . ($i+1) . '.jpeg') }}" alt="Room" class="room-thumb">
                    </div>
                    <div>
                        <h3>{{ $room['type'] }}</h3>
                        <div class="price">Rp {{ number_format($room['price'], 0, ',', '.') }}/malam</div>
                        <div>{{ $room['desc'] }}</div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection