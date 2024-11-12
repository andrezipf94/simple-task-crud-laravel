<?php

namespace App\Core\Tasks\Domain;

use App\Core\Common\VO\UUID as UUIDType;
use App\Core\Tasks\Domain\VO\TaskDescription;
use App\Core\Tasks\Domain\VO\TaskName;
use App\Core\Tasks\Domain\VO\TaskTimePeriod;
use DateTimeInterface;
use Symfony\Component\Uid\Uuid;

class Task
{
    private UUIDType $id;
    private TaskName $name;
    private TaskDescription $description;
    private TaskTimePeriod $timePeriod;

    public function __construct(
        string            $name,
        string            $description,
        DateTimeInterface $startDate,
        DateTimeInterface $endDate,
        ?string           $id = null
    )
    {
        $this->setName($name);
        $this->setDescription($description);
        $this->setTimePeriod($startDate, $endDate);
        $this->setId($id ?? Uuid::v4());
    }

    public function getId(): string
    {
        return $this->id->getValue();
    }

    public function setId(string $id): void
    {
        $this->id = new UUIDType($id);
    }

    public function getName(): string
    {
        return $this->name->getValue();
    }

    public function setName(string $name): void
    {
        $this->name = new TaskName($name);
    }

    public function getDescription(): string
    {
        return $this->description->getValue();
    }

    public function setDescription(string $description): void
    {
        $this->description = new TaskDescription($description);
    }

    public function setTimePeriod(DateTimeInterface $startDate, DateTimeInterface $endDate): void
    {
        $this->timePeriod = new TaskTimePeriod($startDate, $endDate);
    }

    public function getStartDate(): DateTimeInterface
    {
        return $this->timePeriod->getStart();
    }

    public function getEndDate(): DateTimeInterface
    {
        return $this->timePeriod->getEnd();
    }
}
