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
        Schema::create('booking_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                    ->references('id')
                    ->on('users')->onDelete('cascade');
            $table->double('booking_fee');
            $table->string('transaction_ref');

            $table->unsignedBigInteger('transaction_id');
            $table->foreign('transaction_id')->references('id')
                ->on('transactions')->onDelete('cascade');

            $table->unsignedBigInteger('consultation_id');
            $table->foreign('consultation_id')
                    ->references('id')
                    ->on('consultations')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_orders');
    }
};
