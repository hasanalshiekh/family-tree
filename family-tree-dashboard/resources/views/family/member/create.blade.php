@extends('layouts.app')

@section('title', 'إضافة عضو جديد - ' . $family->name)

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header bg-success text-white text-center">
                <h3 class="mb-0">
                    <i class="fas fa-user-plus me-2"></i>
                    إضافة عضو جديد إلى {{ $family->name }}
                </h3>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('family.member.store', $family->id) }}" method="POST">
                    @csrf
                    
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
                                       value="{{ old('name') }}"
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
                                       value="{{ old('arabic_name') }}"
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
                                    <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>
                                        <i class="fas fa-male"></i> ذكر
                                    </option>
                                    <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>
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
                                       value="{{ old('relationship') }}"
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
                                <label for="father_name" class="form-label fw-bold">الأب (اختياري - اكتب أو اختر)</label>
                                <input type="text"
                                       class="form-control @error('father_name') is-invalid @enderror"
                                       id="father_name"
                                       name="father_name"
                                       list="fathers"
                                       value="{{ old('father_name') }}"
                                       placeholder="اكتب اسم الأب أو اختر من القائمة">
                                <datalist id="fathers">
                                    @foreach($members->where('gender', 'male') as $member)
                                        <option value="{{ $member->getDisplayName() }}">{{ $member->getDisplayName() }} (الجيل {{ $member->generation }})</option>
                                    @endforeach
                                </datalist>
                                @error('father_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="mother_name" class="form-label fw-bold">الأم (اختياري - اكتب أو اختر)</label>
                                <input type="text"
                                       class="form-control @error('mother_name') is-invalid @enderror"
                                       id="mother_name"
                                       name="mother_name"
                                       list="mothers"
                                       value="{{ old('mother_name') }}"
                                       placeholder="اكتب اسم الأم أو اختر من القائمة">
                                <datalist id="mothers">
                                    @foreach($members->where('gender', 'female') as $member)
                                        <option value="{{ $member->getDisplayName() }}">{{ $member->getDisplayName() }} (الجيل {{ $member->generation }})</option>
                                    @endforeach
                                </datalist>
                                @error('mother_name')
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
                                               value="{{ old('birth_date') }}">
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
                                               value="{{ old('death_date') }}">
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
                                  placeholder="أي معلومات إضافية عن هذا الشخص...">{{ old('notes') }}</textarea>
                        @error('notes')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <!-- Info Alert -->
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        <strong>ملاحظة:</strong> 
                        إذا لم تختر أباً أو أماً، سيتم اعتبار هذا الشخص من الجيل الأول (جد أو جدة).
                        يمكنك تعديل هذه المعلومات لاحقاً من صفحة الداش بورد.
                    </div>
                    
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('family.dashboard', $family->id) }}" class="btn btn-outline-secondary me-md-2">
                            <i class="fas fa-arrow-right me-2"></i>
                            إلغاء
                        </a>
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save me-2"></i>
                            حفظ العضو
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
                    نصائح لإضافة الأعضاء
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="text-primary">لإضافة الجد/الجدة:</h6>
                        <ul class="list-unstyled">
                            <li><i class="fas fa-check text-success me-2"></i>اترك حقلي الأب والأم فارغين</li>
                            <li><i class="fas fa-check text-success me-2"></i>سيتم تصنيفه تلقائياً في الجيل الأول</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-primary">لإضافة الأبناء:</h6>
                        <ul class="list-unstyled">
                            <li><i class="fas fa-check text-success me-2"></i>اختر الأب والأم إذا كانا موجودين</li>
                            <li><i class="fas fa-check text-success me-2"></i>سيتم حساب الجيل تلقائياً</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
