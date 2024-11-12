<?php

namespace App\Core\Tasks\Application\UseCases\Update;

use App\Core\Tasks\Application\Exceptions\TaskNotFoundException;
use App\Core\Tasks\Application\TaskRepositoryInterface;
use App\Core\Tasks\Application\UseCases\Update\DTO\Input;
use App\Core\Tasks\Application\UseCases\Update\DTO\Output;
use App\Core\Tasks\Domain\Task;

class Update
{
    public function __construct(
        private readonly TaskRepositoryInterface $taskRepository
    )
    {
    }

    public function handle(string $id, Input $input): Output
    {
        $task = $this->findTask($id);
        $this->performUpdate($task, $input);
        return new Output(
            $task->getId(),
            $task->getName(),
            $task->getDescription(),
            $task->getStartDate()->format('Y-m-d H:i:s'),
            $task->getEndDate()->format('Y-m-d H:i:s')
        );
    }

    private function findTask(string $id): Task
    {
        $task = $this->taskRepository->find($id);
        if (!$task) {
            throw new TaskNotFoundException($id);
        }
        return $task;
    }

    private function performUpdate(Task $task, Input $input): void
    {
        $task->setName($input->name ?? $task->getName());
        $task->setDescription($input->description ?? $task->getDescription());
        $task->setTimePeriod($input->startDate ?? $task->getStartDate(), $input->endDate ?? $task->getEndDate());
        $this->taskRepository->save($task);
    }
}
