<?php

namespace App\Http\Controllers;

use App\Models\RumahSakit;
use Illuminate\Http\Request;

class RumahSakitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $rumahSakits = RumahSakit::all();
        if ($request->ajax()) {
            return view('rumah-sakit.table', compact('rumahSakits'))->render();
        }
        return view('rumah-sakit.index', compact('rumahSakits'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_rumah_sakit' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telepon' => 'required|numeric|digits_between:10,12',
        ]);
        $rs = RumahSakit::create($validated);
        return response()->json($rs, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $rs = RumahSakit::findOrFail($id);
        return response()->json($rs);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'nama_rumah_sakit' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telepon' => 'required|numeric|digits_between:10,15',
        ]);
        $rs = RumahSakit::findOrFail($id);
        $rs->update($validated);
        return response()->json($rs);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $rs = RumahSakit::findOrFail($id);
        return response()->json($rs);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $rs = RumahSakit::findOrFail($id);
        $rs->delete();
        return response()->json(['success' => true]);
    }
}
