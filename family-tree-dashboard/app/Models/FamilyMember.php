<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamilyMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'family_id',
        'name',
        'arabic_name',
        'gender',
        'birth_date',
        'death_date',
        'relationship',
        'father_id',
        'mother_id',
        'notes',
        'generation'
    ];

    protected $casts = [
        'birth_date' => 'date',
        'death_date' => 'date',
    ];

    /**
     * العلاقة مع العائلة
     */
    public function family()
    {
        return $this->belongsTo(Family::class);
    }

    /**
     * العلاقة مع الأب
     */
    public function father()
    {
        return $this->belongsTo(FamilyMember::class, 'father_id');
    }

    /**
     * العلاقة مع الأم
     */
    public function mother()
    {
        return $this->belongsTo(FamilyMember::class, 'mother_id');
    }

    /**
     * العلاقة مع الأبناء
     */
    public function children()
    {
        return $this->hasMany(FamilyMember::class, 'father_id')
                   ->orWhere('mother_id', $this->id);
    }

    /**
     * العلاقة مع الأبناء من الأب
     */
    public function childrenFromFather()
    {
        return $this->hasMany(FamilyMember::class, 'father_id');
    }

    /**
     * العلاقة مع الأبناء من الأم
     */
    public function childrenFromMother()
    {
        return $this->hasMany(FamilyMember::class, 'mother_id');
    }

    /**
     * الحصول على الجيل التالي
     */
    public function getNextGeneration()
    {
        return $this->generation + 1;
    }

    /**
     * الحصول على الجيل السابق
     */
    public function getPreviousGeneration()
    {
        return $this->generation - 1;
    }

    /**
     * التحقق من كونه جذر (جد أو جدة)
     */
    public function isRoot()
    {
        return is_null($this->father_id) && is_null($this->mother_id);
    }

    /**
     * الحصول على العمر
     */
    public function getAge()
    {
        if ($this->death_date) {
            return $this->birth_date ? $this->death_date->diffInYears($this->birth_date) : null;
        }
        
        return $this->birth_date ? now()->diffInYears($this->birth_date) : null;
    }

    /**
     * الحصول على اسم العرض
     */
    public function getDisplayName()
    {
        return $this->arabic_name ?: $this->name;
    }
}
