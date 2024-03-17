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
        Schema::create('delayings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("credit_id");
            $table->unsignedBigInteger("customer_id");
            $table->integer("delayed_days");
            $table->float("amount",12,2);
            $table->float("penalty_amount",12,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delayings');
    }
};
