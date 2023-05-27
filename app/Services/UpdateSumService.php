<?php

namespace App\Services;

use App\Models\Credit;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Http\Requests\CreatePaymentRequest;
use Illuminate\Http\JsonResponse;
use App\DTO\UpdateSumDataTransferObject;

class UpdateSumService
{
    /**
     * @param CreatePaymentRequest $data
     * @return JsonResponse
     */
    public function handle(UpdateSumDataTransferObject $data): JsonResponse
    {
        $sum = $data->sum;
        $uuid = $data->uuid;

        $credit = Credit::where('uuid', $uuid)->first();

        if (!$credit) {
            throw new NotFoundHttpException();
        }

        if ($credit->total <= $sum) {
            $credit->delete();
            return response()->json([
                'message' => 'Credit has been paid and deleted afterwards'
            ]);
        }

        $credit->update([
            'total' => $credit->total - $sum,
        ]);

        return response()->json([
            'message' => 'Success'
        ]);

    }
}