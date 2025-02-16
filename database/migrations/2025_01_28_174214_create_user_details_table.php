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
        Schema::create('user_details', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('program_id')->constrained('programs')->onDelete('cascade');
            $table->unsignedBigInteger('batch_id')->nullable()->after('id');
            $table->foreign('batch_id')->references('id')->on('batches')->onDelete('SET NULL');
            $table->string('place', 30);
            $table->string('number_of_participants', 3)->nullable();
            $table->string('position', 30)->nullable();
            $table->string('instance')->nullable();
            $table->string('email')->nullable();
            $table->text('address')->nullable();
            $table->string('last_education', 10)->nullable();
            $table->enum('gender', ['1', '2'])->nullable();
            $table->enum('identity_type', ['KTP', 'SIM', 'KP'])->nullable();
            $table->string('identity_number')->nullable();
            $table->text('reason_to_join');
            $table->string('phone_number');
            $table->string('information_source');
            $table->string('referral')->nullable();
            $table->string('occupation')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_details');
        Schema::table('user_details', function (Blueprint $table) {
            $table->dropColumn('training_ticket');
        });
    }
};
