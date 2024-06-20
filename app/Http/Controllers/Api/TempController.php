<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Temp;
use App\Service\WaNotifService;
use Illuminate\Http\Request;

class TempController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil 7 data terbaru dari tabel temperature_humidity
        $data = Temp::orderBy('created_at', 'desc')
            ->limit(7)
            ->get(); // tambahkan get() untuk menjalankan query

        // Mengembalikan response dalam format JSON
        return response()->json([
            'data' => $data,
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
            'temperature' => 'required|numeric',
            'humidity' => 'required|numeric'
        ]);

        // Menyimpan data ke database
        $data = Temp::create([
            'temperature' => $request->input('temperature'),
            'humidity' => $request->input('humidity')
        ]);


        // Untuk sensor suhu
        WaNotifService::notifikasiSensorMassal($request->value, 'temperature');

        // Untuk sensor kelembaban
        WaNotifService::notifikasiSensorMassal($request->value, 'humidity');


        // Mengembalikan response dalam format JSON
        return response()->json([
            'data' => $data,
            'message' => 'Data saved successfully'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Mencari data berdasarkan ID
        $data = Temp::find($id);

        if ($data) {
            // Jika data ditemukan, kembalikan response dalam format JSON
            return response()->json([
                'data' => $data,
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
