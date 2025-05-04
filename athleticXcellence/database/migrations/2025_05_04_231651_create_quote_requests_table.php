<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('quote_requests', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('organization')->nullable();
            $table->string('email');
            $table->string('phone');
            $table->json('apparel_types'); // Stores array of apparel types
            $table->integer('quantity');
            $table->date('deadline')->nullable();
            $table->string('design_files_path')->nullable();
            $table->text('additional_notes')->nullable();
            $table->enum('status', [
                'new', 
                'in_review', 
                'quoted', 
                'completed', 
                'rejected'
            ])->default('new');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('quote_requests');
    }
};