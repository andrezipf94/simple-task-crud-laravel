<?php

namespace Tests\Core\Tasks\Application\UseCases\Update;

use App\Core\Tasks\Application\TaskRepositoryInterface;
use App\Core\Tasks\Application\UseCases\Update\DTO\Input;
use App\Core\Tasks\Application\UseCases\Update\Update;
use App\Core\Tasks\Domain\Task;
use Illuminate\Support\Facades\Date;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Uid\Uuid;

class UpdateTest extends TestCase
{
    #[Test]
    public function itShouldUpdateATask()
    {
        // Arrange
        $input = new Input(
            id: Uuid::v4(),
            name: 'Task name',
            description: 'Task description',
            startDate: Date::now()->add('1D'),
            endDate: Date::now()->add('2D')
        );
        $task = new Task(
            $input->name,
            $input->description,
            $input->startDate,
            $input->endDate
        );
        $task->setId($input->id);
        $repositoryMock = $this->createMock(TaskRepositoryInterface::class);
        $repositoryMock->expects($this->once())
            ->method('find')
            ->with($input->id)
            ->willReturn($task);
        $repositoryMock->expects($this->once())
            ->method('save')
            ->with($this->callback(function (Task $task) use ($input) {
                return $task->getName() === $input->name
                    && $task->getDescription() === $input->description
                    && $task->getStartDate()->format('Y-m-d H:i:s') === $input->startDate->format('Y-m-d H:i:s')
                    && $task->getEndDate()->format('Y-m-d H:i:s') === $input->endDate->format('Y-m-d H:i:s');
            }));

        // Act
        $useCase = new Update($repositoryMock);
        $output = $useCase->handle($input->id, $input);

        // Assert
        $this->assertEquals($input->id, $output->id);
        $this->assertEquals($input->name, $output->name);
        $this->assertEquals($input->description, $output->description);
        $this->assertEquals($input->startDate->format('Y-m-d H:i:s'), $output->startDate);
        $this->assertEquals($input->endDate->format('Y-m-d H:i:s'), $output->endDate);
    }
}
