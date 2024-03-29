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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("credit_id");
            $table->decimal("amount",12,2);
            $table->decimal("required_amount",12,2);
            $table->decimal("base_debt",12,2);
            $table->decimal("percentage_amount",12,2);
            $table->decimal("remainder",12,2);
            $table->decimal("deleted_amount",12,2);

            $table->date("payed_date");
            $table->date("payment_date");
            $table->unsignedBigInteger("user");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
