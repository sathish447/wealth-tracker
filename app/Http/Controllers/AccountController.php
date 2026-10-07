<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use App\Services\AccountService;
use App\Http\Requests\StoreAccountRequest;
use App\Http\Requests\UpdateAccountRequest;



class AccountController extends Controller
{

    public function __construct(
        private AccountService $accountService
    ) {}


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $accounts = $this->accountService
            ->getOrganizationAccounts(
                auth()->user()->organization_id
            );

        return view(
            'accounts.index',
            compact('accounts')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('accounts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
public function store(StoreAccountRequest $request)
{
    $this->accountService->create(
        $request->validated(),
        auth()->user()->organization_id,
        auth()->id()
    );

    return redirect()
        ->route('accounts.index')
        ->with(
            'success',
            'Account created successfully.'
        );
}

    /**
     * Display the specified resource.
     */
    public function show(Account $account)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Account $account)
    {
            $this->authorizeAccount($account);

    return view(
        'accounts.edit',
        compact('account')
    );
    }

    /**
     * Update the specified resource in storage.
     */
public function update(
    UpdateAccountRequest $request,
    Account $account
)
{
    $this->authorizeAccount($account);

    $this->accountService->update(
        $account,
        $request->validated()
    );

    return redirect()
        ->route('accounts.index')
        ->with(
            'success',
            'Account updated successfully.'
        );
}

    /**
     * Remove the specified resource from storage.
     */
public function destroy(Account $account)
{
    $this->authorizeAccount($account);

    $this->accountService->delete($account);

    return redirect()
        ->route('accounts.index')
        ->with(
            'success',
            'Account deleted successfully.'
        );
}


public function toggleStatus(Account $account)
{
    $this->authorizeAccount($account);

    $this->accountService->toggleStatus($account);

    return back()
        ->with(
            'success',
            'Status updated.'
        );
}


private function authorizeAccount(
    Account $account
): void
{
    abort_if(
        $account->organization_id
        !== auth()->user()->organization_id,
        403
    );
}


}
