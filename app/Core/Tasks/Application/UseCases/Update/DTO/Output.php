<?php

namespace App\Core\Tasks\Application\UseCases\Update\DTO;

class Output
{
    public function __construct(
        public readonly string $id,
        public readonly string $name,
        public readonly string $description,
        public readonly string $startDate,
        public readonly string $endDate
    )
    {
    }
}
