@extends('layouts.app')

@section('title', 'داش بورد العائلة - ' . $family->name)

@section('content')
<div class="row">
    <!-- Family Info Card -->
    <div class="col-lg-4 mb-4">
        <div class="card h-100">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">
                    <i class="fas fa-info-circle me-2"></i>
                    معلومات العائلة
                </h5>
            </div>
            <div class="card-body">
                <h4 class="text-primary">{{ $family->name }}</h4>
                @if($family->description)
                    <p class="text-muted">{{ $family->description }}</p>
                @endif
                
                <div class="row text-center mt-3">
                    <div class="col-6">
                        <div class="stats-card">
                            <div class="stats-number">{{ $family->getMembersCount() }}</div>
                            <div>عضو</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="stats-card">
                            <div class="stats-number">{{ $family->getMembersCount() }}/5</div>
                            <div>المجاني</div>
                        </div>
                    </div>
                </div>
                
                <div class="mt-3">
                    <a href="{{ route('family.tree', $family->id) }}" class="btn btn-success w-100 mb-2">
                        <i class="fas fa-sitemap me-2"></i>
                        عرض الشجرة
                    </a>
                    <a href="{{ route('family.export-pdf', $family->id) }}" class="btn btn-warning w-100 mb-2">
                        <i class="fas fa-file-pdf me-2"></i>
                        تصدير PDF
                    </a>
                    <button class="btn btn-info w-100" onclick="copyShareLink()">
                        <i class="fas fa-share-alt me-2"></i>
                        نسخ رابط المشاركة
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Members List -->
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="fas fa-users me-2"></i>
                    أعضاء العائلة
                </h5>
                @if($family->canAddMoreMembers())
                    <a href="{{ route('family.member.create', $family->id) }}" class="btn btn-primary">
                        <i class="fas fa-plus me-1"></i>
                        إضافة عضو جديد
                    </a>
                @else
                    <span class="badge bg-warning">
                        <i class="fas fa-exclamation-triangle me-1"></i>
                        الحد الأقصى (5 أسماء)
                    </span>
                @endif
            </div>
            <div class="card-body">
                @if($members->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-primary">
                                <tr>
                                    <th>الاسم</th>
                                    <th>الجنس</th>
                                    <th>الجيل</th>
                                    <th>العلاقة</th>
                                    <th>العمر</th>
                                    <th>الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($members as $member)
                                <tr>
                                    <td>
                                        <strong>{{ $member->getDisplayName() }}</strong>
                                        @if($member->arabic_name && $member->arabic_name !== $member->name)
                                            <br><small class="text-muted">{{ $member->name }}</small>
                                        @endif
                                    </td>
                                    <td>
                                        @if($member->gender === 'male')
                                            <i class="fas fa-male text-primary"></i> ذكر
                                        @else
                                            <i class="fas fa-female text-danger"></i> أنثى
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge bg-secondary">الجيل {{ $member->generation }}</span>
                                    </td>
                                    <td>
                                        @if($member->relationship)
                                            <span class="badge bg-info">{{ $member->relationship }}</span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($member->getAge())
                                            {{ $member->getAge() }} سنة
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('family.member.edit', [$family->id, $member->id]) }}" 
                                               class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('family.member.destroy', [$family->id, $member->id]) }}" 
                                                  method="POST" 
                                                  class="d-inline"
                                                  onsubmit="return confirm('هل أنت متأكد من حذف هذا العضو؟')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-users fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted">لا يوجد أعضاء في العائلة بعد</h5>
                        <p class="text-muted">ابدأ بإضافة أول عضو في عائلتك</p>
                        @if($family->canAddMoreMembers())
                            <a href="{{ route('family.member.create', $family->id) }}" class="btn btn-primary">
                                <i class="fas fa-plus me-2"></i>
                                إضافة أول عضو
                            </a>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Share Link Modal -->
<div class="modal fade" id="shareModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-share-alt me-2"></i>
                    رابط المشاركة
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>يمكنك مشاركة هذا الرابط مع أقاربك لرؤية شجرة العائلة:</p>
                <div class="input-group">
                    <input type="text" class="form-control" id="shareUrl" readonly 
                           value="{{ route('family.share', $family->share_token) }}">
                    <button class="btn btn-outline-secondary" type="button" onclick="copyToClipboard()">
                        <i class="fas fa-copy"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
function copyShareLink() {
    const shareUrl = '{{ route("family.share", $family->share_token) }}';
    
    // Show modal
    const modal = new bootstrap.Modal(document.getElementById('shareModal'));
    modal.show();
    
    // Copy to clipboard
    navigator.clipboard.writeText(shareUrl).then(function() {
        // Show success message
        const alert = document.createElement('div');
        alert.className = 'alert alert-success alert-dismissible fade show';
        alert.innerHTML = `
            <i class="fas fa-check-circle me-2"></i>
            تم نسخ رابط المشاركة بنجاح!
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;
        document.querySelector('main').insertBefore(alert, document.querySelector('main').firstChild);
    });
}

function copyToClipboard() {
    const shareUrlInput = document.getElementById('shareUrl');
    shareUrlInput.select();
    document.execCommand('copy');
    
    // Show success message
    const alert = document.createElement('div');
    alert.className = 'alert alert-success alert-dismissible fade show';
    alert.innerHTML = `
        <i class="fas fa-check-circle me-2"></i>
        تم نسخ الرابط بنجاح!
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;
    document.querySelector('main').insertBefore(alert, document.querySelector('main').firstChild);
}
</script>
@endpush
