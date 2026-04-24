<?php

namespace App\Http\Controllers;

use App\Models\GuestBook;
use App\Models\LetterType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Exports\GuestExport;
use Maatwebsite\Excel\Facades\Excel;

class GuestBookController extends Controller
{
    public function index(Request $request)
    {
        $query = GuestBook::with('letterType');

        // FILTER TANGGAL
        if ($request->from && $request->to) {
            $query->whereBetween('created_at', [
                $request->from,
                $request->to
            ]);
        }

        // SORTING
        if ($request->sort == 'oldest') {
            $query->oldest();
        } else {
            $query->latest(); // default
        }

        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('purpose', 'like', '%' . $request->search . '%');
            });
        }

        $guests = $query->paginate(10);

        return view('guest.index', compact('guests'));
    }

    public function indexKepala(Request $request)
    {
        $guests = $this->queryData($request)
            ->paginate(10)
            ->withQueryString();

        return view('kepala.buku_tamu', compact('guests'));
    }

    private function getFilteredData($request)
    {
        $query = GuestBook::with('letterType');

        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->start_date) {
            $query->whereDate('visit_date', '>=', $request->start_date);
        }

        if ($request->end_date) {
            $query->whereDate('visit_date', '<=', $request->end_date);
        }

        return $query;
    }

    public function create()
    {
        $letterTypes = LetterType::all();

        return view('guest.create', compact('letterTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',

            'letter_type_id' => 'nullable',
            'custom_letter_type' => 'nullable',

        ], [
            'name.required' => 'Nama wajib diisi',
        ]);

        // VALIDASI LOGIKA
        if (!$request->letter_type_id && !$request->custom_letter_type) {
            return back()->withErrors([
                'letter_type' => 'Pilih atau isi jenis surat'
            ]);
        }

        if ($request->letter_type_id && $request->custom_letter_type) {
            return back()->withErrors([
                'letter_type' => 'Pilih salah satu saja (dropdown ATAU manual)'
            ]);
        }

        GuestBook::create([
            'name' => $request->name,
            'institution' => $request->institution,
            'purpose' => $request->purpose,
            'phone' => $request->phone,
            'visit_date' => $request->visit_date,

            'letter_type_id' => $request->letter_type_id ?: null,
            'custom_letter_type' => $request->custom_letter_type,
            'letter_number' => $request->letter_number,

            'created_by' => Auth::id()
        ]);



        return redirect()->route('guest.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $guest = GuestBook::findOrFail($id);
        $letterTypes = LetterType::all();

        return view('guest.edit', compact('guest', 'letterTypes'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required'
        ]);

        if (!$request->letter_type_id && !$request->custom_letter_type) {
            return back()->withErrors([
                'letter_type' => 'Pilih atau isi jenis surat'
            ]);
        }

        if ($request->letter_type_id && $request->custom_letter_type) {
            return back()->withErrors([
                'letter_type' => 'Pilih salah satu saja'
            ]);
        }

        $guest = GuestBook::findOrFail($id);

        $guest->update([
            'name' => $request->name,
            'institution' => $request->institution,
            'purpose' => $request->purpose,
            'phone' => $request->phone,
            'visit_date' => $request->visit_date,
            'letter_type_id' => $request->letter_type_id ?: null,
            'custom_letter_type' => $request->custom_letter_type,
            'letter_number' => $request->letter_number,
        ]);

        return redirect()->route('guest.index')->with('success', 'Data diperbarui');
    }

    private function queryData($request)
    {
        $query = GuestBook::with('letterType');

        // 🔍 SEARCH
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('purpose', 'like', '%' . $request->search . '%');
            });
        }

        // 📅 FILTER TANGGAL
        if ($request->from) {
            $query->whereDate('visit_date', '>=', $request->from);
        }

        if ($request->to) {
            $query->whereDate('visit_date', '<=', $request->to);
        }

        // ⬆⬇ SORT
        if ($request->sort == 'oldest') {
            $query->oldest();
        } else {
            $query->latest();
        }

        return $query;
    }

    public function export(Request $request)
    {
        return Excel::download(
            new GuestExport($this->queryData($request)->get()),
            'guest_book.xlsx'
        );
    }

    public function chart(Request $request)
    {
        $year = $request->year ?? now()->year;

        $data = GuestBook::selectRaw('MONTH(visit_date) as month, COUNT(*) as total')
            ->whereYear('visit_date', $year)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // mapping bulan lengkap (biar tidak bolong)
        $months = [
            1 => 'Jan',
            2 => 'Feb',
            3 => 'Mar',
            4 => 'Apr',
            5 => 'Mei',
            6 => 'Jun',
            7 => 'Jul',
            8 => 'Agu',
            9 => 'Sep',
            10 => 'Okt',
            11 => 'Nov',
            12 => 'Des'
        ];

        $labels = [];
        $values = [];

        for ($i = 1; $i <= 12; $i++) {
            $labels[] = $months[$i];

            $found = $data->firstWhere('month', $i);
            $values[] = $found ? $found->total : 0;
        }

        return response()->json([
            'labels' => $labels,
            'values' => $values
        ]);
    }
}
