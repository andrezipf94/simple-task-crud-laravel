<?php

namespace App\Core\Tasks\Application;

use App\Core\Tasks\Domain\Task;

interface TaskRepositoryInterface
{
    public function save(Task $task): string;

    public function delete(string $id): void;

    public function find(string $id): ?Task;
}
