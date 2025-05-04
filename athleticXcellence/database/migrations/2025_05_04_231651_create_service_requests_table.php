<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('service_requests', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('phone');
            $table->enum('project_type', [
                'team-website', 
                'ecommerce', 
                'athlete-portfolio', 
                'event-system', 
                'other'
            ]);
            $table->text('project_details');
            $table->enum('budget', [
                '1k-3k', 
                '3k-5k', 
                '5k-10k', 
                '10k+'
            ])->nullable();
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
        Schema::dropIfExists('service_requests');
    }
};