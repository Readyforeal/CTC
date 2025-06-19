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
        Schema::create('bids', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bid_tracker_id')->constrained();
            $table->foreignId('project_id')->constrained();
            $table->foreignId('proposal_id')->constrained();
            $table->foreignId('account_id')->constrained();
            $table->foreignId('category_id')->constrained();
            $table->string('details')->nullable();
            $table->boolean('reviewed')->default('false');
            $table->boolean('printed')->default('false');
            $table->decimal('amount')->nullable();
            $table->string('local_storage_url')->nullable();
            $table->string('storage_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bids');
    }
};
