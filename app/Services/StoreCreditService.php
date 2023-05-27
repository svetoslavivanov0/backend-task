<?php

namespace App\Services;

use App\Http\Requests\CreateCreditRequest;
use App\Models\Guest;
use const App\Http\Controllers\MAX_TOTAL;
use App\Exceptions\MaxTotalExceededException;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use App\Models\Credit;
use App\DTO\CreateCreditDataTransferObject;

class StoreCreditService
{
    /**
     * @param CreateCreditRequest $request
     * @return Model
     * @throws MaxTotalExceededException
     */
    public function handle(CreateCreditDataTransferObject $data): Credit
    {
        $guestName = $data->name;
        $sum = $data->sum;
        $period = $data->months;


        /** @var Guest $guest */
        $guest = Guest::whereRaw('LOWER(name) = ?', $guestName)->first();

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
            'months' => $period,
            'total' => $sum,
            'uuid' => Str::uuid()->toString(),
        ]);
    }
}