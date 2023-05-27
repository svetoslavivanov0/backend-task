<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePaymentRequest;
use App\Services\UpdateSumService;
use App\DTO\UpdateSumDataTransferObject;

class CreatePaymentController extends Controller
{
    public function __invoke(CreatePaymentRequest $request)
    {
        $data = new UpdateSumDataTransferObject([
            'sum' => $request->get('sum'),
            'uuid' => $request->get('uuid')
        ]);
       return app()->make(UpdateSumService::class)->handle($data);
    }
}