<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    // 🔹 Tampilkan semua data user
    public function index()
    {
        $dataUser = User::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.user.index', compact('dataUser'));
    }

    // 🔹 Form tambah user baru
    public function create()
    {
        return view('admin.user.create');
    }

    // 🔹 Simpan user baru
    public function store(Request $request)
    {
        $request->validate([
            'name'            => 'required|string|max:255',
            'email'           => 'required|email|unique:users,email',
            'password'        => 'required|min:6',
            'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Cara Manual (Lebih aman memastikan data masuk)
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        // Upload foto jika ada
        if ($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $user->profile_picture = $path;
        }

        $user->save(); // Simpan ke database

        return redirect()->route('user.index')->with('success', 'User berhasil ditambahkan!');
    }

    // 🔹 Form edit data user
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.user.edit', compact('user'));
    }

    // 🔹 Update data user
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name'            => 'required|string|max:255',
            'email'           => 'required|email|unique:users,email,' . $id,
            'password'        => 'nullable|min:6', // Password boleh kosong saat edit
            'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // 1. Update data dasar
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;

        // 2. Cek apakah password diisi? Kalau ya, update. Kalau tidak, biarkan lama.
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // 3. Logika Upload Foto
        if ($request->hasFile('profile_picture')) {

            // Hapus foto lama jika ada & filenya eksis di storage
            if ($user->profile_picture && Storage::disk('public')->exists($user->profile_picture)) {
                Storage::disk('public')->delete($user->profile_picture);
            }

            // Simpan foto baru
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');

            // Set path baru ke database
            $user->profile_picture = $path;
        }

        $user->save(); // <--- PENTING: Method save() ini memaksa penyimpanan

        return redirect()->route('user.index')->with('success', 'User berhasil diperbarui!');
    }

    // 🔹 Hapus user
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Hapus file fisik foto jika ada
        if ($user->profile_picture && Storage::disk('public')->exists($user->profile_picture)) {
            Storage::disk('public')->delete($user->profile_picture);
        }

        $user->delete();

        return redirect()->route('user.index')->with('success', 'User berhasil dihapus!');
    }
}
