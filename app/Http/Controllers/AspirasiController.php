<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Aspirasi;
use Illuminate\Support\Facades\Auth;


class AspirasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Daftar Aspirasi';

        $aspirasis = (Auth::user()->role == 'admin')
            ? Aspirasi::with('user')->get()
            : Aspirasi::where('user_id', Auth::id())->get();

        return view('aspirasis.index', compact('title', 'aspirasis'));
    }

    /**
     * Show the form for creating a new resource.
     */

public function create()
{
    $title = 'Tambah Aspirasi';
    $kategori = Kategori::all();
    return view('aspirasis.create', compact('title','kategori'));
}


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'kategori' => 'required',
            'description' => 'required',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5000',

        ]);

        $photoPath = null;

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('aspirasis', 'public');
        }

        Aspirasi::create([
            'user_id' => Auth::id(),
            'kategori_id' => $request->kategori_id,
            'title' => $request->title,
            'description' => $request->description,
            'photo' => $photoPath,
        ]);

        return redirect()->route('aspirasi.index')
            ->with('success', 'Aspirasi berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $title = 'Detail Aspirasi';

        $aspirasi = Aspirasi::findOrFail($id);

        if (Auth::user()->role == 'user' && $aspirasi->user_id != Auth::id()) {
            abort(403);
        }

        return view('aspirasis.show', compact('title', 'aspirasi'));
    }

    /**
     * Update aspirasi status (admin only).
     */
    public function updateStatus(Request $request, Aspirasi $aspirasi)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $aspirasi->update(['status' => $request->status]);

        return redirect()->route('aspirasis.index')
            ->with('success', 'Status aspirasi diperbarui.');
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
