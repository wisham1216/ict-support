<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('accesses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('nation_id');
            $table->string('gender');
            $table->date('dob');
            $table->string('record_card_number');
            $table->string('designation');
            $table->string('section');
            $table->string('mobile');
            $table->string('email');
            $table->string('status')->default('pending');
            $table->text('reason');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accesses');
    }
};
