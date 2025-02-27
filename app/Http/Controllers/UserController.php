<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Menghapus pengguna berdasarkan ID.
     */
    public function destroy($id)
    {
        $user = User::find($id); // Cari pengguna berdasarkan ID
        if ($user) {
            $user->delete(); // Hapus pengguna
            return redirect()->route('total.users')->with('success', 'Pengguna berhasil dihapus.');
        }

        return redirect()->route('total.users')->with('error', 'Pengguna tidak ditemukan.');
    }
}