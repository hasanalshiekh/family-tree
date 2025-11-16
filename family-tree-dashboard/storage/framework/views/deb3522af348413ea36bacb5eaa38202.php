

<?php $__env->startSection('title', 'داش بورد العائلة - ' . $family->name); ?>

<?php $__env->startSection('content'); ?>
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
                <h4 class="text-primary"><?php echo e($family->name); ?></h4>
                <?php if($family->description): ?>
                    <p class="text-muted"><?php echo e($family->description); ?></p>
                <?php endif; ?>
                
                <div class="row text-center mt-3">
                    <div class="col-6">
                        <div class="stats-card">
                            <div class="stats-number"><?php echo e($family->getMembersCount()); ?></div>
                            <div>عضو</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="stats-card">
                            <div class="stats-number"><?php echo e($family->getMembersCount()); ?>/5</div>
                            <div>المجاني</div>
                        </div>
                    </div>
                </div>
                
                <div class="mt-3">
                    <a href="<?php echo e(route('family.tree', $family->id)); ?>" class="btn btn-success w-100 mb-2">
                        <i class="fas fa-sitemap me-2"></i>
                        عرض الشجرة
                    </a>
                    <a href="<?php echo e(route('family.export-pdf', $family->id)); ?>" class="btn btn-warning w-100 mb-2">
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
                <?php if($family->canAddMoreMembers()): ?>
                    <a href="<?php echo e(route('family.member.create', $family->id)); ?>" class="btn btn-primary">
                        <i class="fas fa-plus me-1"></i>
                        إضافة عضو جديد
                    </a>
                <?php else: ?>
                    <span class="badge bg-warning">
                        <i class="fas fa-exclamation-triangle me-1"></i>
                        الحد الأقصى (5 أسماء)
                    </span>
                <?php endif; ?>
            </div>
            <div class="card-body">
                <?php if($members->count() > 0): ?>
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
                                <?php $__currentLoopData = $members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td>
                                        <strong><?php echo e($member->getDisplayName()); ?></strong>
                                        <?php if($member->arabic_name && $member->arabic_name !== $member->name): ?>
                                            <br><small class="text-muted"><?php echo e($member->name); ?></small>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if($member->gender === 'male'): ?>
                                            <i class="fas fa-male text-primary"></i> ذكر
                                        <?php else: ?>
                                            <i class="fas fa-female text-danger"></i> أنثى
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <span class="badge bg-secondary">الجيل <?php echo e($member->generation); ?></span>
                                    </td>
                                    <td>
                                        <?php if($member->relationship): ?>
                                            <span class="badge bg-info"><?php echo e($member->relationship); ?></span>
                                        <?php else: ?>
                                            <span class="text-muted">-</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if($member->getAge()): ?>
                                            <?php echo e($member->getAge()); ?> سنة
                                        <?php else: ?>
                                            <span class="text-muted">-</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="<?php echo e(route('family.member.edit', [$family->id, $member->id])); ?>" 
                                               class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="<?php echo e(route('family.member.destroy', [$family->id, $member->id])); ?>" 
                                                  method="POST" 
                                                  class="d-inline"
                                                  onsubmit="return confirm('هل أنت متأكد من حذف هذا العضو؟')">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="text-center py-5">
                        <i class="fas fa-users fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted">لا يوجد أعضاء في العائلة بعد</h5>
                        <p class="text-muted">ابدأ بإضافة أول عضو في عائلتك</p>
                        <?php if($family->canAddMoreMembers()): ?>
                            <a href="<?php echo e(route('family.member.create', $family->id)); ?>" class="btn btn-primary">
                                <i class="fas fa-plus me-2"></i>
                                إضافة أول عضو
                            </a>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
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
                           value="<?php echo e(route('family.share', $family->share_token)); ?>">
                    <button class="btn btn-outline-secondary" type="button" onclick="copyToClipboard()">
                        <i class="fas fa-copy"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
function copyShareLink() {
    const shareUrl = '<?php echo e(route("family.share", $family->share_token)); ?>';
    
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
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\hasan\OneDrive\Desktop\family tree\family-tree-dashboard\resources\views/family/dashboard.blade.php ENDPATH**/ ?>