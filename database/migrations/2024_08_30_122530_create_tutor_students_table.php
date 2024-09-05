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
        Schema::create('tutor_students', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Tutor::class, 'tutor_id')->constrained();
            $table->foreignIdFor(\App\Models\Student::class, 'student_id')->constrained();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tutor_students');
    }
};
