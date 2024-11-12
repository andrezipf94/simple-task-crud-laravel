<?php

namespace App\Core\Common\VO;

use DomainException;

class UUID
{
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
        // Validate UUID
        if (!preg_match('/^[0-9A-F]{8}-[0-9A-F]{4}-4[0-9A-F]{3}-[89AB][0-9A-F]{3}-[0-9A-F]{12}$/i', $value)) {
            throw new DomainException('Provided value must be a valid UUID (version 4)');
        }
        $this->value = $value;
    }
}
