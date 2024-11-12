<?php

namespace App\Core\Tasks\Domain\VO;

use DateTimeImmutable;
use DateTimeInterface;
use DomainException;

class TaskTimePeriod
{
    private DateTimeInterface $start;
    private DateTimeInterface $end;

    public function __construct(DateTimeInterface $start, DateTimeInterface $end)
    {
        $this->setStart($start);
        $this->setEnd($end);
    }

    public function getStart(): DateTimeInterface
    {
        return $this->start;
    }

    public function setStart(DateTimeInterface $start): void
    {
        if ($start < new DateTimeImmutable()) {
            throw new DomainException('A task start date must not be in the past');
        }
        if (isset($this->end) && $start > $this->getEnd()) {
            throw new DomainException('A task start date must not be after it\'s end date');
        }
        $this->start = $start;
    }

    public function getEnd(): DateTimeInterface
    {
        return $this->end;
    }

    public function setEnd(DateTimeInterface $end): void
    {
        if ($end < new DateTimeImmutable()) {
            throw new DomainException('A task end date must not be in the past');
        }
        if ($end < $this->getStart()) {
            throw new DomainException('A task end date must not be prior to the start date');
        }
        $this->end = $end;
    }


}
