<?php

namespace App\Http\Controllers;

use App\Models\Family;
use App\Models\FamilyMember;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class FamilyMemberController extends Controller
{
    /**
     * الحصول على جميع أعضاء العائلة
     */
    public function index($familyId)
    {
        $members = FamilyMember::where('family_id', $familyId)
                               ->orderBy('generation')
                               ->orderBy('name')
                               ->get();
        return response()->json($members);
    }

    /**
     * الحصول على عضو معين
     */
    public function show($familyId, $id)
    {
        $member = FamilyMember::where('family_id', $familyId)
                             ->findOrFail($id);
        return response()->json($member);
    }

    /**
     * إضافة عضو جديد (API)
     */
    public function storeApi(Request $request, $familyId)
    {
        $family = Family::findOrFail($familyId);
        
        if (!$family->canAddMoreMembers()) {
            return response()->json(['error' => 'لا يمكن إضافة أكثر من 5 أسماء في النسخة المجانية'], 403);
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

        $generation = 1;
        if ($request->father_id) {
            $father = FamilyMember::find($request->father_id);
            $generation = $father->generation + 1;
        } elseif ($request->mother_id) {
            $mother = FamilyMember::find($request->mother_id);
            $generation = $mother->generation + 1;
        }

        $member = FamilyMember::create([
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

        return response()->json($member, 201);
    }

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
     * تحديث عضو (API)
     */
    public function updateApi(Request $request, $familyId, $id)
    {
        $member = FamilyMember::where('family_id', $familyId)->findOrFail($id);
        
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

        $generation = 1;
        if ($request->father_id) {
            $father = FamilyMember::find($request->father_id);
            $generation = $father->generation + 1;
        } elseif ($request->mother_id) {
            $mother = FamilyMember::find($request->mother_id);
            $generation = $mother->generation + 1;
        }

        $member->update(array_merge($request->all(), ['generation' => $generation]));
        
        return response()->json($member, 200);
    }

    /**
     * حذف عضو (API)
     */
    public function destroyApi($familyId, $id)
    {
        $member = FamilyMember::where('family_id', $familyId)->findOrFail($id);
        $member->delete();

        return response()->json(['message' => 'تم حذف العضو بنجاح'], 200);
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
