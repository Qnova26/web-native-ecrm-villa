<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    private $adminUser = 'admin@greenpoint.com';
    private $adminPass = 'admin123'; // Untuk demo, sebaiknya gunakan env di produksi

    public function showLogin()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if ($request->email === $this->adminUser && $request->password === $this->adminPass) {
            session(['admin_logged_in' => true]);
            return redirect()->route('admin.dashboard');
        }
        return back()->withErrors(['email' => 'Login gagal!']);
    }

    public function logout()
    {
        session()->forget('admin_logged_in');
        return redirect()->route('user.login');
    }

    public function dashboard()
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') return redirect()->route('user.login');
        $bookings = $this->getJson('bookings');
        $guests = $this->getJson('guests');
        $feedback = $this->getJson('feedback');
        $promo = $this->getJson('promo');
        return view('admin.dashboard', compact('bookings', 'guests', 'feedback', 'promo'));
    }

    public function bookings() {
        if (!Auth::check() || Auth::user()->role !== 'admin') return redirect()->route('user.login');
        $bookings = $this->getJson('bookings');
        return view('admin.bookings', compact('bookings'));
    }
    public function guests() {
        if (!Auth::check() || Auth::user()->role !== 'admin') return redirect()->route('user.login');
        $guests = $this->getJson('guests');
        return view('admin.guests', compact('guests'));
    }
    public function feedback() {
        if (!Auth::check() || Auth::user()->role !== 'admin') return redirect()->route('user.login');
        $feedback = $this->getJson('feedback');
        return view('admin.feedback', compact('feedback'));
    }
    public function promo() {
        if (!Auth::check() || Auth::user()->role !== 'admin') return redirect()->route('user.login');
        $promo = $this->getJson('promo');
        return view('admin.promo', compact('promo'));
    }

    // Dummy lupa password (hanya tampilkan pesan sukses)
    public function showForgot() {
        return view('admin.forgot');
    }
    public function forgot(Request $request) {
        $request->validate(['email' => 'required|email']);
        if ($request->email === $this->adminUser) {
            // Kirim email reset password (dummy)
            // Mail::to($request->email)->send(...)
            return back()->with('success', 'Link reset password telah dikirim ke email admin!');
        }
        return back()->withErrors(['email' => 'Email tidak ditemukan!']);
    }

    // Booking: Hapus
    public function deleteBooking($id) {
        if (!Auth::check() || Auth::user()->role !== 'admin') return redirect()->route('user.login');
        $file = storage_path('app/data/bookings.json');
        $bookings = file_exists($file) ? json_decode(file_get_contents($file), true) : [];
        $bookings = array_filter($bookings, fn($b) => $b['id'] != $id);
        file_put_contents($file, json_encode(array_values($bookings), JSON_PRETTY_PRINT));
        return back()->with('success', 'Booking berhasil dihapus!');
    }

    // Feedback: Approve
    public function approveFeedback($id) {
        if (!Auth::check() || Auth::user()->role !== 'admin') return redirect()->route('user.login');
        $file = storage_path('app/data/feedback.json');
        $feedbacks = file_exists($file) ? json_decode(file_get_contents($file), true) : [];
        foreach ($feedbacks as &$f) {
            if ($f['id'] == $id) $f['approved'] = true;
        }
        file_put_contents($file, json_encode($feedbacks, JSON_PRETTY_PRINT));
        return back()->with('success', 'Feedback berhasil di-approve!');
    }

    // Feedback: Hapus
    public function deleteFeedback($id) {
        if (!Auth::check() || Auth::user()->role !== 'admin') return redirect()->route('user.login');
        $file = storage_path('app/data/feedback.json');
        $feedbacks = file_exists($file) ? json_decode(file_get_contents($file), true) : [];
        $feedbacks = array_filter($feedbacks, fn($f) => $f['id'] != $id);
        file_put_contents($file, json_encode(array_values($feedbacks), JSON_PRETTY_PRINT));
        return back()->with('success', 'Feedback berhasil dihapus!');
    }

    // Promo: Tambah
    public function addPromo(Request $request) {
        if (!Auth::check() || Auth::user()->role !== 'admin') return redirect()->route('user.login');
        $validated = $request->validate([
            'code' => 'required|string|max:20|unique_promo',
            'description' => 'required|string|max:100',
            'discount' => 'required|integer|min:1|max:100',
        ]);
        $file = storage_path('app/data/promo.json');
        $promos = file_exists($file) ? json_decode(file_get_contents($file), true) : [];
        $promos[] = [
            'id' => time(),
            'code' => strtoupper($validated['code']),
            'description' => $validated['description'],
            'discount' => $validated['discount'],
            'active' => true
        ];
        file_put_contents($file, json_encode($promos, JSON_PRETTY_PRINT));
        return back()->with('success', 'Promo berhasil ditambahkan!');
    }

    // Promo: Edit
    public function editPromo(Request $request, $id) {
        if (!Auth::check() || Auth::user()->role !== 'admin') return redirect()->route('user.login');
        $validated = $request->validate([
            'description' => 'required|string|max:100',
            'discount' => 'required|integer|min:1|max:100',
            'active' => 'required|boolean',
        ]);
        $file = storage_path('app/data/promo.json');
        $promos = file_exists($file) ? json_decode(file_get_contents($file), true) : [];
        foreach ($promos as &$p) {
            if ($p['id'] == $id) {
                $p['description'] = $validated['description'];
                $p['discount'] = $validated['discount'];
                $p['active'] = $validated['active'];
            }
        }
        file_put_contents($file, json_encode($promos, JSON_PRETTY_PRINT));
        return back()->with('success', 'Promo berhasil diedit!');
    }

    // Promo: Hapus
    public function deletePromo($id) {
        if (!Auth::check() || Auth::user()->role !== 'admin') return redirect()->route('user.login');
        $file = storage_path('app/data/promo.json');
        $promos = file_exists($file) ? json_decode(file_get_contents($file), true) : [];
        $promos = array_filter($promos, fn($p) => $p['id'] != $id);
        file_put_contents($file, json_encode(array_values($promos), JSON_PRETTY_PRINT));
        return back()->with('success', 'Promo berhasil dihapus!');
    }

    private function getJson($file) {
        $path = storage_path("app/data/{$file}.json");
        return file_exists($path) ? json_decode(file_get_contents($path), true) : [];
    }
} 