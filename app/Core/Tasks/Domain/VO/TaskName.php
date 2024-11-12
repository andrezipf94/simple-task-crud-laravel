<?php

namespace App\Core\Tasks\Domain\VO;

class TaskName
{
    private const MAX_LENGTH = 100;

    private string $value;

    public function __construct(string $value)
    {
        $this->setValue($value);
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function setValue(string $value): void
    {
        if (strlen($value) > self::MAX_LENGTH) {
            throw new \DomainException('Task name is too long. It should not exceed ' . self::MAX_LENGTH . ' characters');
        }
        $this->value = $value;
    }
}
