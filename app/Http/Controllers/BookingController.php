<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BookingController extends Controller
{
    public function showForm()
    {
        // Dummy data kamar
        $rooms = [
            [
                'type' => 'Deluxe Double Room with Balcony and Sea View',
                'desc' => 'Luas ±25 m², 1 Queen Bed, Balkon/teras, minibar, AC, TV, kulkas, dapur kecil, kamar mandi lengkap.',
                'price' => 50
            ],
            [
                'type' => 'Deluxe Bungalow with Sea View',
                'desc' => '1 Queen Bed, Balkon/teras, pemandangan laut, fasilitas lengkap.',
                'price' => 65
            ],
            [
                'type' => 'Two-Bedroom Townhouse',
                'desc' => '2 Full Bed, 2 kamar mandi pribadi, cocok untuk keluarga.',
                'price' => 90
            ],
        ];
        return view('booking', compact('rooms'));
    }

    public function submitForm(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'room_type' => 'required|string',
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
            'guests' => 'required|integer|min:1|max:10',
            'special_request' => 'nullable|string|max:255',
            'ktp_file' => 'required|file|mimes:jpg,png|max:2048',
            'promo_code' => 'nullable|string|max:20',
        ]);

        // Simpan file KTP
        $ktpPath = $request->file('ktp_file')->storeAs('public/ktp', Str::random(10) . '.' . $request->file('ktp_file')->getClientOriginalExtension());
        $ktpFile = basename($ktpPath);

        // Simpan ke bookings.json
        $booking = [
            'id' => time(),
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'room_type' => $validated['room_type'],
            'check_in' => $validated['check_in'],
            'check_out' => $validated['check_out'],
            'guests' => $validated['guests'],
            'special_request' => $validated['special_request'] ?? '',
            'ktp_file' => $ktpFile,
            'promo_code' => $validated['promo_code'] ?? '',
            'status' => 'confirmed',
            'created_at' => now()->toDateTimeString(),
        ];
        $file = storage_path('app/data/bookings.json');
        $bookings = file_exists($file) ? json_decode(file_get_contents($file), true) : [];
        $bookings[] = $booking;
        file_put_contents($file, json_encode($bookings, JSON_PRETTY_PRINT));

        // Kirim email konfirmasi (dummy, bisa pakai mail() atau Mail::to())
        // mail($booking['email'], 'Booking Confirmation', 'Terima kasih sudah booking di Green Point Retreats!');

        return redirect()->route('booking.form')->with('success', 'Booking berhasil! Konfirmasi dikirim ke email Anda.');
    }
} 