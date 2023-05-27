<?php

namespace App\Services;

use App\Http\Requests\CreateCreditRequest;
use App\Models\Guest;
use const App\Http\Controllers\MAX_TOTAL;
use App\Exceptions\MaxTotalExceededException;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use App\Models\Credit;

class StoreCreditService
{
    /**
     * @param CreateCreditRequest $request
     * @return Model
     * @throws MaxTotalExceededException
     */
    public function handle(CreateCreditRequest $request): Credit
    {
        $guestName = strtolower($request->get('name'));
        $sum = $request->get('sum');
        $period = $request->get('months');


        /** @var Guest $guest */
        $guest = Guest::where('name', $guestName)->first();

        if (!$guest) {
            $guest = Guest::create([
                'name' => $guestName,
            ]);
        }

        if ($guest->total() + $sum > MAX_TOTAL)
        {
            throw new MaxTotalExceededException('The user has a max total sum of ' . MAX_TOTAL);
        }

        return $guest->credits()->create([
            'sum' => $sum,
            'months' => $period,
            'total' => $sum,
            'uuid' => Str::uuid()->toString(),
        ]);
    }
}