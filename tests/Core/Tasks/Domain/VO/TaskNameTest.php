<?php

namespace Tests\Core\Tasks\Domain\VO;

use App\Core\Tasks\Domain\VO\TaskName;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class TaskNameTest extends TestCase
{
    #[Test]
    public function itShouldCorrectlyInstantiate()
    {
        // Arrange
        $description = str_repeat('a', 100);

        // Act
        $taskName = new TaskName($description);

        // Assert
        $this->assertEquals($description, $taskName->getValue());
    }

    #[Test]
    public function itShouldAllowChangingValue()
    {
        // Arrange
        $name = str_repeat('a', 100);
        $newName = str_repeat('b', 90);

        // Act
        $taskName = new TaskName($name);
        $taskName->setValue($newName);

        // Assert
        $this->assertEquals($newName, $taskName->getValue());
    }

    #[Test]
    public function itShouldValidateMaxLength()
    {
        // Arrange
        $taskName = str_repeat('a', 101);
        $this->expectException(\DomainException::class);
        $this->expectExceptionMessage('Task name is too long. It should not exceed 100 characters');

        // Act
        new TaskName($taskName);
    }
}
