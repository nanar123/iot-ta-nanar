<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Rain;
use App\Service\WaNotifService;
use Illuminate\Http\Request;

class RainController extends Controller
{
    public function index()
{
    // Mengambil 7 data terbaru dari tabel rains
    $rains = Rain::orderBy('created_at', 'desc')
        ->limit(7)
        ->get(); // tambahkan get() untuk menjalankan query

    // Mengembalikan response dalam format JSON
    return response()->json([
        'data' => $rains,
        'message' => 'Success'
    ], 200);
}


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input request
        $request->validate([
            'value' => 'required|in:0,1'
        ]);

        // Menentukan status berdasarkan nilai input
        $value = $request->input('value');
        $weather = $value == 1 ? 'Hujan' : 'Cerah';

        // Menyimpan data ke database
        $rain = Rain::create([
            'value' => $value,
            'weather' => $weather
        ]);


        WaNotifService::notifikasiSensorMassal
        ($request->value, 'rain');

        // Mengembalikan response dalam format JSON
        return response()->json([
            'data' => $rain,
            'message' => 'Data saved successfully'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Mencari data berdasarkan ID
        $rain = Rain::find($id);

        if ($rain) {
            // Jika data ditemukan, kembalikan response dalam format JSON
            return response()->json([
                'data' => $rain,
                'message' => 'Success'
            ], 200);
        }

        // Jika data tidak ditemukan, kembalikan response dengan pesan error
        return response()->json([
            'message' => 'Data not found'
        ], 404);
    }

    // Metode edit tidak diimplementasikan
    public function edit(string $id)
    {
        // Method not implemented
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Method not implemented
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Method not implemented
    }
}
