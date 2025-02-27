<?php

namespace App\Http\Controllers;

use App\Models\OrderHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\TotalSales;
use App\Models\Keranjang;
use Illuminate\Support\Facades\Auth;


class OrderHistoryController extends Controller
{
    public function index()
    {
        $orders = OrderHistory::where('user_id', Auth::id())->with('product')->get();
        return view('order_history.index', compact('orders'));
    }

    public function store()
    {
        $keranjangs = Keranjang::where('user_id', Auth::id())->get();

        if ($keranjangs->isEmpty()) {
            return response()->json(['error' => 'Keranjang kosong, tidak ada pesanan yang diproses.'], 400);
        }

        foreach ($keranjangs as $keranjang) {
            // Simpan ke order history
            OrderHistory::create([
                'user_id' => $keranjang->user_id,
                'product_id' => $keranjang->product_id,
                'quantity' => $keranjang->quantity,
                'price' => $keranjang->price
            ]);

            // Simpan ke total sales
            TotalSales::updateOrCreate(
                ['product_id' => $keranjang->product_id],
                [
                    'total_sold' => DB::raw('total_sold + ' . $keranjang->quantity),
                    'total_revenue' => DB::raw('total_revenue + ' . ($keranjang->quantity * $keranjang->price))
                ]
            );
        }

        Keranjang::where('user_id', Auth::id())->delete();

        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        // Cari order berdasarkan ID dan hapus
        $order = OrderHistory::findOrFail($id);
        $order->delete();

        // Jika request adalah AJAX, kembalikan respons JSON
        if (\Illuminate\Support\Facades\Request::ajax()) {
            return response()->json(['success' => 'Produk dihapus dari Wishlist!']);
        }

        // Jika bukan AJAX, kembalikan ke halaman sebelumnya dengan pesan sukses
        return back()->with('success', 'Order berhasil dihapus!');
    }
}
