<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('family_members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('family_id')->constrained()->onDelete('cascade');
            $table->string('name')->comment('الاسم');
            $table->string('arabic_name')->nullable()->comment('الاسم العربي');
            $table->enum('gender', ['male', 'female'])->comment('الجنس');
            $table->date('birth_date')->nullable()->comment('تاريخ الميلاد');
            $table->date('death_date')->nullable()->comment('تاريخ الوفاة');
            $table->string('relationship')->nullable()->comment('العلاقة العائلية');
            $table->foreignId('father_id')->nullable()->constrained('family_members')->onDelete('set null');
            $table->foreignId('mother_id')->nullable()->constrained('family_members')->onDelete('set null');
            $table->text('notes')->nullable()->comment('ملاحظات');
            $table->integer('generation')->default(1)->comment('الجيل');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('family_members');
    }
};
