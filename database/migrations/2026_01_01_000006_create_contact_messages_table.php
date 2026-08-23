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
        Schema::create('contact_messages', function (Blueprint $table) {
            $table->id();
            $table->string('merchant_name');
            $table->string('company_name')->nullable();
            $table->string('phone');
            $table->string('email')->nullable();
            $table->string('service_interested')->nullable();
            $table->string('estimated_quantity')->nullable();
            $table->text('message');
            $table->boolean('is_read')->default(false);
            $table->string('status')->default('New');
            $table->text('admin_notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_messages');
    }
};
