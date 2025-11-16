<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>شجرة عائلة <?php echo e($family->name); ?></title>
    
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 20px;
            background: white;
            direction: rtl;
            text-align: right;
        }
        
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 3px solid #667eea;
            padding-bottom: 20px;
        }
        
        .header h1 {
            color: #2c3e50;
            font-size: 28px;
            margin: 0;
            font-weight: bold;
        }
        
        .header p {
            color: #666;
            font-size: 16px;
            margin: 10px 0 0 0;
        }
        
        .tree-container {
            width: 100%;
            margin: 20px 0;
        }
        
        .generation {
            margin: 30px 0;
            text-align: center;
        }
        
        .generation-title {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 10px 20px;
            border-radius: 25px;
            display: inline-block;
            font-weight: bold;
            margin-bottom: 20px;
        }
        
        .members-row {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 20px;
            margin: 20px 0;
        }
        
        .member-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 15px 20px;
            border-radius: 15px;
            text-align: center;
            min-width: 200px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }
        
        .member-card.generation-2 {
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
        }
        
        .member-card.generation-3 {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        }
        
        .member-card.generation-4 {
            background: linear-gradient(135deg, #ff416c 0%, #ff4b2b 100%);
        }
        
        .member-card.generation-5 {
            background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 100%);
        }
        
        .member-name {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        
        .member-gender {
            font-size: 14px;
            opacity: 0.9;
        }
        
        .member-relationship {
            font-size: 12px;
            opacity: 0.8;
            margin-top: 5px;
        }
        
        .member-age {
            font-size: 12px;
            opacity: 0.8;
        }
        
        .family-info {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 15px;
            margin: 20px 0;
            border-right: 5px solid #667eea;
        }
        
        .family-info h3 {
            color: #2c3e50;
            margin: 0 0 10px 0;
        }
        
        .family-info p {
            margin: 5px 0;
            color: #666;
        }
        
        .footer {
            text-align: center;
            margin-top: 40px;
            padding-top: 20px;
            border-top: 2px solid #e9ecef;
            color: #666;
            font-size: 12px;
        }
        
        .tree-lines {
            position: relative;
            height: 20px;
            margin: 10px 0;
        }
        
        .line {
            position: absolute;
            height: 2px;
            background: #667eea;
            top: 50%;
            transform: translateY(-50%);
        }
        
        @media print {
            body {
                margin: 0;
                padding: 10px;
            }
            
            .member-card {
                break-inside: avoid;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>شجرة عائلة <?php echo e($family->name); ?></h1>
        <?php if($family->description): ?>
            <p><?php echo e($family->description); ?></p>
        <?php endif; ?>
        <p>تم إنشاؤها في: <?php echo e(now()->format('Y/m/d H:i')); ?></p>
    </div>
    
    <div class="family-info">
        <h3>معلومات العائلة</h3>
        <p><strong>عدد الأعضاء:</strong> <?php echo e($members->count()); ?> عضو</p>
        <p><strong>عدد الأجيال:</strong> <?php echo e($members->max('generation') ?? 0); ?> أجيال</p>
        <p><strong>تاريخ الإنشاء:</strong> <?php echo e($family->created_at->format('Y/m/d')); ?></p>
        <p><strong>آخر تحديث:</strong> <?php echo e($family->updated_at->format('Y/m/d')); ?></p>
    </div>
    
    <?php if($members->count() > 0): ?>
        <?php $__currentLoopData = $members->groupBy('generation'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $generation => $generationMembers): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="generation">
            <div class="generation-title">
                الجيل <?php echo e($generation); ?>

            </div>
            
            <div class="members-row">
                <?php $__currentLoopData = $generationMembers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="member-card generation-<?php echo e($member->generation); ?>">
                    <div class="member-name">
                        <?php echo e($member->getDisplayName()); ?>

                    </div>
                    <div class="member-gender">
                        <?php if($member->gender === 'male'): ?>
                            ♂ ذكر
                        <?php else: ?>
                            ♀ أنثى
                        <?php endif; ?>
                    </div>
                    <?php if($member->relationship): ?>
                        <div class="member-relationship">
                            <?php echo e($member->relationship); ?>

                        </div>
                    <?php endif; ?>
                    <?php if($member->getAge()): ?>
                        <div class="member-age">
                            <?php echo e($member->getAge()); ?> سنة
                        </div>
                    <?php endif; ?>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        
        <!-- Family Tree Structure -->
        <div class="family-info">
            <h3>هيكل الشجرة العائلية</h3>
            <?php $__currentLoopData = $members->groupBy('generation'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $generation => $generationMembers): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div style="margin: 15px 0;">
                    <strong>الجيل <?php echo e($generation); ?>:</strong>
                    <?php $__currentLoopData = $generationMembers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <span style="background: #e9ecef; padding: 5px 10px; margin: 2px; border-radius: 15px; display: inline-block;">
                            <?php echo e($member->getDisplayName()); ?>

                            <?php if($member->relationship): ?>
                                (<?php echo e($member->relationship); ?>)
                            <?php endif; ?>
                        </span>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php else: ?>
        <div style="text-align: center; padding: 40px; color: #666;">
            <h3>لا توجد أعضاء في العائلة بعد</h3>
            <p>سيتم إضافة أعضاء العائلة قريباً</p>
        </div>
    <?php endif; ?>
    
    <div class="footer">
        <p>تم إنشاء هذه الشجرة باستخدام نظام شجرة العائلة - Family Tree Dashboard</p>
        <p>رابط المشاركة: <?php echo e(request()->getSchemeAndHttpHost()); ?>/share/<?php echo e($family->share_token); ?></p>
    </div>
</body>
</html>
<?php /**PATH C:\Users\hasan\OneDrive\Desktop\family tree\family-tree-dashboard\resources\views/family/pdf.blade.php ENDPATH**/ ?>