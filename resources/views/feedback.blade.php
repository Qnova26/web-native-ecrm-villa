@extends('layouts.app')

@section('title', 'Feedback | Green Point Retreats')
@section('content')
<div style="min-height:70vh;display:flex;align-items:center;justify-content:center;background:rgba(91,124,77,0.07);padding:32px 0;">
    <div style="background:#fff;border-radius:18px;box-shadow:0 4px 32px rgba(91,124,77,0.13);padding:38px 32px 28px 32px;max-width:420px;width:100%;">
        <h1 style="text-align:center;font-size:2rem;font-weight:700;margin-bottom:18px;color:#5b7c4d;">Feedback & Testimoni</h1>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <form method="POST" action="{{ route('feedback.submit') }}">
            @csrf
            <div style="margin-bottom:18px;">
                <label for="name" style="font-weight:600;color:#5b7c4d;">Nama</label>
                <div style="position:relative;">
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required class="custom-form-input" style="width:100%;padding:10px 36px 10px 12px;border-radius:8px;border:1.2px solid #b7cbb0;margin-top:4px;">
                    <span style="position:absolute;right:10px;top:50%;transform:translateY(-50%);color:#5b7c4d;font-size:1.1rem;">&#128100;</span>
                </div>
                @error('name')<div class="alert alert-error">{{ $message }}</div>@enderror
            </div>
            <div style="margin-bottom:18px;">
                <label for="rating" style="font-weight:600;color:#5b7c4d;">Rating</label>
                <div style="position:relative;">
                    <select name="rating" id="rating" required class="custom-form-input" style="width:100%;padding:10px 36px 10px 12px;border-radius:8px;border:1.2px solid #b7cbb0;margin-top:4px;appearance:auto;">
                        <option value="">-- Pilih Rating --</option>
                        @for($i=5; $i>=1; $i--)
                            <option value="{{ $i }}" @if(old('rating')==$i) selected @endif>{{ $i }} Bintang</option>
                        @endfor
                    </select>
                    <span style="position:absolute;right:10px;top:50%;transform:translateY(-50%);color:#5b7c4d;font-size:1.1rem;">&#11088;</span>
                </div>
                @error('rating')<div class="alert alert-error">{{ $message }}</div>@enderror
            </div>
            <div style="margin-bottom:22px;">
                <label for="comment" style="font-weight:600;color:#5b7c4d;">Komentar</label>
                <textarea name="comment" id="comment" rows="3" required class="custom-form-textarea"></textarea>
                @error('comment')<div class="alert alert-error">{{ $message }}</div>@enderror
            </div>
            <button type="submit" style="width:100%;background:#5b7c4d;color:#fff;font-weight:700;font-size:1.1rem;padding:10px 0;border:none;border-radius:8px;box-shadow:0 2px 8px rgba(91,124,77,0.10);transition:background 0.2s;">Kirim Feedback</button>
        </form>
    </div>
</div>
@endsection 