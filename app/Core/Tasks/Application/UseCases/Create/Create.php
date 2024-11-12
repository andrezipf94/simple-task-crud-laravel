<?php

namespace App\Core\Tasks\Application\UseCases\Create;

use App\Core\Tasks\Application\TaskRepositoryInterface;
use App\Core\Tasks\Application\UseCases\Create\DTO\Input;
use App\Core\Tasks\Application\UseCases\Create\DTO\Output;
use App\Core\Tasks\Domain\Task;

class Create
{
    public function __construct(
        private readonly TaskRepositoryInterface $taskRepository
    )
    {
    }

    public function handle(Input $input): Output
    {
        $task = $this->performCreation($input);
        return new Output(
            $task->getId(),
            $task->getName(),
            $task->getDescription(),
            $task->getStartDate()->format('Y-m-d H:i:s'),
            $task->getEndDate()->format('Y-m-d H:i:s')
        );
    }

    private function performCreation(Input $input): Task
    {
        $task = new Task(
            $input->name,
            $input->description,
            $input->startDate,
            $input->endDate
        );
        $this->taskRepository->save($task);
        return $task;
    }
}
