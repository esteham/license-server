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

        Schema::create('licenses', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('buyer_email')->unique();
            $table->string('buyer_name')->unique();
            $table->string('company')->nullable();
            $table->enum('status', ['active', 'blocked', 'refunded', 'expired'])->default('active');
            $table->unsignedInteger('max_activations')->default(1);
            $table->date('support_until')->nullable();
            $table->json('meta')->nullable();
            $table->timestamps();
        });


        Schema::create('license_activations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('license_id')->constrained('licenses')->onDelete('cascade');
            $table->string('domain')->index();
            $table->string('api_url')->nullable();
            $table->string('fingerprint')->nullable();
            $table->timestamp('activated_at')->nullable();
            $table->timestamp('deactivated_at')->nullable();
            $table->timestamps();

            $table->unique(['license_id', 'domain', 'fingerprint']);
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('licenses');
        Schema::dropIfExists('license_activations');

    }

};
