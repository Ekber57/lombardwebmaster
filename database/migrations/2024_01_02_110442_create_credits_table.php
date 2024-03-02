<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Auth;
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
            $table->float("percentage",12,2);
            $table->float("annuted",12,2);
            $table->float("percentage_amount",12,2);
            $table->float("base_debt",12,2);
            $table->float("amount",12,2);
            $table->float("remainder",12,2);
            $table->float("balance",12,2);
            $table->float("payment_amount",12,2);
            $table->date("next_payment_date");
            $table->date("last_payment_date")->nullable();
            $table->text("note");
            $table->json("data");
            $table->smallInteger("duration");
            $table->smallInteger("status")->default(0);
            $table->unsignedBigInteger("user");
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