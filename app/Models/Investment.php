<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Investment extends Model
{
    protected $fillable = [
        'invest_name',
        'type',
        'status',
        'start_date',
        'maturity_date',
        'total_duration_month',

        'invest_payment_type',
        'payment_mode',
        'payment_source',
        'auto_debit',

        'paid_month_count',
        'remaining_payment_amount',

        'principal_amount',
        'installment_amount',
        'frequency',

        'interest_rate',
        'expected_maturity_amount',

        'institution_name',
        'account_number',
        'notes',
    ];

    protected $casts = [
        'start_date' => 'date',
        'maturity_date' => 'date',

        'auto_debit' => 'boolean',

        'principal_amount' => 'decimal:2',
        'installment_amount' => 'decimal:2',
        'remaining_payment_amount' => 'decimal:2',
        'interest_rate' => 'decimal:4',
        'expected_maturity_amount' => 'decimal:2',

        'total_duration_month' => 'integer',
        'paid_month_count' => 'integer',
    ];
}
