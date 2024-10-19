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
        Schema::create('central_plan', function (Blueprint $table) {
            $table->bigIncrements('plan_id');
            $table->string('stripe_plan_id');
            $table->string('name');
            $table->decimal('price');
            $table->string('currency');
            $table->text('features')->nullable();
            $table->string("bill_period");
            $table->string("period")->default(1);
            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
