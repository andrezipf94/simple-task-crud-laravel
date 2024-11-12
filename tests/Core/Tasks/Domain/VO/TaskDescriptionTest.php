<?php

namespace Tests\Core\Tasks\Domain\VO;

use App\Core\Tasks\Domain\VO\TaskDescription;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class TaskDescriptionTest extends TestCase
{
    #[Test]
    public function itShouldCorrectlyInstantiate()
    {
        // Arrange
        $description = str_repeat('a', 200);

        // Act
        $taskDescription = new TaskDescription($description);

        // Assert
        $this->assertEquals($description, $taskDescription->getValue());
    }

    #[Test]
    public function itShouldAllowChangingValue()
    {
        // Arrange
        $description = str_repeat('a', 200);
        $newDescription = str_repeat('b', 100);

        // Act
        $taskDescription = new TaskDescription($description);
        $taskDescription->setValue($newDescription);

        // Assert
        $this->assertEquals($newDescription, $taskDescription->getValue());
    }

    #[Test]
    public function itShouldValidateMaxLength()
    {
        // Arrange
        $taskDescription = str_repeat('a', 256);
        $this->expectException(\DomainException::class);
        $this->expectExceptionMessage('Task description is too long. It should not exceed 255 characters');

        // Act
        new TaskDescription($taskDescription);
    }

    #[Test]
    public function itShouldValidateMinLength()
    {
        // Arrange
        $taskDescription = str_repeat('a', 2);
        $this->expectException(\DomainException::class);
        $this->expectExceptionMessage('Task description is too short. It should have at least 3 characters');

        // Act
        new TaskDescription($taskDescription);
    }
}
