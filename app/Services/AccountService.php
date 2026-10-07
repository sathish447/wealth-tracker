<?php

namespace App\Services;

use App\Models\Account;

class AccountService
{
    public function getOrganizationAccounts($organizationId)
    {
        return Account::where(
            'organization_id',
            $organizationId
        )->latest()->get();
    }

    public function create(array $data, int $organizationId, int $userId)
    {
        return Account::create([
            'organization_id' => $organizationId,
            'user_id' => $userId,
            'name' => $data['name'],
            'account_type' => $data['account_type'],
            'institution_name' => $data['institution_name'] ?? null,
            'account_number' => $data['account_number'] ?? null,
            'opening_balance' => $data['opening_balance'],
            'current_balance' => $data['opening_balance'],
            'notes' => $data['notes'] ?? null,
            'is_active' => true,
        ]);
    }

    public function update(Account $account, array $data)
    {
        $account->update([
            'name' => $data['name'],
            'account_type' => $data['account_type'],
            'institution_name' => $data['institution_name'] ?? null,
            'account_number' => $data['account_number'] ?? null,
            'notes' => $data['notes'] ?? null,
        ]);

        return $account->fresh();
    }

    public function delete(Account $account)
    {
        $account->delete();
    }

    public function toggleStatus(Account $account)
    {
        $account->update([
            'is_active' => !$account->is_active
        ]);

        return $account->fresh();
    }
}
