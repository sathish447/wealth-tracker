<?php

namespace App\Http\Controllers;

use App\Models\Investment;
use App\Services\InvestmentService;
use Illuminate\Http\Request;

class InvestmentController extends Controller
{
    public function __construct(
        protected InvestmentService $investmentService
    ) {
    }

    public function index()
    {
        $investments = $this->investmentService->getAll();

        return view('investments.index', compact('investments'));
    }

    public function create()
    {
        return view('investments.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'invest_name' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'max:50'],
            'status' => ['required', 'string', 'max:50'],

            'start_date' => ['required', 'date'],
            'maturity_date' => ['nullable', 'date'],

            'total_duration_month' => ['nullable', 'integer', 'min:1'],

            'invest_payment_type' => ['nullable', 'string', 'max:50'],
            'payment_mode' => ['nullable', 'string', 'max:50'],
            'payment_source' => ['nullable', 'string', 'max:100'],

            'auto_debit' => ['nullable', 'boolean'],

            'principal_amount' => ['required', 'numeric', 'min:0'],
            'installment_amount' => ['nullable', 'numeric', 'min:0'],

            'frequency' => ['nullable', 'string', 'max:50'],

            'interest_rate' => ['nullable', 'numeric', 'min:0'],
            'expected_maturity_amount' => ['nullable', 'numeric', 'min:0'],

            'institution_name' => ['nullable', 'string', 'max:255'],
            'account_number' => ['nullable', 'string', 'max:100'],

            'notes' => ['nullable', 'string'],
        ]);

        $this->investmentService->create($validated);

        return redirect()
            ->route('investments.index')
            ->with('success', 'Investment created successfully.');
    }

    public function edit(Investment $investment)
    {
        return view('investments.edit', compact('investment'));
    }

    public function update(Request $request, Investment $investment)
    {
        $validated = $request->validate([
            'invest_name' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'max:50'],
            'status' => ['required', 'string', 'max:50'],

            'start_date' => ['required', 'date'],
            'maturity_date' => ['nullable', 'date'],

            'total_duration_month' => ['nullable', 'integer', 'min:1'],

            'invest_payment_type' => ['nullable', 'string', 'max:50'],
            'payment_mode' => ['nullable', 'string', 'max:50'],
            'payment_source' => ['nullable', 'string', 'max:100'],

            'auto_debit' => ['nullable', 'boolean'],

            'principal_amount' => ['required', 'numeric', 'min:0'],
            'installment_amount' => ['nullable', 'numeric', 'min:0'],

            'frequency' => ['nullable', 'string', 'max:50'],

            'interest_rate' => ['nullable', 'numeric', 'min:0'],
            'expected_maturity_amount' => ['nullable', 'numeric', 'min:0'],

            'institution_name' => ['nullable', 'string', 'max:255'],
            'account_number' => ['nullable', 'string', 'max:100'],

            'notes' => ['nullable', 'string'],
        ]);

        $this->investmentService->update(
            $investment,
            $validated
        );

        return redirect()
            ->route('investments.index')
            ->with('success', 'Investment updated successfully.');
    }

    public function destroy(Investment $investment)
    {
        $this->investmentService->delete($investment);

        return redirect()
            ->route('investments.index')
            ->with('success', 'Investment deleted successfully.');
    }
}
