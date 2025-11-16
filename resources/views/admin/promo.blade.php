@extends('layouts.app')
@section('title', 'Manajemen Promo')
@section('content')
<div class="container" style="margin-top:32px;max-width:900px;">
    <h1 style="text-align:center;font-size:2rem;font-weight:700;margin-bottom:18px;">Manajemen Promo</h1>
    <a class="admin-menu-tile" href="{{ route('admin.dashboard') }}" style="display:inline-block;margin-bottom:18px;">Kembali ke Dashboard</a>
    @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
    <form method="POST" action="{{ route('admin.promo.add') }}" class="promo-form-row">
        @csrf
        <div class="promo-form-group code">
            <label for="code">Kode Promo</label>
            <input type="text" name="code" id="code" maxlength="20" required class="custom-form-input">
            @error('code')<div class="alert alert-error">{{ $message }}</div>@enderror
        </div>
        <div class="promo-form-group desc">
            <label for="description">Deskripsi</label>
            <input type="text" name="description" id="description" maxlength="100" required class="custom-form-input">
            @error('description')<div class="alert alert-error">{{ $message }}</div>@enderror
        </div>
        <div class="promo-form-group discount">
            <label for="discount">Diskon (%)</label>
            <input type="number" name="discount" id="discount" min="1" max="100" required class="custom-form-input">
            @error('discount')<div class="alert alert-error">{{ $message }}</div>@enderror
        </div>
        <div class="promo-form-action">
            <button type="submit" class="admin-menu-tile" style="padding:10px 18px;font-size:1rem;">Tambah Promo</button>
        </div>
    </form>
    <div style="overflow-x:auto;margin-top:18px;">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Deskripsi</th>
                    <th>Diskon (%)</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($promo as $p)
                <tr>
                    <td>{{ $p['code'] }}</td>
                    <td>{{ $p['description'] }}</td>
                    <td>{{ $p['discount'] }}</td>
                    <td>
                        <span class="admin-status-badge admin-status-badge--{{ $p['active'] ? 'confirmed' : 'cancelled' }}">
                            {{ $p['active'] ? 'Aktif' : 'Nonaktif' }}
                        </span>
                    </td>
                    <td>
                        <div class="promo-table-action">
                            <form method="POST" action="{{ route('admin.promo.delete', $p['id']) }}" style="display:inline;">
                                @csrf
                                <button type="submit" class="admin-action-btn admin-action-btn--delete" onclick="return confirm('Yakin hapus promo ini?')">Hapus</button>
                            </form>
                            <form method="POST" action="{{ route('admin.promo.edit', $p['id']) }}" style="display:inline;">
                                @csrf
                                <input type="hidden" name="description" value="{{ $p['description'] }}">
                                <input type="hidden" name="discount" value="{{ $p['discount'] }}">
                                <input type="hidden" name="active" value="{{ $p['active'] ? 1 : 0 }}">
                                <button type="submit" class="admin-action-btn admin-action-btn--edit">Edit</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection 