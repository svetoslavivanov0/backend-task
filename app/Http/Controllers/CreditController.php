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
use App\DTO\CreateCreditDataTransferObject;

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
        $data = new CreateCreditDataTransferObject([
            'name' => $request->get('name'),
            'months' => $request->get('months'),
            'sum' => $request->get('sum'),
        ]);

        $credit = app()->make(StoreCreditService::class)->handle($data);

        return CreditResource::make($credit);
    }
}