<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Buzzer;
use Illuminate\Http\Request;

class BuzzerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Mengambil semua data buzzer dari database
        $buzzers = Buzzer::all();

        // Mengubah format status sesuai dengan nilai value
        foreach ($buzzers as $buzzer) {
            $buzzer->status = $buzzer->value ? 'Bahaya' : 'Aman';
        }

        // Mengembalikan data dalam format JSON
        return response()->json([
            'data' => $buzzers,
            'message' => 'Success'
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi input request
        $request->validate([
            'value' => 'required|boolean',
        ]);

        // Menentukan status berdasarkan nilai input
        $status = $request->value ? 'Bahaya' : 'Aman';

        // Menyimpan data ke database
        $buzzer = Buzzer::create([
            'value' => $request->value,
            'status' => $status
        ]);

        // Mengembalikan response dalam format JSON
        return response()->json([
            'data' => $buzzer,
            'message' => 'Data saved successfully'
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function show(string $id)
    {
        // Mencari data berdasarkan ID
        $buzzer = Buzzer::find($id);

        if (!$buzzer) {
            // Jika data tidak ditemukan, kembalikan response dengan pesan error
            return response()->json([
                'message' => 'Data not found'
            ], 404);
        }

        // Mengembalikan response dalam format JSON
        return response()->json([
            'data' => $buzzer,
            'message' => 'Success'
        ], 200);
    }

    // Metode edit tidak diimplementasikan
    public function edit(string $id)
    {
        // Method not implemented
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, string $id)
    {
        // Mencari data berdasarkan ID
        $buzzer = Buzzer::find($id);

        if (!$buzzer) {
            // Jika data tidak ditemukan, kembalikan response dengan pesan error
            return response()->json([
                'message' => 'Buzzer not found'
            ], 404);
        }

        // Validasi input request
        $request->validate([
            'value' => 'boolean',
        ]);

        // Menentukan status berdasarkan nilai input
        $status = $request->value ? 'Bahaya' : 'Aman';

        // Update data buzzer
        $buzzer->update([
            'value' => $request->value,
            'status' => $status
        ]);

        // Mengembalikan response dalam format JSON
        return response()->json([
            'data' => $buzzer,
            'message' => 'Buzzer updated successfully'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $id)
    {
        // Mencari data berdasarkan ID
        $buzzer = Buzzer::find($id);

        if (!$buzzer) {
            // Jika data tidak ditemukan, kembalikan response dengan pesan error
            return response()->json([
                'message' => 'Buzzer not found'
            ], 404);
        }

        // Hapus data buzzer
        $buzzer->delete();

        // Mengembalikan response dalam format JSON
        return response()->json([
            'message' => 'Buzzer deleted successfully'
        ], 200);
    }
}
