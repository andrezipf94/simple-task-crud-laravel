<?php

namespace Tests\Core\Tasks\Application\UseCases\Create;

use App\Core\Tasks\Application\TaskRepositoryInterface;
use App\Core\Tasks\Application\UseCases\Create\Create;
use App\Core\Tasks\Application\UseCases\Create\DTO\Input;
use App\Core\Tasks\Domain\Task;
use Illuminate\Support\Facades\Date;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class CreateTest extends TestCase
{
    #[Test]
    public function itShouldCreateATask()
    {
        // Arrange
        $input = new Input(
            name: 'Task name',
            description: 'Task description',
            startDate: Date::now()->add('1D'),
            endDate: Date::now()->add('2D')
        );
        $repositoryMock = $this->createMock(TaskRepositoryInterface::class);
        $repositoryMock->expects($this->once())
            ->method('save')
            ->with($this->callback(function (Task $task) use ($input) {
                return $task->getName() === $input->name
                    && $task->getDescription() === $input->description
                    && $task->getStartDate()->format('Y-m-d H:i:s') === $input->startDate->format('Y-m-d H:i:s')
                    && $task->getEndDate()->format('Y-m-d H:i:s') === $input->endDate->format('Y-m-d H:i:s');
            }));

        // Act
        $useCase = new Create($repositoryMock);
        $output = $useCase->handle($input);

        // Assert
        $this->assertNotEmpty($output->id);
        $this->assertEquals($input->name, $output->name);
        $this->assertEquals($input->description, $output->description);
        $this->assertEquals($input->startDate->format('Y-m-d H:i:s'), $output->startDate);
        $this->assertEquals($input->endDate->format('Y-m-d H:i:s'), $output->endDate);
    }
}
