<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('investments', function (Blueprint $table) {
            $table->id();

            // Basic investment information
            $table->string('invest_name');
            $table->string('type'); // fd, rd, equity, mutual_fund, ppf, nsc, etc.
            $table->string('status')->default('active');

            // Investment period
            $table->date('start_date');
            $table->date('maturity_date')->nullable();
            $table->unsignedInteger('total_duration_month')->nullable();

            // Payment information
            $table->string('invest_payment_type')->nullable(); // online, manual, cash
            $table->string('payment_mode')->nullable(); // upi, net_banking, bank_transfer, etc.
            $table->string('payment_source')->nullable(); // salary, savings, bank_account, cash, etc.
            $table->boolean('auto_debit')->default(false);

            // Payment tracking
            $table->unsignedInteger('paid_month_count')->default(0);
            $table->decimal('remaining_payment_amount', 15, 2)->default(0);

            // Amount details
            $table->decimal('principal_amount', 15, 2)->default(0);
            $table->decimal('installment_amount', 15, 2)->nullable();

            // Payment frequency
            $table->string('frequency')->nullable(); // monthly, quarterly, yearly, one_time

            // Return details
            $table->decimal('interest_rate', 8, 4)->nullable();
            $table->decimal('expected_maturity_amount', 15, 2)->nullable();

            // Institution / account details
            $table->string('institution_name')->nullable();
            $table->string('account_number')->nullable();

            // Additional information
            $table->text('notes')->nullable();

            $table->timestamps();

            // Indexes
            $table->index('type');
            $table->index('status');
            $table->index('start_date');
            $table->index('maturity_date');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('investments');
    }
};
