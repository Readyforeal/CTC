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
        Schema::create('bid_trackers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained();
            $table->foreignId('proposal_id')->constrained();
            $table->foreignId('account_id')->constrained()->nullable();
            $table->foreignId('category_id')->constrained()->nullable();
            $table->date('followed_up')->nullable();
            $table->string('notes')->nullable();
            $table->string('status')->default('Not started');
            $table->boolean('winner')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bid_trackers');
    }
};
