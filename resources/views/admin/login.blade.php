@extends('layouts.app')
@section('title', 'Admin Login')
@section('content')
<div style="min-height:70vh;display:flex;align-items:center;justify-content:center;background:rgba(91,124,77,0.07);padding:32px 0;">
    <div style="background:#fff;border-radius:18px;box-shadow:0 4px 32px rgba(91,124,77,0.13);padding:38px 32px 28px 32px;max-width:370px;width:100%;display:flex;flex-direction:column;align-items:center;">
        <h1 style="text-align:center;width:100%;font-size:2.1rem;font-weight:700;color:#5b7c4d;margin-bottom:18px;letter-spacing:1px;">Admin Login</h1>
        @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
        <form method="POST" action="{{ route('admin.login') }}" style="width:100%;">
            @csrf
            <div style="margin-bottom:18px;">
                <label for="email" style="font-weight:600;color:#5b7c4d;">Email</label>
                <div style="position:relative;">
                    <input type="email" name="email" id="email" required class="custom-form-input" style="width:100%;padding:10px 36px 10px 12px;border-radius:8px;border:1.2px solid #b7cbb0;margin-top:4px;">
                    <span style="position:absolute;right:10px;top:50%;transform:translateY(-50%);color:#5b7c4d;font-size:1.1rem;">&#9993;</span>
                </div>
                @error('email')<div class="alert alert-error">{{ $message }}</div>@enderror
            </div>
            <div style="margin-bottom:18px;">
                <label for="password" style="font-weight:600;color:#5b7c4d;">Password</label>
                <div style="position:relative;">
                    <input type="password" name="password" id="password" required class="custom-form-input" style="width:100%;padding:10px 36px 10px 12px;border-radius:8px;border:1.2px solid #b7cbb0;margin-top:4px;">
                    <span style="position:absolute;right:10px;top:50%;transform:translateY(-50%);color:#5b7c4d;font-size:1.1rem;">&#128274;</span>
                </div>
                @error('password')<div class="alert alert-error">{{ $message }}</div>@enderror
            </div>
            <button type="submit" style="width:100%;background:#5b7c4d;color:#fff;font-weight:700;font-size:1.1rem;padding:10px 0;border:none;border-radius:8px;box-shadow:0 2px 8px rgba(91,124,77,0.10);transition:background 0.2s;">Login</button>
        </form>
        <div style="margin-top:18px;text-align:center;width:100%;">
            <a href="{{ url('/admin/forgot') }}" style="font-size:0.98rem;color:#5b7c4d;text-decoration:underline;">Lupa Password?</a>
        </div>
    </div>
</div>
@endsection 