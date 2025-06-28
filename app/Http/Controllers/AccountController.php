<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use App\Http\Requests\Account\StoreAccountRequest;
use App\Http\Requests\Account\UpdateAccountRequest;
use App\Http\Requests\Account\IndexAccountRequest;
use App\Http\Requests\Account\DestroyAccountRequest;
use App\Http\Resources\Account\IndexAccountResource;
use App\Http\Resources\Account\ShowAccountResource;
use App\Http\Resources\Account\StoreAccountResource;
use App\Http\Resources\Account\UpdateAccountResource;

class AccountController extends Controller
{

    public function index(IndexAccountRequest $request)
    {
        $accounts = Account::all();

        return response()->json([
            'message' => 'Accounts fetched successfully.',
            'data'    => IndexAccountResource::collection($accounts)
        ]);
    }

    public function show(IndexAccountRequest $request, $id)
    {
        $account = Account::findOrFail($id);

        return response()->json([
            'message' => 'Account fetched successfully.',
            'data'    => new ShowAccountResource($account)
        ]);
    }

    public function store(StoreAccountRequest $request)
    {
        $account = Account::create($request->validated());

        return response()->json([
            'message' => 'Account created successfully.',
            'data'    => new StoreAccountResource($account)
        ], 201);
    }

    public function update(UpdateAccountRequest $request, $id)
    {
        $account = Account::findOrFail($id);

        $account->update($request->only(['account_name', 'balance']));

        return response()->json([
            'message' => 'Account updated successfully.',
            'data'    => new UpdateAccountResource($account)
        ]);
    }

    public function destroy(DestroyAccountRequest $request, $id)
    {
        $account = Account::findOrFail($id);
        $account->delete();

        return response()->json(['message' => 'Account deleted successfully.']);
    }
}
