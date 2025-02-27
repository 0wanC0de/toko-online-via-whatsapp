<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Keranjang;
use App\Models\Product;
use App\Models\TotalSales;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }

    public function totalUsers()
    {
        $users = User::all();
        return view('total_users', compact('users'));
    }


    public function totalSales()
    {
        // Menggunakan model TotalSales dengan relasi product
        $sales = TotalSales::with('product')->get();

        // Menghitung total quantity sold dan total revenue
        $totalSold = $sales->sum('total_sold');
        $totalRevenue = $sales->sum('total_revenue');

        return view('total_sales', compact('sales', 'totalSold', 'totalRevenue'));
    }
}
