<?php

namespace App\Core\Tasks\Domain\VO;

class TaskDescription
{
    private const MAX_LENGTH = 255;
    private const MIN_LENGTH = 3;

    private string $value;

    public function __construct(string $value) {
        $this->setValue($value);
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function setValue(string $value): void
    {
        if (strlen($value) > self::MAX_LENGTH) {
            throw new \DomainException('Task description is too long. It should not exceed ' . self::MAX_LENGTH . ' characters');
        }
        if (strlen($value) < self::MIN_LENGTH) {
            throw new \DomainException('Task description is too short. It should have at least ' . self::MIN_LENGTH . ' characters');
        }
        $this->value = $value;
    }


}
