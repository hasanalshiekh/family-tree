<?php

namespace App\Http\Controllers;

use App\Models\Family;
use App\Models\FamilyMember;
use Illuminate\Http\Request;

class FamilyMemberController extends Controller
{
    /**
     * عرض نموذج إضافة عضو جديد
     */
    public function create($familyId)
    {
        $family = Family::findOrFail($familyId);
        
        if (!$family->canAddMoreMembers()) {
            return redirect()->back()->with('error', 'لا يمكن إضافة أكثر من 5 أسماء في النسخة المجانية');
        }
        
        $members = $family->members;
        
        return view('family.member.create', compact('family', 'members'));
    }

    /**
     * حفظ عضو جديد
     */
    public function store(Request $request, $familyId)
    {
        $family = Family::findOrFail($familyId);
        
        if (!$family->canAddMoreMembers()) {
            return redirect()->back()->with('error', 'لا يمكن إضافة أكثر من 5 أسماء في النسخة المجانية');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'arabic_name' => 'nullable|string|max:255',
            'gender' => 'required|in:male,female',
            'birth_date' => 'nullable|date',
            'death_date' => 'nullable|date|after:birth_date',
            'relationship' => 'nullable|string|max:255',
            'father_id' => 'nullable|exists:family_members,id',
            'mother_id' => 'nullable|exists:family_members,id',
            'notes' => 'nullable|string|max:1000',
        ]);

        // حساب الجيل
        $generation = 1;
        if ($request->father_id) {
            $father = FamilyMember::find($request->father_id);
            $generation = $father->generation + 1;
        } elseif ($request->mother_id) {
            $mother = FamilyMember::find($request->mother_id);
            $generation = $mother->generation + 1;
        }

        FamilyMember::create([
            'family_id' => $familyId,
            'name' => $request->name,
            'arabic_name' => $request->arabic_name,
            'gender' => $request->gender,
            'birth_date' => $request->birth_date,
            'death_date' => $request->death_date,
            'relationship' => $request->relationship,
            'father_id' => $request->father_id,
            'mother_id' => $request->mother_id,
            'notes' => $request->notes,
            'generation' => $generation,
        ]);

        return redirect()->route('family.dashboard', $familyId)
                        ->with('success', 'تم إضافة العضو بنجاح!');
    }

    /**
     * عرض نموذج تعديل عضو
     */
    public function edit($familyId, $memberId)
    {
        $family = Family::findOrFail($familyId);
        $member = FamilyMember::findOrFail($memberId);
        $members = $family->members;
        
        return view('family.member.edit', compact('family', 'member', 'members'));
    }

    /**
     * تحديث عضو
     */
    public function update(Request $request, $familyId, $memberId)
    {
        $family = Family::findOrFail($familyId);
        $member = FamilyMember::findOrFail($memberId);

        $request->validate([
            'name' => 'required|string|max:255',
            'arabic_name' => 'nullable|string|max:255',
            'gender' => 'required|in:male,female',
            'birth_date' => 'nullable|date',
            'death_date' => 'nullable|date|after:birth_date',
            'relationship' => 'nullable|string|max:255',
            'father_id' => 'nullable|exists:family_members,id',
            'mother_id' => 'nullable|exists:family_members,id',
            'notes' => 'nullable|string|max:1000',
        ]);

        // حساب الجيل الجديد
        $generation = 1;
        if ($request->father_id) {
            $father = FamilyMember::find($request->father_id);
            $generation = $father->generation + 1;
        } elseif ($request->mother_id) {
            $mother = FamilyMember::find($request->mother_id);
            $generation = $mother->generation + 1;
        }

        $member->update([
            'name' => $request->name,
            'arabic_name' => $request->arabic_name,
            'gender' => $request->gender,
            'birth_date' => $request->birth_date,
            'death_date' => $request->death_date,
            'relationship' => $request->relationship,
            'father_id' => $request->father_id,
            'mother_id' => $request->mother_id,
            'notes' => $request->notes,
            'generation' => $generation,
        ]);

        return redirect()->route('family.dashboard', $familyId)
                        ->with('success', 'تم تحديث بيانات العضو بنجاح!');
    }

    /**
     * حذف عضو
     */
    public function destroy($familyId, $memberId)
    {
        $member = FamilyMember::findOrFail($memberId);
        $member->delete();

        return redirect()->route('family.dashboard', $familyId)
                        ->with('success', 'تم حذف العضو بنجاح!');
    }
}
