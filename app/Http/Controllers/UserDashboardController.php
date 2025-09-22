<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    // tampilkan dashboard user
    public function index()
    {
        $barang = Barang::all();
        return view('user.index', compact('barang'));
    }

    public function myBooking()
    {
        $user = Auth::user();
        
        $bookings = $user->bookings;  // relasi hasMany di model User
        
        return view('user.my-booking', compact('bookings'));
    }

    public function show($id)
    {
        $barang = Barang::findOrFail($id);
        return view('user.detail-barang', compact('barang'));
    }

}
