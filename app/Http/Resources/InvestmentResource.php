<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InvestmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,

            'invest_name' => $this->invest_name,
            'type' => $this->type,
            'status' => $this->status,

            'start_date' => $this->start_date?->format('Y-m-d'),
            'maturity_date' => $this->maturity_date?->format('Y-m-d'),
            'total_duration_month' => $this->total_duration_month,

            'payment' => [
                'invest_payment_type' => $this->invest_payment_type,
                'payment_mode' => $this->payment_mode,
                'payment_source' => $this->payment_source,
                'auto_debit' => $this->auto_debit,
            ],

            'tracking' => [
                'paid_month_count' => $this->paid_month_count,
                'remaining_payment_amount' => $this->remaining_payment_amount,
            ],

            'amount' => [
                'principal_amount' => $this->principal_amount,
                'installment_amount' => $this->installment_amount,
                'frequency' => $this->frequency,
            ],

            'returns' => [
                'interest_rate' => $this->interest_rate,
                'expected_maturity_amount' => $this->expected_maturity_amount,
            ],

            'institution' => [
                'name' => $this->institution_name,
                'account_number' => $this->account_number,
            ],

            'notes' => $this->notes,

            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at?->format('Y-m-d H:i:s'),
        ];
    }
}
