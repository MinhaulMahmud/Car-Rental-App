<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Add the new column
        Schema::table('users', function (Blueprint $table) {
            $table->string('role_new')->nullable()->after('role');
        });

        // Copy data with conversion
        DB::table('users')->where('role', 0)->update(['role_new' => 'admin']);
        DB::table('users')->where('role', 1)->update(['role_new' => 'customer']);

        // Drop old column
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
        });

        // Add new column with correct name
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->nullable()->after('role_new');
        });

        // Copy data
        DB::statement('UPDATE users SET role = role_new');

        // Drop temporary column
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role_new');
        });

        // Set default value for new users
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('customer')->nullable(false)->change();
        });
    }

    public function down(): void
    {
        // Add temporary column
        Schema::table('users', function (Blueprint $table) {
            $table->tinyInteger('role_old')->nullable()->after('role');
        });

        // Convert back
        DB::table('users')->where('role', 'admin')->update(['role_old' => 0]);
        DB::table('users')->where('role', 'customer')->update(['role_old' => 1]);

        // Drop string role column
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
        });

        // Add back integer role column
        Schema::table('users', function (Blueprint $table) {
            $table->tinyInteger('role')->default(1)->after('role_old');
        });

        // Copy data
        DB::statement('UPDATE users SET role = role_old');

        // Drop temporary column
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role_old');
        });
    }
};
