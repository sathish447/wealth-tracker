<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\UserService;
use App\Http\Requests\Users\StoreUserRequest;
use App\Http\Requests\Users\UpdateUserRequest;

class UserController extends Controller
{
    public function __construct(
        private UserService $userService
    ) {}

    public function index()
    {
        $users = $this->userService
            ->getOrganizationUsers(
                auth()->user()->organization_id
            );

        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(StoreUserRequest $request)
    {
        $this->userService->create(
            $request->validated(),
            auth()->user()->organization_id
        );

        return redirect()
            ->route('users.index')
            ->with('success', 'Member created successfully.');
    }

    public function edit(User $user)
    {
        $this->authorizeUser($user);

        return view('users.edit', compact('user'));
    }

    public function update(
        UpdateUserRequest $request,
        User $user
    ) {
        $this->authorizeUser($user);

        $this->userService->update(
            $user,
            $request->validated()
        );

        return redirect()
            ->route('users.index')
            ->with('success', 'Member updated successfully.');
    }

    public function destroy(User $user)
    {
        $this->authorizeUser($user);

        $this->userService->delete($user);

        return redirect()
            ->route('users.index')
            ->with('success', 'Member deleted successfully.');
    }

    public function toggleStatus(User $user)
    {
        $this->authorizeUser($user);

        $this->userService->toggleStatus($user);

        return back()
            ->with('success', 'Status updated.');
    }

    private function authorizeUser(User $user): void
    {
        abort_if(
            $user->organization_id !== auth()->user()->organization_id,
            403
        );
    }
}
