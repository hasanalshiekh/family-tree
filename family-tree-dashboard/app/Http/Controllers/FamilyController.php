<?php

namespace App\Http\Controllers;

use App\Models\Family;
use App\Models\FamilyMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Routing\Controller;

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

    public function create()
    {
        return view('family.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        $family = Family::create($request->only(['name', 'description']));

        return redirect()->route('family.dashboard', $family->id)
            ->with('success', 'تم إنشاء العائلة بنجاح!');
    }

    public function dashboard($id)
    {
        $family = Family::with('members')->findOrFail($id);
        $members = $family->members()->orderBy('generation')->orderBy('name')->get();

        return view('family.dashboard', compact('family', 'members'));
    }

    public function tree($id)
    {
        $family = Family::with('members')->findOrFail($id);
        $members = $family->members()->orderBy('generation')->orderBy('name')->get();

        return view('family.tree', compact('family', 'members'));
    }

    public function share($token)
    {
        $family = Family::where('share_token', $token)->with('members')->firstOrFail();
        $members = $family->members()->orderBy('generation')->orderBy('name')->get();

        return view('family.share', compact('family', 'members'));
    }

    public function exportPdf($id)
    {
        $family = Family::with('members')->findOrFail($id);
        $members = $family->members()->orderBy('generation')->orderBy('name')->get();

        $pdf = Pdf::loadView('family.pdf', compact('family', 'members'));
        $filename = 'family-tree-' . $family->name . '.pdf';

        return $pdf->download($filename);
    }

    public function shareData($token)
    {
        $family = Family::where('share_token', $token)->with('members')->firstOrFail();
        $members = $family->members()->orderBy('generation')->orderBy('name')->get();

        return response()->json([
            'family' => $family,
            'members' => $members
        ]);
    }
}
