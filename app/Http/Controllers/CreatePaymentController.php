<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePaymentRequest;
use App\Models\Credit;
use Facade\FlareClient\Http\Exceptions\NotFound;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CreatePaymentController extends Controller
{
    public function __invoke(CreatePaymentRequest $request)
    {
        $sum = $request->get('sum');
        $uuid = $request->get('uuid');

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