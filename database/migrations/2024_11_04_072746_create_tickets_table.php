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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('department_name');
            $table->string('contact_person');
            $table->unsignedBigInteger('creator_id'); // reference to users table (if using authentication)
            $table->string('summary');
            $table->text('description');
            $table->string('category');
            $table->string('attachment')->nullable(); // for file attachments
            $table->enum('status', ['open', 'in_progress', 'closed'])->default('open');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
