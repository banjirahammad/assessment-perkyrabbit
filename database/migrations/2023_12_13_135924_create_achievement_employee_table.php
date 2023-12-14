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
        Schema::create('achievement_employee', function (Blueprint $table) {
            $table->id();
            $table->foreignId('achievement_id')->constrained('achievements')->onDelete('restrict'); //
            $table->foreignId('employee_id')->constrained('employees');
            $table->date('achievement_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('achievement_employee', function (Blueprint $table){
            $table->dropForeign('achievement_id');
            $table->dropForeign('employee_id');
            $table->dropIfExists();
        });
    }
};
