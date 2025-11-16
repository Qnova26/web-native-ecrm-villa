@extends('layouts.app')
@section('title', 'Lupa Password Admin')
@section('content')
<div class="container" style="max-width:400px;">
    <h1>Lupa Password</h1>
    @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
    <form method="POST" action="{{ url('/admin/forgot') }}" class="form-card">
        @csrf
        <div class="form-group">
            <label for="email">Email Admin</label>
            <input type="email" name="email" id="email" required>
            <span class="input-icon">&#9993;</span>
            @error('email')<div class="alert alert-error">{{ $message }}</div>@enderror
        </div>
        <button type="submit">Kirim Link Reset</button>
    </form>
    <div style="margin-top:12px;">
        <a href="{{ route('admin.login') }}">Kembali ke Login</a>
    </div>
</div>
@endsection 