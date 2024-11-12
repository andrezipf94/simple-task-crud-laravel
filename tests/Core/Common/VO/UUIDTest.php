<?php

namespace Tests\Core\Common\VO;

use App\Core\Common\VO\UUID;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class UUIDTest extends TestCase
{
    #[Test]
    public function itShouldCorrectlyInstantiate()
    {
        // Arrange
        $uuidString = \Symfony\Component\Uid\Uuid::v4()->toString();

        // Act
        $uuid = new UUID($uuidString);

        // Assert
        $this->assertEquals($uuidString, $uuid->getValue());
    }

    #[Test]
    public function itShouldAllowChangingValue()
    {
        // Arrange
        $uuidString = \Symfony\Component\Uid\Uuid::v4()->toString();
        $newUuidString = \Symfony\Component\Uid\Uuid::v4()->toString();

        // Act
        $uuid = new UUID($uuidString);
        $uuid->setValue($newUuidString);

        // Assert
        $this->assertEquals($newUuidString, $uuid->getValue());
    }

    #[Test]
    public function itShouldValidateUuid()
    {
        // Arrange
        $uuidString = 'invalid';

        $this->expectException(\DomainException::class);
        $this->expectExceptionMessage('Provided value must be a valid UUID (version 4)');

        // Act
        new UUID($uuidString);
    }
}
