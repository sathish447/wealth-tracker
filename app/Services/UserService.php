<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function getOrganizationUsers(int $organizationId)
    {
        return User::where('organization_id', $organizationId)
            ->latest()
            ->get();
    }

    public function create(array $data, int $organizationId): User
    {
        return User::create([
            'organization_id' => $organizationId,
            'name'            => $data['name'],
            'email'           => $data['email'],
            'password'        => Hash::make($data['password']),
            'role'            => 'member',
            'is_active'       => true,
        ]);
    }

    public function update(User $user, array $data): User
    {
        $user->update([
            'name'  => $data['name'],
            'email' => $data['email'],
        ]);

        return $user->fresh();
    }

    public function toggleStatus(User $user): User
    {
        $user->update([
            'is_active' => !$user->is_active
        ]);

        return $user->fresh();
    }

    public function delete(User $user): void
    {
        $user->delete();
    }
}
