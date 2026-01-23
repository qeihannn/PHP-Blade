<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aspirasi;
use App\Models\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class ResponseController extends Controller
{
    public function store(Request $request, Aspirasi $aspirasi) {
        // Validasi input, memastikan pesan tidak kosong
        $request->validate(['message' => 'required']);

        /* Cek apakah pengguna adalah 'user'
           dan mencoba membalas aspirasi milik orang lain */
        if (Auth::user()->role == 'user'
        && $aspirasi->user_id !== Auth::id()) {
            // Menghentikan eksekusi dan menampilkan error 403 (Forbidden)
            abort(403);
        }

        // Menyimpan balasan ke dalam database
        Response::create([
            // Menghubungkan balasan dengan aspirasi yang bersangkutan
            'aspirasi_id' => $aspirasi->id,
            // Menghubungkan balasan dengan pengguna yang mengirim
            'user_id' => Auth::id(),
            // Menyimpan isi pesan dari pengguna
            'message' => $request->message,
        ]);

        // Redirect kembali ke halaman detail aspirasi dengan pesan sukses
        return redirect()->route('aspirasis.show', $aspirasi)->with('success',
        'Balasan dikirim.');
    }
    
}
