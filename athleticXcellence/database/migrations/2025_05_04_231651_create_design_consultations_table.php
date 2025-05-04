<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('design_consultations', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('organization')->nullable();
            $table->string('email');
            $table->string('phone');
            $table->json('products_needed'); // Stores array of product types
            $table->text('design_details');
            $table->enum('quantity', [
                '1-25', 
                '26-50', 
                '51-100', 
                '101-250', 
                '251+'
            ]);
            $table->date('deadline')->nullable();
            $table->enum('status', [
                'new', 
                'in_review', 
                'contacted', 
                'completed', 
                'rejected'
            ])->default('new');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('design_consultations');
    }
};