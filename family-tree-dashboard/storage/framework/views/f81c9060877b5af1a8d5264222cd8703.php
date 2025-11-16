

<?php $__env->startSection('title', 'تعديل العضو - ' . $member->getDisplayName()); ?>

<?php $__env->startSection('content'); ?>
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header bg-warning text-white text-center">
                <h3 class="mb-0">
                    <i class="fas fa-user-edit me-2"></i>
                    تعديل بيانات <?php echo e($member->getDisplayName()); ?>

                </h3>
            </div>
            <div class="card-body p-4">
                <form action="<?php echo e(route('family.member.update', [$family->id, $member->id])); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>
                    
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
                                       value="<?php echo e(old('name', $member->name)); ?>"
                                       placeholder="مثال: أحمد محمد الأحمد"
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
                            
                            <div class="mb-3">
                                <label for="arabic_name" class="form-label fw-bold">الاسم بالعربية (اختياري)</label>
                                <input type="text" 
                                       class="form-control <?php $__errorArgs = ['arabic_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                       id="arabic_name" 
                                       name="arabic_name" 
                                       value="<?php echo e(old('arabic_name', $member->arabic_name)); ?>"
                                       placeholder="مثال: أحمد محمد الأحمد">
                                <?php $__errorArgs = ['arabic_name'];
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
                            
                            <div class="mb-3">
                                <label for="gender" class="form-label fw-bold">الجنس *</label>
                                <select class="form-select <?php $__errorArgs = ['gender'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                        id="gender" 
                                        name="gender" 
                                        required>
                                    <option value="">اختر الجنس</option>
                                    <option value="male" <?php echo e(old('gender', $member->gender) == 'male' ? 'selected' : ''); ?>>
                                        <i class="fas fa-male"></i> ذكر
                                    </option>
                                    <option value="female" <?php echo e(old('gender', $member->gender) == 'female' ? 'selected' : ''); ?>>
                                        <i class="fas fa-female"></i> أنثى
                                    </option>
                                </select>
                                <?php $__errorArgs = ['gender'];
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
                            
                            <div class="mb-3">
                                <label for="relationship" class="form-label fw-bold">العلاقة العائلية</label>
                                <input type="text" 
                                       class="form-control <?php $__errorArgs = ['relationship'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                       id="relationship" 
                                       name="relationship" 
                                       value="<?php echo e(old('relationship', $member->relationship)); ?>"
                                       placeholder="مثال: جد، جدة، عم، خالة...">
                                <?php $__errorArgs = ['relationship'];
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
                        </div>
                        
                        <!-- Family Relations -->
                        <div class="col-md-6">
                            <h5 class="text-primary mb-3">
                                <i class="fas fa-sitemap me-2"></i>
                                العلاقات العائلية
                            </h5>
                            
                            <div class="mb-3">
                                <label for="father_id" class="form-label fw-bold">الأب (اختياري)</label>
                                <select class="form-select <?php $__errorArgs = ['father_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                        id="father_id" 
                                        name="father_id">
                                    <option value="">اختر الأب</option>
                                    <?php $__currentLoopData = $members->where('gender', 'male')->where('id', '!=', $member->id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $potentialFather): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($potentialFather->id); ?>" 
                                                <?php echo e(old('father_id', $member->father_id) == $potentialFather->id ? 'selected' : ''); ?>>
                                            <?php echo e($potentialFather->getDisplayName()); ?> (الجيل <?php echo e($potentialFather->generation); ?>)
                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php $__errorArgs = ['father_id'];
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
                            
                            <div class="mb-3">
                                <label for="mother_id" class="form-label fw-bold">الأم (اختياري)</label>
                                <select class="form-select <?php $__errorArgs = ['mother_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                        id="mother_id" 
                                        name="mother_id">
                                    <option value="">اختر الأم</option>
                                    <?php $__currentLoopData = $members->where('gender', 'female')->where('id', '!=', $member->id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $potentialMother): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($potentialMother->id); ?>" 
                                                <?php echo e(old('mother_id', $member->mother_id) == $potentialMother->id ? 'selected' : ''); ?>>
                                            <?php echo e($potentialMother->getDisplayName()); ?> (الجيل <?php echo e($potentialMother->generation); ?>)
                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php $__errorArgs = ['mother_id'];
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
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="birth_date" class="form-label fw-bold">تاريخ الميلاد</label>
                                        <input type="date" 
                                               class="form-control <?php $__errorArgs = ['birth_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                               id="birth_date" 
                                               name="birth_date" 
                                               value="<?php echo e(old('birth_date', $member->birth_date?->format('Y-m-d'))); ?>">
                                        <?php $__errorArgs = ['birth_date'];
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
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="death_date" class="form-label fw-bold">تاريخ الوفاة</label>
                                        <input type="date" 
                                               class="form-control <?php $__errorArgs = ['death_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                               id="death_date" 
                                               name="death_date" 
                                               value="<?php echo e(old('death_date', $member->death_date?->format('Y-m-d'))); ?>">
                                        <?php $__errorArgs = ['death_date'];
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
                        <textarea class="form-control <?php $__errorArgs = ['notes'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                  id="notes" 
                                  name="notes" 
                                  rows="3"
                                  placeholder="أي معلومات إضافية عن هذا الشخص..."><?php echo e(old('notes', $member->notes)); ?></textarea>
                        <?php $__errorArgs = ['notes'];
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
                    
                    <!-- Current Info -->
                    <div class="alert alert-info">
                        <h6 class="alert-heading">المعلومات الحالية:</h6>
                        <p class="mb-1"><strong>الجيل الحالي:</strong> <?php echo e($member->generation); ?></p>
                        <?php if($member->father): ?>
                            <p class="mb-1"><strong>الأب:</strong> <?php echo e($member->father->getDisplayName()); ?></p>
                        <?php endif; ?>
                        <?php if($member->mother): ?>
                            <p class="mb-1"><strong>الأم:</strong> <?php echo e($member->mother->getDisplayName()); ?></p>
                        <?php endif; ?>
                        <?php if($member->getAge()): ?>
                            <p class="mb-0"><strong>العمر:</strong> <?php echo e($member->getAge()); ?> سنة</p>
                        <?php endif; ?>
                    </div>
                    
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="<?php echo e(route('family.dashboard', $family->id)); ?>" class="btn btn-outline-secondary me-md-2">
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\hasan\OneDrive\Desktop\family tree\family-tree-dashboard\resources\views/family/member/edit.blade.php ENDPATH**/ ?>