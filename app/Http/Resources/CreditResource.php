<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

class CreditResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'uuid' => $this->uuid,
            'guest' => $this->guest->name,
            'id' => $this->id,
            'period' => $this->months,
            'total' => $this->total,
            'payment' => doubleval($this->total / $this->months)
        ];
    }
}
