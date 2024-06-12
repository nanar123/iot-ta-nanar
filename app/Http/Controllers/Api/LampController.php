<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Lamp;
use Illuminate\Http\Request;

class LampController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rains = Lamp::orderBy('created_at', 'desc')
            ->limit(7)
            ->get();

        return response()->json([
            'data' => $rains,
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
        $request->validate([
            'name' => 'required|string',
            'value' => 'required|boolean',
        ]);

        $lampStatus = $request->value == 1 ? 'hidup' : 'mati';

        $lamp = Lamp::create([
            'name' => $request->name,
            'value' => $request->value,
            'status' => "$lampStatus"
        ]);

        return response()->json([
            'data' => $lamp,
            'message' => 'Data saved successfully'
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lamp = Lamp::find($id);

        if (!$lamp) {
            return response()->json([
                'message' => 'Data not found'
            ], 404);
        }

        return response()->json([
            'data' => $lamp,
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'string',
            'value' => 'boolean',
        ]);

        $lamp = Lamp::find($id);

        if (!$lamp) {
            return response()->json(['message' => 'Lamp not found'], 404);
        }

        $lampStatus = $request->value == 1 ? 'hidup' : 'mati';

        $lamp->update([
            'name' => $request->name,
            'value' => $request->value,
            'status' => " {$request->value} $lampStatus"
        ]);

        return response()->json($lamp, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lamp = Lamp::find($id);

        if (!$lamp) {
            return response()->json(['message' => 'Lamp not found'], 404);
        }

        $lamp->delete();

        return response()->json(['message' => 'Lamp deleted successfully'], 200);
    }
}
