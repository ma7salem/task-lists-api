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
        Schema::table('tasks', function (Blueprint $table) {
            $table->text('details')->nullable()->after('name');
            $table->foreignId('label_id')
            ->nullable()
            ->constrained('label')
            ->onUpdate('cascade')
            ->onDelete('cascade')
            ->after('todo_list_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropColumn(['details', 'label_id']);
        });
    }
};
