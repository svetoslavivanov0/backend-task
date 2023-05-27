<?php

namespace App\DTO;

use Spatie\DataTransferObject\DataTransferObject;

class CreateCreditDataTransferObject extends DataTransferObject
{
    public int $months;
    public int $sum;
    public string $name;
}