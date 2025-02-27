<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlist = Wishlist::where('user_id', Auth::id())->with('product')->get();
        return view('wishlist.index', compact('wishlist'));
    }

    public function store(Request $request)
    {
        Wishlist::create([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id
        ]);

        return back()->with('success', 'Produk ditambahkan ke Wishlist!');
    }

    public function destroy($id)
    {
        Wishlist::where('id', $id)->delete();

        // Jika request adalah AJAX, kembalikan respons JSON
        if (\Illuminate\Support\Facades\Request::ajax()) {
            return response()->json(['success' => 'Produk dihapus dari Wishlist!']);
        }

        // Jika bukan AJAX, kembalikan ke halaman sebelumnya dengan pesan sukses
        return back()->with('success', 'Produk dihapus dari Wishlist!');
    }

    public function checkWishlist($productId)
    {
        $isInWishlist = Wishlist::where('user_id', Auth::id())
            ->where('product_id', $productId)
            ->exists();

        return response()->json(['isInWishlist' => $isInWishlist]);
    }
}
