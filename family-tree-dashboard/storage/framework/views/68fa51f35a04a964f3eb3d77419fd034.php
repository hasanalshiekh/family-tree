

<?php $__env->startSection('title', 'الصفحة الرئيسية'); ?>

<?php $__env->startSection('content'); ?>
<div class="row justify-content-center">
    <div class="col-lg-8">
        <!-- Hero Section -->
        <div class="text-center mb-5">
            <h1 class="display-4 fw-bold text-primary mb-4">
                <i class="fas fa-sitemap me-3"></i>
                نظام شجرة العائلة
            </h1>
            <p class="lead text-muted mb-4">
                أنشئ شجرة عائلتك بسهولة وبدون خبرة تقنية. 
                أدخل الأسماء في جدول بسيط واحصل على شجرة احترافية جاهزة للطباعة والمشاركة.
            </p>
            <a href="<?php echo e(route('family.create')); ?>" class="btn btn-primary btn-lg px-5">
                <i class="fas fa-plus me-2"></i>
                إبدأ الآن - إنشاء عائلة جديدة
            </a>
        </div>

        <!-- Features -->
        <div class="row g-4 mb-5">
            <div class="col-md-4">
                <div class="card h-100 text-center">
                    <div class="card-body">
                        <div class="stats-card mb-3">
                            <i class="fas fa-table fa-3x mb-3"></i>
                            <h5 class="card-title">إدخال بسيط</h5>
                        </div>
                        <p class="card-text">
                            أدخل أسماء عائلتك في جدول بسيط وواضح. 
                            لا تحتاج لأي خبرة تقنية أو برامج رسم.
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card h-100 text-center">
                    <div class="card-body">
                        <div class="stats-card mb-3">
                            <i class="fas fa-share-alt fa-3x mb-3"></i>
                            <h5 class="card-title">مشاركة سهلة</h5>
                        </div>
                        <p class="card-text">
                            شارك شجرة عائلتك مع أقاربك عبر رابط آمن. 
                            يمكن للجميع رؤية الشجرة بدون تسجيل دخول.
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card h-100 text-center">
                    <div class="card-body">
                        <div class="stats-card mb-3">
                            <i class="fas fa-file-pdf fa-3x mb-3"></i>
                            <h5 class="card-title">تصدير PDF</h5>
                        </div>
                        <p class="card-text">
                            احفظ شجرة عائلتك كملف PDF عالي الجودة. 
                            جاهز للطباعة على أحجام كبيرة.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats -->
        <div class="row g-4 mb-5">
            <div class="col-md-3">
                <div class="stats-card">
                    <div class="stats-number">5</div>
                    <div>أسماء مجانية</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card">
                    <div class="stats-number">∞</div>
                    <div>أجيال متاحة</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card">
                    <div class="stats-number">100%</div>
                    <div>عربي</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card">
                    <div class="stats-number">0</div>
                    <div>خبرة مطلوبة</div>
                </div>
            </div>
        </div>

        <!-- How it works -->
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">
                    <i class="fas fa-question-circle me-2"></i>
                    كيف يعمل النظام؟
                </h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="text-primary">الخطوة الأولى: إنشاء العائلة</h5>
                        <p>أدخل اسم العائلة ووصفاً مختصراً لتتعرف عليها.</p>
                        
                        <h5 class="text-primary">الخطوة الثانية: إضافة الأعضاء</h5>
                        <p>أضف أسماء أفراد العائلة مع تحديد العلاقات (أب، أم، أبناء).</p>
                    </div>
                    <div class="col-md-6">
                        <h5 class="text-primary">الخطوة الثالثة: عرض الشجرة</h5>
                        <p>شاهد شجرة عائلتك تظهر تلقائياً بشكل احترافي وجميل.</p>
                        
                        <h5 class="text-primary">الخطوة الرابعة: المشاركة والتصدير</h5>
                        <p>شارك الشجرة مع أقاربك أو احفظها كملف PDF للطباعة.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\hasan\OneDrive\Desktop\family tree\family-tree-dashboard\resources\views/welcome.blade.php ENDPATH**/ ?>