<?php

namespace App\Core\Tasks\Application\Exceptions;

class TaskNotFoundException extends \RuntimeException
{
    public function __construct(string $id)
    {
        parent::__construct("A task with id $id could not be found");
    }
}
