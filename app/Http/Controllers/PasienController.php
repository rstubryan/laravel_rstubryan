<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pasien;
use App\Models\RumahSakit;

class PasienController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $pasiens = Pasien::with('rumahSakit')->get();
        $rumahSakits = RumahSakit::all();
        if ($request->ajax()) {
            return view('pasien.table', compact('pasiens'))->render();
        }
        return view('pasien.index', compact('pasiens', 'rumahSakits'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_pasien' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'no_telpon' => 'required|numeric|digits_between:10,12',
            'rumah_sakit_id' => 'required|exists:rumah_sakit,id',
        ]);
        $pasien = Pasien::create($validated);
        return response()->json($pasien, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pasien = Pasien::with('rumahSakit')->findOrFail($id);
        return response()->json($pasien);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'nama_pasien' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'no_telpon' => 'required|numeric|digits_between:10,15',
            'rumah_sakit_id' => 'required|exists:rumah_sakit,id',
        ]);
        $pasien = Pasien::findOrFail($id);
        $pasien->update($validated);
        return response()->json($pasien);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pasien = Pasien::findOrFail($id);
        return response()->json($pasien);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pasien = Pasien::findOrFail($id);
        $pasien->delete();
        return response()->json(['success' => true]);
    }
}
