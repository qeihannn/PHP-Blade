<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Aspirasi;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;



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

        return redirect()->route('aspirasi.index')
            ->with('success', 'Status aspirasi diperbarui.');
    }

    public function user()
    {
    $title = 'Kelola User';

    $users = User::where('role', '!=', 'admin')->get();

    return view('aspirasis.user', compact('users', 'title'));
    }

    public function edit(User $user)
    {
    $title = 'Edit User';
    return view('aspirasis.edit', compact('user', 'title'));    
    }


    public function update(Request $request, User $user)
{
    $request->validate([
        'name' => 'required',
        'username' => 'required',
        'nis' => 'required',
        'kelas' => 'required',
        'password' => 'nullable|confirmed|min:6',
    ]);

    $user->update([
        'name' => $request->name,
        'username' => $request->username,
        'nis' => $request->nis,
        'kelas' => $request->kelas,
    ]);

    if ($request->filled('password')) {

        if (!Hash::check($request->old_password, $user->password)) {
            return back()->withErrors([
                'old_password' => 'Password lama tidak sesuai'
            ]);
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);
    }

    return redirect()->route('aspirasi.user')
        ->with('success', 'Data user berhasil diperbarui');
}

    public function destroy(User $user)
{
    if ($user->role === 'admin') {
        return back()->with('error', 'Admin tidak boleh dihapus');
    }

    $user->delete();

    return redirect()->route('aspirasi.user')
        ->with('success', 'User berhasil dihapus');
}
}
