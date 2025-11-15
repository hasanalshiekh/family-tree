<?php

namespace App\Http\Controllers;

use App\Models\Family;

use App\Http\Controllers\Controller;
use App\Models\FamilyMember;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;

class FamilyController extends Controller
{
    public function index()
    {
        $families = Family::all();
        return response()->json($families);
    }

    public function storeApi(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        $family = Family::create($request->only(['name', 'description']));

        return response()->json($family, 201);
    }

    public function show($id)
    {
        $family = Family::findOrFail($id);
        return response()->json($family);
    }

    public function update(Request $request, $id)
    {
        $family = Family::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        $family->update($request->only(['name', 'description']));

        return response()->json($family);
    }

    public function destroy($id)
    {
        $family = Family::findOrFail($id);
        $family->delete();

        return response()->json(['message' => 'Family deleted successfully']);
    }
}