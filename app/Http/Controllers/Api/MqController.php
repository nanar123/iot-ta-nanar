<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Mq;
use App\Service\WaNotifService;
use Illuminate\Http\Request;

class MqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Mq::orderBy('created_at', 'desc')->limit(7)->get();

        return response()->json([
            'data' => $data,
            'message' => 'Success'
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input request
        $request->validate([
            'value' => 'required|numeric|min:0|max:300'
        ]);

        // Menentukan status berdasarkan nilai input
        $value = $request->input('value');
        if ($value >= 0 && $value <= 130) {
            $status = 'normal';
        } elseif ($value >= 131 && $value <= 250) {
            $status = 'sedang';
        } elseif ($value >= 251 && $value <= 300) {
            $status = 'tinggi';
        } else {
            $status = 'tidak valid'; // Penanganan nilai di luar rentang, meskipun validasi sudah membatasi
        }

        // Menyimpan data ke database
        $data = Mq::create([
            'value' => $value,
            'status' => $status
        ]);

        // Mengirim notifikasi
        WaNotifService::notifikasiSensorMassal($value, 'mq');

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
        $data = Mq::find($id);

        if ($data) {
            return response()->json([
                'data' => $data,
                'message' => 'Success'
            ], 200);
        }

        return response()->json([
            'message' => 'Data not found'
        ], 404);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // $data = Mq::find($id);

        // if ($data) {
        //     $request->validate([
        //         'value' => 'required|numeric',
        //         'status' => 'nullable|in:normal,tinggi'
        //     ]);

        //     $data->update([
        //         'value' => $request->input('value', $data->value),
        //         'status' => $request->input('status', $data->status)
        //     ]);

        //     return response()->json([
        //         'data' => $data,
        //         'message' => 'Data updated successfully'
        //     ], 200);
        // }

        // return response()->json([
        //     'message' => 'Data not found'
        // ], 404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // $data = Mq::find($id);

        // if ($data) {
        //     $data->delete();

        //     return response()->json([
        //         'message' => 'Data deleted successfully'
        //     ], 200);
        // }

        // return response()->json([
        //     'message' => 'Data not found'
        // ], 404);
    }
}
