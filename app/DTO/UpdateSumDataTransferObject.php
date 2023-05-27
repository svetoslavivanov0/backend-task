<?php

namespace App\DTO;

use Spatie\DataTransferObject\DataTransferObject;

class UpdateSumDataTransferObject extends DataTransferObject
{
    public int $sum;
    public string $uuid;
}