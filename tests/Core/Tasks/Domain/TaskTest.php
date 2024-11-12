<?php

namespace Tests\Core\Tasks\Domain;

use App\Core\Tasks\Domain\Task;
use Illuminate\Support\Facades\Date;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class TaskTest extends TestCase
{
    #[Test]
    public function itShouldCorrectlyInstantiate()
    {
        // Arrange
        $name = 'Boil eggs';
        $description = 'A simple task to boil some eggs';
        $startDate = Date::now()->add('1D')->toDate();
        $endDate = Date::now()->add('2D')->toDate();

        // Act
        $task = new Task($name, $description, $startDate, $endDate);

        // Assert
        $this->assertEquals($name, $task->getName());
        $this->assertEquals($description, $task->getDescription());
        $this->assertEquals($startDate, $task->getStartDate());
        $this->assertEquals($endDate, $task->getEndDate());
        $this->assertNotEmpty($task->getId());
    }

    #[Test]
    public function itShouldAllowChangingName()
    {
        // Arrange
        $name = 'Boil eggs';
        $newName = 'Boil water';
        $description = 'A simple task to boil some eggs';
        $startDate = Date::now()->add('1D')->toDate();
        $endDate = Date::now()->add('2D')->toDate();

        // Act
        $task = new Task($name, $description, $startDate, $endDate);
        $task->setName($newName);

        // Assert
        $this->assertEquals($newName, $task->getName());
    }

    #[Test]
    public function itShouldAllowChangingDescription()
    {
        // Arrange
        $name = 'Boil eggs';
        $description = 'A simple task to boil some eggs';
        $newDescription = 'A simple task to boil some water';
        $startDate = Date::now()->add('1D')->toDate();
        $endDate = Date::now()->add('2D')->toDate();

        // Act
        $task = new Task($name, $description, $startDate, $endDate);
        $task->setDescription($newDescription);

        // Assert
        $this->assertEquals($newDescription, $task->getDescription());
    }

    #[Test]
    public function itShouldAllowChangingTimePeriod()
    {
        // Arrange
        $name = 'Boil eggs';
        $description = 'A simple task to boil some eggs';
        $startDate = Date::now()->add('1D')->toDate();
        $endDate = Date::now()->add('2D')->toDate();
        $newStartDate = Date::now()->add('2D')->toDate();
        $newEndDate = Date::now()->add('3D')->toDate();

        // Act
        $task = new Task($name, $description, $startDate, $endDate);
        $task->setTimePeriod($newStartDate, $newEndDate);

        // Assert
        $this->assertEquals($newStartDate, $task->getStartDate());
        $this->assertEquals($newEndDate, $task->getEndDate());
    }
}
