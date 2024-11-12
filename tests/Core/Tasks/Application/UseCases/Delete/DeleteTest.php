<?php

namespace Tests\Core\Tasks\Application\UseCases\Delete;

use App\Core\Tasks\Application\TaskRepositoryInterface;
use App\Core\Tasks\Application\UseCases\Delete\Delete;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Uid\Uuid;

class DeleteTest extends TestCase
{
    #[Test]
    public function itShouldDeleteATask()
    {
        // Arrange
        $deletionUuid = Uuid::v4();
        $repositoryMock = $this->createMock(TaskRepositoryInterface::class);
        $repositoryMock->expects($this->once())
            ->method('delete')
            ->with($deletionUuid);

        // Act
        $useCase = new Delete($repositoryMock);
        $useCase->handle($deletionUuid);
    }
}
