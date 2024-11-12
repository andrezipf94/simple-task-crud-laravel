<?php

namespace App\Core\Tasks\Application\UseCases\Delete;

use App\Core\Tasks\Application\TaskRepositoryInterface;

class Delete
{
    public function __construct(
        private readonly TaskRepositoryInterface $taskRepository
    )
    {
    }

    public function handle(string $id): void
    {
        $this->taskRepository->delete($id);
    }
}
