# نظام شجرة العائلة - Family Tree Dashboard

نظام ويب بسيط لإنشاء وإدارة أشجار العائلة باستخدام Laravel.

## المميزات

- ✅ واجهة عربية كاملة
- ✅ إدخال البيانات عبر جدول بسيط
- ✅ مجاني حتى 5 أسماء
- ✅ عرض الشجرة تلقائياً
- ✅ مشاركة الشجرة عبر رابط آمن
- ✅ تصدير الشجرة كصورة
- ✅ تصميم متجاوب (Responsive)
- ✅ سهولة الاستخدام بدون خبرة تقنية

## المتطلبات

- PHP 8.1 أو أحدث
- Composer
- SQLite (افتراضي) أو MySQL
- Laravel 10

## التثبيت والتشغيل

### 1. تثبيت التبعيات

```bash
composer install
```

### 2. إعداد البيئة

```bash
cp env.example .env
php artisan key:generate
```

### 3. إعداد قاعدة البيانات

```bash
# إنشاء ملف قاعدة البيانات SQLite
touch database/database.sqlite

# تشغيل الهجرات
php artisan migrate
```

### 4. تشغيل الخادم

```bash
php artisan serve
```

افتح المتصفح على: `http://localhost:8000`

## استخدام النظام

### 1. إنشاء عائلة جديدة
- اضغط على "إنشاء عائلة جديدة"
- أدخل اسم العائلة ووصفاً (اختياري)
- اضغط "إنشاء العائلة"

### 2. إضافة الأعضاء
- من الداش بورد، اضغط "إضافة عضو جديد"
- أدخل المعلومات الأساسية (الاسم، الجنس)
- حدد الأب والأم إذا كانا موجودين
- أدخل التواريخ والملاحظات
- اضغط "حفظ العضو"

### 3. عرض الشجرة
- اضغط "عرض الشجرة" من الداش بورد
- استخدم أزرار التكبير والتصغير
- يمكنك تحميل الشجرة كصورة

### 4. مشاركة الشجرة
- اضغط "نسخ رابط المشاركة" من الداش بورد
- شارك الرابط مع أقاربك
- يمكنهم رؤية الشجرة بدون تسجيل دخول

## هيكل قاعدة البيانات

### جدول العائلات (families)
- `id`: المعرف الفريد
- `name`: اسم العائلة
- `description`: وصف العائلة
- `share_token`: رمز المشاركة
- `created_at`, `updated_at`: تواريخ الإنشاء والتحديث

### جدول أعضاء العائلة (family_members)
- `id`: المعرف الفريد
- `family_id`: معرف العائلة
- `name`: الاسم الكامل
- `arabic_name`: الاسم بالعربية
- `gender`: الجنس (male/female)
- `birth_date`: تاريخ الميلاد
- `death_date`: تاريخ الوفاة
- `relationship`: العلاقة العائلية
- `father_id`: معرف الأب
- `mother_id`: معرف الأم
- `notes`: ملاحظات
- `generation`: رقم الجيل
- `created_at`, `updated_at`: تواريخ الإنشاء والتحديث

## الملفات الرئيسية

```
app/
├── Http/Controllers/
│   ├── FamilyController.php          # تحكم العائلات
│   └── FamilyMemberController.php    # تحكم أعضاء العائلة
├── Models/
│   ├── Family.php                    # نموذج العائلة
│   └── FamilyMember.php             # نموذج عضو العائلة
resources/views/
├── layouts/
│   └── app.blade.php                # التخطيط الأساسي
├── family/
│   ├── create.blade.php             # إنشاء عائلة
│   ├── dashboard.blade.php          # داش بورد العائلة
│   ├── tree.blade.php               # عرض الشجرة
│   ├── share.blade.php              # مشاركة الشجرة
│   └── member/
│       └── create.blade.php         # إضافة عضو
└── welcome.blade.php                # الصفحة الرئيسية
database/migrations/
├── create_families_table.php        # هجرة جدول العائلات
└── create_family_members_table.php  # هجرة جدول الأعضاء
```

## التخصيص

### تغيير الحد الأقصى للأعضاء
في ملف `app/Models/Family.php`:

```php
public function canAddMoreMembers()
{
    return $this->getMembersCount() < 5; // غيّر الرقم هنا
}
```

### تخصيص ألوان الأجيال
في ملفات العرض، ابحث عن `getGenerationColor` وغيّر الألوان:

```javascript
const colors = {
    1: '#667eea',  // الجيل الأول
    2: '#11998e',  // الجيل الثاني
    3: '#f093fb',  // الجيل الثالث
    4: '#ff416c',  // الجيل الرابع
    5: '#ff9a9e'   // الجيل الخامس
};
```

## المساهمة

1. Fork المشروع
2. أنشئ فرعاً جديداً (`git checkout -b feature/amazing-feature`)
3. Commit التغييرات (`git commit -m 'Add amazing feature'`)
4. Push للفرع (`git push origin feature/amazing-feature`)
5. افتح Pull Request

## الترخيص

هذا المشروع مرخص تحت رخصة MIT - راجع ملف [LICENSE](LICENSE) للتفاصيل.

## الدعم

إذا واجهت أي مشاكل أو لديك اقتراحات، يرجى فتح issue في GitHub.

---

**تم التطوير بـ ❤️ باستخدام Laravel**
