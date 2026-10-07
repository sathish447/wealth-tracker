<?php

namespace App\Services;

use App\Models\Investment;
use Illuminate\Database\Eloquent\Collection;

class InvestmentService
{
    public function getAll(): Collection
    {
        return Investment::latest()->get();
    }

    public function getById(int $id): Investment
    {
        return Investment::findOrFail($id);
    }

    public function create(array $data): Investment
    {
        if (
            !empty($data['installment_amount']) &&
            !empty($data['total_duration_month'])
        ) {
            $data['paid_month_count'] = 0;

            $data['remaining_payment_amount'] =
                $data['installment_amount']
                * $data['total_duration_month'];
        } else {
            $data['paid_month_count'] = 0;
            $data['remaining_payment_amount'] = 0;
        }

        return Investment::create($data);
    }

    public function update(
        Investment $investment,
        array $data
    ): Investment {
        $investment->update($data);

        return $investment->fresh();
    }

    public function delete(Investment $investment): bool
    {
        return $investment->delete();
    }
}
