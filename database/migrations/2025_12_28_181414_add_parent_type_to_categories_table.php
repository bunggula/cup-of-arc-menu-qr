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
        Schema::table('categories', function (Blueprint $table) {
            // Idadagdag natin ang parent_type column
            // Nilagyan natin ng 'Coffee Based' as default para hindi mag-error ang mga luma mong data
            $table->string('parent_type')->default('Coffee Based')->after('id');
        });
    }
    
    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn('parent_type');
        });
    }
};
