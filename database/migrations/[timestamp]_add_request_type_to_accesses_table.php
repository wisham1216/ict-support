<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('accesses', function (Blueprint $table) {
            $table->string('request_type')->after('access_type');
            $table->index('request_type');
        });
    }

    public function down()
    {
        Schema::table('accesses', function (Blueprint $table) {
            $table->dropColumn('request_type');
        });
    }
};
