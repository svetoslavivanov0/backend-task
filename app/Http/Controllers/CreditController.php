<?php

namespace App\Http\Controllers;

use App\Models\Credit;
use App\Http\Resources\CreditResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use App\Http\Requests\CreateCreditRequest;
use App\Models\Guest;
use Illuminate\Support\Str;
use App\Exceptions\MaxTotalExceededException;
use App\Services\StoreCreditService;

const MAX_TOTAL = 80000;
class CreditController
{
    /**
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return CreditResource::collection(Credit::query()->paginate());
    }

    /**
     * @param CreateCreditRequest $request
     * @return CreditResource
     * @throws MaxTotalExceededException
     */
    public function store(CreateCreditRequest $request): CreditResource
    {
        $credit = app()->make(StoreCreditService::class)->handle($request);

        return CreditResource::make($credit);
    }
}