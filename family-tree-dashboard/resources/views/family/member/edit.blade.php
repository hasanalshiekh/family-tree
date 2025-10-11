@extends('layouts.app')

@section('title', 'تعديل العضو - ' . $member->getDisplayName())

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header bg-warning text-white text-center">
                <h3 class="mb-0">
                    <i class="fas fa-user-edit me-2"></i>
                    تعديل بيانات {{ $member->getDisplayName() }}
                </h3>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('family.member.update', [$family->id, $member->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <!-- Basic Info -->
                        <div class="col-md-6">
                            <h5 class="text-primary mb-3">
                                <i class="fas fa-user me-2"></i>
                                المعلومات الأساسية
                            </h5>
                            
                            <div class="mb-3">
                                <label for="name" class="form-label fw-bold">الاسم الكامل *</label>
                                <input type="text" 
                                       class="form-control @error('name') is-invalid @enderror" 
                                       id="name" 
                                       name="name" 
                                       value="{{ old('name', $member->name) }}"
                                       placeholder="مثال: أحمد محمد الأحمد"
                                       required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="arabic_name" class="form-label fw-bold">الاسم بالعربية (اختياري)</label>
                                <input type="text" 
                                       class="form-control @error('arabic_name') is-invalid @enderror" 
                                       id="arabic_name" 
                                       name="arabic_name" 
                                       value="{{ old('arabic_name', $member->arabic_name) }}"
                                       placeholder="مثال: أحمد محمد الأحمد">
                                @error('arabic_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="gender" class="form-label fw-bold">الجنس *</label>
                                <select class="form-select @error('gender') is-invalid @enderror" 
                                        id="gender" 
                                        name="gender" 
                                        required>
                                    <option value="">اختر الجنس</option>
                                    <option value="male" {{ old('gender', $member->gender) == 'male' ? 'selected' : '' }}>
                                        <i class="fas fa-male"></i> ذكر
                                    </option>
                                    <option value="female" {{ old('gender', $member->gender) == 'female' ? 'selected' : '' }}>
                                        <i class="fas fa-female"></i> أنثى
                                    </option>
                                </select>
                                @error('gender')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="relationship" class="form-label fw-bold">العلاقة العائلية</label>
                                <input type="text" 
                                       class="form-control @error('relationship') is-invalid @enderror" 
                                       id="relationship" 
                                       name="relationship" 
                                       value="{{ old('relationship', $member->relationship) }}"
                                       placeholder="مثال: جد، جدة، عم، خالة...">
                                @error('relationship')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- Family Relations -->
                        <div class="col-md-6">
                            <h5 class="text-primary mb-3">
                                <i class="fas fa-sitemap me-2"></i>
                                العلاقات العائلية
                            </h5>
                            
                            <div class="mb-3">
                                <label for="father_id" class="form-label fw-bold">الأب (اختياري)</label>
                                <select class="form-select @error('father_id') is-invalid @enderror" 
                                        id="father_id" 
                                        name="father_id">
                                    <option value="">اختر الأب</option>
                                    @foreach($members->where('gender', 'male')->where('id', '!=', $member->id) as $potentialFather)
                                        <option value="{{ $potentialFather->id }}" 
                                                {{ old('father_id', $member->father_id) == $potentialFather->id ? 'selected' : '' }}>
                                            {{ $potentialFather->getDisplayName() }} (الجيل {{ $potentialFather->generation }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('father_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="mother_id" class="form-label fw-bold">الأم (اختياري)</label>
                                <select class="form-select @error('mother_id') is-invalid @enderror" 
                                        id="mother_id" 
                                        name="mother_id">
                                    <option value="">اختر الأم</option>
                                    @foreach($members->where('gender', 'female')->where('id', '!=', $member->id) as $potentialMother)
                                        <option value="{{ $potentialMother->id }}" 
                                                {{ old('mother_id', $member->mother_id) == $potentialMother->id ? 'selected' : '' }}>
                                            {{ $potentialMother->getDisplayName() }} (الجيل {{ $potentialMother->generation }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('mother_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="birth_date" class="form-label fw-bold">تاريخ الميلاد</label>
                                        <input type="date" 
                                               class="form-control @error('birth_date') is-invalid @enderror" 
                                               id="birth_date" 
                                               name="birth_date" 
                                               value="{{ old('birth_date', $member->birth_date?->format('Y-m-d')) }}">
                                        @error('birth_date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="death_date" class="form-label fw-bold">تاريخ الوفاة</label>
                                        <input type="date" 
                                               class="form-control @error('death_date') is-invalid @enderror" 
                                               id="death_date" 
                                               name="death_date" 
                                               value="{{ old('death_date', $member->death_date?->format('Y-m-d')) }}">
                                        @error('death_date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Notes -->
                    <div class="mb-4">
                        <label for="notes" class="form-label fw-bold">
                            <i class="fas fa-sticky-note me-1"></i>
                            ملاحظات إضافية (اختياري)
                        </label>
                        <textarea class="form-control @error('notes') is-invalid @enderror" 
                                  id="notes" 
                                  name="notes" 
                                  rows="3"
                                  placeholder="أي معلومات إضافية عن هذا الشخص...">{{ old('notes', $member->notes) }}</textarea>
                        @error('notes')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <!-- Current Info -->
                    <div class="alert alert-info">
                        <h6 class="alert-heading">المعلومات الحالية:</h6>
                        <p class="mb-1"><strong>الجيل الحالي:</strong> {{ $member->generation }}</p>
                        @if($member->father)
                            <p class="mb-1"><strong>الأب:</strong> {{ $member->father->getDisplayName() }}</p>
                        @endif
                        @if($member->mother)
                            <p class="mb-1"><strong>الأم:</strong> {{ $member->mother->getDisplayName() }}</p>
                        @endif
                        @if($member->getAge())
                            <p class="mb-0"><strong>العمر:</strong> {{ $member->getAge() }} سنة</p>
                        @endif
                    </div>
                    
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('family.dashboard', $family->id) }}" class="btn btn-outline-secondary me-md-2">
                            <i class="fas fa-arrow-right me-2"></i>
                            إلغاء
                        </a>
                        <button type="submit" class="btn btn-warning">
                            <i class="fas fa-save me-2"></i>
                            حفظ التغييرات
                        </button>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Help Section -->
        <div class="card mt-4">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0">
                    <i class="fas fa-lightbulb me-2"></i>
                    نصائح للتعديل
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="text-primary">تغيير الجيل:</h6>
                        <ul class="list-unstyled">
                            <li><i class="fas fa-check text-success me-2"></i>تغيير الأب أو الأم سيؤثر على الجيل</li>
                            <li><i class="fas fa-check text-success me-2"></i>سيتم إعادة حساب الجيل تلقائياً</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-primary">العلاقات:</h6>
                        <ul class="list-unstyled">
                            <li><i class="fas fa-check text-success me-2"></i>يمكن ترك الأب والأم فارغين للجيل الأول</li>
                            <li><i class="fas fa-check text-success me-2"></i>تجنب اختيار الشخص كأب أو أم لنفسه</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
