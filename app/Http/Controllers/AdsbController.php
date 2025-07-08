<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdsbData;
use Illuminate\Validation\ValidationException;

class AdsbController extends Controller
{
    public function store(Request $request)
    {
        try {
            // ✅ Validasi data dari request
            $validated = $request->validate([
                'callsign' => 'nullable|string|max:50',
                'lat'      => 'required|numeric|between:-90,90',
                'lon'      => 'required|numeric|between:-180,180',
                'altitude' => 'nullable|integer',
                'speed'    => 'nullable|integer',
                'heading'  => 'nullable|integer',
            ]);

            // ✅ Simpan data ke database
            AdsbData::create($validated);

            // ✅ Response sukses JSON
            return response()->json([
                'message' => 'Data berhasil disimpan',
            ], 201);
        } catch (ValidationException $e) {
            // ✅ Kalau validasi gagal, balas JSON error 422
            return response()->json([
                'message' => 'Validasi gagal',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            // ✅ Kalau error umum, balas JSON error 500
            return response()->json([
                'message' => 'Gagal menyimpan data',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
