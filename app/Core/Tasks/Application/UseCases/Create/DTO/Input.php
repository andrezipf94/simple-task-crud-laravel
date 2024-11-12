<?php

namespace App\Core\Tasks\Application\UseCases\Create\DTO;

use DateTimeInterface;

class Input
{
    public function __construct(
        public readonly string            $name,
        public readonly string            $description,
        public readonly DateTimeInterface $startDate,
        public readonly DateTimeInterface $endDate
    )
    {
    }
}
