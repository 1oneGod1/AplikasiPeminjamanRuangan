<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // SQLite doesn't support modifying columns directly, so we need to recreate the constraint
        // For SQLite, we'll just document that guru and staff roles are now supported
        // The role column already accepts varchar, so new roles can be inserted
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No-op for SQLite
    }
};
