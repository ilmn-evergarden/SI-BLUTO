<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index(Request $request)
    {
        $query = User::where('role', 'aparat_desa');

        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        $aparats = $query->get();

        return view('kepala.aparat', compact('aparats'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'role' => 'aparat_desa'
        ]);

        return back()->with('success', 'Aparat berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required|email'
        ]);

        $aparat = User::findOrFail($id);

        $aparat->name = $request->name;
        $aparat->email = $request->email;

        /* jika password diisi maka ganti password */

        if ($request->password) {

            $aparat->password = $request->password;
        }

        $aparat->save();

        return back()->with('success', 'Data aparat berhasil diperbarui');
    }

    public function destroy($id)
    {

        User::findOrFail($id)->delete();

        return back()->with('success', 'Aparat berhasil dihapus');
    }
}
