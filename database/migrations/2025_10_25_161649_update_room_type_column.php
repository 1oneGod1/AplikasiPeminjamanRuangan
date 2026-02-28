<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasColumn('rooms', 'type')) {
            // Rename the existing enum column so we can keep the current values temporarily
            Schema::table('rooms', function (Blueprint $table) {
                $table->dropIndex(['type']);
                $table->renameColumn('type', 'legacy_type');
            });
        }

        if (! Schema::hasColumn('rooms', 'type')) {
            Schema::table('rooms', function (Blueprint $table) {
                $table->string('type', 100)->nullable()->after('name');
            });
        }

        if (Schema::hasColumn('rooms', 'legacy_type')) {
            DB::table('rooms')->update([
                'type' => DB::raw('legacy_type')
            ]);

            Schema::table('rooms', function (Blueprint $table) {
                $table->dropColumn('legacy_type');
            });
        }

        // Ensure every room has a type value
        DB::table('rooms')->whereNull('type')->update(['type' => 'laboratorium']);

        // Recreate the index on the new column if it does not exist yet
        Schema::table('rooms', function (Blueprint $table) {
            $table->index('type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('rooms', 'type')) {
            Schema::table('rooms', function (Blueprint $table) {
                $table->dropIndex(['type']);
                $table->renameColumn('type', 'type_string');
            });
        }

        Schema::table('rooms', function (Blueprint $table) {
            $table->enum('type', [
                'laboratorium',
                'ruang_musik',
                'audio_visual',
                'lapangan_basket',
                'kolam_renang',
            ])->default('laboratorium')->after('name');
            $table->index('type');
        });

        $allowedValues = [
            'laboratorium',
            'ruang_musik',
            'audio_visual',
            'lapangan_basket',
            'kolam_renang',
        ];

        DB::table('rooms')->select(['id', 'type_string'])->chunkById(100, function ($rooms) use ($allowedValues) {
            foreach ($rooms as $room) {
                $value = in_array($room->type_string, $allowedValues, true) ? $room->type_string : 'laboratorium';
                DB::table('rooms')->where('id', $room->id)->update(['type' => $value]);
            }
        });

        Schema::table('rooms', function (Blueprint $table) {
            $table->dropColumn('type_string');
        });
    }
};
