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
            $table->decimal("amount",10,2);
            $table->decimal("required_amount",2);
            $table->decimal("base_debt",10,2);
            $table->decimal("percentage_amount",10,2);
            $table->decimal("remainder",10,2);
            $table->decimal("deleted_amount",10,2);

            $table->date("payed_date");
            $table->date("payment_date");
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
