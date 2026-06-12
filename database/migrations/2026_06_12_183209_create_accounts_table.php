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
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('organization_id')->constrained();
            $table->foreignId('user_id')->constrained();

            $table->string('name');

            $table->enum('account_type', [
                'savings',
                'current',
                'cash',
                'wallet',
                'credit_card'
            ]);

            $table->string('institution_name')->nullable();

            $table->string('account_number', 100)->nullable();

            $table->decimal('opening_balance', 15, 2)
                ->default(0);

            $table->decimal('current_balance', 15, 2)
                ->default(0);

            $table->boolean('is_active')
                ->default(true);

            $table->text('notes')
                ->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};
