

<?php $__env->startSection('title', 'إنشاء عائلة جديدة'); ?>

<?php $__env->startSection('content'); ?>
<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header bg-primary text-white text-center">
                <h3 class="mb-0">
                    <i class="fas fa-plus-circle me-2"></i>
                    إنشاء عائلة جديدة
                </h3>
            </div>
            <div class="card-body p-4">
                <form action="<?php echo e(route('family.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    
                    <div class="mb-4">
                        <label for="name" class="form-label fw-bold">
                            <i class="fas fa-family me-1"></i>
                            اسم العائلة *
                        </label>
                        <input type="text" 
                               class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                               id="name" 
                               name="name" 
                               value="<?php echo e(old('name')); ?>"
                               placeholder="مثال: آل محمد، عائلة الأحمد، أسرة الحسن..."
                               required>
                        <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    
                    <div class="mb-4">
                        <label for="description" class="form-label fw-bold">
                            <i class="fas fa-info-circle me-1"></i>
                            وصف العائلة (اختياري)
                        </label>
                        <textarea class="form-control <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                  id="description" 
                                  name="description" 
                                  rows="3"
                                  placeholder="أدخل وصفاً مختصراً عن العائلة، مثل: عائلة من المدينة المنورة، تعود أصولها إلى...""><?php echo e(old('description')); ?></textarea>
                        <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        <strong>ملاحظة:</strong> يمكنك إضافة حتى 5 أسماء في النسخة المجانية. 
                        بعد إنشاء العائلة ستتمكن من إضافة الأعضاء وتحديد العلاقات بينهم.
                    </div>
                    
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-save me-2"></i>
                            إنشاء العائلة
                        </button>
                        <a href="<?php echo e(route('welcome')); ?>" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-right me-2"></i>
                            العودة للصفحة الرئيسية
                        </a>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Help Section -->
        <div class="card mt-4">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0">
                    <i class="fas fa-lightbulb me-2"></i>
                    نصائح مفيدة
                </h5>
            </div>
            <div class="card-body">
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <i class="fas fa-check text-success me-2"></i>
                        اختر اسماً واضحاً يميز عائلتك
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-check text-success me-2"></i>
                        اكتب الوصف باللغة العربية للوضوح
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-check text-success me-2"></i>
                        يمكنك تعديل هذه المعلومات لاحقاً
                    </li>
                    <li class="mb-0">
                        <i class="fas fa-check text-success me-2"></i>
                        بعد الإنشاء ستحصل على رابط للمشاركة
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\hasan\OneDrive\Desktop\family tree\family-tree-dashboard\resources\views/family/create.blade.php ENDPATH**/ ?>