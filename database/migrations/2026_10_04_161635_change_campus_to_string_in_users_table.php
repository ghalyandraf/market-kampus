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
        // Jika sebelumnya campus_id berupa foreignId, kita drop foreign key-nya lalu ubah jadi string nama kampus
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'campus_id')) {
                $table->dropForeign(['campus_id']);
                $table->dropColumn('campus_id');
            }
            $table->string('campus_name')->nullable()->after('role_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
