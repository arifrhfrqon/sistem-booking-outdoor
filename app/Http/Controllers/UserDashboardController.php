<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    // tampilkan dashboard user
    public function index()
    {
        return view('user.index');
    }

    // tampilkan booking milik user yang sedang login
    public function myBooking()
    {
        $user = Auth::user();
        
        $bookings = $user->bookings;  // relasi hasMany di model User
        
        return view('user.my-booking', compact('bookings'));
    }
}
