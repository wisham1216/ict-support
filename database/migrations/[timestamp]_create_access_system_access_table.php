<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('access_system_access', function (Blueprint $table) {
            $table->id();
            $table->foreignId('access_id')->constrained()->cascadeOnDelete();
            $table->foreignId('system_access_id')->constrained('system_accsses')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('access_system_access');
    }
};
