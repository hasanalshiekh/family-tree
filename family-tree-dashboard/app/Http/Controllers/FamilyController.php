<?php

namespace App\Http\Controllers;

use App\Models\Family;
use App\Models\FamilyMember;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FamilyController extends Controller
{
    /**
     * عرض صفحة إنشاء عائلة جديدة
     */
    public function create()
    {
        return view('family.create');
    }

    /**
     * حفظ عائلة جديدة
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        $family = Family::create([
            'name' => $request->name,
            'description' => $request->description,
            'share_token' => Str::random(32)
        ]);

        return redirect()->route('family.dashboard', $family->id)
                        ->with('success', 'تم إنشاء العائلة بنجاح!');
    }

    /**
     * عرض داش بورد العائلة
     */
    public function dashboard($id)
    {
        $family = Family::findOrFail($id);
        $members = $family->members()->orderBy('generation')->orderBy('name')->get();
        
        return view('family.dashboard', compact('family', 'members'));
    }

    /**
     * عرض شجرة العائلة
     */
    public function tree($id)
    {
        $family = Family::findOrFail($id);
        $members = $family->members()->orderBy('generation')->orderBy('name')->get();
        
        return view('family.tree', compact('family', 'members'));
    }

    /**
     * مشاركة العائلة
     */
    public function share($token)
    {
        $family = Family::where('share_token', $token)->firstOrFail();
        $members = $family->members()->orderBy('generation')->orderBy('name')->get();
        
        return view('family.share', compact('family', 'members'));
    }

    /**
     * تصدير PDF للشجرة
     */
    public function exportPdf($id)
    {
        $family = Family::findOrFail($id);
        $members = $family->members()->orderBy('generation')->orderBy('name')->get();
        
        // سيتم إضافة مكتبة PDF لاحقاً
        return view('family.pdf', compact('family', 'members'));
    }
}
