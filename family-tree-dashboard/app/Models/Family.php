<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Family extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'share_token'
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($family) {
            if (empty($family->share_token)) {
                $family->share_token = Str::random(32);
            }
        });
    }

    /**
     * العلاقة مع أعضاء العائلة
     */
    public function members()
    {
        return $this->hasMany(FamilyMember::class);
    }

    /**
     * الحصول على الجذور (الأجداد)
     */
    public function getRootMembers()
    {
        return $this->members()->whereNull('father_id')->whereNull('mother_id')->get();
    }

    /**
     * الحصول على عدد الأعضاء
     */
    public function getMembersCount()
    {
        return $this->members()->count();
    }

    /**
     * التحقق من الحد الأقصى للأعضاء (5 أسماء مجاناً)
     */
    public function canAddMoreMembers()
    {
        return $this->getMembersCount() < 5;
    }
}
