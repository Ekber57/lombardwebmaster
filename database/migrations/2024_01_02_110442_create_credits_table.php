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
        Schema::create('credits', function (Blueprint $table) {
            $table->id();
            $table->foreignId("customer_id")->references("id")->on("customers");
            $table->float("percentage",4,2);
            $table->float("annuted",4,2);
            $table->float("percentage_amount",4,2);
            $table->float("base_debt",4,2);
            $table->float("amount",6,2);
            $table->float("remainder",6,2);
            $table->float("balance",6,2);
            $table->float("payment_amount",6,2);
            $table->date("next_payment_date");
            $table->date("last_payment_date")->nullable();
            $table->json("data");
            $table->smallInteger("payment_index")->default(0);
            $table->smallInteger("duration");
            $table->smallInteger("status")->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('credits');
    }
};
;