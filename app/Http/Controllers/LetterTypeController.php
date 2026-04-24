<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LetterType;


class LetterTypeController extends Controller
{

    public function index()
    {
        $letterTypes = LetterType::latest()->get();
        return view('guest.letter_type', compact('letterTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:letter_types,name'
        ]);

        LetterType::create([
            'name' => $request->name
        ]);

        return redirect()
            ->route('letter-types.manage')
            ->with('success', 'Jenis surat berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate(['name' => 'required']);

        $type = LetterType::findOrFail($id);
        $type->update(['name' => $request->name]);

        return back()->with('success', 'Jenis surat diperbarui');
    }

    public function destroy($id)
    {
        LetterType::findOrFail($id)->delete();

        return back()->with('success', 'Jenis surat dihapus');
    }
}
