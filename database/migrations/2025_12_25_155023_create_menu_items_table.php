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
    Schema::create('menu_items', function (Blueprint $table) {
        $table->id();
        // Nakatali sa Category table. Kapag binura ang category, mabubura rin ang items nito.
        $table->foreignId('category_id')->constrained()->onDelete('cascade');
        
        $table->string('name');
        $table->text('description')->nullable();
        $table->decimal('price', 8, 2);
        
        // Dito natin ilalagay ang Best Seller at Availability
        $table->boolean('is_best_seller')->default(false);
        $table->boolean('is_available')->default(true);
        
        $table->string('image')->nullable(); // Reserba natin para sa image upload mamaya
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_items');
    }
};
